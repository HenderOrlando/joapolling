
<?php if(!$sf_user->isAuthenticated()){ ?>
<div class="formulario grid_4 push_4 ui-widget centrar ui-widget-content">
    <?php echo image_tag(image_path($sf_user->getAttribute('logo','joaPolling/logo')),array('class' => 'logo', 'title' => 'JoaPolling'))?><br/>
    <h1>
        <span>Bienvenido al sistema</span><br/>
        <h4>
            <span>SuperAdmin</span>
        </h4><br/>
    </h1>
    <form action="<?php echo url_for('@homepage')?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <table class="centrar">
            <?php echo $form; ?>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Entrar">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php } elseif(isset($entidadesEducativas) && isset($menu)){ ?>
    <?php foreach ($menu as $opt){ ?>
        <?php echo link_to($opt['nombre'], '@'.$opt['accion'], array('class' => 'ui-button')) ?>
    <?php } ?>
<br/>
<br/>
    <?php foreach ($entidadesEducativas as $ee){ ?>
        <?php echo link_to('"'.$ee->getNombre().'"', '@admin?ee='.$ee->getAbreviatura(), array('class' => 'ui-button')).'<br/>' ?>
    <?php } ?>
<?php } ?>