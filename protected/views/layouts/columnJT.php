<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        [if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->

        <!-- AGREGAR PARA USAR BOOTSTRAP -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <?php
        echo Yii::app()->bootstrap->registerAllCss();
        echo Yii::app()->bootstrap->registerCoreScripts();
        ?>
        <!-- FIN PARA AGREGAR PARA USAR BOOTSTRAP -->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/images/pagina/icono_medico.ico"> </link>


        <script>

// Mouseover/ Click sound effect- by JavaScript Kit (www.javascriptkit.com)
// Visit JavaScript Kit at http://www.javascriptkit.com/ for full source code

//** Usage: Instantiate script by calling: var uniquevar=createsoundbite("soundfile1", "fallbackfile2", "fallebacksound3", etc)
//** Call: uniquevar.playclip() to play sound

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
                }
                else {
                    return {playclip: function () {
                            throw new Error("Your browser doesn't support HTML5 audio unfortunately")
                        }}
                }
            }

//Initialize two sound clips with 1 fallback file each:

            var mouseoversound = createsoundbite("./../../audio/whistle.ogg", "./../../audio/whistle.mp3")
            var clicksound = createsoundbite("./../../audio/click.ogg", "./../../audio/click.mp3")

        </script>

    </head>
    <body>
        <center>
            <div class="fondoLogin div5JT">                    
                    <?php echo  $content; ?>                
                    </div>
            
        </center>
        
            <div class="fondoAnimado">
            </div>
            <div class="fondoAnimado1">
            </div>
            <div class="fondoAnimado2">
            </div>
        
    </body>
</html>
<?php //$this->beginContent('//layouts/main'); ?>
<!--<div class="row-fluid">
        <div class="span12">
                <div class="fondoLogin">
<?php // echo $content; ?>
                </div>	
        </div> content 
</div>-->
<?php //$this->endContent(); ?>
