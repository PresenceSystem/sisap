<?php

class DetalleController extends AweController {

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
                'actions' => array(''),
                'users'=>array('*'),
            ),
            array('allow',
                'actions' => array('minicreate'),
                 'users'=>array('@'),
            ),
            array('allow',
                'actions' => array( 'verplazo','buscar_detalles','create', 'update', 'view', 'admin','admin', 'delete'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
             array('allow',
                'actions' => array( 'buscar_detalles'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
	  public function actionVerplazo($id) {
        $model_cuotas = Cuota::model()->findAllBySql('select * from cuota where ID_DETALLE='.$id);
        $this->render('verplazo', array(
            'model' => $this->loadModel($id),
            'model_cuotas' => $model_cuotas,
        ));
    }
    public function actionView($id) {
        $model_cuotas = Cuota::model()->findAllBySql('select * from cuota where ID_DETALLE='.$id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'model_cuotas' => $model_cuotas,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Detalle;

        $this->performAjaxValidation($model, 'detalle-form');

        if (isset($_POST['Detalle'])) {
            $model->attributes = $_POST['Detalle'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'detalle-form');

        if (isset($_POST['Detalle'])) {
            $model->attributes = $_POST['Detalle'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
			$model = $this->loadModel($id);
            $this->loadModel($id)->delete();
			
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
				  $this->redirect(array('rubro/view', 'id' => $model->ID_RUBRO));
                //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Detalle');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Detalle('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Detalle']))
            $model->attributes = $_GET['Detalle'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
 public function actionBuscar_detalles($id) {
       
      //  $model->unsetAttributes(); // clear any default values
        $query = 'call generar_factura_detalle(' . $id . ')';        
        $command = Yii::app()->db->createCommand($query);
        $datos = $command->queryAll();
       // var_dump($query);
       // Yii::app()->end();
        $this->render('buscar_detalles', array(
            'datos' => $datos,
        ));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Detalle::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'detalle-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    

}
