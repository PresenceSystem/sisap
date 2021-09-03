<?php
/** @var ParametroController $this */
/** @var Parametro $model */
$this->breadcrumbs = array(
    'Parametros' => array('index'),
    Yii::t('AweCrud.app', 'Manage'),
);

$this->menu = array(
  //  array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Parametro::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' tarifa',  'icon' => 'plus', 'url' => array('crear_tarifa')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('parametro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <center>  <div class="btn-primary text-center">TARIFA VIGENTE <?php echo gmdate('Y'); ?></div></center>
    </legend>

    <?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchTarifa(),
       // 'filter' => $model,
        'columns' => array(
          // 'ID',
            'DESCRIPCION',
            'VALOR',
            'VALOR_MIN',
            'VALOR_MAX',
//            array(
//                'name' => 'ESTADO',
//                'value' => '($data->ESTADO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
//                'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
//            ),
             array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'Editar',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("parametro/editar_tarifa", array("id"=>$data->ID))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                   
                   
                   
//                    'pdf' => array(
//                        'label' => 'Generar PDF',
//                        'url' => "CHtml::normalizeUrl(array('pdf_socio', 'id'=>\$data->CODIGO
//                         ))",                        
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/imp_pdf.png',
//                        'options' => array('class' => 'pdf', 'target'=>'_BLANK'),
//                    ),
                ),
                 ),
            
//            array(
//                'class' => 'bootstrap.widgets.TbButtonColumn',
//            ),
        ),
    ));
    ?>
    
    
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchComunidad(),
       // 'filter' => $model,
        'columns' => array(
          // 'ID',
            'DESCRIPCION',
            'VALOR',
           // 'VALOR_MIN',
          //  'VALOR_MAX',
//            array(
//                'name' => 'ESTADO',
//                'value' => '($data->ESTADO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
//                'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
//            ),
             array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'Editar',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("parametro/editar_valor", array("id"=>$data->ID))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                   
                   
                   
//                    'pdf' => array(
//                        'label' => 'Generar PDF',
//                        'url' => "CHtml::normalizeUrl(array('pdf_socio', 'id'=>\$data->CODIGO
//                         ))",                        
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/imp_pdf.png',
//                        'options' => array('class' => 'pdf', 'target'=>'_BLANK'),
//                    ),
                ),
                 ),
            
//            array(
//                'class' => 'bootstrap.widgets.TbButtonColumn',
//            ),
        ),
    ));
    ?>
    
    
    
     
</fieldset>