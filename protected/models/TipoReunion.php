<?php

Yii::import('application.models._base.BaseTipoReunion');

class TipoReunion extends BaseTipoReunion
{
    /**
     * @return TipoReunion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'TipoReunion|TipoReunions', $n);
    }

}