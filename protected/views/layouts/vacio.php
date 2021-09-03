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


        <div class="container fondoLogin fondoAdmin">  
                        <?php echo $content; ?>
                        </div>

             

                        </body>
                        </html>
