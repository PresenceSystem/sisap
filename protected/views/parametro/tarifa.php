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
<h2 class="btn-primary text-center">TARIFA VIGENTE <?php echo gmdate('Y') ?></h2>
<fieldset>
    <?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->
    <h3 class="btn-info text-center"> PARÁMETROS DE AGUA POTABLE</h3>
	<h3 class="badge badge-info text-center text-info h3">Valor Básico </h3>
     <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchBase(),
       'columns' => array(
             'DESCRIPCION',
            'VALOR',
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
                   
                 
                ),
                 ),
            
        ),
    ));
    ?>
      
	 <h3 class="badge badge-info text-center text-info">Valores para el cálculo de sobreconsumo</h3>

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
      <h3 class="btn-warning text-center"> PARÁMETROS DEL ALCANTARILLADO</h3>
        <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchAlcantarillado(),
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
        <h3 class="btn-success text-center"> OTROS PARÁMETROS</h3>
    <h3 class="badge badge-success text-center text-info">Valor de aporte para el mejoramiento de la comunidad (RECIBO)</h3>
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
    
    
    
    
    <!-- <h3 class="badge badge-warning text-center text-info">Valor por ingreso de socios nuevos</h3> -->
      
    <?php /*
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchPagoUnico(),
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
    )); */
    ?>
	
	
	<h3 class="badge badge-success text-center text-info">Porcentaje de mora generado por incumplimiento de pago</h3>
	  <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchMora(),
        'columns' => array(
            'DESCRIPCION',
            'VALOR',
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
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                ),
                 ),
        ),
    ));
    ?>
    
   
     
</fieldset>