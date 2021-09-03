<?php

class MedidorController extends AweController {

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
                'actions' => array('search'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(''),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('actualizar_alcantarillado', 'solo_alcantarillado',
                    'historial_propietarios', 'cambiarNuevoMedidor', 'ingresar_nuevo',
                    'admin', 'delete', 'create', 'update', 'view', 'buscar_historial',
                    'actualizar'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionHistorial_propietarios($id) {
        $model = Medidor::model()->findByPk($id);
        $socios_medidor = SocioMedidor::model()->findAllBySql('select * '
                . 'from socio_medidor '
                . 'where ID_MEDIDOR = ' . $id . ' order by ID desc');
        $this->render('historial_propietarios', array(
            'model' => $model,
            'socios_medidor' => $socios_medidor,
        ));
    }

    public function actionCambiarNuevoMedidor($id) { //resie el ID de SocioMedidor
        $model_socioMedidor = SocioMedidor::model()->findByPk($id);
        //BUSCAMOS MEDIDOR ANTERIOR
        $model_medidor_anterior = Medidor::model()->findByPk($model_socioMedidor->ID_MEDIDOR);
        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
         //Buscar alcantarillado anexo al servicio de agua potable
        $sql_alcantarillado = "SELECT * FROM `acometida_alcantarillado` AS aa 
                        WHERE aa.`ID_SOCIO_MEDIDOR` = " . $id . " and aa.INACTIVO = 0 limit 1";
        $model_aa = AcometidaAlcantarillado::model()->findBySql($sql_alcantarillado);
        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        //INGRESAMOS NUEVO MEDIDOR 
        $model = new Medidor;
        $model->ORDEN_RECORIDO = $model_socioMedidor->iDMEDIDOR->ORDEN_RECORIDO;
        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            if ($model->save()) {
                //Ingresamos la relacion SocioMedidor
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $model_socioMedidor->CODIGO_SOCIO;
                $nuevo_socio_medidor->ID_MEDIDOR = $model->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                //*******
                //Guardamos el nueo esta del medidor anterior INACTIVO
                //INACTIVO=1 
                $model_socioMedidor->FECHA_SALIDA = date('Y-m-d');
                $model_socioMedidor->INACTIVO = 1;
                if ($model_socioMedidor->save()) {
                   
                    //Guardar nuevo socio medidor
                    if ($nuevo_socio_medidor->save()) {
                         // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                    //2.  Si tiene alcantarillado anexo
                    if (isset($model_aa->ID)) {
                        $model_nueva_aa = new AcometidaAlcantarillado();
                        $model_nueva_aa->ID_SOCIO_MEDIDOR = $nuevo_socio_medidor->ID;
                        $model_nueva_aa->ID_GRUPO = $model_aa->ID_GRUPO;
                        $model_nueva_aa->ESTADO = $model_aa->ESTADO;
                        $model_nueva_aa->DESCRIPCION = $model_aa->DESCRIPCION;
                        $model_nueva_aa->INACTIVO = 0;
                        $model_nueva_aa->FECHA_INGRESO = date('Y-m-d H:i:s');
                        //Desactiva la acometida anterior
                        $model_nueva_aa->save();
                        $model_aa->INACTIVO = 1;
                        $model_aa->INACTIVO_DESCRIPCION = "Se realizó el cambio del médidor del agua potable
                     N°: " . $model_medidor_anterior->NUMERO.'('.$model_medidor_anterior->ID.')'
                            . ' por el nuevo medidor N°: ' . $model->NUMERO.'('.$model->ID.')';
                        $model_aa->FECHA_SALIDA = date('Y-m-d H:i:s');
                        $model_aa->save();
                    } //2.- Fin si tiene alcantarillado anexo
                    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                    //VISUALIZAMOS EL CAMBIO REALIZADO
                        $this->redirect(array('socio/historial_medidores/', 'id' => $model_socioMedidor->CODIGO_SOCIO));
                    }
                }
                //Si queda el socio desactivado despues de ingresar nuevo medidor verificar el siguiente codigo
//                if ($nuevo_socio_medidor->save()) {
//                    //Guardamos el nueo esta del medidor anterior INACTIVO
//                    //INACTIVO=1 
//                    $model_socioMedidor->INACTIVO = 1;
//                    if ($model_socioMedidor->save()) {
//                        //VISUALIZAMOS EL CAMBIO REALIZADO
//                        $this->redirect(array('socio/historial_medidores/', 'id' => $model_socioMedidor->CODIGO_SOCIO));
//                    }
//                }
            }
        }

        $this->render('cambiarNuevoMedidor', array(
            'model' => $model,
            'model_medidor_anterior' => $model_medidor_anterior,
            'model_socioMedidor' => $model_socioMedidor,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
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
        $model = new Medidor;

        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionSolo_alcantarillado($id) { //Ingresa el ID del socio
        $model = new Medidor;
        $model_socio = Socio::model()->findByPk($id);
        $nombres = explode(' ', $model_socio->APELLIDO);
                                $siglas = "";
                                foreach ($nombres as $n){
                                    if ($siglas == "")
                                    $siglas = $n[0].'.';
                                    else
                                        $siglas = $siglas.$n[0].'.';
                                };                                
        $model->NUMERO = "Sin agua potable (casa ".$siglas.")";
        $model->ID_GRUPO = $model_socio->COD_GRUPO;
        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            $model->CONSUMO_INICIAL = 0;
            $model->ORDEN_RECORIDO = 'Sin recorrido';
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            if ($model->save()) {
                //Ingresar socio medidor 
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $id;
                $nuevo_socio_medidor->ID_MEDIDOR = $model->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                $nuevo_socio_medidor->SOLO_ALCANTARILLADO = 1; // Se ingresa solo para el alcantarillado
                $nuevo_socio_medidor->FECHA_INGRESO = date('Y-m-d H:i:s');
                // Fin de ingresar socio medidor 
                if ($nuevo_socio_medidor->save()) {
                    //Regresar al proceso anterior
                    $this->redirect(array('acometidaAlcantarillado/ingresar_solo_alcantarillado', 'id' => $nuevo_socio_medidor->ID)); //Redirige a ingresar la acometida de alcantarillado
                }
            }
        }

        $this->render('solo_alcantarillado', array(
            'model' => $model,
            'model_socio' => $model_socio,
        ));
    }

    public function actionActualizar_alcantarillado($id) { //Ingresa el ID de la acometida_alcantarillado
        $model_acometida_alcantarillado = AcometidaAlcantarillado::model()->findByPk($id);
        $model = $this->loadModel($model_acometida_alcantarillado->iDSOCIOMEDIDOR->iDMEDIDOR->ID);

        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            $model->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
            if ($model->save()) {
                //Actualizar acometida de alcantarillado                  
                $model_acometida_alcantarillado->ID_GRUPO = $model->ID_GRUPO;
                if ($model_acometida_alcantarillado->save()) {
                    //Regresar al proceso anterior
                    $this->redirect(array('socio/view', 'id' => $model_acometida_alcantarillado->iDSOCIOMEDIDOR->cODIGOSOCIO->CODIGO)); //Redirige a ingresar la acometida de alcantarillado
                }
                // Fin de actualizar acometida de alcantarillado
            }
        }

        $this->render('actualizar_alcantarillado', array(
            'model' => $model,
            'model_acometida_alcantarillado' => $model_acometida_alcantarillado,
        ));
    }



    public function actionIngresar_nuevo($id) {
        $model = new Medidor;
        $model_socio = Socio::model()->findByPk($id);
        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            if ($model->save()) {
                ///**** ASIGNAMOS EL MEDIDOR AL SOCIO
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $id;
                $nuevo_socio_medidor->ID_MEDIDOR = $model->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                //*******
                if ($nuevo_socio_medidor->save()) {

                    //BUSCA EL SOCIO MEDIDOR INGRESADO
                    $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT *
                    FROM socio_medidor
                    WHERE `CODIGO_SOCIO` = ' . $id . ' order by ID_MEDIDOR desc limit 1');
                    $modelo_socio_medidor = new SocioMedidor();
                    foreach ($modelos_socio_medidor as $mod) {
                        $modelo_socio_medidor = $mod;
                    }
                    if (isset($modelo_socio_medidor->ID)) {
                        $nuevo_socio_medidor = new SocioMedidor();
                        $query = 'call valor_inicial_vigente(' . $modelo_socio_medidor->ID . ')';
                        $command = Yii::app()->db->createCommand($query);
                        $rowCount = $command->execute();
                        // 2.- Crear rubros básicos
                        $sql = "CALL `aplicar_rubros_basicos`();";
                        $command = Yii::app()->db->createCommand($sql);
                        $rows = $command->queryAll();
                        // 3.- Aplica los rubros básicos 
                        foreach ($rows as $row) {
                            $sql = "CALL cobros_rubro_a_todos(" . $row['ID'] . ", " . $row['TIPO'] . ");";
                            $command = Yii::app()->db->createCommand($sql);
                            $rowCount = $command->execute();
                        }
                        /*                         * ******************************** */


                        $this->redirect(array('socio/ver_medidor/', 'id' => $id));
                    } else {
                        Yii::app()->user->setFlash('Buscar', 'No fue posible ingresar un medidor a nombre del usuario de agua ' . $nuevo_socio_medidor->cODIGOSOCIO->APELLIDO . ', comuniquese con el administrador');
                        $nuevo_socio_medidor = new SocioMedidor();
                        $this->redirect(array('socio/bus_ing_medidor'));
                    }
                } //Fin de ingresa socio_medidor
            }
        }

        $this->render('ingresar_nuevo', array(
            'model' => $model,
            'model_socio' => $model_socio,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            if ($model->save()) {
                echo "<script>javascript:history.go(-2)</script>";
                //   $this->redirect(array('view', 'id' => $model->ID));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }


     public function actionActualizar($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'medidor-form');

        if (isset($_POST['Medidor'])) {
            $model->attributes = $_POST['Medidor'];
            if ($model->save()) {
                //Falta programar para dirigir a la acometida de agua potable
                $sql = "SELECT * 
FROM `sisap`.`socio_medidor`
WHERE ID_MEDIDOR = ".$id." limit 1";
                        $command = Yii::app()->db->createCommand($sql);
                        $rows = $command->queryAll();
                        // 3.- Aplica los rubros básicos 
                        foreach ($rows as $row) {
                           $codigo_acometida = $row['ID'];
                        }

             //  echo "<script>javascript:history.go(-2)</script>";
                   $this->redirect(array('socioMedidor/view', 'id' => $codigo_acometida));
            }
        }

        $this->render('actualizar', array(
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
        $dataProvider = new CActiveDataProvider('Medidor');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Medidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Medidor']))
            $model->attributes = $_GET['Medidor'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
      public function actionBuscar_historial() {
        $model = new Medidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Medidor']))
            $model->attributes = $_GET['Medidor'];

        $this->render('buscar_historial', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Medidor::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'medidor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSearch() {
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {
            $query = 'SELECT m.ID, m.CONSUMO_INICIAL,m.ORDEN_RECORIDO,s.APELLIDO FROM medidor AS m
                INNER JOIN socio_medidor AS sm ON m.ID = sm.ID_MEDIDOR
                INNER JOIN socio AS s ON s.CODIGO = sm.CODIGO_SOCIO
                where sm.INACTIVO= 0 and m.NUMERO="' . $_POST['numero'] . '"';
            $command = Yii::app()->db->createCommand($query);
            $datos = $command->queryAll();
            echo CJSON::encode($datos);
        }
    }

}
