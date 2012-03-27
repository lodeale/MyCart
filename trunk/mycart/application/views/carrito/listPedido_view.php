<div id="cuerpo">
	<table border="1" align="center">
		<tr>
			<td>Persona</td>
			<td>Estado</td>
			<td>Fecha</td>
			<td>Cantidad</td>
			<td>Precio</td>
			<td>id_pedido</td>
			<td></td>
		</tr>
	<?php foreach($lista as $row): ?>
			<tr>
				<td><?php echo $row->nombre_apellido; ?></td>
				<td>
				<?php
					switch($row->estado):
						case 1:
							echo "Inicio pedido";
							break;
						case 2:
							echo "Confirmación de pago";
							break;
						default:
							echo "Pedido entregado";
							break;
					endswitch;
				?>
				</td>
				<td><?php echo $row->fecha; ?></td>
				<td><?php echo $row->cant; ?></td>
				<td><?php echo $row->precio; ?></td>
				<td><?php echo $row->id_pedido; ?></td>
				<td><?php echo anchor("carrito/admin/estado/".$row->estado."/".$row->id_pedido,"Cambiar Estado"); ?></td>
				<td><?php echo anchor("carrito/admin/borrarPedido/".$row->id_pedido,"Eliminar"); ?></td>
			</tr>
	<?php endforeach; ?>
	</table>

	
</div>