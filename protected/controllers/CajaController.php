<?php

class CajaController extends AweController
{
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
				'actions'=>array('index','view','cerrar','abrir', 'create','update','admin','delete'),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esAdministrador()',
				),
			array('allow', 
				'actions'=>array('view','cerrar','abrir'),
				'expression' => '!Yii::app()->user->isGuest && Usuario::model()->findByPk(Yii::app()->user->id)->esOperador()',
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
			//$$$$$$$$$$$$$$ COMPLETANDO INFORMACIÓN PARA CIERRE DE CAJA $$$$$$$$$$$$$$$$$$$$$$
			 
			 $model->ESTADO = 1; //Cerrado			 
			  			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 1 -- TIPO FACTURA
																AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA ASC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
					$model->FACTURA_DESDE = $detalle_temporal->ID_FACTURA;
			else
				$model->FACTURA_DESDE = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 1 -- TIPO FACTURA
																AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA DESC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->FACTURA_HASTA = $detalle_temporal->ID_FACTURA;
			else
				$model->FACTURA_HASTA = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(COUNT(DISTINCT  d.`FACTURA_COBRA`),0) AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' AND f.`TIPO` = 1');
			$model->TOTAL_FACTURAS = $detalle_temporal->ID_FACTURA;

			 			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA 
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 2 -- TIPO RECIBO'
																.' AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA ASC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->RECIBO_DESDE = $detalle_temporal->ID_FACTURA;
			else
				$model->RECIBO_DESDE = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA 
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 2 -- TIPO RECIBO'
																.' AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA DESC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->RECIBO_HASTA = $detalle_temporal->ID_FACTURA;
			else
				$model->RECIBO_HASTA = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(COUNT(DISTINCT  d.`FACTURA_COBRA`),0) AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' AND f.`TIPO` = 2');
			$model->TOTAL_RECIBOS = $detalle_temporal->ID_FACTURA;

			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(SUM(d.`V_TOTAL`),0) AS V_TOTAL
																FROM detalle AS d 
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR);
			$model->TOTAL = $detalle_temporal->V_TOTAL;

			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(SUM(d.V_TOTAL),0) AS V_TOTAL
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.ID = d.`ID_FACTURA`
																WHERE d.`ESTADO` = 0
																AND f.`MES_COBRO` = MONTH(CURDATE())
																AND f.`ANIO_COBRO` = YEAR(CURDATE())');
			$model->PENDIENTES_PAGO = $detalle_temporal->V_TOTAL;


			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT mc.ID
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID= '.$id
																.' ORDER BY mc.ID ASC
																LIMIT 1');
			if (isset($mcaja_temporal->ID))
				$model->MOV_CAJA_DESDE = $mcaja_temporal->ID;
			else
				$model->MOV_CAJA_DESDE = 0;
			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT mc.ID
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' ORDER BY mc.ID ASC
																LIMIT 1');
			if (isset($mcaja_temporal->ID))
				$model->MOV_CAJA_HASTA = $mcaja_temporal->ID;
			else
				$model->MOV_CAJA_HASTA = 0;
			
		//Movimiento de caja y actualizacion de informacion
		$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT COALESCE(SUM(mc.VALOR),0) AS VALOR
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' AND mc.TIPO = 0 -- Ingresos');
			$model->TOTAL_INGRESOS = $mcaja_temporal->VALOR;
			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT COALESCE(SUM(mc.VALOR),0) AS VALOR
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' AND mc.TIPO = 1 -- Egresos');
			$model->TOTAL_SALIDAS = $mcaja_temporal->VALOR;
			$model->TOTAL_CAJA = $model->TOTAL_INGRESOS - $model->TOTAL_SALIDAS;
			$total_real = ( $model->SALDO_INICIAL
							+ $model->TOTAL 
							+ $model->TARJETAS
							+ $model->BANCOS
							+ $model->TOTAL_CAJA);
			$total_esperado = $model->EFECTIVO;
			$model->DESCUADRE = $total_esperado - $total_real;
			$model->save();
		$this->render('view', array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Caja;

        $this->performAjaxValidation($model, 'caja-form');

        if(isset($_POST['Caja']))
		{
			$model->attributes = $_POST['Caja'];
			if($model->save()) {
                $this->redirect(array('view', 'id' => $model->ID));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}
	public function actionAbrir()
	{
		$model = new Caja;

        $this->performAjaxValidation($model, 'caja-form');

        if(isset($_POST['Caja']))
		{
			$model->attributes = $_POST['Caja'];
			 $model->RECAUDADOR = Yii::app()->getSession()->get('id_usuario');
			 $model->ESTADO = 0;
			if($model->save()) {
                $this->redirect(array('socioMedidor/factura'));
            }
		}

		$this->render('abrir',array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'caja-form');

		if(isset($_POST['Caja']))
		{
			$model->attributes = $_POST['Caja'];
			if($model->save()) {
				$this->redirect(array('view','id' => $model->ID));
            }
		}

		$this->render('update',array(
			'model' => $model,
		));
	}
public function actionCerrar($id)
	{
		$model = $this->loadModel($id);		
		$nuevo_recuento = Recuento::model()->findBySql('select * from recuento where ID_CAJA = '.$id);
		if(isset($nuevo_recuento))
		{
			$model->RECUENTO = $nuevo_recuento->TOTAL;
			$model->EFECTIVO = $nuevo_recuento->TOTAL;
		}
		else
			$nuevo_recuento = new Recuento(); //Limpia recuento si va nuevamente a contar

        $this->performAjaxValidation($model, 'caja-form');
         
          if (isset($_POST['Recuento'])) {
            $nuevo_recuento->attributes = $_POST['Recuento'];
            $nuevo_recuento->COD_USUARIO = Yii::app()->getSession()->get('id_usuario');
            $nuevo_recuento->ID_CAJA = $model->ID;
            if ($nuevo_recuento->save()) {                             
                    $nuevo_recuento = new Recuento();
                    $this->redirect(array('cerrar', 'id' => $id)); // Regresamos a este mismo lugar
                }
            }  

		if(isset($_POST['Caja']))
		{

			



			$model->attributes = $_POST['Caja'];
			//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
			//$$$$$$$$$$$$$$ COMPLETANDO INFORMACIÓN PARA CIERRE DE CAJA $$$$$$$$$$$$$$$$$$$$$$
			 $model->RECAUDADOR = Yii::app()->getSession()->get('id_usuario');
			 $model->ESTADO = 1; //Cerrado			 
			  			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 1 -- TIPO FACTURA
																AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA ASC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
					$model->FACTURA_DESDE = $detalle_temporal->ID_FACTURA;
			else
				$model->FACTURA_DESDE = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 1 -- TIPO FACTURA
																AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA DESC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->FACTURA_HASTA = $detalle_temporal->ID_FACTURA;
			else
				$model->FACTURA_HASTA = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(COUNT(DISTINCT  d.`FACTURA_COBRA`),0) AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' AND f.`TIPO` = 1');
			$model->TOTAL_FACTURAS = $detalle_temporal->ID_FACTURA;

			 			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA 
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 2 -- TIPO RECIBO'
																.' AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA ASC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->RECIBO_DESDE = $detalle_temporal->ID_FACTURA;
			else
				$model->RECIBO_DESDE = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT d.FACTURA_COBRA AS ID_FACTURA 
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND f.`TIPO` = 2 -- TIPO RECIBO'
																.' AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' GROUP BY FACTURA_COBRA
																ORDER BY FACTURA_COBRA DESC
																LIMIT 1');
			if (isset($detalle_temporal->ID_FACTURA))
				$model->RECIBO_HASTA = $detalle_temporal->ID_FACTURA;
			else
				$model->RECIBO_HASTA = 0;
			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(COUNT(DISTINCT  d.`FACTURA_COBRA`),0) AS ID_FACTURA
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.`ID`= d.`ID_FACTURA`
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR
																.' AND f.`TIPO` = 2');
			$model->TOTAL_RECIBOS = $detalle_temporal->ID_FACTURA;

			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(SUM(d.`V_TOTAL`),0) AS V_TOTAL
																FROM detalle AS d 
																WHERE d.`ESTADO` = 1
																AND d.`FECHA_COBRO` >= "'.$model->FECHA
																.'" AND d.COD_USUARIO = '.$model->RECAUDADOR);
			$model->TOTAL = $detalle_temporal->V_TOTAL;

			$detalle_temporal = Detalle::model()->findBySql('SELECT COALESCE(SUM(d.V_TOTAL),0) AS V_TOTAL
																FROM detalle AS d 
																INNER JOIN factura AS f
																ON f.ID = d.`ID_FACTURA`
																WHERE d.`ESTADO` = 0
																AND f.`MES_COBRO` = MONTH(CURDATE())
																AND f.`ANIO_COBRO` = YEAR(CURDATE())');
			$model->PENDIENTES_PAGO = $detalle_temporal->V_TOTAL;


			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT mc.ID
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID= '.$id
																.' ORDER BY mc.ID ASC
																LIMIT 1');
			if (isset($mcaja_temporal->ID))
				$model->MOV_CAJA_DESDE = $mcaja_temporal->ID;
			else
				$model->MOV_CAJA_DESDE = 0;
			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT mc.ID
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' ORDER BY mc.ID ASC
																LIMIT 1');
			if (isset($mcaja_temporal->ID))
				$model->MOV_CAJA_HASTA = $mcaja_temporal->ID;
			else
				$model->MOV_CAJA_HASTA = 0;
			
			
			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT COALESCE(SUM(mc.VALOR),0) AS VALOR
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' AND mc.TIPO = 0 -- Ingresos');
			$model->TOTAL_INGRESOS = $mcaja_temporal->VALOR;
			$mcaja_temporal = MovimientoCaja::model()->findBySql('SELECT COALESCE(SUM(mc.VALOR),0) AS VALOR
																FROM movimiento_caja AS mc
																INNER JOIN caja AS c
																ON mc.`ID_CAJA` = c.`ID`
																AND c.ID='.$id
																.' AND mc.TIPO = 1 -- Egresos');
			$model->TOTAL_SALIDAS = $mcaja_temporal->VALOR;
			$model->TOTAL_CAJA = $model->TOTAL_INGRESOS - $model->TOTAL_SALIDAS;



			$total_real = ( $model->SALDO_INICIAL
							+ $model->TOTAL 
							+ $model->TARJETAS
							+ $model->BANCOS
							+ $model->TOTAL_CAJA);
			$total_esperado = $model->EFECTIVO;
			$model->DESCUADRE = $total_esperado - $total_real;

       		//$$$$$$$$$$$$$$ COMPLETANDO INFORMACIÓN PARA CIERRE DE CAJA $$$$$$$$$$$$$$$$$$$$$$
       		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
			if($model->save()) {
			
		     
        //************************
            //Cerrar Caja
            //@@@@@@@@@@@@@@@@ INACTIVAR A TODOS LOS QUE DEBEN MAS DE 3 MESES @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@q
            /* $model_socios = Socio::model()->findAllBySql('
                    SELECT s.APELLIDO, s.CI, s.CELULAR, s.TELEFONO, m.NUMERO AS OBS, 
                    COUNT(f.ID) AS COD_USUARIO, sm.ID as FECHA_ACTUALIZACION, sm.INACTIVO as FECHA_INGRESO
                             FROM socio AS s
                            INNER JOIN socio_medidor AS sm
                             ON s.CODIGO = sm.CODIGO_SOCIO
                             INNER JOIN medidor AS m
                             ON m.ID = sm.ID_MEDIDOR
                             INNER JOIN factura AS f
                             ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
                             WHERE f.`ESTADO` = 0
                        AND f.`TIPO` = 1            
                             GROUP BY sm.ID
                             ORDER BY s.`APELLIDO`
                        ');
            foreach ($model_socios as $modelo_socio) {
                                if ($modelo_socio->COD_USUARIO >= 3)                                     
                                {
                                     $query = 'UPDATE `socio_medidor`
                                                SET 
                                                  `INACTIVO` = 1  
                                                WHERE `ID` =  '.$modelo_socio->FECHA_ACTUALIZACION;
                                      $command = Yii::app()->db->createCommand($query);
                                      $rowCount=$command->execute();    
                                  }
                              } */
           //@@@@@@@@@@@@@@@@@@@@@@@@@ FIN DE INACTIVAR @@@@@@@@@@@@@@@@@@@@@@@@@@@


            //Fin de cerrar caja
                              	$this->redirect(array('view','id' => $model->ID));
            }
		}
		$this->render('cerrar',array(
			'model' => $model,
			'nuevo_recuento' => $nuevo_recuento,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Caja');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Caja('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Caja']))
			$model->attributes = $_GET['Caja'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id, $modelClass=__CLASS__)
	{
		$model = Caja::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model, $form=null)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'caja-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
