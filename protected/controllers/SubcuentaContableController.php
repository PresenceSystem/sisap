<?php

class SubcuentaContableController extends AweController {

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
                'actions' => array('', ''),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('ver','create', 'update', 'admin', 'delete',
                    'listarSubcuentas','lista_deudores','lista_cobros_hoy',
                    'lista_cobros_historico','lista_cobros_dia',
                    'ver_con_dia',
                    'cobros_historicos'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('allow',
                'actions' => array(),
                'users' => array('admin'),
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
    public function actionListarSubcuentas($term) {
        $criteria = new CDbCriteria;
        $criteria->condition = "(LOWER(CODIGO) like LOWER(:term) or LOWER(SUBCUENTA) like LOWER(:term))";
        $criteria->params = array(':term' => '%' . $_GET['term'] . '%');
        $criteria->limit = 30;
        $models = SubcuentaContable::model()->findAll($criteria);
        $arr = array();
        foreach ($models as $model) {
            $arr[] = array(
                'label' => ('CUENTA: ' . $model->CODIGO . ' ( ' . $model->SUBCUENTA . ')'), // label for dropdown list
                'value' => $model->SUBCUENTA, // value for input field
                'id' => $model->ID, // return value from autocomplete
            );
        }
        echo CJSON::encode($arr);
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
     public function actionVer($fecha_parametro) {
         
         if (isset($fecha_parametro)) {
    $fecha_parametro = explode('_', $fecha_parametro);
    $mes = $fecha_parametro[0];
    $anio = $fecha_parametro[1];
    $subcuenta = $fecha_parametro[2];    
     $model = SubcuentaContable::model()->findByPk($subcuenta);
}
        $this->render('ver', array(
          //  'model' => $this->loadModel($subcuenta),
            'model' => $model,
            'anio' => $anio,
            'mes' => $mes,
        ));
    }
    public function actionVer_con_dia($fecha_parametro) {
         
         if (isset($fecha_parametro)) {
    $fecha_parametro = explode('_', $fecha_parametro);
    $dia = $fecha_parametro[0];
    $mes = $fecha_parametro[1];
    $anio = $fecha_parametro[2];
    $subcuenta = $fecha_parametro[3];    
     $model = SubcuentaContable::model()->findByPk($subcuenta);
}
        $this->render('ver_con_dia', array(
          //  'model' => $this->loadModel($subcuenta),
            'model' => $model,
            'anio' => $anio,
            'mes' => $mes,
            'dia' => $dia,
        ));
    }
     public function actionLista_deudores() {
        $this->render('lista_deudores', array(            
        ));
    }
      public function actionLista_cobros_hoy() {
        $this->render('lista_cobros_hoy', array(            
        ));
    }
    public function actionLista_cobros_historico($fecha_parametro) {
        
        $this->render('lista_cobros_historico', array( 
            'fecha_parametro' => $fecha_parametro,
        ));
    }
       public function actionLista_cobros_dia($fecha_parametro) {
        
        $this->render('lista_cobros_dia', array( 
            'fecha_parametro' => $fecha_parametro,
        ));
    }
    public function actionCobros_historicos() {
        
        $this->render('cobros_historicos', array(             
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SubcuentaContable;

        $this->performAjaxValidation($model, 'subcuenta-contable-form');

        if (isset($_POST['SubcuentaContable'])) {
            $model->attributes = $_POST['SubcuentaContable'];
            $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
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

        $this->performAjaxValidation($model, 'subcuenta-contable-form');

        if (isset($_POST['SubcuentaContable'])) {
                 $connection_sisap = Yii::app()->db;
            $model->attributes = $_POST['SubcuentaContable'];
            $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
            if ($model->save()) {
                 //Actualizar los rubros si aplica mora/interes
                $sql = "CALL actualizar_aplica_interes(".$model->ID.",".$model->MORA.");";
                $command = $connection_sisap->createCommand($sql);
                $rowCount = $command->execute();
                //Fin de Actualizar los rubros si aplica mora/interes
                //$this->redirect(array('view', 'id' => $model->ID));
                $this->redirect(array('claseContable/listar_rubros'));
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
        $dataProvider = new CActiveDataProvider('SubcuentaContable');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SubcuentaContable('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SubcuentaContable']))
            $model->attributes = $_GET['SubcuentaContable'];

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
        $model = SubcuentaContable::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subcuenta-contable-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
