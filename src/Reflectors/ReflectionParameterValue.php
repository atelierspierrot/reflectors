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
 * An extension of the internal `\ReflectionParameter` with a value
 */
class ReflectionParameterValue
    extends \ReflectionParameter
    implements \Reflector, ReflectionValueInterface
{

    protected $value;
    protected $type;

    /**
     * @param   string  $function   this is the first argument of the original `\ReflectionParameter::__construct()`
     * @param   string  $parameter  this is the second argument of the original `\ReflectionParameter::__construct()`
     * @param   mixed   $value      the user value of the parameter
     * @throws  \Exception caught from parent constructor
     */
    public function __construct($function, $parameter, $value)
    {
        try {
            parent::__construct($function, $parameter);
        } catch (\Exception $e) {
            throw $e;
        }
        $this->value        = $value;
        $this->type         = gettype($value);
    }

    /**
     * Returns the value of the parameter
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the type of the parameter
     *
     * @return string
     */
    public function getValueType()
    {
        return $this->type;
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
            return parent::__toString().' with user value { '.ReflectionValue::export($this->value, true).' }';
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile