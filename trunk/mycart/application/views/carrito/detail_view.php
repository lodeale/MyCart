<div id="center">
		<div id="itemDetalle">
			<div id="img_pro">
			<img src="<?php echo base_url();?>/web/img/<?php echo $product[0]->image; ?>">
			</div>
			<p>
			<?php echo $product[0]->name; ?> | 
			&nbsp;&nbsp;<span style="color:red;">$<?php echo $product[0]->price; ?></span>
			</p>

		</div>
		<br>
		<br>
		<?php echo anchor("carrito/myperfil","volver"); ?>
	</div>
