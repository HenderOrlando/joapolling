<div>
    <form id="votar" action="<?php echo url_for('@guardarVoto?eleccion='.$eleccion) ?>" method="POST">
        <div class="clear clearfix"></div>
        <div id="radio-buttonset" class="grid_12">
            <?php $i = 0;?>
            <?php foreach ($candidatos as $candidato){?>
            <div class="grid_4 candidato">
                <input type="radio" id="Candidato_<?php echo $candidato->getNo()?>" name="<?php echo $candidato->getTipo()->getNombre() ?>" value="<?php echo $candidato->getNo()?>" />
                <label for="Candidato_<?php echo $candidato->getNo()?>" class="grid_12">
                    <h4 class="titulo"><?php echo $candidato->getNombre()?></h4>
                    <div class="clear clearfix"></div>
                    <?php if(isset($representa[$candidato->getIdCandidato()])){?>
                        <?php echo image_tag($candidato->getArchivo()->getSrc(),array('class' => 'grid_6 alpha', 'title' => 'Candidato')) ?>
                        <?php echo image_tag($representa[$candidato->getIdCandidato()],array('class' => 'grid_6 omega', 'title' => 'Representante del Candidato')) ?>
                    <?php }else{?>
                        <?php echo image_tag($candidato->getArchivo()->getSrc(),array('class' => 'grid_8 push_2')) ?>
                    <?php } ?>
                    <div class="clear clearfix"></div>
                    <h4 class="titulo"><?php echo $candidato->getNombre()?></h4>
                </label>
            </div>
            <?php } ?>
        </div>
        <div class="clear clearfix"></div>
        <a id="reset" action="#" class="grid_4 alpha ui-button"><h1>Reestablecer</h1><a/>
        <input id="reset1" type="reset" style="display:none"/>
        <a id="submit" action="#" class="grid_4 alpha omega  ui-button"><h1>Votar</h1></a>
        <a id="salir" href="<?php echo url_for('@sal?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'))?>" class="grid_4 omega ui-button"><h1>Abstenerse</h1></a>
    </form>
</div>
<script type="text/javascript">
    $('#votar').click(function(){
        $('input[name=<?php echo $eleccion?>]').parent().children('label').removeAttr('style');
        $('input[name=<?php echo $eleccion?>]:checked').parent().children('label').css({'color':'#FFF','background':'url(<?php echo image_path($sf_user->getAttribute('fondoMsgColegio','test/fondoMsg'))?>)'});
    })
    $('#submit').click(function(){
        $(this).parent('form').each(function(){
            if(confirm('Seguro desea guardar el voto?'))
                this.submit();
        })
        return false;
    })
    $('#salir').click(function(){
        if(!confirm('Desea abstenerse de votar?'))
            return false;
    })
    $('#reset').click(function(){
        $(this).parent('form').each(function(){
            this.reset();
        })
        $('form label').removeAttr('style')
        return false;
    })
</script>