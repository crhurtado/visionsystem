<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vision System C.A.</title>
<meta name="description" content="Your description" />
<meta name="keywords" content="Your keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="webfonts/fuentes.css" type="text/css" media="screen" />
<!--[if gte IE 9]
<style type="text/css">
.gradient {
filter: none;
}
</style>
<![endif]-->
<?php include ('source/beforehead.html'); ?>
</head>

<body>
<div id="contenedor">
    <div class="lateral_izquierdo"></div>
    <div class="primary">
        <?php include ('source/header.html'); ?>
        <?php include ('source/menu.html'); ?>
        <div id="slider">
        	<img src="img/contacto.jpg" title="Contacto | Vision System C.A." style="width:100%; max-height: 80px;"/>
        </div>
        <div class="flex filajust">
            <div id="contenido">
                                           
                <div class="separador"> Formulario de Contacto</div>
                
                <?php include ('source/contactform.php') ?>
                
                <div class="separador" id="datos"> Datos de Contacto</div>
                
                <div id="contactform">
                	<ul>
                		<li>
                        	<label>Dirección:</label>
                            <p>Urbanización Ciudad Varyná, Sector las Cumbres, Calle 3 con Transversal 1, Barinas Estado Barinas, Venezuela. 5201</p>
                            <label>Teléfonos:</label>
                            <p>(+58) 414-354.6064   |   (+58) 424-549.4026</p>
                            
                            <label>E-mail:</label>
                            <p>info@visionsystem.com.ve   |   visionsystemca@gmail.com</p>
                            
                            <label>Redes Sociales:</label>
                            <p><a href="http://www.facebook.com/visionsystemca" target="_blank">Facebook</a>   |   <a href="http://www.twitter.com/visionsystemca" target="_blank">Twitter</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php include ('source/sidebar.html') ?>
        </div>
        <footer>
        Derechos reservados Vision System C.A. 2015
        </footer>
    </div>
    <div class="lateral_derecho"></div>
</div>
</body>
</html>