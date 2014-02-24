<form id="<?php echo $form->getName() ?>" action="<?php echo url_for('@'.$form->getName().'?tipo='.$tipo) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <table cellpadding="10" class="table-form  no-borde-all">
        <?php echo $form?>
        <div class="clearfix clear"></div>
        <tr>
            <td colspan="2">
                <?php echo link_to('Inicio', '@homepageEntidadEducativa?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')) ?>
                <input type="submit" value="Subir el Archivo"/>
                <input type="reset" value="Limpiar"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(true)?>
            </td>
        </tr>
    </table>
</form>