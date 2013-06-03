<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
    <head>
        <title>CIDECO - Registro de Donante</title>

        <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="../../../css/style.css" />


        <style type="text/css">

            .tiny  {
                width: 250px;
                padding: 3px 3px 3px 3px;
                border: 1px solid #ddd ;
                background: #f7f7f7;
                font-size: 11px;
                color: #000000;
            }

            .fieldsetTitle
            {
                font-family: Arial,Comic Sans MS;
                color:DarkRed;
                font-size: 12px;
                font-weight: bolder;
            }	

            textarea {
                border: none; border: 1px solid #ddd;
                background: #f7f7f7;
                color: #5d5d5d;
            }

        </style>


        <!--[if lt IE 8.]>
      <link rel="stylesheet" type="text/css" href="css/style-ie.css" />
      <![endif]-->
        <!--[if lt IE 7.]>
       <link rel="stylesheet" type="text/css" href="css/style-ie6.css" />
       <![endif]-->

    </head>

    <body >

        <!-- Main Body Starts Here -->
        <div id="main_body">

            <!-- Header Starts Here -->
            <div id="header">

                <div class="menu">
                    <ul>
                        <li class="menu_active" ><a href="../../../index.php">HOME</a></li>

                    </ul>
                </div>

            </div>

            <div id="content_body">

                        <!-- <iframe src ="" id="contenido" name="contenido" width="100%" height="450px"  frameborder="0" scrolling="no"> </iframe> -->

                <fieldset>
                    <legend class="fieldsetTitle">Datos Usuario</legend>

                    <br/>

                    <table width="100%" style="font-size:14px" border="0">
                        <tr>
                            <td width="20%"></td>
                            <td width="20%" ></td>
                            <td width="40%"></td>
                            <td width="20%"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Usuario:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Contrasena:</td>
                            <td><input name="usuario" id="usuario" type="password" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Confirmar Contrasena:</td>
                            <td><input name="usuario" id="usuario" type="password" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					
                    </table>

                    <br/>

                </fieldset>


                <fieldset>
                    <legend class="fieldsetTitle">Datos Personales</legend>

                    <br/>

                    <table width="100%" style="font-size:14px" border="0">
                        <tr>
                            <td width="20%"></td>
                            <td width="20%" ></td>
                            <td width="40%"></td>
                            <td width="20%"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nombre:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Primer Apellido:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Segundo Apellido:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Direccion:</td>
                            <td rowspan="4"><textarea height="20" name="direccion" id="direccion" 
                                                      style="width: 250px;padding: 3px 3px 3px 3px;border: 1px solid #ddd ;background: #f7f7f7;;font-size: 11px;color: #000000;overflow: auto;"></textarea>
                            </td>
                        </tr>					
                        <tr><td></td><td>&nbsp;</td></tr>
                        <tr><td></td><td>&nbsp;</td></tr>
                        <tr><td></td><td>&nbsp;</td></tr>
                        <tr>
                            <td></td>
                            <td>Municipio:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					
                        <tr>
                            <td></td>
                            <td>Pais:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>		

                        <tr>
                            <td></td>
                            <td>Telefono Casa:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	

                        <tr>
                            <td></td>
                            <td>Telefono Movil:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					

                        <tr>
                            <td></td>
                            <td>Telefono Trabajo:</td>
                            <td><input name="usuario" id="usuario" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					

                        <tr>
                            <td></td>
                            <td>Nit:</td>
                            <td><input name="nit" id="nit" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Fecha Nacimiento:</td>
                            <td><input name="nit" id="nit" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					
                        <tr>
                            <td></td>
                            <td>Genero:</td>
                            <td><input name="nit" id="nit" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	

                        <tr>
                            <td></td>
                            <td>Correo Electronico:</td>
                            <td><input name="nit" id="nit" type="text" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	

                    </table>

                    <br/>

                </fieldset>			


                <fieldset>
                    <legend class="fieldsetTitle">Datos Donacion</legend>

                    <br/>

                    <table width="100%" style="font-size:14px" border="0">
                        <tr>
                            <td width="20%"></td>
                            <td width="20%" ></td>
                            <td width="40%"></td>
                            <td width="20%"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tipo Donacion:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tipo Pago:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Monto:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>	
                        <tr>
                            <td></td>
                            <td>Renovacion Automatica:</td>
                            <td><input name="usuario" id="usuario" class="tiny" onfocus="jform.col(this);" /></td>
                        </tr>					
                    </table>

                    <br/>

                </fieldset>		


                <table width="100%" style="font-size:14px" border="0">
                    <tr>
                        <td width="30%"></td>
                        <td width="20%"><input type="button" width="100px" value="Enviar" onclick="alert('En Mantenimiento')" /></td>
                        <td width="20%"><input type="button" value="Cancelar" onclick="alert('En Mantenimiento')" /></td>
                        <td width="30%"></td>
                    </tr>			
                </table>

            </div>

            <input type = "hidden" id = "ses" value = "<?php echo $id; ?>">
                <input type = "hidden" id = "usrid" value = "<?php echo $_SESSION['USERID']; ?>">
                    <input type = "hidden" id = "usr" value="<?php echo $_SESSION['USER']; ?>">
                        <input type = "hidden" id = "mnu" value="<?php echo $_SESSION['MNU']; ?>">



                            <!-- Footer Starts Here -->

                            <div id="footer">
                                <p id="footer_links">
                                    <a href="index.html">Home</a>
                                </p>

                                <!-- Template Copyright -->
                                <p id="footer_copyright">
                                    © All Rights Reserved 2013. Fideco El Salvador
                                </p>
                                <!-- Template Copyright -->

                            </div>
                            <!-- Footer Ends Here -->

                            <br />

                            </div>

                            <script type="text/javascript" src = '../../../script/functions.fields.js'></script>
                            <script type="text/javascript" src = '../../../script/functions.ajax.js'></script>
                            <script type="text/javascript" src = '../scripts/registro_usuario.js'></script>

                            <!-- Librarys Here -->


                            </body>
                            </html>