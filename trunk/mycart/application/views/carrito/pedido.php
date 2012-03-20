<html>
	<head>
		<title>Pedido</title>
	</head>
	<body>
		<table border="1" align="center" style="font-size: 28px; color: #999; border-color: #CCC;">
		<tr>
		<td colspan="6">
			<?php echo "El usuario: ".$this->session->userdata("user"); ?>
		</td>
	</tr>
	<tr>
		<td>Nombre y apellido</td>
		<td>id_Producto</td>
		<td>Cantidad</td>
		<td>Precio</td>
		<td>Descrición</td>
		<td>Sub-total:</td>
	</tr>	
	<?php
	foreach($this->cart->contents() as $k=>$v):
 			echo "<tr>";
 			foreach($v as $k2=>$v2):
 				echo "<td>".$v2."</td>";
 			endforeach;
 			echo "</tr>";
 		endforeach;
 	?>
	<tr>
	<td colspan="3">total: </td>
</table>
	<center>
	<?php echo anchor("carrito/myperfil","Volver");?>
	</center>
	</body>
</html>
