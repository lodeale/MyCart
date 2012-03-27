<div id="cuerpo">
<h3 style ="color :red;">
<?php echo validation_errors();?>
<?php
	if(isset($error)):
		echo $error;
	endif;
?>
</h3>
   <?php echo form_open_multipart("carrito/admin/cargar");
    
        $producto=array(
        "name"=>"nombre",
        "id"=>"nombre"
        );
        $precio =array(
        "name"=>"precio",
        "id"=>"precio"
        );
        $imagen =array(
        "name"=>"userfile"
        );
        echo "<center>";
        echo form_fieldset("Cargando producto",array("style"=>"width:500px;"));
        echo form_label ("nombre");
        echo "<br>";
        echo form_input($producto);
        echo "<br>";
        
        echo form_label ("precio");
        echo "<br>";
        
        echo form_input($precio);
        echo "<br>";
        
        echo form_label ("imagen");
        echo "<br>";
        if(isset($upload_data["file_name"])):
        	echo form_input(array("value"=>$upload_data["file_name"],"name"=>"file_img"));
        else:
        	echo form_upload($imagen);
        endif;
             echo "<br>";
        echo form_submit (array("value"=>"Cargar","name"=>"cargar"));
        echo form_submit (array("value"=>"Upload","name"=>"upload"));
        echo form_close();
       	echo form_fieldset_close();
       	echo "</center>";
?>
</div>