<?php
/** @var TMedicoController $this */
/** @var TMedico $model */
$this->breadcrumbs = array(
	'Lista de médicos',
);
//
//$this->menu = array(
////    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . TMedico::label().' con permiso de acceso al sistema', 'icon' => 'plus', 'url' => array('ingresar')),
////      array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . TMedico::label().' sin permiso de acceso al sistema', 'icon' => 'plus', 'url' => array('create')),
////    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'list-alt', 'url' => array('pdf'), 'linkOptions' => array('target'=>'_blank')),
//);
?>

<fieldset>
    <legend>
        <?php // echo Yii::t('AweCrud.app', 'List') ?> <?php // echo TMedico::label(2) ?>    
        <h2 class="text-center alert-success">LISTA DE USUARIOS</h2>
    </legend>
    <table class="table-bordered table-condensed table-hover table table-striped">
        <thead class="text-info alert-info">
            <tr>
                <th>
                    N°
                </th>
                <th>
                    Apellido y Nombre
                </th>
                <th>
                    Usuario
                </th>
                <th>
                    Rol
                </th>               
            </tr>
        </thead>
        <tbody>              
            <?php
            $contador=1;
            $model_usuarios = Usuario::model()->findAllBySql(''
                               . 'SELECT * FROM `Usuario` '
                               . ' order by nombres, username, Rol desc ');
                       foreach ($model_usuarios as $model) {
                        echo "<tr>";
                            echo "<td>";
                                  echo $contador++;
                            echo "</td>";
                            
                            echo "<td>";
                                  //echo $model->apellido." ".$model->nombre;
                                  echo CHtml::link($model->nombres, array('usuario/view/',
                                     'id' => $model->id));
                            echo "</td>";
                              echo "<td>";
                                  echo $model->username;
                            echo "</td>";
                              echo "<td>";
                                  echo $model->rol->Rol;
                            echo "</td>";
                            
                        echo "</tr>";
                       }                  
                   ?>           
        </tbody>
    </table>
</fieldset>