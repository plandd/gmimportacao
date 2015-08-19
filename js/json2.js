/*
    http://www.JSON.org/json2.js
    2011-02-23

    Public Domain.

    NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.

    See http://www.JSON.org/js.html


    This code should be minified before deployment.
    See http://javascript.crockford.com/jsmin.html

    USE YOUR OWN COPY. IT IS EXTREMELY UNWISE TO LOAD CODE FROM SERVERS YOU DO
    NOT CONTROL.


    This file creates a global JSON object containing two methods: stringify
    and parse.

        JSON.stringify(value, replacer, space)
            value       any JavaScript value, usually an object or array.

            replacer    an optional parameter that determines how object
                        values are stringified for objects. It can be a
                        function or an array of strings.

            space       an optional parameter that specifies the indentation
                        of nested structures. If it is omitted, the text will
                        be packed without extra whitespace. If it is a number,
                        it will specify the number of spaces to indent at each
                        level. If it is a string (such as '\t' or '&nbsp;'),
                        it contains the characters used to indent at each level.

            This method produces a JSON text from a JavaScript value.

            When an object value is found, if the object contains a toJSON
            method, its toJSON method will be called and the result will be
            stringified. A toJSON method does not serialize: it returns the
            value represented by the name/value pair that should be serialized,
            or undefined if nothing should be serialized. The toJSON method
            will be passed the key associated with the value, and this will be
            bound to the value

            For example, this would serialize Dates as ISO strings.

                Date.prototype.toJSON = function (key) {
                    function f(n) {
                        // Format integers to have at least two digits.
                        return n < 10 ? '0' + n : n;
                    }

                    return this.getUTCFullYear()   + '-' +
                         f(this.getUTCMonth() + 1) + '-' +
                         f(this.getUTCDate())      + 'T' +
                         f(this.getUTCHours())     + ':' +
                         f(this.getUTCMinutes())   + ':' +
                         f(this.getUTCSeconds())   + 'Z';
                };

            You can provide an optional replacer method. It will be passed the
            key and value of each member, with this bound to the containing
            object. The value that is returned from your method will be
            serialized. If your method returns undefined, then the member will
            be excluded from the serialization.

            If the replacer parameter is an array of strings, then it will be
            used to select the members to be serialized. It filters the results
            such that only members with keys listed in the replacer array are
            stringified.

            Values that do not have JSON representations, such as undefined or
            functions, will not be serialized. Such values in objects will be
            dropped; in arrays they will be replaced with null. You can use
            a replacer function to replace those with JSON values.
            JSON.stringify(undefined) returns undefined.

            The optional space parameter produces a stringification of the
            value that is filled with line breaks and indentation to make it
            easier to read.

            If the space parameter is a non-empty string, then that string will
            be used for indentation. If the space parameter is a number, then
            the indentation will be that many spaces.

            Example:

            text = JSON.stringify(['e', {pluribus: 'unum'}]);
            // text is '["e",{"pluribus":"unum"}]'


            text = JSON.stringify(['e', {pluribus: 'unum'}], null, '\t');
            // text is '[\n\t"e",\n\t{\n\t\t"pluribus": "unum"\n\t}\n]'

            text = JSON.stringify([new Date()], function (key, value) {
                return this[key] instanceof Date ?
                    'Date(' + this[key] + ')' : value;
            });
            // text is '["Date(---current time---)"]'


        JSON.parse(text, reviver)
            This method parses a JSON text to produce an object or array.
            It can throw a SyntaxError exception.

            The optional reviver parameter is a function that can filter and
            transform the results. It receives each of the keys and values,
            and its return value is used instead of the original value.
            If it returns what it received, then the structure is not modified.
            If it returns undefined then the member is deleted.

            Example:

            // Parse the text. Values that look like ISO date strings will
            // be converted to Date objects.

            myData = JSON.parse(text, function (key, value) {
                var a;
                if (typeof value === 'string') {
                    a =
/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2}(?:\.\d*)?)Z$/.exec(value);
                    if (a) {
                        return new Date(Date.UTC(+a[1], +a[2] - 1, +a[3], +a[4],
                            +a[5], +a[6]));
                    }
                }
                return value;
            });

            myData = JSON.parse('["Date(09/09/2001)"]', function (key, value) {
                var d;
                if (typeof value === 'string' &&
                        value.slice(0, 5) === 'Date(' &&
                        value.slice(-1) === ')') {
                    d = new Date(value.slice(5, -1));
                    if (d) {
                        return d;
                    }
                }
                return value;
            });


    This is a reference implementation. You are free to copy, modify, or
    redistribute.
*/

