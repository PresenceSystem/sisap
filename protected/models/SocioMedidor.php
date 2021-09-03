<?php

Yii::import('application.models._base.BaseSocioMedidor');

class SocioMedidor extends BaseSocioMedidor
{
    /**
     * @return SocioMedidor
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'SocioMedidor|SocioMedidors', $n);
    }

}