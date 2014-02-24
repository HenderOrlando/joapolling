<?php if(!$sf_user->isAuthenticated()){ ?>
<div class="formulario grid_4 push_4 ui-widget centrar ui-widget-content">
    <?php echo image_tag(image_path($sf_user->getAttribute('logoColegio','test/logo')),array('class' => 'logo', 'title' => 'Colegio '.$sf_user->getAttribute('nombreColegio','Colegio de Prueba')))?><br/>
    <h1>
        <span>Bienvenido al sistema</span><br/>
        <h4>
            <span>Administrador</span>
        </h4><br/>
    </h1>
    <form action="<?php echo url_for('@homepage').(isset($ee)?$ee:'')?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <table class="centrar  no-borde-all">
            <tbody>
                <?php echo $form; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Entrar">
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
<?php } elseif(isset($menu)){ ?>
    <?php foreach ($menu as $opt){ ?>
        <?php echo link_to($opt['nombre'], '@'.$opt['accion'],array('class' => 'ui-button')) ?>
    <?php } ?>
<?php } ?>