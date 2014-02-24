<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="centrar">
    <h1>Agrega <?php echo isset($fondo) && $fondo != 'Logo' && $fondo != 'Foto'?'Fondo para '.$fondo:$fondo?></h1>
    
    <form action="<?php echo url_for('@agregaFondo?fondo='.$fondo.(isset($nombreCandidato)?'&nombreCandidato='.$nombreCandidato.'&id_candidato='.$id_candidato:'')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <table class="centrar no-borde-all">
        <tfoot>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(false) ?>
                <?php echo link_to('Inicio', '@homepageEntidadEducativa?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'),array('class' => 'ui-button')) ?>
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