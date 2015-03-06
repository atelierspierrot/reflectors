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
 * Class ReflectionInteger
 */
class ReflectionInteger
    extends AbstractReflectionValue
{

    /**
     * @param   int $value
     * @throws  \ReflectionException if the parameter is not an integer
     */
    public function __construct($value)
    {
        if (!is_numeric($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be integer, %s given', gettype($value))
            );
        }
        $this->type     = 'integer';
        $this->value    = (int) $value;
    }

    /**
     * Representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return 'Integer [ '.$this->getValue().' ]';
    }

}

// Endfile