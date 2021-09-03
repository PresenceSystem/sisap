<?php

/**
 * This is the model base class for the table "socio_medidor".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SocioMedidor".
 *
 * Columns in table "socio_medidor" available as properties of the model,
 * followed by relations of table "socio_medidor" available as properties of the model.
 *
 * @property string $ID
 * @property string $CODIGO_SOCIO
 * @property string $ID_MEDIDOR
 * @property integer $COD_USUARIO
 * @property string $FECHA_ACTUALIZACION
 * @property string $INACTIVO
 * @property string $FECHA_INGRESO
 * @property string $FECHA_SALIDA
 * @property string $SOLO_ALCANTARILLADO
 *  
 *
 * @property Factura[] $facturas
 * @property Socio $cODIGOSOCIO
 * @property Medidor $iDMEDIDOR
 */
abstract class BaseSocioMedidor extends AweActiveRecord {
    //Atributo publico 1,2,3 (principales)
    public $socio_search;
    public $medidor_search;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'socio_medidor';
    }

    public static function representingColumn() {
        //return 'FECHA_ACTUALIZACION';
        return 'iDMEDIDOR.NUMERO';
    }

    public function rules() {
        return array(
            array('CODIGO_SOCIO, ID_MEDIDOR', 'required'),
            array('COD_USUARIO, INACTIVO', 'numerical', 'integerOnly'=>true),
            array('CODIGO_SOCIO, ID_MEDIDOR', 'length', 'max'=>11),
            array('FECHA_INGRESO, FECHA_SALIDA, SOLO_ALCANTARILLADO', 'safe'),
            array('COD_USUARIO', 'default', 'setOnEmpty' => true, 'value' => null),
            array('ID, CODIGO_SOCIO, ID_MEDIDOR, COD_USUARIO, FECHA_ACTUALIZACION, iDMEDIDOR,cODIGOSOCIO, INACTIVO, FECHA_INGRESO, FECHA_SALIDA, SOLO_ALCANTARILLADO', 'safe', 'on'=>'search'),
            array('socio_search, medidor_search', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'facturas' => array(self::HAS_MANY, 'Factura', 'ID_MEDIDOR_SOCIO'),
            'cODIGOSOCIO' => array(self::BELONGS_TO, 'Socio', 'CODIGO_SOCIO'),
            'iDMEDIDOR' => array(self::BELONGS_TO, 'Medidor', 'ID_MEDIDOR'),
            'usuario' => array(self::BELONGS_TO, 'Usuario', 'COD_USUARIO'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'ID' => Yii::t('app', 'ID'),
                'CODIGO_SOCIO' => Yii::t('app', 'Socio N°'),
                'ID_MEDIDOR' => Yii::t('app', 'Medidor N°'),
                
                        'COD_USUARIO' => Yii::t('app', 'Modificado por:'),
                'FECHA_ACTUALIZACION' => Yii::t('app', 'Modificado el:'),
            'INACTIVO' => Yii::t('app', 'INACTIVO'),
                'facturas' => null,
                'cODIGOSOCIO' => null,
                'iDMEDIDOR' => null,
            'socio_search' => ' Nombre del socio',
            'medidor_search' => ' Medidor N°',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
          $criteria->with = array('cODIGOSOCIO','iDMEDIDOR'); //2 Añadiremos a criteria un “with” con la relación “cODIGOSOCIO”              
           //$criteria->with = array( 'iDMEDIDOR' );
          $criteria->together = true; // ADDED THIS
          
        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('APELLIDO', $this->CODIGO_SOCIO);
        $criteria->compare('COD_USUARIO', $this->COD_USUARIO);
        $criteria->compare('FECHA_ACTUALIZACION', $this->FECHA_ACTUALIZACION, true);
         $criteria->compare('FECHA_INGRESO', $this->FECHA_INGRESO, true);
        $criteria->compare('FECHA_SALIDA', $this->FECHA_SALIDA, true);
        $criteria->compare('SOLO_ALCANTARILLADO', $this->SOLO_ALCANTARILLADO, true);        
        $criteria->compare('cODIGOSOCIO.APELLIDO', $this->socio_search, true); // 3 Para poder realizar búsquedas según el “APELLIDO” 
        $criteria->compare('iDMEDIDOR.NUMERO', $this->medidor_search, true);
        $criteria->compare('INACTIVO', 0, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}