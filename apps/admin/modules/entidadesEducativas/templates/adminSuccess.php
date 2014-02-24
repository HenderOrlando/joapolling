
<div class="centrar">
    <h1>Administrando Entidad Educativa <?php echo $ee->getAbreviatura()?></h1>
    <?php foreach ($menu as $opt){ ?>
        <?php echo link_to('"'.$opt['nombre'].'"', '@'.$opt['accion'].'?nombre='.$ee->getAbreviatura().'&id_entidad_educativa='.$ee->getIdEntidadEducativa()).'<br/>' ?>
    <?php } ?>
    <br/>
    <br/>
    <?php if(isset($administrador) && !is_null($administrador)){?>
    <?php echo link_to('El administrador es "'.$administrador->getNombre().'"', '@actualizaAdministrador'.'?nombre='.$ee->getAbreviatura().'&id_entidad_educativa='.$ee->getIdEntidadEducativa().'&administrador='.$administrador->getIdPersona()).'<br/>' ?>
    <?php } ?>
    <?php echo link_to('Inicio', '@homepage') ?>
</div>