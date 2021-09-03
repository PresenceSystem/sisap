
<?php
/** @var ClaseContableController $this */
/** @var ClaseContable $model */


$this->menu = array(
        //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . ClaseContable::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . ClaseContable::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <div class="container-fluid">
        <legend><h2 class="text-center btn-primary">CATÁLOGO DE CUENTAS</h2></legend>
        <div class="panel panel-info info">
            <div class="panel-heading text-center">
                ESTRUCTURA
            </div>
            <dl>
                <dt>CLASE
                <dd>
                    <dl>
                        <dt>
                        <dd>
                            GRUPO
                            <dl>
                                <dt>
                                <dd>
                                    CUENTA
                                    <dl>
                                        <dt>
                                        <dd>
                                            SUBCUENTA
                                        </dd>
                                        </dt>                                    
                                    </dl>
                                </dd>
                                </dt>
                            </dl>
                        </dd>
                        </dt>
                    </dl>
                </dd>
                </dt>
            </dl>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading text-center">
                CUENTAS CONTABLES
            </div>
            <?php
            echo "<dl>";
            foreach ($lista_clases as $clase) {
                echo "<dt>" . $clase->CODIGO . " " . $clase->CLASE;

                $lista_grupos = GrupoContable::model()->findAllBySql('Select * from grupo_contable where ID_CLASE = ' . $clase->ID);
                foreach ($lista_grupos as $grupo) {
                    echo "<dd>" . $grupo->CODIGO . " " . $grupo->GRUPO;
                    $lista_cuentas = CuentaContable::model()->findAllBySql('Select * from cuenta_contable where ID_GRUPO = ' . $grupo->ID);
                    echo "<dl>";
                    foreach ($lista_cuentas as $cuenta) {
                        ECHO "<td>";
                        echo "<dd>" . $cuenta->CODIGO . " " . $cuenta->CUENTA;
                        $lista_subcuentas = SubcuentaContable::model()->findAllBySql('Select * from subcuenta_contable where ID_CUENTA = ' . $cuenta->ID);
                        echo "<dl>";
                        foreach ($lista_subcuentas as $subcuenta) {
                            ECHO "<td>";
                            echo "<dd>" . $subcuenta->CODIGO . " " . $subcuenta->SUBCUENTA . "</dd>";
                            ECHO "</td>";
                        }
                        echo "</dl>";
                        echo "</dd>";
                        ECHO "</td>";
                    }
                    echo "</dl>";
                    echo "</dd>";
                }

                echo "</dt>";
            }
            echo "<dl>";
            ?>
        </div>
    </div>
</fieldset>
