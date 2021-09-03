<div class="fondoAnimado"></div>
<div class="fondoAnimado1"></div>
<div class="fondoAnimado2"></div>
<?php
//setlocale(LC_TIME,"spanish");  
//setlocale(LC_ALL,"es_EC");
setlocale(LC_TIME, 'spanish');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <!--<![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/protected/extensions/bootstrap/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/protected/extensions/bootstrap/assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/protected/extensions/bootstrap/assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/js" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jt/jquery.min.js" /> 

        <style>
            .zoomIt{
                display:block!important;
                -webkit-transition:-webkit-transform 0.5s ease-out;
                -moz-transition:-moz-transform 0.5s ease-out;
                -o-transition:-o-transform 0.5s ease-out;
                -ms-transition:-ms-transform 0.5s ease-out;
                transition:transform 0.5s ease-out;
            }
            .zoomIt:hover{
                -moz-transform: scale(2.2);
                -webkit-transform: scale(2.2);
                -o-transform: scale(2.2);
                -ms-transform: scale(2.2);
                transform: scale(2.2)
            }
        </style>
        <?php
        //Yii::app()->clientScript->registerCoreScript('/js/bootstrap.min.js');
        //Yii::app()->clientScript->registerCoreScript('jquery.js');
        //Yii::app()->getClientScript()->registerCoreScript('/js/bootstrap.min.js');
        ?>
        <?php
        echo Yii::app()->bootstrap->registerAllCss();
        echo Yii::app()->bootstrap->registerCoreScripts();
        ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="/comunidadSVL/images/pagina/icono.ico"> </link> 


        <script>
            var html5_audiotypes = {//define list of audio file extensions and their associated audio types. Add to it if your specified audio file isn't on this list:
                "mp3": "audio/mpeg",
                "mp4": "audio/mp4",
                "ogg": "audio/ogg",
                "wav": "audio/wav"
            }

            function createsoundbite(sound) {
                var html5audio = document.createElement('audio')
                if (html5audio.canPlayType) { //check support for HTML5 audio
                    for (var i = 0; i < arguments.length; i++) {
                        var sourceel = document.createElement('source')
                        sourceel.setAttribute('src', arguments[i])
                        if (arguments[i].match(/\.(\w+)$/i))
                            sourceel.setAttribute('type', html5_audiotypes[RegExp.$1])
                        html5audio.appendChild(sourceel)
                    }
                    html5audio.load()
                    html5audio.playclip = function () {
                        html5audio.pause()
                        html5audio.currentTime = 0
                        html5audio.play()
                    }
                    return html5audio
                } else {
                    return {playclip: function () {
                            throw new Error("Tu navegador no soporta audio en HTML5")
                        }}
                }
            }

            //Initialize two sound clips with 1 fallback file each:

            var mouseoversound = createsoundbite("./../../audio/whistle.ogg", "./../../audio/whistle.mp3")
            var clicksound = createsoundbite("./../../audio/click.ogg", "./../../audio/click.mp3")

        </script> 
        <?php
        ?>
    </head>

    <body>

<?php if (Yii::app()->user->id > 0) { ?>


            <!--// ADMINISTRADOR-->
    <?php
    if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()) {
        $usuario_log = Yii::app()->getSession()->get('id_usuario');
        $caja_vigente = Caja::model()->findBySql('CALL `buscar_caja_vigente`(' . $usuario_log . ')');
        // echo $caja_vigente->ID;          
        ?>
                <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl; ?>" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">
        <?php echo CHtml::encode(Yii::app()->name) . ''; ?>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">





                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-user navbar-default"></i> SOCIOS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/create" ?> >
                                                <i class="icon-user"></i>
                                                Ingresar socio
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/admin" ?> >
                                                <i class="icon-user"></i>
                                                Buscar socio
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/bus_ing_medidor" ?> >
                                                <i class="glyphicon-dashboard"></i>
                                                Ingresar medidor
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cambiar" ?> >
                                                <i class="icon-circle-arrow-up"></i>
                                                Cambio de medidor
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/traspaso" ?> >
                                                <i class="icon-flag"></i>
                                                Traspaso de medidor
                                            </a></li>
                                        <li class="text-center text-warning">__________________________
                                        </li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/bus_ing_acometida_alcantarillado" ?> >
                                                <i class="icon-search"></i>
                                                Ingresar acometida de alcantarillado
                                            </a></li>

                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-wrench navbar-default"></i> RUBROS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/importarExcel" ?> >
                                                <i class="icon-upload"></i>
        <?php
        date_default_timezone_set('America/Guayaquil'); //puedes cambiar Guayaquil por tu Ciudad
        setlocale(LC_TIME, 'spanish');
        $fecha = new DateTime(date('Y-m-d'));
        //$fecha->setISODate(2016, 1, 1);
        $fecha->modify('-1 month');
        $meses = array("N/A", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        ?>
                                                Importar datos desde excel del consumo 
                                                <?php
                                                $aux_mes_anterior = ($fecha->format('m'));
                                                $fecha_dos = new DateTime(date('Y-m-d'));
                                                $fecha_dos->modify('-1 month');
                                                $aux_dos_mes_anterior = ($fecha_dos->format('m'));

                                                echo $meses[$aux_mes_anterior * 1] . ' del ' . $fecha->format('Y');
                                                // echo $fecha->format('m') . ' del ' . $fecha->format('Y'); 
                                                ?>
                                            </a></li>

                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/create" ?> >
                                                <i class="icon-edit"></i>
                                                Ingresar nuevo rubro
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/buscarFacturas" ?> >
                                                <i class="icon-calendar"></i>
                                                Rubros de Factura
                                            </a></li> 
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/buscarRecibos" ?> >
                                                <i class="icon-calendar"></i>
                                                Rubros de Recibo
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/parametro/tarifa" ?> >
                                                <i class="icon-calendar"></i>
                                                Tarifas
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/exportarMedidas" ?> >
                                                <i class="icon-download"></i>
        <?php
        //echo strftime("%A, %d de %B del %Y  <br><b>HORA:</b> %Hh%M");
        ?>
                                                Exportar medidas de <?php echo strftime("%B"); ?> del <?php echo gmdate('Y'); ?>
                                            </a></li>
                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-briefcase navbar-default"></i> COBROS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
        <?php
        if (isset($caja_vigente)) {
            //    var_dump($caja_vigente);
            // Yii::app()->end();
            ?>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/factura" ?> >
                                                    <i class="glyphicon-usd"></i>
                                                    Facturación
                                                </a></li>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/movimientoCaja/create/" . $caja_vigente->ID ?> >
                                                    <i class="glyphicon-usd"></i>
                                                    Movimiento de caja
                                                </a></li>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/cuota/buscar" ?> >
                                                    <i class="glyphicon-usd"></i>
                                                    Cobro parcial
                                                </a></li>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/factura/admin/" ?> >
                                                    <i class="icon-trash"></i>
                                                    Anular factura
                                                </a></li>  
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/caja/cerrar/" . $caja_vigente->ID ?> >
                                                    <i class="icon-calendar"></i>
                                                    Cierre de caja
                                                </a></li>                                
        <?php
        } //Esta abierto caja para este usuario
        else { //Ahun no abre caja
            ?>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                                   href=<?php echo Yii:: app()->baseUrl . "/index.php/caja/abrir" ?> >
                                                    <i class="icon-calendar"></i>
                                                    Apertura de caja
                                                </a></li>
        <?php }; ?>
                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-list navbar-default"></i> REPORTES<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                         <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_acometidas_x_grupo" ?> >
                                                <i class="icon-list"></i>
                                                Lista de acometidas por grupo
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/lista_alcantarillado" ?> >
                                                <i class="icon-list"></i>
                                                Lista de usuarios activos de alcantarillado
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/lista_alcantarillado_inactivo" ?> >
                                                <i class="icon-list"></i>
                                                Lista de usuarios inactivos del alcantarillado
                                            </a></li>
                                       <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/grupo/buscar_alcantarillado" ?> >
                                                <i class="icon-list"></i>
                                                Lista de usuarios por grupo
                                            </a></li>
                                        <li> <div class="text-warning text-center"> ____________________ </div></li>


                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/lista" ?> >
                                                <i class="icon-list"></i>
                                                Lista de socios de la JAAPA
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/lista_por_grupo" ?> >
                                                <i class="icon-list"></i>
                                                Lista de socios por grupo
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_socios" ?> >
                                                <i class="icon-list"></i>
                                                Lista de medidores
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_socios_x_grupo" ?> >
                                                <i class="icon-list"></i>
                                                Lista de medidores por grupo
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lis_soc_sinmedidor" ?> >
                                                <i class="icon-list"></i>
                                                Lista de socios sin medidor
                                            </a></li>
                                      

                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/corte" ?> >
                                                <i class="icon-off"></i>
                                                Corte de servicio de agua potable
                                            </a></li>
                                        
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobro_x_mes/" . ($aux_mes_anterior * 1) . '123123123123123' . $fecha->format('Y') ?> >
                                                <i class="icon-off"></i>
                                                Cobro histórico <?php echo $meses[$aux_dos_mes_anterior * 1] . ' del ' . $fecha->format('Y'); ?>
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobro_realizado_mes" ?> >
                                                <i class="icon-off"></i>
                                                Cobro por consumo <?php echo $meses[$aux_mes_anterior * 1] . ' del ' . date('Y'); ?>
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobro_realizado_hoy" ?> >
                                                <i class="icon-off"></i>
                                                Cobro realizado <?php echo date('d') . " de " . $meses[date('m') * 1] . ' del ' . date('Y'); ?>
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/meses_mora" ?> >
                                                <i class="icon-briefcase"></i>
                                                Cobros pendientes (meses de mora)
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/meses_mora_padron" ?> >
                                                <i class="icon-briefcase"></i>
                                                Cobros pendientes (meses de mora) Padron Electoral
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobros_pendientes" ?> >
                                                <i class="icon-bell"></i>
                                                Cobros pendientes hasta <?php echo $meses[date('m') * 1] . ' del ' . date('Y'); ?>
                                            </a></li> 
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/cobros_pendientes_solo_alcantarillado" ?> >
                                                <i class="icon-off"></i>
                                                Cobros pendientes alcantarillado hasta <?php echo $meses[date('m') * 1] . ' del ' . date('Y'); ?>
                                            </a></li> 
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/resumen_x_rubro_deuda" ?> >
                                                <i class="icon-off"></i>
                                                Resumen de deudas por rubro
                                            </a></li> 
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/resumen_x_rubro_cobro" ?> >
                                                <i class="icon-off"></i>
                                                Resumen de cobros por rubro  <?= date('d').' de '.$meses[date('m') * 1] . ' del ' . date('Y'); ?>
                                            </a></li> 
                                          <li> <div class="text-warning text-center"> ____________________ </div></li>
                                          <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/subcuentaContable/lista_deudores" ?> >
                                                <i class="icon-briefcase"></i>
                                                Deudas por catálogo de cuentas
                                            </a></li>
                                          <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/subcuentaContable/lista_cobros_hoy" ?> >
                                                <i class="icon-briefcase"></i>
                                                Cobros por catálogo de cuentas
                                            </a></li>
                                          <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/subcuentaContable/cobros_historicos" ?> >
                                                <i class="icon-briefcase"></i>
                                                Cobros por catálogo de cuentas históricos
                                            </a></li>

                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-list navbar-default"></i> HISTORIAL<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/historial_total_consumos" ?> >
                                                <i class="icon-list"></i>
                                                Historial de consumo de agua potable
                                            </a></li>
                                            <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/medidor/buscar_historial" ?> >
                                                <i class="icon-calendar"></i>
                                                Historial de propietarios de un medidor
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_historial_socios" ?> >
                                                <i class="icon-list"></i>
                                                Historial de consumo de los socios
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/buscar_historial_socio" ?> >
                                                <i class="icon-list"></i>
                                                Consumos del socio
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/buscar_historial_facturas" ?> >
                                                <i class="icon-home"></i>
                                                Historial de facturas
                                            </a></li>
                                        

                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-glass navbar-default"></i> REUNIÓN <span class="caret"></span></a>
                                    <ul class="dropdown-menu">                                

                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/create" ?> >
                                                Nueva reunión  
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/asistencia" ?> >
                                                Registrar ingreso
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/salida" ?> >
                                                Registrar salida
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/asistencia_y_codigo_de_barra" ?> >
                                                Registrar asistencia y actualizar código de barra
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/admin" ?> >
                                                Buscar reunión 
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/reunion/consultar_asistencia" ?> >
                                                Reporte de asistencia a Reunión
                                            </a></li>

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-home navbar-default"></i> CONVOCATORIA <span class="caret"></span></a>

                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/tconvocatoria/create" ?> >
                                                <i class="icon-user"></i>
                                                Crear
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/tconvocatoria/admin" ?> >
                                                <i class="icon-search"></i>
                                                Buscar
                                            </a></li>

                                    </ul> 
                                </li>
                                
                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-calendar navbar-default"></i> CONTABILIDAD <span class="caret"></span></a>

                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/claseContable/create" ?> >
                                                <i class="icon-calendar"></i>
                                                Clase
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/grupoContable/create" ?> >
                                                <i class="icon-calendar"></i>
                                                Grupo
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/cuentaContable/create" ?> >
                                                <i class="icon-calendar"></i>
                                                Cuenta
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/subcuentaContable/create" ?> >
                                                <i class="icon-calendar"></i>
                                                Subcuenta
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/claseContable/listar" ?> >
                                                <i class="icon-list-alt"></i>
                                                Plan de cuentas
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/claseContable/listar_rubros" ?> >
                                                <i class="icon-list-alt"></i>
                                                Rubros por plan de cuentas
                                            </a></li>

                                    </ul> 
                                </li>
                                
                                
                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-user navbar-default"></i> USUARIOS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/create" ?> >
                                                <i class="icon-user"></i>
                                                Nuevo usuario
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/admin" ?> >
                                                <i class="icon-search"></i>
                                                Buscar
                                            </a></li>
                                        
                                        <li>
                                            ------------------
                                        </li>
                                        
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/cloracion/create" ?> >
                                                <i class="icon-search"></i>
                                                Cloración
                                            </a></li>

                                    </ul> 
                                </li>
        <?php
        /*  $this->widget('bootstrap.widgets.TbButtonGroup', array(
          'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
          'icon'=>'book',
          'size' => '50px',
          'buttons' => array(
          array('label' => 'CONVOC./TICKET', 'items' => array(
          array('label' => 'CREAR CONVOCATORIA', 'icon' => 'th-large', 'url' => array('/tconvocatoria/create')),
          array('label' => 'BUSCAR CONVOCATORIA', 'icon' => 'search', 'url' => array('/tconvocatoria/admin')),
          array('label' => 'CREAR TICKET (Todos)', 'icon' => 'th-list', 'url' => array('/tconvocatoria/crearTicket')),
          array('label' => 'BUSCAR TICKET (Todos)', 'icon' => 'search', 'url' => array('/tconvocatoria/buscarTicket')),
          array('label' => 'CREAR CONVOCATORIA PARA VALIDACIÓN (Faltantes)', 'icon' => 'th-list', 'url' => array('/tconvocatoria/crearConvocatoriaValidacion')),
          array('label' => 'BUSCAR CONVOCATORIA PARA VALIDACIÓN (Faltantes)', 'icon' => 'search', 'url' => array('/tconvocatoria/buscarConvocatoriaValidacion')),

          )),
          ),
          'htmlOptions'=>array(
          'onmouseover'=>"mouseoversound.playclip()",
          'onclick'=>"clicksound.playclip()" )
          )); */
        ?>


                            </ul>

                            <ul class="nav navbar-nav navbar-right">


                                <li class="dropdown ">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle zoomIt" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-user navbar-default"></i> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/cambiar_clave/" . Yii::app()->getSession()->get('id_usuario'); ?> >
                                                Cambiar clave  
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/update/" . Yii::app()->getSession()->get('id_usuario'); ?> >
                                                Modificar Perfil  
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/site/logout" ?> >
                                                <i class="icon-off navbar-default"></i>        Salir (<?php echo Yii::app()->user->name ?>)    
                                            </a>
                                        </li>
                                    </ul> 
                                </li>

                                <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href="<?php echo Yii:: app()->baseUrl . '/index.php/site/logout' ?>" 
                                        class = 'zoomIt' title = "Salir (<?php echo Yii::app()->user->name ?>) ">
                                        <i class="icon-off navbar-default"></i>     
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
        <?php
    } //Fin de condicion administrador
    ?>
            <!--FIN ADMINISTRADOR-->

            <!--// OPERADOR-->
    <?php
    if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()) {
        ?>
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl; ?>" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">
        <?php echo CHtml::encode(Yii::app()->name); ?>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">


                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon- navbar-default"></i> ADMINISTRAR RUBROS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/importarExcel" ?> >
                                                <i class="icon-upload"></i>
        <?php
        date_default_timezone_set('America/Guayaquil'); //puedes cambiar Guayaquil por tu Ciudad
        setlocale(LC_TIME, 'spanish');
        $fecha = new DateTime(gmdate('Y-m-d'));
        //$fecha->setISODate(2016, 1, 1);
        $fecha->modify('-2 month');
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        ?>
                                                Importar datos desde excel del consumo 
                                                <?php echo $meses[($fecha->format('m')) * 1] . ' del ' . $fecha->format('Y'); ?>
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/create" ?> >
                                                <i class="icon-edit"></i>
                                                Ingresar nuevo rubro
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/buscarFacturas" ?> >
                                                <i class="icon-calendar"></i>
                                                Rubros de Factura
                                            </a></li> 
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/rubro/buscarRecibos" ?> >
                                                <i class="icon-calendar"></i>
                                                Rubros de Recibo
                                            </a></li>

                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/exportarMedidas" ?> >
                                                <i class="icon-download"></i>
        <?php
        //echo strftime("%A, %d de %B del %Y  <br><b>HORA:</b> %Hh%M");
        ?>
                                                Exportar medidas de <?php echo strftime("%B"); ?> del <?php echo gmdate('Y'); ?>
                                            </a></li>
                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="glyphicon-usd navbar-default"></i> COBROS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/factura" ?> >
                                                <i class="glyphicon-usd"></i>
                                                Facturación
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/cuota/buscar" ?> >
                                                <i class="glyphicon-usd"></i>
                                                Cobro parcial
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/caja/abrir" ?> >
                                                <i class="icon-calendar"></i>
                                                Abrir caja
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/caja/cerrar" ?> >
                                                <i class="icon-calendar"></i>
                                                Cerrar caja
                                            </a></li>                    
                                    </ul> 
                                </li>

                                <li class="dropdown">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="glyphicon-list navbar-default"></i> REPORTES <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_socios" ?> >
                                                <i class="icon-list"></i>
                                                Lista de socios activos
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/buscar_historial_socio" ?> >
                                                <i class="icon-list"></i>
                                                Historial del socio
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/lista_medidores" ?> >
                                                <i class="icon-time"></i>
                                                Lista de medidores activos
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socioMedidor/factura_cortes" ?> >
                                                <i class="icon-off"></i>
                                                Corte de servicio de agua potable
                                            </a></li>
                                    </ul> 
                                </li>


                            </ul>

                            <ul class="nav navbar-nav navbar-right">

                                <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/site/logout" ?> >
                                        <i class="icon-off navbar"></i>        Salir (<?php echo Yii::app()->user->name ?>)    
                                    </a>
                                </li>
                                <li class="dropdown ">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-user navbar-default"></i> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/cambiar_clave/" . Yii::app()->getSession()->get('id_usuario'); ?> >
                                                Cambiar clave  
                                            </a></li>
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/update/" . Yii::app()->getSession()->get('id_usuario'); ?> >
                                                Modificar Perfil  
                                            </a></li>
                                        <li></li>

                                    </ul> 
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
        <?php
    } //Fin de condicion administrador
    ?>
            <!--FIN OPERADOR-->
            
            
             <?php
    if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esSocio()) {
        ?>
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl; ?>" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">
        <?php echo CHtml::encode(Yii::app()->name); ?>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
     
                                <li class="dropdown">
                                    <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/datos" ?> >
                                                <i class="icon-user icon-white"></i>
                                                Datos personales
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/deudas" ?> >
                                                <i class="icon-briefcase icon-white"></i>
                                                Deudas pendientes
                                            </a></li>
                                        <li><a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                               href=<?php echo Yii:: app()->baseUrl . "/index.php/socio/buscar_historial_consumo" ?> >
                                                <i class="icon-list icon-white"></i>
                                                Historial de consumo
                                            </a></li> 
                            </ul>

                            <ul class="nav navbar-nav navbar-right">

                                <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/site/logout" ?> >
                                        <i class="icon-off navbar"></i>        Salir (<?php echo Yii::app()->user->name ?>)    
                                    </a>
                                </li>
                                <li class="dropdown ">
                                    <a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" 
                                       class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                       aria-expanded="false"><i class="icon-user navbar-default"></i> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/cambiar_clave/"?> > <!-- Yii::app()->getSession()->get('id_usuario'); ?> > -->
                                                Cambiar clave  
                                            </a></li>
<!--                                        <li><a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php //echo Yii:: app()->baseUrl . "/index.php/usuario/update/" . Yii::app()->getSession()->get('id_usuario'); ?> >
                                                Modificar Perfil  
                                            </a></li>-->
                                        <li></li>

                                    </ul> 
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
        <?php
    } //Fin de condicion SOCIO
    ?>
            <!--FIN SOCIO-->





<?php } // Fin de esta logueado  ?>
        <div class="container fondoLogin fondoAdmin">
            <br><br><br>
<?php echo $content; ?>
                        </div>

                        <!--Despues del contentido-->
                        <!--BOTONES ANTERIOR Y SIGUIENTE-->

                        <div class="footer text-center">
                            Copyright &copy; <?php echo gmdate('Y-m-d'); ?> <br/>
                            Todos los derechos reservados.<br/>
<?php //echo "Diseñado por   ";     ?>
                            <a href="http://www.presence-system.com"  TARGET="_new" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" >PRESENCE SYSTEM</a>
                        </div><!-- footer -->
                        </div>
                        <!--</div> page -->

                        </body>
                        </html>
