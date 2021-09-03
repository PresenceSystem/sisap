<?php

Yii::import('application.models._base.BaseTconvocado');

class Tconvocado extends BaseTconvocado
{
    /**
     * @return Tconvocado
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Tconvocado|Tconvocados', $n);
    }

}