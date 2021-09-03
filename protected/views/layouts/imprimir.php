<?php /* @var $this Controller */ ?>
<?php // $this->beginContent('//layouts/main'); ?>
 <title> IMPRIMIR </title>
 <script>
// function myFunction() {
    window.print();
//}
</script>
<div class="span6 ">
    <div id="content">
        <?php  echo $content; ?>
  
    </div><!-- content -->
</div> 
<!-- <div class="span-5 last"> -->
<div class="span-5 last"> 
    <div id="sidebar">
        <?php
               
//        $this->beginWidget('zii.widgets.CPortlet', array(
//            'title' => 'ACCIONES',
//        ));
//         echo "<div class='text-right'>";
////                echo "<div class='text-center space'><b><font color=green size='3' > CATASTRO 2015 </font></b> ";
//                                     echo CHtml::image(Yii::app()->request->baseUrl . '/images/mundo_JT_1.gif','', array("width" => '15%')); 
//                  echo "</div>";
//        $this->widget('zii.widgets.CMenu', array( 
//            'items' => $this->menu,
//            'htmlOptions' => array('class' => 'operations'),
//        ));     $this->endWidget(); 
//                  
    
        ?>
    </div><!-- sidebar -->
 
</div>

<?php // $this->endContent(); ?>