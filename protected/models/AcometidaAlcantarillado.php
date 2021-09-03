<?php

Yii::import('application.models._base.BaseAcometidaAlcantarillado');

class AcometidaAlcantarillado extends BaseAcometidaAlcantarillado
{
    /**
     * @return AcometidaAlcantarillado
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'AcometidaAlcantarillado|AcometidaAlcantarillados', $n);
    }

}