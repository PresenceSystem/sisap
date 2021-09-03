<!DOCTYPE html>

<html lang="es">
    <head>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/abound.css" />'; ?>
    </head>
    <body>
        <!--mpdf
         <htmlpageheader name="myheader">
        <br><br>
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php echo'<img src="' . Yii::app()->baseUrl . '/images/pagina/bannerStanford.jpg" alt="Stanford">'; ?></td>
        
         </tr></table>
         </htmlpageheader>
         
        <htmlpagefooter name="myfooter">
         <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
         PÃ¡gina {PAGENO} de {nb}
         </div>
         </htmlpagefooter>
         
        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
         <sethtmlpagefooter name="myfooter" value="on" />
        
         mpdf-->
        <table width="100%"><tr>
                <th colspan="2"><h3> Datos personales </h3></th>
        </tr>
        <tr><td><b>Usuario:</b></td><td> <?php echo $model->nombres; ?> </td></tr>
        <tr><td><b>Teléfono:</b></td><td> <?php echo $model->telefono; ?> </td></tr>
        <tr><td><b>Dirección:</b></td><td> <?php echo $model->direccion; ?> </td></tr>
        <tr><td><b>Email:</b></td><td> <?php echo $model->email; ?> </td></tr>
    </table>
        <br><br>
        <table  border="1" align="center" width="100%"><tr>
            <tr><th colspan="4"><h3> Historial de prestamos </h3></th></tr>
        <tr><td><b>N°<b></td><td><b>Libro</b></td><td><b>Fecha</b></td><td><b>Estado</b></b></td></tr>
        </tr>
        <?php 
        $contador=0;
        foreach ($model->prestamos as $key => $value) { ?>
                <tr>
                    <?php $contador = $contador + 1; ?>
                    <td> <?php echo $contador; ?> </td>
      <!--<td>  <a href="http://201.218.45.187/jurech/index.php?r=terreno/update&id=<?php // echo $value->NUM_TERRENO;          ?>" >     <?php //echo $value->NUM_TERRENO;          ?> </a> </td>--> 
<!--                    <td> <?php
//                        echo CHtml::link($value->NUM_TERRENO, array('terreno/update',
//                            'id' => $value->NUM_TERRENO));
                        ?></td>-->
                    <td> <?php echo $value->libros->Titulo; ?> </td>
                    <td> <?php echo $value->Fecha_inicio; ?> </td>
                    <td> <?php echo $value->Estado; ?> </td>
                    <!--<td> <?php //echo $value->CODIGO;        ?> </td>--> 
                    <?php                    
                }
                ?>
            </tr>
      
    </table>

</body>
</html> 