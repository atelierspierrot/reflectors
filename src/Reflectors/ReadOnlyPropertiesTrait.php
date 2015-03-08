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
 * This trait defines magic getters and setters for read-only object's properties
 *
 * The read-only properties list MUST be declared via the `setReadOnlyProperties()` method
 * of this class (see the documentation of the method for more information).
 * Keep in mind that the magic methods defined here will ONLY consider read-only
 * properties (other properties must be handled by the child class).
 */
trait ReadOnlyPropertiesTrait
{

    private $_read_only_props = array();

    /**
     * Defines the read-only properties names and accessors.
     *
     * Each `key => value` pair of the `$data` array must be constructed like:
     *
     * -    `key` is the name of the property (MUST be defined with *protected*
     *      access in the child class)
     * -    `value` is an accessor for that property: the name of the access method
     *      if it exists or `true` for the default `$obj->$key` accessor.
     *
     * @param   array  $data This is the table of read-only properties
     * @return  void
     * @throws  \InvalidArgumentException if the `$data` array is malformed
     */
    public function setReadOnlyProperties(array $data)
    {
        foreach ($data as $var=>$val) {
            if (!property_exists(get_called_class(), $var)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        __METHOD__ .' expects parameter one to be a valid array with read-only properties names as keys in class "%s"',
                        get_called_class()
                    )
                );
            }
            if ($val!==true && (is_string($val) && !method_exists(get_called_class(), $val))) {
                throw new \InvalidArgumentException(
                    sprintf(
                        __METHOD__ .' expects parameter one to be a valid array with read-only properties accessors as values in class "%s"',
                        get_called_class()
                    )
                );
            }
        }
        $this->_read_only_props = $data;
    }

    /**
     * Magic getter for read-only properties.
     *
     * This will trigger a notice if the property can not be accessed.
     *
     * @param   string  $name
     * @return  mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_read_only_props)) {
            if (is_string($this->_read_only_props[$name]) && is_callable(array(get_called_class(), $this->_read_only_props[$name]))) {
                return call_user_func(array($this, $this->_read_only_props[$name]));
            } else {
                return $this->{$name};
            }
        }
        if (!property_exists($this, $name)) {
            trigger_error(
                sprintf('Undefined property: %s::$%s', get_called_class(), $name), E_USER_NOTICE
            );
        }
    }

    /**
     * Magic setter to avoid setting read-only properties.
     *
     * @param   string  $name
     * @param   mixed   $value
     * @return  void
     * @throws  \ReflectionException if trying to set a read-only property
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->_read_only_props)) {
            throw new \ReflectionException(
                sprintf('Cannot set read-only property %s::$%s', get_called_class(), $name)
            );
        }
    }

    /**
     * Magic un-setter to avoid un-setting read-only properties.
     *
     * @param   string  $name
     * @return  void
     * @throws  \ReflectionException if trying to unset a read-only property
     */
    public function __unset($name)
    {
        if (array_key_exists($name, $this->_read_only_props)) {
            throw new \ReflectionException(
                sprintf('Cannot unset read-only property %s::$%s', get_called_class(), $name)
            );
        }
    }

}

// Endfile