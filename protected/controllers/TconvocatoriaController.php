<?php

class TconvocatoriaController extends AweController
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array(
				
				'imprimirConvocatoriasValidacion','listaConvocatoriaValidacion','buscarConvocatoriaValidacion',
                                    'actualizarConvocatoriaValidacion','verConvocatoriaValidacion',
                                    'crearConvocatoriaValidacion','imprimirTickets','actualizarTicket',
                                    'listaTicket','buscarTicket','verTicket','crearTicket','imprimirConvocados',
                                    'listaConvocados','imprimirConvocatorias','listaconvocatoria','crearconvocatoria', 
                                    'create','update','admin','delete'),
				             'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->EsAdministrador()',
				), 
			array('allow', 
				'actions'=>array('adminLocal',
				'crearLocal','imprimirConvocados',
                                    'listaConvocados','imprimirConvocatorias',
									'listaconvocatoria'),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esSecretarioLocal()',
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
public function actionListaConvocados($id)
	{
                Yii::app()->getSession()->add('ConvocatoriaSeleccionada',$id); 
                echo "<script>javascript:history.go(-1)</script>" ;
		$this->render('listaConvocados', array(
			//'model' => $this->loadModel($id),
		));
	}


public function actionImprimirConvocatorias($id) {
        $model = Tconvocatoria::model()->findByPk($id);
        $contenido = $this->renderPartial("imprimirConvocatorias", array("model" => $model), true);
        Yii::app()->request->sendFile("convocatorias.doc", $contenido);

        $this->render('imprimirConvocatorias', array( 
           // 'model' => $model,
                //	'dataProvider' => $dataProvider,
                //    'model' => $this->loadModel($id),
        ));
    }

    public function actionImprimirConvocatoriasValidacion($id) {
        $model = Tconvocatoria::model()->findByPk($id);
		 $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
        $contenido = $this->renderPartial("imprimirConvocatoriasValidacion", array("model" => $model, 'model_fechas_omitir'=>$model_fechas_omitir), true);
        Yii::app()->request->sendFile("Lista de convocatorias validacion ".$model->cODJUNTA->SECTOR_NOMBRE.".doc", $contenido);

        $this->render('imprimirConvocatorias', array( 
           // 'model' => $model,
                //	'dataProvider' => $dataProvider,
                //    'model' => $this->loadModel($id),
        ));
    }
    
    
 public function actionImprimirTickets($id) {
       $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
//                        foreach ($model_fechas_omitir as $omitir) {
//                            echo $omitir->FECHA;
//                        }
     
        $model = Tconvocatoria::model()->findByPk($id);
        $contenido = $this->renderPartial("imprimirTickets", array("model" => $model, 'model_fechas_omitir'=>$model_fechas_omitir), true);
        Yii::app()->request->sendFile("Tickets.doc", $contenido);

        $this->render('imprimirTickets', array( 
            'model_fechas_omitir'=>$model_fechas_omitir,
           // 'model' => $model,
                //	'dataProvider' => $dataProvider,
                //    'model' => $this->loadModel($id),
        ));
    }
    public function actionImprimirConvocados($id) {
        $model = Tconvocatoria::model()->findByPk($id);
        $contenido = $this->renderPartial("imprimirConvocados", array("model" => $model), true);
        Yii::app()->request->sendFile("Lista de convocados.doc", $contenido);

        $this->render('imprimirConvocados', array( 
           // 'model' => $model,
                //	'dataProvider' => $dataProvider,
                //    'model' => $this->loadModel($id),
        ));
    }
         public function actionListaconvocatoria($id) {
        $this->render('listaconvocatoria', array(
            'model' => $this->loadModel($id),
        ));
    }
             public function actionListaConvocatoriaValidacion($id) {
				   $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
        $this->render('listaConvocatoriaValidacion', array(
            'model' => $this->loadModel($id),
			 'model_fechas_omitir'=>$model_fechas_omitir,
        ));
    }
          public function actionListaTicket($id) {
               $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
//                        foreach ($model_fechas_omitir as $omitir) {
//                            echo $omitir->FECHA;
//                        }
            $this->render('listaTicket', array(
                'model' => $this->loadModel($id),
                'model_fechas_omitir'=>$model_fechas_omitir,
            ));
         }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}
        
	public function actionVerConvocatoriaValidacion($id)	     
	{               
            $model_omitir = new TOmitirTicket();
            $model_omitir->COD_CONVOCATORIA = $id;
            
             if (isset($_POST['TOmitirTicket'])) {
                $model_omitir->attributes = $_POST['TOmitirTicket'];            
                if ($model_omitir->save()) {
                    $model_omitir = new TOmitirTicket();
                    $this->redirect(array('verConvocatoriaValidacion', 'id' => $id));
                }
             }
             
              $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select COD_OMITIR, FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
//                        foreach ($model_fechas_omitir as $omitir) {
//                            echo $omitir->FECHA;
//                        }
                        
                        
		$this->render('verConvocatoriaValidacion', array(
			'model' => $this->loadModel($id),
                        'model_omitir' =>$model_omitir,
                        'model_fechas_omitir' =>$model_fechas_omitir,
		));
	}


        public function actionVerTicket($id)
	{               
            $model_omitir = new TOmitirTicket();
            $model_omitir->COD_CONVOCATORIA = $id;
            
             if (isset($_POST['TOmitirTicket'])) {
                $model_omitir->attributes = $_POST['TOmitirTicket'];            
                if ($model_omitir->save()) {
                    $model_omitir = new TOmitirTicket();
                    $this->redirect(array('verTicket', 'id' => $id));
                }
             }
             
              $model_fechas_omitir = TOmitirTicket::model()->findAllBySql(''
                        . 'Select COD_OMITIR, FECHA from tOmitirTicket where COD_CONVOCATORIA = '.$id.' GROUP BY FECHA order by FECHA ASC');
//                        foreach ($model_fechas_omitir as $omitir) {
//                            echo $omitir->FECHA;
//                        }
                        
                        
		$this->render('verTicket', array(
			'model' => $this->loadModel($id),
                        'model_omitir' =>$model_omitir,
                        'model_fechas_omitir' =>$model_fechas_omitir,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Tconvocatoria;
                $model->ENCABEZADO="J.A.A.P.A. SAN VICENTE DE LACAS";
                $model->TITULO="CITACIÓN";
                $model->CUERPO=", para realizar el trabajo de ... del canal principal de Cerro Negro, la concentración se realizará en el sector de .......";
                $model->NOTA="En caso de no asistir será sancionado con la multa respectiva (20 $ USD)";
                $model->FIRMA="LA DIRECTIVA";
                
        $this->performAjaxValidation($model, 'tconvocatoria-form');

        if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];
                        $model->TIPO_PLANTILLA = 1; // Convocatoria
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
			if($model->save()) {
				//Guarda Convocados
//				$lista_socios = socio::model()->findAllBySql('select * from socio WHERE ESTADO != "0"  order by APELLIDO');
//				foreach( $lista_socios as $socio)
//				{
//					$convocado = tConvocado::model()->findBySql('select * from tconvocado where COD_CONVOCATORIA = '.$model->COD_CONVOCATORIA.' and COD_SOCIO = '.$socio->CODIGO);
//					if (isset($convocado) and $convocado->COD_CONVOCADO > 0)
//					{}
//					else
//					{
//						$convocado = new tConvocado();
//						$convocado->COD_SOCIO = $socio->CODIGO;
//						$convocado->COD_CONVOCATORIA = $model->COD_CONVOCATORIA;
//						$convocado->save();
//					}
//				} 
//Fin de guardar convocados
                                
                $this->redirect(array('view', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}
	public function actionCrearLocal()
	{
		$junta = $junta = Yii::app()->getSession()->get('junta_local');
		$model_junta = Junta::model()->findByPk($junta);
		$model = new Tconvocatoria;
                $model->ENCABEZADO="JUNTA DE REGANTES ".$model_junta->SECTOR_NOMBRE;
                $model->TITULO="CITACIÓN";
                $model->CUERPO=", para realizar el trabajo de ... del canal principal de Cerro Negro, la concentración se realizará en el sector de .......";
                $model->NOTA="En caso de no asistir será sancionado con la multa respectiva (20 $ USD)";
                $model->FIRMA="LA DIRECTIVA";
				$model->COD_JUNTA = $junta;
                
        $this->performAjaxValidation($model, 'tconvocatoria-form');

        if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];
			$model->COD_JUNTA = $junta;
                        $model->TIPO_PLANTILLA = 1; // Convocatoria
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('crearLocal',array(
			'model' => $model,
		));
	}
        public function actionCrearConvocatoriaValidacion()
	{
		$model = new Tconvocatoria;
                $model->ENCABEZADO="JUNTA GENERAL DE USUARIOS DE RIEGO CHAMBO-GUANO";
                $model->TITULO="PRIMERA CITACIÓN";
                $model->CUERPO="Usuario del Sistema de Riego Chambo-Guano; se le comunica la obligación que tiene de acercarse a las oficinas de la Junta General de Usuarios (EDIFICIO EX INERHI 2DO PISO; FRENTE A EMERGENCIAS DEL HOSPITAL POLICLÍNICO), y ponerse al día en la actualización de datos del levantamiento catastral.
 Caso contrario su terreno quedará borrado del catastro que entregaremos al Consejo Provincial y a la Secretaría del Agua (SENAGUA)
";
                $model->NOTA="";
                $model->FIRMA="MSc. Patricio Morejon V.";
                $model->TIPO= "VALIDACIÓN DE DATOS";
                $model->FECHA=date('Y-m-d');
                $model->HORA = '08:00';
                
        $this->performAjaxValidation($model, 'tconvocatoria-form');

        if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];
	                $model->TIPO= "VALIDACIÓN DE DATOS";
                        $model->TIPO_PLANTILLA = 3; // Convocatoria JURECH
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
			if($model->save()) {
                $this->redirect(array('verConvocatoriaValidacion', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('crearConvocatoriaValidacion',array(
			'model' => $model,
		));
	}
        
        public function actionCrearTicket()
	{
		$model = new Tconvocatoria;              
                $model->LUNES=1;
                $model->MARTES=1;
                $model->MIERCOLES=1;
                $model->JUEVES=1;
                $model->VIERNES=1;
                
                        
        $this->performAjaxValidation($model, 'tconvocatoria-form');

        if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
                        $model->TIPO_PLANTILLA = 2; // Ticket
			if($model->save()) {
                $this->redirect(array('verTicket', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('crearTicket',array(
			'model' => $model,
		));
	}
        public function actionCrearconvocatoria($id)
	{
		$model = new Tconvocatoria;
                $model->COD_JUNTA=$id;
                $model->ENCABEZADO="J.A.A.P.A. SAN VICENTE DE LACAS";
                $model->TITULO="CITACIÓN";
                $model->NOTA="En caso de no asistir será sancionado con la multa respectiva";
                $model->FIRMA="LA DIRECTIVA";
        $this->performAjaxValidation($model, 'tconvocatoria-form');

        if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];
                        $model->TIPO_PLANTILLA = 1; // Convocatoria
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
                        $model->COD_JUNTA=$id;
			if($model->save()) {
                $this->redirect(array('listaconvocatoria', 'id' => $model->COD_CONVOCATORIA));
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

        $this->performAjaxValidation($model, 'tconvocatoria-form');

		if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];                        
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
			if($model->save()) {
				//$this->redirect(array('view','id' => $model->COD_CONVOCATORIA));
				//Guarda Convocados
//				$lista_socios = socio::model()->findAllBySql('select * from socio WHERE ESTADO != "0" order by APELLIDO');
//				foreach( $lista_socios as $socio)
//				{
//					$convocado = tConvocado::model()->findBySql('select * from tconvocado where COD_CONVOCATORIA = '.$model->COD_CONVOCATORIA.' and COD_SOCIO = '.$socio->CODIGO);
//					if (isset($convocado) and $convocado->COD_CONVOCADO > 0)
//					{}
//					else
//					{
//						$convocado = new tConvocado();
//						$convocado->COD_SOCIO = $socio->CODIGO;
//						$convocado->COD_CONVOCATORIA = $model->COD_CONVOCATORIA;
//						$convocado->save();
//					}
//				} 
//Fin de guardar convocados
                            $this->redirect(array('listaconvocatoria', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('update',array(
			'model' => $model,
		));
	}
        public function actionActualizarConvocatoriaValidacion($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'tconvocatoria-form');

		if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];                        
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
			if($model->save()) {
				//$this->redirect(array('view','id' => $model->COD_CONVOCATORIA));
                            $this->redirect(array('listaConvocatoriaValidacion', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('actualizarConvocatoriaValidacion',array(
			'model' => $model,
		));
	}
        public function actionActualizarTicket($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'tconvocatoria-form');

		if(isset($_POST['Tconvocatoria']))
		{
			$model->attributes = $_POST['Tconvocatoria'];     
                         $model->TIPO_PLANTILLA = 2; // Ticket
                        $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usu_jurechgis'));
                        
			if($model->save()) {
				//$this->redirect(array('view','id' => $model->COD_CONVOCATORIA));
                            $this->redirect(array('verTicket', 'id' => $model->COD_CONVOCATORIA));
            }
		}

		$this->render('actualizarTicket',array(
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
		$dataProvider=new CActiveDataProvider('Tconvocatoria');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Tconvocatoria('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Tconvocatoria']))
			$model->attributes = $_GET['Tconvocatoria'];

		$this->render('admin', array(
			'model' => $model,
		));
	}
		public function actionAdminLocal()
	{
		$model = new Tconvocatoria('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Tconvocatoria']))
			$model->attributes = $_GET['Tconvocatoria'];

		$this->render('adminLocal', array(
			'model' => $model,
		));
	}
        public function actionBuscarTicket()
	{
		$model = new Tconvocatoria('searchTicket');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Tconvocatoria']))
			$model->attributes = $_GET['Tconvocatoria'];

		$this->render('buscarTicket', array(
			'model' => $model,
		));
	}
         public function actionBuscarConvocatoriaValidacion()
	{
		$model = new Tconvocatoria('searchTicket');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Tconvocatoria']))
			$model->attributes = $_GET['Tconvocatoria'];

		$this->render('buscarConvocatoriaValidacion', array(
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
		$model = Tconvocatoria::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'tconvocatoria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
