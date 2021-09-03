<?php

Yii::import('application.models._base.BaseSocio');

class Socio extends BaseSocio
{
 
    /**
     * @return Socio
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Socio|Socios', $n);
    }

}