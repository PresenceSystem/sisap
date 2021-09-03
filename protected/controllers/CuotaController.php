<?php

class CuotaController extends AweController
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
				'actions'=>array(''),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array(''),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('pago_parcial','view','buscar','admin','delete', 'create','update'),
				 'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
				),
                        array('allow', 
				'actions'=>array('pago_parcial','buscar'),
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
		$model = new Cuota;

        $this->performAjaxValidation($model, 'cuota-form');

        if(isset($_POST['Cuota']))
		{
			$model->attributes = $_POST['Cuota'];
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}
        
        
        
        public function actionPago_parcial($id)
	{
		$model = new Cuota;
                $model_detalle = Detalle::model()->findAllBySql('call buscar_detalle('.$id.')');
                foreach ($model_detalle as $model_detalle)
                { };
                $this->performAjaxValidation($model, 'cuota-form');
                $model->ID_DETALLE = $id;
                if(isset($_POST['Cuota']))
                        {
                                $model->attributes = $_POST['Cuota'];
                                if($model->save()) {
                                    $this->redirect(array('detalle/view', 'id' => $model->ID_DETALLE));
                                }   
                        }

		$this->render('pago_parcial',array(
			'model' => $model,
                        'model_detalle' => $model_detalle,
		));
	}
        
        
        
        
        
        
        public function actionBuscar()
	{
		$model = new Cuota;

        $this->performAjaxValidation($model, 'cuota-form');

        if(isset($_POST['Cuota']))
		{
			$model->attributes = $_POST['Cuota'];
			if ($model->ID_DETALLE > 0)
                        { //Pasar como parametro CODIGO del socio de agua
                                 $this->redirect(array('detalle/buscar_detalles','id' => $model->ID_DETALLE));
                        }
		}

		$this->render('buscar',array(
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

        $this->performAjaxValidation($model, 'cuota-form');

		if(isset($_POST['Cuota']))
		{
			$model->attributes = $_POST['Cuota'];
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
		$dataProvider=new CActiveDataProvider('Cuota');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Cuota('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Cuota']))
			$model->attributes = $_GET['Cuota'];

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
		$model = Cuota::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'cuota-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
