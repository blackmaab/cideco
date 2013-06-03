<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_name("CIDECO");
session_start();

$id = session_id();


if (!isset($_SESSION['CIDECO'])) {
    header("location: ../../login/pages/default.php");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
    <head>
        <title>FUNDACION CIDECO - Sistema de Gestion de Donaciones</title>
        <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="../../../css/style.css" />


        <style type="text/css">

            .small  {
                width: 150px;
                padding: 3px 3px 3px 3px;
                border: 1px solid #ddd ;
                background-color:#ffffff;
                font-size: 11px;
                color: #000000;
            }

        </style>


        <!--[if lt IE 8.]>
      <link rel="stylesheet" type="text/css" href="css/style-ie.css" />
      <![endif]-->
        <!--[if lt IE 7.]>
       <link rel="stylesheet" type="text/css" href="css/style-ie6.css" />
       <![endif]-->


    </head>

    <body class="yui-skin-sam" onLoad="LoadMenu();Init();">

        <!-- Main Body Starts Here -->
        <div id="main_body">

            <!-- Header Starts Here -->
            <div id="header">

                <div class="menu">
                    <ul>
                        <li class="menu_active" ><a href="index.html">HOME</a></li>
                        <li><a href="about.html">CONTACTENOS</a></li>
                        <li><a href="../../login/pages/logout.php">SALIR</a></li>

                    </ul>
                </div>

            </div>

            <div id="content_body">
                <table width="100%" border="0">
                    <tr>
                        <td width="70%" style="font-size:11px"><b>CIDECO - SISTEMA DE GESTION DE DONACIONES </b><td>
                                <td width="30%">
                                    <input type="text" size="40" name="Dte" id="Dte" style="text-align:right;border:none; border-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px" value=""/>
                                    <input type="text" size="10" name="Clock" id="Clock" style="text-align:right;border:none; border-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px" value=""/>
                                    <td>
                                        </tr>
                                        </table>

                                        <div id="menuObj"></div>

                                        <iframe src ="" id="contenido" name="contenido" width="100%" height="460px"  frameborder="0" scrolling="no"> </iframe>

                                        </div>

                                        <input type = "hidden" id = "ses" value = "<?php echo $id; ?>">
                                            <input type = "hidden" id = "usrid" value = "<?php echo $_SESSION['USERID']; ?>">
                                                <input type = "hidden" id = "usr" value="<?php echo $_SESSION['USER']; ?>">
                                                    <input type = "hidden" id = "mnu" value="<?php echo $_SESSION['MNU']; ?>">



                                                        <!-- Footer Starts Here -->

                                                        <div id="footer">
                                                            <p id="footer_links">
                                                                <a href="index.html">Home</a> &nbsp;&nbsp; | &nbsp;&nbsp;<a href="about.html">Contactenos</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="contact.html">Salir</a>
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



                                                        <div style="visibility:hidden;">
                                                            <button id="pass_show"></button> 
                                                            <button id="pass_hide"></button>

                                                            <div id="RegPass" class="yui-pe-content">
                                                                <div class="hd">Cambio de Contraseña...</div>
                                                                <div class="bd">

                                                                    <div class="label">

                                                                        <table width="100%" style="text-align: left;">
                                                                            <tr>
                                                                                <td width="2%"></td>
                                                                                <td width="20%"></td>
                                                                                <td width="78%"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    &nbsp;
                                                                                </td>
                                                                                <td>
                                                                                    Contraseña:
                                                                                </td>
                                                                                <td>
                                                                                    <input name="contrasena" id="contrasena" type="password" class="small" onfocus="jform.col(this);" onKeyPress="return checkNoChars(event);" >
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    &nbsp;
                                                                                </td>
                                                                                <td>
                                                                                    Confirmar:
                                                                                </td>
                                                                                <td>
                                                                                    <input name="confirmar" id="confirmar" type="password" class="small" onfocus="jform.col(this);" onKeyPress="return checkNoChars(event);" >
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <script type="text/javascript" src = '../scripts/index.js'></script>

                                                        <!-- Librarys Here -->


                                                        <!-- Componente Para hacer el Menu -->
                                                        <link rel="stylesheet" type="text/css" href="../../../components/menu/skins/menu_dhx_skyblue.css">
                                                            <script src="../../../components/menu/common.js"></script>
                                                            <script src="../../../components/menu/menu.js"></script>
                                                            <script src="../../../components/menu/menu_ext.js"></script>
                                                            <script src="../../../components/menu/menu_effects.js"></script>



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


                                                            <!-- Focus a Objetos -->
                                                            <script type="text/javascript" src = '../../../script/functions.fields.js'></script>

                                                            <!-- Ajax -->
                                                            <script type="text/javascript" src = '../../../script/functions.ajax.js'></script>



                                                            <script type="text/javascript">
                                                                showTime();
                                                                getToday();
                                                            </script>


                                                            </body>
                                                            </html>