/*jslint evil: true, strict: false, regexp: false */

/*members "", "\b", "\t", "\n", "\f", "\r", "\"", JSON, "\\", apply,
    call, charCodeAt, getUTCDate, getUTCFullYear, getUTCHours,
    getUTCMinutes, getUTCMonth, getUTCSeconds, hasOwnProperty, join,
    lastIndex, length, parse, prototype, push, replace, slice, stringify,
    test, toJSON, toString, valueOf
*/


// Create a JSON object only if one does not already exist. We create the
// methods in a closure to avoid creating global variables.

var JSON;
if (!JSON) {
    JSON = {};
}

(function () {
    "use strict";

    function f(n) {
        // Format integers to have at least two digits.
        return n < 10 ? '0' + n : n;
    }

    if (typeof Date.prototype.toJSON !== 'function') {

        Date.prototype.toJSON = function (key) {

            return isFinite(this.valueOf()) ?
                this.getUTCFullYear()     + '-' +
                f(this.getUTCMonth() + 1) + '-' +
                f(this.getUTCDate())      + 'T' +
                f(this.getUTCHours())     + ':' +
                f(this.getUTCMinutes())   + ':' +
                f(this.getUTCSeconds())   + 'Z' : null;
        };

        String.prototype.toJSON      =
            Number.prototype.toJSON  =
            Boolean.prototype.toJSON = function (key) {
                return this.valueOf();
            };
    }

    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap,
        indent,
        meta = {    // table of character substitutions
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },
        rep;


    function quote(string) {

// If the string contains no control characters, no quote characters, and no
// backslash characters, then we can safely slap some quotes around it.
// Otherwise we must also replace the offending characters with safe escape
// sequences.

        escapable.lastIndex = 0;
        return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
            var c = meta[a];
            return typeof c === 'string' ? c :
                '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
        }) + '"' : '"' + string + '"';
    }


    function str(key, holder) {

// Produce a string from holder[key].

        var i,          // The loop counter.
            k,          // The member key.
            v,          // The member value.
            length,
            mind = gap,
            partial,
            value = holder[key];

// If the value has a toJSON method, call it to obtain a replacement value.

        if (value && typeof value === 'object' &&
                typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }

// If we were called with a replacer function, then call the replacer to
// obtain a replacement value.

        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }

// What happens next depends on the value's type.

        switch (typeof value) {
        case 'string':
            return quote(value);

        case 'number':

// JSON numbers must be finite. Encode non-finite numbers as null.

            return isFinite(value) ? String(value) : 'null';

        case 'boolean':
        case 'null':

// If the value is a boolean or null, convert it to a string. Note:
// typeof null does not produce 'null'. The case is included here in
// the remote chance that this gets fixed someday.

            return String(value);

// If the type is 'object', we might be dealing with an object or an array or
// null.

        case 'object':

// Due to a specification blunder in ECMAScript, typeof null is 'object',
// so watch out for that case.

            if (!value) {
                return 'null';
            }

// Make an array to hold the partial results of stringifying this object value.

            gap += indent;
            partial = [];

// Is the value an array?

            if (Object.prototype.toString.apply(value) === '[object Array]') {

// The value is an array. Stringify every element. Use null as a placeholder
// for non-JSON values.

                length = value.length;
                for (i = 0; i < length; i += 1) {
                    partial[i] = str(i, value) || 'null';
                }

// Join all of the elements together, separated with commas, and wrap them in
// brackets.

                v = partial.length === 0 ? '[]' : gap ?
                    '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' :
                    '[' + partial.join(',') + ']';
                gap = mind;
                return v;
            }

// If the replacer is an array, use it to select the members to be stringified.

            if (rep && typeof rep === 'object') {
                length = rep.length;
                for (i = 0; i < length; i += 1) {
                    if (typeof rep[i] === 'string') {
                        k = rep[i];
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            } else {

// Otherwise, iterate through all of the keys in the object.

                for (k in value) {
                    if (Object.prototype.hasOwnProperty.call(value, k)) {
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            }

// Join all of the member texts together, separated with commas,
// and wrap them in braces.

            v = partial.length === 0 ? '{}' : gap ?
                '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' :
                '{' + partial.join(',') + '}';
            gap = mind;
            return v;
        }
    }

// If the JSON object does not yet have a stringify method, give it one.

    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function (value, replacer, space) {

// The stringify method takes a value and an optional replacer, and an optional
// space parameter, and returns a JSON text. The replacer can be a function
// that can replace values, or an array of strings that will select the keys.
// A default replacer method can be provided. Use of the space parameter can
// produce text that is more easily readable.

            var i;
            gap = '';
            indent = '';

// If the space parameter is a number, make an indent string containing that
// many spaces.

            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }

// If the space parameter is a string, it will be used as the indent string.

            } else if (typeof space === 'string') {
                indent = space;
            }

// If there is a replacer, it must be a function or an array.
// Otherwise, throw an error.

            rep = replacer;
            if (replacer && typeof replacer !== 'function' &&
                    (typeof replacer !== 'object' ||
                    typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }

// Make a fake root object containing our value under the key of ''.
// Return the result of stringifying the value.

            return str('', {'': value});
        };
    }


// If the JSON object does not yet have a parse method, give it one.

    if (typeof JSON.parse !== 'function') {
        JSON.parse = function (text, reviver) {

// The parse method takes a text and an optional reviver function, and returns
// a JavaScript value if the text is a valid JSON text.

            var j;

            function walk(holder, key) {

// The walk method is used to recursively walk the resulting structure so
// that modifications can be made.

                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }


// Parsing happens in four stages. In the first stage, we replace certain
// Unicode characters with escape sequences. JavaScript handles many characters
// incorrectly, either silently deleting them, or treating them as line endings.

            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' +
                        ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
                });
            }

