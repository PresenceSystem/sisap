<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//ES">-->
<?php 
$url = '../imprimir_recibo/'.$model_socio->CODIGO;
Yii::app()->clientScript->registerMetaTag("3;url=$url",null,'refresh');
?>
<html>    
   
    <head> 
        <LINK href="./../../../css/impresora.css" rel="stylesheet" type="text/css">        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>


    <body>
        <div id="Factura Original">
            <font FACE="times new roman" SIZE=3 style="line-height: 30px;" >
            <!--ENCABEZADO-->
            <div style="position:absolute; 
                 top:147px; 
                 left:110px;">
                 <?php echo $un_dato['APELLIDO']; ?>                               
            </div>
            <div style="position:absolute; 
                 top:166px; 
                 left:110px;">
                 <?php
                 echo $un_dato['FECHA'];
                 ?>
            </div>
            <div style="position:absolute; 
                 top:185px; 
                 left:110px;">
                 <?php echo $un_dato['CI']; ?>            
            </div>
            <div style="position:absolute; 
                 top:204px; 
                 left:110px;">
                 <?php echo $un_dato['DIRECCION']; ?>            
            </div>
            <div style="position:absolute; 
                 top:185px; 
                 left:628px;">
                 <?php echo $un_dato['TELEFONO'] . ''; ?>            
            </div>
            <!-- FIN DE ENCABEZADO-->
            <!--CUERPO-->
            <div style="position:absolute; 
                 top:255px; 
                 left:26px;
                 width: 100%; line-height: 50px;"> 
                <!--<table border="1">--> 
                <table>
                    <?php
                    $contador = 0;
                    $suma = 0;
                    $model_parametro = Parametro::model()->findByPk(1);
                    $parametro_inicial = $model_parametro->DESCRIPCION;
                    foreach ($datos as $dato) {
                        if ($dato['TIPO'] == 1) { //FACTURA
                            $model_detalle = Detalle::model()->findByPK($dato['DETALLE_ID']);
                            echo '<tr style="color:#456789;font-size:100%; text-align:right">';
                            echo '<td style="width:68px;font-size:100%">';
                            if ((strpos($dato['DESCRIPCION'], $parametro_inicial)) !== FALSE) {
                                if ($dato['CANTIDAD']>1)
                                    echo $dato['CANTIDAD'] . ' m³'; // Consumo
                                else
                                    echo "1";
                            } ELSE {
                            echo $dato['CANTIDAD'] ; //Cantidad
                            }
                            echo "<td>";
                            echo '<td style="width:476px; text-align:left">';
                            echo $dato['DESCRIPCION'];
                            echo ' </td>  ';
                            echo '<td style="width:80px">';
                            echo number_format($dato['V_UNITARIO'], 2, ',', '.');
                            echo ' </td>  ';
                            echo '<td style="width:91px">';
                            echo number_format($dato['V_TOTAL'], 2, ',', '.') . ' </td>  ';
                            $suma = $suma + $dato['V_TOTAL'];
                            echo '</tr>';
                        }; //Final de la condicion TIPO=FACTURA
                    }
                    ?>
                </table>
            </div>


            <!--TOTAL rango de 17px-->
            <div style="position:absolute; top:453px; left:737px; text-align:left;">
                <?PHP echo '' . number_format($suma, 2, ',', '.') . ''; ?> <!-- Sub-Total -->
            </div>
            <div style="position:absolute; top:470px; left:737px; text-align:left;">
                <?PHP echo '' .number_format($suma, 2, ',', '.') . ''; ?> <!-- Iva 0% -->
            </div>
            <div style="position:absolute; top:487px; left:744px; text-align:left;">
                <?PHP echo '0,00'; ?> <!-- Iva 14% -->
            </div>
            <div style="position:absolute; top:504px; left:744px; text-align:left;">
                <?PHP echo '0,00'; ?> <!-- Importe del IVA -->
            </div>
            <div style="position:absolute; top:521px; left:737px; text-align:left;">
                <?PHP echo '' . number_format($suma, 2, ',', '.'). ''; ?> <!-- Valor-Total -->
            </div>



            <!--FIRMA--> 
            <div style="position:absolute; top:511px; left:300px;">
                <?php ?>
            </div>
            <!--MENSAJE PIE DE PAGINA-->
            <div style="position:absolute; top:560px; left:80px;">
                <!--<hr SIZE=3 >-->    
                <?php //echo "Efectivo: " . $model->EFECTIVO; ?>
                <?php //echo " su cambio es: " . $model->CAMBIO . '. '; ?>

            </div>
        </div> 
        <!--FIN DE FACTURA ORIGINAL-->

        



          <!--INICIA COPIA DE FACTURA-->
          <!--570px=15cm en TOP de diferencia con la factura original-->
          <div id="Copia de la Factura">
          <font FACE="times new roman" SIZE=3 style="line-height: 30px;" >
          <!--ENCABEZADO-->
          <div style="position:absolute;
          top:717px;
          left:110px;">
          <?php echo $un_dato['APELLIDO']; ?>
          </div>
          <div style="position:absolute;
          top:736px;
          left:110px;">
          <?php
          echo $un_dato['FECHA'];
          ?>
          </div>
          <div style="position:absolute;
          top:755px;
          left:110px;">
          <?php echo $un_dato['CI']; ?>
          </div>
          <div style="position:absolute;
          top:774px;
          left:110px;">
          <?php echo $un_dato['DIRECCION']; ?>
          </div>
          <div style="position:absolute;
          top:755px;
          left:628px;">
          <?php echo $un_dato['TELEFONO'] . ''; ?>
          </div>
          <!-- FIN DE ENCABEZADO-->
          <!--CUERPO-->
          <div style="position:absolute;
          top:825px;
          left:26px;
          width: 100%; line-height: 50px;">
          <!--<table border="1">-->
          <table>
          <?php
          $contador = 0;
          $suma = 0;
          $model_parametro = Parametro::model()->findByPk(1);
          $parametro_inicial=$model_parametro->DESCRIPCION;
          foreach ($datos as $dato) {
          if ($dato['TIPO'] == 1) { //FACTURA          
          echo '<tr style="color:#456789;font-size:100%; text-align:right">';
          echo '<td style="width:68px;font-size:100%">';
          if ((strpos($dato['DESCRIPCION'], $parametro_inicial)) !== FALSE) {
          echo $dato['CANTIDAD'] . ' m³'; // Consumo
          } ELSE {
          echo $dato['CANTIDAD'] ; //Cantidad
          }
          echo "<td>";
          echo '<td style="width:476px; text-align:left">';
          echo $dato['DESCRIPCION'];
          echo ' </td>  ';
          echo '<td style="width:80px">';
          echo number_format($dato['V_UNITARIO'], 2, ',', '.');
          echo ' </td>  ';
          echo '<td style="width:91px">';
          echo number_format($dato['V_TOTAL'], 2, ',', '.') . ' </td>  ';
          $suma = $suma + $dato['V_TOTAL'];
          echo '</tr>';
          }; //Final de la condicion TIPO=FACTURA
          }
          ?>
          </table>
          </div>

          <!--TOTAL rango de 17px-->
          <div style="position:absolute; top:1023px; left:737px; text-align:left;">
          <?PHP echo '' . number_format($suma, 2, ',', '.') . ''; ?> <!-- Sub-Total -->
          </div>
          <div style="position:absolute; top:1040px; left:737px; text-align:left;">
          <?PHP echo '' . number_format($suma, 2, ',', '.') . ''; ?> <!-- Iva 0% -->
          </div>
          <div style="position:absolute; top:1057px; left:744px; text-align:left;">
          <?PHP echo '0,00'; ?> <!-- Iva 14% -->
          </div>
          <div style="position:absolute; top:1074px; left:744px; text-align:left;">
          <?PHP echo '0,00'; ?> <!-- Importe del IVA -->
          </div>
          <div style="position:absolute; top:1091px; left:737px; text-align:left;">
          <?PHP echo '' . number_format($suma, 2, ',', '.') . ''; ?> <!-- Valor-Total -->
          </div>



          <!--FIRMA-->
          <div style="position:absolute; top:1081px; left:300px;">
          <?php ?>
          </div>
          <!--MENSAJE PIE DE PAGINA-->
          <div style="position:absolute; top:1110px; left:80px;">
          <!--<hr SIZE=3 >-->
          <?php //echo "Efectivo: " . rtrim(number_format($model->EFECTIVO,5,',','.'), ',0');  ?>
          <?php //echo " su cambio es: " . rtrim(number_format($model->CAMBIO,5,',','.'), ',0') . '. ';  ?>

          </div>
          </div>
          <!--FIN DE LA COPIA DE FACTURA-->
          </font>
    </body>
</html>
