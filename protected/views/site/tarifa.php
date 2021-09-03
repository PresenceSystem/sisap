<h2 class="btn-primary text-center">TARIFA VIGENTE <?php echo gmdate('Y') ?></h2>
<fieldset>    
    <!--<h3 class="btn-info text-center"> PARÁMETROS DE AGUA POTABLE</h3>-->
    <h3 class="alert alert-info text-center text-info h3">Valor Básico </h3>
    <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>VALOR</td>
        </tr>
        <?php
        foreach ($model as $tar) {
            if ($tar->ESTADO == 9) {
                echo "<tr>";
                echo "<td>" . $tar->DESCRIPCION . "</td>";
                echo "<td>" . $tar->VALOR . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>  
    <h3 class="alert alert-info text-center text-info">Valores para el cálculo de sobreconsumo</h3>
    <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>DESDE (m³)</td>
            <td>HASTA (m³)</td>
            <td>VALOR / 1 m³</td>
        </tr>
        <?php
        foreach ($model as $tar) {
            if ($tar->ESTADO == 1) {
                echo "<tr>";
                echo "<td>" . $tar->DESCRIPCION . "</td>";
                echo "<td>" . $tar->VALOR_MIN . "</td>";
                echo "<td>" . $tar->VALOR_MAX . "</td>";
                echo "<td>" . $tar->VALOR . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    
    <h3 class="btn-warning text-center"> PARÁMETROS DEL ALCANTARILLADO</h3>
    <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>VALOR</td>
        </tr>
        <?php
        foreach ($model as $tar) {
            if ($tar->ESTADO == 11) {
                echo "<tr>";
                echo "<td>" . $tar->DESCRIPCION . "</td>";
                echo "<td>" . $tar->VALOR . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table> 
    <h3 class="btn-success text-center"> OTROS PARÁMETROS</h3>
      <h3 class="badge badge-success text-center text-info">Valor de aporte para el mejoramiento de la comunidad (RECIBO)</h3>
      <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>VALOR</td>
        </tr>
        <?php
        foreach ($model as $tar) {
            if ($tar->ESTADO == 5) {
                echo "<tr>";
                echo "<td>" . $tar->DESCRIPCION . "</td>";
                echo "<td>" . $tar->VALOR . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
      
<!--       <h3 class="badge badge-warning text-center text-info">Valor por ingreso de socios nuevos</h3> 
       <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>VALOR</td>
        </tr>
        <?php
//        foreach ($model as $tar) {
//            if ($tar->ESTADO == 7) {
//                echo "<tr>";
//                echo "<td>" . $tar->DESCRIPCION . "</td>";
//                echo "<td>" . $tar->VALOR . "</td>";
//                echo "</tr>";
//            }
//        }
        ?>
    </table>-->
       
       <h3 class="badge badge-success text-center text-info">Porcentaje de mora generado por incumplimiento de pago</h3>
      <table class="table table-responsive table-condensed table-bordered table-striped">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>VALOR</td>
        </tr>
        <?php
        foreach ($model as $tar) {
            if ($tar->ESTADO == 8) {
                echo "<tr>";
                echo "<td>" . $tar->DESCRIPCION . "</td>";
                echo "<td>" . $tar->VALOR . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    
</fieldset>