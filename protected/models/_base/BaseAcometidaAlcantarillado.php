<?php

/**
 * This is the model base class for the table "acometida_alcantarillado".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AcometidaAlcantarillado".
 *
 * Columns in table "acometida_alcantarillado" available as properties of the model,
 * followed by relations of table "acometida_alcantarillado" available as properties of the model.
 *
 * @property string $ID
 * @property string $ID_SOCIO_MEDIDOR
 * @property string $ID_GRUPO
 * @property string $ESTADO
 * @property string $DESCRIPCIÓN
 * @property integer $INACTIVO
 * @property string $INACTIVO_DESCRIPCION
 * @property string $FECHA_INGRESO
 * @property string $FECHA_SALIDA
 *
 * @property SocioMedidor $iDSOCIOMEDIDOR
 */
abstract class BaseAcometidaAlcantarillado extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'acometida_alcantarillado';
    }

    public static function representingColumn() {
        return 'ESTADO';
    }

    public function rules() {
        return array(
            array('ID_SOCIO_MEDIDOR, ID_GRUPO', 'required'),
            array('INACTIVO', 'numerical', 'integerOnly'=>true),
            array('ID_SOCIO_MEDIDOR, ID_GRUPO', 'length', 'max'=>11),
            array('ESTADO', 'length', 'max'=>200),
            array('INACTIVO_DESCRIPCION, DESCRIPCION', 'length', 'max'=>2000),
            array('FECHA_INGRESO, FECHA_SALIDA', 'safe'),
            array('ESTADO, DESCRIPCION, INACTIVO, INACTIVO_DESCRIPCION, FECHA_INGRESO, FECHA_SALIDA', 'default', 'setOnEmpty' => true, 'value' => null),
            array('ID, ID_SOCIO_MEDIDOR, ID_GRUPO, ESTADO, DESCRIPCION, INACTIVO, INACTIVO_DESCRIPCION, FECHA_INGRESO, FECHA_SALIDA', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'iDSOCIOMEDIDOR' => array(self::BELONGS_TO, 'SocioMedidor', 'ID_SOCIO_MEDIDOR'),
             'iDGRUPO'=>array(self::BELONGS_TO, 'Grupo','ID_GRUPO'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'ID' => Yii::t('app', 'ID'),
                'ID_SOCIO_MEDIDOR' => Yii::t('app', 'Medidor al que esta asociado'),
                'ID_GRUPO' => Yii::t('app', 'Grupo'),
                'ESTADO' => Yii::t('app', 'Estado'),
                'DESCRIPCION' => Yii::t('app', 'Descripción'),
                'INACTIVO' => Yii::t('app', 'Inactivo'),
                'INACTIVO_DESCRIPCION' => Yii::t('app', 'motivo por el cual está inactivo'),
                'FECHA_INGRESO' => Yii::t('app', 'Fecha Ingreso'),
                'FECHA_SALIDA' => Yii::t('app', 'Fecha Salida'),
                'iDSOCIOMEDIDOR' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('ID_SOCIO_MEDIDOR', $this->ID_SOCIO_MEDIDOR);
        $criteria->compare('ID_GRUPO', $this->ID_GRUPO, true);
        $criteria->compare('ESTADO', $this->ESTADO, true);
        $criteria->compare('DESCRIPCION', $this->DESCRIPCION, true);
        $criteria->compare('INACTIVO', $this->INACTIVO);
        $criteria->compare('INACTIVO_DESCRIPCION', $this->INACTIVO_DESCRIPCION, true);
        $criteria->compare('FECHA_INGRESO', $this->FECHA_INGRESO, true);
        $criteria->compare('FECHA_SALIDA', $this->FECHA_SALIDA, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}