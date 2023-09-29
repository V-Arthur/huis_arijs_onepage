 /**
 * session.language.js (BACKEND)
 * Language selection + session with use of selectbox
 * Created by: Evstratova-Bourgois Ekaterina Urievna(ASU.K8)
 * Contact webvisio@webvisiondesign.net
 */
$(function(lng) {
    var select_box_name= '#identificatiekeuzedd';
    $(select_box_name).change();
    var session_lng = $.session("LANG");
    if(typeof(session_lng)!='undefined') lng = session_lng; else lng ='NL';
    select_lang(lng);
    $(select_box_name).val(lng).prop("selected", "selected");
   });

function select_lang(lang){
    var select_box_name;
    $(select_box_name+" option[value='"+lang+"']").prop('selected', true);
    $.each( ['NL','FR','EN','DE' ], function( i, l ){
         if(lang!=l)$('.identificatie'+l).hide(); else $('.identificatie'+l).show();
   });

 }
function identificatiekeuze(devar){
    $("#identificatiekeuzedd").find('option:selected').each(function(){
    var val_lng =$(this).val();
    var val = 'identificatie'+ val_lng;
    $('.'+val).show();
    if(val_lng=='') val_lng= devar;
    select_lang(val_lng);
    $.session("LANG",val_lng);

    });
}
//$('.datum').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
//$(".geselecteerde").select2({ allowClear:true, closeOnSelect:false });