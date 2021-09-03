<style>
    #lienzo{
        background-color: #292d30;
    }
    section{
        width: 500;
        position: relative;
        margin: auto;
    }
</style>
<?php
  $datos_cloracion = Cloracion::model()->findBySql(
        'SELECT *
        FROM cloracion 
        WHERE CODIGO > 0 ORDER BY CODIGO DESC LIMIT 1
                ');
// *************************************
// Agua en el tanque de Filtro 1
  if ($datos_cloracion->TANQUE1 != "") {
       $porcentaje_filtro1 = $datos_cloracion->TANQUE1;
  } else {
    $porcentaje_filtro1 =  0; //Cambiar el porcentaje
  }
$pac = 100 - $porcentaje_filtro1;
$agua_filtro1 = 100 - $pac;
$fin_agua_filtro1 = 60 + $pac;
// *************************************
// *************************************
// Agua en el tanque de Filtro 2
 if ($datos_cloracion->TANQUE2 != "") {
       $porcentaje_filtro2 = $datos_cloracion->TANQUE2;
  } else {
    $porcentaje_filtro2 =  0; //Cambiar el porcentaje
  }
$pac = 100 - $porcentaje_filtro2;
$agua_filtro2 = 100 - $pac;
$fin_agua_filtro2 = 60 + $pac;
// *************************************
// *************************************
// Agua en el tanque de cloración
if ($datos_cloracion->TANQUE3 != "") {
       $porcentaje_agua_cloracion = $datos_cloracion->TANQUE3;
  } else {
    $porcentaje_agua_cloracion =  20; //Cambiar el porcentaje
  } 
$pac = 100 - $porcentaje_agua_cloracion;
$agua_cloracion = 100 - $pac;
$fin_agua_cloracion = 180 + $pac;
// *************************************
?>
<script>
    function comenzar() {
        var elemento = document.getElementById("lienzo");
        lienzo = elemento.getContext("2d");
        lienzo.font = "bold italic 12px arial";
        // Tanque de filtro 1
        lienzo.fillStyle = "#fc3039";
        lienzo.fillText("FILTRO N° 1", 80, 50);
        lienzo.fillText(<?= $porcentaje_filtro1 ?> + " %", 100, 175);
        lienzo.strokeStyle = "#d2d3cd";
        lienzo.strokeRect(60, 55, 100, 105); // Grafica rectangulo sólido
        lienzo.fillStyle = "#93acef";
        lienzo.fillRect(60, <?= $fin_agua_filtro1 ?>, 100, <?= $agua_filtro1 ?>); // Grafica rectangulo sólido
        //
        // Tanque de filtro 2
        lienzo.fillStyle = "#fc3039";
        lienzo.fillText("FILTRO N° 2", 183, 50);
        lienzo.fillText(<?= $porcentaje_filtro2 ?> + " %", 200, 175);
        lienzo.strokeStyle = "#d2d3cd";
        lienzo.strokeRect(163, 55, 100, 105); // Grafica rectangulo sólido
        lienzo.fillStyle = "#93acef";
        lienzo.fillRect(163, <?= $fin_agua_filtro2 ?>, 100, <?= $agua_filtro2 ?>); // Grafica rectangulo sólido
        //
        //lienzo.fillRect(110, 110, 100, 100); // Grafica rectangulo sólido
        //lienzo.strokeRect(110, 110, 100, 100); // Grafica rectangulo vacio
        // lienzo.clearRect(130, 130, 50, 50); Borra el rectangulo

        // Tanque de cloración
        lienzo.fillStyle = "#fc3039";
        lienzo.fillText("RESERVA", 370, 170);
        lienzo.fillText(<?= $porcentaje_agua_cloracion ?> + " %", 395, 293);
        lienzo.strokeStyle = "#d2d3cd";
        lienzo.strokeRect(350, 175, 100, 105); // Grafica rectangulo sólido
        lienzo.fillStyle = "#93acef";
        lienzo.fillRect(350, <?= $fin_agua_cloracion ?>, 100, <?= $agua_cloracion ?>); // Grafica rectangulo sólido

        lienzo.strokeStyle = "#93acef";
        /* Establecemos el grosor de línea, en píxeles. Por defecto es 1. */
        lienzo.lineWidth = 3;
        /* Establecemos una línea recta cruzando el canvas de una esquina a la opuesta */
        lienzo.moveTo(160, 160);
        lienzo.lineTo(350, 280);
        lienzo.stroke();
    }
    window.addEventListener("load", comenzar, false);
</script>
<section id="dibujo">
    <canvas id="lienzo" width="500" height="300">
        Su navegador no soporta canvas en html5
    </canvas>   
</section>
<a href="<?= Yii::app()->homeUrl; ?>">
    <button type="button" class="btn btn-warning"> 
        <center><b> ← Volver</b> </center>
    </button>
</a>
<br><br>
<div class="panel-group">
    <div class="panel panel-info span5">
        <div class="panel-heading">FILTRO N° 1 / FILTRO N° 2</div>
        <div class="panel-body text-justify">Filtro convencional lento
descendente diseñado para un caudal de 5,68 l/s; con una tasa de filtración de 0,19 m/h
y una profundidad de 2,6 m. La construcción realizada en hormigón armado, consta de
dos unidades paralelas de filtración cada uno de 10 m de largo y 5,50 m de ancho</div>
    </div>
   
    <div class="panel panel-info span5">
        <div class="panel-heading">RESERVA</div>
        <div class="panel-body text-justify">El volumen del tanque de reserva es de 100 m³.<br>
        La alimentación a la reserva desde los filtros lentos es por medio de una tubería de 90
mm de PVC con sus respectivos accesorios
        </div>
    </div>
</div>