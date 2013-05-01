/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
dhtmlx=function(obj){for (var a in obj)dhtmlx[a]=obj[a];return dhtmlx;};dhtmlx.extend_api=function(name,map,ext){var t = window[name];if (!t)return;window[name]=function(obj){if (obj && typeof obj == "object" && !obj.tagName){var that = t.apply(this,(map._init?map._init(obj):arguments));for (var a in dhtmlx)if (map[a])this[map[a]](dhtmlx[a]);for (var a in obj){if (map[a])this[map[a]](obj[a]);else if (a.indexOf("on")==0){this.attachEvent(a,obj[a]);}
 }
 }else
 var that = t.apply(this,arguments);if (map._patch)map._patch(this);return that||this;};window[name].prototype=t.prototype;if (ext)dhtmlXHeir(window[name].prototype,ext);};dhtmlxAjax={get:function(url,callback){var t=new dtmlXMLLoaderObject(true);t.async=(arguments.length<3);t.waitCall=callback;t.loadXML(url)
 return t;},
 post:function(url,post,callback){var t=new dtmlXMLLoaderObject(true);t.async=(arguments.length<4);t.waitCall=callback;t.loadXML(url,true,post)
 return t;},
 getSync:function(url){return this.get(url,null,true)
 },
 postSync:function(url,post){return this.post(url,post,null,true);}
}
function dtmlXMLLoaderObject(funcObject, dhtmlObject, async, rSeed){this.xmlDoc="";if (typeof (async)!= "undefined")
 this.async=async;else
 this.async=true;this.onloadAction=funcObject||null;this.mainObject=dhtmlObject||null;this.waitCall=null;this.rSeed=rSeed||false;return this;};dtmlXMLLoaderObject.count = 0;dtmlXMLLoaderObject.prototype.waitLoadFunction=function(dhtmlObject){var once = true;this.check=function (){if ((dhtmlObject)&&(dhtmlObject.onloadAction != null)){if ((!dhtmlObject.xmlDoc.readyState)||(dhtmlObject.xmlDoc.readyState == 4)){if (!once)return;once=false;dtmlXMLLoaderObject.count++;if (typeof dhtmlObject.onloadAction == "function")dhtmlObject.onloadAction(dhtmlObject.mainObject, null, null, null, dhtmlObject);if (dhtmlObject.waitCall){dhtmlObject.waitCall.call(this,dhtmlObject);dhtmlObject.waitCall=null;}
 }
 }
 };return this.check;};dtmlXMLLoaderObject.prototype.getXMLTopNode=function(tagName, oldObj){if (this.xmlDoc.responseXML){var temp = this.xmlDoc.responseXML.getElementsByTagName(tagName);if(temp.length==0 && tagName.indexOf(":")!=-1)
 var temp = this.xmlDoc.responseXML.getElementsByTagName((tagName.split(":"))[1]);var z = temp[0];}else
 var z = this.xmlDoc.documentElement;if (z){this._retry=false;return z;}
 if (!this._retry){this._retry=true;var oldObj = this.xmlDoc;this.loadXMLString(this.xmlDoc.responseText.replace(/^[\s]+/,""), true);return this.getXMLTopNode(tagName, oldObj);}
 dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (oldObj||this.xmlDoc),
 this.mainObject
 ]);return document.createElement("DIV");};dtmlXMLLoaderObject.prototype.loadXMLString=function(xmlString, silent){if (!_isIE){var parser = new DOMParser();this.xmlDoc=parser.parseFromString(xmlString, "text/xml");}else {this.xmlDoc=new ActiveXObject("Microsoft.XMLDOM");this.xmlDoc.async=this.async;this.xmlDoc.onreadystatechange = function(){};this.xmlDoc["loadXM"+"L"](xmlString);}
 
 if (silent)return;if (this.onloadAction)this.onloadAction(this.mainObject, null, null, null, this);if (this.waitCall){this.waitCall();this.waitCall=null;}
}
dtmlXMLLoaderObject.prototype.loadXML=function(filePath, postMode, postVars, rpc){if (this.rSeed)filePath+=((filePath.indexOf("?") != -1) ? "&" : "?")+"a_dhx_rSeed="+(new Date()).valueOf();this.filePath=filePath;if ((!_isIE)&&(window.XMLHttpRequest))
 this.xmlDoc=new XMLHttpRequest();else {this.xmlDoc=new ActiveXObject("Microsoft.XMLHTTP");}
 if (this.async)this.xmlDoc.onreadystatechange=new this.waitLoadFunction(this);this.xmlDoc.open(postMode ? "POST" : "GET", filePath, this.async);if (rpc){this.xmlDoc.setRequestHeader("User-Agent", "dhtmlxRPC v0.1 ("+navigator.userAgent+")");this.xmlDoc.setRequestHeader("Content-type", "text/xml");}
 else if (postMode)this.xmlDoc.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');this.xmlDoc.setRequestHeader("X-Requested-With","XMLHttpRequest");this.xmlDoc.send(null||postVars);if (!this.async)(new this.waitLoadFunction(this))();};dtmlXMLLoaderObject.prototype.destructor=function(){this._filterXPath = null;this._getAllNamedChilds = null;this._retry = null;this.async = null;this.rSeed = null;this.filePath = null;this.onloadAction = null;this.mainObject = null;this.xmlDoc = null;this.doXPath = null;this.doXPathOpera = null;this.doXSLTransToObject = null;this.doXSLTransToString = null;this.loadXML = null;this.loadXMLString = null;this.doSerialization = null;this.xmlNodeToJSON = null;this.getXMLTopNode = null;this.setXSLParamValue = null;return null;}
dtmlXMLLoaderObject.prototype.xmlNodeToJSON = function(node){var t={};for (var i=0;i<node.attributes.length;i++)t[node.attributes[i].name]=node.attributes[i].value;t["_tagvalue"]=node.firstChild?node.firstChild.nodeValue:"";for (var i=0;i<node.childNodes.length;i++){var name=node.childNodes[i].tagName;if (name){if (!t[name])t[name]=[];t[name].push(this.xmlNodeToJSON(node.childNodes[i]));}
 }
 return t;}
function callerFunction(funcObject, dhtmlObject){this.handler=function(e){if (!e)e=window.event;funcObject(e, dhtmlObject);return true;};return this.handler;};function getAbsoluteLeft(htmlObject){return getOffset(htmlObject).left;}
function getAbsoluteTop(htmlObject){return getOffset(htmlObject).top;}
function getOffsetSum(elem) {var top=0, left=0;while(elem){top = top + parseInt(elem.offsetTop);left = left + parseInt(elem.offsetLeft);elem = elem.offsetParent;}
 return {top: top, left: left};}
function getOffsetRect(elem) {var box = elem.getBoundingClientRect();var body = document.body;var docElem = document.documentElement;var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;var clientTop = docElem.clientTop || body.clientTop || 0;var clientLeft = docElem.clientLeft || body.clientLeft || 0;var top = box.top + scrollTop - clientTop;var left = box.left + scrollLeft - clientLeft;return {top: Math.round(top), left: Math.round(left) };}
function getOffset(elem) {if (elem.getBoundingClientRect){return getOffsetRect(elem);}else {return getOffsetSum(elem);}
}
function convertStringToBoolean(inputString){if (typeof (inputString)== "string")
 inputString=inputString.toLowerCase();switch (inputString){case "1":
 case "true":
 case "yes":
 case "y":
 case 1:
 case true:
 return true;break;default: return false;}
}
function getUrlSymbol(str){if (str.indexOf("?")!= -1)
 return "&"
 else
 return "?"
}
function dhtmlDragAndDropObject(){if (window.dhtmlDragAndDrop)return window.dhtmlDragAndDrop;this.lastLanding=0;this.dragNode=0;this.dragStartNode=0;this.dragStartObject=0;this.tempDOMU=null;this.tempDOMM=null;this.waitDrag=0;window.dhtmlDragAndDrop=this;return this;};dhtmlDragAndDropObject.prototype.removeDraggableItem=function(htmlNode){htmlNode.onmousedown=null;htmlNode.dragStarter=null;htmlNode.dragLanding=null;}
dhtmlDragAndDropObject.prototype.addDraggableItem=function(htmlNode, dhtmlObject){htmlNode.onmousedown=this.preCreateDragCopy;htmlNode.dragStarter=dhtmlObject;this.addDragLanding(htmlNode, dhtmlObject);}
dhtmlDragAndDropObject.prototype.addDragLanding=function(htmlNode, dhtmlObject){htmlNode.dragLanding=dhtmlObject;}
dhtmlDragAndDropObject.prototype.preCreateDragCopy=function(e){if ((e||window.event)&& (e||event).button == 2)
 return;if (window.dhtmlDragAndDrop.waitDrag){window.dhtmlDragAndDrop.waitDrag=0;document.body.onmouseup=window.dhtmlDragAndDrop.tempDOMU;document.body.onmousemove=window.dhtmlDragAndDrop.tempDOMM;return false;}
 
 if (window.dhtmlDragAndDrop.dragNode)window.dhtmlDragAndDrop.stopDrag(e);window.dhtmlDragAndDrop.waitDrag=1;window.dhtmlDragAndDrop.tempDOMU=document.body.onmouseup;window.dhtmlDragAndDrop.tempDOMM=document.body.onmousemove;window.dhtmlDragAndDrop.dragStartNode=this;window.dhtmlDragAndDrop.dragStartObject=this.dragStarter;document.body.onmouseup=window.dhtmlDragAndDrop.preCreateDragCopy;document.body.onmousemove=window.dhtmlDragAndDrop.callDrag;window.dhtmlDragAndDrop.downtime = new Date().valueOf();if ((e)&&(e.preventDefault)){e.preventDefault();return false;}
 return false;};dhtmlDragAndDropObject.prototype.callDrag=function(e){if (!e)e=window.event;dragger=window.dhtmlDragAndDrop;if ((new Date()).valueOf()-dragger.downtime<100) return;if (!dragger.dragNode){if (dragger.waitDrag){dragger.dragNode=dragger.dragStartObject._createDragNode(dragger.dragStartNode, e);if (!dragger.dragNode)return dragger.stopDrag();dragger.dragNode.onselectstart=function(){return false;}
 dragger.gldragNode=dragger.dragNode;document.body.appendChild(dragger.dragNode);document.body.onmouseup=dragger.stopDrag;dragger.waitDrag=0;dragger.dragNode.pWindow=window;dragger.initFrameRoute();}
 else return dragger.stopDrag(e, true);}
 if (dragger.dragNode.parentNode != window.document.body && dragger.gldragNode){var grd = dragger.gldragNode;if (dragger.gldragNode.old)grd=dragger.gldragNode.old;grd.parentNode.removeChild(grd);var oldBody = dragger.dragNode.pWindow;if (grd.pWindow && grd.pWindow.dhtmlDragAndDrop.lastLanding)grd.pWindow.dhtmlDragAndDrop.lastLanding.dragLanding._dragOut(grd.pWindow.dhtmlDragAndDrop.lastLanding);if (_isIE){var div = document.createElement("Div");div.innerHTML=dragger.dragNode.outerHTML;dragger.dragNode=div.childNodes[0];}else
 dragger.dragNode=dragger.dragNode.cloneNode(true);dragger.dragNode.pWindow=window;dragger.gldragNode.old=dragger.dragNode;document.body.appendChild(dragger.dragNode);oldBody.dhtmlDragAndDrop.dragNode=dragger.dragNode;}
 dragger.dragNode.style.left=e.clientX+15+(dragger.fx
 ? dragger.fx*(-1)
 : 0)
 +(document.body.scrollLeft||document.documentElement.scrollLeft)+"px";dragger.dragNode.style.top=e.clientY+3+(dragger.fy
 ? dragger.fy*(-1)
 : 0)
 +(document.body.scrollTop||document.documentElement.scrollTop)+"px";if (!e.srcElement)var z = e.target;else
 z=e.srcElement;dragger.checkLanding(z, e);}
dhtmlDragAndDropObject.prototype.calculateFramePosition=function(n){if (window.name){var el = parent.frames[window.name].frameElement.offsetParent;var fx = 0;var fy = 0;while (el){fx+=el.offsetLeft;fy+=el.offsetTop;el=el.offsetParent;}
 if ((parent.dhtmlDragAndDrop)){var ls = parent.dhtmlDragAndDrop.calculateFramePosition(1);fx+=ls.split('_')[0]*1;fy+=ls.split('_')[1]*1;}
 if (n)return fx+"_"+fy;else
 this.fx=fx;this.fy=fy;}
 return "0_0";}
dhtmlDragAndDropObject.prototype.checkLanding=function(htmlObject, e){if ((htmlObject)&&(htmlObject.dragLanding)){if (this.lastLanding)this.lastLanding.dragLanding._dragOut(this.lastLanding);this.lastLanding=htmlObject;this.lastLanding=this.lastLanding.dragLanding._dragIn(this.lastLanding, this.dragStartNode, e.clientX,
 e.clientY, e);this.lastLanding_scr=(_isIE ? e.srcElement : e.target);}else {if ((htmlObject)&&(htmlObject.tagName != "BODY"))
 this.checkLanding(htmlObject.parentNode, e);else {if (this.lastLanding)this.lastLanding.dragLanding._dragOut(this.lastLanding, e.clientX, e.clientY, e);this.lastLanding=0;if (this._onNotFound)this._onNotFound();}
 }
}
dhtmlDragAndDropObject.prototype.stopDrag=function(e, mode){dragger=window.dhtmlDragAndDrop;if (!mode){dragger.stopFrameRoute();var temp = dragger.lastLanding;dragger.lastLanding=null;if (temp)temp.dragLanding._drag(dragger.dragStartNode, dragger.dragStartObject, temp, (_isIE
 ? event.srcElement
 : e.target));}
 dragger.lastLanding=null;if ((dragger.dragNode)&&(dragger.dragNode.parentNode == document.body))
 dragger.dragNode.parentNode.removeChild(dragger.dragNode);dragger.dragNode=0;dragger.gldragNode=0;dragger.fx=0;dragger.fy=0;dragger.dragStartNode=0;dragger.dragStartObject=0;document.body.onmouseup=dragger.tempDOMU;document.body.onmousemove=dragger.tempDOMM;dragger.tempDOMU=null;dragger.tempDOMM=null;dragger.waitDrag=0;}
dhtmlDragAndDropObject.prototype.stopFrameRoute=function(win){if (win)window.dhtmlDragAndDrop.stopDrag(1, 1);for (var i = 0;i < window.frames.length;i++){try{if ((window.frames[i] != win)&&(window.frames[i].dhtmlDragAndDrop))
 window.frames[i].dhtmlDragAndDrop.stopFrameRoute(window);}catch(e){}
 }
 try{if ((parent.dhtmlDragAndDrop)&&(parent != window)&&(parent != win))
 parent.dhtmlDragAndDrop.stopFrameRoute(window);}catch(e){}
}
dhtmlDragAndDropObject.prototype.initFrameRoute=function(win, mode){if (win){window.dhtmlDragAndDrop.preCreateDragCopy();window.dhtmlDragAndDrop.dragStartNode=win.dhtmlDragAndDrop.dragStartNode;window.dhtmlDragAndDrop.dragStartObject=win.dhtmlDragAndDrop.dragStartObject;window.dhtmlDragAndDrop.dragNode=win.dhtmlDragAndDrop.dragNode;window.dhtmlDragAndDrop.gldragNode=win.dhtmlDragAndDrop.dragNode;window.document.body.onmouseup=window.dhtmlDragAndDrop.stopDrag;window.waitDrag=0;if (((!_isIE)&&(mode))&&((!_isFF)||(_FFrv < 1.8)))
 window.dhtmlDragAndDrop.calculateFramePosition();}
 try{if ((parent.dhtmlDragAndDrop)&&(parent != window)&&(parent != win))
 parent.dhtmlDragAndDrop.initFrameRoute(window);}catch(e){}
 for (var i = 0;i < window.frames.length;i++){try{if ((window.frames[i] != win)&&(window.frames[i].dhtmlDragAndDrop))
 window.frames[i].dhtmlDragAndDrop.initFrameRoute(window, ((!win||mode) ? 1 : 0));}catch(e){}
 }
}
 _isFF = false;_isIE = false;_isOpera = false;_isKHTML = false;_isMacOS = false;_isChrome = false;_FFrv = false;_KHTMLrv = false;_OperaRv = false;if (navigator.userAgent.indexOf('Macintosh')!= -1)
 _isMacOS=true;if (navigator.userAgent.toLowerCase().indexOf('chrome')>-1)
 _isChrome=true;if ((navigator.userAgent.indexOf('Safari')!= -1)||(navigator.userAgent.indexOf('Konqueror') != -1)){_KHTMLrv = parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf('Safari')+7, 5));if (_KHTMLrv > 525){_isFF=true;_FFrv = 1.9;}else
 _isKHTML=true;}else if (navigator.userAgent.indexOf('Opera')!= -1){_isOpera=true;_OperaRv=parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf('Opera')+6, 3));}
else if (navigator.appName.indexOf("Microsoft")!= -1){_isIE=true;if ((navigator.appVersion.indexOf("MSIE 8.0")!= -1 || navigator.appVersion.indexOf("MSIE 9.0")!= -1 || navigator.appVersion.indexOf("MSIE 10.0")!= -1 ) && document.compatMode != "BackCompat"){_isIE=8;}
}else {_isFF=true;_FFrv = parseFloat(navigator.userAgent.split("rv:")[1])
}
dtmlXMLLoaderObject.prototype.doXPath=function(xpathExp, docObj, namespace, result_type){if (_isKHTML || (!_isIE && !window.XPathResult))
 return this.doXPathOpera(xpathExp, docObj);if (_isIE){if (!docObj)if (!this.xmlDoc.nodeName)docObj=this.xmlDoc.responseXML
 else
 docObj=this.xmlDoc;if (!docObj)dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (docObj||this.xmlDoc),
 this.mainObject
 ]);if (namespace != null)docObj.setProperty("SelectionNamespaces", "xmlns:xsl='"+namespace+"'");if (result_type == 'single'){return docObj.selectSingleNode(xpathExp);}
 else {return docObj.selectNodes(xpathExp)||new Array(0);}
 }else {var nodeObj = docObj;if (!docObj){if (!this.xmlDoc.nodeName){docObj=this.xmlDoc.responseXML
 }
 else {docObj=this.xmlDoc;}
 }
 if (!docObj)dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (docObj||this.xmlDoc),
 this.mainObject
 ]);if (docObj.nodeName.indexOf("document")!= -1){nodeObj=docObj;}
 else {nodeObj=docObj;docObj=docObj.ownerDocument;}
 var retType = XPathResult.ANY_TYPE;if (result_type == 'single')retType=XPathResult.FIRST_ORDERED_NODE_TYPE
 var rowsCol = new Array();var col = docObj.evaluate(xpathExp, nodeObj, function(pref){return namespace
 }, retType, null);if (retType == XPathResult.FIRST_ORDERED_NODE_TYPE){return col.singleNodeValue;}
 var thisColMemb = col.iterateNext();while (thisColMemb){rowsCol[rowsCol.length]=thisColMemb;thisColMemb=col.iterateNext();}
 return rowsCol;}
}
function _dhtmlxError(type, name, params){if (!this.catches)this.catches=new Array();return this;}
_dhtmlxError.prototype.catchError=function(type, func_name){this.catches[type]=func_name;}
_dhtmlxError.prototype.throwError=function(type, name, params){if (this.catches[type])return this.catches[type](type, name, params);if (this.catches["ALL"])return this.catches["ALL"](type, name, params);alert("Error type: "+arguments[0]+"\nDescription: "+arguments[1]);return null;}
window.dhtmlxError=new _dhtmlxError();dtmlXMLLoaderObject.prototype.doXPathOpera=function(xpathExp, docObj){var z = xpathExp.replace(/[\/]+/gi, "/").split('/');var obj = null;var i = 1;if (!z.length)return [];if (z[0] == ".")obj=[docObj];else if (z[0] == ""){obj=(this.xmlDoc.responseXML||this.xmlDoc).getElementsByTagName(z[i].replace(/\[[^\]]*\]/g, ""));i++;}else
 return [];for (i;i < z.length;i++)obj=this._getAllNamedChilds(obj, z[i]);if (z[i-1].indexOf("[")!= -1)
 obj=this._filterXPath(obj, z[i-1]);return obj;}
