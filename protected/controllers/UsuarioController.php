<?php

class UsuarioController extends AweController {

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
                'actions' => array('modificar_Perfil','ver_Perfil', '', '', '', '', '', '', '', ''),
                'users' => array('@'),
            ), 
            array('allow',
                'actions' => array('listar','index','admin','create','view','update','delete'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('allow',
                'actions' => array('mensaje_cambio_clave','cambiar_clave','adminMedico','createMedico','view_Medico','updateMedico'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('allow',
                'actions' => array('mensaje_cambio_clave','cambiar_clave','modificar_Perfil','ver_Perfil',),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esSocio()',
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
     public function actionVer_Perfil($id) {
        if (Yii::app()->user->id == $id) {
            $this->render('ver_Perfil', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            $nombre = Yii::app()->getSession()->get('nombre_usuario');
            throw new CHttpException(400, '' . $nombre . ' no tienes permiso para ver el perfil de otro usuario');
        }
    }

     public function actionModificar_Perfil($id) {
        //Validar q seha el perfil personal????           
        if (Yii::app()->user->id == $id) { //1. Seguridad 1-3
            $model = $this->loadModel($id);
            $ImagenAntigua = $model->foto;
            $this->performAjaxValidation($model, 'usuario-form');
            $clave = $model->password;
            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
               // $model->Rol = 4; //ROL DE TECNICO DEL GADPCH
                /* Agregado para que la clave se guarde en MD5 */
                if (isset($_POST['Usuario']['password']) and ( $_POST['Usuario']['password']) != '') {
                    $model->password = md5($model->password); //Encriptar en MD5
                    $model->validador_pass = md5($model->validador_pass);
                } else {
                    $model->password = $clave;
                    $model->validador_pass = $clave;
                }
                /**/

                /* Codigo para subir fotos */
                $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999

                /**/
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;
                    if ($fileName == '' or $fileName == null) {
                        $fileName = $ImagenAntigua;
                    }
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('ver_Perfil', 'id' => $model->id));
                    }
                } else {
                    $model->foto = $ImagenAntigua;
                    if ($model->save()) {
                        $this->redirect(array('ver_Perfil', 'id' => $model->id));
                    }
                }
                /* Fin del código para subir fotos */



                // Por defecto para guardar el modelo pasado como parametro
//                if ($model->save()) {
//                    $this->
//                            redirect(array('view_Topografo', 'id' => $model->id));
//                }
            }

            $this->render('modificar_Perfil', array(
                'model' => $model,
            ));
            //2. seguridad
        } else {
            $nombre = Yii::app()->getSession()->get('nombre_usuario');
            throw new CHttpException(400, '' . $nombre . ' no tienes permiso para modificar el perfil de otro usuario, guardaremos su petición por seguridad');
        }
        //3. Fin de seguridad
    }
    public function actionListar() {
        $this->render('listar', array(
           // 'model' => $this->loadModel($id),
                // 'usuario' => $usuario,
        ));
    }
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        )); 
    }
     public function actionMensaje_cambio_clave() {
         $id = Yii::app()->getSession()->get('id_usuario');
        $this->render('mensaje_cambio_clave', array(
            'model' => $this->loadModel($id),
        )); 
    }
    
     public function actionView_Medico($id) {
        $this->render('view_Medico', array(
            'model' => $this->loadModel($id),
        ));
    }
     public function actionView_Paciente($id) {
        $this->render('view_Paciente', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
             // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()) { //1. Seguridad 1-3
        $model = new Usuario;

        $this->performAjaxValidation($model, 'usuario-form');

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            /* Agregado para que la clave se guarde en MD5 */
            
             $numero_aleatorio = rand(0, 999);
             $model->descripcion='Presence System clave: '.$numero_aleatorio.'000.'.$model->password.$numero_aleatorio;
            
            $model->password = md5($model->password);
            $model->validador_pass = md5($model->validador_pass);
            /**/
             /* Codigo para subir fotos */
                    $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999                    
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;                           
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                } 
                else
                {
                    if ($model->save()) {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
//            if ($model->save()) {
//                $this->redirect(array('view', 'id' => $model->id));
//            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
        //2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador,  para realizar esta acción');
       // }
        //3. Fin de seguridad
    }
     public function actionCreateMedico() {
         // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3
        $model = new Usuario;

        $this->performAjaxValidation($model, 'usuario-form');

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            /* Agregado para que la clave se guarde en MD5 */
            $model->password = md5($model->password);
            $model->Rol = 2; //El rol es Medico
            /**/
              /* Codigo para subir fotos */
                    $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999

                    /**/ 
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;                           
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('view_Medico', 'id' => $model->id));
                    }
                } 
                else
                {
                    if ($model->save()) {
                        $this->redirect(array('view_Medico', 'id' => $model->id));
                    }
                }
                /* Fin del código para subir fotos */
