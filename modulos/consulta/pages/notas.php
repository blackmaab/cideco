<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
    <head>
        <script type="text/javascript" src="../../../script/jquery.js"></script>

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

    <body class="yui-skin-sam" onLoad="init();LoadData();doOnLoad();doCalendar();" >

        <br/>
        <fieldset style="width: 99%;">
            <legend class="fieldsetTitle">&nbsp;Consulta - Notas de apadrinados</legend>
            <br />
            <table width="100%">
                <tr>
                    <td width="2%">&nbsp;</td>
                    <td width="96%">
                        <?php
                        session_name("CIDECO");
                        session_start();
                        if ($_SESSION['IDPERF'] == 3):
                            ?>
                            <div style="width:99%;padding-bottom: 10px;">                            
                                <h4>Buscar calificaciones</h4>

                                <select id="selAnio">
                                    <?php
                                    $year = ((int) date('Y')) - 5;
                                    for ($anio = ((int) date('Y')); $anio > $year; $anio--):
                                        ?>
                                        <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                                        <?php
                                    endfor;
                                    ?>
                                </select>                            
                                <input type="button" id="btnBuscars" name="btnBuscars" value="Buscar" onclick="filterGrid();"/>  
                                <input type="hidden" id="txtTipoUsuario" value="3"/>
                            </div>
                            <?php
                        elseif ($_SESSION['IDPERF'] == 1):
                            include_once '../../../class/Conexion.class.php';
                            include_once '../../../class/InstitucionEducativa.class.php';

                            $obj_ins_edu = new InstitucionEducativa();
                            $array = $obj_ins_edu->select_InstitucionEducativa(true);
                            ?>
                            <div style="width:99%;padding-bottom: 10px;">
                                <h4>Buscar calificaciones</h4>
                                <div>
                                    <table>
                                        <tr>
                                            <td>Realizar busqueda por:</td>
                                            <td>
                                                <select id="selFiltro">
                                                    <option value="1" selected="selected">Alumno</option>
                                                    <option value="5">Donante</option>
                                                    <option value="2">Institucion</option>
                                                    <option value="3">A&ntilde;o</option>
                                                    <option value="4">Rango de Fechas</option>
                                                </select>
                                                <input type="hidden" id="txtTipoUsuario" value="1"/>
                                            </td>                                                            
                                            <td>
                                                <input type="button" name="btnBuscar" id="btnBuscar" value="Buscar"/>
                                            </td>
                                        </tr>
                                        <tr id="rowNombre">
                                            <td>Escribir el nombre:</td>
                                            <td>
                                                <input type="text" id="txtNombre" name="txtNombre" class="tiny"/>
                                            </td>
                                        </tr>
                                        <tr id="rowInstitucion" style="display: none">
                                            <td>Institucion:</td>
                                            <td>
                                                <select id="selInstitucion">
                                                    <?php
                                                    foreach ($array as $key => $value):
                                                        ?>
                                                        <option value="<?php echo $value['id_institucion'] ?>"><?php echo $value['nombre_institucion']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>                                                    
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="rowAnio" style="display: none;">
                                            <td>A&ntilde;o</td>
                                            <td>
                                                <select id="selAnio">
                                                    <?php
                                                    $year = ((int) date('Y')) - 5;
                                                    for ($anio = ((int) date('Y')); $anio > $year; $anio--):
                                                        ?>
                                                        <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                                                        <?php
                                                    endfor;
                                                    ?>
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr id="rowFecha" style="display: none;">
                                            <td>Fecha inicial:</td>
                                            <td>
                                                <input type="text" id="txtFechaIni" name="txtFechaIni" class="tiny" onclick="setSens('txtFechaFin', 'max');" readonly="true"/>
                                            </td>
                                            <td>hasta:<input type="text" id="txtFechaFin" name="txtFechaFin" class="tiny" onclick="setSens('txtFechaIni', 'min');" readonly="true"/></td>                                                            
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>


                        <div style="width:99%;"><div id="toolbarObj"></div></div>
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

                        <script type="text/javascript" src = '../scripts/notas.js'></script>

                        </body>

                        </html>