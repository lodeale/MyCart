<html>
<head>
<meta charset="UTF-8">
<title>Mi cart</title>
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
			<li><a href="<?= base_url('carrito/inicio/')?>">Inicio</a></li>
			<li><a href="<?= base_url('carrito/perfil/registrar')?>">Registrar</a></li>
			<li><a href="">Nosotros</a></li>
		</ul>
	</div>
</div>

<div id="cuerpo">
	<div id="left">
		<p>Login</p>
		<?php
			/*
			 * Creo los atributo para abrir formulario
			 */
			$atributos = array("id"=>"formLogin","name"=>"formLogin");
			echo form_open("carrito/perfil", $atributos);
			
			/*
			 * Creo los atributos para los inputs
			 */
			 $usuario = array(
			 	"name"=>"usuario",
			 	"id"=>"usuario",
			 	"type"=>"text"
			 );
			 $password = array(
			 	"name"=>"clave",
			 	"id"=>"clave",
			 	"type"=>"password"
			 );
			 $submit = array(
			 	"type"=>"submit",
			 	"value"=>"Enviar"
			 );
			 
			 echo form_label("Usuario");
			 echo "<br>".form_input($usuario);
			 echo "<br>".form_label("Clave");
			 echo "<br>".form_input($password);
			 echo "<br>".form_submit($submit);
			 echo form_close();
		?>
		<hr>
	</div>


	<div id="center">
		<?php
			foreach($products as $item):
		?>
		<div id="item">
			<div id="img_pro"><img src="<?php echo base_url();?>/web/img/<?= $item->image; ?>"></div>
			<div id="desc"><p><?= $item->name; ?></p></div>
			<div id="precio"><p>$<?= $item->price; ?></p></div>
		</div>
		<hr>
		<?php endforeach; ?>
	</div>
</div>

<div id="footer">
</div>
</body>
</html>