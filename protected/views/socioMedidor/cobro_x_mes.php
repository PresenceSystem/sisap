<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
        /*  array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
          array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
         */
);


$imagen_off = CHtml::image(Yii::app()->baseUrl . "/images/iconos/off.png");

$imagen_on = CHtml::image(Yii::app()->baseUrl . "/images/iconos/on.png");
?>




<?php
date_default_timezone_set('America/Guayaquil'); //puedes cambiar Guayaquil por tu Ciudad
setlocale(LC_TIME, 'spanish');
$fecha = new DateTime(date('Y-m-d'));
$meses = array("N/A", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
<p class='h4 text-center text-info'>AÑO <?php echo $anio ?> MES DE COBRO:</p>
<form method="post" action="">
    <div align="center"> 
        <p> 
            <select name="select" size="1" select 
                    style="FONT-SIZE: 12px; COLOR: #565656; BACKGROUND-COLOR: RGB(0, 255, 255)" 
                    onChange="window.open(this.options[this.selectedIndex].value, '_blank')">

                <option value="">
                    Seleccionar...
                </option>
<?php
for ($i = 1; $i <= 18; $i++) {
    $fecha->modify('-1 month');
    $aux_mes_anterior = ($fecha->format('m'));
    $aux_anio = $fecha->format('Y');
    $ver_usuario = $meses[$aux_mes_anterior * 1] . ' del ' . $aux_anio;
    ?>		
                    <option value="<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobro_x_mes/" . ($aux_mes_anterior * 1) . '123123123123123' . $aux_anio ?>">
                    <?php echo $ver_usuario; ?>
                    </option>
                <?php } //Fin de cada mes historico de cobro ?>
            </select>
        </p>
    </div>
</form>




<table class="table-bordered table-responsive table-striped" width="100%">
    <tr>
        <td colspan="2">
            <h3 class="btn-primary text-center ">
                Cobros realizados en factura en el mes de <?php echo $meses[$mes] . ' del ' . $anio; ?>
<?php
$cadena_fecha_mysql = $anio . '-' . $mes . '-01';
$fecha_consumo = DateTime::createFromFormat('Y-m-d', $cadena_fecha_mysql);
$fecha_consumo->modify('-1 month');
$aux_mes_consumo = round($fecha_consumo->format('m'));
//  echo $aux_mes_consumo;
?>
                <marquee> Consumo: <?php echo $meses[$aux_mes_consumo] . ' del ' . $anio . '</marquee>'; ?>
            </h3>
        </td>
    </tr>
    <tr>        
        <td colspan="2">
            <!--LISTA DE SOCIOS QUE ASISTIERON-->

            <table class="table-hover table table-condensed">
                <thead class="badge-info">
                <th style="text-align:center;">N°</th>
                <th style="text-align:center;">MEDIDOR</th>
                <th style="text-align:center;">SOCIO</th>
                <th style="text-align:center;">CI</th>      
                <th style="text-align:center;">FACTURA N°</th> 
                <th style="text-align:center;">VALOR RECAUDADO</th>                       
                <th style="text-align:center;">EMISIÓN N°</th>    
                </thead>
<?php
$contador = 1;
$valor_total = 0;
foreach ($model_socios as $modelo_socio) {

    echo "<tr>";
    echo '<td style="text-align:right;">' . $contador++ . '</td>';
    echo '<td>' . $modelo_socio->OBS . '</td>';
    echo '<td>' . $modelo_socio->APELLIDO . '</td>';
    echo '<td>' . $modelo_socio->CI . '</td>';
    echo '<td style="text-align:right;">' . $modelo_socio->FOTO . '</td>';   // N° Factura física
    echo '<td style="text-align:right;">' . $modelo_socio->COD_USUARIO . '</td>';   // Valor recaudado
    echo '<td style="text-align:right;">' . CHtml::link($modelo_socio->TIPO, array('factura/ver', 'id' => $modelo_socio->TIPO)) . '</td>';   // Emision N°
    echo "</tr>";
    $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
};
?>  
                <tr class="text-info">
                    <td colspan="5" style="text-align:right;">
                        <b>  TOTAL </b>
                    </td>
                    <td style="text-align:right;">
                        <b> <?php echo $valor_total; ?> </b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h4 class="btn-success text-center ">

    Cobro para la comunidad SAN VICENTE DE LACAS
</h4>
<table class="table-hover table table-condensed">
    <thead class="badge-info">
    <th style="text-align:center;">N°</th>
    <th style="text-align:center;">MEDIDOR</th>
    <th style="text-align:center;">SOCIO</th>
    <th style="text-align:center;">CI</th>
    <th style="text-align:center;">VALOR RECAUDADO</th>                       
</thead>
<?php
$contador = 1;
$valor_total = 0;
foreach ($model_socios_comunidad as $modelo_socio) {
    echo "<tr>";
    echo '<td style="text-align:right;">' . $contador++ . '</td>';
    echo '<td>' . $modelo_socio->OBS . '</td>';
    echo '<td>' . $modelo_socio->APELLIDO . '</td>';
    echo '<td>' . $modelo_socio->CI . '</td>';
    echo '<td style="text-align:right;">' . $modelo_socio->COD_USUARIO . '</td>';   // Valor recaudado
    echo "</tr>";
    $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
};
?>  
<tr class="text-info">
    <td colspan="4" style="text-align:right;">
        <b>  TOTAL </b>
    </td>
    <td style="text-align:right;">
        <b> <?php echo $valor_total; ?> </b>
    </td>
</tr>
</table>
