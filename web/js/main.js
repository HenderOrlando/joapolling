/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function jsonToArray(json){
    var array = []
    $.each(json, function(i){
        var temp = [i+1,this[i+1]]
        array.push(temp)
    })
    return array;
}

$(function(){
    if($('a#go_to_admin').length){
        if($('a#go_to_admin').attr('href').search('index.php') != -1 || $('a#go_to_admin').attr('href').search('frontend_dev.php') != -1)
            $('a#go_to_admin').attr('href',$('a#go_to_admin').attr('href').replace('index.php', 'backend.php').replace('frontend_', 'backend_'))
        else if ($('a#go_to_admin').attr('href').search('backend.php') != -1 || $('a#go_to_admin').attr('href').search('backend_dev.php') != -1)
            $('a#go_to_admin').attr('href',$('a#go_to_admin').attr('href').replace('backend.php', 'index.php').replace('backend_', 'frontend_'))
    }
    
    if($('#contenido, #contenido-a').children('.formulario').length)
        $('#contenido, #contenido-a').removeClass('ui-widget').removeClass('ui-widget-content');
    
    $('#msg').animate({'top' : '-8px'},2000,function(){
        $(this).delay(8000).animate({'top' : '-30px'},4000);
    }).hover(function(){
        $(this).stop().animate({'top' : '-8px'},2000)
    },function(){
        $(this).stop().animate({'top' : '-30px'},1000)
    })
    $('a.ui-button, input').button();
    $('select').selectmenu({
        maxHeight: 120,
        style:'dropdown',
        menuWidth: 160,
        width: 130
    });
    
    /*MENU*/
    $(".navmenu-h li,.navmenu-v li").hover(
        function() {$(this).addClass("iehover");},
        function() {$(this).removeClass("iehover");}
    );
    /*MENU*/
    /*TABLA*/
    $('.votantes tr:first-child').addClass('ui-corner-left')
    $('.votantes tr:last-child').addClass('ui-corner-left')
    $('.votantes tr').hover(function(){
        $(this).addClass('ui-state-hover ui-corner-all')
    }, function(){
        $(this).removeClass('ui-state-hover ui-corner-all')
    })
    /*TABLA*/
})