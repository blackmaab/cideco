var isProtectedMode=false;

d=document;w=window;m=Math;
l={};l.isIE=navigator.appName=="Microsoft Internet Explorer";
l.gt=function(id){return (typeof(id)=='string')?d.getElementById(id):id;};
l.op=function(ur,nm,pr){w.open(ur,nm,pr||'menubar=0,statusbar=0,width=640,height=480,scrollbars=yes');};
l.ae=function(ob,en,fn){ return (l.isIE)?ob.attachEvent('on'+en,fn):ob.addEventListener(en, fn, false);};
l.parent=function(ob,i){while(i--) ob=ob.parentNode;return ob;};
l.mm=function(pt,ar,dm){if(!dm)var dm='\\$';for(var i=0;i<ar.length;i++) pt = pt.replace(RegExp(dm+i+dm,'g'), ar[i]);return pt.replace(new RegExp(dm+'[0-9]+?'+dm,'g'),'');	};

g={};
g.st=function(ob,st,vl){(typeof ob=='string'?l.gt(ob):ob).style[st]=vl;};
g.cn=function(ob,cn){(typeof ob=='string'?l.gt(ob):ob).className=cn;};g.sh=function(obs,obh){if(obs)g.cn(obs,'visible');if(obh)g.cn(obh,'hidden');};
g.col=function(ob,cl,out){if(!out){var obs=ob.style.backgroundColor;l.ae(ob,'mouseout',function(){g.st(ob,'backgroundColor',obs);});};g.st(ob,'backgroundColor',cl||'#f9f6ff');};

ajx={};
ajx.x=function() { ajx.x = w.XMLHttpRequest ? function() { return new w.XMLHttpRequest(); } : w.ActiveXObject ? function() { return new ActiveXObject('Microsoft.XMLHTTP'); } : null;	return ajx.x(); };
ajx.g=function(u,f) { var x=ajx.x(); x.open('GET',u,true); x.onreadystatechange=function(){ if(x.readyState==4&&x.status==200)f(x.responseText) }; x.send(null); };

function info(show, hide)
{
	g.sh(show, hide);
};

var panel = { };
panel.ix = 'charts';
panel.show = function(ix)
{
	if(ix == panel.ix) return false;
	g.sh('panel_'+ix, 'panel_'+panel.ix);
	g.cn('tab_'+ix, 'selected');
	g.cn('tab_'+panel.ix, '');

	panel.ix=ix;
	return false;
}

var jform = { };
jform.col = function(obj, cval)
{
	//var oldCol = obj.style.borderColor;
	var oldCol = '#DDDDDD';
	obj.style.borderColor = cval || '#fda';
	obj.onblur=function() {obj.style.borderColor = oldCol;
		// alert(obj)
	};
};

jform.asig = function(obj, cval)
{
	if ( isProtectedMode == false )
	{
		//var oldCol = obj.style.borderColor;
		var oldCol = '#DDDDDD';
		obj.style.borderColor = cval || '#fda';
		obj.onblur=function() {obj.style.borderColor = oldCol;
			
			// if(
			// obj.id=='hor_paro' || obj.id=='hor_ini' || obj.id=='hor_fin' ||
			// obj.id=='min_paro' || obj.id=='min_ini' || obj.id=='min_fin' )
			// {
				// try{
					// return validHora(obj.id , obj.value);
				// }
				// catch(err){
					// // alert(obj.id)
				// }
			// }
		}
	}
};

function checkNoChars(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 33 || charCode == 34 || charCode == 35 || charCode == 37 || charCode == 38 || charCode == 39 || charCode == 42 || charCode == 45 || charCode == 47 || charCode == 60 || charCode == 61 || charCode == 62 || charCode == 63 || charCode == 92 || charCode == 94 || charCode == 95 || charCode == 96) {
        status = "Este campo unicamente acepta letras y numeros.";
        return false
    }
    status = "";
    return true;
}

function checkOnlyNumber(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode

		if (charCode > 31 && (charCode < 48 || charCode > 57)) 
		{
			status = "Este campo unicamente acepta numeros."
			return false
		}
    
    status = "";
    return true;
}

function checkOnlyLetters(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode

		if (charCode > 31 && (charCode < 65 || charCode > 90)) 
		{
			status = "Este campo unicamente acepta letras."
			return false
		}
    
    status = "";
    return true;
}


var isNN = (navigator.appName.indexOf("Netscape")!=-1);

function autoTab(input,len, e) {
  var keyCode = (isNN) ? e.which : e.keyCode; 
  var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
  if(input.value.length >= len && !containsElement(filter,keyCode)) {
    input.value = input.value.slice(0, len);
    input.form[(getIndex(input)+1) % input.form.length].focus();
  }

  function containsElement(arr, ele) {
    var found = false, index = 0;
    while(!found && index < arr.length)
    if(arr[index] == ele)
    found = true;
    else
    index++;
    return found;
  }

  function getIndex(input) {
    var index = -1, i = 0, found = false;
    while (i < input.form.length && index == -1)
    if (input.form[i] == input)index = i;
    else i++;
    return index;
  }
  return true;
}

