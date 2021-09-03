<?php

Yii::import('application.models._base.BaseAsistencia');

class Asistencia extends BaseAsistencia
{
    /**
     * @return Asistencia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Asistencia|Asistencias', $n);
    }

}