<div id="center">
		<p style="font-size:24px; color: #444;">
			Los datos seran enviados al correo <?php echo "<span style='color: red;'>".$persona[0]->email."</span>"; ?>.
		</p>
		<table border="1" align="center" style="font-size: 28px; color: #999; border-color: #CCC;">
		<tr>
		<td colspan="4">
			<?php echo "Nombre y Apellido: ".$persona[0]->nombre_apellido; ?>
		</td>
		<td>
		<?php
			//echo "Fecha: ".date("d-m-Y",time());
			//echo "<br>Hora: ".date("h:i:s",time());
		?>
		</td>
	</tr>

	<tr>
		<td>id_Producto</td>
		<td>Descrición</td>
		<td>Cantidad</td>
		<td>Precio</td>
		<td>Sub-total:</td>
	</tr>	
	<?php
	foreach($this->cart->contents() as $k=>$v):
 			echo "<tr>";
 				echo "<td>".$v["id"]."</td>";
 				echo "<td>".$v["name"]."</td>";
 				echo "<td>".$v["qty"]."</td>";
 				echo "<td>".$this->cart->format_number($v["price"])."</td>";
 				echo "<td>".$this->cart->format_number($v["subtotal"])."</td>";
 			echo "</tr>";
 		endforeach;
 	?>
	<tr>
	<td colspan="3">total: $<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</table>
	<center>
	<?php echo anchor("carrito/myperfil","Volver");?>
	<?php echo anchor("carrito/myperfil/confirma", "Confirmar");?>
	</center>
</div>