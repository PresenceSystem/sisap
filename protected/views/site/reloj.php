<center>
<?php
$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
header("refresh:5; url=$self"); //Refrescamos cada 300 segundos
date_default_timezone_set("America/Lima");
$hoy = date("Y-n-j");
$hora = date("H:i:s");
echo '<h2 class="alert-info">'.$hora.'</h2>'; 
echo '<h5 class="alert-info">'.$hoy.'</h5>';
?>
</center>