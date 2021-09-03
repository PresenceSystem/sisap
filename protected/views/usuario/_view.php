<?php
/** @var UsuarioController $this */
/** @var Usuario $data */
?>
<table>
    <tr> 
        <td class="text-center" width='200px'>
            <?php if (!empty($data->foto)): ?>
                        <?php //echo CHtml::encode($data->foto); ?>
                        <?php
                        if ($data->foto != null or $data->foto != '') {
                            $foto = Yii:: app()->baseUrl . "/images/fotos/" . $data->foto;
                        } else {
                            $foto = Yii:: app()->baseUrl . "/images/iconos_del_sistema/usuario/usuario.png";
                        }
                        ?>
                        <img src='<?php echo $foto; ?>' border=0 style="border:0;margin:0;padding:0" width="100px" /><br>
                 <?php endif; ?>
        </td>
        <td>
            <div class="view">
                <h4 class="alert-info text-center"> .</h4>                  
                <?php if (!empty($data->username)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::encode($data->username); ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if (!empty($data->nombres)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('nombres')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::encode($data->nombres); ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if (!empty($data->email)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::mailto($data->email); ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if (!empty($data->telefono)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::encode($data->telefono); ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if (!empty($data->direccion)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::encode($data->direccion); ?>
                        </div>
                    </div>

                <?php endif; ?>



                <?php /* if (!empty($data->id_referencia)): ?>
                  <div class="field">
                  <div class="field_name">
                  <b><?php echo CHtml::encode($data->getAttributeLabel('id_referencia')); ?>:</b>
                  </div>
                  <div class="field_value">
                  <?php echo CHtml::encode($data->id_referencia); ?>
                  </div>
                  </div>

                  <?php endif; */ ?>

                <?php if (!empty($data->rol->Rol)): ?>
                    <div class="field">
                        <div class="field_name">
                            <b><?php echo CHtml::encode($data->getAttributeLabel('Rol')); ?>:</b>
                        </div>
                        <div class="field_value">
                            <?php echo CHtml::encode($data->rol->Rol); ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php /* if (!empty($data->codigo_barra)): ?>
                  <div class="field">
                  <div class="field_name">
                  <b><?php echo CHtml::encode($data->getAttributeLabel('codigo_barra')); ?>:</b>
                  </div>
                  <div class="field_value">
                  <?php echo CHtml::encode($data->codigo_barra); ?>
                  </div>
                  </div>

                  <?php endif; ?>

                  <?php if (!empty($data->descripcion)): ?>
                  <div class="field">
                  <div class="field_name">
                  <b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
                  </div>
                  <div class="field_value">
                  <?php echo CHtml::encode($data->descripcion); ?>
                  </div>
                  </div>

                  <?php endif; */ ?>
            </div>
        </td>

    </tr>
</table>