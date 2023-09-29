$(function() {
   /*if(typeof sortable !== "undefined")*/ $( ".banner_pics" ).sortable();
   /*if(typeof selectable !== "undefined")*/ $( ".banners_all" ).selectable();
  });
$(document).ready(function() {
    $('.ui-icon-close').click(function(e) {
        get_id_name($(this),'delete')
    });

    $('.deleteallbanners').click(function(e) {
        get_id_name($('.ui-selected'),'delete')
    });
});
/**
 *
 * @param {type} it
 * @returns {undefined}
 */
function get_id_name(it, action){
        var parent_0 = it.parent();
        var parent = $(parent_0).parent();
        //alert(action)
         $(it).each(function () {
             var idd = $(this).attr('id');
             var pdd = parent.attr('id');
             if (typeof idd !== 'undefined') var tid = idd;
             if (typeof pdd !== 'undefined') var tid = pdd;
             //alert(tid)
             if (typeof tid !== 'undefined'){
                $.ajax({
                   type: 'get',
                   url: '',
                   data: 'ajax=1&'+action+'=' +tid,
                   beforeSend: function() {},
                   success: function() {
                        if(typeof tid !=='')  it.slideUp(150,function() { it.remove(); });

                   }
               });
            }
        });
 }
 /**change effects:
    function hide_it(classname){ $(classname).fadeOut(); }
              function callback(classname) { $(classname).fadeIn();};
              function check_checked(which, classname, if_foo, then_foo){
                 var hide =false; $( which ).each(function () { if(this.checked == true) hide = true; });
                 if(hide==true) if_foo(classname); else then_foo(classname);
              }
              function change(which, classname, if_foo, then_foo){ $(which).change(function() { check_checked(which, classname,if_foo,then_foo)}); }
              $(window).on("load", function(){
                check_checked("#leegradio", ".logowegermee",callback,hide_it)
              });
              change("#leegradio", ".logowegermee", callback,hide_it);
  */