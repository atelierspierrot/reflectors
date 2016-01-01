
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Reflectors" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Reflectors.html">Reflectors</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Reflectors_Value" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Reflectors/Value.html">Value</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Reflectors_Value_ReflectionArray" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionArray.html">ReflectionArray</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionBoolean" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionBoolean.html">ReflectionBoolean</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionCallback" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionCallback.html">ReflectionCallback</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionFloat" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionFloat.html">ReflectionFloat</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionInteger" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionInteger.html">ReflectionInteger</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionNull" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionNull.html">ReflectionNull</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionObject" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionObject.html">ReflectionObject</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionResource" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionResource.html">ReflectionResource</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionString" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionString.html">ReflectionString</a>                    </div>                </li>                            <li data-name="class:Reflectors_Value_ReflectionUnknown" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Reflectors/Value/ReflectionUnknown.html">ReflectionUnknown</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Reflectors_AbstractReflectionValue" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/AbstractReflectionValue.html">AbstractReflectionValue</a>                    </div>                </li>                            <li data-name="class:Reflectors_AbstractReflectionValueProxy" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/AbstractReflectionValueProxy.html">AbstractReflectionValueProxy</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReadOnlyPropertiesTrait" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReadOnlyPropertiesTrait.html">ReadOnlyPropertiesTrait</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionBacktrace" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionBacktrace.html">ReflectionBacktrace</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionCallback" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionCallback.html">ReflectionCallback</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionParameterValue" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionParameterValue.html">ReflectionParameterValue</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionSource" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionSource.html">ReflectionSource</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionTrace" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionTrace.html">ReflectionTrace</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionValue" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionValue.html">ReflectionValue</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectionValueInterface" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectionValueInterface.html">ReflectionValueInterface</a>                    </div>                </li>                            <li data-name="class:Reflectors_ReflectorTrait" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ReflectorTrait.html">ReflectorTrait</a>                    </div>                </li>                            <li data-name="class:Reflectors_ValueType" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Reflectors/ValueType.html">ValueType</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Reflectors.html", "name": "Reflectors", "doc": "Namespace Reflectors"},{"type": "Namespace", "link": "Reflectors/Value.html", "name": "Reflectors\\Value", "doc": "Namespace Reflectors\\Value"},
            {"type": "Interface", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionValueInterface.html", "name": "Reflectors\\ReflectionValueInterface", "doc": "&quot;This interface is designed to build generic objects reflecting a variable with its value and type.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionValueInterface", "fromLink": "Reflectors/ReflectionValueInterface.html", "link": "Reflectors/ReflectionValueInterface.html#method_getValue", "name": "Reflectors\\ReflectionValueInterface::getValue", "doc": "&quot;Returns the current value of concerned variable&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValueInterface", "fromLink": "Reflectors/ReflectionValueInterface.html", "link": "Reflectors/ReflectionValueInterface.html#method_getValueType", "name": "Reflectors\\ReflectionValueInterface::getValueType", "doc": "&quot;Returns the type of the value of concerned variable&quot;"},
            
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/AbstractReflectionValue.html", "name": "Reflectors\\AbstractReflectionValue", "doc": "&quot;Basic implementation of the &lt;code&gt;\\Reflectors\\ReflectionValueInterface&lt;\/code&gt; with read-only properties.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValue", "fromLink": "Reflectors/AbstractReflectionValue.html", "link": "Reflectors/AbstractReflectionValue.html#method___construct", "name": "Reflectors\\AbstractReflectionValue::__construct", "doc": "&quot;Extending classes may define their own constructor and call this one first&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValue", "fromLink": "Reflectors/AbstractReflectionValue.html", "link": "Reflectors/AbstractReflectionValue.html#method___toString", "name": "Reflectors\\AbstractReflectionValue::__toString", "doc": "&quot;Extending classes must define their own representation&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValue", "fromLink": "Reflectors/AbstractReflectionValue.html", "link": "Reflectors/AbstractReflectionValue.html#method_getValue", "name": "Reflectors\\AbstractReflectionValue::getValue", "doc": "&quot;Returns the current value&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValue", "fromLink": "Reflectors/AbstractReflectionValue.html", "link": "Reflectors/AbstractReflectionValue.html#method_getValueType", "name": "Reflectors\\AbstractReflectionValue::getValueType", "doc": "&quot;Returns the type of the value&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/AbstractReflectionValueProxy.html", "name": "Reflectors\\AbstractReflectionValueProxy", "doc": "&quot;Use this class to define a `ReflectionValue.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValueProxy", "fromLink": "Reflectors/AbstractReflectionValueProxy.html", "link": "Reflectors/AbstractReflectionValueProxy.html#method___construct", "name": "Reflectors\\AbstractReflectionValueProxy::__construct", "doc": "&quot;Constructor. You MUST call this one to prepare proxy.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\AbstractReflectionValueProxy", "fromLink": "Reflectors/AbstractReflectionValueProxy.html", "link": "Reflectors/AbstractReflectionValueProxy.html#method___call", "name": "Reflectors\\AbstractReflectionValueProxy::__call", "doc": "&quot;This will transmit a method&#039;s call to the proxy if it exists&quot;"},
            
            {"type": "Trait", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReadOnlyPropertiesTrait.html", "name": "Reflectors\\ReadOnlyPropertiesTrait", "doc": "&quot;This trait defines magic getters and setters for read-only object&#039;s properties&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReadOnlyPropertiesTrait", "fromLink": "Reflectors/ReadOnlyPropertiesTrait.html", "link": "Reflectors/ReadOnlyPropertiesTrait.html#method_setReadOnlyProperties", "name": "Reflectors\\ReadOnlyPropertiesTrait::setReadOnlyProperties", "doc": "&quot;Defines the read-only properties names and accessors.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReadOnlyPropertiesTrait", "fromLink": "Reflectors/ReadOnlyPropertiesTrait.html", "link": "Reflectors/ReadOnlyPropertiesTrait.html#method___get", "name": "Reflectors\\ReadOnlyPropertiesTrait::__get", "doc": "&quot;Magic getter for read-only properties.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReadOnlyPropertiesTrait", "fromLink": "Reflectors/ReadOnlyPropertiesTrait.html", "link": "Reflectors/ReadOnlyPropertiesTrait.html#method___set", "name": "Reflectors\\ReadOnlyPropertiesTrait::__set", "doc": "&quot;Magic setter to avoid setting read-only properties.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReadOnlyPropertiesTrait", "fromLink": "Reflectors/ReadOnlyPropertiesTrait.html", "link": "Reflectors/ReadOnlyPropertiesTrait.html#method___unset", "name": "Reflectors\\ReadOnlyPropertiesTrait::__unset", "doc": "&quot;Magic un-setter to avoid un-setting read-only properties.&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionBacktrace.html", "name": "Reflectors\\ReflectionBacktrace", "doc": "&quot;The backtrace reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method___construct", "name": "Reflectors\\ReflectionBacktrace::__construct", "doc": "&quot;Construct a backtrace reflection&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method_getRawTraces", "name": "Reflectors\\ReflectionBacktrace::getRawTraces", "doc": "&quot;Returns the original backtrace array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method_getTraces", "name": "Reflectors\\ReflectionBacktrace::getTraces", "doc": "&quot;Returns the backtrace array with each item as a &lt;code&gt;\\Reflectors\\ReflectionTrace&lt;\/code&gt; object&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method_getLength", "name": "Reflectors\\ReflectionBacktrace::getLength", "doc": "&quot;Returns the length of the backtrace (affected by the &lt;code&gt;$limit&lt;\/code&gt; argument if so)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method_getTrace", "name": "Reflectors\\ReflectionBacktrace::getTrace", "doc": "&quot;Returns a specific trace of the backtrace table as a &lt;code&gt;\\Reflectors\\ReflectionTrace&lt;\/code&gt; object&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionBacktrace", "fromLink": "Reflectors/ReflectionBacktrace.html", "link": "Reflectors/ReflectionBacktrace.html#method___toString", "name": "Reflectors\\ReflectionBacktrace::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionCallback.html", "name": "Reflectors\\ReflectionCallback", "doc": "&quot;The callback global reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method___construct", "name": "Reflectors\\ReflectionCallback::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getCallback", "name": "Reflectors\\ReflectionCallback::getCallback", "doc": "&quot;Returns the original callback content&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getCallbackType", "name": "Reflectors\\ReflectionCallback::getCallbackType", "doc": "&quot;Returns the callback type&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getType", "name": "Reflectors\\ReflectionCallback::getType", "doc": "&quot;Returns the callback type (alias of &lt;code&gt;self::getCallbackType()&lt;\/code&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getReflector", "name": "Reflectors\\ReflectionCallback::getReflector", "doc": "&quot;Returns the reflector of the callback&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getFunctionName", "name": "Reflectors\\ReflectionCallback::getFunctionName", "doc": "&quot;Returns the function or method name if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_getClassName", "name": "Reflectors\\ReflectionCallback::getClassName", "doc": "&quot;Returns the class or object class name if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_invoke", "name": "Reflectors\\ReflectionCallback::invoke", "doc": "&quot;Invokes the callback with a list of parameters&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_invokeArgs", "name": "Reflectors\\ReflectionCallback::invokeArgs", "doc": "&quot;Invokes the callback with a list of parameters as an array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_isFunction", "name": "Reflectors\\ReflectionCallback::isFunction", "doc": "&quot;Tests if the callback is a function&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_isClosure", "name": "Reflectors\\ReflectionCallback::isClosure", "doc": "&quot;Tests if the callback is a closure&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_isMethod", "name": "Reflectors\\ReflectionCallback::isMethod", "doc": "&quot;Tests if the callback is a class&#039; method&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_isMethodStatic", "name": "Reflectors\\ReflectionCallback::isMethodStatic", "doc": "&quot;Tests if the callback is a static class&#039; method&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method_isObject", "name": "Reflectors\\ReflectionCallback::isObject", "doc": "&quot;Tests if the callback is a static class&#039; method&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionCallback", "fromLink": "Reflectors/ReflectionCallback.html", "link": "Reflectors/ReflectionCallback.html#method___toString", "name": "Reflectors\\ReflectionCallback::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionParameterValue.html", "name": "Reflectors\\ReflectionParameterValue", "doc": "&quot;An extension of the internal &lt;code&gt;\\ReflectionParameter&lt;\/code&gt; with a value&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionParameterValue", "fromLink": "Reflectors/ReflectionParameterValue.html", "link": "Reflectors/ReflectionParameterValue.html#method___construct", "name": "Reflectors\\ReflectionParameterValue::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionParameterValue", "fromLink": "Reflectors/ReflectionParameterValue.html", "link": "Reflectors/ReflectionParameterValue.html#method_getValue", "name": "Reflectors\\ReflectionParameterValue::getValue", "doc": "&quot;Returns the value of the parameter&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionParameterValue", "fromLink": "Reflectors/ReflectionParameterValue.html", "link": "Reflectors/ReflectionParameterValue.html#method_getValueType", "name": "Reflectors\\ReflectionParameterValue::getValueType", "doc": "&quot;Returns the type of the parameter&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionParameterValue", "fromLink": "Reflectors/ReflectionParameterValue.html", "link": "Reflectors/ReflectionParameterValue.html#method___toString", "name": "Reflectors\\ReflectionParameterValue::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionSource.html", "name": "Reflectors\\ReflectionSource", "doc": "&quot;The source reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method___construct", "name": "Reflectors\\ReflectionSource::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_getFilePath", "name": "Reflectors\\ReflectionSource::getFilePath", "doc": "&quot;Returns the path of concerned file&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_getLineNo", "name": "Reflectors\\ReflectionSource::getLineNo", "doc": "&quot;Returns the concerned line number (if defined)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_getContext", "name": "Reflectors\\ReflectionSource::getContext", "doc": "&quot;Returns the context or one of its items&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_getSource", "name": "Reflectors\\ReflectionSource::getSource", "doc": "&quot;Get the source code of the file in a line-by-line array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_render", "name": "Reflectors\\ReflectionSource::render", "doc": "&quot;Renders the source as plain text&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method_renderHighlight", "name": "Reflectors\\ReflectionSource::renderHighlight", "doc": "&quot;Renders the source highlighted in HTML&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionSource", "fromLink": "Reflectors/ReflectionSource.html", "link": "Reflectors/ReflectionSource.html#method___toString", "name": "Reflectors\\ReflectionSource::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionTrace.html", "name": "Reflectors\\ReflectionTrace", "doc": "&quot;This is the backtrace item reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method___construct", "name": "Reflectors\\ReflectionTrace::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getCalled", "name": "Reflectors\\ReflectionTrace::getCalled", "doc": "&quot;Returns a representation of called method or function&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_hasObject", "name": "Reflectors\\ReflectionTrace::hasObject", "doc": "&quot;Tests if an object is defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getObject", "name": "Reflectors\\ReflectionTrace::getObject", "doc": "&quot;Returns the object if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getClassName", "name": "Reflectors\\ReflectionTrace::getClassName", "doc": "&quot;Returns the class name if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getClass", "name": "Reflectors\\ReflectionTrace::getClass", "doc": "&quot;Returns the class as a &lt;code&gt;\\ReflectionClass&lt;\/code&gt; object if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getFunctionName", "name": "Reflectors\\ReflectionTrace::getFunctionName", "doc": "&quot;Returns the function name if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getFunction", "name": "Reflectors\\ReflectionTrace::getFunction", "doc": "&quot;Returns the class as a &lt;code&gt;\\ReflectionFunction&lt;\/code&gt; or &lt;code&gt;\\ReflectionMethod&lt;\/code&gt; object if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getLine", "name": "Reflectors\\ReflectionTrace::getLine", "doc": "&quot;Returns concerned line if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getFile", "name": "Reflectors\\ReflectionTrace::getFile", "doc": "&quot;Returns concerned file if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getType", "name": "Reflectors\\ReflectionTrace::getType", "doc": "&quot;Returns concerned type if defined&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getArgs", "name": "Reflectors\\ReflectionTrace::getArgs", "doc": "&quot;Returns the trace arguments as the original array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method_getArguments", "name": "Reflectors\\ReflectionTrace::getArguments", "doc": "&quot;Returns the trace arguments as an array of &lt;code&gt;\\Reflectors\\ReflectionParameterValue&lt;\/code&gt; or &lt;code&gt;\\ReflectionParameter&lt;\/code&gt; items&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionTrace", "fromLink": "Reflectors/ReflectionTrace.html", "link": "Reflectors/ReflectionTrace.html#method___toString", "name": "Reflectors\\ReflectionTrace::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionValue.html", "name": "Reflectors\\ReflectionValue", "doc": "&quot;This is the global variable value reflector object. It acts like a reflection proxy.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method___construct", "name": "Reflectors\\ReflectionValue::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_getReflector", "name": "Reflectors\\ReflectionValue::getReflector", "doc": "&quot;Returns the variable reflector&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_getValue", "name": "Reflectors\\ReflectionValue::getValue", "doc": "&quot;Returns the variable&#039;s value from the reflector&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_getValueType", "name": "Reflectors\\ReflectionValue::getValueType", "doc": "&quot;Returns the variable&#039;s type from the reflector&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isNull", "name": "Reflectors\\ReflectionValue::isNull", "doc": "&quot;Tests if the variable is NULL&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isBoolean", "name": "Reflectors\\ReflectionValue::isBoolean", "doc": "&quot;Tests if the variable is a boolean&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isInteger", "name": "Reflectors\\ReflectionValue::isInteger", "doc": "&quot;Tests if the variable is an integer&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isFloat", "name": "Reflectors\\ReflectionValue::isFloat", "doc": "&quot;Tests if the variable is a float&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isString", "name": "Reflectors\\ReflectionValue::isString", "doc": "&quot;Tests if the variable is a string&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isArray", "name": "Reflectors\\ReflectionValue::isArray", "doc": "&quot;Tests if the variable is an array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isObject", "name": "Reflectors\\ReflectionValue::isObject", "doc": "&quot;Tests if the variable is an object&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isResource", "name": "Reflectors\\ReflectionValue::isResource", "doc": "&quot;Tests if the variable is a resource&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method_isCallback", "name": "Reflectors\\ReflectionValue::isCallback", "doc": "&quot;Tests if the variable is a callback&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValue", "fromLink": "Reflectors/ReflectionValue.html", "link": "Reflectors/ReflectionValue.html#method___toString", "name": "Reflectors\\ReflectionValue::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectionValueInterface.html", "name": "Reflectors\\ReflectionValueInterface", "doc": "&quot;This interface is designed to build generic objects reflecting a variable with its value and type.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectionValueInterface", "fromLink": "Reflectors/ReflectionValueInterface.html", "link": "Reflectors/ReflectionValueInterface.html#method_getValue", "name": "Reflectors\\ReflectionValueInterface::getValue", "doc": "&quot;Returns the current value of concerned variable&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ReflectionValueInterface", "fromLink": "Reflectors/ReflectionValueInterface.html", "link": "Reflectors/ReflectionValueInterface.html#method_getValueType", "name": "Reflectors\\ReflectionValueInterface::getValueType", "doc": "&quot;Returns the type of the value of concerned variable&quot;"},
            
            {"type": "Trait", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ReflectorTrait.html", "name": "Reflectors\\ReflectorTrait", "doc": "&quot;Basic implementation of the &lt;code&gt;\\Reflector::export()&lt;\/code&gt; method&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ReflectorTrait", "fromLink": "Reflectors/ReflectorTrait.html", "link": "Reflectors/ReflectorTrait.html#method_export", "name": "Reflectors\\ReflectorTrait::export", "doc": "&quot;Creation of a new instance of the mother class on-the-fly&quot;"},
            
            {"type": "Class", "fromName": "Reflectors", "fromLink": "Reflectors.html", "link": "Reflectors/ValueType.html", "name": "Reflectors\\ValueType", "doc": "&quot;This only defines possible value types as constants and validators static methods.&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_getType", "name": "Reflectors\\ValueType::getType", "doc": "&quot;Returns a value type by testing it in the &lt;code&gt;$order&lt;\/code&gt; order.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_getReflector", "name": "Reflectors\\ValueType::getReflector", "doc": "&quot;Returns a reflector for the value by testing its type in the &lt;code&gt;$order&lt;\/code&gt; order.&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_getCallbackType", "name": "Reflectors\\ValueType::getCallbackType", "doc": "&quot;Returns the type of a callback&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isNull", "name": "Reflectors\\ValueType::isNull", "doc": "&quot;Tests if a value is null&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isBoolean", "name": "Reflectors\\ValueType::isBoolean", "doc": "&quot;Tests if a value is a boolean&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isInteger", "name": "Reflectors\\ValueType::isInteger", "doc": "&quot;Tests if a value is an integer&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isFloat", "name": "Reflectors\\ValueType::isFloat", "doc": "&quot;Tests if a value is a float&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isDouble", "name": "Reflectors\\ValueType::isDouble", "doc": "&quot;Tests if a value is a double (alias of &lt;code&gt;self::isFloat()&lt;\/code&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isRealNumber", "name": "Reflectors\\ValueType::isRealNumber", "doc": "&quot;Tests if a value is a \&quot;real number\&quot; (alias of &lt;code&gt;self::isFloat()&lt;\/code&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isString", "name": "Reflectors\\ValueType::isString", "doc": "&quot;Tests if a value is a string&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isArray", "name": "Reflectors\\ValueType::isArray", "doc": "&quot;Tests if a value is an array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isObject", "name": "Reflectors\\ValueType::isObject", "doc": "&quot;Tests if a value is an object&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isClosure", "name": "Reflectors\\ValueType::isClosure", "doc": "&quot;Tests if a value is a closure (alias of &lt;code&gt;self::isCallback()&lt;\/code&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isCallable", "name": "Reflectors\\ValueType::isCallable", "doc": "&quot;Tests if a value is callable (alias of &lt;code&gt;self::isCallback()&lt;\/code&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isCallback", "name": "Reflectors\\ValueType::isCallback", "doc": "&quot;Tests if a value is a valid callback&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\ValueType", "fromLink": "Reflectors/ValueType.html", "link": "Reflectors/ValueType.html#method_isResource", "name": "Reflectors\\ValueType::isResource", "doc": "&quot;Tests if a value is a resource&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionArray.html", "name": "Reflectors\\Value\\ReflectionArray", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/array\&quot;&gt;array&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method___construct", "name": "Reflectors\\Value\\ReflectionArray::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_getArray", "name": "Reflectors\\Value\\ReflectionArray::getArray", "doc": "&quot;Returns the full array itself&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_getKeys", "name": "Reflectors\\Value\\ReflectionArray::getKeys", "doc": "&quot;Returns the keys of the array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_getValues", "name": "Reflectors\\Value\\ReflectionArray::getValues", "doc": "&quot;Returns the values of the array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_getLength", "name": "Reflectors\\Value\\ReflectionArray::getLength", "doc": "&quot;Returns the length of the array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_hasKey", "name": "Reflectors\\Value\\ReflectionArray::hasKey", "doc": "&quot;Test if a key exists in the array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method_getItem", "name": "Reflectors\\Value\\ReflectionArray::getItem", "doc": "&quot;Get a specific item of the array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionArray", "fromLink": "Reflectors/Value/ReflectionArray.html", "link": "Reflectors/Value/ReflectionArray.html#method___toString", "name": "Reflectors\\Value\\ReflectionArray::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionBoolean.html", "name": "Reflectors\\Value\\ReflectionBoolean", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/boolean\&quot;&gt;boolean&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionBoolean", "fromLink": "Reflectors/Value/ReflectionBoolean.html", "link": "Reflectors/Value/ReflectionBoolean.html#method___construct", "name": "Reflectors\\Value\\ReflectionBoolean::__construct", "doc": "&quot;Use the &lt;code&gt;ValueType::BINARY_AS_BOOLEAN&lt;\/code&gt; flag to allow binaries &lt;code&gt;0&lt;\/code&gt; and &lt;code&gt;1&lt;\/code&gt; as boolean values&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionBoolean", "fromLink": "Reflectors/Value/ReflectionBoolean.html", "link": "Reflectors/Value/ReflectionBoolean.html#method___toString", "name": "Reflectors\\Value\\ReflectionBoolean::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionCallback.html", "name": "Reflectors\\Value\\ReflectionCallback", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/callable\&quot;&gt;callback&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method___construct", "name": "Reflectors\\Value\\ReflectionCallback::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method_getCallback", "name": "Reflectors\\Value\\ReflectionCallback::getCallback", "doc": "&quot;Returns the callable value (ready to be called).&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method_getReflector", "name": "Reflectors\\Value\\ReflectionCallback::getReflector", "doc": "&quot;Returns a reflector object for the callable&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method_getCallbackType", "name": "Reflectors\\Value\\ReflectionCallback::getCallbackType", "doc": "&quot;Returns the type of the value&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method_invoke", "name": "Reflectors\\Value\\ReflectionCallback::invoke", "doc": "&quot;Invokes the callback with a list of parameters&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method_invokeArgs", "name": "Reflectors\\Value\\ReflectionCallback::invokeArgs", "doc": "&quot;Invokes the callback with a list of parameters as an array&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionCallback", "fromLink": "Reflectors/Value/ReflectionCallback.html", "link": "Reflectors/Value/ReflectionCallback.html#method___toString", "name": "Reflectors\\Value\\ReflectionCallback::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionFloat.html", "name": "Reflectors\\Value\\ReflectionFloat", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/float\&quot;&gt;float&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionFloat", "fromLink": "Reflectors/Value/ReflectionFloat.html", "link": "Reflectors/Value/ReflectionFloat.html#method___construct", "name": "Reflectors\\Value\\ReflectionFloat::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionFloat", "fromLink": "Reflectors/Value/ReflectionFloat.html", "link": "Reflectors/Value/ReflectionFloat.html#method___toString", "name": "Reflectors\\Value\\ReflectionFloat::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionInteger.html", "name": "Reflectors\\Value\\ReflectionInteger", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/integer\&quot;&gt;integer&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionInteger", "fromLink": "Reflectors/Value/ReflectionInteger.html", "link": "Reflectors/Value/ReflectionInteger.html#method___construct", "name": "Reflectors\\Value\\ReflectionInteger::__construct", "doc": "&quot;Use the &lt;code&gt;ValueType::NUMERIC_AS_INTEGER&lt;\/code&gt; flag to allow any numeric value&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionInteger", "fromLink": "Reflectors/Value/ReflectionInteger.html", "link": "Reflectors/Value/ReflectionInteger.html#method___toString", "name": "Reflectors\\Value\\ReflectionInteger::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionNull.html", "name": "Reflectors\\Value\\ReflectionNull", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/null\&quot;&gt;NULL&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionNull", "fromLink": "Reflectors/Value/ReflectionNull.html", "link": "Reflectors/Value/ReflectionNull.html#method___construct", "name": "Reflectors\\Value\\ReflectionNull::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionNull", "fromLink": "Reflectors/Value/ReflectionNull.html", "link": "Reflectors/Value/ReflectionNull.html#method___toString", "name": "Reflectors\\Value\\ReflectionNull::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionObject.html", "name": "Reflectors\\Value\\ReflectionObject", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/object\&quot;&gt;object&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionObject", "fromLink": "Reflectors/Value/ReflectionObject.html", "link": "Reflectors/Value/ReflectionObject.html#method___construct", "name": "Reflectors\\Value\\ReflectionObject::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionObject", "fromLink": "Reflectors/Value/ReflectionObject.html", "link": "Reflectors/Value/ReflectionObject.html#method_getValue", "name": "Reflectors\\Value\\ReflectionObject::getValue", "doc": "&quot;Returns the current value&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionObject", "fromLink": "Reflectors/Value/ReflectionObject.html", "link": "Reflectors/Value/ReflectionObject.html#method_getValueType", "name": "Reflectors\\Value\\ReflectionObject::getValueType", "doc": "&quot;Returns the type of the value&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionObject", "fromLink": "Reflectors/Value/ReflectionObject.html", "link": "Reflectors/Value/ReflectionObject.html#method___toString", "name": "Reflectors\\Value\\ReflectionObject::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionResource.html", "name": "Reflectors\\Value\\ReflectionResource", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/resource\&quot;&gt;resource&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionResource", "fromLink": "Reflectors/Value/ReflectionResource.html", "link": "Reflectors/Value/ReflectionResource.html#method___construct", "name": "Reflectors\\Value\\ReflectionResource::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionResource", "fromLink": "Reflectors/Value/ReflectionResource.html", "link": "Reflectors/Value/ReflectionResource.html#method_getResourceType", "name": "Reflectors\\Value\\ReflectionResource::getResourceType", "doc": "&quot;Returns the type of the resource (&lt;a href=\&quot;http:\/\/php.net\/get_resource_type\&quot;&gt;http:\/\/php.net\/get_resource_type&lt;\/a&gt;)&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionResource", "fromLink": "Reflectors/Value/ReflectionResource.html", "link": "Reflectors/Value/ReflectionResource.html#method___toString", "name": "Reflectors\\Value\\ReflectionResource::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionString.html", "name": "Reflectors\\Value\\ReflectionString", "doc": "&quot;The &lt;a href=\&quot;http:\/\/php.net\/string\&quot;&gt;string&lt;\/a&gt; value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionString", "fromLink": "Reflectors/Value/ReflectionString.html", "link": "Reflectors/Value/ReflectionString.html#method___construct", "name": "Reflectors\\Value\\ReflectionString::__construct", "doc": "&quot;Use the &lt;code&gt;ValueType::NUMERIC_AS_STRING&lt;\/code&gt; flag to allow numeric values as strings&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionString", "fromLink": "Reflectors/Value/ReflectionString.html", "link": "Reflectors/Value/ReflectionString.html#method_getString", "name": "Reflectors\\Value\\ReflectionString::getString", "doc": "&quot;Returns the current value of the string&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionString", "fromLink": "Reflectors/Value/ReflectionString.html", "link": "Reflectors/Value/ReflectionString.html#method_getLength", "name": "Reflectors\\Value\\ReflectionString::getLength", "doc": "&quot;Returns the length of the string&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionString", "fromLink": "Reflectors/Value/ReflectionString.html", "link": "Reflectors/Value/ReflectionString.html#method___toString", "name": "Reflectors\\Value\\ReflectionString::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            {"type": "Class", "fromName": "Reflectors\\Value", "fromLink": "Reflectors/Value.html", "link": "Reflectors/Value/ReflectionUnknown.html", "name": "Reflectors\\Value\\ReflectionUnknown", "doc": "&quot;The \&quot;unknown\&quot; typed value reflector&quot;"},
                                                        {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionUnknown", "fromLink": "Reflectors/Value/ReflectionUnknown.html", "link": "Reflectors/Value/ReflectionUnknown.html#method___construct", "name": "Reflectors\\Value\\ReflectionUnknown::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Reflectors\\Value\\ReflectionUnknown", "fromLink": "Reflectors/Value/ReflectionUnknown.html", "link": "Reflectors/Value/ReflectionUnknown.html#method___toString", "name": "Reflectors\\Value\\ReflectionUnknown::__toString", "doc": "&quot;Representation of the object&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


