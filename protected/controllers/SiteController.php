<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('tarifa', 'simulador_calculos', 'simulador_tanques', 
                    'about', 'reloj', 'actions', 'contact', 'autenticar', 'login', 
                    'index', 'error', 'presenceSystem', 'mision_vision','buscar_deuda',
                    'deuda_socio','buscar_historial_facturas','historial_facturas', 'servicios'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('indexSecretaria', 'actions', 'indexAutenticado', 'indexMedico', 'desarrollando', 'logoutCambiarClave', 'logout'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('', '', '', '', ''),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

//    public function actions()
//{
//    return array(
//        'eyui'=>array(
//            'class'=>'EYuiAction',
//        ),
//    );
//}
    
     public function actionBuscar_historial_facturas() {
         $this->layout = 'vacio';
        $model = new Socio;
        $this->performAjaxValidation($model, 'socio-form');
        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];           
             $socio = $_POST['Socio']['CI'];
            $socio_seleccionado = Socio::model()->findBySql("Select * from socio where CI = '" . $socio . "'");
//            var_dump($socio);
//            Yii::app()->end();
            if ($socio_seleccionado->CODIGO > 0) {
                 Yii::app()->getSession()->add('cedula_socio_historial_facturas', $socio_seleccionado->CODIGO);
                $this->redirect(array('historial_facturas'));
            }
        }
        $this->render('buscar_historial_facturas', array(
            'model' => $model,
        ));
    }
     public function actionHistorial_facturas() {
          $id = Yii::app()->getSession()->get('cedula_socio_historial_facturas');
         $this->layout = 'vacio';
        $model = Socio::model()->findByPk($id); //$this->loadModel($id);
        // Socio Medidor activo
        $socio_medidor = SocioMedidor::model()->findAllBySql('select * '
                . 'from socio_medidor '
                . 'where '
                // . 'INACTIVO = 0 and '
                . 'CODIGO_SOCIO = ' . $id . ' order by ID desc');
        $this->render('historial_facturas', array(
            'model' => $model,
            'socio_medidor' => $socio_medidor,
        ));
    }
    
     public function actionBuscar_deuda() {
        $this->layout = 'vacio';
        $model = new Socio;
        $this->performAjaxValidation($model, 'socio-form');
        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];
            $socio = $_POST['Socio']['CI'];
