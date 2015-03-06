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
 * Interface ReflectionVariableInterface
 *
 * This interface is designed to build generic reflection objects
 * for variables with a `$value` and its type.
 *
 * @link    http://php.net/manual/function.gettype.php
 * @link    http://php.net/manual/class.reflector.php
 */
interface ReflectionVariableInterface
    extends \Reflector
{

    /**
     * Returns the current value of concerned variable
     * @return mixed
     */
    public function getValue();

    /**
     * Returns the type of the value of concerned variable
     *
     * The type returned MUST be one of the internal types returned
     * by the `gettype()` function:
     *
     *      null , boolean , integer , float (double included) , string , array , object , resource , unknown
     *
     * @return  string
     * @link    http://php.net/manual/function.gettype.php
     */
    public function getValueType();

}

// Endfile