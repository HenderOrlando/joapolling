<h1><?php echo $titulo ?></h1>

<?php echo link_to('Inicio', '@homepageEntidadEducativa?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')) ?>
<table class="centrar">
  <thead>
    <tr>
      <?php foreach ($encabezados as $encabezado){ ?>
        <th><?php echo $encabezado ?></th>
      <?php }?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos as $dato){ ?>
        <tr>
            <?php foreach ($encabezados as $encabezado){ ?>
                <td>
                    <?php
                        echo $dato[$encabezado];
                    ?>
                </td>
            <?php }?>
            <td>
                <?php 
                $funcionId = 'getId'.$obj;
                echo link_to('Editar', 'entidadEducativa/actualiza'.$obj.'?nombre='.str_replace(' ', '-', $dato->getNombre()).'&id_'.strtolower($obj).'='.$dato->$funcionId().(isset($dato['id_tipo'])?'&id_tipo='.$dato['id_tipo']:''), array('class' => 'ui-button'))?>
            </td>
        </tr>
    <?php }; ?>
  </tbody>
</table>