// In the second stage, we run the text against regular expressions that look
// for non-JSON patterns. We are especially concerned with '()' and 'new'
// because they can cause invocation, and '=' because it can cause mutation.
// But just to be safe, we want to reject all unexpected forms.

// We split the second stage into 4 regexp operations in order to work around
// crippling inefficiencies in IE's and Safari's regexp engines. First we
// replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
// replace all simple value tokens with ']' characters. Third, we delete all
// open brackets that follow a colon or comma or that begin the text. Finally,
// we look to see that the remaining characters are only whitespace or ']' or
// ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.

            if (/^[\],:{}\s]*$/
                    .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                        .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
                        .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

// In the third stage we use the eval function to compile the text into a
// JavaScript structure. The '{' operator is subject to a syntactic ambiguity
// in JavaScript: it can begin a block or an object literal. We wrap the text
// in parens to eliminate the ambiguity.

                j = eval('(' + text + ')');

// In the optional fourth stage, we recursively walk the new structure, passing
// each name/value pair to a reviver function for possible transformation.

                return typeof reviver === 'function' ?
                    walk({'': j}, '') : j;
            }

// If the text is not JSON parseable, then a SyntaxError is thrown.

            throw new SyntaxError('JSON.parse');
        };
    }
}());

/*
 * ----------------------------- JSTORAGE ------------------------------------- */
