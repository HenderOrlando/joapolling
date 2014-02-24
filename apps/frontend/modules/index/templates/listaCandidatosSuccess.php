<div class="grid_1">
    <?php echo link_to('Inicio', '@homepageJurado?abreviatura='.$sf_user->getAttribute('abreviaturaEntidadEducativa'), array('class' => 'ui-button')); ?>
</div>
<?php
use_javascript('flot/jquery.flot.min.js');
use_javascript('flot/jquery.flot.pie.js');
?>
<div class="grid_8 push_1">
    <span class="centrar">
        <h1 class="">
            Conteo de Votación "<?php echo $eleccion=='total'?$eleccion:'de '.$eleccion?>"
        </h1>
    </span>
    <div id="json"><strong>Total de Votantes:</strong> <?php echo $totalVotantes?></div>
    <div id="votos" style="width:500px;height:400px;"></div>
<script type="text/javascript">
    var options = {
        series: {
            pie: { 
                show: true,
                label: {
                    show: false
                },
                offset: {
                    top: 20,
                    left: 50
                },
                stroke: {
                    color: '#FFF',
                    width: 3
                }
            }
        },
        grid: {
            autoHighlight: true,
            hoverable: true,
            clickable: true,
            color: '#000',
            borderWidth: 8,
            borderColor: '#FFF',
            mouseActiveRadius: 10
        },
        legend: {
        position: "nw",
        margin: [-30,10]
    }
    };
    function pieHover(event, pos, obj){
        if (obj){
//                var percent = parseFloat(obj.series.percent).toFixed(2);
                showTooltip({
                    x: pos.pageX,
                    y: pos.pageY,
                    contents: obj.series.label,
                    bgcolor: obj.series.color
                })
                var index = obj.series.label.search('<br/>')
                var label = obj.series.label
                if(index > -1)
                    label = obj.series.label.substring(0,index)
                $('.legendLabel').parents('tr').removeClass('ui-state-hover').end().each(function(){
                    if($(this).text().search(label) || (index < 0 && $(this).text() != label))
                        $(this).parents('tr').addClass('ui-state-hover')
                })
        }else {
            $('.legendLabel').parents('tr').removeClass('ui-state-hover')
            $("#tooltip").remove();
        }
    }
    function pieClick(event, pos, obj){
    /*Ver Foto Candidato*/
        if (!obj)
                return;
	percent = parseFloat(obj.series.percent).toFixed(2);
    }
    function showTooltip(opts) {
        if($('#tooltip').length){
            var texto = $('#tooltip-texto').stop()
                .html(opts.contents)
                .css( {
                    top: opts.y + 5,
                    left: opts.x + 5,
                    opacity: 1
                })
            $('#tooltip-fondo').stop().css( {
                    top: opts.y + 5,
                    left: opts.x + 5,
                    'background-color': opts.bgcolor,
                    height: texto.height()+2,
                    width: texto.width()+3
                })
        }else{
            var tooltip = $('<div id="tooltip"></div>').css({display: 'none'}).appendTo("body").fadeIn(300)
            var texto = $('<div id="tooltip-texto">' + opts.contents + '</div>').css( {
                'font-size':'12pt',
                'font-weight':'bolder',
                'text-align':'center',
                color:'#107010',
                position: 'absolute',
                top: opts.y + 10,
                left: opts.x + 10,
                padding: '7px',
                'background-color': 'transparent',
                opacity: 1
            });
            $('<div id="tooltip-fondo" class="ui-corner-all ui-state-hover"></div>').css( {
                position: 'absolute',
                top: opts.y + 10,
                left: opts.x + 10,
                padding: '5px',
                'background-color': opts.bgcolor,
                opacity: 0.8,
                height: texto.height()+2,
                width: texto.width()+3
            }).appendTo(tooltip);
            texto.appendTo(tooltip)
        }
    }
    $(function(){
            updatePlot();
            setInterval(updatePlot, 10000);
            function updatePlot() {
                $.ajax({
                    url:        '<?php echo url_for($urlAjax)?>',
                    method:     'POST',
                    data:       ({'eleccion': '<?php echo $eleccion?>', 'abreviatura':'<?php echo $sf_user->getAttribute('abreviaturaEntidadEducativa')?>'}),
                    dataType:   'json',
                    success:    function(serie){
                            options.xaxis = {
                                ticks: jsonToArray(serie.xaxis)
                            }
                            $.plot($("#votos"), serie.plot, options);
                            $("#votos").bind("plothover", pieHover);
                            $("#votos").bind("plotclick", pieClick);
                        }
                    });
            }
        })
</script>
