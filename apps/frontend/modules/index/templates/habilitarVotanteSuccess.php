
<div class="formulario grid_4 push_4 ui-widget centrar ui-widget-content">
    <?php echo image_tag(image_path($sf_user->getAttribute('logoColegio','test/logo')),array('class' => 'logo', 'title' => 'Colegio '.$sf_user->getAttribute('nombreColegio','Colegio de Prueba')))?><br/>
    <h1>
        <span>Habilitando Votantes</span><br/>
        <h4>
            <span>en Mesa <?php echo $sf_user->getAttribute('mesa')?></span>
        </h4><br/>
    </h1>
    <form action="<?php echo url_for('@habilitaVotante?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <table class="centrar no-borde-all">
            <tbody>
                <?php echo $form; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Habilitar">
                        <br/>
                        <?php echo link_to('Inicio', '@homepageJurado?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>