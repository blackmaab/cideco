﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
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

    <body class="yui-skin-sam" onLoad="init();LoadData();doOnLoad();" >




        <br/>
        <fieldset style="width: 99%;">
            <legend class="fieldsetTitle">&nbsp;Mantenimiento - Tipo Pago</legend>

            <br />
            <table width="100%">
                <tr>
                    <td width="2%">&nbsp;</td>
                    <td width="96%">
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


                        <table width="100%" >
                            <tr>
                                <td width="3%"></td>
                                <td width="25%"></td>
                                <td width="72%"></td>
                            </tr>
                            <tr>
                                <td  align="center"><div class="fieldsetTitle">*</div></td>
                                <td >Tipo Pago:</td>
                                <td ><input name="tipo_pago" id="tipo_pago" class="medium" onfocus="jform.col(this);" /></td>
                            </tr>
                            <tr>
                                <td  align="center"><div class="fieldsetTitle">*</div></td>
                                <td >Meses:</td>
                                <td ><input name="txtMeses" id="txtMeses" class="medium" onfocus="jform.col(this);" /></td>
                            </tr>
                            <tr>
                                <td  align="center"><div class="fieldsetTitle">*</div></td>
                                <td>Activo:</td>
                                <td>
                                    Si <input type="radio" name="rd_activo"  id="rd_si" value="1" checked="checked" />
                                    No <input type="radio" name="rd_activo" id="rd_no" value="0" />                                    
                                </td>
                            </tr>

                            <tr ><td></td><td>&nbsp;</td></tr>
                            <tr><td></td><td colspan="2"><div class="fieldsetTitle">(*) Campos Obligatorios</div></td></tr>			

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

                        <script type="text/javascript" src = '../scripts/tipo_pago.js'></script>



                        </body>

                        </html>