//            if ($model->save()) {
//                $this->redirect(array('view_Medico', 'id' => $model->id));
//            }
        }

        $this->render('createMedico', array(
            'model' => $model,
        ));
        //2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador o medico,  para realizar esta acción');
        //}
        //3. Fin de seguridad
    }
    

    public function actionCreatePaciente($id) {
        $model = new Usuario;
        //Creado para comprobar si ya fue pasado al sistema medico este paciente
        $model_usuario = new Usuario;
       

        //Para cargar os datos del paciente al usuario

            $model_paciente = new Paciente;
            $model_paciente = Paciente::model()->findByPk($id);
            $model->Rol = '3'; // Paciente
            $model->codigo_barra = $model_paciente->Codigo;
            $model->descripcion = "CI." . $model_paciente->Ci . ", Sexo: " . $model_paciente->Sexo . ", Tipo_Sangre:" . $model_paciente->Tipo_Sangre;
            $model->direccion = $model_paciente->Direccion;
            $model->email = $model_paciente->Mail;
            $model->foto = '';
            $model->id_referencia = $id;
            $model->nombres = $model_paciente->Apellido;
            $model->password = $model_paciente->Ci;
            /* Agregado para que la clave se guarde en MD5 */
            $model->password = md5($model->password);
            /**/
            $model->telefono = trim($model_paciente->Telefono);
            $model->username = $model_paciente->Ci;
        


        $this->performAjaxValidation($model, 'usuario-form');

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
               $model->Rol = '3'; // Paciente
            $model->codigo_barra = $model_paciente->Codigo;
            $model->descripcion = "CI." . $model_paciente->Ci . ", Sexo: " . $model_paciente->Sexo . ", Tipo_Sangre:" . $model_paciente->Tipo_Sangre;
            $model->direccion = $model_paciente->Direccion;
            $model->email = $model_paciente->Mail;
            $model->foto = '';
            $model->id_referencia = $id;
            $model->nombres = $model_paciente->Apellido;
            $model->password = $model_paciente->Ci;
            /* Agregado para que la clave se guarde en MD5 */
            $model->password = md5($model->password);
            /**/
            $model->telefono = $model_paciente->Telefono; 
            $model->telefono = trim($model->telefono);
            $model->username = $model_paciente->Ci; 
            if ($model->save()) { 
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
 
        $this->render('createPaciente', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador) { //1. Seguridad 1-3
        $model = $this->loadModel($id);
            
            $this->performAjaxValidation($model, 'usuario-form');
            
                $clave = $model->password;
                $foto=$model->foto;
                
            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
                
                $numero_aleatorio = rand(0, 999);
            $model->descripcion='Presence System clave: '.$numero_aleatorio.'000.'.$model->password.$numero_aleatorio;
                /* Agregado para que la clave se guarde en MD5 */
                if (isset($_POST['Usuario']['password'])  and ($_POST['Usuario']['password']) != '' ) {
                    $model->password = md5($model->password); //Encriptar en MD5
                    
                }
                else
                {
                    $model->password = $clave;
                    
                }
                 if (isset($_POST['Usuario']['validador_pass'])  and ($_POST['Usuario']['validador_pass']) != '' ) {
                     $model->validador_pass = md5($model->validador_pass);
                }
                else
                {
                     $model->validador_pass = $clave;
                }
                /**/
                 /* Codigo para subir fotos */
                    $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999                    
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;                           
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                } 
                else
                {
                    $model->foto=$foto;
                    if ($model->save()) {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
//                
//                if ($model->save()) {
//                    $this->
//                            redirect(array('view', 'id' => $model->id));
//                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
            	//2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador,  para realizar esta acción');
       // }
        //3. Fin de seguridad
    }
    public function actionCambiar_clave() {
     //   // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico) { //1. Seguridad 1-3
        $id = Yii::app()->getSession()->get('id_usuario');
        $model = $this->loadModel($id);
            
            $this->performAjaxValidation($model, 'usuario-form');                
                 $clave = $model->password;
                $foto=$model->foto;
            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
                 $numero_aleatorio = rand(0, 999);
            $model->descripcion='Presence System clave: '.$numero_aleatorio.'000.'.$model->password.$numero_aleatorio;
                /* Agregado para que la clave se guarde en MD5 */
                if (isset($_POST['Usuario']['password'])  and ($_POST['Usuario']['password']) != '' ) {
                    $model->password = md5($model->password); //Encriptar en MD5
                    
                }
                else
                {
                    $model->password = $clave;
                    
                }
                 if (isset($_POST['Usuario']['validador_pass'])  and ($_POST['Usuario']['validador_pass']) != '' ) {
                     $model->validador_pass = md5($model->validador_pass);
                }
                else
                {
                     $model->validador_pass = $clave;
                }
                /**/
                /* Agregado para que la clave se guarde en MD5 */
                
                /**/
                if ($model->save()) {
                    $this->redirect(array('mensaje_cambio_clave'));
                }
            }

            $this->render('cambiar_clave', array(
                'model' => $model,
            ));
            	//2. seguridad
//        // } else {
//        // throw new CHttpException(400, 'No tiene permiso de administrador,  para realizar esta acción');
//        }
        //3. Fin de seguridad
    }
     public function actionUpdatePaciente($id) {
        // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3
        $model = $this->loadModel($id);
            $ImagenAntigua=$model->foto;
            $this->performAjaxValidation($model, 'usuario-form');
                $clave = $model->password;
            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
                /* Agregado para que la clave se guarde en MD5 */
                if (isset($_POST['Usuario']['password'])  and ($_POST['Usuario']['password']) != '' ) {
                    $model->password = md5($model->password); //Encriptar en MD5
                }
                else
                {
                    $model->password = $clave;
                }
                /**/
                
                    /* Codigo para subir fotos */
                    $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999

                    /**/ 
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;     
                    if ($fileName =='' or $fileName == null)
                    {
                        $fileName=$ImagenAntigua;
                    }
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('view_Paciente', 'id' => $model->id));
                    }
                } 
                else
                {
                        $model->foto=$ImagenAntigua;                    
                    if ($model->save()) {
                        $this->redirect(array('view_Paciente', 'id' => $model->id));
                    }
                }
                /* Fin del código para subir fotos */
                    


                // Por defecto para guardar el modelo pasado como parametro
