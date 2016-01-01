<?php
/**
 * This file is part of the Reflectors package.
 *
 * Copyright (c) 2015-2016 Pierre Cassat <me@e-piwi.fr> and contributors
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
 * The callback global reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionCallback
    implements \Reflector
{

    use ReflectorTrait, ReadOnlyPropertiesTrait;

    /**
     * @var callable   The original callback value. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $callback;

    /**
     * @var \Reflector   The reflection of the callback. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $reflector;

    /**
     * @var int   The callback type. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $type;

    protected $function_name;
    protected $class_name;

    protected static $_read_only = array(
        'callback'  => 'getCallback',
        'reflector' => 'getReflector',
        'type'      => 'getType',
    );

    /**
     * @param   callable   $value
     * @throws  \ReflectionException if the parameter is not a closure
     */
    public function __construct($value)
    {
        if (!ValueType::isCallable($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be callable, %s given', gettype($value))
            );
        }
        $this->setReadOnlyProperties($this::$_read_only);
        $this->callback = $value;
        $this->type     = ValueType::getCallbackType($value);
        $this->_populate();
    }

    /**
     * Returns the original callback content
     *
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Returns the callback type
     *
     * @return int
     */
    public function getCallbackType()
    {
        return $this->type;
    }

    /**
     * Returns the callback type (alias of `self::getCallbackType()`)
     *
     * @return  int
     * @see     self::getCallbackType()
     */
    public function getType()
    {
        return $this->getCallbackType();
    }

    /**
     * Returns the reflector of the callback
     *
     * @return  \Reflector
     */
    public function getReflector()
    {
        if (empty($this->reflector)) {
            if ($this->isFunction() || $this->isClosure()) {
                $this->reflector = new \ReflectionFunction($this->getFunctionName());
            } elseif ($this->isMethod() || $this->isMethodStatic()) {
                $this->reflector = new \ReflectionMethod($this->getClassName(), $this->getFunctionName());
            } elseif ($this->isObject()) {
                $this->reflector = new \ReflectionObject($this->getCallback());
            }
        }
        return $this->reflector;
    }

    /**
     * Returns the function or method name if defined
     *
     * @return null|string
     */
    public function getFunctionName()
    {
        return $this->function_name;
    }

    /**
     * Returns the class or object class name if defined
     *
     * @return null|string
     */
    public function getClassName()
    {
        return $this->class_name;
    }

    /**
     * Invokes the callback with a list of parameters
     *
     * @return mixed
     */
    public function invoke()
    {
        return $this->invokeArgs(func_get_args());
    }

    /**
     * Invokes the callback with a list of parameters as an array
     *
     * @param   array   $args
     * @return  mixed
     */
    public function invokeArgs(array $args)
    {
        return $this->getReflector()->invokeArgs($args);
    }

    /**
     * Tests if the callback is a function
     *
     * @return bool
     */
    public function isFunction()
    {
        return (bool) ($this->getCallbackType()===ValueType::CALLBACK_FUNCTION);
    }

    /**
     * Tests if the callback is a closure
     *
     * @return bool
     */
    public function isClosure()
    {
        return (bool) ($this->getCallbackType()===ValueType::CALLBACK_CLOSURE);
    }

    /**
     * Tests if the callback is a class' method
     *
     * @return bool
     */
    public function isMethod()
    {
        return (bool) ($this->getCallbackType()===ValueType::CALLBACK_METHOD);
    }

    /**
     * Tests if the callback is a static class' method
     *
     * @return bool
     */
    public function isMethodStatic()
    {
        return (bool) ($this->getCallbackType()===ValueType::CALLBACK_METHOD_STATIC);
    }

    /**
     * Tests if the callback is a static class' method
     *
     * @return bool
     */
    public function isObject()
    {
        return (bool) ($this->getCallbackType()===ValueType::CALLBACK_OBJECT);
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
            return $this->getReflector()->__toString();
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

    /*
     * Populates the function and class names
     */
    protected function _populate()
    {
        $callback = $this->getCallback();
        if ($this->isClosure()) {
            $this->function_name = $callback;
        } else {
            if (is_string($callback)) {
                $parts = explode('::', $callback);
            } elseif (is_array($callback)) {
                $parts = $callback;
            } else {
                $parts = array($callback);
            }

            if (count($parts) === 1) {
                if (!is_object($parts[0])) {
                    $this->function_name = $parts[0];
                }
            } elseif (count($parts) === 2) {
                if (is_object($parts[0])) {
                    $this->class_name = get_class($parts[0]);
                } else {
                    $this->class_name = $parts[0];
                }
                $this->function_name = $parts[1];
            }
        }
    }
}
