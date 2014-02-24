<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="centrar">
    <h1><?php echo ($form->isNew())?'Nueva': 'Actualizar'?> Entidad educativa</h1>
    
    <form action="<?php echo url_for('@'.($form->getObject()->isNew() ? 'agregaEntidad' : 'actualizaEntidad').(!$form->getObject()->isNew() ? '?id_entidad_educativa='.$form->getObject()->getIdEntidadEducativa().'&nombre='.$form->getObject()->getNombre() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="centrar">
        <tfoot>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(false) ?>  
                <?php if (!$form->getObject()->isNew()){ ?>
                    &nbsp;<?php echo link_to('Inicio', '@homepage') ?>
                    &nbsp;<?php echo link_to('Inhabilitar', '@actualizaEntidad?id_entidad_educativa='.$form->getObject()->getIdEntidadEducativa().'&nombre='.$form->getObject()->getNombre().'&inhabilitar=1' , array('method' => 'delete', 'confirm' => 'Está seguro de Inhabilitar la entidad educativa '.$form->getObject()->getNombre().' ('.$form->getObject()->getAbreviatura().')?')) ?>
                    &nbsp;<?php echo link_to('Agregar Otro', '@agregaEntidad') ?>
                <?php }; ?>
                <input type="submit" value="Guardar"/>
                <input type="reset" value="Limpiar Formulario"/>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php echo $form?>
        </tbody>
    </table>
    </form>
</div>