dtmlXMLLoaderObject.prototype._filterXPath=function(a, b){var c = new Array();var b = b.replace(/[^\[]*\[\@/g, "").replace(/[\[\]\@]*/g, "");for (var i = 0;i < a.length;i++)if (a[i].getAttribute(b))
 c[c.length]=a[i];return c;}
dtmlXMLLoaderObject.prototype._getAllNamedChilds=function(a, b){var c = new Array();if (_isKHTML)b=b.toUpperCase();for (var i = 0;i < a.length;i++)for (var j = 0;j < a[i].childNodes.length;j++){if (_isKHTML){if (a[i].childNodes[j].tagName&&a[i].childNodes[j].tagName.toUpperCase()== b)
 c[c.length]=a[i].childNodes[j];}
 else if (a[i].childNodes[j].tagName == b)c[c.length]=a[i].childNodes[j];}
 return c;}
function dhtmlXHeir(a, b){for (var c in b)if (typeof (b[c])== "function")
 a[c]=b[c];return a;}
function dhtmlxEvent(el, event, handler){if (el.addEventListener)el.addEventListener(event, handler, false);else if (el.attachEvent)el.attachEvent("on"+event, handler);}
dtmlXMLLoaderObject.prototype.xslDoc=null;dtmlXMLLoaderObject.prototype.setXSLParamValue=function(paramName, paramValue, xslDoc){if (!xslDoc)xslDoc=this.xslDoc

 if (xslDoc.responseXML)xslDoc=xslDoc.responseXML;var item =
 this.doXPath("/xsl:stylesheet/xsl:variable[@name='"+paramName+"']", xslDoc,
 "http:/\/www.w3.org/1999/XSL/Transform", "single");if (item != null)item.firstChild.nodeValue=paramValue
}
dtmlXMLLoaderObject.prototype.doXSLTransToObject=function(xslDoc, xmlDoc){if (!xslDoc)xslDoc=this.xslDoc;if (xslDoc.responseXML)xslDoc=xslDoc.responseXML

 if (!xmlDoc)xmlDoc=this.xmlDoc;if (xmlDoc.responseXML)xmlDoc=xmlDoc.responseXML

 
 if (!_isIE){if (!this.XSLProcessor){this.XSLProcessor=new XSLTProcessor();this.XSLProcessor.importStylesheet(xslDoc);}
 var result = this.XSLProcessor.transformToDocument(xmlDoc);}else {var result = new ActiveXObject("Msxml2.DOMDocument.3.0");try{xmlDoc.transformNodeToObject(xslDoc, result);}catch(e){result = xmlDoc.transformNode(xslDoc);}
 }
 return result;}
dtmlXMLLoaderObject.prototype.doXSLTransToString=function(xslDoc, xmlDoc){var res = this.doXSLTransToObject(xslDoc, xmlDoc);if(typeof(res)=="string")
 return res;return this.doSerialization(res);}
dtmlXMLLoaderObject.prototype.doSerialization=function(xmlDoc){if (!xmlDoc)xmlDoc=this.xmlDoc;if (xmlDoc.responseXML)xmlDoc=xmlDoc.responseXML
 if (!_isIE){var xmlSerializer = new XMLSerializer();return xmlSerializer.serializeToString(xmlDoc);}else
 return xmlDoc.xml;}
dhtmlxEventable=function(obj){obj.attachEvent=function(name, catcher, callObj){name='ev_'+name.toLowerCase();if (!this[name])this[name]=new this.eventCatcher(callObj||this);return(name+':'+this[name].addEvent(catcher));}
 obj.callEvent=function(name, arg0){name='ev_'+name.toLowerCase();if (this[name])return this[name].apply(this, arg0);return true;}
 obj.checkEvent=function(name){return (!!this['ev_'+name.toLowerCase()])
 }
 obj.eventCatcher=function(obj){var dhx_catch = [];var z = function(){var res = true;for (var i = 0;i < dhx_catch.length;i++){if (dhx_catch[i] != null){var zr = dhx_catch[i].apply(obj, arguments);res=res&&zr;}
 }
 return res;}
 z.addEvent=function(ev){if (typeof (ev)!= "function")
 ev=eval(ev);if (ev)return dhx_catch.push(ev)-1;return false;}
 z.removeEvent=function(id){dhx_catch[id]=null;}
 return z;}
 obj.detachEvent=function(id){if (id != false){var list = id.split(':');this[list[0]].removeEvent(list[1]);}
 }
 obj.detachAllEvents = function(){for (var name in this){if (name.indexOf("ev_")==0) 
 delete this[name];}
 }
 obj = null;};if(!window.dhtmlx)window.dhtmlx = {};(function(){var _dhx_msg_cfg = null;function callback(config, result){var usercall = config.callback;modality(false);config.box.parentNode.removeChild(config.box);_dhx_msg_cfg = config.box = null;if (usercall)usercall(result);}
 function modal_key(e){if (_dhx_msg_cfg){e = e||event;var code = e.which||event.keyCode;if (dhtmlx.message.keyboard){if (code == 13 || code == 32)callback(_dhx_msg_cfg, true);if (code == 27)callback(_dhx_msg_cfg, false);}
 if (e.preventDefault)e.preventDefault();return !(e.cancelBubble = true);}
 }
 if (document.attachEvent)document.attachEvent("onkeydown", modal_key);else
 document.addEventListener("keydown", modal_key, true);function modality(mode){if(!modality.cover){modality.cover = document.createElement("DIV");modality.cover.onkeydown = modal_key;modality.cover.className = "dhx_modal_cover";document.body.appendChild(modality.cover);}
 var height = document.body.scrollHeight;modality.cover.style.display = mode?"inline-block":"none";}
 function button(text, result){return "<div class='dhtmlx_popup_button' result='"+result+"' ><div>"+text+"</div></div>";}
 function info(text){if (!t.area){t.area = document.createElement("DIV");t.area.className = "dhtmlx_message_area";t.area.style[t.position]="5px";document.body.appendChild(t.area);}
 t.hide(text.id);var message = document.createElement("DIV");message.innerHTML = "<div>"+text.text+"</div>";message.className = "dhtmlx-info dhtmlx-" + text.type;message.onclick = function(){t.hide(text.id);text = null;};if (t.position == "bottom" && t.area.firstChild)t.area.insertBefore(message,t.area.firstChild);else
 t.area.appendChild(message);if (text.expire > 0)t.timers[text.id]=window.setTimeout(function(){t.hide(text.id);}, text.expire);t.pull[text.id] = message;message = null;return text.id;}
 function _boxStructure(config, ok, cancel){var box = document.createElement("DIV");box.className = " dhtmlx_modal_box dhtmlx-"+config.type;box.setAttribute("dhxbox", 1);var inner = '';if (config.width)box.style.width = config.width;if (config.height)box.style.height = config.height;if (config.title)inner+='<div class="dhtmlx_popup_title">'+config.title+'</div>';inner+='<div class="dhtmlx_popup_text"><span>'+(config.content?'':config.text)+'</span></div><div class="dhtmlx_popup_controls">';if (ok)inner += button(config.ok || "OK", true);if (cancel)inner += button(config.cancel || "Cancel", false);if (config.buttons){for (var i=0;i<config.buttons.length;i++)inner += button(config.buttons[i],i);}
 inner += '</div>';box.innerHTML = inner;if (config.content){var node = config.content;if (typeof node == "string")node = document.getElementById(node);if (node.style.display == 'none')node.style.display = "";box.childNodes[config.title?1:0].appendChild(node);}
 box.onclick = function(e){e = e ||event;var source = e.target || e.srcElement;if (!source.className)source = source.parentNode;if (source.className == "dhtmlx_popup_button"){result = source.getAttribute("result");result = (result == "true")||(result == "false"?false:result);callback(config, result);}
 };config.box = box;if (ok||cancel)_dhx_msg_cfg = config;return box;}
 function _createBox(config, ok, cancel){var box = config.tagName ? config : _boxStructure(config, ok, cancel);if (!config.hidden)modality(true);document.body.appendChild(box);var x = Math.abs(Math.floor(((window.innerWidth||document.documentElement.offsetWidth) - box.offsetWidth)/2));var y = Math.abs(Math.floor(((window.innerHeight||document.documentElement.offsetHeight) - box.offsetHeight)/2));if (config.position == "top")box.style.top = "-3px";else
 box.style.top = y+'px';box.style.left = x+'px';box.onkeydown = modal_key;box.focus();if (config.hidden)dhtmlx.modalbox.hide(box);return box;}
 function alertPopup(config){return _createBox(config, true, false);}
 function confirmPopup(config){return _createBox(config, true, true);}
 function boxPopup(config){return _createBox(config);}
 function box_params(text, type, callback){if (typeof text != "object"){if (typeof type == "function"){callback = type;type = "";}
 text = {text:text, type:type, callback:callback };}
 return text;}
 function params(text, type, expire, id){if (typeof text != "object")text = {text:text, type:type, expire:expire, id:id};text.id = text.id||t.uid();text.expire = text.expire||t.expire;return text;}
 dhtmlx.alert = function(){text = box_params.apply(this, arguments);text.type = text.type || "confirm";return alertPopup(text);};dhtmlx.confirm = function(){text = box_params.apply(this, arguments);text.type = text.type || "alert";return confirmPopup(text);};dhtmlx.modalbox = function(){text = box_params.apply(this, arguments);text.type = text.type || "alert";return boxPopup(text);};dhtmlx.modalbox.hide = function(node){while (node && node.getAttribute && !node.getAttribute("dhxbox"))
 node = node.parentNode;if (node){node.parentNode.removeChild(node);modality(false);}
 };var t = dhtmlx.message = function(text, type, expire, id){text = params.apply(this, arguments);text.type = text.type||"info";var subtype = text.type.split("-")[0];switch (subtype){case "alert":
 return alertPopup(text);case "confirm":
 return confirmPopup(text);case "modalbox":
 return boxPopup(text);default:
 return info(text);break;}
 };t.seed = (new Date()).valueOf();t.uid = function(){return t.seed++;};t.expire = 4000;t.keyboard = true;t.position = "top";t.pull = {};t.timers = {};t.hideAll = function(){for (var key in t.pull)t.hide(key);};t.hide = function(id){var obj = t.pull[id];if (obj && obj.parentNode){window.setTimeout(function(){obj.parentNode.removeChild(obj);obj = null;},2000);obj.className+=" hidden";if(t.timers[id])window.clearTimeout(t.timers[id]);delete t.pull[id];}
 };})();function dhtmlXCalendarObject(inps, skin) {this.i = {};this.uid = function() {if (!this.uidd)this.uidd = new Date().getTime();return this.uidd++;}
 
 var p = null;if (typeof(inps)== "string") {var t0 = document.getElementById(inps);}else {var t0 = inps;}
 if (t0 && typeof(t0)== "object" && t0.tagName && String(t0.tagName).toLowerCase() != "input") p = t0;t0 = null;if (typeof(inps)!= "object" || !inps.length) inps = [inps];for (var q=0;q<inps.length;q++){if (typeof(inps[q])== "string") inps[q] = (document.getElementById(inps[q])||null);if (inps[q] != null && inps[q].tagName && String(inps[q].tagName).toLowerCase() == "input") {this.i[this.uid()] = inps[q];}
 inps[q] = null;}
 
 this.skin = (skin != null ? skin : (typeof(dhtmlx) != "undefined" && typeof(dhtmlx.skin) == "string" ? dhtmlx.skin : "dhx_skyblue"));this.setSkin = function(skin){this.skin = skin;this.base.className = "dhtmlxcalendar_container dhtmlxcalendar_skin_"+this.skin;this._ifrSize();}
 
 
 this.base = document.createElement("DIV");this.base.className = "dhtmlxcalendar_container";this.base.style.display = "none";if (p != null){this._hasParent = true;p.appendChild(this.base);p = null;}else {document.body.appendChild(this.base);}
 
 this.setParent = function(p) {if (this._hasParent){if (typeof(p)== "object") {p.appendChild(this.base);}else if (typeof(p)== "string") {document.getElementById(p).appendChild(this.base);}
 }
 }
 
 this.setSkin(this.skin);this.base.onclick = function(e) {e = e||event;e.cancelBubble = true;}
 
 this.loadUserLanguage = function(lang) {if (!this.langData[lang])return;this.lang = lang;this.setWeekStartDay(this.langData[this.lang].weekstart);if (this.msCont){var e = 0;for (var q=0;q<this.msCont.childNodes.length;q++){for (var w=0;w<this.msCont.childNodes[q].childNodes.length;w++){this.msCont.childNodes[q].childNodes[w].innerHTML = this.langData[this.lang].monthesSNames[e++];}
 }
 }
 }
 
 
 this.contMonth = document.createElement("DIV");this.contMonth.className = "dhtmlxcalendar_month_cont";this.contMonth.onselectstart = function(e){e=e||event;e.cancelBubble=true;e.returnValue=false;return false;}
 this.base.appendChild(this.contMonth);var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_line";this.contMonth.appendChild(ul);var li = document.createElement("LI");li.className = "dhtmlxcalendar_cell dhtmlxcalendar_month_hdr";li.innerHTML = "<div class='dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_left' onmouseover='this.className=\"dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_left_hover\";' onmouseout='this.className=\"dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_left\";'></div>"+
 "<span class='dhtmlxcalendar_month_label_month'>Month</span><span class='dhtmlxcalendar_month_label_year'>Year</span>"+
 "<div class='dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_right' onmouseover='this.className=\"dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_right_hover\";' onmouseout='this.className=\"dhtmlxcalendar_month_arrow dhtmlxcalendar_month_arrow_right\";'></div>";ul.appendChild(li);var that = this;li.onclick = function(e) {e = e||event;var t = (e.target||e.srcElement);if (t.className && t.className.indexOf("dhtmlxcalendar_month_arrow")=== 0) {that._hideSelector();var ind = (t.parentNode.firstChild==t?-1:1);var k0 = new Date(that._activeMonth);that._drawMonth(new Date(that._activeMonth.getFullYear(), that._activeMonth.getMonth()+ind, 1, 0, 0, 0, 0));that.callEvent("onArrowClick", [k0, new Date(that._activeMonth)]);return;}
 
 if (t.className && t.className == "dhtmlxcalendar_month_label_month"){e.cancelBubble = true;that._showSelector("month",31,21,"selector_month",true);return;}
 
 if (t.className && t.className == "dhtmlxcalendar_month_label_year"){e.cancelBubble = true;that._showSelector("year",42,21,"selector_year",true);return;}
 
 that._hideSelector();}
 
 
 this.contDays = document.createElement("DIV");this.contDays.className = "dhtmlxcalendar_days_cont";this.base.appendChild(this.contDays);this.setWeekStartDay = function(ind) {if (ind == 0)ind = 7;this._wStart = Math.min(Math.max((isNaN(ind)?1:ind),1),7);this._drawDaysOfWeek();}
 
 this._drawDaysOfWeek = function() {if (this.contDays.childNodes.length == 0){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_line";this.contDays.appendChild(ul);}else {var ul = this.contDays.firstChild;}
 
 var w = this._wStart;var k = this.langData[this.lang].daysSNames;k.push(String(this.langData[this.lang].daysSNames[0]).valueOf());for (var q=0;q<7;q++){if (ul.childNodes[q] == null){var li = document.createElement("LI");ul.appendChild(li);}else {var li = ul.childNodes[q];}
 li.className = "dhtmlxcalendar_cell"+(w>=6?" dhtmlxcalendar_day_weekday_cell":"")+(q==0?"_first":"");li.innerHTML = k[w];if (++w > 7)w = 1;}
 if (this._activeMonth != null)this._drawMonth(this._activeMonth);}
 
 this._wStart = this.langData[this.lang].weekstart;this.setWeekStartDay(this._wStart);this.contDates = document.createElement("DIV");this.contDates.className = "dhtmlxcalendar_dates_cont";this.base.appendChild(this.contDates);this.contDates.onclick = function(e){e = e||event;var t = (e.target||e.srcElement);if (t._date != null && !t._css_dis){var t1 = that._activeDate.getHours();var t2 = that._activeDate.getMinutes();var d0 = t._date;if (that.checkEvent("onBeforeChange")) {if (!that.callEvent("onBeforeChange",[new Date(t._date.getFullYear(),t._date.getMonth(),t._date.getDate(),t1,t2)])) return;}
 
 if (that._activeDateCell != null){that._activeDateCell._css_date = false;that._updateCellStyle(that._activeDateCell._q, that._activeDateCell._w);}
 
 
 var refreshView = (that._hasParent && that._activeDate.getFullYear()+"_"+that._activeDate.getMonth() != d0.getFullYear()+"_"+d0.getMonth());that._nullDate = false;that._activeDate = new Date(d0.getFullYear(),d0.getMonth(),d0.getDate(),t1,t2);that._activeDateCell = t;that._activeDateCell._css_date = true;that._activeDateCell._css_hover = false;that._lastHover = null;that._updateCellStyle(that._activeDateCell._q, that._activeDateCell._w);if (refreshView)that._drawMonth(that._activeDate);if (that._activeInp && that.i[that._activeInp]){that.i[that._activeInp].value = that._dateToStr(new Date(that._activeDate.getTime()));}
 
 if (!that._hasParent)that._hide();that.callEvent("onClick",[new Date(that._activeDate.getTime())]);}
 }
 
 this.contDates.onmouseover = function(e) {e = e||event;var t = (e.target||e.srcElement);if (t._date != null){t._css_hover = true;that._updateCellStyle(t._q, t._w);that._lastHover = t;}
 }
 this.contDates.onmouseout = function() {that._clearDayHover();}
 
 this._lastHover = null;this._clearDayHover = function() {if (!this._lastHover)return;this._lastHover._css_hover = false;this._updateCellStyle(this._lastHover._q, this._lastHover._w);this._lastHover = null;}
 
 
 for (var q=0;q<6;q++){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_line";this.contDates.appendChild(ul);for (var w=0;w<7;w++){var li = document.createElement("LI");li.className = "dhtmlxcalendar_cell";ul.appendChild(li);}
 }
 
 
 
 
 this.contTime = document.createElement("DIV");this.contTime.className = "dhtmlxcalendar_time_cont";this.base.appendChild(this.contTime);this.showTime = function() {if (String(this.base.className).search("dhtmlxcalendar_time_hidden") > 0) this.base.className = String(this.base.className).replace(/dhtmlxcalendar_time_hidden/gi,"");this._ifrSize();}
 
 this.hideTime = function() {if (String(this.base.className).search("dhtmlxcalendar_time_hidden") < 0) this.base.className += " dhtmlxcalendar_time_hidden";this._ifrSize();}
 
 var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_line";this.contTime.appendChild(ul);var li = document.createElement("LI");li.className = "dhtmlxcalendar_cell dhtmlxcalendar_time_hdr";li.innerHTML = "<div class='dhtmlxcalendar_time_label'></div><span class='dhtmlxcalendar_label_hours'></span><span class='dhtmlxcalendar_label_colon'>:</span><span class='dhtmlxcalendar_label_minutes'></span>";ul.appendChild(li);li.onclick = function(e) {e = e||event;var t = (e.target||e.srcElement);if (t.className && t.className == "dhtmlxcalendar_label_hours"){e.cancelBubble = true;that._showSelector("hours",3,115,"selector_hours",true);return;}
 
 if (t.className && t.className == "dhtmlxcalendar_label_minutes"){e.cancelBubble = true;that._showSelector("minutes",59,115,"selector_minutes",true);return;}
 
 that._hideSelector();}
 
 
 this._activeMonth = null;this._activeDate = new Date();this._activeDateCell = null;this.setDate = function(d) {this._nullDate = (typeof(d) == "undefined" || d === "" || !d);if (!(d instanceof Date)) {d = this._strToDate(String(d||""));if (d == "Invalid Date")d = new Date();}
 
 var time = d.getTime();if (this._isOutOfRange(time)) return;this._activeDate = new Date(time);this._drawMonth(this._nullDate?new Date():this._activeDate);this._updateVisibleHours();this._updateVisibleMinutes();}
 
 this.getDate = function(formated) {if (this._nullDate)return null;var t = new Date(this._activeDate.getTime());if (formated)return this._dateToStr(t);return t;}
 
 this._drawMonth = function(d) {if (!(d instanceof Date)) return;if (isNaN(d.getFullYear())) d = new Date(this._activeMonth.getFullYear(), this._activeMonth.getMonth(), 1, 0, 0, 0, 0);this._activeMonth = new Date(d.getFullYear(), d.getMonth(), 1, 0, 0, 0, 0);this._activeDateCell = null;var first = new Date(this._activeMonth.getTime());var d0 = first.getDay();var e0 = d0-this._wStart;if (e0 < 0)e0 = e0+7;first.setDate(first.getDate()-e0);var mx = d.getMonth();var dx = new Date(this._activeDate.getFullYear(), this._activeDate.getMonth(), this._activeDate.getDate(), 0, 0, 0, 0).getTime();var i = 0;for (var q=0;q<6;q++){var ws = this._wStart;for (var w=0;w<7;w++){var d2 = new Date(first.getFullYear(), first.getMonth(), first.getDate()+i++, 0, 0, 0, 0);this.contDates.childNodes[q].childNodes[w].innerHTML = d2.getDate();var day = d2.getDay();var time = d2.getTime();this.contDates.childNodes[q].childNodes[w]._date = new Date(time);this.contDates.childNodes[q].childNodes[w]._q = q;this.contDates.childNodes[q].childNodes[w]._w = w;this.contDates.childNodes[q].childNodes[w]._css_month = (d2.getMonth()==mx);this.contDates.childNodes[q].childNodes[w]._css_date = (!this._nullDate&&time==dx);this.contDates.childNodes[q].childNodes[w]._css_weekend = (ws>=6);this.contDates.childNodes[q].childNodes[w]._css_dis = this._isOutOfRange(time);this.contDates.childNodes[q].childNodes[w]._css_holiday = (this._holidays[time] == true);this._updateCellStyle(q, w);if (time==dx)this._activeDateCell = this.contDates.childNodes[q].childNodes[w];if (++ws > 7)ws = 1;}
 }
 
 this.contMonth.firstChild.firstChild.childNodes[1].innerHTML = this.langData[this.lang].monthesFNames[d.getMonth()];this.contMonth.firstChild.firstChild.childNodes[2].innerHTML = d.getFullYear();}
 
 this._updateCellStyle = function(q, w) {var r = this.contDates.childNodes[q].childNodes[w];var s = "dhtmlxcalendar_cell dhtmlxcalendar_cell";s += (r._css_month ? "_month" : "");s += (r._css_date ? "_date" : "");s += (r._css_weekend ? "_weekend" : "");s += (r._css_holiday ? "_holiday" : "");s += (r._css_dis ? "_dis" : "");s += (r._css_hover && !r._css_dis ? "_hover" : "");r.className = s;r = null;}
 
 
 
 this._initSelector = function(type,css) {if (!this._selCover){this._selCover = document.createElement("DIV");this._selCover.className = "dhtmlxcalendar_selector_cover";this.base.appendChild(this._selCover);}
 if (!this._sel){this._sel = document.createElement("DIV");this._sel.className = "dhtmlxcalendar_selector_obj";this.base.appendChild(this._sel);this._sel.appendChild(document.createElement("TABLE"));this._sel.firstChild.className = "dhtmlxcalendar_selector_table";this._sel.firstChild.cellSpacing = 0;this._sel.firstChild.cellPadding = 0;this._sel.firstChild.border = 0;this._sel.firstChild.appendChild(document.createElement("TBODY"));this._sel.firstChild.firstChild.appendChild(document.createElement("TR"));this._sel.firstChild.firstChild.firstChild.appendChild(document.createElement("TD"));this._sel.firstChild.firstChild.firstChild.appendChild(document.createElement("TD"));this._sel.firstChild.firstChild.firstChild.appendChild(document.createElement("TD"));this._sel.firstChild.firstChild.firstChild.childNodes[0].className = "dhtmlxcalendar_selector_cell_left";this._sel.firstChild.firstChild.firstChild.childNodes[1].className = "dhtmlxcalendar_selector_cell_middle";this._sel.firstChild.firstChild.firstChild.childNodes[2].className = "dhtmlxcalendar_selector_cell_right";this._sel.firstChild.firstChild.firstChild.childNodes[0].innerHTML = "&nbsp;";this._sel.firstChild.firstChild.firstChild.childNodes[2].innerHTML = "&nbsp;";this._sel.firstChild.firstChild.firstChild.childNodes[0].onmouseover = function(){this.className = "dhtmlxcalendar_selector_cell_left dhtmlxcalendar_selector_cell_left_hover";}
 this._sel.firstChild.firstChild.firstChild.childNodes[0].onmouseout = function(){this.className = "dhtmlxcalendar_selector_cell_left";}
 
 this._sel.firstChild.firstChild.firstChild.childNodes[2].onmouseover = function(){this.className = "dhtmlxcalendar_selector_cell_right dhtmlxcalendar_selector_cell_right_hover";}
 this._sel.firstChild.firstChild.firstChild.childNodes[2].onmouseout = function(){this.className = "dhtmlxcalendar_selector_cell_right";}
 
 this._sel.firstChild.firstChild.firstChild.childNodes[0].onclick = function(e){e = e||event;e.cancelBubble = true;that._scrollYears(-1);}
 
 this._sel.firstChild.firstChild.firstChild.childNodes[2].onclick = function(e){e = e||event;e.cancelBubble = true;that._scrollYears(1);}
 
 this._sel._ta = {};this._selHover = null;this._sel.onmouseover = function(e) {e = e||event;var t = (e.target||e.srcElement);if (t._cell === true){if (that._selHover != t)that._clearSelHover();if (String(t.className).match(/^\s{0,}dhtmlxcalendar_selector_cell\s{0,}$/gi) !=null) {t.className += " dhtmlxcalendar_selector_cell_hover";that._selHover = t;}
 }
 }
 
 this._sel.onmouseout = function() {that._clearSelHover();}
 
 this._sel.appendChild(document.createElement("DIV"));this._sel.lastChild.className = "dhtmlxcalendar_selector_obj_arrow";}
 
 
 if (this._sel._ta[type] == true)return;if (type == "month"){this._msCells = {};this.msCont = document.createElement("DIV");this.msCont.className = "dhtmlxcalendar_area_"+css;this._sel.firstChild.firstChild.firstChild.childNodes[1].appendChild(this.msCont);var i = 0;for (var q=0;q<4;q++){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_selector_line";this.msCont.appendChild(ul);for (var w=0;w<3;w++){var li = document.createElement("LI");li.innerHTML = this.langData[this.lang].monthesSNames[i];li.className = "dhtmlxcalendar_selector_cell";ul.appendChild(li);li._month = i;li._cell = true;this._msCells[i++] = li;}
 }
 
 this.msCont.onclick = function(e) {e = e||event;e.cancelBubble = true;var t = (e.target||e.srcElement);if (t._month != null){that._hideSelector();that._updateActiveMonth();that._drawMonth(new Date(that._activeMonth.getFullYear(), t._month, 1, 0, 0, 0, 0));that._doOnSelectorChange();}
 }
 
 }
 
 
 if (type == "year"){this._ysCells = {};this.ysCont = document.createElement("DIV");this.ysCont.className = "dhtmlxcalendar_area_"+css;this._sel.firstChild.firstChild.firstChild.childNodes[1].appendChild(this.ysCont);for (var q=0;q<4;q++){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_selector_line";this.ysCont.appendChild(ul);for (var w=0;w<3;w++){var li = document.createElement("LI");li.className = "dhtmlxcalendar_selector_cell";li._cell = true;ul.appendChild(li);}
 }
 
 this.ysCont.onclick = function(e) {e = e||event;e.cancelBubble = true;var t = (e.target||e.srcElement);if (t._year != null){that._hideSelector();that._drawMonth(new Date(t._year, that._activeMonth.getMonth(), 1, 0, 0, 0, 0));that._doOnSelectorChange();}
 }
 
 }
 
 
 if (type == "hours"){this._hsCells = {};this.hsCont = document.createElement("DIV");this.hsCont.className = "dhtmlxcalendar_area_"+css;this._sel.firstChild.firstChild.firstChild.childNodes[1].appendChild(this.hsCont);var i = 0;for (var q=0;q<4;q++){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_selector_line";this.hsCont.appendChild(ul);for (var w=0;w<6;w++){var li = document.createElement("LI");li.innerHTML = this._fixLength(i,2);li.className = "dhtmlxcalendar_selector_cell";ul.appendChild(li);li._hours = i;li._cell = true;this._hsCells[i++] = li;}
 }
 
 this.hsCont.onclick = function(e) {e = e||event;e.cancelBubble = true;var t = (e.target||e.srcElement);if (t._hours != null){that._hideSelector();that._activeDate.setHours(t._hours);that._updateActiveHours();that._updateVisibleHours();that._doOnSelectorChange();}
 }
 
 }
 
 
 if (type == "minutes"){this._rsCells = {};this.rsCont = document.createElement("DIV");this.rsCont.className = "dhtmlxcalendar_area_"+css;this._sel.firstChild.firstChild.firstChild.childNodes[1].appendChild(this.rsCont);var i = 0;for (var q=0;q<4;q++){var ul = document.createElement("UL");ul.className = "dhtmlxcalendar_selector_line";this.rsCont.appendChild(ul);for (var w=0;w<3;w++){var li = document.createElement("LI");li.innerHTML = this._fixLength(i,2);li.className = "dhtmlxcalendar_selector_cell";ul.appendChild(li);li._minutes = i;li._cell = true;this._rsCells[i] = li;i+=5;}
 }
 
 this.rsCont.onclick = function(e) {e = e||event;e.cancelBubble = true;var t = (e.target||e.srcElement);if (t._minutes != null){that._hideSelector();that._activeDate.setMinutes(t._minutes);that._updateActiveMinutes();that._updateVisibleMinutes();that._doOnSelectorChange();}
 }
 
 }
 
 
 this._sel._ta[type] = true;}
 
 this._showSelector = function(type,x,y,css,autoHide) {if (autoHide === true && this._sel != null && this._isSelectorVisible()&& type == this._sel._t) {this._hideSelector();return;}
 
 if (this.skin == "dhx_terrace"){x += {month: 14, year:27, hours: 19, minutes: 24}[type];y += {month: 8, year: 8, hours: 14, minutes: 14}[type];}
 
 if (!this._sel || !this._sel._ta[type])this._initSelector(type,css);this._selCover.style.display = "";this._sel._t = type;this._sel.style.left = x+"px";this._sel.style.top = y+"px";this._sel.style.display = "";this._sel.className = "dhtmlxcalendar_selector_obj dhtmlxcalendar_"+css;this._doOnSelectorShow(type);}
 
 this._doOnSelectorShow = function(type) {if (type == "month")this._updateActiveMonth();if (type == "year")this._updateYearsList(this._activeMonth);if (type == "hours")this._updateActiveHours();if (type == "minutes")this._updateActiveMinutes();}
 
 this._hideSelector = function() {if (!this._sel)return;this._sel.style.display = "none";this._selCover.style.display = "none";}
 
 this._isSelectorVisible = function() {if (!this._sel)return false;return (this._sel.style.display != "none");}
 
 this._doOnSelectorChange = function(state) {this.callEvent("onChange",[new Date(this._activeMonth.getFullYear(), this._activeMonth.getMonth(), this._activeDate.getDate(), this._activeDate.getHours(), this._activeDate.getMinutes(), this._activeDate.getSeconds()),state]);}
 
 this._clearSelHover = function() {if (!this._selHover)return;this._selHover.className = String(this._selHover.className.replace(/dhtmlxcalendar_selector_cell_hover/gi,""));this._selHover = null;}
 
 
 
 
 this._updateActiveMonth = function() {if (typeof(this._msActive)!= "undefined" && typeof(this._msCells[this._msActive]) != "undefined") this._msCells[this._msActive].className = "dhtmlxcalendar_selector_cell";this._msActive = this._activeMonth.getMonth();this._msCells[this._msActive].className = "dhtmlxcalendar_selector_cell dhtmlxcalendar_selector_cell_active";}
 
 
 
 this._updateActiveYear = function() {var i = this._activeMonth.getFullYear();if (this._ysCells[i])this._ysCells[i].className = "dhtmlxcalendar_selector_cell dhtmlxcalendar_selector_cell_active";}
 
 this._updateYearsList = function(d) {for (var a in this._ysCells){this._ysCells[a] = null;delete this._ysCells[a];}
 
 var i = 12*Math.floor(d.getFullYear()/12);for (var q=0;q<4;q++){for (var w=0;w<3;w++){this.ysCont.childNodes[q].childNodes[w].innerHTML = i;this.ysCont.childNodes[q].childNodes[w]._year = i;this.ysCont.childNodes[q].childNodes[w].className = "dhtmlxcalendar_selector_cell";this._ysCells[i++] = this.ysCont.childNodes[q].childNodes[w];}
 }
 this._updateActiveYear();}
 
 this._scrollYears = function(i) {var y = (i<0?this.ysCont.firstChild.firstChild._year:this.ysCont.lastChild.lastChild._year)+i;var d = new Date(y, this._activeMonth.getMonth(), 1, 0, 0, 0, 0);this._updateYearsList(d);}
 
 
 
 
 this._updateActiveHours = function() {if (typeof(this._hsActive)!= "undefined" && typeof(this._hsCells[this._hsActive]) != "undefined") this._hsCells[this._hsActive].className = "dhtmlxcalendar_selector_cell";this._hsActive = this._activeDate.getHours();this._hsCells[this._hsActive].className = "dhtmlxcalendar_selector_cell dhtmlxcalendar_selector_cell_active";}
 
 
 this._updateVisibleHours = function() {this.contTime.firstChild.firstChild.childNodes[1].innerHTML = this._fixLength(this._activeDate.getHours(),2);}
 
 
 
 
 this._updateActiveMinutes = function() {if (typeof(this._rsActive)!= "undefined" && typeof(this._rsCells[this._rsActive]) != "undefined") this._rsCells[this._rsActive].className = "dhtmlxcalendar_selector_cell";this._rsActive = this._activeDate.getMinutes();if (typeof(this._rsCells[this._rsActive])!= "undefined") this._rsCells[this._rsActive].className = "dhtmlxcalendar_selector_cell dhtmlxcalendar_selector_cell_active";}
 
 
 this._updateVisibleMinutes = function() {this.contTime.firstChild.firstChild.childNodes[3].innerHTML = this._fixLength(this._activeDate.getMinutes(),2);}
 
 
 
 this._fixLength = function(t, r) {while (String(t).length < r) t = "0"+String(t);return t;}
 
 this._dateFormat = "";this._dateFormatRE = null;this.setDateFormat = function(format) {this._dateFormat = format;this._dateFormatRE = new RegExp(String(this._dateFormat).replace(/%[a-zA-Z]+/g,function(t){var t2 = t.replace(/%/,"");switch (t2) {case "n":
 case "j":
 case "g":
 case "G":
 return "\\d{1,2}";case "m":
 case "d":
 case "H":
 case "i":
 case "s":
 case "y":
 return "\\d{2}";case "Y":
 return "\\d{4}";case "M":
 return "("+that.langData[that.lang].monthesSNames.join("|").toLowerCase()+"){1,}";case "F":
 return "("+that.langData[that.lang].monthesFNames.join("|").toLowerCase()+"){1,}";}
 return t;}),"i");}
 
 this.setDateFormat("%Y-%m-%d");this._getInd = function(val,ar) {for (var q=0;q<ar.length;q++)if (ar[q].toLowerCase()== val) return q;return -1;}
 
 this._strToDate = function(val, format) {format = (format||this._dateFormat);var v = val.match(/[a-z0-9]{1,}/gi);var f = format.match(/%[a-zA-Z]/g);if (!v || v.length != f.length)return "Invalid Date";var p = {"%y":1,"%Y":1,"%n":2,"%m":2,"%M":2,"%F":2,"%d":3,"%j":3,"%H":4,"%G":4,"%h":4,"%g":4,"%i":5,"%s":6};var v2 = {};var f2 = {};for (var q=0;q<f.length;q++){if (typeof(p[f[q]])!= "undefined") {var ind = p[f[q]];if (!v2[ind]){v2[ind]=[];f2[ind]=[];}
 v2[ind].push(v[q]);f2[ind].push(f[q]);}
 }
 v = [];f = [];for (var q=1;q<=6;q++){if (v2[q] != null){for (var w=0;w<v2[q].length;w++){v.push(v2[q][w]);f.push(f2[q][w]);}
 }
 }
 
 
 var r = new Date();r.setDate(1);for (var q=0;q<v.length;q++){switch (f[q]) {case "%d":
 case "%j":
 case "%d":
 case "%j":
 case "%n":
 case "%m":
 case "%Y":
 case "%H":
 case "%G":
 case "%i":
 case "%s":
 if (!isNaN(v[q])) r[{"%d":"setDate","%j":"setDate","%n":"setMonth","%m":"setMonth","%Y":"setFullYear","%H":"setHours","%G":"setHours","%i":"setMinutes","%s":"setSeconds"}[f[q]]](Number(v[q])+(f[q]=="%m"||f[q]=="%n"?-1:0));break;case "%M":
 case "%F":
 var k = this._getInd(v[q].toLowerCase(),that.langData[that.lang][{"%M":"monthesSNames","%F":"monthesFNames"}[f[q]]]);if (k >= 0)r.setMonth(k);break;case "%y":
 if (!isNaN(v[q])) {var v0 = Number(v[q]);r.setFullYear(v0+(v0>50?1900:2000));}
 break;case "%g":
 case "%h":
 if (!isNaN(v[q])) {var v0 = Number(v[q]);if (v0 <= 12 && v0 >= 0)r.setHours(v0+(this._getInd("pm",v)>=0?12:0));}
 break;}
 
 }
 
 return r;}
 
 this._dateToStr = function(val, format) {if (val instanceof Date){var z = function(t) {return (String(t).length==1?"0"+String(t):t);}
 var k = function(t) {switch(t) {case "%d": return z(val.getDate());case "%j": return val.getDate();case "%D": return that.langData[that.lang].daysSNames[val.getDay()];case "%l": return that.langData[that.lang].daysFNames[val.getDay()];case "%m": return z(val.getMonth()+1);case "%n": return val.getMonth()+1;case "%M": return that.langData[that.lang].monthesSNames[val.getMonth()];case "%F": return that.langData[that.lang].monthesFNames[val.getMonth()];case "%y": return z(val.getYear()%100);case "%Y": return val.getFullYear();case "%g": return (val.getHours()+11)%12+1;case "%h": return z((val.getHours()+11)%12+1);case "%G": return val.getHours();case "%H": return z(val.getHours());case "%i": return z(val.getMinutes());case "%s": return z(val.getSeconds());case "%a": return (val.getHours()>11?"pm":"am");case "%A": return (val.getHours()>11?"PM":"AM");case "%%": "%";default: return t;}
 }
 var t = String(format||this._dateFormat).replace(/%[a-zA-Z]/g, k);}
 return (t||String(val));}
 
 this._updateDateStr = function(str) {if (str == ""){this.setDate(new Date());this.callEvent("onChange",[null,true]);return;}else {if (!this._dateFormatRE || !str.match(this._dateFormatRE)) return;}
 
 
 var r = this._strToDate(str);if (!(r instanceof Date)) return;this._nullDate = false;this._activeDate = r;this._drawMonth(this._nullDate?new Date():this._activeDate);this._updateVisibleMinutes();this._updateVisibleHours();if (this._sel && this._isSelectorVisible()) this._doOnSelectorShow(this._sel._t);this._doOnSelectorChange(true);}
 
 this.setFormatedDate = function(format, str, a, return_only) {var date = this._strToDate(str, format);if (return_only)return date;this.setDate(date);}
 this.getFormatedDate = function(format, date) {if (this._nullDate)return "";if (!(date && date instanceof Date)) date = new Date(this._activeDate);return this._dateToStr(date, format);}
 
 
 
 
 
 this.show = function(id) {if (!id && this._hasParent){this._show();return;}
 
 
 if (typeof(id)== "object" && typeof(id._dhtmlxcalendar_uid) != "undefined" && this.i[id._dhtmlxcalendar_uid] == id) {this._show(id._dhtmlxcalendar_uid);return;}
 if (typeof(id)== "undefined") {for (var a in this.i)if (!id)id = a;}
 if (!id)return;this._show(id);}
 
 this.hide = function() {if (this._isVisible()) this._hide();}
 
 this.isVisible = function() {return this._isVisible();}
 
 
 this.draw = function() {this.show();}
 
 this.close = function() {this.hide();}
 
 
 
 this._activeInp = null;this.pos = "bottom";this.setPosition = function(x, y) {this._px = null;this._py = null;if (x == "right" || x == "bottom"){this.pos = x;}else {this.pos = "int";if (typeof(x)!= "undefined" && !isNaN(x)) {this.base.style.left = x+"px";this._px = x;}
 if (typeof(y)!= "undefined" && !isNaN(y)) {this.base.style.top = y+"px";this._py = y;}
 this._ifrSize();}
 }
 
 this._show = function(inpId, autoHide) {if (autoHide === true && this._activeInp == inpId && this._isVisible()) {this._hide();return;}
 if (!inpId){if (this._px && this._py){this.base.style.left = this._px+"px";this.base.style.top = this._py+"px";}else {this.base.style.left = "0px";this.base.style.top = "0px";}
 }else {if (this.pos == "right"){this.base.style.left = this._getLeft(this.i[inpId])+this.i[inpId].offsetWidth-1+"px";this.base.style.top = this._getTop(this.i[inpId])+"px";}else if (this.pos == "bottom"){this.base.style.left = this._getLeft(this.i[inpId])+"px";this.base.style.top = this._getTop(this.i[inpId])+this.i[inpId].offsetHeight-1+"px";}else {this.base.style.left = (this._px||0)+"px";this.base.style.top = (this._py||0)+"px";}
 this._activeInp = inpId;}
 this._hideSelector();this.base.style.display = "";this._ifrSize();if (this._ifr)this._ifr.style.display = "";}
 
 this._hide = function() {this._hideSelector();this.base.style.display = "none";this._activeInp = null;if (this._ifr)this._ifr.style.display = "none";}
 
 this._isVisible = function() {return (this.base.style.display!="none");}
 
 this._getLeft = function(obj) {return this._posGetOffset(obj).left;}
 
 this._getTop = function(obj) {return this._posGetOffset(obj).top;}
 
 this._posGetOffsetSum = function(elem) {var top=0, left=0;while(elem){top = top + parseInt(elem.offsetTop);left = left + parseInt(elem.offsetLeft);elem = elem.offsetParent;}
 return {top: top, left: left};}
 this._posGetOffsetRect = function(elem) {var box = elem.getBoundingClientRect();var body = document.body;var docElem = document.documentElement;var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;var clientTop = docElem.clientTop || body.clientTop || 0;var clientLeft = docElem.clientLeft || body.clientLeft || 0;var top = box.top + scrollTop - clientTop;var left = box.left + scrollLeft - clientLeft;return {top: Math.round(top), left: Math.round(left) };}
 this._posGetOffset = function(elem) {return this[elem.getBoundingClientRect?"_posGetOffsetRect":"_posGetOffsetSum"](elem);}
 
 this._rangeActive = false;this._rangeFrom = null;this._rangeTo = null;this._rangeSet = {};this.setInsensitiveDays = function(d) {var t = this._extractDates(d);for (var q=0;q<t.length;q++)this._rangeSet[new Date(t[q].getFullYear(),t[q].getMonth(),t[q].getDate(),0,0,0,0).getTime()] = true;this._drawMonth(this._activeMonth);}
 
 this.clearInsensitiveDays = function() {this._clearRangeSet();this._drawMonth(this._activeMonth);}
 
 this._holidays = {};this.setHolidays = function(r) {if (r == null){this._clearHolidays();}else if (r != null){var t = this._extractDates(r);for (var q=0;q<t.length;q++)this._holidays[new Date(t[q].getFullYear(),t[q].getMonth(),t[q].getDate(),0,0,0,0).getTime()] = true;}
 this._drawMonth(this._activeMonth);}
 
 this._extractDates = function(r) {if (typeof(r)== "string" || r instanceof Date) r = [r];var t = [];for (var q=0;q<r.length;q++){if (typeof(r[q])== "string") {var e = r[q].split(",");for (var w=0;w<e.length;w++)t.push(this._strToDate(e[w]));}else if (r[q] instanceof Date){t.push(r[q]);}
 }
 return t;}
 
 this._clearRange = function() {this._rangeActive = false;this._rangeType = null;this._rangeFrom = null;this._rangeTo = null;}
 
 this._clearRangeSet = function() {for (var a in this._rangeSet){this._rangeSet[a] = null;delete this._rangeSet[a];}
 }
 
 this._clearHolidays = function() {for (var a in this._holidays){this._holidays[a] = null;delete this._holidays[a];}
 }
 
 this._isOutOfRange = function(time) {if (this._rangeSet[time] == true)return true;if (this._rangeActive){if (this._rangeType == "in" && (time<this._rangeFrom || time>this._rangeTo)) return true;if (this._rangeType == "out" && (time>=this._rangeFrom && time<=this._rangeTo)) return true;if (this._rangeType == "from" && time<this._rangeFrom)return true;if (this._rangeType == "to" && time>this._rangeTo)return true;}
 
 var t0 = new Date(time);if (this._rangeWeek){if (this._rangeWeekData[t0.getDay()] === true) return true;}
 
 if (this._rangeMonth){if (this._rangeMonthData[t0.getDate()] === true) return true;}
 
 if (this._rangeYear){if (this._rangeYearData[t0.getMonth()+"_"+t0.getDate()] === true) return true;}
 
 return false;}
 
 this.clearSensitiveRange = function() {this._clearRange();this._drawMonth(this._activeMonth);}
 
 this.setSensitiveRange = function(from, to, ins) {var f = false;if (from != null && to != null){if (!(from instanceof Date)) from = this._strToDate(from);if (!(to instanceof Date)) to = this._strToDate(to);if (from.getTime()> to.getTime()) return;this._rangeFrom = new Date(from.getFullYear(),from.getMonth(),from.getDate(),0,0,0,0).getTime();this._rangeTo = new Date(to.getFullYear(),to.getMonth(),to.getDate(),0,0,0,0).getTime();this._rangeActive = true;this._rangeType = "in";f = true;}
 
 
 if (!f && from != null && to == null){if (!(from instanceof Date)) from = this._strToDate(from);this._rangeFrom = new Date(from.getFullYear(),from.getMonth(),from.getDate(),0,0,0,0).getTime();this._rangeTo = null;if (ins === true)this._rangeFrom++;this._rangeActive = true;this._rangeType = "from";f = true;}
 
 
 if (!f && from == null && to != null){if (!(to instanceof Date)) to = this._strToDate(to);this._rangeFrom = null;this._rangeTo = new Date(to.getFullYear(),to.getMonth(),to.getDate(),0,0,0,0).getTime();if (ins === true)this._rangeTo--;this._rangeActive = true;this._rangeType = "to";f = true;}
 
 if (f)this._drawMonth(this._activeMonth);}
 
 this.setInsensitiveRange = function(from, to) {if (from != null && to != null){if (!(from instanceof Date)) from = this._strToDate(from);if (!(to instanceof Date)) to = this._strToDate(to);if (from.getTime()> to.getTime()) return;this._rangeFrom = new Date(from.getFullYear(),from.getMonth(),from.getDate(),0,0,0,0).getTime();this._rangeTo = new Date(to.getFullYear(),to.getMonth(),to.getDate(),0,0,0,0).getTime();this._rangeActive = true;this._rangeType = "out";this._drawMonth(this._activeMonth);return;}
 
 if (from != null && to == null){this.setSensitiveRange(null, from, true);return;}
 
 if (from == null && to != null){this.setSensitiveRange(to, null, true);return;}
 
 }
 
 
 this.disableDays = function(mode, d) {if (mode == "week"){if (typeof(d)!= "object" && typeof(d.length) == "undefined") d = [d];if (!this._rangeWeekData)this._rangeWeekData = {};for (var a in this._rangeWeekData){this._rangeWeekData[a] = false;delete this._rangeWeekData[a];}
 
 for (var q=0;q<d.length;q++){this._rangeWeekData[d[q]] = true;if (d[q] == 7)this._rangeWeekData[0] = true;}
 this._rangeWeek = true;}
 
 if (mode == "month"){if (typeof(d)!= "object" && typeof(d.length) == "undefined") d = [d];if (!this._rangeMonthData)this._rangeMonthData = {};for (var a in this._rangeMonthData){this._rangeMonthData[a] = false;delete this._rangeMonthData[a];}
 for (var q=0;q<d.length;q++)this._rangeMonthData[d[q]] = true;this._rangeMonth = true;}
 
 if (mode == "year"){var t = this._extractDates(d);if (!this._rangeYearData)this._rangeYearData = {};for (var a in this._rangeYearData){this._rangeYearData[a] = false;delete this._rangeYearData[a];}
 for (var q=0;q<t.length;q++)this._rangeYearData[t[q].getMonth()+"_"+t[q].getDate()] = true;this._rangeYear = true;}
 
 this._drawMonth(this._activeMonth);}
 
 this.enableDays = function(mode) {if (mode == "week"){this._rangeWeek = false;}
 
 if (mode == "month"){this._rangeMonth = false;}
 
 if (mode == "year"){this._rangeYear = false;}
 
 this._drawMonth(this._activeMonth);}
 
 this._updateFromInput = function(t) {if (this._nullInInput && ((t.value).replace(/\s/g,"")).length == 0) {this.setDate(null);}else {this._updateDateStr(t.value);}
 t = null;}
 
 
 this._doOnClick = function(e) {e = e||event;var t = (e.target||e.srcElement);if (t._dhtmlxcalendar_uid && t._dhtmlxcalendar_uid != that._activeInp && that._isVisible()&&that._activeInp) {that._hide();return;}
 if (!t._dhtmlxcalendar_uid || !that.i[t._dhtmlxcalendar_uid]){if (that._isSelectorVisible()) that._hideSelector();else if (!that._hasParent && that._isVisible()) that._hide();}
 }
 
 this._doOnKeyDown = function(e) {e = e||event;if (e.keyCode == 27 || e.keyCode == 13){if (that._isSelectorVisible()) that._hideSelector();else if (that._isVisible()&& !that._hasParent) that._hide();}
 }
 
 
 this._doOnInpClick = function(e) {e = e||event;var t = (e.target||e.srcElement);if (!t._dhtmlxcalendar_uid)return;if (!that._listenerEnabled){that._updateFromInput(t);}
 that._show(t._dhtmlxcalendar_uid, true);}
 
 this._doOnInpKeyUp = function(e) {e = e||event;var t = (e.target||e.srcElement);if (e.keyCode == 13 || !t._dhtmlxcalendar_uid)return;if (!that._listenerEnabled)that._updateFromInput(t);}
 
 this._doOnUnload = function() {if (that && that.unload)that.unload();}
 
 if (window.addEventListener){document.body.addEventListener("click", that._doOnClick, false);window.addEventListener("keydown", that._doOnKeyDown, false);window.addEventListener("unload", that._doOnUnload, false);}else {document.body.attachEvent("onclick", that._doOnClick);document.body.attachEvent("onkeydown", that._doOnKeyDown);window.attachEvent("onunload", that._doOnUnload);}
 
 this.attachObj = function(obj) {if (typeof(obj)== "string") obj = document.getElementById(obj);var a = this.uid();this.i[a] = obj;this._attachEventsToObject(a);}
 
 this.detachObj = function(obj) {if (typeof(obj)== "string") obj = document.getElementById(obj);var a = obj._dhtmlxcalendar_uid;if (this.i[a] != null){this._detachEventsFromObject(a);this.i[a]._dhtmlxcalendar_uid = null;this.i[a] = null;delete this.i[a];}
 }
 
 this._attachEventsToObject = function(a) {this.i[a]._dhtmlxcalendar_uid = a;if (window.addEventListener){this.i[a].addEventListener("click", that._doOnInpClick, false);this.i[a].addEventListener("keyup", that._doOnInpKeyUp, false);}else {this.i[a].attachEvent("onclick", that._doOnInpClick);this.i[a].attachEvent("onkeyup", that._doOnInpKeyUp);}
 }
 
 this.enableListener = function(t) {this._listenerEnabled = true;this._startListener(t);}
 
 this.disableListener = function(t) {this._listenerEnabled = false;}
 
 
 this._startListener = function(t) {if (typeof(t._v1)== "undefined") t._v1 = t.value;if (t._v1 != t.value){this._updateFromInput(t);t._v1 = t.value;}
 if (this._tmListener)window.clearTimeout(this._tmListener);this._tmListener = window.setTimeout(function(){that._startListener(t);},10);}
 
 this._detachEventsFromObject = function(a) {if (window.addEventListener){this.i[a].removeEventListener("click", that._doOnInpClick, false);this.i[a].removeEventListener("keyup", that._doOnInpKeyUp, false);}else {this.i[a].detachEvent("onclick", that._doOnInpClick);this.i[a].detachEvent("onkeyup", that._doOnInpKeyUp);}
 }
 
 for (var a in this.i)this._attachEventsToObject(a);this.evs = {};this.attachEvent = function(name, func) {var eId = this.uid();this.evs[eId] = {name: String(name).toLowerCase(), func: func};return eId;}
 this.detachEvent = function(id) {if (this.evs[id]){this.evs[id].name = null;this.evs[id].func = null;this.evs[id] = null;delete this.evs[id];}
 }
 this.callEvent = function(name, params) {var u = true;var n = String(name).toLowerCase();params = (params||[]);for (var a in this.evs){if (this.evs[a].name == n){var r = this.evs[a].func.apply(this,params);u = (u && r);}
 }
 return u;}
 this.checkEvent = function(name) {var u = false;var n = String(name).toLowerCase();for (var a in this.evs)u = (u || this.evs[a].name == n);return u;}
 
 
 
 this.unload = function() {this._activeDate = null;this._activeDateCell = null;this._activeInp = null;this._activeMonth = null;this._dateFormat = null;this._dateFormatRE = null;this._lastHover = null;this.uid = null;this.uidd = null;if (this._tmListener)window.clearTimeout(this._tmListener);this._tmListener = null;if (window.addEventListener){document.body.removeEventListener("click", that._doOnClick, false);window.removeEventListener("keydown", that._doOnKeyDown, false);window.removeEventListener("unload", that._doOnUnload, false);}else {document.body.detachEvent("onclick", that._doOnClick);document.body.detachEvent("onkeydown", that._doOnKeyDown);window.detachEvent("onunload", that._doOnKeyDown);}
 
 this._doOnClick = null;this._doOnKeyDown = null;this._doOnUnload = null;for (var a in this.i){this.i[a]._dhtmlxcalendar_uid = null;if (window.addEventListener){this.i[a].removeEventListener("click", that._doOnInpClick, false);this.i[a].removeEventListener("keyup", that._doOnInpKeyUp, false);}else {this.i[a].detachEvent("onclick", that._doOnInpClick);this.i[a].detachEvent("onkeyup", that._doOnInpKeyUp);}
 
 this.i[a] = null;delete this.i[a];}
 
 this.i = null;this._doOnInpClick = null;this._doOnInpKeyUp = null;for (var a in this.evs)this.detachEvent(a);this.evs = null;this.attachEvent = null;this.detachEvent = null;this.checkEvent = null;this.callEvent = null;this.contMonth.onselectstart = null;this.contMonth.firstChild.firstChild.onclick = null;this.contMonth.firstChild.firstChild.firstChild.onmouseover = null;this.contMonth.firstChild.firstChild.firstChild.onmouseout = null;this.contMonth.firstChild.firstChild.lastChild.onmouseover = null;this.contMonth.firstChild.firstChild.lastChild.onmouseout = null;while (this.contMonth.firstChild.firstChild.childNodes.length > 0)this.contMonth.firstChild.firstChild.removeChild(this.contMonth.firstChild.firstChild.lastChild);this.contMonth.firstChild.removeChild(this.contMonth.firstChild.firstChild);this.contMonth.removeChild(this.contMonth.firstChild);this.contMonth.parentNode.removeChild(this.contMonth);this.contMonth = null;while (this.contDays.firstChild.childNodes.length > 0)this.contDays.firstChild.removeChild(this.contDays.firstChild.lastChild);this.contDays.removeChild(this.contDays.firstChild);this.contDays.parentNode.removeChild(this.contDays);this.contDays = null;this.contDates.onclick = null;this.contDates.onmouseover = null;this.contDates.onmouseout = null;while (this.contDates.childNodes.length > 0){while (this.contDates.lastChild.childNodes.length > 0){this.contDates.lastChild.lastChild._css_date = null;this.contDates.lastChild.lastChild._css_month = null;this.contDates.lastChild.lastChild._css_weekend = null;this.contDates.lastChild.lastChild._css_hover = null;this.contDates.lastChild.lastChild._date = null;this.contDates.lastChild.lastChild._q = null;this.contDates.lastChild.lastChild._w = null;this.contDates.lastChild.removeChild(this.contDates.lastChild.lastChild);}
 
 this.contDates.removeChild(this.contDates.lastChild);}
 
 
 this.contDates.parentNode.removeChild(this.contDates);this.contDates = null;this.contTime.firstChild.firstChild.onclick = null;while (this.contTime.firstChild.firstChild.childNodes.length > 0)this.contTime.firstChild.firstChild.removeChild(this.contTime.firstChild.firstChild.lastChild);this.contTime.firstChild.removeChild(this.contTime.firstChild.firstChild);this.contTime.removeChild(this.contTime.firstChild);this.contTime.parentNode.removeChild(this.contTime);this.contTime = null;this._lastHover = null;if (this.msCont){this.msCont.onclick = null;this._msActive = null;for (var a in this._msCells){this._msCells[a]._cell = null;this._msCells[a]._month = null;this._msCells[a].parentNode.removeChild(this._msCells[a]);this._msCells[a] = null;}
 this._msCells = null;while (this.msCont.childNodes.length > 0)this.msCont.removeChild(this.msCont.lastChild);this.msCont.parentNode.removeChild(this.msCont);this.msCont = null;}
 
 
 if (this.ysCont){this.ysCont.onclick = null;for (var a in this._ysCells){this._ysCells[a]._cell = null;this._ysCells[a]._year = null;this._ysCells[a].parentNode.removeChild(this._ysCells[a]);this._ysCells[a] = null;}
 this._ysCells = null;while (this.ysCont.childNodes.length > 0)this.ysCont.removeChild(this.ysCont.lastChild);this.ysCont.parentNode.removeChild(this.ysCont);this.ysCont = null;}
 
 
 if (this.hsCont){this.hsCont.onclick = null;this._hsActive = null;for (var a in this._hsCells){this._hsCells[a]._cell = null;this._hsCells[a]._hours = null;this._hsCells[a].parentNode.removeChild(this._hsCells[a]);this._hsCells[a] = null;}
 this._hsCells = null;while (this.hsCont.childNodes.length > 0)this.hsCont.removeChild(this.hsCont.lastChild);this.hsCont.parentNode.removeChild(this.hsCont);this.hsCont = null;}
 
 
 if (this.rsCont){this.rsCont.onclick = null;this._rsActive = null;for (var a in this._rsCells){this._rsCells[a]._cell = null;this._rsCells[a]._minutes = null;this._rsCells[a].parentNode.removeChild(this._rsCells[a]);this._rsCells[a] = null;}
 this._rsCells = null;while (this.rsCont.childNodes.length > 0)this.rsCont.removeChild(this.rsCont.lastChild);this.rsCont.parentNode.removeChild(this.rsCont);this.rsCont = null;}
 
 
 if (this._selCover){this._selCover.parentNode.removeChild(this._selCover);this._selCover = null;}
 
 
 if (this._sel){for (var a in this._sel._ta)this._sel._ta[a] = null;this._sel._ta = null;this._sel._t = null;this._sel.onmouseover = null;this._sel.onmouseout = null;while (this._sel.firstChild.firstChild.firstChild.childNodes.length > 0){this._sel.firstChild.firstChild.firstChild.lastChild.onclick = null;this._sel.firstChild.firstChild.firstChild.lastChild.onmouseover = null;this._sel.firstChild.firstChild.firstChild.lastChild.onmouseout = null;this._sel.firstChild.firstChild.firstChild.removeChild(this._sel.firstChild.firstChild.firstChild.lastChild);}
 
 
 this._sel.firstChild.firstChild.removeChild(this._sel.firstChild.firstChild.firstChild);this._sel.firstChild.removeChild(this._sel.firstChild.firstChild);while (this._sel.childNodes.length > 0)this._sel.removeChild(this._sel.lastChild);this._sel.parentNode.removeChild(this._sel);this._sel = null;}
 
 
 
 
 this.base.onclick = null;this.base.parentNode.removeChild(this.base);this.base = null;this._clearDayHover = null;this._clearSelHover = null;this._doOnSelectorChange = null;this._doOnSelectorShow = null;this._drawMonth = null;this._fixLength = null;this._getLeft = null;this._getTop = null;this._hide = null;this._hideSelector = null;this._initSelector = null;this._isSelectorVisible = null;this._isVisible = null;this._posGetOffset = null;this._posGetOffsetRect = null;this._posGetOffsetSum = null;this._scrollYears = null;this._show = null;this._showSelector = null;this._strToDate = null;this._updateActiveHours = null;this._updateActiveMinutes = null;this._updateActiveMonth = null;this._updateActiveYear = null;this._updateCellStyle = null;this._updateDateStr = null;this._updateVisibleHours = null;this._updateVisibleMinutes = null;this._updateYearsList = null;this.hide = null;this.hideTime = null;this.setDate = null;this.setDateFormat = null;this.show = null;this.showTime = null;this.unload = null;for (var a in this)delete this[a];a = that = null;}
 
 
 
 this.setDate(this._activeDate);return this;};dhtmlXCalendarObject.prototype.setYearsRange = function(){};dhtmlXCalendarObject.prototype.lang = "en";dhtmlXCalendarObject.prototype.langData = {"en": {dateformat: "%Y-%m-%d",
 monthesFNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
 monthesSNames: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
 daysFNames: ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
 daysSNames: ["Su","Mo","Tu","We","Th","Fr","Sa"],
 weekstart: 1
 }
};dhtmlXCalendarObject.prototype.enableIframe = function(mode) {if (mode == true){if (!this._ifr){this._ifr = document.createElement("IFRAME");this._ifr.frameBorder = 0;this._ifr.border = 0;this._ifr.setAttribute("src","javascript:false;");this._ifr.className = "dhtmlxcalendar_ifr";this._ifr.onload = function(){this.onload = null;this.contentWindow.document.open("text/html", "replace");this.contentWindow.document.write("<html><head><style>html,body{width:100%;height:100%;overflow:hidden;margin:0px;}</style></head><body</body></html>");}
 this.base.parentNode.insertBefore(this._ifr, this.base);this._ifrSize();}
 }else {if (this._ifr){this._ifr.parentNode.removeChild(this._ifr);this._ifr = null;}
 }
};dhtmlXCalendarObject.prototype._ifrSize = function() {if (this._ifr){this._ifr.style.left = this.base.style.left;this._ifr.style.top = this.base.style.top;this._ifr.style.width = this.base.offsetWidth+"px";this._ifr.style.height = this.base.offsetHeight+"px";}
};dhtmlxCalendarObject = dhtmlXCalendarObject;function dataProcessor(serverProcessorURL){this.serverProcessor = serverProcessorURL;this.action_param="!nativeeditor_status";this.object = null;this.updatedRows = [];this.autoUpdate = true;this.updateMode = "cell";this._tMode="GET";this.post_delim = "_";this._waitMode=0;this._in_progress={};this._invalid={};this.mandatoryFields=[];this.messages=[];this.styles={updated:"font-weight:bold;",
 inserted:"font-weight:bold;",
 deleted:"text-decoration : line-through;",
 invalid:"background-color:FFE0E0;",
 invalid_cell:"border-bottom:2px solid red;",
 error:"color:red;",
 clear:"font-weight:normal;text-decoration:none;"
 };this.enableUTFencoding(true);dhtmlxEventable(this);return this;}
dataProcessor.prototype={setTransactionMode:function(mode,total){this._tMode=mode;this._tSend=total;},
 escape:function(data){if (this._utf)return encodeURIComponent(data);else
 return escape(data);},
 
 enableUTFencoding:function(mode){this._utf=convertStringToBoolean(mode);},
 
 setDataColumns:function(val){this._columns=(typeof val == "string")?val.split(","):val;},
 
 getSyncState:function(){return !this.updatedRows.length;},
 
 enableDataNames:function(mode){this._endnm=convertStringToBoolean(mode);},
 
 enablePartialDataSend:function(mode){this._changed=convertStringToBoolean(mode);},
 
 setUpdateMode:function(mode,dnd){this.autoUpdate = (mode=="cell");this.updateMode = mode;this.dnd=dnd;},
 ignore:function(code,master){this._silent_mode=true;code.call(master||window);this._silent_mode=false;},
 
 setUpdated:function(rowId,state,mode){if (this._silent_mode)return;var ind=this.findRow(rowId);mode=mode||"updated";var existing = this.obj.getUserData(rowId,this.action_param);if (existing && mode == "updated")mode=existing;if (state){this.set_invalid(rowId,false);this.updatedRows[ind]=rowId;this.obj.setUserData(rowId,this.action_param,mode);if (this._in_progress[rowId])this._in_progress[rowId]="wait";}else{if (!this.is_invalid(rowId)){this.updatedRows.splice(ind,1);this.obj.setUserData(rowId,this.action_param,"");}
 }
 
 if (!state)this._clearUpdateFlag(rowId);this.markRow(rowId,state,mode);if (state && this.autoUpdate)this.sendData(rowId);},
 _clearUpdateFlag:function(id){},
 markRow:function(id,state,mode){var str="";var invalid=this.is_invalid(id);if (invalid){str=this.styles[invalid];state=true;}
 if (this.callEvent("onRowMark",[id,state,mode,invalid])){str=this.styles[state?mode:"clear"]+str;this.obj[this._methods[0]](id,str);if (invalid && invalid.details){str+=this.styles[invalid+"_cell"];for (var i=0;i < invalid.details.length;i++)if (invalid.details[i])this.obj[this._methods[1]](id,i,str);}
 }
 },
 getState:function(id){return this.obj.getUserData(id,this.action_param);},
 is_invalid:function(id){return this._invalid[id];},
 set_invalid:function(id,mode,details){if (details)mode={value:mode, details:details, toString:function(){return this.value.toString();}};this._invalid[id]=mode;},
 
 checkBeforeUpdate:function(rowId){return true;},
 
 sendData:function(rowId){if (this._waitMode && (this.obj.mytype=="tree" || this.obj._h2)) return;if (this.obj.editStop)this.obj.editStop();if(typeof rowId == "undefined" || this._tSend)return this.sendAllData();if (this._in_progress[rowId])return false;this.messages=[];if (!this.checkBeforeUpdate(rowId)&& this.callEvent("onValidationError",[rowId,this.messages])) return false;this._beforeSendData(this._getRowData(rowId),rowId);},
 _beforeSendData:function(data,rowId){if (!this.callEvent("onBeforeUpdate",[rowId,this.getState(rowId),data])) return false;this._sendData(data,rowId);},
 serialize:function(data, id){if (typeof data == "string")return data;if (typeof id != "undefined")return this.serialize_one(data,"");else{var stack = [];var keys = [];for (var key in data)if (data.hasOwnProperty(key)){stack.push(this.serialize_one(data[key],key+this.post_delim));keys.push(key);}
 stack.push("ids="+this.escape(keys.join(",")));if (dhtmlx.security_key)stack.push("dhx_security="+dhtmlx.security_key);return stack.join("&");}
 },
 serialize_one:function(data, pref){if (typeof data == "string")return data;var stack = [];for (var key in data)if (data.hasOwnProperty(key))
 stack.push(this.escape((pref||"")+key)+"="+this.escape(data[key]));return stack.join("&");},
 _sendData:function(a1,rowId){if (!a1)return;if (!this.callEvent("onBeforeDataSending",rowId?[rowId,this.getState(rowId),a1]:[null, null, a1])) return false;if (rowId)this._in_progress[rowId]=(new Date()).valueOf();var a2=new dtmlXMLLoaderObject(this.afterUpdate,this,true);var a3 = this.serverProcessor+(this._user?(getUrlSymbol(this.serverProcessor)+["dhx_user="+this._user,"dhx_version="+this.obj.getUserData(0,"version")].join("&")):"");if (this._tMode!="POST")a2.loadXML(a3+((a3.indexOf("?")!=-1)?"&":"?")+this.serialize(a1,rowId));else
 a2.loadXML(a3,true,this.serialize(a1,rowId));this._waitMode++;},
 sendAllData:function(){if (!this.updatedRows.length)return;this.messages=[];var valid=true;for (var i=0;i<this.updatedRows.length;i++)valid&=this.checkBeforeUpdate(this.updatedRows[i]);if (!valid && !this.callEvent("onValidationError",["",this.messages])) return false;if (this._tSend)this._sendData(this._getAllData());else
 for (var i=0;i<this.updatedRows.length;i++)if (!this._in_progress[this.updatedRows[i]]){if (this.is_invalid(this.updatedRows[i])) continue;this._beforeSendData(this._getRowData(this.updatedRows[i]),this.updatedRows[i]);if (this._waitMode && (this.obj.mytype=="tree" || this.obj._h2)) return;}
 },
 
 
 
 
 
 
 
 
 _getAllData:function(rowId){var out={};var has_one = false;for(var i=0;i<this.updatedRows.length;i++){var id=this.updatedRows[i];if (this._in_progress[id] || this.is_invalid(id)) continue;if (!this.callEvent("onBeforeUpdate",[id,this.getState(id)])) continue;out[id]=this._getRowData(id,id+this.post_delim);has_one = true;this._in_progress[id]=(new Date()).valueOf();}
 return has_one?out:null;},
 
 
 
 setVerificator:function(ind,verifFunction){this.mandatoryFields[ind] = verifFunction||(function(value){return (value!="");});},
 
 clearVerificator:function(ind){this.mandatoryFields[ind] = false;},
 
 
 
 
 
 findRow:function(pattern){var i=0;for(i=0;i<this.updatedRows.length;i++)if(pattern==this.updatedRows[i])break;return i;},

 
 


 





 
 defineAction:function(name,handler){if (!this._uActions)this._uActions=[];this._uActions[name]=handler;},




 
 afterUpdateCallback:function(sid, tid, action, btag) {var marker = sid;var correct=(action!="error" && action!="invalid");if (!correct)this.set_invalid(sid,action);if ((this._uActions)&&(this._uActions[action])&&(!this._uActions[action](btag))) 
 return (delete this._in_progress[marker]);if (this._in_progress[marker]!="wait")this.setUpdated(sid, false);var soid = sid;switch (action) {case "inserted":
 case "insert":
 if (tid != sid){this.obj[this._methods[2]](sid, tid);sid = tid;}
 break;case "delete":
 case "deleted":
 this.obj.setUserData(sid, this.action_param, "true_deleted");this.obj[this._methods[3]](sid);delete this._in_progress[marker];return this.callEvent("onAfterUpdate", [sid, action, tid, btag]);break;}
 
 if (this._in_progress[marker]!="wait"){if (correct)this.obj.setUserData(sid, this.action_param,'');delete this._in_progress[marker];}else {delete this._in_progress[marker];this.setUpdated(tid,true,this.obj.getUserData(sid,this.action_param));}
 
 this.callEvent("onAfterUpdate", [sid, action, tid, btag]);},

 
 afterUpdate:function(that,b,c,d,xml){xml.getXMLTopNode("data");if (!xml.xmlDoc.responseXML)return;var atag=xml.doXPath("//data/action");for (var i=0;i<atag.length;i++){var btag=atag[i];var action = btag.getAttribute("type");var sid = btag.getAttribute("sid");var tid = btag.getAttribute("tid");that.afterUpdateCallback(sid,tid,action,btag);}
 that.finalizeUpdate();},
 finalizeUpdate:function(){if (this._waitMode)this._waitMode--;if ((this.obj.mytype=="tree" || this.obj._h2)&& this.updatedRows.length) 
 this.sendData();this.callEvent("onAfterUpdateFinish",[]);if (!this.updatedRows.length)this.callEvent("onFullSync",[]);},




 
 
 init:function(anObj){this.obj = anObj;if (this.obj._dp_init)this.obj._dp_init(this);},
 
 
 setOnAfterUpdate:function(ev){this.attachEvent("onAfterUpdate",ev);},
 enableDebug:function(mode){},
 setOnBeforeUpdateHandler:function(func){this.attachEvent("onBeforeDataSending",func);},



 
 setAutoUpdate: function(interval, user) {interval = interval || 2000;this._user = user || (new Date()).valueOf();this._need_update = false;this._loader = null;this._update_busy = false;this.attachEvent("onAfterUpdate",function(sid,action,tid,xml_node){this.afterAutoUpdate(sid, action, tid, xml_node);});this.attachEvent("onFullSync",function(){this.fullSync();});var self = this;window.setInterval(function(){self.loadUpdate();}, interval);},


 
 afterAutoUpdate: function(sid, action, tid, xml_node) {if (action == 'collision'){this._need_update = true;return false;}else {return true;}
 },


 
 fullSync: function() {if (this._need_update == true){this._need_update = false;this.loadUpdate();}
 return true;},


 
 getUpdates: function(url,callback){if (this._update_busy)return false;else
 this._update_busy = true;this._loader = this._loader || new dtmlXMLLoaderObject(true);this._loader.async=true;this._loader.waitCall=callback;this._loader.loadXML(url);},


 
 _v: function(node) {if (node.firstChild)return node.firstChild.nodeValue;return "";},


 
 _a: function(arr) {var res = [];for (var i=0;i < arr.length;i++){res[i]=this._v(arr[i]);};return res;},


 
 loadUpdate: function(){var self = this;var version = this.obj.getUserData(0,"version");var url = this.serverProcessor+getUrlSymbol(this.serverProcessor)+["dhx_user="+this._user,"dhx_version="+version].join("&");url = url.replace("editing=true&","");this.getUpdates(url, function(){var vers = self._loader.doXPath("//userdata");self.obj.setUserData(0,"version",self._v(vers[0]));var upds = self._loader.doXPath("//update");if (upds.length){self._silent_mode = true;for (var i=0;i<upds.length;i++){var status = upds[i].getAttribute('status');var id = upds[i].getAttribute('id');var parent = upds[i].getAttribute('parent');switch (status) {case 'inserted':
 self.callEvent("insertCallback",[upds[i], id, parent]);break;case 'updated':
 self.callEvent("updateCallback",[upds[i], id, parent]);break;case 'deleted':
 self.callEvent("deleteCallback",[upds[i], id, parent]);break;}
 }
 
 self._silent_mode = false;}
 
 self._update_busy = false;self = null;});}
};window.dhx||(dhx={});dhx.version="3.0";dhx.codebase="./";dhx.name="Core";dhx.clone=function(a){var b=dhx.clone.ua;b.prototype=a;return new b};dhx.clone.ua=function(){};dhx.extend=function(a,b,c){if(a.o)return dhx.PowerArray.insertAt.call(a.o,b,1),a;for(var d in b)if(!a[d]||c)a[d]=b[d];b.defaults&&dhx.extend(a.defaults,b.defaults);b.$init&&b.$init.call(a);return a};dhx.copy=function(a){var b=a.length?[]:{};arguments.length>1&&(b=arguments[0],a=arguments[1]);for(var c in a)a[c]&&typeof a[c]=="object"&&!dhx.isDate(a[c])?(b[c]=a[c].length?[]:{},dhx.copy(b[c],a[c])):b[c]=a[c];return b};dhx.single=function(a){var b=null,c=function(c){b||(b=new a({}));b.Fa&&b.Fa.apply(b,arguments);return b};return c};dhx.protoUI=function(){var a=arguments,b=a[0].name,c=function(a){if(!c)return dhx.ui[b].prototype;var e=c.o;if(e){for(var f=[e[0]],g=1;g<e.length;g++)f[g]=e[g],f[g].o&&(f[g]=f[g].call(dhx,f[g].name)),f[g].prototype&&f[g].prototype.name&&(dhx.ui[f[g].prototype.name]=f[g]);dhx.ui[b]=dhx.proto.apply(dhx,f);if(c.p)for(g=0;g<c.p.length;g++)dhx.Type(dhx.ui[b],c.p[g]);c=e=null}return this!=dhx?new dhx.ui[b](a):dhx.ui[b]};c.o=Array.prototype.slice.call(arguments,0);return dhx.ui[b]=c};dhx.proto=function(){for(var a=arguments,b=a[0],c=!!b.$init,d=[],e=a.length-1;e>0;e--){if(typeof a[e]=="function")a[e]=a[e].prototype;a[e].$init&&d.push(a[e].$init);if(a[e].defaults){var f=a[e].defaults;if(!b.defaults)b.defaults={};for(var g in f)dhx.isUndefined(b.defaults[g])&&(b.defaults[g]=f[g])}if(a[e].type&&b.type)for(g in a[e].type)b.type[g]||(b.type[g]=a[e].type[g]);for(var i in a[e])b[i]||(b[i]=a[e][i])}c&&d.push(b.$init);b.$init=function(){for(var a=0;a<d.length;a++)d[a].apply(this,arguments)};var h=function(a){this.$ready=[];this.$init(a);this.X&&this.X(a,this.defaults);for(var b=0;b<this.$ready.length;b++)this.$ready[b].call(this)};h.prototype=b;b=a=null;return h};dhx.bind=function(a,b){return function(){return a.apply(b,arguments)}};dhx.require=function(a){dhx.V[a]||(dhx.exec(dhx.ajax().sync().get(dhx.codebase+a).responseText),dhx.V[a]=!0)};dhx.V={};dhx.exec=function(a){window.execScript?window.execScript(a):window.eval(a)};dhx.wrap=function(a,b){return!a?b:function(){var c=a.apply(this,arguments);b.apply(this,arguments);return c}};dhx.isUndefined=function(a){return typeof a=="undefined"};dhx.delay=function(a,b,c,d){return window.setTimeout(function(){var d=a.apply(b,c||[]);a=b=c=null;return d},d||1)};dhx.uid=function(){if(!this.N)this.N=(new Date).valueOf();this.N++;return this.N};dhx.toNode=function(a){return typeof a=="string"?document.getElementById(a):a};dhx.toArray=function(a){return dhx.extend(a||[],dhx.PowerArray,!0)};dhx.toFunctor=function(a){return typeof a=="string"?eval(a):a};dhx.isArray=function(a){return Object.prototype.toString.call(a)==="[object Array]"};dhx.isDate=function(a){return a instanceof Date};dhx.H={};dhx.event=function(a,b,c,d){var a=dhx.toNode(a),e=dhx.uid();d&&(c=dhx.bind(c,d));dhx.H[e]=[a,b,c];a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,c);return e};dhx.eventRemove=function(a){if(a){var b=dhx.H[a];b[0].removeEventListener?b[0].removeEventListener(b[1],b[2],!1):b[0].detachEvent&&b[0].detachEvent("on"+b[1],b[2]);delete this.H[a]}};dhx.EventSystem={$init:function(){if(!this.d)this.d={},this.q={},this.I={}},blockEvent:function(){this.d.P=!0},unblockEvent:function(){this.d.P=!1},mapEvent:function(a){dhx.extend(this.I,a,!0)},on_setter:function(a){if(a)for(var b in a)typeof a[b]=="function"&&this.attachEvent(b,a[b])},callEvent:function(a,b){if(this.d.P)return!0;var a=a.toLowerCase(),c=this.d[a.toLowerCase()],d=!0;if(c)for(var e=0;e<c.length;e++)if(c[e].apply(this,b||[])===!1)d=!1;this.I[a]&&!this.I[a].callEvent(a,b)&&(d=!1);return d},
attachEvent:function(a,b,c){var a=a.toLowerCase(),c=c||dhx.uid(),b=dhx.toFunctor(b),d=this.d[a]||dhx.toArray();d.push(b);this.d[a]=d;this.q[c]={f:b,t:a};return c},detachEvent:function(a){if(this.q[a]){var b=this.q[a].t,c=this.q[a].f,d=this.d[b];d.remove(c);delete this.q[a]}},hasEvent:function(a){a=a.toLowerCase();return this.d[a]?!0:!1}};dhx.extend(dhx,dhx.EventSystem);dhx.PowerArray={removeAt:function(a,b){a>=0&&this.splice(a,b||1)},remove:function(a){this.removeAt(this.find(a))},insertAt:function(a,b){if(!b&&b!==0)this.push(a);else{var c=this.splice(b,this.length-b);this[b]=a;this.push.apply(this,c)}},find:function(a){for(var b=0;b<this.length;b++)if(a==this[b])return b;return-1},each:function(a,b){for(var c=0;c<this.length;c++)a.call(b||this,this[c])},map:function(a,b){for(var c=0;c<this.length;c++)this[c]=a.call(b||this,this[c]);return this}};dhx.env={};(function(){if(navigator.userAgent.indexOf("Mobile")!=-1)dhx.env.mobile=!0;if(dhx.env.mobile||navigator.userAgent.indexOf("iPad")!=-1||navigator.userAgent.indexOf("Android")!=-1)dhx.env.touch=!0;navigator.userAgent.indexOf("Opera")!=-1?dhx.env.isOpera=!0:(dhx.env.isIE=!!document.all,dhx.env.isFF=!document.all,dhx.env.isWebKit=navigator.userAgent.indexOf("KHTML")!=-1,dhx.env.isSafari=dhx.env.isWebKit&&navigator.userAgent.indexOf("Mac")!=-1);if(navigator.userAgent.toLowerCase().indexOf("android")!=
-1)dhx.env.isAndroid=!0;dhx.env.transform=!1;dhx.env.transition=!1;for(var a={names:["transform","transition"],transform:["transform","WebkitTransform","MozTransform","OTransform","msTransform"],transition:["transition","WebkitTransition","MozTransition","OTransition","msTransition"]},b=document.createElement("DIV"),c=0;c<a.names.length;c++)for(var d=a[a.names[c]],e=0;e<d.length;e++)if(typeof b.style[d[e]]!="undefined"){dhx.env[a.names[c]]=d[e];break}b.style[dhx.env.transform]="translate3d(0,0,0)";dhx.env.translate=b.style[dhx.env.transform]?"translate3d":"translate";var f="",g=!1;dhx.env.isOpera&&(f="-o-",g="O");dhx.env.isFF&&(f="-Moz-");dhx.env.isWebKit&&(f="-webkit-");dhx.env.isIE&&(f="-ms-");dhx.env.transformCSSPrefix=f;dhx.env.transformPrefix=g||dhx.env.transformCSSPrefix.replace(/-/gi,"");dhx.env.transitionEnd=dhx.env.transformCSSPrefix=="-Moz-"?"transitionend":dhx.env.transformPrefix+"TransitionEnd"})();dhx.env.svg=function(){return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure","1.1")}();dhx.html={s:0,denySelect:function(){if(!dhx.s)dhx.s=document.onselectstart;document.onselectstart=dhx.html.stopEvent},allowSelect:function(){if(dhx.s!==0)document.onselectstart=dhx.s||null;dhx.s=0},index:function(a){for(var b=0;a=a.previousSibling;)b++;return b},da:{},createCss:function(a){var b="",c;for(c in a)b+=c+":"+a[c]+";";var d=this.da[b];d||(d="s"+dhx.uid(),this.addStyle("."+d+"{"+b+"}"),this.da[b]=d);return d},addStyle:function(a){var b=document.createElement("style");b.setAttribute("type",
"text/css");b.setAttribute("media","screen");b.styleSheet?b.styleSheet.cssText=a:b.appendChild(document.createTextNode(a));document.getElementsByTagName("head")[0].appendChild(b)},create:function(a,b,c){var b=b||{},d=document.createElement(a),e;for(e in b)d.setAttribute(e,b[e]);if(b.style)d.style.cssText=b.style;if(b["class"])d.className=b["class"];if(c)d.innerHTML=c;return d},getValue:function(a){a=dhx.toNode(a);return!a?"":dhx.isUndefined(a.value)?a.innerHTML:a.value},remove:function(a){if(a instanceof
Array)for(var b=0;b<a.length;b++)this.remove(a[b]);else a&&a.parentNode&&a.parentNode.removeChild(a)},insertBefore:function(a,b,c){a&&(b&&b.parentNode?b.parentNode.insertBefore(a,b):c.appendChild(a))},locate:function(a,b){if(a.tagName)var c=a;else a=a||event,c=a.target||a.srcElement;for(;c;){if(c.getAttribute){var d=c.getAttribute(b);if(d)return d}c=c.parentNode}return null},offset:function(a){if(a.getBoundingClientRect){var b=a.getBoundingClientRect(),c=document.body,d=document.documentElement,e=
window.pageYOffset||d.scrollTop||c.scrollTop,f=window.pageXOffset||d.scrollLeft||c.scrollLeft,g=d.clientTop||c.clientTop||0,i=d.clientLeft||c.clientLeft||0,h=b.top+e-g,j=b.left+f-i;return{y:Math.round(h),x:Math.round(j)}}else{for(j=h=0;a;)h+=parseInt(a.offsetTop,10),j+=parseInt(a.offsetLeft,10),a=a.offsetParent;return{y:h,x:j}}},posRelative:function(a){a=a||event;return dhx.isUndefined(a.offsetX)?{x:a.layerX,y:a.layerY}:{x:a.offsetX,y:a.offsetY}},pos:function(a){a=a||event;if(a.pageX||a.pageY)return{x:a.pageX,
y:a.pageY};var b=dhx.env.isIE&&document.compatMode!="BackCompat"?document.documentElement:document.body;return{x:a.clientX+b.scrollLeft-b.clientLeft,y:a.clientY+b.scrollTop-b.clientTop}},preventEvent:function(a){a&&a.preventDefault&&a.preventDefault();return dhx.html.stopEvent(a)},stopEvent:function(a){(a||event).cancelBubble=!0;return!1},addCss:function(a,b){a.className+=" "+b},removeCss:function(a,b){a.className=a.className.replace(RegExp(" "+b,"g"),"")}};dhx.ready=function(a){this.Da?a.call():this.B.push(a)};dhx.B=[];(function(){var a=document.getElementsByTagName("SCRIPT");if(a.length)a=(a[a.length-1].getAttribute("src")||"").split("/"),a.splice(a.length-1,1),dhx.codebase=a.slice(0,a.length).join("/")+"/";dhx.event(window,"load",function(){dhx.callEvent("onReady",[]);dhx.delay(function(){dhx.Da=!0;for(var a=0;a<dhx.B.length;a++)dhx.B[a].call();dhx.B=[]})})})();dhx.locale=dhx.locale||{};dhx.ready(function(){dhx.event(document.body,"click",function(a){dhx.callEvent("onClick",[a||event])})});(function(){var a={},b=RegExp("(\\r\\n|\\n)","g"),c=RegExp('(\\")',"g");dhx.Template=function(d){if(typeof d=="function")return d;if(a[d])return a[d];d=(d||"").toString();if(d.indexOf("->")!=-1)switch(d=d.split("->"),d[0]){case "html":d=dhx.html.getValue(d[1]);break;case "http":d=(new dhx.ajax).sync().get(d[1],{uid:dhx.uid()}).responseText}d=(d||"").toString();d=d.replace(b,"\\n");d=d.replace(c,'\\"');d=d.replace(/\{obj\.([^}?]+)\?([^:]*):([^}]*)\}/g,'"+(obj.$1?"$2":"$3")+"');d=d.replace(/\{common\.([^}\(]*)\}/g,
"\"+(common.$1||'')+\"");d=d.replace(/\{common\.([^\}\(]*)\(\)\}/g,'"+(common.$1?common.$1(obj,common):"")+"');d=d.replace(/\{obj\.([^}]*)\}/g,'"+(obj.$1)+"');d=d.replace("{obj}",'"+obj+"');d=d.replace(/#([^#'";, ]+)#/gi,'"+(obj.$1)+"');try{a[d]=Function("obj","common",'return "'+d+'";')}catch(e){}return a[d]};dhx.Template.empty=function(){return""};dhx.Template.bind=function(a){return dhx.bind(dhx.Template(a),this)};dhx.Type=function(a,b){if(a.o){if(!a.p)a.p=[];a.p.push(b)}else{if(typeof a=="function")a=
a.prototype;if(!a.types)a.types={"default":a.type},a.type.name="default";var c=b.name,g=a.type;c&&(g=a.types[c]=dhx.clone(b.baseType?a.types[b.baseType]:a.type));for(var i in b)g[i]=i.indexOf("template")===0?dhx.Template(b[i]):b[i];return c}}})();dhx.Settings={$init:function(){this.a=this.config={}},define:function(a,b){return typeof a=="object"?this.M(a):this.Q(a,b)},Q:function(a,b){var c=this[a+"_setter"];return this.a[a]=c?c.call(this,b,a):b},M:function(a){if(a)for(var b in a)this.Q(b,a[b])},X:function(a,b){var c={};b&&(c=dhx.extend(c,b));typeof a=="object"&&!a.tagName&&dhx.extend(c,a,!0);this.M(c)},ya:function(a,b){for(var c in b)switch(typeof a[c]){case "object":a[c]=this.ya(a[c]||{},b[c]);break;case "undefined":a[c]=b[c]}return a}};dhx.ajax=function(a,b,c){if(arguments.length!==0){var d=new dhx.ajax;if(c)d.master=c;return d.get(a,null,b)}return!this.getXHR?new dhx.ajax:this};dhx.ajax.count=0;dhx.ajax.prototype={master:null,getXHR:function(){return dhx.env.isIE?new ActiveXObject("Microsoft.xmlHTTP"):new XMLHttpRequest},send:function(a,b,c){var d=this.getXHR();dhx.isArray(c)||(c=[c]);if(typeof b=="object"){var e=[],f;for(f in b){var g=b[f];if(g===null||g===dhx.undefined)g="";e.push(f+"="+encodeURIComponent(g))}b=e.join("&")}b&&this.request==="GET"&&(a=a+(a.indexOf("?")!=-1?"&":"?")+b,b=null);d.open(this.request,a,!this.Ka);this.request==="POST"&&d.setRequestHeader("Content-type","application/x-www-form-urlencoded");var i=this;d.onreadystatechange=function(){if(!d.readyState||d.readyState==4){dhx.ajax.count++;if(c&&i)for(var a=0;a<c.length;a++)if(c[a]){var b=c[a].success||c[a];if(d.status>=400||!d.status&&!d.responseText)b=c[a].error;b&&b.call(i.master||i,d.responseText,d.responseXML,d)}c=i=i.master=null}};d.send(b||null);return d},get:function(a,b,c){this.request="GET";return this.send(a,b,c)},post:function(a,b,c){this.request="POST";return this.send(a,b,c)},put:function(a,b,c){this.request="PUT";return this.send(a,
b,c)},del:function(a,b,c){this.request="DELETE";return this.send(a,b,c)},sync:function(){this.Ka=!0;return this},bind:function(a){this.master=a;return this}};dhx.send=function(a,b,c){var d=dhx.html.create("FORM",{action:a,method:c||"POST"},""),e;for(e in b){var f=dhx.html.create("INPUT",{type:"hidden",name:e,value:b[e]},"");d.appendChild(f)}d.style.display="none";document.body.appendChild(d);d.submit();document.body.removeChild(d)};dhx.AtomDataLoader={$init:function(a){this.data={};if(a)this.a.datatype=a.datatype||"json",this.$ready.push(this.xa)},xa:function(){this.Y=!0;this.a.url&&this.url_setter(this.a.url);this.a.data&&this.data_setter(this.a.data)},url_setter:function(a){if(!this.Y)return a;this.load(a,this.a.datatype);return a},data_setter:function(a){if(!this.Y)return a;this.parse(a,this.a.datatype);return!0},load:function(a,b,c){if(a.$proxy)a.load(this,typeof b=="string"?b:"json");else{this.callEvent("onXLS",[]);if(typeof b==
"string")this.data.driver=dhx.DataDriver[b],b=c;else if(!this.data.driver)this.data.driver=dhx.DataDriver.json;var d=[{success:this.L,error:this.A}];b&&(dhx.isArray(b)?d.push.apply(d,b):d.push(b));return dhx.ajax(a,d,this)}},parse:function(a,b){this.callEvent("onXLS",[]);this.data.driver=dhx.DataDriver[b||"json"];this.L(a,null)},L:function(a,b,c){var d=this.data.driver,e=d.toObject(a,b);if(e){var f=d.getRecords(e)[0];this.data=d?d.getDetails(f):a}else this.A(a,b,c);this.callEvent("onXLE",[])},A:function(a,
b,c){this.callEvent("onXLE",[]);this.callEvent("onLoadError",arguments);dhx.callEvent("onLoadError",[a,b,c,this])},v:function(a){if(!this.a.dataFeed||this.J||!a)return!0;var b=this.a.dataFeed;if(typeof b=="function")return b.call(this,a.id||a,a);b=b+(b.indexOf("?")==-1?"?":"&")+"action=get&id="+encodeURIComponent(a.id||a);this.callEvent("onXLS",[]);dhx.ajax(b,function(a,b,e){this.J=!0;var f=dhx.DataDriver.toObject(a,b);f?this.setValues(f.getDetails(f.getRecords()[0])):this.A(a,b,e);this.J=!1;this.callEvent("onXLE",
[])},this);return!1}};dhx.DataDriver={};dhx.DataDriver.json={toObject:function(a){a||(a="[]");if(typeof a=="string"){try{eval("dhx.temp="+a)}catch(b){return null}a=dhx.temp}if(a.data){var c=a.data.config={},d;for(d in a)d!="data"&&(c[d]=a[d]);a=a.data}return a},getRecords:function(a){return a&&!dhx.isArray(a)?[a]:a},getDetails:function(a){return typeof a=="string"?{id:dhx.uid(),value:a}:a},getInfo:function(a){var b=a.config;return!b?{}:{k:b.total_count||0,j:b.pos||0,Ba:b.parent||0,G:b.config,K:b.dhx_security}},child:"data"};dhx.DataDriver.html={toObject:function(a){if(typeof a=="string"){var b=null;a.indexOf("<")==-1&&(b=dhx.toNode(a));if(!b)b=document.createElement("DIV"),b.innerHTML=a;return b.getElementsByTagName(this.tag)}return a},getRecords:function(a){for(var b=[],c=0;c<a.childNodes.length;c++){var d=a.childNodes[c];d.nodeType==1&&b.push(d)}return b},getDetails:function(a){return dhx.DataDriver.xml.tagToObject(a)},getInfo:function(){return{k:0,j:0}},tag:"LI"};dhx.DataDriver.jsarray={toObject:function(a){return typeof a=="string"?(eval("dhx.temp="+a),dhx.temp):a},getRecords:function(a){return a},getDetails:function(a){for(var b={},c=0;c<a.length;c++)b["data"+c]=a[c];return b},getInfo:function(){return{k:0,j:0}}};dhx.DataDriver.csv={toObject:function(a){return a},getRecords:function(a){return a.split(this.row)},getDetails:function(a){for(var a=this.stringToArray(a),b={},c=0;c<a.length;c++)b["data"+c]=a[c];return b},getInfo:function(){return{k:0,j:0}},stringToArray:function(a){for(var a=a.split(this.cell),b=0;b<a.length;b++)a[b]=a[b].replace(/^[ \t\n\r]*(\"|)/g,"").replace(/(\"|)[ \t\n\r]*$/g,"");return a},row:"\n",cell:","};dhx.DataDriver.xml={U:function(a){return!a||!a.documentElement?null:a.getElementsByTagName("parsererror").length?null:a},toObject:function(a){if(this.U(b))return b;var b=typeof a=="string"?this.fromString(a.replace(/^[\s]+/,"")):a;return this.U(b)?b:null},getRecords:function(a){return this.xpath(a,this.records)},records:"/*/item",child:"item",config:"/*/config",getDetails:function(a){return this.tagToObject(a,{})},getInfo:function(a){var b=this.xpath(a,this.config),b=b.length?this.assignTypes(this.tagToObject(b[0],
{})):null;return{k:a.documentElement.getAttribute("total_count")||0,j:a.documentElement.getAttribute("pos")||0,Ba:a.documentElement.getAttribute("parent")||0,G:b,K:a.documentElement.getAttribute("dhx_security")||null}},xpath:function(a,b){if(window.XPathResult){var c=a;if(a.nodeName.indexOf("document")==-1)a=a.ownerDocument;for(var d=[],e=a.evaluate(b,c,null,XPathResult.ANY_TYPE,null),f=e.iterateNext();f;)d.push(f),f=e.iterateNext();return d}else{var g=!0;try{typeof a.selectNodes=="undefined"&&(g=
!1)}catch(i){}if(g)return a.selectNodes(b);else{var h=b.split("/").pop();return a.getElementsByTagName(h)}}},assignTypes:function(a){for(var b in a){var c=a[b];typeof c=="object"?this.assignTypes(c):typeof c=="string"&&c!==""&&(c=="true"?a[b]=!0:c=="false"?a[b]=!1:c==c*1&&(a[b]*=1))}return a},tagToObject:function(a,b){var b=b||{},c=!1,d=a.attributes;if(d&&d.length){for(var e=0;e<d.length;e++)b[d[e].name]=d[e].value;c=!0}for(var f=a.childNodes,g={},e=0;e<f.length;e++)if(f[e].nodeType==1){var i=f[e].tagName;typeof b[i]!="undefined"?(dhx.isArray(b[i])||(b[i]=[b[i]]),b[i].push(this.tagToObject(f[e],{}))):b[f[e].tagName]=this.tagToObject(f[e],{});c=!0}if(!c)return this.nodeValue(a);b.value=b.value||this.nodeValue(a);return b},nodeValue:function(a){return a.firstChild?a.firstChild.data:""},fromString:function(a){try{if(window.DOMParser)return(new DOMParser).parseFromString(a,"text/xml");if(window.ActiveXObject){var b=new ActiveXObject("Microsoft.xmlDOM");b.loadXML(a);return b}}catch(c){return null}}};dhx.DataLoader=dhx.proto({$init:function(a){a=a||"";this.l=dhx.toArray();this.data=new dhx.DataStore;this.data.attachEvent("onClearAll",dhx.bind(this.la,this));this.data.attachEvent("onServerConfig",dhx.bind(this.ka,this));this.data.feed=this.pa},pa:function(a,b,c){if(this.r)return this.r=[a,b,c];else this.r=!0;this.S=[a,b];this.ra.call(this,a,b,c)},ra:function(a,b,c){var d=this.data.url;a<0&&(a=0);this.load(d+(d.indexOf("?")==-1?"?":"&")+(this.dataCount()?"continue=true&":"")+"start="+a+"&count="+
b,[this.qa,c])},qa:function(){var a=this.r,b=this.S;this.r=!1;typeof a=="object"&&(a[0]!=b[0]||a[1]!=b[1])&&this.data.feed.apply(this,a)},load:function(a,b){var c=dhx.AtomDataLoader.load.apply(this,arguments);this.l.push(c);if(!this.data.url)this.data.url=a},loadNext:function(a,b,c,d,e){this.a.datathrottle&&!e?(this.ea&&window.clearTimeout(this.ea),this.ea=dhx.delay(function(){this.loadNext(a,b,c,d,!0)},this,0,this.a.datathrottle)):(!b&&b!==0&&(b=this.dataCount()),this.data.url=this.data.url||d,this.callEvent("onDataRequest",
[b,a,c,d])&&this.data.url&&this.data.feed.call(this,b,a,c))},Na:function(a,b){var c=this.S;return this.r&&c&&c[0]<=b&&c[1]+c[0]>=a+b?!0:!1},L:function(a,b,c){this.l.remove(c);var d=this.data.driver.toObject(a,b);if(d)this.data.Ca(d);else return this.A(a,b,c);this.ma();this.callEvent("onXLE",[])},removeMissed_setter:function(a){return this.data.Ga=a},scheme_setter:function(a){this.data.scheme(a)},dataFeed_setter:function(a){this.data.attachEvent("onBeforeFilter",dhx.bind(function(a,c){if(this.a.dataFeed){var d=
{};if(a||c){if(typeof a=="function"){if(!c)return;a(c,d)}else d={text:c};this.clearAll();var e=this.a.dataFeed,f=[];if(typeof e=="function")return e.call(this,c,d);for(var g in d)f.push("dhx_filter["+g+"]="+encodeURIComponent(d[g]));this.load(e+(e.indexOf("?")<0?"?":"&")+f.join("&"),this.a.datatype);return!1}}},this));return a},ma:function(){if(this.a.ready&&!this.Ea){var a=dhx.toFunctor(this.a.ready);a&&dhx.delay(a,this,arguments);this.Ea=!0}},la:function(){for(var a=0;a<this.l.length;a++)this.l[a].abort();this.l=dhx.toArray()},ka:function(a){this.M(a)}},dhx.AtomDataLoader);dhx.DataStore=function(){this.name="DataStore";dhx.extend(this,dhx.EventSystem);this.setDriver("json");this.pull={};this.order=dhx.toArray()};dhx.DataStore.prototype={setDriver:function(a){this.driver=dhx.DataDriver[a]},Ca:function(a){this.callEvent("onParse",[this.driver,a]);this.c&&this.filter();var b=this.driver.getInfo(a);if(b.K)dhx.securityKey=b.K;b.G&&this.callEvent("onServerConfig",[b.G]);var c=this.driver.getRecords(a);this.wa(b,c);this.Z&&this.va&&this.va(this.Z);this.aa&&(this.blockEvent(),this.sort(this.aa),this.unblockEvent());this.callEvent("onStoreLoad",[this.driver,a]);this.refresh()},wa:function(a,b){var c=(a.j||0)*1,d=
!0,e=!1;if(c===0&&this.order[0]){if(this.Ga)for(var e={},f=0;f<this.order.length;f++)e[this.order[f]]=!0;d=!1;c=this.order.length}for(var g=0,f=0;f<b.length;f++){var i=this.driver.getDetails(b[f]),h=this.id(i);this.pull[h]?d&&this.order[g+c]&&g++:(this.order[g+c]=h,g++);this.pull[h]?(dhx.extend(this.pull[h],i,!0),this.D&&this.D(this.pull[h]),e&&delete e[h]):(this.pull[h]=i,this.C&&this.C(i))}if(e){this.blockEvent();for(var j in e)this.remove(j);this.unblockEvent()}if(!this.order[a.k-1])this.order[a.k-
1]=dhx.undefined},id:function(a){return a.id||(a.id=dhx.uid())},changeId:function(a,b){this.pull[a]&&(this.pull[b]=this.pull[a]);this.pull[b].id=b;this.order[this.order.find(a)]=b;this.c&&(this.c[this.c.find(a)]=b);this.callEvent("onIdChange",[a,b]);this.Ha&&this.Ha(a,b);delete this.pull[a]},item:function(a){return this.pull[a]},update:function(a,b){dhx.isUndefined(b)&&(b=this.item(a));this.D&&this.D(b);if(this.callEvent("onBeforeUpdate",[a,b])===!1)return!1;this.pull[a]=b;this.callEvent("onStoreUpdated",
[a,b,"update"])},refresh:function(a){this.ca||(a?this.callEvent("onStoreUpdated",[a,this.pull[a],"paint"]):this.callEvent("onStoreUpdated",[null,null,null]))},silent:function(a,b){this.ca=!0;a.call(b||this);this.ca=!1},getRange:function(a,b){a=a?this.indexById(a):this.$min||this.startOffset||0;b?b=this.indexById(b):(b=Math.min(this.$max||this.endOffset||Infinity,this.dataCount()-1),b<0&&(b=0));if(a>b)var c=b,b=a,a=c;return this.getIndexRange(a,b)},getIndexRange:function(a,b){for(var b=Math.min(b||
Infinity,this.dataCount()-1),c=dhx.toArray(),d=a||0;d<=b;d++)c.push(this.item(this.order[d]));return c},dataCount:function(){return this.order.length},exists:function(a){return!!this.pull[a]},move:function(a,b){var c=this.idByIndex(a),d=this.item(c);this.order.removeAt(a);this.order.insertAt(c,Math.min(this.order.length,b));this.callEvent("onStoreUpdated",[c,d,"move"])},scheme:function(a){this.Oa=a;this.C=a.$init;this.D=a.$update;this.$=a.$serialize;if(a.$group)this.Z=a.$group;this.aa=a.$sort;delete a.$init;delete a.$update;delete a.$serialize;delete a.$group;delete a.$sort},sync:function(a,b,c){typeof b!="function"&&(c=b,b=null);if(a.name!="DataStore")a=a.data;var d=dhx.bind(function(){this.order=dhx.toArray([].concat(a.order));this.c=null;this.pull=a.pull;b&&this.silent(b);this.W&&this.W();c?c=!1:this.refresh()},this);this.u=[a.attachEvent("onStoreUpdated",d)];d()},add:function(a,b){this.C&&this.C(a);var c=this.id(a),d=this.order.length;if(dhx.isUndefined(b)||b<0)b=d;b>d&&(b=Math.min(this.order.length,
b));if(this.callEvent("onBeforeAdd",[c,a,b])===!1)return!1;this.pull[c]=a;this.order.insertAt(c,b);if(this.c){var e=this.c.length;!b&&this.order.length&&(e=0);this.c.insertAt(c,e)}this.callEvent("onAfterAdd",[c,b]);this.callEvent("onStoreUpdated",[c,a,"add"]);return c},remove:function(a){if(dhx.isArray(a))for(var b=0;b<a.length;b++)this.remove(a[b]);else{if(this.callEvent("onBeforeDelete",[a])===!1)return!1;var c=this.item(a);this.order.remove(a);this.c&&this.c.remove(a);delete this.pull[a];this.callEvent("onAfterDelete",
[a]);this.callEvent("onStoreUpdated",[a,c,"delete"])}},clearAll:function(){this.pull={};this.order=dhx.toArray();this.c=null;this.callEvent("onClearAll",[]);this.refresh()},idByIndex:function(a){return this.order[a]},indexById:function(a){var b=this.order.find(a);return b},next:function(a,b){return this.order[this.indexById(a)+(b||1)]},first:function(){return this.order[0]},last:function(){return this.order[this.order.length-1]},previous:function(a,b){return this.order[this.indexById(a)-(b||1)]},
sort:function(a,b,c){var d=a;typeof a=="function"?d={as:a,dir:b}:typeof a=="string"&&(d={by:a.replace(/#/g,""),dir:b,as:c});var e=[d.by,d.dir,d.as];this.callEvent("onBeforeSort",e)&&(this.Ja(d),this.refresh(),this.callEvent("onAfterSort",e))},Ja:function(a){if(this.order.length){var b=this.Ia.na(a),c=this.getRange(this.first(),this.last());c.sort(b);this.order=c.map(function(a){return this.id(a)},this)}},ta:function(a){if(this.c&&!a)this.order=this.c,delete this.c;return this.order.length},sa:function(a,
b,c){for(var d=dhx.toArray(),e=0;e<this.order.length;e++){var f=this.order[e];a(this.item(f),b)&&d.push(f)}if(!c||!this.c)this.c=this.order;this.order=d},filter:function(a,b,c){if(this.callEvent("onBeforeFilter",[a,b])&&this.ta(c)){if(a){var d=a,b=b||"";typeof a=="string"&&(a=a.replace(/#/g,""),b=b.toString().toLowerCase(),d=function(b,c){return(b[a]||"").toString().toLowerCase().indexOf(c)!=-1});this.sa(d,b,c)}this.refresh();this.callEvent("onAfterFilter",[])}},each:function(a,b){for(var c=0;c<this.order.length;c++)a.call(b||
this,this.item(this.order[c]))},za:function(a,b){return function(){return a[b].apply(a,arguments)}},provideApi:function(a,b){b&&this.mapEvent({onbeforesort:a,onaftersort:a,onbeforeadd:a,onafteradd:a,onbeforedelete:a,onafterdelete:a,onbeforeupdate:a});for(var c="sort,add,remove,exists,idByIndex,indexById,item,update,refresh,dataCount,filter,next,previous,clearAll,first,last,serialize,sync".split(","),d=0;d<c.length;d++)a[c[d]]=this.za(this,c[d])},serialize:function(){for(var a=this.order,b=[],c=0;c<
a.length;c++){var d=this.pull[a[c]];if(this.$&&(d=this.$(d),d===!1))continue;b.push(d)}return b},Ia:{na:function(a){return this.oa(a.dir,this.ja(a.by,a.as))},ga:{date:function(a,b){a-=0;b-=0;return a>b?1:a<b?-1:0},"int":function(a,b){a*=1;b*=1;return a>b?1:a<b?-1:0},string_strict:function(a,b){a=a.toString();b=b.toString();return a>b?1:a<b?-1:0},string:function(a,b){if(!b)return 1;if(!a)return-1;a=a.toString().toLowerCase();b=b.toString().toLowerCase();return a>b?1:a<b?-1:0}},ja:function(a,b){if(!a)return b;typeof b!="function"&&(b=this.ga[b||"string"]);return function(c,d){return b(c[a],d[a])}},oa:function(a,b){return a=="asc"||!a?b:function(a,d){return b(a,d)*-1}}}};dhx.BaseBind={bind:function(a,b,c){typeof a=="string"&&(a=dhx.ui.get(a));a.b&&a.b();this.b&&this.b();a.getBindData||dhx.extend(a,dhx.BindSource);if(!this.ha){var d=this.render;if(this.filter){var e=this.a.id;this.data.W=function(){a.n[e]=!1}}this.render=function(){if(!this.T){this.T=!0;var a=this.callEvent("onBindRequest");this.T=!1;return d.apply(this,a===!1?arguments:[])}};if(this.getValue||this.getValues)this.save=function(){if(!this.validate||this.validate())a.setBindData(this.getValue?this.getValue:
this.getValues(),this.a.id)};this.ha=!0}a.addBind(this.a.id,b,c);this.attachEvent(this.touchable?"onAfterRender":"onBindRequest",function(){return a.getBindData(this.a.id)});this.isVisible(this.a.id)&&this.refresh()},e:function(a){a.removeBind(this.a.id);var b=this.u||(this.data?this.data.u:0);if(b&&a.data)for(var c=0;c<b.length;c++)a.data.detachEvent(b[c])}};dhx.BindSource={$init:function(){this.m={};this.n={};this.w={};this.ia(this)},saveBatch:function(a){this.R=!0;a.call(this);this.R=!1;this.i()},setBindData:function(a,b){b&&(this.w[b]=!0);if(this.setValue)this.setValue(a);else if(this.setValues)this.setValues(a);else{var c=this.getCursor();c&&(a=dhx.extend(this.item(c),a,!0),this.update(c,a))}this.callEvent("onBindUpdate",[a,b]);this.save&&this.save();b&&(this.w[b]=!1)},getBindData:function(a,b){if(this.n[a])return!1;var c=dhx.ui.get(a);c.isVisible(c.a.id)&&
(this.n[a]=!0,this.F(c,this.m[a][0],this.m[a][1]),b&&c.filter&&c.refresh())},addBind:function(a,b,c){this.m[a]=[b,c]},removeBind:function(a){delete this.m[a];delete this.n[a];delete this.w[a]},ia:function(a){a.filter?dhx.extend(this,dhx.CollectionBind):a.setValue?dhx.extend(this,dhx.ValueBind):dhx.extend(this,dhx.RecordBind)},i:function(){if(!this.R)for(var a in this.m)this.w[a]||(this.n[a]=!1,this.getBindData(a,!0))},O:function(a,b,c){a.setValue?a.setValue(c?c[b]:c):a.filter?a.data.silent(function(){this.filter(b,
c)}):!c&&a.clear?a.clear():a.v(c)&&a.setValues(dhx.clone(c));a.callEvent("onBindApply",[c,b,this])}};dhx.DataValue=dhx.proto({name:"DataValue",isVisible:function(){return!0},$init:function(a){var b=(this.data=a)&&a.id?a.id:dhx.uid();this.a={id:b};dhx.ui.views[b]=this},setValue:function(a){this.data=a;this.callEvent("onChange",[a])},getValue:function(){return this.data},refresh:function(){this.callEvent("onBindRequest")}},dhx.EventSystem,dhx.BaseBind);dhx.DataRecord=dhx.proto({name:"DataRecord",isVisible:function(){return!0},$init:function(a){this.data=a||{};var b=a&&a.id?a.id:dhx.uid();this.a={id:b};dhx.ui.views[b]=this},getValues:function(){return this.data},setValues:function(a){this.data=a;this.callEvent("onChange",[a])},refresh:function(){this.callEvent("onBindRequest")}},dhx.EventSystem,dhx.BaseBind,dhx.AtomDataLoader,dhx.Settings);dhx.DataCollection=dhx.proto({name:"DataCollection",isVisible:function(){return!this.data.order.length&&!this.data.c&&!this.a.dataFeed?!1:!0},$init:function(a){this.data.provideApi(this,!0);var b=a&&a.id?a.id:dhx.uid();this.a.id=b;dhx.ui.views[b]=this;this.data.attachEvent("onStoreLoad",dhx.bind(function(){this.callEvent("onBindRequest",[])},this))},refresh:function(){this.callEvent("onBindRequest",[])}},dhx.DataLoader,dhx.EventSystem,dhx.BaseBind,dhx.Settings);dhx.ValueBind={$init:function(){this.attachEvent("onChange",this.i)},F:function(a,b,c){var d=this.getValue()||"";c&&(d=c(d));if(a.setValue)a.setValue(d);else if(a.filter)a.data.silent(function(){this.filter(b,d)});else{var e={};e[b]=d;a.v(d)&&a.setValues(e)}a.callEvent("onBindApply",[d,b,this])}};dhx.RecordBind={$init:function(){this.attachEvent("onChange",this.i)},F:function(a,b){var c=this.getValues()||null;this.O(a,b,c)}};dhx.CollectionBind={$init:function(){this.g=null;this.attachEvent("onSelectChange",function(){var a=this.getSelected();this.setCursor(a?a.id||a:"")});this.attachEvent("onAfterCursorChange",this.i);this.data.attachEvent("onStoreUpdated",dhx.bind(function(a){a&&a==this.getCursor()&&this.i()},this));this.data.attachEvent("onClearAll",dhx.bind(function(){this.g=null},this));this.data.attachEvent("onIdChange",dhx.bind(function(a,b){if(this.g==a)this.g=b},this))},setCursor:function(a){if(!(a==this.g||a!==
null&&!this.item(a)))this.callEvent("onBeforeCursorChange",[this.g]),this.g=a,this.callEvent("onAfterCursorChange",[a])},getCursor:function(){return this.g},F:function(a,b){var c=this.item(this.getCursor())||null;this.O(a,b,c)}};if(!dhx.ui)dhx.ui={};if(!dhx.ui.views)dhx.ui.views={},dhx.ui.get=function(a){return a.a?a:dhx.ui.views[a]};dhtmlXDataStore=function(a){var b=new dhx.DataCollection(a),c="_dp_init";b[c]=function(a){var b="_methods";a[b]=["dummy","dummy","changeId","dummy"];this.data.Aa={add:"inserted",update:"updated","delete":"deleted"};this.data.attachEvent("onStoreUpdated",function(b,c,e){b&&!a.ba&&a.setUpdated(b,!0,this.Aa[e])});b="_getRowData";a[b]=function(a){var b=this.obj.data.item(a),c={id:a,"!nativeeditor_status":this.obj.getUserData(a)};if(b)for(var d in b)d.indexOf("_")!==0&&(c[d]=b[d]);return c};this.changeId=
function(b,c){this.data.changeId(b,c);a.ba=!0;this.data.callEvent("onStoreUpdated",[c,this.item(c),"update"]);a.ba=!1};b="_clearUpdateFlag";a[b]=function(){};this.fa={}};b.dummy=function(){};b.setUserData=function(a,b,c){this.fa[a]=c};b.getUserData=function(a){return this.fa[a]};b.dataFeed=function(a){this.define("dataFeed",a)};dhx.extend(b,dhx.BindSource);return b};if(window.dhtmlXDataView)dhtmlXDataView.prototype.b=function(){this.isVisible=function(){return!this.data.order.length&&!this.data.c&&!this.a.dataFeed?!1:!0};this.a = this.a||this._settings;if(!this.a.id)this.a.id=dhx.uid();this.unbind=dhx.BaseBind.unbind;this.unsync=dhx.BaseBind.unsync;dhx.ui.views[this.a.id]=this};if(window.dhtmlXChart)dhtmlXChart.prototype.b=function(){this.isVisible=function(){return!this.data.order.length&&!this.data.Ma&&!this.a.dataFeed?!1:!0};this.a = this.a||this._settings;if(!this.a.id)this.a.id=dhx.uid();this.unbind=dhx.BaseBind.unbind;this.unsync=dhx.BaseBind.unsync;dhx.ui.views[this.a.id]=this};dhx.BaseBind.unsync=function(a){return dhx.BaseBind.e.call(this,a)};dhx.BaseBind.unbind=function(a){return dhx.BaseBind.e.call(this,a)};dhx.BaseBind.legacyBind=function(){return dhx.BaseBind.bind.apply(this,arguments)};dhx.BaseBind.legacySync=function(a,b){this.b&&this.b();a.b&&a.b();this.attachEvent("onAfterEditStop",function(a){this.save(a);return!0});this.save=function(b){b||(b=this.getCursor());var d=this.item(b),e=a.item(b),f;for(f in d)f.indexOf("$")!==0&&(e[f]=d[f]);a.refresh(b)};return a&&a.name=="DataCollection"?a.data.sync.apply(this.data,arguments):this.data.sync.apply(this.data,arguments)};if(window.dhtmlXForm)dhtmlXForm.prototype.bind=function(a){dhx.BaseBind.bind.apply(this,arguments);a.getBindData(this.a.id)},dhtmlXForm.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXForm.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this},dhtmlXForm.prototype.v=function(a){if(!this.a.dataFeed||this.J||!a)return!0;var b=this.a.dataFeed;if(typeof b=="function")return b.call(this,a.id||a,a);b=b+(b.indexOf("?")==-1?"?":
"&")+"action=get&id="+encodeURIComponent(a.id||a);this.load(b);return!1},dhtmlXForm.prototype.setValues=dhtmlXForm.prototype.setFormData,dhtmlXForm.prototype.getValues=function(){return this.getFormData(!1,!0)},dhtmlXForm.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXForm.prototype.refresh=dhtmlXForm.prototype.isVisible=function(){return!0};if(window.scheduler){if(!window.Scheduler)window.Scheduler={};Scheduler.$syncFactory=function(a){a.sync=function(b,c){this.b&&this.b();b.b&&b.b();var d="_process_loading",e=function(){a.clearAll();for(var e=b.data.order,g=b.data.pull,i=[],h=0;h<e.length;h++)i[h]=c&&c.copy?dhx.clone(g[e[h]]):g[e[h]];a[d](i)};this.save=function(a){a||(a=this.getCursor());var c=this.item(a),d=b.item(a);this.callEvent("onStoreSave",[a,c,d])&&(dhx.extend(b.item(a),c,!0),b.update(a))};this.item=function(a){return this.getEvent(a)};this.u=[b.data.attachEvent("onStoreUpdated",function(){e.call(this)}),b.data.attachEvent("onIdChange",function(a,b){combo.changeOptionId(a,b)})];this.attachEvent("onEventChanged",function(a){this.save(a)});this.attachEvent("onEventAdded",function(a,c){b.data.pull[a]||b.add(c)});e()};a.unsync=function(a){dhx.BaseBind.e.call(this,a)};a.b=function(){if(!this.a)this.a={id:dhx.uid()}}};Scheduler.$syncFactory(window.scheduler)}
if(window.dhtmlXCombo)dhtmlXCombo.prototype.bind=function(){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXCombo.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXCombo.unsync=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXCombo.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXCombo.prototype.sync=function(a){this.b&&this.b();a.b&&a.b();var b=this,c=function(){b.clearAll();b.addOption(this.serialize())};this.u=[a.data.attachEvent("onStoreUpdated",function(){c.call(this)}),
a.data.attachEvent("onIdChange",function(a,c){b.changeOptionId(a,c)})];c.call(a)},dhtmlXCombo.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this,this.data={silent:dhx.bind(function(a){a.call(this)},this)},dhtmlxEventable(this.data),this.attachEvent("onChange",function(){this.callEvent("onSelectChange",[this.getSelectedValue()])}),this.attachEvent("onXLE",function(){this.callEvent("onBindRequest",[])})},dhtmlXCombo.prototype.item=function(){return this.Pa},
dhtmlXCombo.prototype.getSelected=function(){return this.getSelectedValue()},dhtmlXCombo.prototype.isVisible=function(){return!this.optionsArr.length&&!this.a.dataFeed?!1:!0},dhtmlXCombo.prototype.refresh=function(){this.render(!0)},dhtmlXCombo.prototype.filter=function(){alert("not implemented")};if(window.dhtmlXGridObject)dhtmlXGridObject.prototype.bind=function(a,b,c){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXGridObject.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXGridObject.prototype.unsync=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXGridObject.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXGridObject.prototype.sync=function(a,b){this.b&&this.b();a.b&&a.b();var c=this,d="_parsing",e="_parser",f="_locator",g="_process_store_row",i="_get_store_data";this.save=function(b){b||(b=this.getCursor());dhx.extend(a.item(b),this.item(b),!0);a.update(b)};var h=function(){var a=0;c.z?(a=c.z,c.z=!1):c.clearAll();var b=this.dataCount();if(b){c[d]=!0;for(var h=a;h<b;h++){var k=this.order[h];if(k&&(!a||!c.rowsBuffer[h]))c.rowsBuffer[h]={idd:k,data:this.pull[k]},c.rowsBuffer[h][e]=c[g],c.rowsBuffer[h][f]=c[i],c.rowsAr[k]=this.pull[k]}if(!c.rowsBuffer[b-1])c.rowsBuffer[b-1]=dhtmlx.undefined,c.xmlFileUrl=c.xmlFileUrl||!0;c.pagingOn?c.changePage():c.Qa&&c.La?c.Ra():
(c.render_dataset(),c.callEvent("onXLE",[]));c[d]=!1}};this.u=[a.data.attachEvent("onStoreUpdated",function(a,b,d){d=="delete"?(c.deleteRow(a),c.data.callEvent("onStoreUpdated",[a,b,d])):d=="update"?(c.callEvent("onSyncUpdate",[b,d]),c.update(a,b),c.data.callEvent("onStoreUpdated",[a,b,d])):d=="add"?(c.callEvent("onSyncUpdate",[b,d]),c.add(a,b,this.indexById(a)),c.data.callEvent("onStoreUpdated",[a,b,d])):h.call(this)}),a.data.attachEvent("onStoreLoad",function(b,d){c.xmlFileUrl=a.data.url;c.z=b.getInfo(d).j}),
a.data.attachEvent("onIdChange",function(a,b){c.changeRowId(a,b)})];c.attachEvent("onDynXLS",function(b,d){for(var e=b;e<b+d;e++)if(!a.data.order[e])return a.loadNext(d,b),!1;c.z=b;h.call(a.data)});h.call(a.data);c.attachEvent("onEditCell",function(a,b){a==2&&this.save(b);return!0});c.attachEvent("onClearAll",function(){var a="_f_rowsBuffer";this[a]=null});b&&b.sort&&c.attachEvent("onBeforeSorting",function(b,d,e){if(d=="connector")return!1;var f=this.getColumnId(b);a.sort("#"+f+"#",e=="asc"?"asc":
"desc",d=="int"?d:"string");c.setSortImgState(!0,b,e);return!1});b&&b.filter&&c.attachEvent("onFilterStart",function(b,d){var e="_con_f_used";if(c[e]&&c[e].length)return!1;a.data.silent(function(){a.filter();for(var e=0;e<b.length;e++)if(d[e]!=""){var f=c.getColumnId(b[e]);a.filter("#"+f+"#",d[e],e!=0)}});a.refresh();return!1});b&&b.select&&c.attachEvent("onRowSelect",function(b){a.setCursor(b)});c.clearAndLoad=function(b){a.clearAll();a.load(b)}},dhtmlXGridObject.prototype.b=function(){if(dhx.isUndefined(this.a)){this.a=
{id:dhx.uid(),dataFeed:this.h};dhx.ui.views[this.a.id]=this;this.data={silent:dhx.bind(function(a){a.call(this)},this)};dhtmlxEventable(this.data);for(var a="_cCount",b=0;b<this[a];b++)this.columnIds[b]||(this.columnIds[b]="cell"+b);this.attachEvent("onSelectStateChanged",function(a){this.callEvent("onSelectChange",[a])});this.attachEvent("onSelectionCleared",function(){this.callEvent("onSelectChange",[null])});this.attachEvent("onEditCell",function(a,b){a===2&&this.getCursor&&b&&b==this.getCursor()&&
this.i();return!0});this.attachEvent("onXLE",function(){this.callEvent("onBindRequest",[])})}},dhtmlXGridObject.prototype.item=function(a){if(a===null)return null;var b=this.getRowById(a);if(!b)return null;var c="_attrs",d=dhx.copy(b[c]);d.id=a;for(var e=this.getColumnsNum(),f=0;f<e;f++)d[this.columnIds[f]]=this.cells(a,f).getValue();return d},dhtmlXGridObject.prototype.update=function(a,b){for(var c=0;c<this.columnIds.length;c++){var d=this.columnIds[c];dhx.isUndefined(b[d])||this.cells(a,c).setValue(b[d])}var e=
"_attrs",f=this.getRowById(a)[e];for(d in b)f[d]=b[d];this.callEvent("onBindUpdate",[a])},dhtmlXGridObject.prototype.add=function(a,b,c){for(var d=[],e=0;e<this.columnIds.length;e++){var f=this.columnIds[e];d[e]=dhx.isUndefined(b[f])?"":b[f]}this.addRow(a,d,c);var g="_attrs";this.getRowById(a)[g]=dhx.copy(b)},dhtmlXGridObject.prototype.getSelected=function(){return this.getSelectedRowId()},dhtmlXGridObject.prototype.isVisible=function(){var a="_f_rowsBuffer";return!this.rowsBuffer.length&&!this[a]&&
!this.a.dataFeed?!1:!0},dhtmlXGridObject.prototype.refresh=function(){this.render_dataset()},dhtmlXGridObject.prototype.filter=function(a,b){if(this.a.dataFeed){var c={};if(!a&&!b)return;if(typeof a=="function"){if(!b)return;a(b,c)}else dhx.isUndefined(a)?c=b:c[a]=b;this.clearAll();var d=this.a.dataFeed;if(typeof d=="function")return d.call(this,b,c);var e=[],f;for(f in c)e.push("dhx_filter["+f+"]="+encodeURIComponent(c[f]));this.load(d+(d.indexOf("?")<0?"?":"&")+e.join("&"));return!1}if(b===null)return this.filterBy(0,
function(){return!1});this.filterBy(0,function(c,d){return a.call(this,d,b)})};if(window.dhtmlXTreeObject)dhtmlXTreeObject.prototype.bind=function(){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXTreeObject.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXTreeObject.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXTreeObject.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this,this.data={silent:dhx.bind(function(a){a.call(this)},this)},dhtmlxEventable(this.data),this.attachEvent("onSelect",
function(a){this.callEvent("onSelectChange",[a])}),this.attachEvent("onEdit",function(a,b){a===2&&b&&b==this.getCursor()&&this.i();return!0})},dhtmlXTreeObject.prototype.item=function(a){return a===null?null:{id:a,text:this.getItemText(a)}},dhtmlXTreeObject.prototype.getSelected=function(){return this.getSelectedItemId()},dhtmlXTreeObject.prototype.isVisible=function(){return!0},dhtmlXTreeObject.prototype.refresh=function(){},dhtmlXTreeObject.prototype.filter=function(a,b){if(this.a.dataFeed){var c=
{};if(a||b){if(typeof a=="function"){if(!b)return;a(b,c)}else dhx.isUndefined(a)?c=b:c[a]=b;this.deleteChildItems(0);var d=this.a.dataFeed;if(typeof d=="function")return d.call(this,[data.id||data,data]);var e=[],f;for(f in c)e.push("dhx_filter["+f+"]="+encodeURIComponent(c[f]));this.loadXML(d+(d.indexOf("?")<0?"?":"&")+e.join("&"));return!1}}},dhtmlXTreeObject.prototype.update=function(a,b){dhx.isUndefined(b.text)||this.setItemText(a,b.text)};dhtmlx.skin='dhx_skyblue';