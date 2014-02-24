<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="centrar">
    <h1><?php echo ($form->isNew())?'Nuevo': 'Actualizar'?> Candidato</h1>
    
    <form action="<?php echo url_for('@'.($form->getObject()->isNew() ? 'agregaCandidato' : 'actualizaCandidato').(!$form->getObject()->isNew() ? '?id_candidato='.$form->getObject()->getIdCandidato().'&nombre='.$form->getObject()->getNombre() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="centrar no-borde-all">
        <tfoot>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(false) ?>  
                &nbsp;<?php echo link_to('Inicio', '@homepageEntidadEducativa?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')) ?>
                &nbsp;<?php echo link_to('Agregar Persona', '@agregaPersona?tipo=candidato', array('class' => 'ui-button')) ?>
                <?php if (!$form->getObject()->isNew()){ ?>
                    &nbsp;<?php echo link_to('Agregar Foto', '@agregaFotoCandidato?nombreCandidato='.$form->getObject()->getNombre().'&id_candidato='.$form->getObject()->getIdCandidato(), array('class' => 'ui-button')) ?>
                    &nbsp;<?php echo link_to('Borrar', '@actualizaCandidato?id_candidato='.$form->getObject()->getIdCandidato().'&nombre='.$form->getObject()->getNombre().'&borrar=1' , array('method' => 'delete', 'confirm' => 'Está seguro de Borrar la Candidato "'.$form->getObject()->getNombre().'"?', 'class' => 'ui-button')) ?>
                    &nbsp;<?php echo link_to('Agregar Otro', '@agregaCandidato', array('class' => 'ui-button')) ?>
                <?php }; ?>
                <input type="submit" value="Guardar"/>
                <input type="reset" value="Limpiar Formulario"/>
            </td>
        </tr>
        </tfoot>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
    </form>
</div>