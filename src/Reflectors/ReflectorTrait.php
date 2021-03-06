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
 * Basic implementation of the `\Reflector::export()` method
 *
 * This trait defines a global `export()` method for objects
 * that implement the [`\Reflector` interface](http://php.net/Reflector).
 * The method will basically try to call current class constructor passing it
 * the first argument received and then returns or echoes its representation.
 *
 * @author  piwi <me@e-piwi.fr>
 */
trait ReflectorTrait
{

    /**
     * Creation of a new instance of the mother class on-the-fly
     *
     * Keep in mind that this method only consider the FIRST argument passed
     * to transmit to the constructor. If your mother class requires more than
     * one argument, you will have to over-write this method (or to not use the
     * trait).
     *
     * @param   mixed   $argument
     * @param   bool    $return
     *
     * @return  string|null
     *
     * @throws  \ErrorException if the mother class does not implement the `\Reflector` interface
     * @throws  \ErrorException if the mother class constructor is not callable
     */
    public static function export($argument, $return = false)
    {
        $_class     = get_called_class();
        $reflection = new \ReflectionClass($_class);
        if (!in_array('Reflector', $reflection->getInterfaceNames())) {
            throw new \ErrorException(
                sprintf(__METHOD__.' must be used by class implementing the "\Reflector" interface, "%s" given', $_class)
            );
        }
        if (!method_exists($_class, '__construct') || !$reflection->isInstantiable()) {
            throw new \ErrorException(
                sprintf(__METHOD__.' must be used by class with a callable constructor, "%s" given', $_class)
            );
        } else {
            $obj = $reflection->newInstance($argument);
        }
        if ($return) {
            return $obj->__toString();
        } else {
            echo $obj;
            return null;
        }
    }
}
