<h1><?=$fabianho?></h1>
<?php foreach($sociomedidores as $data):?>
<h3>
	<?php echo $data->FECHA_ACTUALIZACION ?>
</h3>
<?php endforeach;?>
<?php foreach($socios as $d):?>
<h3>
        <?php echo $d->CI.'<br>' ?>
	<?php echo $d->APELLIDO.'<br>' ?>
    <?php echo $d['Socio'].'<br>' ?>
</h3>
<?php endforeach;?>