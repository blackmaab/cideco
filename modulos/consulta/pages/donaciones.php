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

    <body class="yui-skin-sam" onLoad="init();LoadData();doCalendar();toolbars();" >

        <br/>
        <fieldset style="width: 99%;">
            <legend class="fieldsetTitle">&nbsp;Consulta - Historial de Donaciones</legend>
            <br />
            <table width="100%">
                <tr>
                    <td width="2%">&nbsp;</td>
                    <td width="96%">
                        <div style="width:99%;padding-bottom: 10px;">
                            <h4>Buscar donaciones realizadas por fechas</h4>                            
                            <span>&nbsp;&nbsp;desde:&nbsp;&nbsp;</span><input type="text" id="txtFechaIni" name="txtFechaIni" class="tiny" onclick="setSens('txtFechaFin', 'max');" readonly="true">
                            <span>&nbsp;&nbsp;hasta:&nbsp;&nbsp;</span><input type="text" id="txtFechaFin" name="txtFechaFin" class="tiny" onclick="setSens('txtFechaIni', 'min');" readonly="true">
                                <input type="button" id="btnBuscar" name="btnBuscar" value="Buscar" onclick="filterGrid();">    
                        </div>
                        <div id="divOpciones"></div>
                        <div id="gridbox" style="width:99%;height:325px;background-color:white;"></div>
                    </td>
                    <td width="1%">&nbsp;</td>

                </tr>
            </table>
            <br />
        </fieldset>

        <div align = 'left' id="content"></div>









        <!--Componente Grid--> 
        <script  language="JavaScript" type="text/javascript" src="../../../components/grid/dhtmlxgrid_std.js"></script>	
        <link rel="stylesheet" type="text/css" href="../../../components/grid/dhtmlxgrid_std.css">

            <!--Componente Toolbar--> 

            <script  language="JavaScript" type="text/javascript" src="../../../components/toolbar/dhtmlxtoolbar_full.js"></script>
            <link rel="STYLESHEET" type="text/css" href="../../../components/toolbar/dhtmlxtoolbar_full.css">


                <!--Componente Calendar--> 

                <script  language="JavaScript" type="text/javascript" src="../../../components/toolbar/dhtmlxcalendar_full.js"></script>
                <link rel="STYLESHEET" type="text/css" href="../../../components/toolbar/dhtmlxcalendar_full.css">

                    <!--Componente Combo--> 

                    <script  language="JavaScript" type="text/javascript" src="../../../components/select/dhtmlxcombo_full.js"></script>
                    <link rel="STYLESHEET" type="text/css" href="../../../components/select/dhtmlxcombo_full.css">


                        <!--Componente Formularios, Ventanas y Avisos--> 

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

                        <script type="text/javascript" src = '../scripts/donaciones.js'></script>

                        </body>

                        </html>