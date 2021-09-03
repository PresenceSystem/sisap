<?php

Yii::import('application.models._base.BaseGrupoContable');

class GrupoContable extends BaseGrupoContable
{
    /**
     * @return GrupoContable
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'GrupoContable|GrupoContables', $n);
    }

}