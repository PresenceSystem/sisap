<?php

/**
 * This is the model base class for the table "subcuenta_contable".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SubcuentaContable".
 *
 * Columns in table "subcuenta_contable" available as properties of the model,
 * followed by relations of table "subcuenta_contable" available as properties of the model.
 *
 * @property string $ID
 * @property string $ID_CUENTA
 * @property string $CODIGO
 * @property string $SUBCUENTA
 * @property integer $COD_USUARIO
 * @property string $FECHA
 * 
 * @property integer $MORA
 *
 * @property CuentaContable $iDCUENTA
 */
abstract class BaseSubcuentaContable extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'subcuenta_contable';
    }

    public static function representingColumn() {
        return 'CODIGO';
    }

    public function rules() {
        return array(
            array('ID_CUENTA, CODIGO, SUBCUENTA', 'required'),
            array('COD_USUARIO, MORA', 'numerical', 'integerOnly'=>true),
            array('ID_CUENTA', 'length', 'max'=>11),
            array('CODIGO', 'length', 'max'=>50),
            array('SUBCUENTA', 'length', 'max'=>200),
            array('FECHA', 'safe'),
            array('CODIGO','unique'),
            array('COD_USUARIO, FECHA, MORA', 'default', 'setOnEmpty' => true, 'value' => null),
            array('ID, ID_CUENTA, CODIGO, SUBCUENTA, COD_USUARIO, FECHA, MORA', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'iDCUENTA' => array(self::BELONGS_TO, 'CuentaContable', 'ID_CUENTA'),            
            'rubros' => array(self::HAS_MANY, 'Rubro', 'ID_SUBCUENTA'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'ID' => Yii::t('app', 'ID'),
                'ID_CUENTA' => Yii::t('app', 'Id Cuenta'),
                'CODIGO' => Yii::t('app', 'Codigo'),
                'SUBCUENTA' => Yii::t('app', 'Subcuenta'),
                'COD_USUARIO' => Yii::t('app', 'Cod Usuario'),
                'FECHA' => Yii::t('app', 'Fecha'),
                'iDCUENTA' => null,
            'MORA' => Yii::t('app', 'Aplica mora'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('ID_CUENTA', $this->ID_CUENTA);
        $criteria->compare('CODIGO', $this->CODIGO, true);
        $criteria->compare('SUBCUENTA', $this->SUBCUENTA, true);
        $criteria->compare('COD_USUARIO', $this->COD_USUARIO);
        $criteria->compare('FECHA', $this->FECHA, true);
        $criteria->compare('MORA', $this->MORA, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}