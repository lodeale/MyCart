<html>
<head>
<meta charset="UTF-8">
<title><?= $titulo; ?></title>
<link rel="stylesheet" type="text/css" href="<?= base_url();?>web/css/estilo.css">
</head>
<body>
<div id="header">
	<h1>Mi Cart</h1>
	<div id="logo"><img src="<?php echo base_url();?>/web/img/carrito.png" width="150px;"></div>
	<p>Lo que buscas está acá!!...</p>
	<hr>
	<div id="nav">
		<ul>
			<li><a href="">Inicio</a></li>
			<li><a href="">Nosotros</a></li>
		</ul>
	</div>
</div>
<div id="cuerpo">
<div id="center">
	<div id="registrar">
		<h1>Registrarse</h1>
		<h3 style="color:red;"><?php echo validation_errors(); ?></h3>
		<?php echo form_open("carrito/perfil/addUser");?>
		<?php			
			/*
			 * Creo los atributos para los inputs
			 */
			 $usuario = array(
			 	"name"=>"usuario",
			 	"id"=>"usuario",
			 	"type"=>"text",
			 	"value"=>set_value("usuario")
			 );
			 $password = array(
			 	"name"=>"clave",
			 	"id"=>"clave",
			 	"type"=>"password"
			 );
			 $rePassword = array(
			 	"name"=>"reclave",
			 	"id"=>"reclave",
			 	"type"=>"password"
			 );
			 $email = array(
			 	"name"=>"email",
			 	"id"=>"email",
			 	"type"=>"text",
			 	"value"=>set_value("email")
			 );
			 $nombre_apellido = array(
			 	"name"=>"n_p",
			 	"id"=>"n_p",
			 	"type"=>"text",
				"value"=>set_value("n_p")
			 );
			 $dni = array(
			 	"name"=>"dni",
			 	"id"=>"dni",
			 	"type"=>"text",
			 	"value"=>set_value("dni")
			 );
			 $tel = array(
			 	"name"=>"tel",
			 	"id"=>"tel",
			 	"type"=>"text",
			 	"value"=>set_value("tel")
			 );
			 $direccion = array(
			 	"name"=>"direccion",
			 	"id"=>"direccion",
			 	"type"=>"text",
			 	"value"=>set_value("direccion")
			 );
			 $opcProv = array();
			 foreach($provincia as $row):
			 	$opcProv[$row->id_provincia]= $row->provincia;
			 endforeach;
			 	
			 $submit = array(
			 	"type"=>"submit",
			 	"value"=>"Enviar"
			 );
		
			 echo form_label("Usuario");
			 echo "<br>".form_input($usuario);
			 echo "<br>".form_label("Clave");
			 echo "<br>".form_input($password);
			 echo "<br>".form_label("Repetir clave");
			 echo "<br>".form_input($rePassword);
			 echo "<br>".form_label("Email");
			 echo "<br>".form_input($email);
			 echo "<hr>";
			 echo "<br>".form_label("Nombre y Apellido");
			 echo "<br>".form_input($nombre_apellido);
			 echo "<br>".form_label("DNI");
			 echo "<br>".form_input($dni);
			 echo "<br>".form_label("Dirección");
			 echo "<br>".form_input($direccion);
			 echo "<br>".form_label("Telefono");
			 echo "<br>".form_input($tel);
			 /*
			  * provincia
			  */
			 echo "<br>".form_dropdown("provincia",$opcProv); 
			 
			 echo "<br>".form_submit($submit);
			 echo form_close();
		?>

	</div>
</div>

	<div id="footer">
	</div>
</div>
</body>
</html>