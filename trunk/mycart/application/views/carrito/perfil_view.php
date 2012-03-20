<html>
<head>
<meta charset="UTF-8">
<title><?= $titulo ?></title>
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
			<li><a href="<?= base_url('carrito/inicio/registrar')?>">Registrar</a></li>
			<li><a href="">Nosotros</a></li>
		</ul>
	</div>
</div>

<div id="cuerpo">
	<div id="login">
		<img src="<?= base_url()."/web/img/login.png"; ?>" width="30">
			<?php
				echo "<b>".$this->session->userdata("user")."</b>";
			?>
		<div id="loginMenu">
			<ul>
				<li><a href="">Mi carrito</a></li>
				<li><a href="">Perfil</a></li>
				<li><a href="myperfil/salir">Salir</a></li>
			</ul>
		</div>
	</div>

	<div id="center">
		<?php
			foreach($products as $item):
		?>
		<div id="item">
			<div id="img_pro"><img src="<?php echo base_url();?>/web/img/<?= $item->image; ?>"></div>
			<div id="desc"><p><?= $item->name; ?></p></div>
			<div id="precio"><p>$<?= $item->price; ?></p></div>
			<div id="agregar"><a href="myperfil/addProduct/<?= $item->id; ?>"><img src="<?= base_url();?>web/img/ok.jpg" width="50"></a></div>
		</div>
		<hr>
		<?php endforeach; ?>
	</div>
	
	<div id="carrito">
		<?php echo form_open('carrito/myperfil/updateProduct'); ?>
		<table cellpadding="6" cellspacing="1" style="width:100%" border="0">
		<tr>
		<th>Cantidad</th>
		<th>Descripción</th>
		<th style="text-align:right">Precio</th>
		<th style="text-align:right">Sub-Total</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($this->cart->contents() as $items): ?>
		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
		<tr>
		<td><?php echo form_input(array('name' => $i.'[qty]',
									'value' => $items['qty'],
									'maxlength' => '3',
									'size' => '3')); ?>
		</td>
		<td>
		<?php echo $items['name']; ?>
		<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
		<p>
		<?php foreach ($this->cart->product_options($items['rowid']) as
		$option_name => $option_value): ?>
		<strong><?php echo $option_name; ?>:</strong>
		<?php echo $option_value; ?><br />
		<?php endforeach; ?>
		</p>
		<?php endif; ?>
		</td>
		<td style="text-align:right">
		<?php echo $this->cart->format_number($items['price']); ?>
		</td>
		<td style="text-align:right">
		$<?php echo $this->cart->format_number($items['subtotal']); ?>
		</td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
		<tr>
		<td colspan="2"><hr></td>
		<td class="right"><strong>Total</strong></td>
		<td class="right">
		$<?php echo $this->cart->format_number($this->cart->total()); ?>
		</td>
		</tr>
		</table>
		<p><?php echo form_submit('', 'Actualizar'); ?> | <?php echo anchor("carrito/myperfil/clearProduct","Limpiar");?> | <?php echo anchor("carrito/myperfil/marketProduct","Comprar");?></p>		
		<?php echo form_close(); ?>
	</div>
</div>

<div id="footer">
</div>
</body>
</html>