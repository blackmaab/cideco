<?php


	include("../../../class/database.class.php");

	
	$execQuery = " Select IFNULL((Sum(Monto)*0.70),0.00) As Donaciones From donacion Where estado = 2 ";
	$Donacion = number_format($database -> database_scalar ($execQuery),2);
	
	$execQuery = " Select IFNULL(Sum(Monto),0.00) As Beca From beca_escolar where activo = 1 ";
	$Beca = number_format($database -> database_scalar ($execQuery),2);
	
	$database -> database_close();


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
<head>


<script type="text/javascript">

	// Funcion para evitar volver atras con los controles de solo lectura.

	document.onkeydown = function (e)
	{ 

		e = e? e : window.event; 
		var t = e.target? e.target : e.srcElement? e.srcElement : null; 
		var k = e.keyCode? e.keyCode : e.which? e.which : null; 
		
		if (k == 8 && t.readOnly)
		{
			return false;
		}
		else
		{
			return true;
		}

	} 

</script>



 <title></title>
 <meta http-equiv="Pragma" content="no-cache"> 
 <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="../../../css/style_form.css" />
 
</head>

<body class="yui-skin-sam" onLoad="init();LoadData();doOnLoad();LoadCombos();doCalendar();" >




<br/>
<fieldset style="width: 99%;">
	<legend class="fieldsetTitle">&nbsp;Administracion de Becas</legend>
	
	<br />
	<table width="100%">
		<tr>
			<td width="2%">&nbsp;</td>
			<td width="96%">
				<div style="font-weight: bolder;" align="right">Becas: $ <?php echo $Beca; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Proyeccion Donaciones: $ <?php echo $Donacion; ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div style="width:99%;"><div id="toolbarObj"></div></div>
				<div id="gridbox" style="width:99%;height:325px;background-color:white;"></div>
			</td>
			<td width="1%">&nbsp;</td>
		
		</tr>
	</table>
	
	<br />
				
</fieldset>

<div align = 'left' id="content"></div>

	<!-- Fromulario de Nuevo, Editar Registro -->

	<div style="visibility:hidden;">
		<button id="frm_show"></button> 
		<button id="frm_hide"></button>
    
		<div id="RegNew" class="yui-pe-content">
		<div class="hd">Datos Registro...</div>
		<div class="bd">
		
		<div class="label">
		
		<table width="100%" CellSpacing = 0 >
		
			<tr>
				<td width="3%"></td>
				<td width="30%"></td>
				<td width="67%"></td>
			</tr>
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Alumno</td>
				<td ><div id='cbo_alumno'></div></td>
			</tr>	
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Centro Escolar</td>
				<td ><div id='cbo_centro_escolar'></div></td>
			</tr>			
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Grado</td>
				<td ><div id='cbo_grado'></div></td>
			</tr>	
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Seccion</td>
				<td ><input name="seccion" id="seccion" class="small" onfocus="jform.col(this);" value="A" ></td>
			</tr>			
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Monto ($ USD)</td>
				<td ><input name="monto" id="monto" class="small" onfocus="jform.col(this);" value="30.00" ></td>
			</tr>	
			<tr>
				<td >&nbsp;</td>
				<td >Comentario:</td>
				<td ><input name="comentario" id="comentario" class="medium" onfocus="jform.col(this);" ></td>
			</tr>
			<tr>
				<td  align="center"><div class="fieldsetTitle">*</div></td>
				<td >Estado</td>
				<td ><div id='cbo_estado'></div></td>
			</tr>				
		
		</table>

		</div>
		</div>
		</div>
		</div>
		
		
		
	<div style="visibility:hidden;">
		<button id="Alu_show"></button> 
		<button id="Alu_hide"></button>
    
		<div id="AluNew" class="yui-pe-content">
		<div class="hd">Datos Registro...</div>
		<div class="bd">
		
		<div class="label">
		
		<table width="100%" CellSpacing = 0 >
		
		<tr>
			<td width="50%">
				<fieldset style="width: 99%;">
				<legend class="fieldsetTitle">&nbsp;Datos Personales</legend>
				
				<table width="100%" CellSpacing = 0 >
					<tr>
						<td width="3%"></td>
						<td width="30%"></td>
						<td width="67%"></td>
					</tr>
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Nombre</td>
						<td ><input name="nombre" id="nombre" class="small" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Primer Apellido:</td>
						<td ><input name="apellido1" id="apellido1" class="small" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td >&nbsp;</td>
						<td >Segundo Apellido:</td>
						<td ><input name="apellido2" id="apellido2" class="small" onfocus="jform.col(this);" ></td>
					</tr>		
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Direccion:</td>
						<td rowspan="2"><textarea height="15" name="direccion" id="direccion" 
						style="width: 250px;padding: 3px 3px 3px 3px;border: 1px solid #ddd ;background: #ffffff;;font-size: 11px;color: #000000;overflow: auto;"></textarea>
						</td>
					</tr>
					<tr><td></td><td>&nbsp;</td></tr>
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Municipio:</td>
						<td ><div id='cbo_municipio'></div></td>
					</tr>
					
					<tr>
						<td >&nbsp;</td>
						<td >Telefono Casa:</td>
						<td ><input name="telefono_casa" id="telefono_casa" class="small" onfocus="jform.col(this);" ></td>
					</tr>	
					
					<tr>
						<td >&nbsp;</td>
						<td >Telefono Movil:</td>
						<td ><input name="telefono_movil" id="telefono_movil" class="small" onfocus="jform.col(this);" ></td>
					</tr>

					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Fecha Nacimiento:</td>
						<td ><input name="fecha_nac" id="fecha_nac" class="small" onfocus="jform.col(this);" ></td>
					</tr>		
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >Genero:</td>
						<td ><div id='cbo_genero'></div></td>
					</tr>	
					<tr ><td></td><td>&nbsp;</td></tr>
					<tr height="25px"><td></td><td>&nbsp;</td></tr>
					
					
				</table>
				
				</fieldset>
			</td >
			
			<td width="50%">
				<fieldset style="width: 99%;">
				<legend class="fieldsetTitle">&nbsp;Datos Alumnos</legend>
					<table width="100%" CellSpacing = 0 >
					<tr>
						<td width="3%"></td>
						<td width="40%"></td>
						<td width="57%"></td>
					</tr>
					<tr>
						<td  align="center"><div class="fieldsetTitle">*</div></td>
						<td >No. NIE</td>
						<td ><input name="nie" id="nie" class="tiny" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"></td>
						<td >Destacado en:</td>
						<td ><input name="destacado" id="destacado" class="medium" onfocus="jform.col(this);" ></td>
					</tr>		
					<tr>
						<td  align="center"></td>
						<td >Necesidades Medicas:</td>
						<td ><input name="necesidades" id="necesidades" class="medium" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"></td>
						<td >Numero Hermanos:</td>
						<td ><input name="num_hermanos" id="num_hermanos" class="medium" onfocus="jform.col(this);" ></td>
					</tr>		
					<tr>
						<td  align="center"></td>
						<td >Vive Con:</td>
						<td ><input name="vive_con" id="vive_con" class="medium" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"></td>
						<td >Grande Quire Ser:</td>
						<td ><input name="quiere_ser" id="quiere_ser" class="medium" onfocus="jform.col(this);" ></td>
					</tr>						
					<tr>
						<td  align="center"></td>
						<td >Juego Favorito:</td>
						<td ><input name="juego_favorito" id="juego_favorito" class="medium" onfocus="jform.col(this);" ></td>
					</tr>
					<tr>
						<td  align="center"></td>
						<td >Materia Favorita:</td>
						<td ><input name="materia_favorita" id="materia_favorita" class="medium" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"></td>
						<td >Ayuda en Casa:</td>
						<td ><input name="ayuda" id="ayuda" class="medium" onfocus="jform.col(this);" ></td>
					</tr>	
					<tr>
						<td  align="center"></td>
						<td ></td>
						<td >&nbsp;</td>
					</tr>		
					<tr ><td></td><td>&nbsp;</td></tr>
					<tr><td></td><td><div class="fieldsetTitle">(*) Campos Obligatorios</div></td></tr>
					</table>
				</fieldset>
			
				</td>
		</tr>
		</table>
			
		</div>
		</div>
		</div>
	</div>
				
		
		
	<div style="visibility:hidden;">
		<button id="msj_show"></button> 
		<button id="msj_hide"></button>
    
		<div id="RegDel" class="yui-pe-content">
		<div class="hd">Advertencia...</div>
		<div class="bd">
		
		<div class="label">
		
			¿Esta seguro(a) que desea borrar el Registro Permanentemente?

		
		</div>
		</div>
		</div>
	</div>
		
		
		
			

