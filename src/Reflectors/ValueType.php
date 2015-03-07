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
 * This only defines possible value types as constants and validators static methods.
 *
 * The internal PHP types returned by the [`gettype()` function](http://php.net/gettype) are:
 *
 * -    [null](http://php.net/null)
 * -    [boolean](http://php.net/boolean)
 * -    [integer](http://php.net/integer)
 * -    [float](http://php.net/float) (double included)
 * -    [string](http://php.net/string)
 * -    [array](http://php.net/array)
 * -    [object](http://php.net/object)
 * -    [resource](http://php.net/resource)
 * -    unknown, when no other type was possible (very rare)
 *
 * The class extends this list with a new type:
 *
 * -    [callback](http://php.net/callable), defined as any variable passing
 *      the [`is_callable()` function](http://php.net/is_callable)
 *
 * When the `getType()` method of this class tests each type one by one to find
 * the type of the parameter, you can use some specific flags have a flexible
 * behavior (see the documented constants of this class).
 *
 * Various types of callbacks are defined to identify the "callable" type:
 *
 * -    function
 * -    closure
 * -    method of instantiated object
 * -    static method of a class
 * -    object
 */
class ValueType
{

    /**
     * Defines the [null](http://php.net/null) type
     */
    const TYPE_NULL             = 'null';

    /**
     * Defines the [boolean](http://php.net/boolean) type
     */
    const TYPE_BOOLEAN          = 'boolean';

    /**
     * Defines the [integer](http://php.net/integer) type
     */
    const TYPE_INTEGER          = 'integer';

    /**
     * Defines the [float](http://php.net/float) (double included) type
     */
    const TYPE_FLOAT            = 'float';

    /**
     * Defines the [string](http://php.net/string) type
     */
    const TYPE_STRING           = 'string';

    /**
     * Defines the [array](http://php.net/array) type
     */
    const TYPE_ARRAY            = 'array';

    /**
     * Defines the [object](http://php.net/object) type
     */
    const TYPE_OBJECT           = 'object';

    /**
     * Defines the [callback](http://php.net/callable) type
     */
    const TYPE_CALLBACK         = 'callback';

    /**
     * Defines the [resource](http://php.net/resource) type
     */
    const TYPE_RESOURCE         = 'resource';

    /**
     * Defines the unknown type, when no other type was possible (very rare)
     */
    const TYPE_UNKNOWN          = 'unknown';

    /**
     * Defines a *function* callback: `$callback = 'functionName'`
     */
    const CALLBACK_FUNCTION         = 1;

    /**
     * Defines a *closure* callback (anonymous function): `$callback = function () use () {};`
     */
    const CALLBACK_CLOSURE          = 2;

    /**
     * Defines a *class' method* callback: `$callback = array('className', 'methodName')`
     */
    const CALLBACK_METHOD           = 4;

    /**
     * Defines a *class' static method* callback: `$callback = 'className::methodName'`
     */
    const CALLBACK_METHOD_STATIC    = 8;

    /**
     * Defines a *object* callback: `$callback = array($object, 'methodName')`
     */
    const CALLBACK_OBJECT           = 16;

    /**
     * Defines the default behavior of internal PHP (this is the default value of the `$flag` parameter of class' methods)
     */
    const MODE_STRICT           = 1;

    /**
     * Defines the binary numbers `0` and `1` (and their decimal, hexadecimal, octal and binary equivalents) as booleans rather than integers
     */
    const BINARY_AS_BOOLEAN     = 2;

    /**
     * Defines a callable array as a callable rather than an array
     */
    const ARRAY_AS_CALLABLE     = 4;

    /**
     * Defines a callable string as a callable rather than a string
     */
    const STRING_AS_CALLABLE    = 8;

    /**
     * Defines a `\Closure` object as a closure rather than an object
     */
    const OBJECT_AS_CLOSURE     = 16;

    /**
     * Defines any numeric value as an integer
     */
    const NUMERIC_AS_INTEGER    = 32;

    /**
     * Defines any numeric value as a string
     */
    const NUMERIC_AS_STRING     = 64;

    /**
     * @var array   The default type tests order
     */
    public static $ordered_types = array(
        0 => self::TYPE_NULL,
        1 => self::TYPE_BOOLEAN,
        2 => self::TYPE_INTEGER,
        3 => self::TYPE_FLOAT,
        4 => self::TYPE_CALLBACK,
        5 => self::TYPE_STRING,
        6 => self::TYPE_ARRAY,
        7 => self::TYPE_OBJECT,
        8 => self::TYPE_RESOURCE,
    );

    /**
     * Returns a value type by testing it in the `$order` order.
     *
     * The tests order defaults to the `$ordered_types` static of the class.
     *
     * You can use some of the class' flags to have a flexible testing.
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @param   array   $order
     * @return  string
     * @throws  \InvalidArgumentException if an item of the `$order` array does not seem to be a valid type
     */
    public static function getType($value, $flag = self::MODE_STRICT, array $order = null)
    {
        if (is_null($order)) {
            $order = self::$ordered_types;
        }
        ksort($order);
        foreach ($order as $test) {
            $test_method = 'is'.ucfirst(strtolower($test));
            if (method_exists(__CLASS__, $test_method)) {
                if (true===call_user_func(array(__CLASS__, $test_method), $value, $flag)) {
                    return $test;
                }
            } else {
                throw new \InvalidArgumentException(
                    sprintf(__METHOD__.' expects parameter 3 to be an array of valid value types, "%s" given', $test)
                );
            }
        }
        return self::TYPE_UNKNOWN;
    }

    /**
     * Returns a reflector for the value by testing its type in the `$order` order.
     *
     * See the documentation of the `getType()` method for more information about parameters.
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @param   array   $order
     * @return  ReflectionValueInterface
     */
    public static function getReflector($value, $flag = self::MODE_STRICT, array $order = null)
    {
        $type       = self::getType($value, $flag, $order);
        $reflector  = new Value\ReflectionUnknown($value);
        switch ($type) {
            case self::TYPE_NULL:       $reflector = new Value\ReflectionNull($value, $flag); break;
            case self::TYPE_BOOLEAN:    $reflector = new Value\ReflectionBoolean($value, $flag); break;
            case self::TYPE_INTEGER:    $reflector = new Value\ReflectionInteger($value, $flag); break;
            case self::TYPE_FLOAT:      $reflector = new Value\ReflectionFloat($value, $flag); break;
            case self::TYPE_STRING:     $reflector = new Value\ReflectionString($value, $flag); break;
            case self::TYPE_ARRAY:      $reflector = new Value\ReflectionArray($value, $flag); break;
            case self::TYPE_OBJECT:     $reflector = new Value\ReflectionObject($value, $flag); break;
            case self::TYPE_RESOURCE:   $reflector = new Value\ReflectionResource($value, $flag); break;
            case self::TYPE_CALLBACK:   $reflector = new Value\ReflectionCallback($value, $flag); break;
        }
        return $reflector;
    }

    /**
     * Returns the type of a callback
     *
     * @param   callable $callback
     * @return  int|null
     */
    public static function getCallbackType(callable $callback)
    {
        if (is_object($callback) && ($callback instanceof \Closure)) {
            return self::CALLBACK_CLOSURE;
        } else {

            if (is_string($callback)) {
                $parts = explode('::', $callback);
            } elseif (is_array($callback)) {
                $parts = $callback;
            } else {
                $parts = array($callback);
            }

            if (count($parts) === 1) {
/*
// this is not good right ?
                if (is_object($parts[0])) {
                    return self::CALLBACK_OBJECT;
                } else {
*/
                    return self::CALLBACK_FUNCTION;
//                }
            } elseif (count($parts) === 2) {
                if (is_object($parts[0])) {
                    return self::CALLBACK_METHOD;
                } else {
                    return self::CALLBACK_METHOD_STATIC;
                }
            }
        }
        return null;
    }

    /**
     * Tests if a value is null
     *
     * @param   mixed   $value
     * @return  bool
     */
    public static function isNull($value = null)
    {
        return (bool) is_null($value);
    }

    /**
     * Tests if a value is a boolean
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @return  bool
     */
    public static function isBoolean($value = null, $flag = self::MODE_STRICT)
    {
        if (($flag & self::BINARY_AS_BOOLEAN) && is_int($value) && ((int) $value===0 || (int) $value===1)) {
            return true;
        }
        return (bool) is_bool($value);
    }

    /**
     * Tests if a value is an integer
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @return  bool
     */
    public static function isInteger($value = null, $flag = self::MODE_STRICT)
    {
        if (($flag & self::NUMERIC_AS_INTEGER) && is_numeric($value)) {
            return true;
        }
        return (bool) is_int($value);
    }

    /**
     * Tests if a value is a float
     *
     * @param   mixed   $value
     * @return  bool
     */
    public static function isFloat($value = null)
    {
        return (bool) is_float($value);
    }

    /**
     * Tests if a value is a double (alias of `self::isFloat()`)
     *
     * @param   mixed   $value
     * @return  bool
     * @see     self::isFloat()
     */
    public static function isDouble($value = null)
    {
        return (bool) self::isFloat($value);
    }

    /**
     * Tests if a value is a "real number" (alias of `self::isFloat()`)
     *
     * @param   mixed   $value
     * @return  bool
     * @see     self::isFloat()
     */
    public static function isRealNumber($value = null)
    {
        return (bool) self::isFloat($value);
    }

    /**
     * Tests if a value is a string
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @return  bool
     */
    public static function isString($value = null, $flag = self::MODE_STRICT)
    {
        if (($flag & self::NUMERIC_AS_STRING) && is_numeric($value)) {
            return true;
        }
        if (($flag & self::STRING_AS_CALLABLE) && is_string($value) && self::isCallable($value)) {
            return false;
        }
        return (bool) is_string($value);
    }

    /**
     * Tests if a value is an array
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @return  bool
     */
    public static function isArray($value = null, $flag = self::MODE_STRICT)
    {
        if (($flag & self::ARRAY_AS_CALLABLE) && is_array($value) && self::isCallable($value)) {
            return false;
        }
        return (bool) is_array($value);
    }

    /**
     * Tests if a value is an object
     *
     * @param   mixed   $value
     * @param   int     $flag
     * @return  bool
     */
    public static function isObject($value = null, $flag = self::MODE_STRICT)
    {
        if (($flag & self::OBJECT_AS_CLOSURE) && is_object($value) && self::isClosure($value)) {
            return false;
        }
        return (bool) is_object($value);
    }

    /**
     * Tests if a value is a closure (alias of `self::isCallback()`)
     *
     * @param   mixed   $value
     * @return  bool
     * @see     self::isCallback()
     */
    public static function isClosure($value = null)
    {
        return (bool) self::isCallback($value);
    }

    /**
     * Tests if a value is callable (alias of `self::isCallback()`)
     *
     * @param   mixed   $value
     * @return  bool
     * @see     self::isCallback()
     */
    public static function isCallable($value = null)
    {
        return (bool) self::isCallback($value);
    }

    /**
     * Tests if a value is a valid callback
     *
     * @param   mixed   $value
     * @return  bool
     */
    public static function isCallback($value = null)
    {
        return (bool) is_callable($value);
    }

    /**
     * Tests if a value is a resource
     *
     * @param   mixed   $value
     * @return  bool
     */
    public static function isResource($value = null)
    {
        return (bool) is_resource($value);
    }

}

// Endfile