<?php

class SocioController extends AweController {

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
                'actions' => array('deuda_socio', 'buscar_deuda', 'ejemplo1', 'ejemplo1recibe', 'ejemplo2', 'ejemplo2recibe', 'search'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('lista_excel', 'lista_por_grupo_excel', 'lista_por_grupo_word',
                    'lista', 'lista_por_grupo', 'historial_pdf', 'historial', 'buscar_historial_socio',
                    'listarSocios','listarSociosTodos', 'historial_medidores', 'view', 'bus_ing_medidor',
                    'admin', 'delete', 'create', 'lista_por_grupo_pdf', 'ver_medidor',
                    'update', 'bus_ing_acometida_alcantarillado', 'lista_alcantarillado',
                    'lista_alcantarillado_inactivo', 'lista_alcantarillado_por_grupo',
                    'buscar_historial_facturas', 'historial_facturas', 'lista_padron'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('allow',
                'actions' => array('', 'listarSocios'),
                //'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
            ),
            array(
                'allow',
                'actions' => array('buscar_historial_consumo', 'datos', 'deudas'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esSocio()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
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

    public function actionBuscar_historial_consumo() {
        $usu = Yii::app()->getSession()->get('id_usuario');
        $usuario = Usuario::model()->findByPk($usu);
        $id = $usuario->id_referencia;
        $model = $this->loadModel($id);
        // Socio Medidor activo
        $socio_medidor = SocioMedidor::model()->findAllBySql('select * '
                . 'from socio_medidor '
                . 'where '
                //  . ' -- INACTIVO = 0 and '
                . 'CODIGO_SOCIO = ' . $id . ' order by ID desc');
//        // historial de Facturas 6 meses atras
//        $historial_facturas = Factura::model()->findAllBySql(
//                'SELECT f.*
//                FROM factura AS f
//                INNER JOIN socio_medidor AS sm
//                ON f.ID_MEDIDOR_SOCIO = sm.ID
//                WHERE sm.ID = '.$socio_medidor->ID
//                .' AND f.`TIPO` = 1
//                GROUP BY f.`ANIO_COBRO`, f.`MES_COBRO`
//                ORDER BY ID desc
//                LIMIT 12
//                ');
        $this->render('buscar_historial_consumo', array(
            'model' => $model,
            'socio_medidor' => $socio_medidor,
                //   'historial_facturas' => $historial_facturas
        ));
    }

    public function actionDatos() {
        $usu = Yii::app()->getSession()->get('id_usuario');
        $usuario = Usuario::model()->findByPk($usu);
        $id = $usuario->id_referencia;
        $model = $this->loadModel($id);
        $nuevo_medidor = new Medidor();
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.*
            FROM socio_medidor as sm
            WHERE sm.`CODIGO_SOCIO` = ' . $id . ' and sm.SOLO_ALCANTARILLADO = 0 AND sm.INACTIVO = 0 order by sm.ID_MEDIDOR desc');
        $modelo_acometida_alcantarillado = AcometidaAlcantarillado::model()->findAllBySql('SELECT a.*
            FROM socio_medidor as sm
            inner join acometida_alcantarillado as a
            on a.ID_SOCIO_MEDIDOR = sm.ID
            WHERE sm.`CODIGO_SOCIO` = ' . $id . '  order by a.ID_GRUPO desc');
        $modelo_socio_medidor = new SocioMedidor();
        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        //************************
        //INGRESAR NUEVO MEDIDOR DEL SOCIO
        if (isset($_POST['Medidor'])) {
            $nuevo_medidor->attributes = $_POST['Medidor'];
            if ($nuevo_medidor->save()) {
                ///**** ASIGNAMOS EL MEDIDOR AL SOCIO
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $id;
                $nuevo_socio_medidor->ID_MEDIDOR = $nuevo_medidor->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                //*******
                if ($nuevo_socio_medidor->save()) {
                    $query = 'call valor_inicial_vigente(' . $nuevo_socio_medidor->ID . ')';
                    $command = Yii::app()->db->createCommand($query);
                    $rowCount = $command->execute();
                    $nuevo_socio_medidor = new SocioMedidor();
                    $nuevo_medidor = new Medidor();
                    $this->redirect(array('view', 'id' => $id)); // Regresamos a este mismo lugar
                }
            }
        }
        //************************
        $this->render('datos', array(
            'model' => $model,
            'modelo_socio_medidor' => $modelo_socio_medidor,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor,
            'modelo_acometida_alcantarillado' => $modelo_acometida_alcantarillado
        ));
    }

    public function actionDeudas() {
        $usu = Yii::app()->getSession()->get('id_usuario');
        $usuario = Usuario::model()->findByPk($usu);
        $id = $usuario->id_referencia;
        $model = $this->loadModel($id);
        $nuevo_medidor = new Medidor();
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.*
            FROM socio_medidor as sm
            WHERE sm.`CODIGO_SOCIO` = ' . $id  // ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' AND sm.INACTIVO = 0 order by sm.ID_MEDIDOR desc');

        $modelo_socio_medidor = new SocioMedidor();
        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        //************************

        $this->render('deudas', array(
            'model' => $model,
            'modelo_socio_medidor' => $modelo_socio_medidor,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor
        ));
    }

    public function actionLista_alcantarillado_por_grupo($id) {
        $model_grupo = Grupo::model()->findByPk($id);
        $model_socios = Socio::model()->findAllBySql('CALL `lista_alcantarillado_por_grupo`(' . $id . ')');
        $this->render('lista_alcantarillado_por_grupo', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo,
        ));
    }

    public function actionLista_alcantarillado() {
        $model_socios = Socio::model()->findAllBySql('CALL `lista_alcantarillado`()');
        $this->render('lista_alcantarillado', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_alcantarillado_inactivo() {
        $model_socios = Socio::model()->findAllBySql('CALL `lista_alcantarillado_inactivo`()');
        $this->render('lista_alcantarillado_inactivo', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista() {
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO > 0  order by APELLIDO'); //Estado=0 Es un socio eliminado del sistema
        $this->render('lista', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_padron() {
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO > 0  order by APELLIDO'); //Estado=0 Es un socio eliminado del sistema
        $this->render('lista_padron', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_excel() {
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO > 0  order by APELLIDO'); //Estado=0 Es un socio eliminado del sistema
        $contenido = $this->renderPartial("lista_excel", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Listado al " . gmdate('d M Y') . ".xls", $contenido);
        $this->render('lista_excel', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_por_grupo() {
        $model_grupo = Grupo::model()->findAllBySql('SELECT * FROM grupo where DESCRIPCION != "N/A" ORDER BY GRUPO ASC ');
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO = 1  order by APELLIDO'); //Estado=3 Es un socio eliminado del sistema
        $this->render('lista_por_grupo', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo,
        ));
    }

    public function actionLista_por_grupo_excel() {
        $model_grupo = Grupo::model()->findAllBySql('SELECT * FROM grupo where DESCRIPCION != "N/A" ORDER BY GRUPO ASC');
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO = 1  order by APELLIDO'); //Estado=3 Es un socio eliminado del sistema
        $contenido = $this->renderPartial("lista_por_grupo_excel", array('model_socios' => $model_socios, 'model_grupo' => $model_grupo), true);
        Yii::app()->request->sendFile("Listado por grupos al " . gmdate('d M Y') . ".xls", $contenido);
        $this->render('lista_por_grupo_excel', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo
        ));
    }

    public function actionLista_por_grupo_word() {
        $model_grupo = Grupo::model()->findAllBySql('SELECT * FROM grupo where DESCRIPCION != "N/A" ORDER BY GRUPO ASC');
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO = 1  order by APELLIDO'); //Estado=3 Es un socio eliminado del sistema
        $contenido = $this->renderPartial("lista_por_grupo_word", array('model_socios' => $model_socios, 'model_grupo' => $model_grupo), true);
        Yii::app()->request->sendFile("Listado por grupos al " . gmdate('d M Y') . ".doc", $contenido);
        $this->render('lista_por_grupo_word', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo
        ));
    }

    public function actionLista_por_grupo_pdf() {
        $model_grupo = Grupo::model()->findAllBySql('SELECT * FROM grupo where DESCRIPCION != "N/A" ORDER BY GRUPO ASC');
        $model_socios = Socio::model()->findAllBySql('select * from socio where ESTADO = 1  order by APELLIDO'); //Estado=3 Es un socio eliminado del sistema

        $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 10, 10, 32, 23, 8, 8, 'P');
        $mpdf->useOnlyCoreFonts = true;
        $mpdf->SetTitle("LISTA");
        $mpdf->SetAuthor("SISAP");
        $mpdf->SetWatermarkText("``SISAP " . gmdate(Y) . "``");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('lista_por_grupo_pdf', array(
                    'model_socios' => $model_socios,
                    'model_grupo' => $model_grupo,
                        ), true));
        $mpdf->Output('Listado por grupo al  ' . gmdate('d M Y') . ' .pdf', 'I');
        exit;
    }

    public function actionHistorial($id) {
        $model = $this->loadModel($id);
        // Socio Medidor activo
        $socio_medidor = SocioMedidor::model()->findAllBySql('select * '
                . 'from socio_medidor '
                . 'where '
                //  . ' -- INACTIVO = 0 and '
                . 'CODIGO_SOCIO = ' . $id . ' order by ID desc');
//        // historial de Facturas 6 meses atras
//        $historial_facturas = Factura::model()->findAllBySql(
//                'SELECT f.*
//                FROM factura AS f
//                INNER JOIN socio_medidor AS sm
//                ON f.ID_MEDIDOR_SOCIO = sm.ID
//                WHERE sm.ID = '.$socio_medidor->ID
//                .' AND f.`TIPO` = 1
//                GROUP BY f.`ANIO_COBRO`, f.`MES_COBRO`
//                ORDER BY ID desc
//                LIMIT 12
//                ');
        $this->render('historial', array(
            'model' => $model,
            'socio_medidor' => $socio_medidor,
                //   'historial_facturas' => $historial_facturas
        ));
    }

    public function actionHistorial_facturas($id) {
         $this->layout = 'vacio';
        $model = $this->loadModel($id);
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

    public function actionHistorial_pdf($id) {
        $model = $this->loadModel($id);
        // Socio Medidor activo
        $socio_medidor = SocioMedidor::model()->findBySql('select * '
                . 'from socio_medidor '
                . 'where INACTIVO = 0 and CODIGO_SOCIO = ' . $id . ' order by ID desc limit 1');
        // historial de Facturas 6 meses atras
        $historial_facturas = Factura::model()->findAllBySql(
                'SELECT f.*
            FROM factura AS f
            INNER JOIN socio_medidor AS sm
            ON f.ID_MEDIDOR_SOCIO = sm.ID
            WHERE sm.ID = ' . $socio_medidor->ID
                . ' AND f.`TIPO` = 1
            GROUP BY f.`ANIO_COBRO`, f.`MES_COBRO`
            ORDER BY f.`MES_COBRO` DESC
            LIMIT 6
            ');
        $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 35, 25, 9, 9, 'P');
        $mpdf->useOnlyCoreFonts = true;
        $mpdf->SetTitle("LISTA");
        $mpdf->SetAuthor("SISAP");
        $mpdf->SetWatermarkText("``SISAP " . gmdate(Y) . "``");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('historial_pdf', array(
                    'model' => $model,
                    'socio_medidor' => $socio_medidor,
                    'historial_facturas' => $historial_facturas
                        ), true));
        $mpdf->Output('Historial al ' . gmdate('d-M-Y') . ' ' . $model->APELLIDO . ' .pdf', 'I');
        exit;
    }

    public function actionBuscar_historial_socio() {
        $model = new Socio;
        $this->performAjaxValidation($model, 'socio-form');
        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];
            $socio = $_POST['Socio']['CODIGO'];
//            var_dump($socio);
//            Yii::app()->end();
            if ($socio > 0) {
                $this->redirect(array('historial', 'id' => $socio));
            }
        }
        $this->render('buscar_historial_socio', array(
            'model' => $model,
        ));
    }

    public function actionBuscar_historial_facturas() {
        $model = new Socio;
        $this->performAjaxValidation($model, 'socio-form');
        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];
            $socio = $_POST['Socio']['CODIGO'];
//            var_dump($socio);
//            Yii::app()->end();
            if ($socio > 0) {
                $this->redirect(array('historial_facturas', 'id' => $socio));
            }
        }
        $this->render('buscar_historial_facturas', array(
            'model' => $model,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionListarSocios($term) {
        $criteria = new CDbCriteria;
        $criteria->condition = "(LOWER(CI) like LOWER(:term) or LOWER(APELLIDO) like LOWER(:term)
 or (COD_BARRA) like LOWER(:term)
or (COD_BARRA_RIEGO_OLD) like LOWER(:term)
or (COD_BARRA_POTABLE) like LOWER(:term)
 ) AND ESTADO = 1 ";
        $criteria->params = array(':term' => '%' . $_GET['term'] . '%');
        $criteria->limit = 30;
        $models = Socio::model()->findAll($criteria);
        $arr = array();
        foreach ($models as $model) {
            $arr[] = array(
                'label' => ('CI: ' . $model->CI . ', ( ' . $model->APELLIDO . ')  ' . ' G.' . $model->COD_GRUPO), // label for dropdown list
                'value' => $model->APELLIDO, // value for input field
//     'value'=>$model->ci_cli, // value for input field
                //    'attribute'=> $model->APELLIDO,
                'id' => $model->CODIGO, // return value from autocomplete
            );
        }
        echo CJSON::encode($arr);
    }
    public function actionListarSociosTodos($term) {
        $criteria = new CDbCriteria;
        $criteria->condition = "(LOWER(CI) like LOWER(:term) or LOWER(APELLIDO) like LOWER(:term)
 or (COD_BARRA) like LOWER(:term)
or (COD_BARRA_RIEGO_OLD) like LOWER(:term)
or (COD_BARRA_POTABLE) like LOWER(:term)
 )  
 ";
        $criteria->params = array(':term' => '%' . $_GET['term'] . '%');
        $criteria->limit = 30;
        $models = Socio::model()->findAll($criteria);
        $arr = array();
        foreach ($models as $model) {
            $arr[] = array(
                'label' => ('CI: ' . $model->CI . ', ( ' . $model->APELLIDO . ')  ' . ' G.' . $model->COD_GRUPO), // label for dropdown list
                'value' => $model->APELLIDO, // value for input field
//     'value'=>$model->ci_cli, // value for input field
                //    'attribute'=> $model->APELLIDO,
                'id' => $model->CODIGO, // return value from autocomplete
            );
        }
        echo CJSON::encode($arr);
    }

    public function actionHistorial_medidores($id) {
        $model = $this->loadModel($id);
        $nuevo_medidor = new Medidor();
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT *
            FROM socio_medidor
            WHERE `CODIGO_SOCIO` = ' . $id . ' order by ID_MEDIDOR desc');
        $modelo_socio_medidor = new SocioMedidor();
        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        //************************
        //INGRESAR NUEVO MEDIDOR DEL SOCIO
        if (isset($_POST['Medidor'])) {
            $nuevo_medidor->attributes = $_POST['Medidor'];
            if ($nuevo_medidor->save()) {
                ///**** ASIGNAMOS EL MEDIDOR AL SOCIO
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $id;
                $nuevo_socio_medidor->ID_MEDIDOR = $nuevo_medidor->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                //*******
                if ($nuevo_socio_medidor->save()) {
                    $nuevo_socio_medidor = new SocioMedidor();
                    $nuevo_medidor = new Medidor();
                    $this->redirect(array('view', 'id' => $id)); // Regresamos a este mismo lugar
                }
            }
        }
        //************************
        $this->render('historial_medidores', array(
            'model' => $model,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'modelo_socio_medidor' => $modelo_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor,
        ));
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $nuevo_medidor = new Medidor();
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT sm.*
            FROM socio_medidor as sm
            WHERE sm.`CODIGO_SOCIO` = ' . $id . ' and sm.SOLO_ALCANTARILLADO = 0  order by sm.ID_MEDIDOR desc');
        $modelo_acometida_alcantarillado = AcometidaAlcantarillado::model()->findAllBySql('SELECT a.*
            FROM socio_medidor as sm
            inner join acometida_alcantarillado as a
            on a.ID_SOCIO_MEDIDOR = sm.ID
            WHERE sm.`CODIGO_SOCIO` = ' . $id . '  order by a.ID_GRUPO desc');
        $modelo_socio_medidor = new SocioMedidor();
        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        //************************
        //INGRESAR NUEVO MEDIDOR DEL SOCIO
        if (isset($_POST['Medidor'])) {
            $nuevo_medidor->attributes = $_POST['Medidor'];
            if ($nuevo_medidor->save()) {
                ///**** ASIGNAMOS EL MEDIDOR AL SOCIO
                $nuevo_socio_medidor = new SocioMedidor();
                $nuevo_socio_medidor->CODIGO_SOCIO = $id;
                $nuevo_socio_medidor->ID_MEDIDOR = $nuevo_medidor->ID;
                $nuevo_socio_medidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                //*******
                if ($nuevo_socio_medidor->save()) {
                    $query = 'call valor_inicial_vigente(' . $nuevo_socio_medidor->ID . ')';
                    $command = Yii::app()->db->createCommand($query);
                    $rowCount = $command->execute();
                    $nuevo_socio_medidor = new SocioMedidor();
                    $nuevo_medidor = new Medidor();
                    $this->redirect(array('view', 'id' => $id)); // Regresamos a este mismo lugar
                }
            }
        }
        //************************
        $this->render('view', array(
            'model' => $model,
            'modelo_socio_medidor' => $modelo_socio_medidor,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor,
            'modelo_acometida_alcantarillado' => $modelo_acometida_alcantarillado
        ));
    }

    public function actionVer_medidor($id) {


        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('SELECT *
            FROM socio_medidor
            WHERE `CODIGO_SOCIO` = ' . $id . ' order by ID_MEDIDOR desc');


        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        $nuevo_medidor = Medidor::model()->findByPk($modelo_socio_medidor->ID_MEDIDOR);
        //************************
        $model = $this->loadModel($modelo_socio_medidor->CODIGO_SOCIO);
        $this->render('ver_medidor', array(
            'model' => $model,
            //  'modelo_socio_medidor' => $modelo_socio_medidor,
            'modelos_socio_medidor' => $modelos_socio_medidor,
            'nuevo_medidor' => $nuevo_medidor,
        ));
    }

    public function actionEjemplo1() {
        $this->render('ejemplo1');
    }

    public function actionEjemplo1recibe() {
        echo gmdate('d/m/Y H:i:s');
    }

    public function actionEjemplo2() {
        $this->render('ejemplo2');
    }

    public function actionEjemplo2recibe_() {
        sleep(4);
        echo gmdate('d/m/Y H:i:s');
    }

    public function actionSearch() {
        $socio = array();
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {

            //$parametro = $_POST['cedula'];
            $modelos_socio = Socio::model()->findAllBySql('select * from socio where CI="' . $_POST['cedula'] . '" and ESTADO = 1 ');
            if (isset($modelos_socio)) {
                $arr = array();
                foreach ($modelos_socio as $mod) {
                    $arr[] = array(
                        'CODIGO' => $mod->CODIGO,
                        'CI' => $mod->CI,
                        'APELLIDO' => $mod->APELLIDO,
                        'GENERO' => $mod->GENERO,
                        'DIRECCION' => $mod->DIRECCION,
                        'TELEFONO' => $mod->TELEFONO,
                        'CELULAR' => $mod->CELULAR,
                        'EMAIL' => $mod->EMAIL,
                    );
                    $socio = $arr[0];
                }
            } else {
                $socio = 0;
            }
            echo CJSON::encode($socio);
        } else {
            echo 'no llega la cedula al controlador';
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Socio;
        $model->FECHA_INGRESO = gmdate('Y-m-d');
        $this->performAjaxValidation($model, 'socio-form');

        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            $model->FECHA_INGRESO = gmdate('Y-m-d');
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

        $this->performAjaxValidation($model, 'socio-form');

        if (isset($_POST['Socio'])) {
            $model->attributes = $_POST['Socio'];
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            $model->FECHA_ACTUALIZACION = gmdate('Y-m-d H:i:s');
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
        $dataProvider = new CActiveDataProvider('Socio');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Socio('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Socio']))
            $model->attributes = $_GET['Socio'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionBus_ing_medidor() {
        $model = new Socio('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Socio']))
            $model->attributes = $_GET['Socio'];

        $this->render('bus_ing_medidor', array(
            'model' => $model,
        ));
    }

    public function actionBus_ing_acometida_alcantarillado() {
        $model = new Socio('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Socio']))
            $model->attributes = $_GET['Socio'];

        $this->render('bus_ing_acometida_alcantarillado', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Socio::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'socio-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