(function(){var
JSTORAGE_VERSION="0.4.3",$=window.jQuery||window.$||(window.$={}),JSON={parse:window.JSON&&(window.JSON.parse||window.JSON.decode)||String.prototype.evalJSON&&function(str){return String(str).evalJSON();}||$.parseJSON||$.evalJSON,stringify:Object.toJSON||window.JSON&&(window.JSON.stringify||window.JSON.encode)||$.toJSON};if(!('parse'in JSON)||!('stringify'in JSON)){throw new Error("No JSON support found, include //cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js to page");}
var
_storage={__jstorage_meta:{CRC32:{}}},_storage_service={jStorage:"{}"},_storage_elm=null,_storage_size=0,_backend=false,_observers={},_observer_timeout=false,_observer_update=0,_pubsub_observers={},_pubsub_last=+new Date(),_ttl_timeout,_XMLService={isXML:function(elm){var documentElement=(elm?elm.ownerDocument||elm:0).documentElement;return documentElement?documentElement.nodeName!=="HTML":false;},encode:function(xmlNode){if(!this.isXML(xmlNode)){return false;}
try{return new XMLSerializer().serializeToString(xmlNode);}catch(E1){try{return xmlNode.xml;}catch(E2){}}
return false;},decode:function(xmlString){var dom_parser=("DOMParser"in window&&(new DOMParser()).parseFromString)||(window.ActiveXObject&&function(_xmlString){var xml_doc=new ActiveXObject('Microsoft.XMLDOM');xml_doc.async='false';xml_doc.loadXML(_xmlString);return xml_doc;}),resultXML;if(!dom_parser){return false;}
resultXML=dom_parser.call("DOMParser"in window&&(new DOMParser())||window,xmlString,'text/xml');return this.isXML(resultXML)?resultXML:false;}};function _init(){var localStorageReallyWorks=false;if("localStorage"in window){try{window.localStorage.setItem('_tmptest','tmpval');localStorageReallyWorks=true;window.localStorage.removeItem('_tmptest');}catch(BogusQuotaExceededErrorOnIos5){}}
if(localStorageReallyWorks){try{if(window.localStorage){_storage_service=window.localStorage;_backend="localStorage";_observer_update=_storage_service.jStorage_update;}}catch(E3){}}
else if("globalStorage"in window){try{if(window.globalStorage){if(window.location.hostname=='localhost'){_storage_service=window.globalStorage['localhost.localdomain'];}
else{_storage_service=window.globalStorage[window.location.hostname];}
_backend="globalStorage";_observer_update=_storage_service.jStorage_update;}}catch(E4){}}
else{_storage_elm=document.createElement('link');if(_storage_elm.addBehavior){_storage_elm.style.behavior='url(#default#userData)';document.getElementsByTagName('head')[0].appendChild(_storage_elm);try{_storage_elm.load("jStorage");}catch(E){_storage_elm.setAttribute("jStorage","{}");_storage_elm.save("jStorage");_storage_elm.load("jStorage");}
var data="{}";try{data=_storage_elm.getAttribute("jStorage");}catch(E5){}
try{_observer_update=_storage_elm.getAttribute("jStorage_update");}catch(E6){}
_storage_service.jStorage=data;_backend="userDataBehavior";}else{_storage_elm=null;return;}}
_load_storage();_handleTTL();_setupObserver();_handlePubSub();if("addEventListener"in window){window.addEventListener("pageshow",function(event){if(event.persisted){_storageObserver();}},false);}}
function _reloadData(){var data="{}";if(_backend=="userDataBehavior"){_storage_elm.load("jStorage");try{data=_storage_elm.getAttribute("jStorage");}catch(E5){}
try{_observer_update=_storage_elm.getAttribute("jStorage_update");}catch(E6){}
_storage_service.jStorage=data;}
_load_storage();_handleTTL();_handlePubSub();}
function _setupObserver(){if(_backend=="localStorage"||_backend=="globalStorage"){if("addEventListener"in window){window.addEventListener("storage",_storageObserver,false);}else{document.attachEvent("onstorage",_storageObserver);}}else if(_backend=="userDataBehavior"){setInterval(_storageObserver,1000);}}
function _storageObserver(){var updateTime;clearTimeout(_observer_timeout);_observer_timeout=setTimeout(function(){if(_backend=="localStorage"||_backend=="globalStorage"){updateTime=_storage_service.jStorage_update;}else if(_backend=="userDataBehavior"){_storage_elm.load("jStorage");try{updateTime=_storage_elm.getAttribute("jStorage_update");}catch(E5){}}
if(updateTime&&updateTime!=_observer_update){_observer_update=updateTime;_checkUpdatedKeys();}},25);}
function _checkUpdatedKeys(){var oldCrc32List=JSON.parse(JSON.stringify(_storage.__jstorage_meta.CRC32)),newCrc32List;_reloadData();newCrc32List=JSON.parse(JSON.stringify(_storage.__jstorage_meta.CRC32));var key,updated=[],removed=[];for(key in oldCrc32List){if(oldCrc32List.hasOwnProperty(key)){if(!newCrc32List[key]){removed.push(key);continue;}
if(oldCrc32List[key]!=newCrc32List[key]&&String(oldCrc32List[key]).substr(0,2)=="2."){updated.push(key);}}}
for(key in newCrc32List){if(newCrc32List.hasOwnProperty(key)){if(!oldCrc32List[key]){updated.push(key);}}}
_fireObservers(updated,"updated");_fireObservers(removed,"deleted");}
function _fireObservers(keys,action){keys=[].concat(keys||[]);if(action=="flushed"){keys=[];for(var key in _observers){if(_observers.hasOwnProperty(key)){keys.push(key);}}
action="deleted";}
for(var i=0,len=keys.length;i<len;i++){if(_observers[keys[i]]){for(var j=0,jlen=_observers[keys[i]].length;j<jlen;j++){_observers[keys[i]][j](keys[i],action);}}
if(_observers["*"]){for(var j=0,jlen=_observers["*"].length;j<jlen;j++){_observers["*"][j](keys[i],action);}}}}
function _publishChange(){var updateTime=(+new Date()).toString();if(_backend=="localStorage"||_backend=="globalStorage"){_storage_service.jStorage_update=updateTime;}else if(_backend=="userDataBehavior"){_storage_elm.setAttribute("jStorage_update",updateTime);_storage_elm.save("jStorage");}
_storageObserver();}
function _load_storage(){if(_storage_service.jStorage){try{_storage=JSON.parse(String(_storage_service.jStorage));}catch(E6){_storage_service.jStorage="{}";}}else{_storage_service.jStorage="{}";}
_storage_size=_storage_service.jStorage?String(_storage_service.jStorage).length:0;if(!_storage.__jstorage_meta){_storage.__jstorage_meta={};}
if(!_storage.__jstorage_meta.CRC32){_storage.__jstorage_meta.CRC32={};}}
function _save(){_dropOldEvents();try{_storage_service.jStorage=JSON.stringify(_storage);if(_storage_elm){_storage_elm.setAttribute("jStorage",_storage_service.jStorage);_storage_elm.save("jStorage");}
_storage_size=_storage_service.jStorage?String(_storage_service.jStorage).length:0;}catch(E7){}}
function _checkKey(key){if(!key||(typeof key!="string"&&typeof key!="number")){throw new TypeError('Key name must be string or numeric');}
if(key=="__jstorage_meta"){throw new TypeError('Reserved key name');}
return true;}
function _handleTTL(){var curtime,i,TTL,CRC32,nextExpire=Infinity,changed=false,deleted=[];clearTimeout(_ttl_timeout);if(!_storage.__jstorage_meta||typeof _storage.__jstorage_meta.TTL!="object"){return;}
curtime=+new Date();TTL=_storage.__jstorage_meta.TTL;CRC32=_storage.__jstorage_meta.CRC32;for(i in TTL){if(TTL.hasOwnProperty(i)){if(TTL[i]<=curtime){delete TTL[i];delete CRC32[i];delete _storage[i];changed=true;deleted.push(i);}else if(TTL[i]<nextExpire){nextExpire=TTL[i];}}}
if(nextExpire!=Infinity){_ttl_timeout=setTimeout(_handleTTL,nextExpire-curtime);}
if(changed){_save();_publishChange();_fireObservers(deleted,"deleted");}}
function _handlePubSub(){var i,len;if(!_storage.__jstorage_meta.PubSub){return;}
var pubelm,_pubsubCurrent=_pubsub_last;for(i=len=_storage.__jstorage_meta.PubSub.length-1;i>=0;i--){pubelm=_storage.__jstorage_meta.PubSub[i];if(pubelm[0]>_pubsub_last){_pubsubCurrent=pubelm[0];_fireSubscribers(pubelm[1],pubelm[2]);}}
_pubsub_last=_pubsubCurrent;}
function _fireSubscribers(channel,payload){if(_pubsub_observers[channel]){for(var i=0,len=_pubsub_observers[channel].length;i<len;i++){_pubsub_observers[channel][i](channel,JSON.parse(JSON.stringify(payload)));}}}
function _dropOldEvents(){if(!_storage.__jstorage_meta.PubSub){return;}
var retire=+new Date()-2000;for(var i=0,len=_storage.__jstorage_meta.PubSub.length;i<len;i++){if(_storage.__jstorage_meta.PubSub[i][0]<=retire){_storage.__jstorage_meta.PubSub.splice(i,_storage.__jstorage_meta.PubSub.length-i);break;}}
if(!_storage.__jstorage_meta.PubSub.length){delete _storage.__jstorage_meta.PubSub;}}
function _publish(channel,payload){if(!_storage.__jstorage_meta){_storage.__jstorage_meta={};}
if(!_storage.__jstorage_meta.PubSub){_storage.__jstorage_meta.PubSub=[];}
_storage.__jstorage_meta.PubSub.unshift([+new Date,channel,payload]);_save();_publishChange();}
function murmurhash2_32_gc(str,seed){var
l=str.length,h=seed^l,i=0,k;while(l>=4){k=((str.charCodeAt(i)&0xff))|((str.charCodeAt(++i)&0xff)<<8)|((str.charCodeAt(++i)&0xff)<<16)|((str.charCodeAt(++i)&0xff)<<24);k=(((k&0xffff)*0x5bd1e995)+((((k>>>16)*0x5bd1e995)&0xffff)<<16));k^=k>>>24;k=(((k&0xffff)*0x5bd1e995)+((((k>>>16)*0x5bd1e995)&0xffff)<<16));h=(((h&0xffff)*0x5bd1e995)+((((h>>>16)*0x5bd1e995)&0xffff)<<16))^k;l-=4;++i;}
switch(l){case 3:h^=(str.charCodeAt(i+2)&0xff)<<16;case 2:h^=(str.charCodeAt(i+1)&0xff)<<8;case 1:h^=(str.charCodeAt(i)&0xff);h=(((h&0xffff)*0x5bd1e995)+((((h>>>16)*0x5bd1e995)&0xffff)<<16));}
h^=h>>>13;h=(((h&0xffff)*0x5bd1e995)+((((h>>>16)*0x5bd1e995)&0xffff)<<16));h^=h>>>15;return h>>>0;}
$.jStorage={version:JSTORAGE_VERSION,set:function(key,value,options){_checkKey(key);options=options||{};if(typeof value=="undefined"){this.deleteKey(key);return value;}
if(_XMLService.isXML(value)){value={_is_xml:true,xml:_XMLService.encode(value)};}else if(typeof value=="function"){return undefined;}else if(value&&typeof value=="object"){value=JSON.parse(JSON.stringify(value));}
_storage[key]=value;_storage.__jstorage_meta.CRC32[key]="2."+murmurhash2_32_gc(JSON.stringify(value),0x9747b28c);this.setTTL(key,options.TTL||0);_fireObservers(key,"updated");return value;},get:function(key,def){_checkKey(key);if(key in _storage){if(_storage[key]&&typeof _storage[key]=="object"&&_storage[key]._is_xml){return _XMLService.decode(_storage[key].xml);}else{return _storage[key];}}
return typeof(def)=='undefined'?null:def;},deleteKey:function(key){_checkKey(key);if(key in _storage){delete _storage[key];if(typeof _storage.__jstorage_meta.TTL=="object"&&key in _storage.__jstorage_meta.TTL){delete _storage.__jstorage_meta.TTL[key];}
delete _storage.__jstorage_meta.CRC32[key];_save();_publishChange();_fireObservers(key,"deleted");return true;}
return false;},setTTL:function(key,ttl){var curtime=+new Date();_checkKey(key);ttl=Number(ttl)||0;if(key in _storage){if(!_storage.__jstorage_meta.TTL){_storage.__jstorage_meta.TTL={};}
if(ttl>0){_storage.__jstorage_meta.TTL[key]=curtime+ttl;}else{delete _storage.__jstorage_meta.TTL[key];}
_save();_handleTTL();_publishChange();return true;}
return false;},getTTL:function(key){var curtime=+new Date(),ttl;_checkKey(key);if(key in _storage&&_storage.__jstorage_meta.TTL&&_storage.__jstorage_meta.TTL[key]){ttl=_storage.__jstorage_meta.TTL[key]-curtime;return ttl||0;}
return 0;},flush:function(){_storage={__jstorage_meta:{CRC32:{}}};_save();_publishChange();_fireObservers(null,"flushed");return true;},storageObj:function(){function F(){}
F.prototype=_storage;return new F();},index:function(){var index=[],i;for(i in _storage){if(_storage.hasOwnProperty(i)&&i!="__jstorage_meta"){index.push(i);}}
return index;},storageSize:function(){return _storage_size;},currentBackend:function(){return _backend;},storageAvailable:function(){return!!_backend;},listenKeyChange:function(key,callback){_checkKey(key);if(!_observers[key]){_observers[key]=[];}
_observers[key].push(callback);},stopListening:function(key,callback){_checkKey(key);if(!_observers[key]){return;}
if(!callback){delete _observers[key];return;}
for(var i=_observers[key].length-1;i>=0;i--){if(_observers[key][i]==callback){_observers[key].splice(i,1);}}},subscribe:function(channel,callback){channel=(channel||"").toString();if(!channel){throw new TypeError('Channel not defined');}
if(!_pubsub_observers[channel]){_pubsub_observers[channel]=[];}
_pubsub_observers[channel].push(callback);},publish:function(channel,payload){channel=(channel||"").toString();if(!channel){throw new TypeError('Channel not defined');}
_publish(channel,payload);},reInit:function(){_reloadData();}};_init();})();
 
 jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});