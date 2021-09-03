

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <style type="text/css">
.xl65
 {mso-style-parent:style0;
 mso-number-format:"\@";
 text-align:right}


</style>
</head>
<body> 
<?php 
 $meses = array("N/A","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO",
                                                "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
?>
    <table border="2px">
		<tr><td colspan='8'><center><h2>CONSUMO DE AGUA POTABLE <?php echo $meses[date('m') * 1] . ' DEL ' . date('Y');  ?></h2></center></td></tr>
        <tr> 
            <td BGCOLOR="#81DAF5"  align="center">
              <b> N°</b>
            </td>
            <td BGCOLOR="#81DAF5"  align="center">
                <b> ID </b>
            </td>
            <td BGCOLOR="#81DAF5"  align="center">
                <b> RECORRIDO </b>
            </td>
            <td BGCOLOR="#81DAF5"  align="center">
                <b> APELLIDOS Y NOMBRES </b>
            </td>
            <td BGCOLOR="#81DAF5"  align="center">
                <b> CI </b>
            </td>            
            <td BGCOLOR="#81DAF5"  align="center">
                <b> MEDIDOR N° </b>
            </td>
            
            <td BGCOLOR="#81DAF5"  align="center">
                <b> L. ANTERIOR </b>
            </td>
            <td BGCOLOR="#81DAF5"  align="center">
                <b> L. ACTUAL </b>
            </td>
			<td BGCOLOR="#81DAF5"  align="center">
                <b> CONSUMO </b>
            </td>
        </tr>
        <?php 
        $contador = 1;
        foreach ($socio_medidor as $soc_med)
        {
            echo "<tr>";
                echo "<td>".$contador++."</td>";
                echo "<td>".$soc_med->ID."</td>";
                echo "<td class=xl65>".$soc_med->FECHA_ACTUALIZACION."</td>"; //Orden de Recorrido
                echo "<td>".$soc_med->cODIGOSOCIO->APELLIDO."</td>";
                echo "<td class=xl65>".$soc_med->cODIGOSOCIO->CI."</td>";    				
                echo "<td class=xl65>".$soc_med->iDMEDIDOR->NUMERO."</td>";                
                $consumo_anterior = $soc_med->COD_USUARIO; //
                if ($consumo_anterior == 0)
                    $consumo_anterior=$soc_med->iDMEDIDOR->CONSUMO_INICIAL;
                echo "<td>".$consumo_anterior."</td>";
                echo "<td>";
                echo "</td>";
				 echo "<td>=H".($contador+2)."-G".($contador+2)."</td>";
            echo "</tr>";
        }; // Termina de exportar todos los medidores
        ?>
    </table>
</body>
</html>

