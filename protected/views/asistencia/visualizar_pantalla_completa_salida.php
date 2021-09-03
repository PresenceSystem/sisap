<html>
    <head>
        <script language="JavaScript">
            function maximizar() {
                window.moveTo(0, 0);
                window.resizeTo(screen.width, screen.height);
            }
        </script>
        <title>REGISTRO DE ASISTENCIA</title>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">-->
    </head>

    <body onload="maximizar()">

        <div class="text-center badge-inverse">
            <?php
            $socio = Yii::app()->getSession()->get('ultimo_registrado');
            if (isset($socio)) {
                $ultimo_registrado = $socio;
                echo '<h3 class="text-inverse badge-info text-center"><marquee>Registro salida: ' . $ultimo_registrado . '</marquee></h3>';
            };
            ?>
            <center><?php
                //REFRESCA AUTOMATICAMENTE PAGINA EN PHP CADA 5 MINUTOS
//        $self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
//        header("refresh:3; url=$self"); //Refrescamos cada 300 segundos
                echo $this->renderPartial('_salida', array('model_reunion' => $model_reunion));
                ?>    

<?php echo $this->renderPartial('_reloj'); ?>  
            </center>
        </div>
    </body>
</html>
