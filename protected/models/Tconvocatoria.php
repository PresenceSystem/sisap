<?php

Yii::import('application.models._base.BaseTconvocatoria');

class Tconvocatoria extends BaseTconvocatoria
{
    /**
     * @return Tconvocatoria
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'convocatoria: |convocatorias: ', $n);
    }

}