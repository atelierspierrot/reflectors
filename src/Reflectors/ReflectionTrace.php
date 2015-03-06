<?php
/**
 * This file is part of the Reflectors package.
 *
 * Copyright (c) 2013-2015 Pierre Cassat <me@e-piwi.fr> and contributors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * The source code of this package is available online at
 * <http://github.com/atelierspierrot/reflectors>.
 */

namespace Reflectors;

/**
 * Class ReflectionTrace
 * @link    http://php.net/manual/class.reflector.php
 */
class ReflectionTrace
    implements \Reflector
{

    /**
     * This class inherits from \Reflectors\ReflectorTrait
     */
    use ReflectorTrait;

    /**
     * @var array An array of internal PHP functions not considered as real traces
     */
    public static $not_real_fcts = array('require', 'require_once', 'include', 'include_once');

    protected $object;
    protected $class_name;
    protected $class;
    protected $function_name;
    protected $function;
    protected $line;
    protected $file;
    protected $type;
    protected $called;
    protected $args;
    protected $arguments;

    /**
     * @param array $trace
     */
    public function __construct(array $trace)
    {
        $entries = array(
            'object', 'line', 'file', 'type', 'args',
            'class'     => 'class_name',
            'function'  => 'function_name'
        );
        foreach ($entries as $k=>$entry) {
            $index = is_string($k) ? $k : $entry;
            if (array_key_exists($index, $trace) && !empty($trace[$index])) {
                $this->{$entry} = $trace[$index];
            }
        }
    }

    /**
     * Returns a representation of called method or function
     *
     * Rendering:
     *
     *      ClassName::method
     *      object->method
     *      function
     *      -
     *
     * @return string
     */
    public function getCalled()
    {
        if (empty($this->called)) {
            if (!empty($this->class_name)) {
                $this->called = $this->class_name.$this->type.$this->function_name;
            } else {
                $this->called = isset($this->function_name) ? $this->function_name : '-';
            }
        }
        return $this->called;
    }

    /**
     * Returns the object if defined
     *
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Returns the class name if defined
     *
     * @return string|null
     */
    public function getClassName()
    {
        return $this->class_name;
    }

    /**
     * Returns the class as a `\ReflectionClass` object if defined
     *
     * @return \ReflectionClass|null
     */
    public function getClass()
    {
        if (empty($this->class) && !empty($this->class_name)) {
            $this->class = new \ReflectionClass($this->class_name);
        }
        return $this->class;
    }

    /**
     * Returns the function name if defined
     *
     * @return string|null
     */
    public function getFunctionName()
    {
        return $this->function_name;
    }

    /**
     * Returns the class as a `\ReflectionFunction` or `\ReflectionMethod` object if defined
     *
     * @return \ReflectionFunction|\ReflectionMethod|null
     */
    public function getFunction()
    {
        if (empty($this->function) && !empty($this->function_name)) {
            if (
                !empty($this->class_name) &&
                method_exists($this->class_name, $this->function_name) &&
                is_callable(array($this->class_name, $this->function_name))
            ) {
                $this->function = new \ReflectionMethod($this->class_name, $this->function_name);
            } elseif (
                function_exists($this->function_name)
            ) {
                $this->function = new \ReflectionFunction($this->function_name);
            }
        }
        return $this->function;
    }

    /**
     * Returns concerned line if defined
     *
     * @return int|null
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Returns concerned file if defined
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file;
    }

    /**
     * Returns concerned type if defined
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the trace arguments as the original array
     *
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Returns the trace arguments as an array of `\Reflectors\ReflectionParameterValue` or `\ReflectionParameter` items
     *
     * @return array
     */
    public function getArguments()
    {
        if (empty($this->arguments) && !empty($this->args) && count($this->args)>0) {
            $this->arguments = array();
            $cls_name = $this->getClassName();
            $fct_name = $this->getFunctionName();

            if (
                empty($cls_name) &&
                !empty($fct_name) &&
                in_array($fct_name, self::$not_real_fcts)
            ) {
                return $this->arguments;
            }

            $methodReflect      = $this->getFunction();
            $argumentsReflect   = $methodReflect->getParameters();

            foreach($this->getArgs() as $index=>$value) {
                if (isset($argumentsReflect[$index])) {
                    $paramReflect = $argumentsReflect[$index];
                } else {
                    $paramReflect = new \ReflectionParameter('_empty_parameter_ghost', 'param');
                }
                if (!empty($cls_name)) {
                    $this->arguments[$index] = new ReflectionParameterValue(
                        array($fct_name, $cls_name), $paramReflect->getName(), $value
                    );
                } else {
                    $this->arguments[$index] = new ReflectionParameterValue(
                        $fct_name, $paramReflect->getName(), $value
                    );
                }
            }
        } else {
            $this->arguments = array();
        }
        return $this->arguments;
    }

    /**
     * Representation of the object
     *
     * If an exception is caught, its message is returned instead of the
     * original result (but its not thrown ahead).
     *
     * @return string
     */
    public function __toString()
    {
        try {
            $str = 'at '.$this->getCalled();

            $args = $this->getArguments();
            if (!empty($args)) {
                $str .= ' (';
                foreach ($args as $i=>$arg) {
                    $str .= $arg->__toString();
                    if ($i<count($args)) {
                        $str .= ' , ';
                    }
                }
                $str .= ' )';
            } else {
                $str .= ' ()';
            }

            $file = $this->getFileName();
            $line = $this->getLine();
            if (!empty($file)) {
                $str .= PHP_EOL.' in file '.$file;
                if (!empty($line)) {
                    $str .= ' at line '.$line;
                }
            }

            return $str;
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

function _empty_parameter_ghost($param = null) {}

// Endfile