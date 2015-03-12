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
 * This is the global variable value reflector object. It acts like a reflection proxy.
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionValue
    implements ReflectionValueInterface
{

    use ReflectorTrait, ReadOnlyPropertiesTrait;

    /**
     * @var \Reflector   The "real" value reflection object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $reflector;

    protected $flag;
    protected $order;

    protected static $_read_only = array(
        'reflector'    => 'getReflector'
    );

    /**
     * @param   mixed   $value
     * @param   int     $flag
     * @param   array   $order
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT, array $order = null)
    {
        $this->setReadOnlyProperties($this::$_read_only);
        $this->flag         = $flag;
        $this->order        = $order;
        $this->reflector    = ValueType::getReflector($value, $flag, $order);
    }

    /**
     * Returns the variable reflector
     *
     * @return  mixed
     */
    public function getReflector()
    {
        return $this->reflector;
    }

    /**
     * Returns the variable's value from the reflector
     *
     * @return  mixed
     */
    public function getValue()
    {
        return $this->getReflector()->getValue();
    }

    /**
     * Returns the variable's type from the reflector
     *
     * @return  string
     */
    public function getValueType()
    {
        return $this->getReflector()->getValueType();
    }

    /**
     * Tests if the variable is NULL
     *
     * @return bool
     */
    public function isNull()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_NULL);
    }

    /**
     * Tests if the variable is a boolean
     *
     * @return bool
     */
    public function isBoolean()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_BOOLEAN);
    }

    /**
     * Tests if the variable is an integer
     *
     * @return bool
     */
    public function isInteger()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_INTEGER);
    }

    /**
     * Tests if the variable is a float
     *
     * @return bool
     */
    public function isFloat()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_FLOAT);
    }

    /**
     * Tests if the variable is a string
     *
     * @return bool
     */
    public function isString()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_STRING);
    }

    /**
     * Tests if the variable is an array
     *
     * @return bool
     */
    public function isArray()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_ARRAY);
    }

    /**
     * Tests if the variable is an object
     *
     * @return bool
     */
    public function isObject()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_OBJECT);
    }

    /**
     * Tests if the variable is a resource
     *
     * @return bool
     */
    public function isResource()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_RESOURCE);
    }

    /**
     * Tests if the variable is a callback
     *
     * @return bool
     */
    public function isCallback()
    {
        return (bool) ($this->getValueType()===ValueType::TYPE_CALLBACK);
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
            $str = $this->getReflector()->__toString();
            return $str;
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile