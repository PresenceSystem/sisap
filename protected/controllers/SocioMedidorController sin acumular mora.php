<?php

class SocioMedidorController extends AweController {

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
            array(
                'allow',
                'actions' => array(''),
                'users' => array('*'),
            ),
            array(
                'allow',
                'actions' => array(''),
                'users' => array('@'),
            ),
            array(
                'allow',
                'actions' => array(
                    'lista_historial_socios',
                    'historial_total_consumos',
                    'buscar_socio',
                    'buscar_socio_entrega_documento',
                    'cobros_pendientes_con_rubro', 'cobros_pendientes_con_rubro_excel',
                    'cobros_pendientes_solo_alcantarillado',
                    'cobros_pendientes', 'cobros_pendientes_excel',
                    'cobro_realizado_hoy', 'cobro_realizado_hoy_excel',
                    'cobro_realizado_mes', 'cobro_realizado_mes_excel',
                    'cobros_pendientes_x_mes', 'cobro_x_mes',
                    'cambiar_estado',
                    'corte', 'corte_excel',
                    'lis_soc_sinmedidor', 'encabezadofactura', 'detallefactura', 'imprimir_factura', 'imprimir_recibo',
                    'lista_socios_pdf', 'lista_socios_excel', 'lista_socios_word',
                    'lista_socios', 'lista_socios_x_grupo',
                    'lista_acometidas_x_grupo',
                    'derecho_agua', 'factura', 'exportarMedidas', 'importarExcel', 'cambiarPropietario', 'traspaso',
                    'cambiar', 'buscar_x_socio', 'admin', 'delete', 'create', 'update', 'view', 'reporte', 'comunidadsvl', 'consultarcomunidadsvl',
                    'meses_mora', 'meses_mora_excel', 'meses_mora_padron', 'meses_mora_excel_padron', 'reimprimir'
                ),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
            ),
            array(
                'allow',
                'actions' => array('lista_historial_socios', 'lis_soc_sinmedidor', 'encabezadofactura', 'detallefactura', 'imprimir_factura', 'imprimir_recibo', 'lista_socios_pdf', 'lista_socios_excel', 'lista_socios_word', 'lista_socios', 'derecho_agua', 'factura', 'exportarMedidas', 'importarExcel', 'cambiarPropietario', 'traspaso', 'cambiar', 'buscar_x_socio', 'update', 'view', 'reporte'),
                'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionComunidadsvl() {
        $this->render('comunidadsvl', array(
                // 'model_socios' => $model_socios,
                //  'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionConsultarcomunidadsvl() {
        $modelo_socio = Socio::model()->findByPk($_POST['codigo']);
        $socio = array();
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {

            //$parametro = $_POST['cedula'];
            // Datos de la base de datos
            // **************************
            $usuario = "usrsanvicente";
            $password = "reloadedsanvicente";
            $servidor = "192.168.1.15";
            $basededatos = "comunidadsvl";

            // **************************
//            $usuario = "jtierra";
//            $password = "234150";
//            $servidor = "192.168.1.4";
//            $basededatos = "comunidadsvl";
            // **************************
            // creación de la conexión a la base de datos con mysql_connect()
            $conexion = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al servidor de Base de datos");
            // Selección del a base de datos a utilizar
            $db = mysqli_select_db($conexion, $basededatos) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");
            // establecer y realizar consulta. guardamos en variable.
            $consulta = "SELECT s.CI AS CI,
                s.APELLIDO AS APELLIDO, 
                s.COD_BARRA AS COD_BARRA,
SUM(nd.V_TOTAL) AS V_TOTAL,
rub.RUBRO AS RUBRO
FROM socio AS s
INNER JOIN nuevo_recibo AS nr
ON s.CODIGO = nr.COD_SOCIO
INNER JOIN nuevo_detalle AS nd
ON nd.`COD_RECIBO` = nr.`COD_RECIBO`
INNER JOIN nuevo_rubro AS rub
ON rub.`COD_RUBRO` = nd.`COD_RUBRO`
WHERE nd.ESTADO = 0

AND (SELECT 
COUNT(det.COD_DETALLE) 
FROM nuevo_detalle  AS det
INNER JOIN nuevo_recibo AS rec
ON rec.`COD_RECIBO` = det.`COD_RECIBO`
WHERE rec.`COD_SOCIO` = s.`CODIGO`
AND DAY(det.`FECHA`) = DAY(NOW())
AND MONTH(det.`FECHA`) = MONTH(NOW())
AND YEAR(det.`FECHA`) = YEAR(NOW())
AND det.`ESTADO` = 1
) = 0



AND s.`PARTICIPA_COMUNIDAD` = 1
AND s.CI = '" . $modelo_socio->CI
                    . "' GROUP BY s.`CODIGO`";
            $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            // Bucle while que recorre cada registro y muestra cada campo en la tabla.
            $arr = array();
            while ($columna = mysqli_fetch_array($resultado)) {

                $arr[] = array(
                    $columna['CI'],
//                    $columna['APELLIDO'],
                    $columna['V_TOTAL'],
                );
                $socio = $arr[0];
            }
        } else {
            $socio = 0;
        }
        echo CJSON::encode($socio);
    }

    public function actionBuscar_socio_entrega_documento() {
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {
            $query = 'call generar_factura_encabezado(' . $_POST['socio'] . ')';
            $command = Yii::app()->db->createCommand($query);
            $datos = $command->queryAll();
            if (    $_POST['socio'] == "38" || $_POST['socio'] == "34"
                    ||  $_POST['socio'] == "65" || $_POST['socio'] == "74"  
                    ||  $_POST['socio'] == "105" || $_POST['socio'] == "96"  
                    ||  $_POST['socio'] == "154" || $_POST['socio'] == "150"  
                    ||  $_POST['socio'] == "234" || $_POST['socio'] == "208"  
                    ||  $_POST['socio'] == "235" || $_POST['socio'] == "239"  
                    ||  $_POST['socio'] == "252" || $_POST['socio'] == "257"  
                    ||  $_POST['socio'] == "273" || $_POST['socio'] == "275"  ) {
                $datos = $datos;
            } else {
                $datos = null;
            }
            echo CJSON::encode($datos);
        }
    }

    public function actionBuscar_socio() {
        $socio = array();
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {

            //$parametro = $_POST['cedula'];
            $modelos_socio = Socio::model()->findAllBySql('select * from socio where CI="' . $_POST['cedula'] . '"');
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

    public function actionCobros_pendientes_solo_alcantarillado() {

        $model_socios = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             inner join rubro as r
                             on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0   
                                and r.APLICA = 0
                                and s.ESTADO = 1
                                and m.NUMERO like "Sin agua potable%"
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                              inner join rubro as r
                             on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0  
                                and r.APLICA = 2
                                and s.ESTADO = 1
                                 and m.NUMERO like "Sin agua potable%"
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $this->render('cobros_pendientes_solo_alcantarillado', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobros_pendientes() {

        $model_socios = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
						     on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0   
								and r.APLICA = 0
                                and s.ESTADO = 1                                
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							  inner join rubro as r
						     on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0  
								and r.APLICA = 2
                                and s.ESTADO = 1
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $this->render('cobros_pendientes', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobros_pendientes_excel() {
        $model_socios = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
						     on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0   
								and r.APLICA = 0
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO 
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							  inner join rubro as r
						     on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 0  
								and r.APLICA = 2
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $contenido = $this->renderPartial("cobros_pendientes_excel", array('model_socios' => $model_socios, 'model_socios_comunidad' => $model_socios_comunidad), true);
        Yii::app()->request->sendFile("Socios deudores " . date('d M Y') . ".xls", $contenido);
        $this->render('cobros_pendientes_excel', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobros_pendientes_con_rubro() {

        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            GROUP_CONCAT(DISTINCT CONCAT(r.`DESCRIPCION`," [ ",d.`V_TOTAL`," $]")
					ORDER BY r.`DESCRIPCION` ASC
					SEPARATOR ";"
					)  AS FOTO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             INNER JOIN rubro AS r
                             ON r.`ID` = d.`ID_RUBRO`
                             WHERE d.`ESTADO` = 0               
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $this->render('cobros_pendientes_con_rubro', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionCobros_pendientes_con_rubro_excel() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            GROUP_CONCAT(DISTINCT CONCAT(r.`DESCRIPCION`," [ ",d.`V_TOTAL`," $]")
					ORDER BY r.`DESCRIPCION` ASC
					SEPARATOR ";"
					)  AS FOTO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             INNER JOIN rubro AS r
                             ON r.`ID` = d.`ID_RUBRO`
                             WHERE d.`ESTADO` = 0               
                            GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $contenido = $this->renderPartial("cobros_pendientes_con_rubro_excel", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Socios deudores detallado " . date('d M Y') . ".xls", $contenido);
        $this->render('cobros_pendientes_con_rubro_excel', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionCobro_realizado_mes() {

        $model_socios = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            d.FACTURA_COBRA as PARTICIPA_COMUNIDAD
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 0
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							 AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  							 
                            GROUP BY sm.`ID`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 2
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							 AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  							 
                            GROUP BY sm.`ID`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $this->render('cobro_realizado_mes', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobro_realizado_hoy() {


//        $model_socios_factura = Socio::model()->findAllBySql('
//                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
//                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
//                            f.NUMERO_FACTURA as FOTO
//                             FROM socio AS s
//                            INNER JOIN socio_medidor AS sm
//                             ON s.CODIGO = sm.CODIGO_SOCIO
//                             INNER JOIN medidor AS m
//                             ON m.ID = sm.ID_MEDIDOR
//                             INNER JOIN factura AS f
//                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
//                             INNER JOIN detalle AS d
//                             ON d.`ID_FACTURA` = f.`ID`
//                             inner join rubro as r
//                             on r.ID = d.ID_RUBRO
//                             WHERE d.`ESTADO` = 1    
//                                and r.APLICA = 0
//                                 AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
//                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
//                            AND DAY(d.`FECHA_COBRO`)=DAY(NOW())   
//                            and r.TIPO = 1      
//                            -- AND f.NUMERO_FACTURA IS NOT NULL
//                            GROUP BY sm.`ID`
//                             ORDER BY f.`NUMERO_FACTURA` ASC
//                        ');
        $model_socios_factura = Socio::model()->findAllBySql('
                  SELECT 
s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            f.NUMERO_FACTURA AS FOTO
FROM socio AS s
INNER JOIN `socio_medidor` AS sm
ON s.`CODIGO` = sm.`CODIGO_SOCIO`
INNER JOIN medidor AS m
ON m.`ID` = sm.`ID_MEDIDOR`
INNER JOIN factura AS f
ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
INNER JOIN detalle AS d
ON f.`ID` = d.`FACTURA_COBRA`
INNER JOIN rubro AS r
ON r.`ID` = d.`ID_RUBRO`
WHERE
d.ESTADO = 1
AND f.TIPO = 1
AND r.APLICA = 0
  AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
  AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
  AND DAY(d.`FECHA_COBRO`)=DAY(NOW())
  AND f.NUMERO_FACTURA IS NOT NULL
  and r.TIPO = 1 
 GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');
        $model_socios_recibo = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             inner join rubro as r
                             on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
                                and r.APLICA = 0
                                 AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
                            AND DAY(d.`FECHA_COBRO`)=DAY(NOW())       
                            and r.TIPO = 2                       
                            GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 2
                              AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							AND DAY(d.`FECHA_COBRO`)=DAY(NOW())  	        
                            GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');


        $this->render('cobro_realizado_hoy', array(
            'model_socios_factura' => $model_socios_factura,
            'model_socios_recibo' => $model_socios_recibo,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobro_realizado_mes_excel() {

        $model_socios = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 0
                           AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())      
                            GROUP BY sm.`ID`
                             ORDER BY s.`APELLIDO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 2
                             AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							     
                            GROUP BY sm.`ID`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $contenido = $this->renderPartial("cobro_realizado_mes_excel", array('model_socios' => $model_socios, 'model_socios_comunidad' => $model_socios_comunidad), true);
        Yii::app()->request->sendFile("Cobro realizado .xls", $contenido);
        $this->render('cobro_realizado_mes_excel', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobro_realizado_hoy_excel() {


        $model_socios_factura = Socio::model()->findAllBySql('
                  SELECT 
s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            f.NUMERO_FACTURA AS FOTO
FROM socio AS s
INNER JOIN `socio_medidor` AS sm
ON s.`CODIGO` = sm.`CODIGO_SOCIO`
INNER JOIN medidor AS m
ON m.`ID` = sm.`ID_MEDIDOR`
INNER JOIN factura AS f
ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
INNER JOIN detalle AS d
ON f.`ID` = d.`FACTURA_COBRA`
INNER JOIN rubro AS r
ON r.`ID` = d.`ID_RUBRO`
WHERE
d.ESTADO = 1
AND f.TIPO = 1
AND r.APLICA = 0
  AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
  AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
  AND DAY(d.`FECHA_COBRO`)=DAY(NOW())
  AND f.NUMERO_FACTURA IS NOT NULL
  and r.TIPO = 1 
 GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');
        $model_socios_recibo = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             inner join rubro as r
                             on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
                                and r.APLICA = 0
                                 AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
                            AND DAY(d.`FECHA_COBRO`)=DAY(NOW())       
                            and r.TIPO = 2                       
                            GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');
        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
							 inner join rubro as r
							 on r.ID = d.ID_RUBRO
                             WHERE d.`ESTADO` = 1    
								and r.APLICA = 2
                              AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  
                             AND MONTH(d.`FECHA_COBRO`)=MONTH(NOW())  
							AND DAY(d.`FECHA_COBRO`)=DAY(NOW())  	        
                            GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');


        $contenido = $this->renderPartial(
                "cobro_realizado_hoy_excel", array(
            'model_socios_factura' => $model_socios_factura,
            'model_socios_recibo' => $model_socios_recibo,
            'model_socios_comunidad' => $model_socios_comunidad
                ), true
        );
        Yii::app()->request->sendFile("Cobro realizado .xls", $contenido);
        $this->render('cobro_realizado_mes_excel', array(
            'model_socios_factura' => $model_socios_factura,
            'model_socios_recibo' => $model_socios_recibo,
            'model_socios_comunidad' => $model_socios_comunidad,
        ));
    }

    public function actionCobro_x_mes($id) {
        $parametro = explode('123123123123123', $id);
        $mes = $parametro[0];
        $anio = $parametro[1];
        $model = new SocioMedidor;
//        $model_socios = Socio::model()->findAllBySql('
//                   SELECT      s.APELLIDO, 
//                               s.CI, 
//                               s.CELULAR, 
//                               s.TELEFONO, 
//                               m.NUMERO AS OBS, 
//                               SUM(d.`V_TOTAL`) AS COD_USUARIO,
//                               d.`FACTURA_COBRA` AS TIPO,
//                               f.NUMERO_FACTURA as FOTO
//                             FROM socio AS s
//                            INNER JOIN socio_medidor AS sm
//                             ON s.CODIGO = sm.CODIGO_SOCIO
//                             INNER JOIN medidor AS m
//                             ON m.ID = sm.ID_MEDIDOR
//                             INNER JOIN factura AS f
//                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
//                             INNER JOIN detalle AS d
//                             ON d.`ID_FACTURA` = f.`ID`
//                             WHERE d.`ESTADO` = 1    
//                             and f.TIPO = 1
//                            -- AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  							 
//                             AND MONTH(d.`FECHA_COBRO`)= ' . $mes .
//                ' AND YEAR(d.`FECHA_COBRO`)= ' . $anio .
//                ' GROUP BY d.`FACTURA_COBRA`
//                             ORDER BY f.`NUMERO_FACTURA` ASC
//                        ');
        $model_socios = Socio::model()->findAllBySql('
                  SELECT 
s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                            SUM(d.`V_TOTAL`) AS COD_USUARIO,
                            d.`FACTURA_COBRA` AS TIPO,
                            f.NUMERO_FACTURA AS FOTO
FROM socio AS s
INNER JOIN `socio_medidor` AS sm
ON s.`CODIGO` = sm.`CODIGO_SOCIO`
INNER JOIN medidor AS m
ON m.`ID` = sm.`ID_MEDIDOR`
INNER JOIN factura AS f
ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
INNER JOIN detalle AS d
ON f.`ID` = d.`FACTURA_COBRA`
INNER JOIN rubro AS r
ON r.`ID` = d.`ID_RUBRO`
WHERE
d.ESTADO = 1
AND f.TIPO = 1
AND r.APLICA = 0
 AND MONTH(d.`FECHA_COBRO`)= ' . $mes .
                ' AND YEAR(d.`FECHA_COBRO`)= ' . $anio .
                '  AND f.NUMERO_FACTURA IS NOT NULL
  and r.TIPO = 1 
 GROUP BY d.`FACTURA_COBRA`
 ORDER BY d.`FECHA_COBRO` ASC
                        ');

        $model_socios_comunidad = Socio::model()->findAllBySql('
                   SELECT      s.APELLIDO, 
                               s.CI, 
                               s.CELULAR, 
                               s.TELEFONO, 
                               m.NUMERO AS OBS, 
                               SUM(d.`V_TOTAL`) AS COD_USUARIO,
                               d.`FACTURA_COBRA` AS TIPO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             INNER JOIN detalle AS d
                             ON d.`ID_FACTURA` = f.`ID`
                             WHERE d.`ESTADO` = 1    
                             and f.TIPO = 2
                            -- AND YEAR(d.`FECHA_COBRO`)=YEAR(NOW())  							 
                             AND MONTH(d.`FECHA_COBRO`)= ' . $mes .
                ' AND YEAR(d.`FECHA_COBRO`)= ' . $anio .
                ' GROUP BY sm.`CODIGO_SOCIO`
                             ORDER BY s.`APELLIDO` ASC
                        ');


        $this->render('cobro_x_mes', array(
            'model_socios' => $model_socios,
            'model_socios_comunidad' => $model_socios_comunidad,
            'model' => $model,
            'id' => $id,
            'anio' => $anio,
            'mes' => $mes,
        ));
    }

    public function actionCambiar_estado($id) {

        $model = SocioMedidor::model()->findByPk($id);
        if ($model->INACTIVO == 1) {
            $model->INACTIVO = 0;
        } else {
            $model->INACTIVO = 1;
        };
        if ($model->save()) {
            $this->redirect(array('corte', 'id' => $id));
        };

        $this->render('cambiar_estado', array(
            'model' => $model,
        ));
    }

    public function actionCorte() {
        //1.- Ver si ya se realizaron los cobros del mes actual
        //        $query = '
        //                        SELECT count(*) as BANDERA_COBRO FROM detalle 
        //                        WHERE YEAR(FECHA_COBRO) = YEAR(CURDATE())
        //                        AND MONTH(FECHA_COBRO) = MONTH(CURDATE())
        //                        AND `ESTADO` = 1
        //                        LIMIT 1
        //                    ';
        //        $command = Yii::app()->db->createCommand($query);
        //        $row = $command->queryRow();
        //SI YA PASO
        //        if ($row['BANDERA_COBRO'] > 0) {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					m.ORDEN_RECORIDO AS COD_GRUPO,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    sm.INACTIVO AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE f.`ESTADO` = 0
                        AND f.`TIPO` = 1 
                        AND r.`DESCRIPCION` LIKE "CONSUMO DE AGUA POTABLE %" 
                        AND s.ESTADO = 1
                             GROUP BY sm.ID
                             ORDER BY COD_USUARIO DESC, FOTO DESC
                        ');
        //        }
        //        //SI AHUN NO COBRA
        //        else {
        //            $model_socios = Socio::model()->findAllBySql('
        //                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
        //					m.ORDEN_RECORIDO AS COD_GRUPO,
        //                    (COUNT(f.ID)-1) AS COD_USUARIO, sm.ID as FECHA_ACTUALIZACION, sm.INACTIVO as FECHA_INGRESO,(select sum(det.V_TOTAL) from detalle as det inner join factura as fac on fac.ID = det.ID_FACTURA inner join socio_medidor as socmed on socmed.ID = fac.ID_MEDIDOR_SOCIO where socmed.ID = sm.ID and det.ESTADO=0) as FOTO
        //                             FROM socio AS s
        //                            INNER JOIN socio_medidor AS sm
        //                             ON s.CODIGO = sm.CODIGO_SOCIO
        //                             INNER JOIN medidor AS m
        //                             ON m.ID = sm.ID_MEDIDOR
        //                             INNER JOIN factura AS f
        //                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
        //                             WHERE f.`ESTADO` = 0
        //                        AND f.`TIPO` = 1     
        //                        AND s.ESTADO = 1
        //                             GROUP BY sm.ID
        //                             ORDER BY s.`APELLIDO`
        //                        ');
        //        }

        $this->render('corte', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionCorte_excel() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					m.ORDEN_RECORIDO AS COD_GRUPO,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    sm.INACTIVO AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE f.`ESTADO` = 0
                        AND f.`TIPO` = 1 
                        AND r.`DESCRIPCION` LIKE "CONSUMO DE AGUA POTABLE %" 
                        AND s.ESTADO = 1
                             GROUP BY sm.ID
                             ORDER BY COD_USUARIO DESC, FOTO DESC
                        ');
        $contenido = $this->renderPartial("corte_excel", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Corte de servicio de agua potable al " . gmdate('d_M_Y') . ".xls", $contenido);
        $this->render('corte_excel', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionMeses_mora() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.CODIGO, s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					m.ORDEN_RECORIDO AS COD_GRUPO, s.FECHA_NACIMIENTO, edad(s.CODIGO) as FECHA_SALIDA,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    s.PARTICIPA_COMUNIDAD AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE f.`ESTADO` = 0
                        -- AND f.`TIPO` = 1 
                       -- AND r.`DESCRIPCION` LIKE "CONSUMO DE AGUA POTABLE %" 
                        AND s.ESTADO = 1
                             GROUP BY sm.ID
                             ORDER BY s.`APELLIDO`
                        ');


        $this->render('meses_mora', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionMeses_mora_excel() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.CODIGO, s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					m.ORDEN_RECORIDO AS COD_GRUPO, s.FECHA_NACIMIENTO, edad(s.CODIGO) as FECHA_SALIDA,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    s.PARTICIPA_COMUNIDAD AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE f.`ESTADO` = 0
                        -- AND f.`TIPO` = 1 
                       -- AND r.`DESCRIPCION` LIKE "CONSUMO DE AGUA POTABLE %" 
                        AND s.ESTADO = 1
                             GROUP BY sm.ID
                             ORDER BY s.`APELLIDO`
                        ');
        $contenido = $this->renderPartial("meses_mora_excel", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Padrón Electoral 2019 " . ".xls", $contenido);
        $this->render('meses_mora_excel', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionMeses_mora_padron() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.CODIGO, s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					s.COD_GRUPO AS COD_GRUPO,
                                        s.FECHA_NACIMIENTO, edad(s.CODIGO) as FECHA_SALIDA,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    s.PARTICIPA_COMUNIDAD AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE s.ESTADO = 1
                        AND sm.`INACTIVO` = 0
                             GROUP BY sm.ID
                             ORDER BY s.`APELLIDO`
                        ');


        $this->render('meses_mora_padron', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionMeses_mora_excel_padron() {
        $model_socios = Socio::model()->findAllBySql('
                    SELECT s.CODIGO, s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
					s.COD_GRUPO AS COD_GRUPO, s.FECHA_NACIMIENTO, edad(s.CODIGO) as FECHA_SALIDA,
                                        
                    (SELECT COUNT(DISTINCT fac.ID)
                    FROM detalle AS det 
                    INNER JOIN factura AS fac 
                    ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed 
                    ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID 
                    AND det.ESTADO=0
                    AND fac.TIPO = 1) AS COD_USUARIO, 
                    
                    sm.ID AS FECHA_ACTUALIZACION, 
                    s.PARTICIPA_COMUNIDAD AS FECHA_INGRESO,
                    
                    (SELECT SUM(det.V_TOTAL) FROM detalle AS det 
                    INNER JOIN factura AS fac ON fac.ID = det.ID_FACTURA 
                    INNER JOIN socio_medidor AS socmed ON socmed.ID = fac.ID_MEDIDOR_SOCIO 
                    WHERE socmed.ID = sm.ID AND det.ESTADO=0) AS FOTO
                    
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
			     INNER JOIN detalle AS d
			     ON d.`ID_FACTURA` = f.`ID`
			     INNER JOIN rubro AS r
			     ON d.`ID_RUBRO` = r.ID
                             WHERE s.ESTADO = 1
                        AND sm.`INACTIVO` = 0
                             GROUP BY sm.ID
                             ORDER BY s.`APELLIDO`
                        ');
        $contenido = $this->renderPartial("meses_mora_excel_padron", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Padrón Electoral 2019 " . ".xls", $contenido);
        $this->render('meses_mora_excel_padron', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionEncabezadofactura() {
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {
            $query = 'call generar_factura_encabezado(' . $_POST['socio'] . ')';
            $command = Yii::app()->db->createCommand($query);
            $datos = $command->queryAll();
            echo CJSON::encode($datos);
        }
    }

    public function actionDetallefactura() {
        header('Content-type: application/json');
        if (!isset($_GET['ajax'])) {

            $medidor = $_POST['medidor'];
            $socio = $_POST['socio'];
            $query = 'call generar_factura_detalle(' . $socio . ', "' . $medidor . '")';
            $command = Yii::app()->db->createCommand($query);
            $datos = $command->queryAll();
            echo CJSON::encode($datos);
        }
    }

    public function actionFactura() {
        $model = new SocioMedidor;
        $this->performAjaxValidation($model, 'socio-medidor-form-factura');
        $ultima_factura_fisica = Factura::model()->findBySql('SELECT IF (MAX(`NUMERO_FACTURA`) IS NULL,0, MAX(`NUMERO_FACTURA`))+1 AS NUMERO_FACTURA
FROM factura');
        $model->COD_USUARIO = $ultima_factura_fisica->NUMERO_FACTURA;
        if (isset($_POST['SocioMedidor']) and isset($_POST['item'])) {
            $model->attributes = $_POST['SocioMedidor'];
            $detalles = $_POST['item'];

            //Buscando la factura mayor
            $id_factura_mayor = 0;
            foreach ($detalles as $detalle) {
                $ids_detalles = explode('-', $detalle);
                $FACTURA = $ids_detalles[2];    //ID DE LA FACTURA 
                $fact_cobrando = Factura::model()->findByPk($FACTURA);
                if ($id_factura_mayor < $FACTURA and $fact_cobrando->TIPO == 1) {
                    $id_factura_mayor = $FACTURA;
                }
                // var_dump($detalles);				 
                // Yii::app()->end();
            }

            foreach ($detalles as $detalle) {
                $ids_detalles = explode('-', $detalle);
                $id_detalle = $ids_detalles[0];    //ID DEL DETALLE               
                $model_detalle = Detalle::model()->findByPk($id_detalle);
                $model_detalle->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                $model_detalle->ESTADO = 1; //CAmbia a estado pagado
                $model_detalle->FACTURA_COBRA = $id_factura_mayor;
                if (isset($model_detalle)) {
                    $cuen = 0;
                    if ($model_detalle->save()) {
                        $cuen++;
                    }
                    //		echo "modificarorn ".$cuen.'<br>';
                    //	echo $model_detalle->FACTURA_COBRA;
                    //	Yii::app()->end();
                }
            }
            Yii::app()->getSession()->add('factura_cobro', $id_factura_mayor);
            // Actualizamos el número de la factura física
            $factura_cobrada = Factura::model()->findByPk($id_factura_mayor);
            $factura_cobrada->NUMERO_FACTURA = $model->COD_USUARIO;

            // var_dump($id_factura_mayor);
            // Yii::app()->end();
            //   REDIRECCIONAMOS A  IMPRIMIR El estado ya esta cambiado toca crear otro procedimiento apra la impresion
            if ($factura_cobrada->save()) {
                $this->redirect(array('imprimir_factura', 'id' => $model_detalle->iDFACTURA->iDMEDIDORSOCIO->CODIGO_SOCIO));
            }
        }
        $this->render('factura', array(
            'model' => $model,
        ));
    }

    public function actionImprimir_recibo($id) {
        //  $this->layout = 'imprimir';
        $factura_vinculada = Yii::app()->getSession()->get('factura_cobro');

        $model_socio = Socio::model()->findByPk($id);
        $query = 'call generar_factura_encabezado_pagado(' . $id . ', ' . $factura_vinculada . ')';
        $command = Yii::app()->db->createCommand($query);
        $rec = $command->queryRow();

        $query = 'call generar_factura_detalle_pagado(' . $id . ', ' . $factura_vinculada . ')';
        $command = Yii::app()->db->createCommand($query);
        $detalles = $command->queryAll();

        $username = (Yii::app()->getSession()->get('nombre_usuario'));
        $connection = Yii::app()->db;
        $contador = 1;
        $ano = (date('Y')) * 1;
        $mes = (date('m')) * 1;
        $dia = (date('d')) * 1;
        $diasemana = date('w');
        $diassemanaN = array(
            "Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado"
        );
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano";
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


        $barcode = printer_create_font("Arial", 72, 48, 400, false, false, false, 0);
        printer_select_font($enlace, $barcode);
        //   printer_delete_font($font);
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$   SE REPITE POR LA COPIA   $$$$$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


        printer_draw_text($enlace, "                 COMUNIDAD", 0, 50);
        printer_draw_text($enlace, "         ''SAN VICENTE DE LACAS''", 0, 150);
        printer_draw_text($enlace, utf8_decode('FECHA  : ' . $fecha_formateada), 0, 300);
        //printer_draw_text($enlace, utf8_decode("Recibo N' : ".$rec->ID_FACTURA), 0, 300);
        printer_draw_text($enlace, utf8_decode('NOMBRES: ' . $model_socio->APELLIDO), 0, 450);
        printer_draw_text($enlace, utf8_decode('CI/RUC : ' . $model_socio->CI), 0, 600);
        //	$recibo->CAMBIO = number_format('VALOR',0,'.',''); 				


        $total = 0.00;
        $mm_inicia_detalle = 750; //Inica a imprimir los detalles en el eje y

        printer_draw_text($enlace, utf8_decode('DESCRIPCION') . utf8_decode(' ( V.TOTAL )'), 2, $mm_inicia_detalle); //Cant


        foreach ($detalles as $det) {
            if (($det['TIPO']) == 2) { //RECIBO 
                $mm_inicia_detalle = $mm_inicia_detalle + 150;
                printer_draw_text($enlace, utf8_decode($det['DESCRIPCION']) . ' (' . utf8_decode($det['V_TOTAL']) . ')', 2, $mm_inicia_detalle); //Descripción						 

                $total = $total + $det['V_TOTAL'];
            } // Termina de validar si es RECIBO
        } //Termina de imprimir los detalles

        if (($punto = strpos($total, '.')) == false)
            $total = $total . ',00';
        $mm_inicia_detalle = $mm_inicia_detalle + 150;

        printer_draw_text($enlace, 'VALOR TOTAL: ' . $total . ' $', 2, $mm_inicia_detalle);
        $mm_inicia_detalle = $mm_inicia_detalle + 150;
        printer_draw_text($enlace, utf8_decode('     GRACIAS POR SU COLABORACION '), 2, $mm_inicia_detalle);
        $mm_inicia_detalle = $mm_inicia_detalle + 900;
        printer_draw_text($enlace, utf8_decode('     ´ '), 2, $mm_inicia_detalle);

        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$  FIN SE REPITE POR LA COPIA   $$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

        printer_end_page($enlace);
        printer_end_doc($enlace);
        printer_close($enlace);


        $this->redirect(array('factura'));

        Yii::app()->getSession()->remove('factura_cobro'); //Eliminamos la variable de sesión
    }

    public function actionImprimir_factura($id) {
        //  $this->layout = 'imprimir';
        $factura_vinculada = Yii::app()->getSession()->get('factura_cobro');

        $model_socio = Socio::model()->findByPk($id);
        $query = 'call generar_factura_encabezado_pagado(' . $id . ', ' . $factura_vinculada . ')';
        $command = Yii::app()->db->createCommand($query);
        $rec = $command->queryRow();

        $query = 'call generar_factura_detalle_pagado(' . $id . ', ' . $factura_vinculada . ')';
        $command = Yii::app()->db->createCommand($query);
        $detalles = $command->queryAll();

        $username = (Yii::app()->getSession()->get('nombre_usuario'));
        $connection = Yii::app()->db;
        $contador = 1;
//        $fecha_y_hora = explode(' ', $rec['FECHA']);
//        $fec = $fecha_y_hora[0];
//        $hor = $fecha_y_hora[1];
//        $fe = explode('-', $fec);
//        $ano = $fe[0] * 1; //(date('Y')) * 1;
//        $mes = $fe[1] * 1; //(date('m')) * 1;
//        $dia = $fe[2] * 1; //(date('d')) * 1;
//        $diasemana = date('w', strtotime($rec['FECHA']));


        $ano = (date('Y')) * 1;
        $mes = (date('m')) * 1;
        $dia = (date('d')) * 1;
        $diasemana = date('w');

        $diassemanaN = array(
            "Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado"
        );
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );

        // $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano       " . $hor;
        $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano       " . date('H:i:s');

        //Buscar impresora para imprimir factura
        $impresora = Impresora::model()->findBySql('SELECT *
                                                            FROM impresora
                                                            WHERE DOC=1 
                                                            limit 1');
        $mm_px = 10; // px
        $menorar_y = 30; //esta aumentando en el eje y
        $menorar_x = 5; //esta menorando en el eje x

        $printer = $impresora->IMPRESORA;
        $enlace = printer_open($printer);
        printer_start_doc($enlace, 'Recibo');
        printer_start_page($enlace);

        //$font = printer_create_font('Tipo', Alto, Ancho, Peso_de_la_fuente -100<_400_>100, cursiva, subrayado, trasada, orientacion);
        // $font = printer_create_font('Arial', 14, 48, 400, false, false, false, 0);
        //  printer_select_font($enlace, $font);
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$   SE REPITE POR LA COPIA   $$$$$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        for ($i = 1; $i <= 2; $i++) {

            if ($i == 2)
                $menorar_y = 220;
            $tel = '';
            if ($rec['TELEFONO'] != '')
                $tel = $rec['TELEFONO'];
            if ($rec['CELULAR'] != '')
                $tel = $rec['TELEFONO'] . '/' . $rec['CELULAR'];
            else
                $tel = $rec['CELULAR'];
            if ($tel == '')
                $tel = 'N/A';
            $barcode = printer_create_font("Free 3 of 9 Extended", 40, 20, PRINTER_FW_HEAVY, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            //   printer_delete_font($font);
            printer_draw_text($enlace, utf8_decode('SOCIO: '), ((28 - $menorar_x) * $mm_px), ((20 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode('CI/RUC: '), ((28 - $menorar_x) * $mm_px), ((26 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode('TEL.: '), ((28 - $menorar_x) * $mm_px), ((32 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode('FECHA: '), ((28 - $menorar_x) * $mm_px), ((38 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode('EMITIDO POR: '), ((28 - $menorar_x) * $mm_px), ((44 + $menorar_y) * $mm_px));
            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 40, 20, PRINTER_FW_NORMAL, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            printer_draw_text($enlace, utf8_decode($rec['APELLIDO']), ((62 - $menorar_x) * $mm_px), ((20 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode($rec['CI']), ((62 - $menorar_x) * $mm_px), ((26 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode($tel), ((62 - $menorar_x) * $mm_px), ((32 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode($fecha_formateada), ((62 - $menorar_x) * $mm_px), ((38 + $menorar_y) * $mm_px));
            printer_draw_text($enlace, utf8_decode($username), ((62 - $menorar_x) * $mm_px), ((44 + $menorar_y) * $mm_px));

            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 40, 20, PRINTER_FW_HEAVY, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            printer_draw_text($enlace, utf8_decode('CONEXIÓN: '), ((174 - $menorar_x) * $mm_px), ((25 + $menorar_y) * $mm_px)); //Modulo
            printer_draw_text($enlace, utf8_decode('EMISIÓN Nº: '), ((230 - $menorar_x) * $mm_px), ((25 + $menorar_y) * $mm_px)); //Toma
            printer_draw_text($enlace, utf8_decode('MEDIDOR: '), ((174 - $menorar_x) * $mm_px), ((31 + $menorar_y) * $mm_px)); //Reservorio
            printer_draw_text($enlace, utf8_decode($rec['GRUPO']), ((174 - $menorar_x) * $mm_px), ((37 + $menorar_y) * $mm_px)); //Reservorio
            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 40, 20, PRINTER_FW_NORMAL, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            printer_draw_text($enlace, utf8_decode($rec['ID_SM']), ((202 - $menorar_x) * $mm_px), ((25 + $menorar_y) * $mm_px)); //Modulo
            printer_draw_text($enlace, utf8_decode($rec['ID_FACTURA']), ((260 - $menorar_x) * $mm_px), ((25 + $menorar_y) * $mm_px)); //Toma
            printer_draw_text($enlace, utf8_decode($rec['NUMERO']), ((202 - $menorar_x) * $mm_px), ((31 + $menorar_y) * $mm_px)); //Reservorio



            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 36, 18, PRINTER_FW_HEAVY, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            $total = 0.00;

            $mm_inicia_detalle = 66; //Inica a imprimir los detalles en el eje y
            $sumador_de_lineas_y = (($mm_inicia_detalle + $menorar_y) * $mm_px);
            printer_draw_text($enlace, utf8_decode('DESCRIPCIÓN'), ((14 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Cant
            printer_draw_text($enlace, utf8_decode('ANTERIOR'), ((115 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Descripción
            printer_draw_text($enlace, utf8_decode('ACTUAL'), ((140 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //V.U.
            printer_draw_text($enlace, utf8_decode('CONSUMO'), ((165 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total
            printer_draw_text($enlace, utf8_decode('BÁSICO'), ((190 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total
            printer_draw_text($enlace, utf8_decode('VALOR'), ((215 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total
            printer_draw_text($enlace, utf8_decode('MORA'), ((240 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total
            printer_draw_text($enlace, utf8_decode('SUBTOTAL'), ((265 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total
            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 36, 15, PRINTER_FW_NORMAL, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            foreach ($detalles as $det) {
                if (($det['TIPO']) == 1) { //FACTURA 
                    $sub_total = 0;
                    // BUSCAR FACTURA DE CADA DETALLE
                    $factura = Factura::model()->findByPk($det['ID_FACTURA']);
                    $posicion = strpos($det['DESCRIPCION'], 'CONSUMO DE AGUA POTABLE'); //posicion debe ser 0					  
                    $basico = strpos($det['DESCRIPCION'], 'VALOR BÁSICO'); // posicion 0
                    $mora = strpos($det['DESCRIPCION'], 'MORA'); //posicion 0
                    if ($posicion !== 0 and $basico !== 0 and $mora !== 0) { //NO ES CONSUMO DE AGUA POTABLE    
                        $mm_inicia_detalle = $mm_inicia_detalle + 6;
                        $sumador_de_lineas_y = (($mm_inicia_detalle + $menorar_y) * $mm_px);
                        printer_draw_text($enlace, utf8_decode($det['DESCRIPCION']), ((14 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Descripción														
                        $sub_total = $det['V_TOTAL'];
                        $sub_total = number_format($sub_total, 2, '.', '');
                        printer_draw_text($enlace, utf8_decode($sub_total), ((265 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total de la factura
                    }
                    if ($posicion === 0) {

                        $des_f = explode(' ', $det['DESCRIPCION']);
                        $cuenta_elementos = count($des_f);
                        $descripcion_final = $des_f[$cuenta_elementos - 2] . ' ' . $des_f[$cuenta_elementos - 1];  //Ejm: Febrero 2017
                        $mm_inicia_detalle = $mm_inicia_detalle + 6;
                        $sumador_de_lineas_y = (($mm_inicia_detalle + $menorar_y) * $mm_px);
                        printer_draw_text($enlace, utf8_decode($det['DESCRIPCION']), ((14 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Descripción
                        printer_draw_text($enlace, utf8_decode($factura['CONSUMO_ANTERIOR'] . ' '), ((115 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Medida anterior
                        printer_draw_text($enlace, utf8_decode($factura['CONSUMO_ACTUAL'] . ' '), ((140 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Medida final
                        printer_draw_text($enlace, utf8_decode($factura['CONSUMO_CALCULADO'] . ' m³'), ((165 - $menorar_x) * $mm_px), $sumador_de_lineas_y); //Consumo							
                        $basico = 0;
                        //Buscar básico
                        $basico_a_comparar = 'VALOR BÁSICO ' . $descripcion_final;
                        foreach ($detalles as $det_basico) {
                            if (($det_basico['TIPO']) == 1) { //FACTURA 
                                if ($det_basico['DESCRIPCION'] == $basico_a_comparar) {
                                    $basico = $det_basico['V_TOTAL'];
                                }
                            }
                        }
                        printer_draw_text($enlace, utf8_decode($basico), ((190 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total de la factura
                        printer_draw_text($enlace, utf8_decode($det['V_TOTAL']), ((215 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total de la factura
                        $mora = 0;
                        //Buscamos mora
                        $mora_a_comparar = 'MORA ' . $descripcion_final;
                        foreach ($detalles as $det_mora) {
                            if (($det_mora['TIPO']) == 1) { //FACTURA 
                                if ($det_mora['DESCRIPCION'] == $mora_a_comparar) {
                                    $mora = $det_mora['V_TOTAL'];
                                }
                            }
                        }
                        printer_draw_text($enlace, utf8_decode($mora), ((240 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total de la factura
                        $sub_total = $det['V_TOTAL'] + $mora + $basico;
                        $sub_total = number_format($sub_total, 2, '.', '');
                        printer_draw_text($enlace, utf8_decode($sub_total), ((265 - $menorar_x) * $mm_px), $sumador_de_lineas_y); // V. Total de la factura
                    }

                    $total = $total + $sub_total;
                } //Termina de validar si es FACTURA
            } //Termina de imprimir los detalles
            printer_delete_font($barcode);
            $barcode = printer_create_font("Free 3 of 9 Extended", 35, 23, PRINTER_FW_HEAVY, false, false, false, 0);
            printer_select_font($enlace, $barcode);
            //Al estar imprimiendo guardamos en la base de datos como impreso
            //Fin de impreso el recibo
            /*             * ********************************************************** */





            $total = number_format($total, 2, '.', '');

            printer_draw_text($enlace, 'TOTAL: ' . $total, ((245 - $menorar_x) * $mm_px), ((130 + $menorar_y) * $mm_px));
        } // Fin de cada copia
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$  FIN SE REPITE POR LA COPIA   $$$$$$$$$$$
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // printer_draw_text($enlace, utf8_decode('Areas de lotes m²'), ((25-$menorar_x) * $mm_px), ((93 + $menorar_y) * $mm_px));
        // printer_draw_text($enlace, 'VALVULA: '.$valvulas_repetidos,                           ((25-$menorar_x) * $mm_px), ((98 + $menorar_y) * $mm_px));
        // printer_draw_text($enlace, 'TERRENO: '.$areas,                           ((25-$menorar_x) * $mm_px), ((103 + $menorar_y) * $mm_px));
        // printer_draw_text($enlace, utf8_decode('Total lotes: ' . $contador_terrenos . '    Area total: ' . $area_total . ' m²'), ((25-$menorar_x) * $mm_px), ((108 + $menorar_y) * $mm_px));
        // printer_draw_text($enlace, utf8_decode('Nota: Este comprobante no es válido para legalización de tierras'),             ((21-$menorar_x) * $mm_px), ((113 + $menorar_y) * $mm_px));

        printer_delete_font($barcode);

        //FIN BARCODE
        //*******************************************

        printer_end_page($enlace);
        printer_end_doc($enlace);
        printer_close($enlace);
//Habilitar para reimprimir solo factura
        //echo "<script>javascript:history.go(-1)</script>";
//Habilitar para imprimir recibo
        $this->redirect(array('imprimir_recibo', 'id' => $id));
    }

    public function actionLista_socios_pdf() {
        $model_socios = Socio::model()->findAllBySql('select s.* '
                . ' from socio as s'
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' order by APELLIDO');
        $mpdf = Yii::app()->ePdf->mpdf('utf-8', 'A4', '', '', 10, 10, 32, 22, 8, 8, 'P');
        $mpdf->useOnlyCoreFonts = true;
        $mpdf->SetTitle("LISTA");
        $mpdf->SetAuthor("SISAP");
        $mpdf->SetWatermarkText("``SISAP " . date(Y) . "``");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('lista_socios_pdf', array(
                    'model_socios' => $model_socios,
                        ), true));
        $mpdf->Output('Lista de socios activos ' . date('d M Y') . '.pdf', 'I');
        exit;
    }

    public function actionLista_socios_word() {
        $model_socios = Socio::model()->findAllBySql('select s.* '
                . ' from socio as s'
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' order by APELLIDO');
        $contenido = $this->renderPartial("lista_socios_word", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Socios activos" . ".xls", $contenido);
        $this->render('lista_socios_word', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_socios_excel() {
        $model_socios = Socio::model()->findAllBySql('
            select s.APELLIDO, 
            s.CI, 
            s.CELULAR, 
            s.TELEFONO,
			m.ID_GRUPO as COD_GRUPO,
            m.NUMERO as OBS,
            sm.ID as COD_BARRA'
                . ' from socio as s'
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' order by APELLIDO');
        $contenido = $this->renderPartial("lista_socios_excel", array('model_socios' => $model_socios), true);
        Yii::app()->request->sendFile("Socios activos" . ".xls", $contenido);
        $this->render('lista_socios_excel', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionLista_socios() {
        $model_socios = Socio::model()->findAllBySql('
            select s.APELLIDO, 
            s.CI, 
            s.CELULAR, 
            s.TELEFONO, 
            m.NUMERO as OBS,
            sm.ID as COD_BARRA'
                . ' from socio as s'
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' and s.ESTADO = 1'
                . ' order by APELLIDO');
        $this->render('lista_socios', array(
            'model_socios' => $model_socios,
        ));
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
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and sm.SOLO_ALCANTARILLADO = 0'
                . ' order by s.APELLIDO');
        $this->render('lista_socios_x_grupo', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo,
        ));
    }

    public function actionLista_acometidas_x_grupo() {
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
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' inner join acometida_alcantarillado as aa'
                . ' on sm.ID = aa.ID_SOCIO_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' and aa.INACTIVO = 0'
                . ' order by s.APELLIDO');
        $this->render('lista_acometidas_x_grupo', array(
            'model_socios' => $model_socios,
            'model_grupo' => $model_grupo,
        ));
    }

    public function actionLista_historial_socios() {
        $model_socios = Socio::model()->findAllBySql('
            select s.APELLIDO, 
            s.CI, 
            s.CELULAR, 
            s.TELEFONO,
			m.ID_GRUPO as COD_GRUPO,
            m.NUMERO as OBS,
            sm.ID as COD_BARRA'
                . ' from socio as s'
                . ' inner join socio_medidor as sm'
                . ' on s.CODIGO = sm.CODIGO_SOCIO'
                . ' inner join medidor as m'
                . ' on m.ID = sm.ID_MEDIDOR'
                . ' where sm.INACTIVO=0'
                . ' order by APELLIDO');
        $this->render('lista_historial_socios', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionHistorial_total_consumos() {
        $consumos = Factura::model()->findAllBySql('
        SELECT 
COUNT(*) as `CONSUMO_ANTERIOR`, SUM(`CONSUMO_CALCULADO`) as `CONSUMO_ACTUAL`, `MES_COBRO`, `ANIO_COBRO`
FROM `factura`
WHERE TIPO = 1
and `SOLO_ALCANTARILLADO` = 0
AND `ANIO_COBRO` > 2016
GROUP BY `MES_COBRO`, `ANIO_COBRO`
ORDER BY `ANIO_COBRO`, `MES_COBRO`    
        ');
        $this->render('historial_total_consumos', array(
            'consumos' => $consumos,
        ));
    }

    public function actionLis_soc_sinmedidor() {
        //        $model_socios = Socio::model()->findAllBySql('select s.* '
        //                . ' from socio as s'
        //                . ' inner join socio_medidor as sm'
        //                . ' on s.CODIGO = sm.CODIGO_SOCIO'
        //                . ' where sm.INACTIVO=1'
        //                . ' order by APELLIDO');
        $model_socios = Socio::model()->findAllBySql('select s.* '
                . ' from socio  as s'
                . ' where s.CODIGO not in (select sm.CODIGO_SOCIO from socio_medidor as sm )'
                . ' order by s.APELLIDO');

        $this->render('lis_soc_sinmedidor', array(
            'model_socios' => $model_socios,
        ));
    }

    public function actionExportarMedidas() {
        $socio_medidor = SocioMedidor::model()->findAllBySql('CALL listar_socio_medidor()');
        $contenido = $this->renderPartial("exportarMedidas", array('socio_medidor' => $socio_medidor), true);
        Yii::app()->request->sendFile("Consumo " . gmdate('M') . " del " . gmdate('Y') . ".xls", $contenido);
        $this->render('exportarMedidas', array(
            'socio_medidor' => $socio_medidor,
        ));
    }

    public function actionImportarExcel() {
        $connection_sisap = Yii::app()->db;
        //*********************************************************************
        //*********************************************************************
        // 0.- Aplicar Mora por servicio de agua potable a todos los deudores
        $sql = "CALL aplicar_mora_agua_potable();";
        $command = $connection_sisap->createCommand($sql);
        $rowCount = $command->execute();
        // 0.- Aplicar Mora por servicio de alcantarillado a todos los deudores
        $sql = "CALL aplicar_mora_alcantarillado();";
        $command = $connection_sisap->createCommand($sql);
        $rowCount = $command->execute();
        //*********************************************************************
        //*********************************************************************
         //*********************************************************************
        //*********************************************************************
         // 0.- Aplicar Mora por acometida nueva de agua potable
        $sql = "CALL aplicar_mora_acometida_agua_potable();";
        $command = $connection_sisap->createCommand($sql);
        $rowCount = $command->execute();
        // 0.- Aplicar Mora por acometida de alcantarillado
        $sql = "CALL aplicar_mora_acometida_alcantarillado();";
        $command = $connection_sisap->createCommand($sql);
        $rowCount = $command->execute();
        //*********************************************************************
        //*********************************************************************
        // 1.- Crea las facturas para el mes actual
        $sql = "CALL generar_factura_recibo_del_mes_actual();";
        $command = $connection_sisap->createCommand($sql);
        $rowCount = $command->execute();
        // 2.- Crear rubros básicos
        $sql = "CALL `aplicar_rubros_basicos`();";
        $command = $connection_sisap->createCommand($sql);
        $rows = $command->queryAll();
        // 3.- Aplica los rubros básicos 
        foreach ($rows as $row) { //recorre cada rubro
            $sql = "CALL cobros_rubro_a_todos(" . $row['ID'] . ", " . $row['TIPO'] . ");";
            $command = $connection_sisap->createCommand($sql);
            $rowCount = $command->execute();
        }
        // 4.- Cargar valores por alcantarillado.
        // Busca rubros
        $sqla = "CALL `buscar_rubro_alcantarillado`();";
        $commanda = $connection_sisap->createCommand($sqla);
        $rowsa = $commanda->queryAll();
        // Aplica valor
        foreach ($rowsa as $rowa) { //recorre cada rubro
            $sql = "CALL aplicar_cobro_alcantarillado(" . $rowa['ID'] . ", " . $rowa['TIPO'] . ");";
            $command = $connection_sisap->createCommand($sql);
            $rowCount = $command->execute();
        }
       
        // 5.- Carga el consumo y calcula el valor a cancelar por consumo de agua potable en la vista
        $this->render('importarExcel');
    }

    public function actionCambiarPropietario($id) { //resie el ID de SocioMedidor
        //Socio Medidor
        $model_socioMedidor = SocioMedidor::model()->findByPk($id);
        // ############ ADEUDA  #############
        $sql_deuda = 'SELECT d.ID, SUM(d.`V_TOTAL`) AS V_TOTAL
            FROM detalle AS d
            INNER JOIN factura AS f
            ON d.`ID_FACTURA` = f.`ID`
            INNER JOIN `socio_medidor` AS sm
            ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
            WHERE sm.`ID` = ' . $id
                . ' AND d.`ESTADO` = 0';
        $model_detalle = Detalle::model()->findBySql($sql_deuda);
        if (isset($model_detalle->V_TOTAL)) {
            Yii::app()->user->setFlash('traspaso', 'Se realizó el traspaso 
                    del medidor N°: ' . $model_socioMedidor->iDMEDIDOR->NUMERO
                    . ' del socio ' . $model_socioMedidor->cODIGOSOCIO->APELLIDO
                    . ' y su deuda de ' . $model_detalle->V_TOTAL . ' $ USD.');
            //$this->refresh();
            //  $this->redirect(array('traspaso'));
        }
        // ########### FIN ADEUDA ###########
        //Buscar alcantarillado anexo al servicio de agua potable
        $sql_alcantarillado = "SELECT * FROM `acometida_alcantarillado` AS aa 
                        WHERE aa.`ID_SOCIO_MEDIDOR` = " . $id . " and aa.INACTIVO = 0 limit 1";
        $model_aa = AcometidaAlcantarillado::model()->findBySql($sql_alcantarillado);
        //INGRESAMOS NUEVO SOCIOMEDIDOR 
        $model = new SocioMedidor;
        $model->ID_MEDIDOR = $model_socioMedidor->ID_MEDIDOR;
        $this->performAjaxValidation($model, 'socio-medidor-form');
        //Ingresa el nuevo socio
        if (isset($_POST['SocioMedidor'])) {
            $model->attributes = $_POST['SocioMedidor'];
            //Asignamos el medidor al propietario 
            $model->INACTIVO = 0;
            $model->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            $model->FECHA_INGRESO = date('Y-m-d');
            if ($model->save()) {
                //Desactivamos el anterior
                $model_socioMedidor->INACTIVO = 1;
                $model_socioMedidor->FECHA_SALIDA = date('Y-m-d');
                $model_socioMedidor->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                if ($model_socioMedidor->save()) {
                    //Cargamos la deuda anterior
                    $sql_deuda = 'SELECT f.*
								FROM detalle AS d
								INNER JOIN factura AS f
								ON d.`ID_FACTURA` = f.`ID`
								INNER JOIN `socio_medidor` AS sm
								ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
								WHERE sm.`ID` = ' . $id
                            . ' AND d.`ESTADO` = 0 
								GROUP BY f.ID ';
                    $model_factura_deuda = Factura::model()->findAllBySql($sql_deuda);
                    foreach ($model_factura_deuda as $fac) {
                        $fac->ID_MEDIDOR_SOCIO = $model->ID; //Realizar el cambio 
                        $fac->save();
                    }


                    //2.  Si tiene alcantarillado anexo
                    if (isset($model_aa->ID)) {
                        $model_nueva_aa = new AcometidaAlcantarillado();
                        $model_nueva_aa->ID_SOCIO_MEDIDOR = $model->ID;
                        $model_nueva_aa->ID_GRUPO = $model_aa->ID_GRUPO;
                        $model_nueva_aa->ESTADO = $model_aa->ESTADO;
                        $model_nueva_aa->DESCRIPCION = $model_aa->DESCRIPCION;
                        $model_nueva_aa->INACTIVO = 0;
                        $model_nueva_aa->FECHA_INGRESO = date('Y-m-d H:i:s');
                        $model_nueva_aa->save();
                        //Desactiva la acometida anterior
                        $model_aa->INACTIVO = 1;
                        $model_aa->INACTIVO_DESCRIPCION = "Se realizó el traspaso en conjunto con el médidor del agua potable
                     N°: " . $model_socioMedidor->iDMEDIDOR->NUMERO
                                . ' del socio ' . $model_socioMedidor->cODIGOSOCIO->APELLIDO . ' al socio ' . $model->cODIGOSOCIO->APELLIDO;
                        $model_aa->FECHA_SALIDA = date('Y-m-d H:i:s');
                        $model_aa->save();
                    } //2.- Fin si tiene alcantarillado anexo
                    //3.- Cambiamos los estados de los socios
                    $model_socio_anterior = Socio::model()->findByPk($model_socioMedidor->CODIGO_SOCIO);
                    $model_nuevo_socio = Socio::model()->findByPk($model->CODIGO_SOCIO);

                    /*                     * ******************************************** */
                    /*                     * ******************************************** */
                    //3.1.- Verificar si tienen servicio de agua potable
                    /*                     * ******************************************** */
                    $sql = 'SELECT * FROM `socio_medidor` WHERE INACTIVO = 0 AND `SOLO_ALCANTARILLADO` = 0 AND `CODIGO_SOCIO` = ' . $model_socio_anterior->CODIGO . ' limit 1';
                    $agua_potable = SocioMedidor::model()->findBySql($sql);
                    if (isset($agua_potable->ID) && $agua_potable->ID > 0) {
                        $model_socio_anterior->USU_AGUA_POTABLE = 1;
                    } else {
                        $model_socio_anterior->USU_AGUA_POTABLE = 0;
                    };
                    /*                     * ******************************************** */
                    $sql = 'SELECT * FROM `socio_medidor` WHERE INACTIVO = 0 AND `SOLO_ALCANTARILLADO` = 0 AND `CODIGO_SOCIO` = ' . $model_nuevo_socio->CODIGO . ' limit 1';
                    $agua_potable = SocioMedidor::model()->findBySql($sql);
                    if (isset($agua_potable->ID) && $agua_potable->ID > 0) {
                        $model_nuevo_socio->USU_AGUA_POTABLE = 1;
                    } else {
                        $model_nuevo_socio->USU_AGUA_POTABLE = 0;
                    };
                    /*                     * ******************************************** */
                    /*                     * ******************************************** */
                    //3.2.- Verificar si tienen servicio de alcantarillado
                    $sql = 'SELECT * FROM `socio_medidor` AS sm
                            INNER JOIN `acometida_alcantarillado` AS aa
                            ON aa.`ID_SOCIO_MEDIDOR` = sm.`ID`
                             WHERE aa.INACTIVO = 0 
                             AND sm.`CODIGO_SOCIO` = 
                             ' . $model_socio_anterior->CODIGO . ' limit 1';
                    $agua_potable = SocioMedidor::model()->findBySql($sql);
                    if (isset($agua_potable->ID) && $agua_potable->ID > 0) {
                        $model_socio_anterior->USU_ALCANTARILLADO = 1;
                    } else {
                        $model_socio_anterior->USU_ALCANTARILLADO = 0;
                    };
                    /*                     * ******************************************** */
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
                    //3.3.- Verificamos si tiene q estar activo para los cobros
                    if ($model_socio_anterior->USU_AGUA_POTABLE == 0 && $model_socio_anterior->USU_ALCANTARILLADO == 0) {
                        $model_socio_anterior->PARTICIPA_COMUNIDAD = 0;
                        $model_socio_anterior->ESTADO = 0;
                    } else {
                        $model_socio_anterior->PARTICIPA_COMUNIDAD = 1;
                        $model_socio_anterior->ESTADO = 1;
                    }
                    /*                     * ******************************************** */
                    if ($model_nuevo_socio->USU_AGUA_POTABLE == 0 && $model_nuevo_socio->USU_ALCANTARILLADO == 0) {
                        $model_nuevo_socio->PARTICIPA_COMUNIDAD = 0;
                        $model_nuevo_socio->ESTADO = 0;
                    } else {
                        $model_nuevo_socio->PARTICIPA_COMUNIDAD = 1;
                        $model_nuevo_socio->ESTADO = 1;
                    }
                    //3.4.- Guardar los datos de los socios
                    $model_socio_anterior->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                    $model_socio_anterior->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
                    $model_socio_anterior->save();
                    $model_nuevo_socio->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
                    $model_nuevo_socio->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
                    $model_nuevo_socio->save();
                    //4. VISUALIZAMOS EL CAMBIO REALIZADO
                    $this->redirect(array('medidor/historial_propietarios/', 'id' => $model_socioMedidor->ID_MEDIDOR));
                }
            }
            //  }
        }
        $this->render('cambiarPropietario', array(
            'model' => $model,
            'model_socioMedidor' => $model_socioMedidor,
            'model_detalle' => $model_detalle,
            'model_aa' => $model_aa
        ));
    }

    public function actionBuscar_x_socio($id) {
        //************************
        // BUSCAR ÚLTIMO MEDIDOR ASIGNADO AL SOCIO
        /* $modelos_socio_medidor = SocioMedidor::model()->findAll(
          array("condition" => array("INACTIVO =  0","CODIGO_SOCIO=$id"), "order" => "ID_MEDIDOR")); */

        $modelos_socio_medidor = SocioMedidor::model()->findAllBySql('select * '
                . ' from socio_medidor '
                . ' where  INACTIVO = 0 and CODIGO_SOCIO = ' . $id . ' order by ID_MEDIDOR desc limit 1');

        /* $socio_medidor_nuevo_propietario = SocioMedidor::model()->findAllBySql('select * '
          . 'from socio_medidor '
          . 'where INACTIVO = 0 and CODIGO_SOCIO = ' . $model->CODIGO_SOCIO); */
        $modelo_socio_medidor = new SocioMedidor();
        foreach ($modelos_socio_medidor as $mod) {
            $modelo_socio_medidor = $mod;
        }
        if (isset($modelo_socio_medidor->ID)) { //SOLO UN MEDIDOR
            //throw new CHttpException(400, 'El usuario de agua ya tiene registrado el medidor N°:'.$modelo_socio_medidor->iDMEDIDOR->NUMERO.' a su nombres');
            Yii::app()->user->setFlash('Buscar', 'El socio ' . '<strong>' . $modelo_socio_medidor->cODIGOSOCIO->APELLIDO . '</strong>' . ' ya tiene registrado el medidor ' . '<strong>N°</strong>:' . '<strong>' . $modelo_socio_medidor->iDMEDIDOR->NUMERO . '</strong>' . ' a su nombre');
            //  $this->refresh();
            // $this->redirect(array('socio/bus_ing_medidor'));
        } else {
            Yii::app()->user->setFlash('Buscar', 'El socio no tiene registrado medidores de agua a su nombre');
            //  $this->refresh();
        }
        //INGRESA NUEVO MEDIDOR
        $this->redirect(array('medidor/ingresar_nuevo', 'id' => $id));
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

    public function actionReimprimir($id) { //Recibe ID de factura
        Yii::app()->getSession()->add('factura_cobro', $id);
        $model = Factura::model()->findByPk($id);

        $ultima_factura_fisica = Factura::model()->findBySql('SELECT IF (MAX(`NUMERO_FACTURA`) IS NULL,0, MAX(`NUMERO_FACTURA`))+1 AS NUMERO_FACTURA
FROM factura');
        $toca_factura_fisica = $ultima_factura_fisica->NUMERO_FACTURA;
        $model->NUMERO_FACTURA = $toca_factura_fisica;

        if ($model->save()) {
            $this->redirect(array('imprimir_factura', 'id' => $model->iDMEDIDORSOCIO->CODIGO_SOCIO));
        };
        $this->render('reimprimir', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SocioMedidor;

        $this->performAjaxValidation($model, 'socio-medidor-form');

        if (isset($_POST['SocioMedidor'])) {
            $model->attributes = $_POST['SocioMedidor'];
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

        $this->performAjaxValidation($model, 'socio-medidor-form');

        if (isset($_POST['SocioMedidor'])) {
            $model->attributes = $_POST['SocioMedidor'];
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
        $dataProvider = new CActiveDataProvider('SocioMedidor');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionCambiar() {
        $model = new SocioMedidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SocioMedidor']))
            $model->attributes = $_GET['SocioMedidor'];

        $this->render('cambiar', array(
            'model' => $model,
        ));
    }

    public function actionDerecho_agua() {
        $model = new SocioMedidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SocioMedidor']))
            $model->attributes = $_GET['SocioMedidor'];

        $this->render('derecho_agua', array(
            'model' => $model,
        ));
    }

    public function actionTraspaso() {
        $model = new SocioMedidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SocioMedidor']))
            $model->attributes = $_GET['SocioMedidor'];

        $this->render('traspaso', array(
            'model' => $model,
        ));
    }

    public function actionAdmin() {
        $model = new SocioMedidor('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SocioMedidor']))
            $model->attributes = $_GET['SocioMedidor'];

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
        $model = SocioMedidor::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'socio-medidor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReporte() {
        $sociomedidores = SocioMedidor::model()->findAll();
        $socios = Socio::model()->with('medidor')->findAll();
        $fabianho = "Deberias contratar a Fabianho";
        //var_dump($socios);
        //Yii::app()->end();
        $this->render('reporte', array(
            "fabianho" => $fabianho,
            "socios" => $socios,
            'sociomedidores' => $sociomedidores,
        ));
    }

}