//                if ($model->save()) {
//                    $this->
//                            redirect(array('view_Medico', 'id' => $model->id));
//                }
            }

            $this->render('updatePaciente', array(
                'model' => $model,
            ));
            	//2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso, para realizar esta acción');
       // }
        //3. Fin de seguridad
    }
    
    public function actionUpdateMedico($id) {
        // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3
        $model = $this->loadModel($id);
            $ImagenAntigua=$model->foto;
            $this->performAjaxValidation($model, 'usuario-form');
                $clave = $model->password;
            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
                /* Agregado para que la clave se guarde en MD5 */
                if (isset($_POST['Usuario']['password'])  and ($_POST['Usuario']['password']) != '' ) {
                    $model->password = md5($model->password); //Encriptar en MD5
                }
                else
                {
                    $model->password = $clave;
                }
                /**/
                
                    /* Codigo para subir fotos */
                    $rnd = rand(0, 9999);  // Generamos un numero aleatorio entre 0-9999

                    /**/ 
                $uploadedFile = CUploadedFile::getInstance($model, 'foto');
                if (!empty($uploadedFile)) {  // checkeamos si el archivo subido esta seteado o no
                    $fileName = "{$rnd}-{$uploadedFile}";  // numero aleatorio  + nombre de archivo
                    $model->foto = $fileName;     
                    if ($fileName =='' or $fileName == null)
                    {
                        $fileName=$ImagenAntigua;
                    }
                    if ($model->save()) {
                        $uploadedFile->saveAs(Yii::app()->basePath . './../images/fotos/' . $fileName);  // la imagen se subirá a la carpeta 
//                        $this->redirect(array('admin'));
                        $this->redirect(array('view_Medico', 'id' => $model->id));
                    }
                } 
                else
                {
                        $model->foto=$ImagenAntigua;                    
                    if ($model->save()) {
                        $this->redirect(array('view_Medico', 'id' => $model->id));
                    }
                }
                /* Fin del código para subir fotos */
                    


                // Por defecto para guardar el modelo pasado como parametro
//                if ($model->save()) {
//                    $this->
//                            redirect(array('view_Medico', 'id' => $model->id));
//                }
            }

            $this->render('updateMedico', array(
                'model' => $model,
            ));
            	//2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador o medico,  para realizar esta acción');
       // }
        //3. Fin de seguridad
    }
    

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
      // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3  
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        	//2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador o medico,  para realizar esta acción');
        //}
        //3. Fin de seguridad
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Usuario');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Usuario('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    public function actionAdminReporteCertificado() {
        // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3
        $model = new Usuario('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('adminReporteCertificado', array(
            'model' => $model,
        ));
        	//2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador o medico,  para realizar esta acción');
        //}
        //3. Fin de seguridad
    }
      public function actionAdminMedico() {
        $model = new Usuario('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('adminMedico', array(
            'model' => $model,
        ));
        
    }
      public function actionAdminReporteHistorial() {
        $model = new Usuario('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('adminReporteHistorial', array(
            'model' => $model, 
        ));
        
    }

    public function actionListarUsuarios($term) {
        $criteria = new CDbCriteria;
        $criteria->condition = "LOWER(nombres) like LOWER(:term) or LOWER(codigo_barra) like LOWER(:term)
                                    or (descripcion) like LOWER(:term) or (id) like LOWER(:term)";
        $criteria->params = array(':term' => '%' . $_GET['term'] . '%');
        $criteria->limit = 30;
        $models = Usuario::model()->findAll($criteria);
        $arr = array();
        foreach ($models as $model) {  
            $arr[] = array(
                'label' => ( $model->nombres . ' ( ' . $model->descripcion . '),  ' . ''), // label for dropdown list
                'value' => $model->nombres, // value for input field
                'id' => $model->id, // return value from autocomplete
            ); 
        }
        echo CJSON::encode($arr);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Usuario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
 public function actionPdfCertificado($id) {
     // if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministradorMedico()) { //1. Seguridad 1-3
        $model = $this->loadModel($id);
        $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 35, 25, 9, 9, 'P');
        $mpdf->useOnlyCoreFonts = true;
        $mpdf->SetTitle("UASGAD QUERO");
        $mpdf->SetAuthor("Presence System");
        $mpdf->SetWatermarkText(" ''STANFORD'' ");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('pdfCertificado', array(
                    'model' => $this->loadModel($id),
                   // 'model2' => $this->loadModelTerrenos($id),
//            'model3'=>$this->loadModelCursoChilds($id),
//            'model6'=>$this->loadModelFamiliarChilds($id),
//            'model8'=>$this->loadModelCasoChilds($id),
                        ), true));
        $mpdf->Output('documento' . date('YmdHis'), 'I');

        //$mpdf->Output('Ficha-'.$model->run.'-('.date(Y.'-'.m.'-'.d).').pdf','I');
        exit;
           //2. seguridad
        // } else {
        // throw new CHttpException(400, 'No tiene permiso de administrador o medico,  para realizar esta acción');
        //}
        //3. Fin de seguridad
    }
    public function actionPdfHistorialPrestamo($id) {
        $model = $this->loadModel($id);
        $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 35, 25, 9, 9, 'P');
        $mpdf->useOnlyCoreFonts = true;
        $mpdf->SetTitle("UASGAD QUERO");
        $mpdf->SetAuthor("Presence System");
        $mpdf->SetWatermarkText("``Stanford``");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('pdfHistorialPrestamo', array(
                    'model' => $this->loadModel($id),
                   // 'model2' => $this->loadModelTerrenos($id),
//            'model3'=>$this->loadModelCursoChilds($id),
//            'model6'=>$this->loadModelFamiliarChilds($id),
//            'model8'=>$this->loadModelCasoChilds($id),
                        ), true));
        $mpdf->Output('Histotial_usuario' . date('YmdHis'), 'I');

        //$mpdf->Output('Ficha-'.$model->run.'-('.date(Y.'-'.m.'-'.d).').pdf','I');
        exit;
    }
    
}
