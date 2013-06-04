
// Variables globales

var toolbar;
var mygrid;
var myCalendar;
var loader;

var idReg=0;

// Funcion para cargar el menu
function doOnLoad() {

    // Creando nuevo objeto
    toolbar = new dhtmlXToolbarObject("toolbarObj");
    // Direccion de iconos
    toolbar.setIconsPath("../../../images/icons/");
    // xml a cargar, este es fijo en la direccion q aparece
    toolbar.loadXML("../../../components/toolbar/Control_Beca.xml?etc=" + new Date().getTime());
	
	
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
	
        DoEvent(id);
	
    });
}


// Eventos al dar click en el toolbar
function DoEvent(data) {
	
	
    switch(data)
    {
	
        case "new":
            idReg=0;
            ClearRegistro();
            document.getElementById('frm_show').click();
            //document.getElementById('nombre').focus();
            break;
		
        case "save":
		
            SaveData();
            //Msjbox.show();
            break;
		
		
        case "edit_alumno":
		
            if(mygrid.getSelectedId())
            {
                LoadAlumnos();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }
		
			
			
            break;		
		
		
		
        case "edit_beca":
		
            if(mygrid.getSelectedId())
            {
                LoadBeca();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }
			
            break;		
		
        case "delete":
		
            if(mygrid.getSelectedId())
            {
                document.getElementById('msj_show').click();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }		
			

            break;
		
        case "export":
		
            var url="../actions/beca_escolar_export.php";
			
            var window_width = 10;
            var window_height = 10;
            var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
            var window_top = (screen.height-window_height)/2;
            var window_left = (screen.width-window_width)/2;
            window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
		
            break;
		
        default:
            alert('Opcion aun en desarrollo.... ' + data);
            break;
		
    }
	
}


// funcion para crear el calendario
function doCalendar()
{

    myCalendar = new dhtmlXCalendarObject(["fecha_nac"]);

}

// Funcion para cargar los datos
function LoadData(){

    // primero se muestra el mensaje de "espere"
    MsjWait.show();
	
    // Luego despues de un segundo cargamos el grid
    setTimeout("LoadGrid();", 1000);

}


// Funcion para cargar el grid de datos.

