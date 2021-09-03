<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('meses_mora_excel_padron')),
);


$imagen_off = CHtml::image(Yii::app()->baseUrl . "/images/iconos/off.png",'',  array("width"=>"50px" ,"height"=>"50px"));

$imagen_on = CHtml::image(Yii::app()->baseUrl . "/images/iconos/on.png",'',  array("width"=>"50px" ,"height"=>"50px"));
?>
<p>
<div class="span1"><?php echo $imagen_on; ?></div>
- El usuario esta activo en la comunidad.
</p>
<p>
<div class="span1"><?php echo $imagen_off; ?></div>
- El usuario no esta activo dentro de la comunidad.
</p>
<table class="table-bordered table-responsive " width="100%">
    <tr>
        <td colspan="2">
            <h3 class="btn-primary text-center ">
                MESES EN MORA
            </h3>
        </td>
    </tr>
    <tr>        
        <td colspan="2">
            <!--LISTA DE SOCIOS QUE ASISTIERON-->

            <table class="table-hover table table-condensed">
                <thead class="badge-info">
                <th>N°</th>
                <th>GRUPO</th>
                <th>MEDIDOR</th>
                <th>SOCIO</th>
                <th>CI</th>
                <th>MESES EN MORA</th>
                <th>DEUDA</th>                
                <th></th>
                <th>FECHA_NACIMIENTO</th>
                <th>EDAD</th>
                </thead>
                <?php
                $contador = 1;
                $valor_total = 0;
                $suma_votantes=0;
                $suma_no_votantes=0;
                $bandera_socio_anterior=0;
                foreach ($model_socios as $modelo_socio) {
                    $bandera_vota = 1;
                    /*   $query = 'UPDATE `socio_medidor`
                      SET
                      `INACTIVO` = 1
                      WHERE `ID` =  '.$modelo_socio->FECHA_ACTUALIZACION;
                      $command = Yii::app()->db->createCommand($query);
                      $rowCount=$command->execute(); */
                    if ($modelo_socio->COD_USUARIO > 3) {
                        echo "<tr bgcolor='#FBD35E'>";
                        $bandera_vota = 0;
                    } else {
                        echo "<tr>";                        
                    }
                    if ($bandera_socio_anterior === $modelo_socio->CODIGO){
                    echo '<td bgcolor="aqua" style="text-align:right;">' . $contador++ . '</td>';
                    } else {
                        echo '<td style="text-align:right;">' . $contador++ . '</td>';
                    }
                    echo '<td>' . $modelo_socio->COD_GRUPO . '</td>';
                    echo '<td>' . $modelo_socio->OBS . '</td>';
                    echo '<td>' . $modelo_socio->APELLIDO . '</td>';
                    echo '<td>' . $modelo_socio->CI . '</td>';
                    echo '<td>' . $modelo_socio->COD_USUARIO . '</td>';   // Meses en mora 
                    echo '<td>' . $modelo_socio->FOTO . '</td>';   // Deuda
                    echo "<td width='50px'>";
                    if ($modelo_socio->FECHA_INGRESO == 1) { //INACTIVO
                        $imagen = $imagen_on;
                    } else {
                        $imagen = $imagen_off;
                    };
                    //echo $modelo_socio->FECHA_INGRESO;
                    echo $imagen;
                   // echo CHtml::link($imagen, array('socioMedidor/cambiar_estado/' . $modelo_socio->FECHA_ACTUALIZACION));
                    echo "</td>";
                    echo '<td>' . $modelo_socio->FECHA_NACIMIENTO . '</td>';  
                    $edad = $modelo_socio->FECHA_SALIDA; //Edad del socio
                    if ($edad < 18){
                    echo '<td bgcolor="#FBD35E">' . $edad . '</td>';   
                    $bandera_vota = 0;
                    } else {
                        echo '<td>' . $edad . '</td>';   
                    }
                    $valor_total = $valor_total + $modelo_socio->FOTO;
                    echo "</tr>";
                    if ($bandera_vota == 1 and $bandera_socio_anterior != $modelo_socio->CODIGO){
                        $suma_votantes++;
                    } else {
                        if ($bandera_socio_anterior != $modelo_socio->CODIGO)
                        { $suma_no_votantes++; }
                    }
                    $bandera_socio_anterior = $modelo_socio->CODIGO;
                };
                ?>  
                <tr>
                    <td colspan="5" class="text-right">
                        <b>TOTAL</b>
                    </td>
                    <td><?= $valor_total ?></td>
                </tr>
            </table>
            <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
        </td>
    </tr>
</table>
<div class="panel-info">
    El padrón electoral cuenta con <?= $suma_votantes ?> socios votantes y <?= $suma_no_votantes ?> no votantes.
    <br> Dando un total de <?= $suma_votantes + $suma_no_votantes ?> socios
</div>