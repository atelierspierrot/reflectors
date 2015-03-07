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
 * Use this class to define a `ReflectionValue...` object that depends on another one.
 */
abstract class AbstractReflectionValueProxy
    extends AbstractReflectionValue
{

    /**
     * @var string Define there the reflection class to use.
     */
    protected static $proxy_class = null;

    protected $proxy;

    /**
     * Constructor. You MUST call this one to prepare proxy.
     *
     * @param   object  $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method
     * @throws  \ErrorException if the `$proxy_class` does not exist or is not instantiable
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        parent::__construct($value);
        if (!empty($this::$proxy_class)) {
            if (class_exists($this::$proxy_class)) {
                $reflection = new \ReflectionClass($this::$proxy_class);
                if (method_exists($this::$proxy_class, '__construct') || $reflection->isInstantiable()) {
                    $this->proxy = $reflection->newInstance($value);
                } else {
                    throw new \ErrorException(
                        sprintf('%s::$proxy_class is expected to be an instantiable class, "%s" given',
                            get_called_class(), $this::$proxy_class)
                    );
                }
            } else {
                throw new \ErrorException(
                    sprintf('%s::$proxy_class is expected to be a valid class name, "%s" given',
                        get_called_class(), $this::$proxy_class)
                );
            }
        }
    }

    /**
     * This will transmit a method's call to the proxy if it exists
     *
     * @param   string  $name
     * @param   array   $arguments
     * @return  mixed
     */
    public function __call($name, array $arguments)
    {
        if (
            (
                !method_exists($this, $name) ||
                (method_exists($this, $name) && !is_callable(array($this, $name)))
            ) &&
            method_exists($this->getProxy(), $name) &&
            is_callable(array($this->getProxy(), $name))
        ) {
            return call_user_func_array(array($this->getProxy(), $name), $arguments);
        }
        user_error(
            sprintf('Call to undefined or inaccessible method %s::%s()', get_called_class(), $name),
            E_USER_ERROR
        );
    }

    /**
     * Returns the reflector proxy
     *
     * @return object
     */
    protected function getProxy()
    {
        return $this->proxy;
    }

}

// Endfile