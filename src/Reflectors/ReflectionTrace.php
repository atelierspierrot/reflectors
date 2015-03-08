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

namespace
{
    /*
     * Special function to create a not existing parameter
     */
    function _empty_parameter_ghost($param = null) {}
}

namespace Reflectors
{

    /**
     * This is the backtrace item reflector
     *
     * @TODO redraw the _empty_parameter_ghost in the same namespace (closure ?)
     */
    class ReflectionTrace
        implements \Reflector
    {

        use ReflectorTrait, ReadOnlyPropertiesTrait;

        /**
         * @var array An array of internal PHP functions not considered as real traces
         */
        public static $not_real_fcts = array('require', 'require_once', 'include', 'include_once');

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $object;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $class;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $function;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $line;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $file;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $type;

        /**
         * @var null|object   The current object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
         */
        protected $args;

        protected $function_reflection;
        protected $class_reflection;
        protected $called;
        protected $arguments;
        protected static $_read_only = array(
            'function'  => 'getFunctionName',
            'line'      => 'getLine',
            'file'      => 'getFile',
            'class'     => 'getClassName',
            'object'    => 'getObject',
            'type'      => 'getType',
            'args'      => 'getArgs',
        );

        /**
         * @param array $trace
         */
        public function __construct(array $trace)
        {
            $this->setReadOnlyProperties($this::$_read_only);
            $entries = array(
                'function', 'line', 'file', 'class', 'object', 'type', 'args'
            );
            foreach ($entries as $entry) {
                if (array_key_exists($entry, $trace)) {
                    $this->{$entry} = $trace[$entry];
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
                $class_name = $this->getClassName();
                $function_name = $this->getFunctionName();
                $type = $this->getType();
                if (!empty($class_name)) {
                    $this->called = $class_name . $type . $function_name;
                } else {
                    $this->called = isset($function_name) ? $function_name : '-';
                }
            }
            return $this->called;
        }

        /**
         * Tests if an object is defined
         *
         * @return bool
         */
        public function hasObject()
        {
            return (bool)!empty($this->object);
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
            return $this->class;
        }

        /**
         * Returns the class as a `\ReflectionClass` object if defined
         *
         * @return \ReflectionClass|null
         */
        public function getClass()
        {
            $cls_name = $this->getClassName();
            if (empty($this->class_reflection) && !empty($cls_name)) {
                $this->class_reflection = new \ReflectionClass($cls_name);
            }
            return $this->class_reflection;
        }

        /**
         * Returns the function name if defined
         *
         * @return string|null
         */
        public function getFunctionName()
        {
            return $this->function;
        }

        /**
         * Returns the class as a `\ReflectionFunction` or `\ReflectionMethod` object if defined
         *
         * @return \ReflectionFunction|\ReflectionMethod|null
         */
        public function getFunction()
        {
            $fct_name = $this->getFunctionName();
            if (empty($this->function_reflection) && !empty($fct_name)) {
                $cls_name = $this->getClassName();
                if (
                    !empty($cls_name) &&
                    method_exists($cls_name, $fct_name)
                ) {
                    $this->function_reflection = new \ReflectionMethod($cls_name, $fct_name);
                } elseif (
                    function_exists($fct_name)
                ) {
                    $this->function_reflection = new \ReflectionFunction($fct_name);
                }
            }
            return $this->function_reflection;
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
        public function getFile()
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
            $args               = $this->getArgs();
            $this->arguments    = array();
            if (empty($this->arguments) && !empty($args) && count($args) > 0) {
                $this->arguments    = array();
                $cls_name           = $this->getClassName();
                $fct_name           = $this->getFunctionName();

                if (
                    empty($cls_name) &&
                    !empty($fct_name) &&
                    in_array($fct_name, self::$not_real_fcts)
                ) {
                    return $this->arguments;
                }

                $methodReflect      = $this->getFunction();
                if (!empty($methodReflect)) {
                    $argumentsReflect       = $methodReflect->getParameters();
                    foreach ($this->getArgs() as $index => $value) {
                        if (isset($argumentsReflect[$index])) {
                            $paramReflect   = $argumentsReflect[$index];
                        } else {
                            $paramReflect   = new \ReflectionParameter('_empty_parameter_ghost', 'param');
                        }
                        if (!empty($cls_name)) {
                            $this->arguments[$index] = new ReflectionParameterValue(
                                array($cls_name, $fct_name), $paramReflect->getName(), $value
                            );
                        } else {
                            $this->arguments[$index] = new ReflectionParameterValue(
                                $fct_name, $paramReflect->getName(), $value
                            );
                        }
                    }
                }
            }
            return $this->arguments;
        }

        /**
         * Representation of the object
         *
         * If an exception is caught, its message is returned instead of the
         * original result (but it is not thrown ahead).
         *
         * @return string
         */
        public function __toString()
        {
            try {
                $str = 'at ' . $this->getCalled();

                $args = $this->getArguments();
                if (!empty($args)) {
                    $str .= ' (';
                    foreach ($args as $i => $arg) {
                        $str .= $arg->__toString();
                        if ($i < count($args) - 1) {
                            $str .= ' , ';
                        }
                    }
                    $str .= ' )';
                } else {
                    $str .= ' ()';
                }

                $file = $this->getFile();
                $line = $this->getLine();
                if (!empty($file)) {
                    $str .= PHP_EOL . '  called in file ' . $file;
                    if (!empty($line)) {
                        $str .= ' at line ' . $line;
                    }
                }

                return $str;
            } catch (\Exception $e) {
                return $e->__toString();
            }
        }

    }

}
// Endfile