//            var_dump($socio);
//            Yii::app()->end();
            if ($socio > 0) {
                Yii::app()->getSession()->add('cedula_socio_deuda', $socio);
                $this->redirect(array('deuda_socio'));
            }
        }
        $this->render('buscar_deuda', array(
            'model' => $model,
        ));
    }
     protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'socio-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
     public function actionDeuda_socio() {
        $this->layout = 'vacio';
        $ci = Yii::app()->getSession()->get('cedula_socio_deuda');

        //$usu = Yii::app()->getSession()->get('id_usuario');
        //  $usuario = Usuario::model()->findByPk($usu);
        // $id = $usuario->id_referencia;
        $model = Socio::model()->findBySql("Select * from socio where CI = '" . $ci . "'");
        $nuevo_medidor = new Medidor();
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        if (isset($model->CODIGO) && $model->CODIGO > 0) {
            $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.*
            FROM socio_medidor as sm
            WHERE sm.`CODIGO_SOCIO` = ' . $model->CODIGO  // ' and sm.SOLO_ALCANTARILLADO = 0'
                    . ' AND sm.INACTIVO = 0 order by sm.ID_MEDIDOR desc');

            $modelo_socio_medidor = new SocioMedidor();
            foreach ($modelos_socio_medidor as $mod) {
                $modelo_socio_medidor = $mod;
            }
            //************************
        }
        $this->render('deuda_socio', array(
            'model' => $model,
            'modelo_socio_medidor' => $modelo_socio_medidor,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor
        ));
    }
    
    
    public function actionTarifa() {
        $model = Parametro::model()->findAll();
        $this->render('tarifa', array(
            'model' => $model,
        ));
    }

    public function actionSimulador_calculos() {
        $this->layout = 'vacio';
        $model_parametro = new Parametro();
      //  if (Yii::app()->getSession()->get('desde') > 0){
        $model_parametro->VALOR_MIN = Yii::app()->getSession()->get('desde');         
//        }
//        if (Yii::app()->getSession()->get('hasta') > 0){
        $model_parametro->VALOR_MAX = Yii::app()->getSession()->get('hasta');         
//        }
//        if (Yii::app()->getSession()->get('total') > 0){
        $model_parametro->VALOR = Yii::app()->getSession()->get('total');         
//        }        
            if (isset($_POST['Parametro'])) {
            $model_parametro->attributes = $_POST['Parametro'];
//            $model_parametro->VALOR_MIN = $_POST['desde'];
//            $model_parametro->VALOR_MAX = $_POST['hasta'];
          //  $model_parametro->VALOR = $model_parametro->VALOR_MAX - $model_parametro->VALOR_MIN;
            Yii::app()->getSession()->add('desde', $model_parametro->VALOR_MIN);
            Yii::app()->getSession()->add('hasta', $model_parametro->VALOR_MAX);
            Yii::app()->getSession()->add('total', $model_parametro->VALOR);
            //$this->redirect(array('simulador_calculos'));
        }

        $this->render('simulador_calculos', array(
            'model_parametro' => $model_parametro
        ));
    }

    public function actionSimulador_tanques() {
        $this->layout = 'vacio';
        $this->render('simulador_tanques');
    }

    public function actionPresenceSystem() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('presenceSystem');
    }

    public function actionReloj() {
        $this->layout = 'vacio';
        $this->render('reloj');
    }

    public function actionIndexAutenticado() {
        //***** AUMENTADO PARA LA BUSQUEDA DE SOCIOS
        $model = new Socio('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Socio']))
            $model->attributes = $_GET['Socio'];

        $this->render('indexAutenticado', array(
            'model' => $model,
                //            'model_inspeccion' => $model_inspeccion
        ));
    }

    public function actionIndexMedico() {
        $id = Yii::app()->getSession()->get('id_referencia');
        //aumentar para no tener problemas al renderizar el modelo
        if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()) {
            $this->redirect(array('indexAutenticado'));
        }
        if (!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esSecretaria()) {
            $this->redirect(array('indexSecretaria'));
        }
        //fin aumentar para no tener problemas al renderizar el modelo
        if ($id > 0) {
            $model = TMedico::model()->findByPk($id);
            $this->render('indexMedico', array(
                //	'model_transporte' => $model_transporte,
                //            'model_inspeccion' => $model_inspeccion
                'model' => $model,
            ));
        } else {
            $this->render('indexMedico', array(
                'model' => $model,
            ));
        }
    }

    public function actionIndexSecretaria() {
        //Toca crear un modelo para ingresar empleado de tipo secretaria
//        $id=Yii::app()->getSession()->get('id_referencia');
//        if($id>0)
//        {
//            $model = TEmpleado::model()->findByPk($id);
//            $this->render('indexSecretaria', array(
//                    //	'model_transporte' => $model_transporte,
//                    //            'model_inspeccion' => $model_inspeccion
//                 //'model' => $model,
//            ));
//        }
//        else
//        {
        $this->render('indexSecretaria', array(
                // 'model' => $model,
        ));
//        } 
    }

    public function actionAutenticar() {
        $this->layout = 'columnJT';
        //  $this->beginContent('//layouts/main');
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('autenticar', array('model' => $model));
        // $this->endContent();
    }

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }
     public function actionServicios() {       
        $this->render('servicios');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
        //    $this->redirect("http://www.uasgadquero.com.ec/");
        //Destruir las variables de session q 
        //iniciamos en el Active Record del Usuario, que se encuentra en el modelo del mismo

        Yii::app()->getSession()->remove('tipo_usuario');
        Yii::app()->getSession()->remove('id_usuario');
        Yii::app()->getSession()->remove('nombre_usuario');
        Yii::app()->getSession()->remove('id_referencia');
        Yii::app()->getSession()->remove('foto');
        Yii::app()->getSession()->remove('bandera_audio');
    }

    public function actionLogoutCambiarClave() {
        $usu = Yii::app()->user->id;
        Yii::app()->user->logout();
        //$this->redirect(Yii::app()->homeUrl);
        $this->redirect(array('usuario/cambiar_Clave/' . $usu));
    }

}