function LoadGrid()
{

    mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("../../../components/grid/imgs/");
    mygrid.init();
    mygrid.setSkin("dhx_skyblue");

    // direccion de la pagina que hace el xml de forma dinamica
    mygrid.loadXML("../actions/beca_escolar_grid.php",
        function()
        {
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
	
	
	
}


function LoadAlumnos()
{

    idReg = mygrid.cells(mygrid.getSelectedId(),0).getValue()
	
    var parameters = ""; 
    parameters = parameters + "?p0=" + idReg;
	
    loader = dhtmlxAjax.post( "../actions/beca_get_alumno.php",encodeURI(parameters), function(){
        ReadXml()
    } );



}

function LoadBeca()
{

    idReg = mygrid.cells(mygrid.getSelectedId(),0).getValue()
	
    var parameters = ""; 
    parameters = parameters + "?p0=" + idReg;
	
    loader = dhtmlxAjax.post( "../actions/beca_get_beca.php",encodeURI(parameters), function(){
        ReadXml()
    } );



}


// funcion q carga los combos. perfil y estatus


var alumno;
var estado;
var genero;
var municipio;
var grado;
var centro_escolar;

function LoadCombos()
{

    // directorio de las imagenes del combo (no tocar)
    window.dhx_globalImgPath = "../../../components/select/imgs/";
	
	
    // creacion del combo alumno
    alumno = new dhtmlXCombo("cbo_alumno","cbo_alumno",250);
    alumno.enableFilteringMode(true);	
    //alumno.attachEvent("onKeyPressed", function(keyCode){if (keyCode == 13 ) LoadGrid(0);});
    alumno.loadXML("../actions/beca_combo_alumno.php?p0=" , function(){});
    alumno.attachEvent("onBlur", ValidacionAlumno);
	
	
    // creacion del combo estado
    estado = new dhtmlXCombo("cbo_estado","cbo_estado",150);
    estado.enableFilteringMode(true);	
    estado.loadXML("../actions/beca_combo_estado.php?p0=" , function(){});
    estado.attachEvent("onBlur", ValidacionEstado);
	
    // creacion del combo genero
    genero = new dhtmlXCombo("cbo_genero","cbo_genero",150);
    genero.enableFilteringMode(false);	
    genero.loadXML("../actions/solicitud_combo_genero.php?p0=" , function(){});
    genero.attachEvent("onBlur", ValidacionGenero);
	
	
    // creacion del combo Municipio
    municipio = new dhtmlXCombo("cbo_municipio","cbo_municipio",150);
    municipio.enableFilteringMode(true);	
    municipio.loadXML("../actions/solicitud_combo_municipio.php?p0=1" , function(){});
    municipio.attachEvent("onBlur", ValidacionMunicipio);
	
	
    // creacion del combo Grado
    grado = new dhtmlXCombo("cbo_grado","cbo_grado",150);
    grado.enableFilteringMode(true);	
    grado.loadXML("../actions/beca_combo_grado.php?p0=" , function(){});
    grado.attachEvent("onBlur", ValidacionGrado);	
	
	
    // creacion del combo Centro Escolar
    centro_escolar = new dhtmlXCombo("cbo_centro_escolar","cbo_centro_escolar",250);
    centro_escolar.enableFilteringMode(true);	
    centro_escolar.loadXML("../actions/beca_combo_centro.php?p0=" , function(){});
    centro_escolar.attachEvent("onBlur", ValidacionCentro);	
	

}



// validacion del combo perfil
function ValidacionAlumno() {

    if (alumno.getSelectedValue()==null)
    {
        alumno.setComboText('');
    }
	
    if (alumno.getSelectedValue() == -1)
    {
	
        ClearAlumno();
        document.getElementById('Alu_show').click();
        document.getElementById('nombre').focus();
		
    }
	
    return true;
}



function ValidacionGenero() {

    if (genero.getSelectedValue()==null)
    {
        genero.setComboText('');
    }
		
    return true;
}


function ValidacionMunicipio() {

    if (municipio.getSelectedValue()==null)
    {
        municipio.setComboText('');
    }
		
    return true;
}


function ValidacionGrado() {

    if (grado.getSelectedValue()==null)
    {
        grado.setComboText('');
    }
		
    return true;
}


function ValidacionEstado() {

    if (estado.getSelectedValue()==null)
    {
        estado.setComboText('');
    }
		
    return true;
}


function ValidacionCentro()
{

    if (centro_escolar.getSelectedValue()==null)
    {
        centro_escolar.setComboText('');
    }
		
    return true;

}


function ClearAlumno()
{

    document.getElementById("nombre").value = '';
    document.getElementById("apellido1").value = '';
    document.getElementById("apellido2").value = '';
    document.getElementById("direccion").value = 
    municipio.setComboText('');
    document.getElementById("telefono_casa").value = '';
    document.getElementById("telefono_movil").value = '';
    document.getElementById("fecha_nac").value = '';
    genero.setComboText('');
    document.getElementById("nie").value = '';
    document.getElementById("destacado").value = '';
    document.getElementById("necesidades").value = '';
    document.getElementById("num_hermanos").value = '';
    document.getElementById("vive_con").value = '';
    document.getElementById("quiere_ser").value = '';
    document.getElementById("juego_favorito").value = '';
    document.getElementById("materia_favorita").value = '';
    document.getElementById("ayuda").value = '';
	

}

function ClearRegistro()
{


    alumno.setComboText('');
    centro_escolar.setComboText('');
    grado.setComboText('');
    document.getElementById("seccion").value = '';
    document.getElementById("monto").value = '';
    document.getElementById("comentario").value = '';
    estado.setComboText('');

}

// funcion para guardar los registros
function SaveAlumno()
{

    try
    {

        // verificamos q los parametros obligatorios esten llenos
        if(CheckParam())
        {
		
            // guardamos los parametros en un arreglo post
			
            var parameters = ""; 
            parameters = parameters + "?p0=" + idReg;
            parameters = parameters + "&p1=" + document.getElementById("nombre").value;
            parameters = parameters + "&p2=" + document.getElementById("apellido1").value;
            parameters = parameters + "&p3=" + document.getElementById("apellido2").value;
            parameters = parameters + "&p4=" + document.getElementById("direccion").value;
            parameters = parameters + "&p5=" + municipio.getSelectedValue();
            parameters = parameters + "&p6=" + document.getElementById("telefono_casa").value;
            parameters = parameters + "&p7=" + document.getElementById("telefono_movil").value;
            parameters = parameters + "&p8=" + document.getElementById("fecha_nac").value;
            parameters = parameters + "&p9=" + genero.getSelectedValue();
            parameters = parameters + "&p10=" + document.getElementById("nie").value;
            parameters = parameters + "&p11=" + document.getElementById("destacado").value;
            parameters = parameters + "&p12=" + document.getElementById("necesidades").value;
            parameters = parameters + "&p13=" + document.getElementById("num_hermanos").value;
            parameters = parameters + "&p14=" + document.getElementById("vive_con").value;
            parameters = parameters + "&p15=" + document.getElementById("quiere_ser").value;
            parameters = parameters + "&p16=" + document.getElementById("juego_favorito").value;
            parameters = parameters + "&p17=" + document.getElementById("materia_favorita").value;
            parameters = parameters + "&p18=" + document.getElementById("ayuda").value;
	
		

            if (idReg==0)
            {
				
                // si es nuevo entra aqui
                loader = dhtmlxAjax.post( "../actions/beca_alumno_save.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
                MsjWait.show();
				
            }
            else
            {
				
                // si es un update entra aqui
                loader = dhtmlxAjax.post( "../actions/beca_alumno_update.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
                MsjWait.show();
				
            }

        }
        else
        {
		
            // mensaje de llenar los campos obligatorios
            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar los campos Obligatorios</td></tr></table>");
            Msjbox.show();
		
        }

    }
    catch(err)
    {

        alert(err.message );
		
    }



}



function SaveBeca()
{

    try
    {

        // verificamos q los parametros obligatorios esten llenos
        if(CheckParam())
        {
		
            // guardamos los parametros en un arreglo post
			
            var parameters = ""; 
            parameters = parameters + "?p0=" + idReg;
            parameters = parameters + "&p1=" + alumno.getSelectedValue();
            parameters = parameters + "&p2=" + centro_escolar.getSelectedValue();
            parameters = parameters + "&p3=" + grado.getSelectedValue();
            parameters = parameters + "&p4=" + document.getElementById("seccion").value;
            parameters = parameters + "&p5=" + document.getElementById("monto").value;
            parameters = parameters + "&p6=" + document.getElementById("comentario").value;
            parameters = parameters + "&p7=" + estado.getSelectedValue();
			
	
            if (idReg==0)
            {
                // si es nuevo entra aqui
                loader = dhtmlxAjax.post( "../actions/beca_escolar_save.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
                MsjWait.show();
            }
            else
            {
                // si es un update entra aqui
                loader = dhtmlxAjax.post( "../actions/beca_escolar_update.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
                MsjWait.show();
            }

        }
        else
        {
		
            // mensaje de llenar los campos obligatorios
            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar los campos Obligatorios</td></tr></table>");
            Msjbox.show();
		
        }

    }
    catch(err)
    {

        alert(err.message );
		
    }



}

// Campos Obligatorios.

function CheckParam()
{
    var Val = true
	
	
	
    /*if (document.getElementById('usuario').value == '')
	{
		Val = false;
	}
	
	if (document.getElementById('contrasena').value == '')
	{
		Val = false;
	}
	
	if (document.getElementById('fechacad').value == '')
	{
		Val = false;
	}
	*/
	
	
    return Val;

}


// Catgando los campos del grid hacia las cajas del formulario
function LoadParam()
{

    // limpiamos las cajas
    ClearParam();
	
    // llenamos las cajas
    idReg = mygrid.cells(mygrid.getSelectedId(),0).getValue();

	
    document.getElementById('frm_show').click();

}


// funcion para limpiar las cajas

function ClearParam(){



//document.getElementById("usuario").value = "";	
//combo_perfil.setComboText('');

	
	
}


// funcion para eliminar un registro
function DeleteData()
{


    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),0).getValue();

    if (idReg==0)
    {
    //loader = dhtmlxAjax.post( "../actions/usuarios_delete.php",encodeURI(parameters), function(){ReadXml()} );
    }
			
}



// lectura del xml de respuesta
function ReadXml(){

    //alert(loader.doSerialization());
    if ( loader.xmlDoc.responseXML != null && loader.xmlDoc.statusText=='OK' && loader.doSerialization()!='' ) 
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(loader.doSerialization());
		
        switch(xmlDoc.documentElement.childNodes[0].text)
        {
		
		
		
			
			
            case "Insert_Alumno":
				
				
                document.getElementById('Alu_hide').click();
                alumno.loadXML("../actions/beca_combo_alumno.php?p0=" , function(){});
                alumno.setComboText('');
                alumno.DOMelem_input.focus();

				
                break;
			
			
            case "Insert_Registro":
				
				
                document.getElementById('frm_hide').click();
                LoadGrid();
				
                MsjWait.hide();
				
				
                break;
			
			
            case "Update_Registro":
				
				
                document.getElementById('frm_hide').click();
                LoadGrid();
				
                MsjWait.hide();
				
				
                break;
			
			

			
			
            case "Update_Alumno":
				
				
                document.getElementById('Alu_hide').click();
                LoadGrid();
				
                MsjWait.hide();
				
				
                break;
			
			
			
			
			
            case "Get_Alumno":
			
                ClearAlumno();
				
                document.getElementById("nombre").value = xmlDoc.documentElement.childNodes[2].text;
                document.getElementById("apellido1").value = xmlDoc.documentElement.childNodes[3].text;
                document.getElementById("apellido2").value = xmlDoc.documentElement.childNodes[4].text;
                document.getElementById("direccion").value = xmlDoc.documentElement.childNodes[5].text;
                municipio.loadXML("../actions/solicitud_combo_municipio.php?p0="+xmlDoc.documentElement.childNodes[6].text , function(){});
                document.getElementById("telefono_casa").value = xmlDoc.documentElement.childNodes[7].text;
                document.getElementById("telefono_movil").value = xmlDoc.documentElement.childNodes[8].text;
                document.getElementById("fecha_nac").value = xmlDoc.documentElement.childNodes[9].text;
                genero.loadXML("../actions/solicitud_combo_genero.php?p0="+xmlDoc.documentElement.childNodes[10].text , function(){});
                document.getElementById("nie").value = xmlDoc.documentElement.childNodes[11].text; 
                document.getElementById("destacado").value = xmlDoc.documentElement.childNodes[12].text;
                document.getElementById("necesidades").value = xmlDoc.documentElement.childNodes[13].text;
                document.getElementById("num_hermanos").value = xmlDoc.documentElement.childNodes[14].text;
                document.getElementById("vive_con").value = xmlDoc.documentElement.childNodes[15].text;
                document.getElementById("quiere_ser").value = xmlDoc.documentElement.childNodes[16].text;
                document.getElementById("juego_favorito").value = xmlDoc.documentElement.childNodes[17].text;
                document.getElementById("materia_favorita").value = xmlDoc.documentElement.childNodes[18].text;
                document.getElementById("ayuda").value = xmlDoc.documentElement.childNodes[19].text;
				
                document.getElementById('Alu_show').click();
			
                break;
			
			
            case "Get_Beca":
			
                alumno.loadXML("../actions/beca_combo_alumno.php?p0="+xmlDoc.documentElement.childNodes[2].text , function(){});
                centro_escolar.loadXML("../actions/beca_combo_centro.php?p0="+xmlDoc.documentElement.childNodes[3].text , function(){});
                grado.loadXML("../actions/beca_combo_grado.php?p0="+xmlDoc.documentElement.childNodes[4].text , function(){});
                document.getElementById("seccion").value = xmlDoc.documentElement.childNodes[5].text;
                document.getElementById("monto").value = xmlDoc.documentElement.childNodes[6].text;
                document.getElementById("comentario").value = xmlDoc.documentElement.childNodes[7].text;
                estado.loadXML("../actions/beca_combo_estado.php?p0="+xmlDoc.documentElement.childNodes[8].text , function(){});

				
                document.getElementById('frm_show').click();
				
			
                break;
				
				
            // si fue un insert
            case "Insert":
				
                MsjWait.show();
                document.getElementById('frm_hide').click();
                LoadGrid();
				
				
                break;
		
		
            // si fue un update
            case "Update":
			
				
                MsjWait.show();
                document.getElementById('frm_hide').click();
                LoadGrid();
				
			
                break;
			
			
            // si fue un delete
            case "Delete":
			
				
                MsjWait.show();
                document.getElementById('msj_hide').click();
                LoadGrid();
				
			
                break;
		
        }
    }
    else
    {
        // en el caso q haya sucedido un error.
        alert('No se Pudo Realizar la Operacion, Contacte a su Administrador!!!');
  
    }
 
}
  
  


//HBI.namespace("classPopup.container");
//HBI.namespace("classes.container");


// Funciones de los Formularios
var RegNew_Submit = function() {
    SaveBeca();
};
var RegNew_Cancel = function() {
    document.getElementById('frm_hide').click();
};	

var RegDel_Submit = function() {
    DeleteData();
};
var RegDel_Cancel = function() {
    document.getElementById('msj_hide').click();
};	


var AluNew_Submit = function() {
    SaveAlumno();
};
var AluNew_Cancel = function() {
    document.getElementById('Alu_hide').click();
};	


function init() {

    try
    {
	
        // Cargar los Controles.
		
        // Mensaje de Espere. *********************************************
		
        MsjWait = new HBI.widget.Panel("wait", {
            width: "240px", 
            fixedcenter: true, 
            close: false, 
            draggable: false, 
            zindex:4, 
            modal: true, 
            visible: false
        } );
        MsjWait.setHeader("Espere...");
        MsjWait.setBody("<img src=\"../../../images/icons/rel_interstitial_loading.gif\"/>");
        MsjWait.render(document.body);
		
		
        // Mensaje Personalizado. ****************************************
        Msjbox = new HBI.widget.Panel("panel1", {
            width:"500px",  
            visible:false, 
            draggable:true, 
            close:true, 
            modal: true, 
            fixedcenter : true
        });
        Msjbox.setHeader("Atenci&oacute;n... <br>");
        Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Prueba de Mensaje</td></tr></table>");
        Msjbox.render(document.body);
		
		
        // Fromulario de Nuevo Registro y Edicion. ************************
		
        FormRegistro = new HBI.widget.Dialog("RegNew", {
            width : "30em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Guardar", 
                handler:RegNew_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:RegNew_Cancel
            } ]
        });
        FormRegistro.render();
        HBI.util.Event.addListener("frm_show", "click", FormRegistro.show, FormRegistro, true);
        HBI.util.Event.addListener("frm_hide", "click", FormRegistro.hide, FormRegistro, true);
		
		
        // Fromulario de Nuevo Alumno. ************************
		
        FormRegistro = new HBI.widget.Dialog("AluNew", {
            width : "68em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Guardar", 
                handler:AluNew_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:AluNew_Cancel
            } ]
        });
        FormRegistro.render();
        HBI.util.Event.addListener("Alu_show", "click", FormRegistro.show, FormRegistro, true);
        HBI.util.Event.addListener("Alu_hide", "click", FormRegistro.hide, FormRegistro, true);		
		
		
        // Mensaje de Eliminar Registro. **********************************
        MsjDelete = new HBI.widget.Dialog("RegDel", {
            width : "35em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Aceptar", 
                handler:RegDel_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:RegDel_Cancel
            } ]
        });
        MsjDelete.render();
        HBI.util.Event.addListener("msj_show", "click", MsjDelete.show, MsjDelete, true);
        HBI.util.Event.addListener("msj_hide", "click", MsjDelete.hide, MsjDelete, true);
		
		
		
    }
    catch(err)
    {

        alert(err.message );
		
    }
	
}
