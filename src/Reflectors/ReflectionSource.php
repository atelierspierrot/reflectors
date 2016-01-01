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
 * The source reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionSource
    implements \Reflector
{

    use ReflectorTrait, ReadOnlyPropertiesTrait;

    /**
     * @var array   The default source context. It only defines the default number of lines to show around the highlighted one (if so).
     */
    public static $default_context = array(
        'unified'       => 3,
        'highlighting'  => array(
            'highlight.string'  => '#DD0000',
            'highlight.comment' => '#FF9900',
            'highlight.keyword' => '#007700',
            'highlight.default' => '#0000BB',
            'highlight.html'    => '#000000'
        )
    );

    /**
     * @var string   The source file path. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $file_path;

    /**
     * @var int   The source line number. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $lineno;

    /**
     * @var array   The context. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $context;

    /**
     * @var array   The sources. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $source;

    protected $file_source;
    protected static $_read_only = array(
        'file_path' => 'getFilePath',
        'lineno'    => 'getLineNo',
        'context'   => 'getContext',
        'source'    => 'getSource',
    );

    /**
     * @param   string  $file_path  The file path, which MUST exist
     * @param   null    $lineno     An optional line of the file to work around
     * @param   array   $context    A table with optional context info:
     *                                  - 'unified' is the number of lines taken around concerned one (default is 3)
     *                                  - 'highlighting' is the table of highlight settings colors
     *                                     (from php.ini: <http://php.net/manual/misc.configuration.php#ini.syntax-highlighting>)
     *                                  - 'function' can be concerned function name, to increase unified if necessary
     *
     * @throws \ReflectionException if the `$file_path` parameter is not a string
     * @throws \ReflectionException if the file does not exist
     */
    public function __construct($file_path, $lineno = null, array $context = null)
    {
        $this->setReadOnlyProperties($this::$_read_only);
        if (!is_string($file_path)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be string, %s given', gettype($file_path))
            );
        }
        if (!file_exists($file_path)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be a valid file path, %s given: No such file or directory', $file_path)
            );
        }
        $this->file_path    = $file_path;
        $this->lineno       = $lineno;
        $this->context      = self::$default_context;
        if (!empty($context)) {
            $this->context  = array_merge($this->context, $context);
        }
    }

    /**
     * Returns the path of concerned file
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->file_path;
    }

    /**
     * Returns the concerned line number (if defined)
     *
     * @return int|null
     */
    public function getLineNo()
    {
        return $this->lineno;
    }

    /**
     * Returns the context or one of its items
     *
     * @param   null    $item
     * @return  array|mixed
     */
    public function getContext($item = null)
    {
        if (is_null($item)) {
            return $this->context;
        } else {
            return array_key_exists($item, $this->context) ? $this->context[$item] : null;
        }
    }

    /**
     * Get the source code of the file in a line-by-line array
     *
     * The keys of the items are the line numbers, and a special `on` key
     * is used if a `line` exists in the trace: `on => line number`.
     *
     * @return mixed
     */
    public function getSource()
    {
        if (empty($this->source)) {
            $lines      = $this->_getFileSource();
            $lineno     = $this->getLineNo();
            $unified    = $this->getContext('unified');
            $fct        = $this->getContext('function');

            if (!empty($lineno)) {
                $start  = $lineno < $unified ? 0 : $lineno - $unified;
                $end    = $lineno + $unified;
            } else {
                $start  = 0;
                $end    = count($lines);
            }

            foreach ($lines as $k=>$_line) {
                if ($k>$end) {
                    break;
                }
                if (
                    $k<$start && !empty($fct) &&
                    preg_match('/function( )*'.preg_quote($fct).'[ |\(]/', $_line)
                ) {
                    $start = $k;
                }
            }

            for ($i=$start; $i<=$end; $i++) {
                $this->source[$i] = $lines[$i - 1];
            }
            if (!empty($lineno) && isset($this->source[$lineno])) {
                $this->source['on'] = $lineno;
            }
        }
        return $this->source;
    }

    /**
     * Renders the source as plain text
     *
     * @param   bool    $return Return the result or not
     * @param   bool    $info   Add the introduction information or not
     * @return  string
     */
    public function render($return = false, $info = false)
    {
        if ($info) {
            $output = $this->_renderInfo().PHP_EOL.$this->_renderSource();
        } else {
            $output = $this->_renderSource();
        }
        if ($return) {
            return $output;
        } else {
            echo $output;
        }
    }

    /**
     * Renders the source highlighted in HTML
     *
     * @param   bool    $return Return the result or not
     * @param   bool    $info   Add the introduction information or not
     * @return  string
     */
    public function renderHighlight($return = false, $info = false)
    {
        $directives = $this->getContext('highlighting');
        $old_values = array();
        foreach ($directives as $name=>$default) {
            $user = ini_get($name);
            if (empty($user)) {
                ini_set($name, $default);
                $old_values[] = $name;
            }
        }

        $raw_source     = $this->_renderSource();
        if (!strpos('<?php', $raw_source)) {
            $raw_source = '<?php'.PHP_EOL.$raw_source;
        }
        $source         = preg_replace('/&lt;\?php\<br \/\>/', '', highlight_string($raw_source, true), 1);
        if ($info) {
            $intro      = nl2br($this->_renderInfo());
            $output     = <<<MESSAGE
<figure>
    <figcaption>{$intro}</figcaption>
    <pre>{$source}</pre>
</figure>
MESSAGE;
        } else {
            $output     = "<pre>{$source}</pre>";
        }

        foreach ($old_values as $name) {
            ini_restore($name);
        }

        if ($return) {
            return $output;
        } else {
            echo $output;
        }
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
            return $this->render(true, true);
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

    /*
     * Gets the file content line by line
     */
    protected function _getFileSource()
    {
        if (empty($this->file_source)) {
            $this->file_source = file($this->getFilePath(), FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES);
        }
        return $this->file_source;
    }

    /*
     * Renders the information string about the source (file name and concerned lines)
     */
    protected function _renderInfo()
    {
        $lines  = $this->getSource();
        if (array_key_exists('on', $lines)) {
            unset($lines['on']);
        }

        $info = 'Source from file [ '.$this->getFilePath().' ] ';
        $line = $this->getLineNo();
        if (!empty($line)) {
            $info .= 'at line [ '.$line.' ] ';
        }

        $info .= PHP_EOL.'@@ '.$this->getFilePath().' '.min(array_keys($lines)).' - '.max(array_keys($lines));
        return $info;
    }

    /*
     * Renders the source line by line by an asterisk on the highlighted one (if so)
     */
    protected function _renderSource()
    {
        $str    = '';
        $lines  = $this->getSource();
        foreach ($lines as $i=>$line) {
            if (!is_string($i)) {
                if (array_key_exists('on', $lines) && $lines['on']==$i) {
                    $str .= '* '.$line.PHP_EOL;
                } else {
                    $str .= '  '.$line.PHP_EOL;
                }
            }
        }
        return $str;
    }
}
