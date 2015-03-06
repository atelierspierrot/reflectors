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
 * Class ReflectionArray
 */
class ReflectionArray
    extends AbstractReflectionValue
{

    protected $length;

    /**
     * @param   array   $value
     * @throws  \ReflectionException if the parameter is not an array
     */
    public function __construct($value)
    {
        if (!is_array($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be array, %s given', gettype($value))
            );
        }
        $this->type     = 'array';
        $this->value    = $value;
        $this->length   = count($value);
    }

    /**
     * Returns the full array itself
     *
     * @return  array
     */
    public function getArray()
    {
        return $this->value;
    }

    /**
     * Returns the keys of the array
     *
     * @return  array
     */
    public function getKeys()
    {
        return array_keys($this->value);
    }

    /**
     * Returns the values of the array
     *
     * @return  array
     */
    public function getValues()
    {
        return array_values($this->value);
    }

    /**
     * Returns the length of the array
     *
     * @return  int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Test if a key exists in the array
     *
     * @param   string|int  $index
     * @return  bool
     */
    public function hasKey($index)
    {
        return array_key_exists($index, $this->getValue());
    }

    /**
     * Get a specific item of the array
     *
     * @param   string|int  $index
     * @return  mixed
     */
    public function getItem($index)
    {
        $table = $this->getArray();
        return $this->hasKey($index) ? $table[$index] : null;
    }

    /**
     * Representation of the object
     *
     * If an exception is caught, its message is returned instead of the
     * original result (but its not thrown ahead).
     *
     * @return string
     */
    public function __toString()
    {
        try {
            $table      = '';
            $counter    = 0;
            foreach ($this->getArray() as $index=>$item) {
                $table .= PHP_EOL.'    Item #'.$counter.' [ <'.gettype($index).'> '.$index.' ] => ';
                if (in_array(gettype($item), array('object', 'array', 'resource', 'unknown type'))) {
                    $table .= PHP_EOL;
                }
                $table .= ReflectionVariable::export($item, true);
                $counter++;
            }
            $table .= PHP_EOL;

            return 'Array of length '.$this->getLength().' ( '.$table.' )';
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile