
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
                <dt><h1>CLASE</h1>
                <dd>
                    <dl>
                        <dt>
                        <dd>
                            <h2>GRUPO</h2>
                            <dl>
                                <dt>
                                <dd>
                                    <h3>CUENTA</h3>
                                    <dl>
                                        <dt>
                                        <dd>
                                            <h4>SUBCUENTA</h4>
                                            <dl>
                                                <dt>
                                                <dd>
                                                    <h5> RUBRO</h5>
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
                echo "<dt><h1>" . $clase->CODIGO . " " . $clase->CLASE."</h1>";

                $lista_grupos = GrupoContable::model()->findAllBySql('Select * from grupo_contable where ID_CLASE = ' . $clase->ID);
                foreach ($lista_grupos as $grupo) {
                    echo "<dd><h2>" . $grupo->CODIGO . " " . $grupo->GRUPO."</h2>";
                    $lista_cuentas = CuentaContable::model()->findAllBySql('Select * from cuenta_contable where ID_GRUPO = ' . $grupo->ID);
                    echo "<dl>";
                    foreach ($lista_cuentas as $cuenta) {
                        ECHO "<td>";
                        echo "<dd><h3>" . $cuenta->CODIGO . " " . $cuenta->CUENTA."</h3>";
                        $lista_subcuentas = SubcuentaContable::model()->findAllBySql('Select * from subcuenta_contable where ID_CUENTA = ' . $cuenta->ID);
                        echo "<dl>";
                        foreach ($lista_subcuentas as $subcuenta) {
                            ECHO "<td>";
                            if ($subcuenta->MORA == 0){
                               $mens_mora =""; //"(No aplica interes mensual)";
                            } else {
                                $mens_mora = "<b class='badge-warning'>(Aplica interes mensual) </b>";
                            }
                            echo "<dd><h4><a href='".Yii:: app()->baseUrl . "/index.php/subcuentaContable/update/".$subcuenta->ID."' > " .$subcuenta->CODIGO." ". $subcuenta->SUBCUENTA." " . $mens_mora . "</a></h4>";
                                $lista_rubros = Rubro::model()->findAllBySql('Select * from rubro where ID_SUBCUENTA = ' . $subcuenta->ID);
                                echo "<dl>";
                                foreach ($lista_rubros as $rubro) {
                                    ECHO "<td>";
                                    if ($rubro->MORA == 1){
                                        echo "<div class='badge-warning'>";
                                    } else {
                                        echo "<div class=''>";
                                    }                                    
                                    echo "<dd><a href='".Yii:: app()->baseUrl . "/index.php/rubro/solover/".$rubro->ID."' >" . $rubro->ID . " " . $rubro->DESCRIPCION."</a></dd>";
                                    echo "</div>";
                                    ECHO "</td>";
                                }
                                echo "</dl>";
                            echo "</dd>";
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
