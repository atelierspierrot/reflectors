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

namespace Reflectors\Value;

use \Reflectors\ValueType;
use \Reflectors\AbstractReflectionValueProxy;
use \Reflectors\ReflectionCallback as GenericReflectionCallback;

/**
 * The [callback](http://php.net/callable) value reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionCallback
    extends AbstractReflectionValueProxy
{

    /**
     * @var string The proxy will be an instance of `\Reflectors\ReflectionCallback`
     */
    protected static $proxy_class = 'Reflectors\ReflectionCallback';

    protected static $_read_only = array(
        'callback'      => 'getCallback',
        'callback_type' => 'getCallbackType',
        'reflector'     => 'getReflector',
        'value'         => 'getValue',
        'type'          => 'getValueType',
    );

    /**
     * @var callable   The reflected callback. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $callback;

    /**
     * @var int     The callback type. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $callback_type;

    /**
     * @var \Reflector     The callback reflection object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $reflector;

    /**
     * @param   callable   $value
     * @param   int         $flag   A flag used by the `ValueType::getType()` method (not used here)
     * @throws  \ReflectionException if the parameter is not a closure
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        if (!ValueType::isCallable($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be callable, %s given', gettype($value))
            );
        }
        parent::__construct($value, $flag);
        $this->value_type       = ValueType::TYPE_CALLBACK;
        $this->callback         = $this->value;
        $this->callback_type    = ValueType::getCallbackType($this->callback);
    }

    /**
     * Returns the callable value (ready to be called).
     *
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Returns a reflector object for the callable
     *
     * @return ReflectionCallback
     */
    public function getReflector()
    {
        if (empty($this->reflector)) {
            $this->reflector = new GenericReflectionCallback($this->getCallback());
        }
        return $this->reflector;
    }

    /**
     * Returns the type of the value
     *
     * @return string
     */
    public function getCallbackType()
    {
        return $this->callback_type;
    }

    /**
     * Invokes the callback with a list of parameters
     *
     * @return mixed
     */
    public function invoke()
    {
        return $this->getReflector()->invokeArgs(func_get_args());
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
            return $this->getProxy()->__toString();
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }
}
