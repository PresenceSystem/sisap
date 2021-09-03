<?php
//header('Content-Type: text/html; charset=ISO-8859-1');

/** @var AsistenciaController $this */
/** @var Asistencia $model */
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('AweCrud.app', 'Create'),
);

//PARA COMPARAR FECHAS
// $fecha_actual = date("Y-n-j");
//                        $hora_actual = date("H:i:s");
//                        $fecha_reunion = $model_reunion->FECHA;
//                            $datetime1 = date_create($fecha_reunion);
//                            $datetime2 = date_create($fecha_actual);
//                            $interval = date_diff($datetime1, $datetime2);
//                            //echo $interval->format('%R%a días'); //Da +2 dias
//                            if($interval->format('%a')==1)
//                            {
//                                echo "Fue ayer";
//                            }
//                            else
//                            {
//                            echo $interval->format('%a');
//                            }
                            

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List').' '.Asistencia::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend>
<!--        <h3 class="text-success text-center ">
            <marquee>REGISTRANDO SALIDA DE LA REUNIÓN</marquee>
        </h3>-->
    
    <?php
    $socio = Yii::app()->getSession()->get('ultimo_registrado');
    if (isset($socio)) {
        $ultimo_registrado = $socio;
        echo '<h3 class="text-inverse badge-warning text-center">Registró salida' . $ultimo_registrado . '</h3>';
    };
    ?>
        </legend>
    <table width="100%">
        <tr>
            <td width="50%">
                <div class="panel-heading alert-info">
                    <?php
                    echo '<center><b>' . $model_reunion->cODIGOTIPO->TIPO . '</b></center>';
                    setlocale(LC_TIME, "spanish");
                    $dateutf = '<br><b>DIA:</b> ' . (strftime("%A, %d de %B de %Y", strtotime($model_reunion->FECHA)));
                    $dateutf = ucfirst(iconv("ISO-8859-1", "UTF-8", $dateutf));
                    echo $dateutf;
                    echo '<br><b>HORA:</b> ' . $model_reunion->HORA_INGRESO;
                    ?>
                </div>
                <div class="panel-title alert-success">
                    <?php if (Yii::app()->user->hasFlash('success')): ?>
                        <div class="info">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php // echo $this->renderPartial('_reloj');  ?>
                <?php echo $this->renderPartial('_form_salida', array('model' => $model)); ?>
                <div class="">
                     <?php
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //  'icon'=>'hand-up',        
                        //'size' => '50px',
                        'buttons' => array(
                            array('label' => 'REGISTRAR SIN LECTOR DE CÓDIGO DE BARRA', 'icon' => 'barcode',
                                'url' => array('/asistencia/salir_sin_lector/', 'id' => $model_reunion->CODIGO_REUNION)),
                        ),
                            )
                    );
                    echo "<br><br><br>";
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //  'icon'=>'hand-up',        
                        //'size' => '50px',
                        'buttons' => array(
                            array('label' => 'FINALIZAR REUNIÓN REGISTRANDO SALIDA', 'icon' => 'off',
                                'url' => array('/reunion/finalizar_reunion_con_salida/', 'id' => $model_reunion->CODIGO_REUNION)),
                        ),
                            )
                    );
                    echo "<br><br>";
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //  'icon'=>'hand-up',        
                        //'size' => '50px',
                        'buttons' => array(
                            array('label' => 'FINALIZAR REUNIÓN SIN REGISTRAR SALIDA', 'icon' => 'off',
                                'url' => array('/reunion/finalizar_reunion_sin_salida/', 'id' => $model_reunion->CODIGO_REUNION)),
                        ),
                            )
                    );
                    ?>
                </div>
            </td>
            <td bgcolor="#444">               
                <?php echo $this->renderPartial('_salida', array('model_reunion' => $model_reunion)); ?>    
                <div class="text-right">
                     <?php
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //  'icon'=>'hand-up',        
                        //'size' => '50px',
                        'buttons' => array(
                            array('label' => 'INFORME COMPLETO', 'icon' => 'fullscreen',
                                'url' => array('/reunion/lista_asistencia/', 'id' => $model_reunion->CODIGO_REUNION)),
                        ),
                            )
                    );
                    ?>
                    <?php
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //  'icon'=>'hand-up',        
                        //'size' => '50px',
                        'buttons' => array(
                            array('label' => 'VER', 'icon' => 'fullscreen',
                                'url' => array('/asistencia/visualizar_pantalla_completa_salida/', 'id' => $model_reunion->CODIGO_REUNION)),
                        ),
                            )
                    );
                    ?>
                </div>
            </td>
        </tr>
    </table>
</fieldset>