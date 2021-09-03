<?php

class ReunionController extends AweController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout = '//layouts/column2';

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('',''),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('','' ),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('aplicar_falta','aplicar_atraso','delete','view','pdf_lista_faltas','finalizar_reunion_sin_salida','finalizar_reunion_con_salida','word_lista_asistencia','excel_lista_asistencia','pdf_lista_asistencia','cambiar_de_entrada_salida','salida','consultar_asistencia','lista_asistencia','asistencia_y_codigo_de_barra','asistencia','create','update','admin',''),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
				),
            
			array('deny', 
				'users'=>array('*'),
				),
			);
}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
function actionAplicar_falta($id)
	{
		 $model_reunion = $this->loadModel($id);
		  
		   $model_socios_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.ID FROM
                                             socio as s INNER JOIN socio_medidor as sm
                                             ON s.CODIGO = sm.CODIGO_SOCIO
                                             WHERE 
                                             (SELECT a.CODIGO_ASISTENCIA 
							FROM asistencia AS a WHERE a.`CODIGO_SOCIO`= s.CODIGO 
							AND a.`CODIGO_REUNION` = '.$model_reunion->CODIGO_REUNION.' limit 1) IS NULL
								AND s.FECHA_INGRESO <= "'. $model_reunion->FECHA.'" '
                                             .' AND sm.`INACTIVO` = 0
                                             GROUP BY s.CODIGO ORDER BY APELLIDO');
		  //busca el rubro
		  $model_rubro = Rubro::model()->findBySql('
		  select * from rubro
		  where DESCRIPCION = concat("FALTA A '.$model_reunion->cODIGOTIPO->TIPO.' '.$model_reunion->FECHA.'") '
                          . 'and APLICA = 0');
		  
		  //Si es necesario crea el rubro
		   if (!isset($model_rubro->COD_RUBRO))
		   {
			   $model_rubro = new Rubro();
			   $model_rubro->DESCRIPCION = "FALTA A ".$model_reunion->cODIGOTIPO->TIPO.' '.$model_reunion->FECHA;
				$model_rubro->APLICA = 0;
                                $model_rubro->TIPO = 1;
                                $model_rubro->ID_SUBCUENTA = 2;
				$model_rubro->V_UNITARIO =$model_reunion->VALOR_FALTA;				
				$model_rubro->FEC_CREACION = $model_reunion->FECHA.' '.$model_reunion->HORA_INGRESO;
				$model_rubro->save();
		   }
				//Aplica el rubro a los faltantes
				foreach ($model_socios_medidor as $sm)
				{
					$nuevo_detalle = Detalle::model()->findAllBySql('
					SELECT d.*
					FROM detalle AS d
					INNER JOIN factura AS f
					ON f.`ID` = d.`ID_FACTURA`
					WHERE f.`ID_MEDIDOR_SOCIO` = '.$sm->ID);
					$bandera=0;
					foreach ($nuevo_detalle as $det)
					{
						if($det->ID_RUBRO == $model_rubro->ID)
								$bandera=1;
					}
					if ($bandera == 0)
					{
						$nuevo_detalle = new Detalle();
						$nuevo_detalle->ID_FACTURA = $det->ID_FACTURA;
						$nuevo_detalle->ID_RUBRO = $model_rubro->ID;
						$nuevo_detalle->CANTIDAD = 1;
						$nuevo_detalle->V_UNITARIO = $model_rubro->V_UNITARIO;
						$nuevo_detalle->V_TOTAL = $model_rubro->V_UNITARIO;
						$nuevo_detalle->ESTADO = 0;
						$nuevo_detalle->COD_USUARIO =  (Yii::app()->getSession()->get('id_usuario'));
						$nuevo_detalle->save();
						
					}
				}
		  $this->redirect(array('rubro/'.$model_rubro->ID));
	}
        function actionAplicar_Atraso($id)
	{
		 $model_reunion = $this->loadModel($id);
		  
		     $model_socios_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.ID FROM
                                             socio as s INNER JOIN socio_medidor as sm
                                             ON s.CODIGO = sm.CODIGO_SOCIO
                                             WHERE 
                                             (SELECT a.CODIGO_ASISTENCIA 
							FROM asistencia AS a WHERE a.`CODIGO_SOCIO`= s.CODIGO 
							AND a.`CODIGO_REUNION` = '.$model_reunion->CODIGO_REUNION.' 
                                                            AND a.`REGISTRA_ATRASO` = 1 
                                                            LIMIT 1) 
                                                    AND sm.`INACTIVO` = 0
                                             GROUP BY s.CODIGO ORDER BY APELLIDO');
		  //busca el rubro
		  $model_rubro = Rubro::model()->findBySql('
		  select * from rubro
		  where DESCRIPCION = concat("ATRASO A '.$model_reunion->cODIGOTIPO->TIPO.' '.$model_reunion->FECHA.'") '
                          . 'and APLICA = 0');
		  
		  //Si es necesario crea el rubro
		   if (!isset($model_rubro->COD_RUBRO))
		   {
			   $model_rubro = new Rubro();
			   $model_rubro->DESCRIPCION = "ATRASO A ".$model_reunion->cODIGOTIPO->TIPO.' '.$model_reunion->FECHA;
				$model_rubro->APLICA = 0;
                                $model_rubro->TIPO = 1;
                                $model_rubro->ID_SUBCUENTA = 6;
				$model_rubro->V_UNITARIO =$model_reunion->VALOR_ATRASO;				
				$model_rubro->FEC_CREACION = $model_reunion->FECHA.' '.$model_reunion->HORA_INGRESO;
				$model_rubro->save();
		   }
				//Aplica el rubro a los faltantes
				foreach ($model_socios_medidor as $sm)
				{
					$nuevo_detalle = Detalle::model()->findAllBySql('
					SELECT d.*
					FROM detalle AS d
					INNER JOIN factura AS f
					ON f.`ID` = d.`ID_FACTURA`
					WHERE f.`ID_MEDIDOR_SOCIO` = '.$sm->ID);
					$bandera=0;
					foreach ($nuevo_detalle as $det)
					{	if($det->ID_RUBRO == $model_rubro->ID)			
								$bandera=1;
					}
					if ($bandera == 0)
					{
						$nuevo_detalle = new Detalle();
						$nuevo_detalle->ID_FACTURA = $det->ID_FACTURA;
						$nuevo_detalle->ID_RUBRO = $model_rubro->ID;
						$nuevo_detalle->CANTIDAD = 1;
						$nuevo_detalle->V_UNITARIO = $model_rubro->V_UNITARIO;
						$nuevo_detalle->V_TOTAL = $model_rubro->V_UNITARIO;
						$nuevo_detalle->ESTADO = 0;
						$nuevo_detalle->COD_USUARIO =  (Yii::app()->getSession()->get('id_usuario'));
						$nuevo_detalle->save();
						
					}
				}
		  $this->redirect(array('rubro/'.$model_rubro->ID));
	}
        
    public function actionWord_lista_asistencia($id)
	{       $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
               $model_reunion = $this->loadModel($id);
                $contenido = $this->renderPartial("word_lista_asistencia", array("model_reunion" => $model_reunion), true);
                Yii::app()->request->sendFile("Reporte: ".".doc", $contenido);
		$this->render('word_lista_asistencia', array(
                    'model_reunion' => $model_reunion,
                    'model_asistentes' => $model_asistentes,
		));
	}
    public function actionExcel_lista_asistencia($id)
	{       $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
               $model_reunion = $this->loadModel($id);
                $contenido = $this->renderPartial("excel_lista_asistencia", array("model_reunion" => $model_reunion), true);
                Yii::app()->request->sendFile("Reporte: ".".xls", $contenido);
		$this->render('excel_lista_asistencia', array(
                    'model_reunion' => $model_reunion,
                    'model_asistentes' => $model_asistentes,
		));
	}
         public function actionPdf_lista_asistencia($id) {
              $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
            $model = $this->loadModel($id);
            $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 10, 25, 9, 9, 'P');
            $mpdf->useOnlyCoreFonts = true;
            $mpdf->SetTitle("Reporte");
            $mpdf->SetAuthor("Presence System");
            $mpdf->SetWatermarkText("''www.presencesystem.com.ec''");
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = 'DejaVuSansCondensed';
            $mpdf->watermarkTextAlpha = 0.1;
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($this->renderPartial('pdf_lista_asistencia', array(
                        'model' => $this->loadModel($id),
                        'model_asistentes' => $model_asistentes,
                         'model_reunion' => $this->loadModel($id),
    //            'model3'=>$this->loadModelCursoChilds($id),
    //            'model6'=>$this->loadModelFamiliarChilds($id),
    //            'model8'=>$this->loadModelCasoChilds($id),
                            ), true));
            $mpdf->Output('Reporte ' . date('Y-m-d H:i:s'), 'I');

            //$mpdf->Output('Ficha-'.$model->run.'-('.date(Y.'-'.m.'-'.d).').pdf','I');
            exit;
        }
         public function actionPdf_lista_faltas($id) {
              $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
            $model = $this->loadModel($id);
            $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 10, 25, 9, 9, 'P');
            $mpdf->useOnlyCoreFonts = true;
            $mpdf->SetTitle("Reporte");
            $mpdf->SetAuthor("Presence System");
            $mpdf->SetWatermarkText("''www.presencesystem.com.ec''");
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = 'DejaVuSansCondensed';
            $mpdf->watermarkTextAlpha = 0.1;
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($this->renderPartial('pdf_lista_faltas', array(
                        'model' => $this->loadModel($id),
                        'model_asistentes' => $model_asistentes,
                         'model_reunion' => $this->loadModel($id),
    //            'model3'=>$this->loadModelCursoChilds($id),
    //            'model6'=>$this->loadModelFamiliarChilds($id),
    //            'model8'=>$this->loadModelCasoChilds($id),
                            ), true));
            $mpdf->Output('Reporte faltas' . date('Y-m-d H:i:s'), 'I');

            //$mpdf->Output('Ficha-'.$model->run.'-('.date(Y.'-'.m.'-'.d).').pdf','I');
            exit;
        }
	public function actionLista_asistencia($id)
	{
             $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
//            $bandera=0;
//            foreach ($model_asistentes as $modelo_asistencia) {
//                ////Ya tiene asistencia a la reunion
//                $bandera=1;
//            }
		$this->render('lista_asistencia', array(
			'model' => $this->loadModel($id),
                        'model_asistentes' => $model_asistentes,
                        'model_reunion' => $this->loadModel($id),
		));
	}
        
        public function actionView($id)
	{  $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
		$this->render('view', array(
			'model' => $this->loadModel($id),
                     'model_asistentes' => $model_asistentes,
                        'model_reunion' => $this->loadModel($id),
		));
	}
        public function actionFinalizar_reunion_con_salida($id)
	{  //CAMBIAR ESTADO A TERMINADO CON INGRESO Y SALIDA
                 // Se registro ingreso, salida y se termina la reunión
                          $connection = Yii::app()->db;
                       $sql = "UPDATE reunion SET `ESTADO` = 4, `COD_USUARIO` = ".Yii::app()->getSession()->get('id_usuario')." WHERE `CODIGO_REUNION` = ".$id."";
                              $command = $connection->createCommand($sql);
                             $rows = $command->execute();
			$this->redirect(array('reunion/lista_asistencia', 'id' => $id));
        }
        public function actionFinalizar_reunion_sin_salida($id)
	{  //CAMBIAR ESTADO A TERMINADO SOLO CON INGRESO
                 // Se registro ingreso y se termina
                          $connection = Yii::app()->db;
                       $sql = "UPDATE reunion SET `ESTADO` = 3, `COD_USUARIO` = ".Yii::app()->getSession()->get('id_usuario')." WHERE `CODIGO_REUNION` = ".$id."";
                              $command = $connection->createCommand($sql);
                             $rows = $command->execute();
			$this->redirect(array('reunion/lista_asistencia', 'id' => $id));
        }
         public function actionCambiar_de_entrada_salida($id)
	{  //CAMBIAR ESTADO A REGISTRAR SALIDA
                 // Se registro ingreso y ahora se registra salida
                          $connection = Yii::app()->db;
                       $sql = "UPDATE reunion SET `ESTADO` = 2, `COD_USUARIO` = ".Yii::app()->getSession()->get('id_usuario')." WHERE `CODIGO_REUNION` = ".$id."";
                              $command = $connection->createCommand($sql);
                             $rows = $command->execute();
			$this->redirect(array('asistencia/salir', 'id' => $id));
                        
	
//               if( $model->Save())
//               {
                  
//               }
             //GUARDAR TODOS LOS QUE NO REGISTRARON INGRESO COMO FALTAS
             //FALTA ANALIZAR SI ES NECESARIO O NO 
                /*$fecha_actual=$model->FECHA;
              $model_socios = Socio::model()->findAllBySql('select * from socio where (FECHA_INGRESO <= "'.$fecha_actual.'" and FECHA_SALIDA >= "'.$fecha_actual.'") group by CI order by APELLIDO');
                        $cuenta_socios_activos=0;
                        foreach ($model_socios as $modelo) {
                            $cuenta_socios_activos++;
                        }
              foreach ($model_socios as $modelo_socio) {
                         $modelo_asistente = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$codigo_de_reunion.' and CODIGO_SOCIO = '.$modelo_socio->CODIGO.' group by CODIGO_ASISTENCIA order by CODIGO_ASISTENCIA asc limit 1;');
                                $bandera_tiene_asistencia=0;
                                 foreach ($modelo_asistente as $modelo){ 
                                     $bandera_tiene_asistencia=1;
                                 }
                                 if($bandera_tiene_asistencia==0)
                                 {// Ahun no tiene asistencia, entonces creamos como falta
                                     $modelo_asistentencia_nuevo = new  Asistencia();
                                     $modelo_asistentencia_nuevo->CODIGO_REUNION=$id;
                                     $modelo_asistentencia_nuevo->CODIGO_SOCIO=$modelo_socio->CODIGO;
                                     $modelo_asistentencia_nuevo->FECHA=$modelo->FECHA;
                                     
                                 }
              }          
             $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$id.' ');
		*/
//                $this->render('cambiar_de_entrada_salida', array(
//                
//		//	'model' => $this->loadModel($id),
//                //     'model_asistentes' => $model_asistentes,
//                //        'model_reunion' => $this->loadModel($id),
//		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Reunion;

        $this->performAjaxValidation($model, 'reunion-form');

        if(isset($_POST['Reunion']))
		{
			$model->attributes = $_POST['Reunion'];
                        $model->ESTADO = 1; //Estado CREADO.- puede pasar a registrar ingreso
                         $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
			if($model->save()) {
                //$this->redirect(array('view', 'id' => $model->CODIGO_REUNION));
                            //PASA A REGISTRAR ASISTENCIA
                        $this->redirect(array('asistencia/registrar', 'id' => $model->CODIGO_REUNION));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'reunion-form');

		if(isset($_POST['Reunion']))
		{
			$model->attributes = $_POST['Reunion'];
                         $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
			if($model->save()) {
				$this->redirect(array('view','id' => $model->CODIGO_REUNION));
            }
		}

		$this->render('update',array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Reunion');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Reunion('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Reunion']))
			$model->attributes = $_GET['Reunion'];

		$this->render('admin', array(
			'model' => $model,
		));
	}
        public function actionConsultar_asistencia()
	{
		$model = new Reunion('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['consultar_asistencia']))
			$model->attributes = $_GET['Reunion'];

		$this->render('consultar_asistencia', array(
			'model' => $model,
		));
	}
        public function actionAsistencia()
	{
		$model = new Reunion('searchAsistencia');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Reunion']))
			$model->attributes = $_GET['Reunion'];

		$this->render('asistencia', array(
			'model' => $model,
		));
	}
         public function actionSalida()
	{
		$model = new Reunion('searchAsistencia');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Reunion']))
			$model->attributes = $_GET['Reunion'];

		$this->render('salida', array(
			'model' => $model,
		));
	}
        

         public function actionAsistencia_y_codigo_de_barra()
	{
		$model = new Reunion('searchAsistencia');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Reunion']))
			$model->attributes = $_GET['Reunion'];

		$this->render('asistencia_y_codigo_de_barra', array(
			'model' => $model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id, $modelClass=__CLASS__)
	{
		$model = Reunion::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model, $form=null)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'reunion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
