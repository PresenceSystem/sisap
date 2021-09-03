<?php

class ParametroController extends AweController
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
				'actions'=>array('minicreate'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('editar_valor','crear_tarifa','admin','delete', 'create','update','tarifa','editar_tarifa'),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
				),
                                array('allow', 
				'actions'=>array(''),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
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
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Parametro;

        $this->performAjaxValidation($model, 'parametro-form');

        if(isset($_POST['Parametro']))
		{
			$model->attributes = $_POST['Parametro'];
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}
        
        public function actionCrear_tarifa()
	{
		$model = new Parametro;
                $model_consumo_agua_potable = Parametro::model()->findByPk(1);
                $model->DESCRIPCION = $model_consumo_agua_potable->DESCRIPCION;
                $model->ESTADO = 1;
        $this->performAjaxValidation($model, 'parametro-form');

        if(isset($_POST['Parametro']))
		{
			$model->attributes = $_POST['Parametro'];
                        
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
		}

		$this->render('crear_tarifa',array(
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

        $this->performAjaxValidation($model, 'parametro-form');

		if(isset($_POST['Parametro']))
		{
			$model->attributes = $_POST['Parametro'];
			if($model->save()) {
				$this->redirect(array('view','id' => $model->ID));
            }
		}

		$this->render('update',array(
			'model' => $model,
		));
	}
        
        public function actionEditar_tarifa($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'parametro-form');

		if(isset($_POST['Parametro']))
		{
			$model->attributes = $_POST['Parametro'];
                        $model->ESTADO=1;
			if($model->save()) {
				$this->redirect(array('tarifa'));
            }
		}

		$this->render('editar_tarifa',array(
			'model' => $model,
		));
	}
         public function actionEditar_valor($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'parametro-form');

		if(isset($_POST['Parametro']))
		{
			$model->attributes = $_POST['Parametro'];
                   
			if($model->save()) {
				$this->redirect(array('tarifa'));
            }
		}

		$this->render('editar_valor',array(
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
		$dataProvider=new CActiveDataProvider('Parametro');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Parametro('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Parametro']))
			$model->attributes = $_GET['Parametro'];

		$this->render('admin', array(
			'model' => $model,
		));
	}
        public function actionTarifa()
	{
		$model = new Parametro('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Parametro']))
			$model->attributes = $_GET['Parametro'];

		$this->render('tarifa', array(
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
		$model = Parametro::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'parametro-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
