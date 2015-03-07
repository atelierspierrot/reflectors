
/*
 * jQuery Highlight Plugin - modified
 * Examples and documentation at: http://demo.webcodingstudio.com/highlight/
 * Copyright (c) 2010 E. Matsakov
 * Version: 1.0 (26-FEB-2010)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.2.6 or later
 */
!function(e){function r(e){return"("+e.replace(/ /g,"|")+")([^a-z0-9$_])"}function a(e){e=e.split("\n");for(var r=0;r<e.length;r++)e[r]='<span class="com">'+e[r]+"</span>";return e.join("\n")}function t(e,r){return e.push(r),e.length-1}e.fn.highlight=function(r){var a={source:!0,zebra:!0,indent:"tabs",list:"ol",code_lang:"lang"},t=e.extend({},a,r);return this.each(function(){var r=e(this),a=e(r).attr("class"),s=e(r).attr(t.code_lang),i="";""!=s&&(i=" "+s),e(r).wrap('<div class="highlight'+i+'"></div>');var l=e(r).parent(),n=r.html();n=n.replace(/</gm,"&lt;"),"space"==t.indent&&(n=n.replace(/\t/g,"    "));var o=n;switch(s){case"html":o=e.highlightCode.hightlight_html(o);break;case"css":o=e.highlightCode.hightlight_css(o);break;case"php":o=e.highlightCode.hightlight_php(o);break;default:o=e.highlightCode.hightlight(o)}if(o=o.replace(/(?:\r\n?|\n)$/,""),o="<"+t.list+"><li>"+o.split(/\r\n|\n/).join("\n</li><li>")+"\n</li></"+t.list+">",1==t.source){n='<pre class="source">'+n+"</pre>";var c='<ul class="tabs"><li class="code active">code</li><li class="source">source</li></ul>';e(r).after(n),e(r).before(c)}if(1==t.source){var c=e(l).find("ul.tabs li");e.each(c,function(r,a){e(a).click(function(){e(c).removeClass("active");var r=e(a).attr("class");e(l).find('pre[class!="'+r+'"]').css("display","none"),e(l).find('pre[class^="'+r+'"]').css("display","block"),e(a).addClass("active")})})}e(r).replaceWith('<pre class="'+a+'">'+o+"</pre>"),1==t.zebra&&e(l).find('pre[class="'+a+'"] '+t.list+" li:even").addClass("even")})},e.highlightCode={hightlight:function(e){var r=[];return e=e.replace(/(var|function|typeof|new|return|if|for|in|while|break|do|continue|case|switch)([^a-z0-9\$_])/gi,'<span class="kwd">$1</span>$2').replace(/(\{|\}|\]|\[|\|)/gi,'<span class="kwd">$1</span>').replace(/('.*?')/g,'<span class="str">$1</span>').replace(/\/\*([\s\S]*?)\*\//g,function(e){return"\x00C"+t(r,a(e))+"\x00"}).replace(/\0C(\d+)\0/g,function(e,a){return r[a]}).replace(/\/\/(.*$)/gm,'<span class="com">//$1</span>').replace(/([a-z\_\$][a-z0-9_]*)\(/gi,'<span class="fnc">$1</span>(')},hightlight_php:function(e){var s=[],i="abs acos acosh addcslashes addslashes array_change_key_case array_chunk array_combine array_count_values array_diff array_diff_assoc array_diff_key array_diff_uassoc array_diff_ukey array_fill array_filter array_flip array_intersect array_intersect_assoc array_intersect_key array_intersect_uassoc array_intersect_ukey array_key_exists array_keys array_map array_merge array_merge_recursive array_multisort array_pad array_pop array_product array_push array_rand array_reduce array_reverse array_search array_shift array_slice array_splice array_sum array_udiff array_udiff_assoc array_udiff_uassoc array_uintersect array_uintersect_assoc array_uintersect_uassoc array_unique array_unshift array_values array_walk array_walk_recursive atan atan2 atanh base64_decode base64_encode base_convert basename bcadd bccomp bcdiv bcmod bcmul bindec bindtextdomain bzclose bzcompress bzdecompress bzerrno bzerror bzerrstr bzflush bzopen bzread bzwrite ceil chdir checkdate checkdnsrr chgrp chmod chop chown chr chroot chunk_split class_exists closedir closelog copy cos cosh count count_chars date decbin dechex decoct deg2rad delete ebcdic2ascii echo empty end ereg ereg_replace eregi eregi_replace error_log error_reporting escapeshellarg escapeshellcmd eval exec exit exp explode extension_loaded feof fflush fgetc fgetcsv fgets fgetss file_exists file_get_contents file_put_contents fileatime filectime filegroup fileinode filemtime fileowner fileperms filesize filetype floatval flock floor flush fmod fnmatch fopen fpassthru fprintf fputcsv fputs fread fscanf fseek fsockopen fstat ftell ftok getallheaders getcwd getdate getenv gethostbyaddr gethostbyname gethostbynamel getimagesize getlastmod getmxrr getmygid getmyinode getmypid getmyuid getopt getprotobyname getprotobynumber getrandmax getrusage getservbyname getservbyport gettext gettimeofday gettype glob gmdate gmmktime in_array ini_alter ini_get ini_get_all ini_restore ini_set interface_exists intval ip2long is_a is_array is_bool is_callable is_dir is_double is_executable is_file is_finite is_float is_infinite is_int is_integer is_link is_long is_nan is_null is_numeric is_object is_readable is_real is_resource is_scalar is_soap_fault is_string is_subclass_of is_uploaded_file is_writable is_writeable mkdir mktime nl2br parse_ini_file parse_str parse_url passthru pathinfo readlink realpath rewind rewinddir rmdir round str_ireplace str_pad str_repeat str_replace str_rot13 str_shuffle str_split str_word_count strcasecmp strchr strcmp strcoll strcspn strftime strip_tags stripcslashes stripos stripslashes stristr strlen strnatcasecmp strnatcmp strncasecmp strncmp strpbrk strpos strptime strrchr strrev strripos strrpos strspn strstr strtok strtolower strtotime strtoupper strtr strval substr substr_compare",l="and or xor array as break case cfunction const continue declare default die do else elseif enddeclare endfor endforeach endif endswitch endwhile extends for foreach function include include_once global if new old_function return static switch use require require_once while abstract interface public implements extends private protected throw";return i=new RegExp(r(i),"gi"),l=new RegExp(r(l),"gi"),e=e.replace(/(".*?")/g,'<span class="str">$1</span>').replace(/('.*?')/g,'<span class="str">$1</span>').replace(/\/\*([\s\S]*?)\*\//g,function(e){return"\x00C"+t(s,a(e))+"\x00"}).replace(/\0C(\d+)\0/g,function(e,r){return s[r]}).replace(/\/\/(.*$)/gm,'<span class="com">//$1</span>').replace(/\$(\w+)/g,'<span class="var">$$$1</span>').replace(i,'<span class="fnc">$1</span>$2').replace(l,'<span class="kwd">$1</span>$2')},hightlight_css:function(e){var s=[],i="background-color background-image background-position background-repeat background border-collapse border-color border-spacing border-style border-top border-right border-bottom border-left border-top-color border-right-color border-bottom-color border-left-color border-top-style border-right-style border-bottom-style border-left-style border-top-width border-right-width border-bottom-width border-left-width border-width border color cursor direction display float font-size-adjust font-family font-size font-stretch font-style font-variant font-weight font height left letter-spacing line-height list-style-image list-style-position list-style-type list-style margin-top margin-right margin-bottom margin-left margin max-height max-width min-height min-width outline-color outline-style outline-width outline overflow padding-top padding-right padding-bottom padding-left padding positionquotes right size src table-layout text-align top text-decoration text-indent text-shadow text-transform vertical-align visibility white-space width word-spacing x-height z-index",l="absolute all attr auto baseline behind below black blink block blue bold bolder both bottom capitalize caption center center-left center-right circle close-quote collapse compact continuous cursive dashed decimal default digits disc dotted double embed expanded fixed format gray green groove help hidden hide high higher icon inline-table inline inset inside invert italic justify large larger left-side left leftwards level line-through list-item lowercase lower low ltr marker medium middle move none no-repeat normal nowrap oblique olive once outset outside overline pointer print purple red relative repeat repeat-x repeat-y rgb right rtl screen scroll show silver slower slow small small-caps small-caption smaller soft solid square s-resize static sub super table-caption table-cell table-column table-column-group table-footer-group table-header-group table-row table-row-group text-bottom text-top thick thin top transparent underline upper-alpha uppercase upper-latin upper-roman url visible wait white wider w-resize x-fast x-high x-large x-low x-small x-soft yellow",n="[mM]onospace [tT]ahoma [vV]erdana [aA]rial [hH]elvetica [sS]ans-serif [sS]erif [cC]ourier New mono sans serif";return i=new RegExp(r(i),"gi"),l=new RegExp(r(l),"gi"),n=new RegExp(r(n),"gi"),e=e.replace(/\/\*([\s\S]*?)\*\//g,function(e){return"\x00C"+t(s,a(e))+"\x00"}).replace(/\0C(\d+)\0/g,function(e,r){return s[r]}).replace(i,'<span class="kwd">$1</span>$2').replace(l,'<span class="pln">$1</span>$2').replace(n,'<span class="str">$1</span>$2').replace(/(\#[a-fA-F0-9]{3,6})/gi,'<span class="lit">$1</span>').replace(/(-?\d+)(\.\d+)?(px|em|pt|\:|\%|)/gi,'<span class="lit">$1$3</span>')},hightlight_html:function(e){return e=e.replace(/\s+([a-zA-Z\-]{0,15})\=\"([-a-z0-9_ \/\.\#\:\=\;]{0,49})\"/gi,' <span class="atn">$1</span>=<span class="atv">"$2"</span>').replace(/(&lt;)(\w{0,15})(\s+|&gt;|>)/gi,'$1<span class="tag">$2</span>$3').replace(/(&lt;)\/(\w{0,15})(&gt;|>)/gi,'$1/<span class="tag">$2</span>$3').replace(/(&lt;!)([-a-z0-9_ \/\.\#\:\"]{0,150})(&gt;|>)/gi,'<span class="dec">$1$2$3</span>').replace(/(&lt;|<)!--([\s\S]*?)--(&gt;|>)/gm,'<span class="com">$1!--$2--$3</span>')}}}(jQuery);

/* Scripts for demo */

function initHandler( _name, opened ){
    var elt_handler = $('#'+_name+'_handler'),
        elt_handler_icon = elt_handler.find('.fa'),
        elt_block = $('#'+_name);
    if (opened==undefined || opened==false) {
        elt_block.hide();
    } else {
        elt_handler_icon.removeClass('fa-caret-right').addClass('fa-caret-down');
    }
    elt_handler.click(function(){ 
        elt_block.toggle('slow');
        if (elt_handler_icon.hasClass('fa-caret-down')) {
            elt_handler_icon.removeClass('fa-caret-down').addClass('fa-caret-right');
        } else {
            elt_handler_icon.removeClass('fa-caret-right').addClass('fa-caret-down');
        }
    });
}

function getPluginManifest( url, callback ) {
    $.ajax(url, {
        error: function(jqXHR, textStatus, error) {
            addMessage('AJAX error! ['+textStatus+(error ? ' : '+error : '')+']');
            return false;
        },
        success: function(data) { callback.apply(this, [data]); }
    });
}

function getGitHubCommits( github, callback ) {
    $.ajax(github+'commits', {
        method: 'GET',
        crossDomain: true,
        data: { page: 1, per_page: 5 },
        dataType: 'json',
        error: function(jqXHR, textStatus, error) {
            addMessage('AJAX error! ['+textStatus+(error ? ' : '+error : '')+']');
            return false;
        },
        success: function(data, textStatus, jqXHR) { 
            if (data.length>1 || data[0]!==undefined) {
                callback.apply(this, [data]);
            } else {
                callback.apply(this, [null]);
            }
        }
    });
}

function getGitHubBugs( github, callback ) {
    $.ajax(github+'issues', {
        method: 'GET',
        crossDomain: true,
        data: { page: 1, per_page: 5 },
        dataType: 'json',
        error: function(jqXHR, textStatus, error) {
            addMessage('AJAX error! ['+textStatus+(error ? ' : '+error : '')+']');
            return false;
        },
        success: function(data, textStatus, jqXHR) {
            if (data.length>1 || data[0]!==undefined) {
                callback.apply(this, [data]);
            } else {
                callback.apply(this, [null]);
            }
        }
    });
}

function getUrlFilenameAndQuery( url ){
    var filename, qm = url.lastIndexOf('#');
    if (qm!==-1) { filename = url.substr(0,qm); }
    else { filename = url; }
    return filename.substring(filename.lastIndexOf('/')+1);
}

function getUrlFilename( url ){
    var filename, qm = url.lastIndexOf('?');
    if (qm!==-1) { filename = url.substr(0,qm); }
    else { filename = url; }
    return filename.substring(filename.lastIndexOf('/')+1);
}

function getUrlHash(){
    return window.location.hash;
}
