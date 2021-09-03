<?php

class FacturaController extends AweController
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
				'actions'=>array('index','view','admin'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('ver','minicreate', 'create','update','anular','buscar_factura'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	public function actionView($id)
	{
             //$usuario= Yii::app()->getSession()->get('id_usuario');
             $usuario = 6;
		$modelo_detalles = Detalle::model()->findAllBySql('call buscar_factura_por_anular(' . $id .', '.$usuario.')');
		$this->render('view', array(
			'model' => $this->loadModel($id),
			'modelo_detalles' => $modelo_detalles,
		));
	}
        public function actionVer($id)
	{
             $usuario= Yii::app()->getSession()->get('id_usuario');
		$modelo_detalles = Detalle::model()->findAllBySql('call buscar_factura_por_anular(' . $id .', '.$usuario.')');
		$this->render('ver', array(
			'model' => $this->loadModel($id),
			'modelo_detalles' => $modelo_detalles,
		));
	}
	public function actionAnular($id)
	{
		 //$usuario= Yii::app()->getSession()->get('id_usuario');
                 $usuario = 6;
		$modelo_detalles = Detalle::model()->findAllBySql('call anular_factura_x_id(' . $id .', '.$usuario.')');
		  $this->redirect(array('socioMedidor/factura'));
		$this->render('anular', array(			
			'modelo_detalles' => $modelo_detalles,
		));
	}
		public function actionBuscar_factura()
	{		
		$modelo_facturas = Factura::model()->findAllBySql('call buscar_facturas()');
		 // $this->redirect(array('socioMedidor/factura'));
		$this->render('buscar_factura', array(			
			'modelo_facturas' => $modelo_facturas,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Factura;

        $this->performAjaxValidation($model, 'factura-form');

        if(isset($_POST['Factura']))
		{
			$model->attributes = $_POST['Factura'];
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
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

        $this->performAjaxValidation($model, 'factura-form');

		if(isset($_POST['Factura']))
		{
			$model->attributes = $_POST['Factura'];
			if($model->save()) {
				$this->redirect(array('view','id' => $model->ID));
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
		$dataProvider=new CActiveDataProvider('Factura');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Factura('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Factura']))
			$model->attributes = $_GET['Factura'];

		$this->render('admin', array(
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
		$model = Factura::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'factura-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
