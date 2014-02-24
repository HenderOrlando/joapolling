<div class="grid_1">
    <?php echo link_to('Inicio', '@homepageJurado?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')); ?>
</div>
<div class="grid_10 lista-table">
    <table class="centrar">
        <thead>
            <?php if ($paginador->haveToPaginate()): ?>
                <tr>
                    <td colspan="7">
                        <h1>Lista de Votantes</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        Mostrando desde
                        <strong>
                            <?php echo $paginador->getMaxPerPage()*($paginador->getPage()-1) ?>
                        </strong> 
                        hasta
                        <strong>
                            <?php echo $paginador->getMaxPerPage()*$paginador->getPage() > $paginador->count()?$paginador->count(): $paginador->getMaxPerPage()*$paginador->getPage()?>
                        </strong> 
                        de
                        <strong>
                            <?php echo $paginador->getNbResults() ?>
                        </strong> 
                        Votantes Encontrados - pagina 
                        <strong>
                            <?php echo $paginador->getPage() ?>
                        </strong> de 
                        <strong>
                            <?php echo $paginador->getLastPage() ?>
                        </strong>
                        <p>
                            <?php if($paginador->getPage() != $paginador->getFirstPage()){?>
                                <?php echo link_to("«", "@listarVotantes?pagina=".$paginador->getFirstPage(), array('class' => 'ui-button')) ?>
                                <?php echo link_to("<", "@listarVotantes?pagina=".$paginador->getPreviousPage(), array('class' => 'ui-button')) ?>
                            <?php } ?>
                            <?php foreach ($paginador->getLinks() as $page): ?>
                                <?php echo ($page == $paginador->getPage()) ? $page : link_to($page, '@listarVotantes?pagina='.$page, array('class' => 'ui-button')) ?>
                            <?php endforeach ?>
                            <?php if($paginador->getPage() != $paginador->getLastPage()){?>
                                <?php echo link_to(">", "@listarVotantes?pagina=".$paginador->getNextPage(), array('class' => 'ui-button')) ?>
                                <?php echo link_to("»", "@listarVotantes?pagina=".$paginador->getLastPage(), array('class' => 'ui-button')) ?>
                            <?php } ?>
                        </p>
                    </td>
                </tr>
            <?php endif ?>
            <tr class="ui-widget ui-widget-header">
                <td>
                    Votante
                </td>
                <td>
                    Codigo
                </td>
                <td>
                    Curso
                </td>
                <td>
                    Mesa
                </td>
                <td>
                    está Habilitado?
                </td>
                <td>
                    ha votado?
                </td>
            </tr>
        </thead>
        <tbody class="votantes">
            <?php foreach ($paginador->getResults() as $votante){ if($votante->getIdVotante() == 0 || $votante->getIdVotante() == 1) continue; ?>
                <tr id="<?php echo $votante->getIdVotante() ?>" class="ui-widget ui-widget-content">
                    <td>
                        <?php echo $votante->getNombre(); ?>
                    </td>
                    <td>
                        <?php echo $votante->getPersona()->getEstudiante()->getCodCurso(); ?>
                    </td>
                    <td>
                        <?php echo $votante->getPersona()->getEstudiante()->getCursosGrado()->getNombre(); ?>
                    </td>
                    <td>
                        <?php echo $votante->getMesa()->getMesa()->getNombre(); ?>
                    </td>
                    <td>
                        <?php echo $votante->getHabilitado()?'Si':'No'; ?>
                    </td>
                    <td>
                        <?php echo $votante->getFechaVoto() != NULL?'Si':'No'; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>