<?php

class AsistenciaController extends AweController {

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
                'actions' => array('search', 'visualizar_pantalla_completa', 'visualizar_pantalla_completa_salida'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('view', 'index'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('imprimir','anular', 'salir_sin_lector', 'registrar_sin_lector', 'salir', 'registra_y_actualiza_codigo_barra', 'registrar', '', 'update', 'admin', 'delete'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionSearch() {
        $socio = array();
        header('Content-type: application/json');
       
        if (!isset($_POST['ajax'])) {

            //$parametro = $_POST['cedula'];
            $modelos_socio = Socio::model()->findAllBySql('select * from socio where 
			CI="' . $_POST['cedula'] . '"
			 or COD_BARRA = "' . $_POST['cedula'] . '"
			  or COD_BARRA_RIEGO_OLD = "' . $_POST['cedula'] . '"
			   or COD_BARRA_POTABLE = "' . $_POST['cedula'] . '"
			');
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
                //guardando asistencia
                //************************************************************
                //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
                $id = (Yii::app()->getSession()->get('registrando_reunion'));
                $model_reunion = Reunion::model()->findByPk($id);
                $model = new Asistencia;
                $model->CODIGO_SOCIO = $socio['CODIGO'];

                $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
                $bandera = 0;
                foreach ($model_asistentes as $modelo_asistencia) {
                    ////Ya tiene asistencia a la reunion
                    $bandera = 1;
                }
                if ($bandera == 0) { // Ahun no tiene asistencia a esta reunión
                    //Fecha y hora actual   
                    $bandera = 1;
                    date_default_timezone_set("America/Lima");
                    $fecha_actual = date("Y-n-j");
                    $hora_actual = date("H:i:s");
                    $fecha_reunion = $model_reunion->FECHA;
                    $codigo_de_reunion = $id;
                    $connection = Yii::app()->db;
                    $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = " . $codigo_de_reunion . "";
                    $command = $connection->createCommand($sql);
                    $rows = $command->execute();
                    $rows = $command->queryAll();

                    foreach ($rows as $row) {
                        $hora_reunion = $row['HORA_INGRESO'];
                    }
                    //$hora_reunion = $model_reunion->HORA_INGRESO+$model_reunion->TIEMPO_ESPERA;                        
                    //PARA COMPARAR FECHAS
                    $datetime1 = date_create($fecha_reunion);
                    $datetime2 = date_create($fecha_actual);
                    $interval = date_diff($datetime1, $datetime2);
                    //echo $interval->format('%R%a días'); //Da +2 dias                           
                    if (($interval->format('%a') == 0) and ( $hora_actual <= $hora_reunion)) {  ///ES HOY Y antes de la hora
                        $model->REGISTRA_INGRESO_PUNTUAL = 1;
                    } else {
                        $model->REGISTRA_ATRASO = 1;
                    };

                    //   $mensajeConfirmandoRegistro=''.$genero.$model_socio->APELLIDO;
                    // //Yii::app()->user->setFlash('success',$mensajeConfirmandoRegistro);
                    // // Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro); //foto del usuario
                    $model->CODIGO_REUNION = $id;
                    $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
                    $model->FECHA = $fecha_actual;
                    $model->HORA_INGRESO = $hora_actual;
                    
                    
                    
                    $model_asis_confirmar = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
                    $bandera_confirma = 0;
                    foreach ($model_asis_confirmar as $asist) {
                        ////Ya tiene asistencia a la reunion
                        $bandera_confirma = 1;
                    }
                    if ($bandera_confirma == 0) {
                        if ($model->save()) {
                             // $mensajeConfirmandoRegistro=$genero.$model_socio->APELLIDO.' se registro su asistencia.';
                            //   Yii::app()->user->setFlash('success',$mensajeConfirmandoRegistro);
                            // Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
                           // redirect(array('registrar', 'id' => $id));
                        }
                    }
                } // fin de Ahun no tiene asistencia
                //************************************************************
                //Fin de guardar asistencia
            } else {
                $socio = 0;
            }
            echo CJSON::encode($socio);
        } else {
            echo 'no llega la cedula al controlador';
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionAnular($id) {
//BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);
        $model = new Asistencia;
        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
//Si es código de barra, buscar en base de datos y obtener código

            $barra = $model->CODIGO_SOCIO;
            if ($barra == '') {
                $barra = "$$%%&&&////|||*****++++]]]]??????";
            }
            if (is_numeric($barra)) {
                $variable = "Esta buscando manualmente";
            } else {     //Con lector de códig de barras       
                $modelo_socio = new Socio();
                $modelo_socio = Socio::model()->findAllBySql(''
                        . "SELECT CODIGO FROM `socio` where CI = '" . $barra
                        . "' OR COD_BARRA = '" . $barra
                        . "' OR (USU_AGUA_RIEGO = 1 AND COD_BARRA_RIEGO_OLD = '" . $barra . "') "
                        . "OR (USU_AGUA_POTABLE = 1 AND COD_BARRA_POTABLE = '" . $barra . "') "
                        . " limit 1 ");
                foreach ($modelo_socio as $soc) {
                    $model->CODIGO_SOCIO = $soc->CODIGO;
                }
            }
//FIN Si es código de barra, buscar en base de datos y obtener código
            if ($model->CODIGO_SOCIO > 0) {
                $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
                if ($model_socio->GENERO == 'F') {
                    $genero = " Sra/Srta. ";
                } else {
                    $genero = " Sr. ";
                };
//VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
                $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
                $bandera = 0;
                foreach ($model_asistentes as $modelo_asistencia) {
////Ya tiene asistencia a la reunion
                    $model = $modelo_asistencia;
                }
                if ($model->CODIGO_ASISTENCIA > 0) {
                    $model->delete();
                    $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' ya esta anulada su asistencia en esta reunión';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    $this->redirect(array('anular', 'id' => $id));
                } else {
                    $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' UD. NO TIENE REGISTRADO ASISTENCIA A ESTA REUNIÓN';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    $this->redirect(array('anular', 'id' => $id));
                }
            }
        }

        $this->render('anular', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

    public function actionVisualizar_pantalla_completa($id) {
        $this->layout = 'vacio';
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);

        $model = new Asistencia;
        $this->render('visualizar_pantalla_completa', array(
            //'model' => $this->loadModel($id),
            'model_reunion' => $model_reunion,
        ));
    }

    public function actionVisualizar_pantalla_completa_salida($id) {
        $this->layout = 'vacio';
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);

        $model = new Asistencia;
        $this->render('visualizar_pantalla_completa_salida', array(
            //'model' => $this->loadModel($id),
            'model_reunion' => $model_reunion,
        ));
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
        $model = new Asistencia;

        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->CODIGO_ASISTENCIA));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRegistrar($id) {
        //BUSCAR LA REUNION
        
        $model_reunion = Reunion::model()->findByPk($id);
        $model = new Asistencia;
        $model->CODIGO_SOCIO = '';
        $this->performAjaxValidation($model, 'asistencia-form');
        
        $modelo_registro_ingresos = Asistencia::model()->findAllBySql(''
                . "SELECT * from asistencia where CODIGO_REUNION = " . $id
                ." and COD_USUARIO = ".(Yii::app()->getSession()->get('id_usuario'))
                . " GROUP BY CODIGO_SOCIO  order by CODIGO_ASISTENCIA DESC limit 5 ");
        $mensajeConfirmandoRegistro = "***** ULTIMOS INGRESOS *****";
        foreach ($modelo_registro_ingresos as $ing) {
            if ($ing->cODIGOSOCIO->GENERO == 'F') {
                $genero = " Sra/Srta. ";
            } else {
                $genero = " Sr. ";
            };
            $mensajeConfirmandoRegistro = $mensajeConfirmandoRegistro . '<br>' . $genero . $ing->cODIGOSOCIO->APELLIDO;
        }
        Yii::app()->getSession()->add('lista_ultimos_registrados', $mensajeConfirmandoRegistro);
        
        
        
        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            /*

              //Si es código de barra, buscar en base de datos y obtener código
              $barra = $model->CODIGO_SOCIO;
              if ($barra == '') {
              $barra = '¡¡¡EN BLANCO!!!';
              }
              // Yii::app()->getSession()->add('ultimo_registrado', '>>'.$barra); //foto del usuario
              if (isset($barra)) {
              //                if(is_numeric($barra))
              //                {
              //                    $variable="Esta buscando manualmente";
              //                }
              //                else
              //                {     //Con lector de códig de barras
              $modelo_socio = new Socio();
              $modelo_socio = Socio::model()->findAllBySql(''
              . "SELECT CODIGO FROM `socio` where "
              . " COD_BARRA = '" . $barra . "'"
              . " or COD_BARRA_RIEGO_OLD = '" . $barra . "'"
              . " or COD_BARRA_POTABLE = '" . $barra . "'"
              . " or CI = '" . $barra . "'"
              . " limit 1 ");
              foreach ($modelo_socio as $soc) {
              $model->CODIGO_SOCIO = $soc->CODIGO;
              }
              }
              //FIN Si es código de barra, buscar en base de datos y obtener código

              $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
              if (isset($model_socio)) {
              if ($model_socio->GENERO == 'F') {
              $genero = " Sra/Srta. ";
              } else {
              $genero = " Sr. ";
              };
              //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
              $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
              $bandera = 0;
              foreach ($model_asistentes as $modelo_asistencia) {
              ////Ya tiene asistencia a la reunion
              $bandera = 1;
              }
              if ($bandera == 0) { // Ahun no tiene asistencia a esta reunión
              //Fecha y hora actual
              date_default_timezone_set("America/Lima");
              $fecha_actual = date("Y-n-j");
              $hora_actual = date("H:i:s");
              $fecha_reunion = $model_reunion->FECHA;
              $codigo_de_reunion = $id;
              $connection = Yii::app()->db;
              $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = " . $codigo_de_reunion . "";
              $command = $connection->createCommand($sql);
              $rows = $command->execute();
              $rows = $command->queryAll();

              foreach ($rows as $row) {
              $hora_reunion = $row['HORA_INGRESO'];
              }
              //$hora_reunion = $model_reunion->HORA_INGRESO+$model_reunion->TIEMPO_ESPERA;
              //PARA COMPARAR FECHAS
              $datetime1 = date_create($fecha_reunion);
              $datetime2 = date_create($fecha_actual);
              $interval = date_diff($datetime1, $datetime2);
              //echo $interval->format('%R%a días'); //Da +2 dias
              if (($interval->format('%a') == 0) and ( $hora_actual <= $hora_reunion)) {  ///ES HOY Y antes de la hora
              $model->REGISTRA_INGRESO_PUNTUAL = 1;
              } else {
              $model->REGISTRA_ATRASO = 1;
              };

              $mensajeConfirmandoRegistro = '' . $genero . $model_socio->APELLIDO;
              //Yii::app()->user->setFlash('success',$mensajeConfirmandoRegistro);
              // Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro); //foto del usuario
              $model->CODIGO_REUNION = $id;
              $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
              $model->FECHA = $fecha_actual;
              $model->HORA_INGRESO = $hora_actual;

              if ($model->save()) {
              $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' se registro su asistencia.';
              Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
              Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
              $this->redirect(array('registrar', 'id' => $id));
              }
              } // fin de Ahun no tiene asistencia
              else {
              $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' ya esta registrado en esta reunión';
              Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
              Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
              $this->redirect(array('registrar', 'id' => $id));
              }
              } //El código de barra pertenece a alguien
              else { //El codigo de barra posiblemente esta en blanco
              $mensajeConfirmandoRegistro = 'El valor ingresado "' . $barra . '" no se encuentra registrado en la base de datos.';
              Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
              Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
              $this->redirect(array('registrar', 'id' => $id));
              }

             */
        }

        $this->render('registrar', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

 public function actionImprimir($id) {
     $model = Asistencia::model()->findByPk($id);
// Proceso de imprimir
  $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
        
     
        
     $username = (Yii::app()->getSession()->get('nombre_usuario'));
        $connection = Yii::app()->db;
    $contador = 1;
        $ano = (date('Y')) * 1;
        $mes = (date('m')) * 1;
        $dia = (date('d')) * 1;
        $diasemana = date('w');
        $diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado");
        $mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano".date(' H:i:s');
    //Buscar impresora para imprimir RECIBO
     $impresora = Impresora::model()->findBySql('SELECT *
                                                            FROM impresora
                                                            WHERE DOC=0 
                                                            limit 1');
        $mm_px = 10; // px
                $menorar_y = 25; //esta aumentando en el eje y
                $menorar_x = 5; //esta menorando en el eje x

                $printer = $impresora->IMPRESORA;
                $enlace = printer_open($printer);
                printer_start_doc($enlace, 'Recibo');
                printer_start_page($enlace);

                //$font = printer_create_font('Tipo', Alto, Ancho, Peso_de_la_fuente -100<_400_>100, cursiva, subrayado, trasada, orientacion);
                // $font = printer_create_font('Arial', 14, 48, 400, false, false, false, 0);
                //  printer_select_font($enlace, $font);
               
                
                $barcode =  printer_create_font("Arial",72,48,400,false,false,false,0);
                printer_select_font($enlace, $barcode);
                //   printer_delete_font($font);
        
        
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$   SE REPITE POR LA COPIA   $$$$$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        
      
         printer_draw_text($enlace,"             ".$model->cODIGOREUNION->cODIGOTIPO->TIPO,0, 50);     
         printer_draw_text($enlace,"     ''JAAPA SAN VICENTE DE LACAS''",0, 150); 
         printer_draw_text($enlace, utf8_decode('FECHA     : '.$fecha_formateada), 0, 300);
        //printer_draw_text($enlace, utf8_decode("Recibo N' : ".$rec->ID_FACTURA), 0, 300);
                printer_draw_text($enlace, utf8_decode('NOMBRES   : '.$model_socio->APELLIDO), 0, 450);
        printer_draw_text($enlace, utf8_decode('CI/RUC    : '.$model_socio->CI), 0, 600);
      //  $recibo->CAMBIO = number_format('VALOR',0,'.','');        
        
      
                $total = 0.00;
                $mm_inicia_detalle = 750; //Inica a imprimir los detalles en el eje y
                  $mm_inicia_detalle = $mm_inicia_detalle + 250;
        
          printer_draw_text($enlace,utf8_decode('              ').utf8_decode('_________________'),    2, $mm_inicia_detalle); //Cant
          printer_draw_text($enlace,utf8_decode('').utf8_decode('FIRMA'),    2, $mm_inicia_detalle+30); //Cant
                   
          
         
        $mm_inicia_detalle = $mm_inicia_detalle + 150;
        printer_draw_text($enlace, utf8_decode('     GRACIAS POR SU ASISTENCIA '), 2, $mm_inicia_detalle);
        $mm_inicia_detalle = $mm_inicia_detalle + 900;
        printer_draw_text($enlace, utf8_decode('     ´ '), 2, $mm_inicia_detalle);
        
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$  FIN SE REPITE POR LA COPIA   $$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        
                printer_end_page($enlace);
                printer_end_doc($enlace);
                printer_close($enlace);
// Fin de proceso de imprimir
 $this->redirect(array('registrar_sin_lector', 'id' => $model->CODIGO_REUNION));
  
 }
    public function actionRegistrar_sin_lector($id) {
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);
        $model = new Asistencia;
        $this->performAjaxValidation($model, 'asistencia-form');

        $modelo_registro_ingresos = Asistencia::model()->findAllBySql(''
                . "SELECT * from asistencia where CODIGO_REUNION = " . $id
                ." and COD_USUARIO = ".(Yii::app()->getSession()->get('id_usuario'))
                . " GROUP BY CODIGO_SOCIO  order by CODIGO_ASISTENCIA DESC limit 5 ");
        $mensajeConfirmandoRegistro = "***** ULTIMOS INGRESOS *****";
        foreach ($modelo_registro_ingresos as $ing) {
            if ($ing->cODIGOSOCIO->GENERO == 'F') {
                $genero = " Sra/Srta. ";
            } else {
                $genero = " Sr. ";
            };
            $mensajeConfirmandoRegistro = $mensajeConfirmandoRegistro . '<br>' . $genero . $ing->cODIGOSOCIO->APELLIDO;
        }
        Yii::app()->getSession()->add('lista_ultimos_registrados', $mensajeConfirmandoRegistro);
        
        
        
        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            //Si es código de barra, buscar en base de datos y obtener código
            if ($model->CODIGO_SOCIO > 0) { // Existe valor en CODIGO DE SOCIO
                $barra = $model->CODIGO_SOCIO;
                if (is_numeric($barra)) {
                    $variable = "Esta buscando manualmente";
                } else {     //Con lector de códig de barras       
                    $modelo_socio = new Socio();
                    $modelo_socio = Socio::model()->findAllBySql(''
                            . "SELECT CODIGO FROM `socio` where COD_BARRA = '" . $barra . "' limit 1 ");
                    foreach ($modelo_socio as $soc) {
                        $model->CODIGO_SOCIO = $soc->CODIGO;
                    }
                }
                //FIN Si es código de barra, buscar en base de datos y obtener código

                $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
                if ($model_socio->GENERO == 'F') {
                    $genero = " Sra/Srta. ";
                } else {
                    $genero = " Sr. ";
                };
                //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
                $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
                $bandera = 0;
                foreach ($model_asistentes as $modelo_asistencia) {
                    ////Ya tiene asistencia a la reunion
                    $bandera = 1;
                }
                if ($bandera == 0) { // Ahun no tiene asistencia a esta reunión
                    //Fecha y hora actual   
                    date_default_timezone_set("America/Lima");
                    $fecha_actual = date("Y-n-j");
                    $hora_actual = date("H:i:s");
                    $fecha_reunion = $model_reunion->FECHA;
                    $codigo_de_reunion = $id;
                    $connection = Yii::app()->db;
                    $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = " . $codigo_de_reunion . "";
                    $command = $connection->createCommand($sql);
                    $rows = $command->execute();
                    $rows = $command->queryAll();

                    foreach ($rows as $row) {
                        $hora_reunion = $row['HORA_INGRESO'];
                    }
                    //$hora_reunion = $model_reunion->HORA_INGRESO+$model_reunion->TIEMPO_ESPERA;                        
                    //PARA COMPARAR FECHAS
                    $datetime1 = date_create($fecha_reunion);
                    $datetime2 = date_create($fecha_actual);
                    $interval = date_diff($datetime1, $datetime2);
                    //echo $interval->format('%R%a días'); //Da +2 dias                           
                    if (($interval->format('%a') == 0) and ( $hora_actual <= $hora_reunion)) {  ///ES HOY Y antes de la hora
                        $model->REGISTRA_INGRESO_PUNTUAL = 1;
                    } else {
                        $model->REGISTRA_ATRASO = 1;
                    };

                    $mensajeConfirmandoRegistro = '' . $genero . $model_socio->APELLIDO;
                    //Yii::app()->user->setFlash('success',$mensajeConfirmandoRegistro);
                    Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro); //foto del usuario
                    $model->CODIGO_REUNION = $id;
                    $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
                    $model->FECHA = $fecha_actual;
                    $model->HORA_INGRESO = $hora_actual;
                    $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' se registro su asistencia.';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    if ($model->save()) {
                            $this->redirect(array('imprimir', 'id' => $model->CODIGO_ASISTENCIA));
                       // $this->redirect(array('registrar_sin_lector', 'id' => $id));
                    }
                } // fin de Ahun no tiene asistencia
                else {
                    $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' ya esta registrado en esta reunión';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    //$this->redirect(array('registrar_sin_lector', 'id' => $id));
                      $this->redirect(array('imprimir', 'id' => $modelo_asistencia->CODIGO_ASISTENCIA));
                }
            } // FIN Existe valor en CODIGO DE SOCIO
            else {
                $mensajeConfirmandoRegistro = 'Intente nuevamente';
                Yii::app()->user->setFlash('error', $mensajeConfirmandoRegistro);
            }
        } // Fin de ingresa como parámetro

        $this->render('registrar_sin_lector', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

    public function actionRegistra_y_actualiza_codigo_barra($id) {

        $connection = Yii::app()->db;
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);

        $model = new Asistencia;

        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
            if ($model_socio->GENERO == 'F') {
                $genero = " Sra/Srta. ";
            } else {
                $genero = " Sr. ";
            };
            //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
            $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
            $bandera = 0;
            foreach ($model_asistentes as $modelo_asistencia) {
                ////Ya tiene asistencia a la reunion
                $bandera = 1;
            }
            if ($bandera == 0) { // Ahun no tiene asistencia a esta reunión
                //Fecha y hora actual   
                date_default_timezone_set("America/Lima");
                $fecha_actual = date("Y-n-j");
                $hora_actual = date("H:i:s");
                $fecha_reunion = $model_reunion->FECHA;
                $codigo_de_reunion = $id;
                $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = " . $codigo_de_reunion . "";
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();

                foreach ($rows as $row) {
                    $hora_reunion = $row['HORA_INGRESO'];
                }
                //$hora_reunion = $model_reunion->HORA_INGRESO+$model_reunion->TIEMPO_ESPERA;                        
                //PARA COMPARAR FECHAS
                $datetime1 = date_create($fecha_reunion);
                $datetime2 = date_create($fecha_actual);
                $interval = date_diff($datetime1, $datetime2);
                //echo $interval->format('%R%a días'); //Da +2 dias                           
                if (($interval->format('%a') == 0) and ( $hora_actual <= $hora_reunion)) {  ///ES HOY Y antes de la hora
                    $model->REGISTRA_INGRESO_PUNTUAL = 1;
                } else {
                    $model->REGISTRA_ATRASO = 1;
                };

                $mensajeConfirmandoRegistro = '' . $genero . $model_socio->APELLIDO;
                //Yii::app()->user->setFlash('success',$mensajeConfirmandoRegistro);
                Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro); //foto del usuario
                $model->CODIGO_REUNION = $id;
                $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
                $model->FECHA = $fecha_actual;
                $model->HORA_INGRESO = $hora_actual;
                // ACTUALIZA CODIGO DE BARRA EN EL SOCIO
                if ($model->OBSERVACIONES != '') {
                    $sql = "CALL ACTUALIZA_CODIGO_DE_BARRA(" . $model->CODIGO_SOCIO . ", '" . $model->OBSERVACIONES . "', " . $model->COD_USUARIO . ")";
                    $command = $connection->createCommand($sql);
                    $rows = $command->execute();
                    $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ', se actualizó su código de barra';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                } else {
                    $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' se registro su asistencia,pero no se actualizó su codigo de barra';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                }
                //GUARDA ASISTENCIA
                if ($model->save()) {
                    $this->redirect(array('registra_y_actualiza_codigo_barra', 'id' => $id));
                }
            } // fin de Ahun no tiene asistencia
            else { //YAA TIENE ASISTENCIA SOLO ACTUALIZA CODIGO DE BARRA EN EL SOCIO
                $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' ya esta registrado en esta reunión. ';
                Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                //ACTUALIZA COD DE BARRA
                // ACTUALIZA CODIGO DE BARRA EN EL SOCIO
                if ($model->OBSERVACIONES != '') {
                    $sql = "CALL ACTUALIZA_CODIGO_DE_BARRA(" . $model->CODIGO_SOCIO . ", '" . $model->OBSERVACIONES . "', " . Yii::app()->getSession()->get('id_usuario') . ")";
                    $command = $connection->createCommand($sql);
                    $rows = $command->execute();
                    $mensajeConfirmandoRegistro = $mensajeConfirmandoRegistro . ' Se actualizó su código de barra';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                }
                $this->redirect(array('registra_y_actualiza_codigo_barra', 'id' => $id));
            }
        }

        $this->render('registra_y_actualiza_codigo_barra', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

    public function actionSalir($id) {
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);
        $model = new Asistencia;

        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            //Si es código de barra, buscar en base de datos y obtener código

            $barra = $model->CODIGO_SOCIO;
            if ($barra == '') {
                $barra = '¡¡¡SALIR!!!';
            }
            if (isset($barra)) {
                $modelo_socio = new Socio();
                $modelo_socio = Socio::model()->findAllBySql(''
                        . "SELECT CODIGO FROM `socio` where "
                        . " COD_BARRA = '" . $barra . "'"
                        . " or COD_BARRA_RIEGO_OLD = '" . $barra . "'"
                        . " or COD_BARRA_POTABLE = '" . $barra . "'"
                        . " or CI = '" . $barra . "'"
                        . " limit 1 ");
                foreach ($modelo_socio as $soc) {
                    $model->CODIGO_SOCIO = $soc->CODIGO;
                }
            }
            //FIN Si es código de barra, buscar en base de datos y obtener código
            $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
            if (isset($model_socio)) {
                if ($model_socio->GENERO == 'F') {
                    $genero = " Sra/Srta. ";
                } else {
                    $genero = " Sr. ";
                };
                //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
                $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
                $bandera = 0;
                foreach ($model_asistentes as $modelo_asistencia) {
                    $bandera = 1;
                    ////Ya tiene asistencia a la reunion / cambiamos estado
                    $hora_actual = date("H:i:s");
                    $modelo_asistencia->REGISTRA_SALIDA_PUNTUAL = 1;
                    $modelo_asistencia->HORA_SALIDA = $hora_actual;
                    $modelo_asistencia->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
                    if ($modelo_asistencia->Save()) {
                        $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' gracias por registrar su salida.';
                        Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                        Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
                        // $this->redirect(array('salir', 'id' => $id));
                    }
                }
                if ($bandera == 0) { // No tiene ingreso
                    $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' no tiene registrado el ingreso a la reunión';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
                }
            } else {
                $mensajeConfirmandoRegistro = 'No es posible registrar la salida';
                Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
            }
            $this->redirect(array('salir', 'id' => $id));
        }


        $this->render('salir', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

    public function actionSalir_sin_lector($id) {
        //BUSCAR LA REUNION
        $model_reunion = Reunion::model()->findByPk($id);
        $model = new Asistencia;

        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            //Si es código de barra, buscar en base de datos y obtener código

            $barra = $model->CODIGO_SOCIO;
            if (is_numeric($barra)) {
                $variable = "Esta buscando manualmente";
            } else {     //Con lector de códig de barras       
                $modelo_socio = new Socio();
                $modelo_socio = Socio::model()->findAllBySql(''
                        . "SELECT CODIGO FROM `socio` where COD_BARRA = '" . $barra . "' limit 1 ");
                foreach ($modelo_socio as $soc) {
                    $model->CODIGO_SOCIO = $soc->CODIGO;
                }
            }
            //FIN Si es código de barra, buscar en base de datos y obtener código
            $model_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);
            if ($model_socio->GENERO == 'F') {
                $genero = " Sra/Srta. ";
            } else {
                $genero = " Sr. ";
            };
            //VERIFICAMOS SI AHUN NO TIENE ASISTENCIA A ESTA REUNION
            $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = ' . $id . ' and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO);
            $bandera = 0;
            foreach ($model_asistentes as $modelo_asistencia) {
                $bandera = 1;
                ////Ya tiene asistencia a la reunion / cambiamos estado
                $hora_actual = date("H:i:s");
                $modelo_asistencia->REGISTRA_SALIDA_PUNTUAL = 1;
                $modelo_asistencia->HORA_SALIDA = $hora_actual;
                $modelo_asistencia->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
                if ($modelo_asistencia->Save()) {
                    $mensajeConfirmandoRegistro = $genero . $model_socio->APELLIDO . ' gracias por registrar su salida.';
                    Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
                    Yii::app()->getSession()->add('ultimo_registrado', $mensajeConfirmandoRegistro);
                }
            }
            if ($bandera == 0) { // No tiene ingreso
                $mensajeConfirmandoRegistro = 'El socio ' . $genero . $model_socio->APELLIDO . ' no tiene registrado el ingreso a la reunión';
                Yii::app()->user->setFlash('success', $mensajeConfirmandoRegistro);
            }
            $this->redirect(array('salir_sin_lector', 'id' => $id));
        }

        $this->render('salir_sin_lector', array(
            'model' => $model,
            'model_reunion' => $model_reunion,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'asistencia-form');

        if (isset($_POST['Asistencia'])) {
            $model->attributes = $_POST['Asistencia'];
            $model->COD_USUARIO = (Yii::app()->getSession()->get('id_usuario'));
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->CODIGO_ASISTENCIA));
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
        $dataProvider = new CActiveDataProvider('Asistencia');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Asistencia('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Asistencia']))
            $model->attributes = $_GET['Asistencia'];

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
        $model = Asistencia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'asistencia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
