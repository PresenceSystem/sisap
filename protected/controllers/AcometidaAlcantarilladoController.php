<?php

class AcometidaAlcantarilladoController extends AweController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('search'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('ingresar_solo_alcantarillado', 'ingresar', 'admin', 'delete', 'create', 'search',
                    'update', 'view', 'lista_socios_x_grupo'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('allow',
                'actions' => array('', ''),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionLista_socios_x_grupo() {
        $model_grupo = Grupo::model()->findAllBySql('SELECT * FROM grupo where DESCRIPCION != "N/A"  ORDER BY GRUPO ASC');
        $model_socios = Socio::model()->findAllBySql('
            select s.APELLIDO, 
            s.CI, 
            s.CELULAR, 
            s.TELEFONO, 
            m.NUMERO as OBS,
            m.ORDEN_RECORIDO AS COD_USUARIO,
            sm.ID as COD_BARRA,
            m.ID_GRUPO as COD_GRUPO '
                . ' from socio as s'
                . ' inner join acometida_alcantarillado as aa'
                . ' on s.CODIGO = aa.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = aa.ID_MEDIDOR'
                . ' where aa.INACTIVO=0'
                . ' order by s.APELLIDO');
        $this->render('lista_socios_x_grupo', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo,
        ));
    }

    public function actionSearch() {
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {
            $query = 'SELECT g.DESCRIPCION, m.ID, m.CONSUMO_INICIAL,m.ORDEN_RECORIDO,s.APELLIDO 
                FROM medidor AS m
                INNER JOIN socio_medidor AS sm ON m.ID = sm.ID_MEDIDOR
                INNER JOIN socio AS s ON s.CODIGO = sm.CODIGO_SOCIO
                INNER JOIN grupo as g ON g.COD_GRUPO = m.ID_GRUPO
                where sm.INACTIVO = 0 and sm.ID="' . $_POST['socio_medidor'] . '"';
            $command = Yii::app()->db->createCommand($query);
            $datos = $command->queryAll();
            echo CJSON::encode($datos);
        }
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
    public function actionIngresar($id) { //Recibe el CODIGO del socio
        $model = new AcometidaAlcantarillado;
        $sql = 'select * from socio_medidor where CODIGO_SOCIO = ' . $id .
                ' AND (SELECT a.ID
                FROM socio_medidor AS sm
                INNER JOIN acometida_alcantarillado AS a
                ON a.ID_SOCIO_MEDIDOR = sm.ID
                WHERE sm.ID = socio_medidor.`ID`
                ORDER BY a.ID_GRUPO DESC 
                LIMIT 1) IS NULL ';
        $this->performAjaxValidation($model, 'acometida-alcantarillado-form');

        if (isset($_POST['AcometidaAlcantarillado'])) {
            $model->attributes = $_POST['AcometidaAlcantarillado'];
            $model_socio_medidor = SocioMedidor::model()->findByPk($model->ID_SOCIO_MEDIDOR);
            $model->ID_GRUPO = $model_socio_medidor->iDMEDIDOR->ID_GRUPO;
            if ($model->FECHA_INGRESO == null) {
                $model->FECHA_INGRESO = date('Y-m-d H:i:s');
            }
            if ($model->save()) {
                $this->redirect(array('socio/view', 'id' => $model->iDSOCIOMEDIDOR->CODIGO_SOCIO));
                //$this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('ingresar', array(
            'model' => $model,
            'sql' => $sql,
            'id' => $id, //Código del socio
        ));
    }

    public function actionIngresar_solo_alcantarillado($id) { //Recibe el ID de socio_medidor
        $model = new AcometidaAlcantarillado;
        $model->ID_SOCIO_MEDIDOR = $id;
        $sql = 'select * from socio_medidor where ID = ' . $id;
        $this->performAjaxValidation($model, 'acometida-alcantarillado-form');

        if (isset($_POST['AcometidaAlcantarillado'])) {
            $model->attributes = $_POST['AcometidaAlcantarillado'];
            $model_socio_medidor = SocioMedidor::model()->findByPk($id);
            $model->ID_GRUPO = $model_socio_medidor->iDMEDIDOR->ID_GRUPO;
            if ($model->FECHA_INGRESO == null) {
                $model->FECHA_INGRESO = date('Y-m-d H:i:s');
            }
            if ($model->save()) {
                ////////////////////////////////////////////////////////////////
                $model_nuevo_socio = Socio::model()->findByPk($model_socio_medidor->ID);
                //3.1.- Verificar si tienen servicio de agua potable
                if (isset($model_nuevo_socio->CODIGO) && $model_nuevo_socio->CODIGO > 0) {
                    $sql = 'SELECT * FROM `socio_medidor` WHERE INACTIVO = 0 AND `SOLO_ALCANTARILLADO` = 0 AND `CODIGO_SOCIO` = ' . $model_nuevo_socio->CODIGO . ' limit 1';
                    $agua_potable = SocioMedidor::model()->findBySql($sql);
                    if (isset($agua_potable->ID) && $agua_potable->ID > 0) {
                        $model_nuevo_socio->USU_AGUA_POTABLE = 1;
                    } else {
                        $model_nuevo_socio->USU_AGUA_POTABLE = 0;
                    };
                };
                //3.2.- Verificar si tienen servicio de alcantarillado
                if (isset($model_nuevo_socio->CODIGO) && $model_nuevo_socio->CODIGO > 0) {
                    $sql = 'SELECT * FROM `socio_medidor` AS sm
                            INNER JOIN `acometida_alcantarillado` AS aa
                            ON aa.`ID_SOCIO_MEDIDOR` = sm.`ID`
                             WHERE aa.INACTIVO = 0 
                             AND sm.`CODIGO_SOCIO` = 
                             ' . $model_nuevo_socio->CODIGO . ' limit 1';
                    $agua_potable = SocioMedidor::model()->findBySql($sql);
                    if (isset($agua_potable->ID) && $agua_potable->ID > 0) {
                        $model_nuevo_socio->USU_ALCANTARILLADO = 1;
                    } else {
                        $model_nuevo_socio->USU_ALCANTARILLADO = 0;
                    };
                }
                //3.3.- Verificamos si tiene q estar activo para los cobros
                if ($model_nuevo_socio->USU_AGUA_POTABLE == 0 && $model_nuevo_socio->USU_ALCANTARILLADO == 0) {
                    $model_nuevo_socio->PARTICIPA_COMUNIDAD = 0;
                    $model_nuevo_socio->ESTADO = 0;
                } else {
                    $model_nuevo_socio->PARTICIPA_COMUNIDAD = 1;
                    $model_nuevo_socio->ESTADO = 1;
                }
                //3.4.- Guardar los datos de los socios
                $model_nuevo_socio->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                $model_nuevo_socio->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
                $model_nuevo_socio->save();
                ////////////////////////////////////////////////////////////////
                $this->redirect(array('socio/view', 'id' => $model->iDSOCIOMEDIDOR->CODIGO_SOCIO));
                //   $this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('ingresar_solo_alcantarillado', array(
            'model' => $model,
            'sql' => $sql,
            'id' => $id, //Código del socio
        ));
    }

    public function actionCreate() {
        $model = new AcometidaAlcantarillado;

        $this->performAjaxValidation($model, 'acometida-alcantarillado-form');

        if (isset($_POST['AcometidaAlcantarillado'])) {
            $model->attributes = $_POST['AcometidaAlcantarillado'];
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

        $this->performAjaxValidation($model, 'acometida-alcantarillado-form');

        if (isset($_POST['AcometidaAlcantarillado'])) {
            $model->attributes = $_POST['AcometidaAlcantarillado'];
            if ($model->save()) {
                $this->redirect(array('socio/view', 'id' => $model->iDSOCIOMEDIDOR->CODIGO_SOCIO));
                // $this->redirect(array('view', 'id' => $model->ID));
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
        $dataProvider = new CActiveDataProvider('AcometidaAlcantarillado');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AcometidaAlcantarillado('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['AcometidaAlcantarillado']))
            $model->attributes = $_GET['AcometidaAlcantarillado'];

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
        $model = AcometidaAlcantarillado::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'acometida-alcantarillado-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
