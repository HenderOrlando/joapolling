<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="cuerpo" class="container_12">
        <?php if($sf_user->hasFlash('msg')){?>
            <div id="msg" class="grid_4 push_4 centrar">
                <div class="ui-widget ui-widget-header" style="background: url('<?php echo image_path($sf_user->getAttribute('fondoMsgColegio','test/fondoMsg'))?>') ">
                    <?php echo $sf_user->getFlash('msg')?>
                </div>
            </div>
        <?php } ?>
        <div id="contenido-a" class="ui-widget grid_10 push_1 ui-widget-content">
            <?php echo $sf_content ?>
        </div>
        <div class="ui-widget grid_12" id="pie" style="background: url('<?php echo image_path($sf_user->getAttribute('fondoPieColegio','test/fondoPie')) ?>') repeat-x">
            <span id="copyright" class="centrar">Copyright Hender Orlando Puello Rincón</span>
        </div>
      </div>
  </body>
</html>