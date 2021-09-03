<?php 
//Datos del usuario
$foto_aux = Yii::app()->getSession()->get('foto_sismedic');
            if ($foto_aux != null or $foto_aux != '') {
                $foto = Yii:: app()->baseUrl . "/images/fotos/" . $foto_aux;
            } else {
                $foto = Yii:: app()->baseUrl . "/images/iconos_del_sistema/usuario.png";
            }
            ?>


<?php $this->beginContent('//layouts/main'); ?>
      <div class="row-fluid">
        <div class="span10">
		<div class="main">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
        <div class="span2">
          <br>
            <div class="row text-center">
                <!--<img src='<?php // echo Yii::app()->request->baseUrl . '/images/GIF/receta.gif'; ?>' alt="???" width="35%" />-->
                <div class="text-center">
                    <a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/usuario/update/" . Yii::app()->getSession()->get('id_usu_sismedic'); ?> >
                        <img src="<?php echo $foto; ?>" width="70px" alt="..." class="img-circle"></img>
                    </a>
                </div> 
                <a  onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" href=<?php echo Yii:: app()->baseUrl . "/index.php/site/logout" ?> >
                    Salir (<?php echo Yii::app()->user->name ?>)    
                </a>
            </div>
            <br> 
         <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Acciones',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'sidebar'),
			));
			$this->endWidget();
		?>
          <?php /*   <br>
           <div class="row text-center"> <!-- slider -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img src="<?php echo Yii::app()->request->baseUrl .'/images/quero/1.jpg' ?> " alt="Foto">
<!--                            <div class="carousel-caption">
                              <h3>Chania</h3>
                              <p>....</p>
                            </div>-->
                          </div>
                            <?php for ($i = 2; $i <= 8; $i++) {
                                $foto = $i.".jpg" ; ?>
                                <div class="item">
                                  <img src="<?php echo Yii::app()->request->baseUrl.'/images/quero/'.$foto; ?>" alt="Foto">                            
                                </div>
                            <?php }; ?>
                          
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <!--<span class="sr-only">Previous</span>-->
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <!--<span class="sr-only">Next</span>-->
                        </a>
                      </div>
            </div> <!-- Fin del slider --> */ ?>
        </div><!-- sidebar span3 -->
                
                
	
</div>
<?php $this->endContent(); ?>
