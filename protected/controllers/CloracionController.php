<?php

class CloracionController extends AweController {

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
                'actions' => array('', '', ''),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('', '', '', '', '', '', '', '', '', ''),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'create', 'view', 'index', 'update', 'delete'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Cloracion;

        $this->performAjaxValidation($model, 'cloracion-form');

        $model->LLAVET1 = "100";
        $model->LLAVET2 = "10";
        $model->LLAVET3 = "50";
        $model->VALVULA_CL = "2.75";
        $model->LLAVE_DISTRIBUCION = "8";
        $model->FECHA = date('Y-m-d H:i:s');

        if (isset($_POST['Cloracion'])) {
            $model->attributes = $_POST['Cloracion'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->CODIGO));
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

        $this->performAjaxValidation($model, 'cloracion-form');
        $model->FECHA = date('Y-m-d H:i:s');
        if (isset($_POST['Cloracion'])) {
            $model->attributes = $_POST['Cloracion'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->CODIGO));
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
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Cloracion');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Cloracion('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Cloracion']))
            $model->attributes = $_GET['Cloracion'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Cloracion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cloracion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