<!-- Componente Grid -->
<script  language="JavaScript" type="text/javascript" src="../../../components/grid/dhtmlxgrid_std.js"></script>	
<link rel="stylesheet" type="text/css" href="../../../components/grid/dhtmlxgrid_std.css">

<!-- Componente Toolbar -->

<script  language="JavaScript" type="text/javascript" src="../../../components/toolbar/dhtmlxtoolbar_full.js"></script>
<link rel="STYLESHEET" type="text/css" href="../../../components/toolbar/dhtmlxtoolbar_full.css">


<!-- Componente Calendar -->

<script  language="JavaScript" type="text/javascript" src="../../../components/toolbar/dhtmlxcalendar_full.js"></script>
<link rel="STYLESHEET" type="text/css" href="../../../components/toolbar/dhtmlxcalendar_full.css">

<!-- Componente Combo -->

<script  language="JavaScript" type="text/javascript" src="../../../components/select/dhtmlxcombo_full.js"></script>
<link rel="STYLESHEET" type="text/css" href="../../../components/select/dhtmlxcombo_full.css">


<!-- Componente Formularios, Ventanas y Avisos -->

<link rel="stylesheet" type="text/css" href="../../../components/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../../../components/build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../../../components/build/container/assets/skins/sam/container.css" />
<link rel="stylesheet" type="text/css" href="../../../components/build/carousel/assets/skins/sam/carousel.css" />

<script type="text/javascript" src="../../../components/build/framework-dom-event/framework-dom-event.js"></script>
<script type="text/javascript" src="../../../components/build/element/element-min.js"></script>
<script type="text/javascript" src="../../../components/build/button/button-min.js"></script>
<script type="text/javascript" src="../../../components/build/animation/animation-min.js"></script>
<script type="text/javascript" src="../../../components/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../../../components/build/container/container-min.js"></script>


<script type="text/javascript" src = '../../../script/functions.fields.js'></script>
<script type="text/javascript" src = '../../../script/functions.ajax.js'></script>

<script type="text/javascript" src = '../scripts/beca_escolar.js'></script>



 </body>
 
</html>