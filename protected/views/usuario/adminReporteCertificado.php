<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	Yii::t('AweCrud.app', 'Certificado'),
);

?>

<fieldset>
    <legend>
        Buscar Estudiante   </legend>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'usuario-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'username',
//        'password',
        'nombres',
//        'email',
//        'telefono',
        /*
        'direccion',
        'foto',
        'id_referencia',
        array(
                    'name' => 'Rol',
                    'value' => 'isset($data->rol) ? $data->rol : null',
                    'filter' => CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn()),
                ),
         */
        'codigo_barra',
        
        //'descripcion',
        
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
         array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
               // 'template' => '{update}  {delete}  {prestar}',
                'template' => ' {certificado}',
                'buttons' => array
                    ( 
                    'certificado' => array
                        (
                        'label' => 'Emitir certificado', 
                        'icon' => 'ok red',
                        'url' => 'Yii::app()->createUrl("usuario/pdfCertificado", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn',                           
                        ),
                    ),
                    
                    ))
        
	
        
	),
)); ?>
</fieldset>