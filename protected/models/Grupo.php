<?php

Yii::import('application.models._base.BaseGrupo');

class Grupo extends BaseGrupo
{
    /**
     * @return Grupo
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Grupo|Grupos', $n);
    }

}