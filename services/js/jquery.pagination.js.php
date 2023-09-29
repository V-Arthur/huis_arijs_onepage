<script  type='text/javascript'>
 /**
 * Pagination (based ont he script from  http://web.enavu.com) : JS / PHP mix
 * Debugged and simplified AND IMPROVED by: Evstratova-Bourgois Ekaterina Urievna(ASU.K8)
 * Contact webvisio@webvisiondesign.net
 * Created 07/08/2015
 */
   $('.hiden').css('display', 'none');
   $(document).ready(function(){
           $('#page_navigation').html("<?php echo $navigation?>");
           $('#page_navigation .page_link:first').addClass('active_page');
           $('#content').children().slice(0, <?php echo $per_page?>).css('display', ''); 
   });

    function previous(){
    var new_page = parseInt($('#current_page').val())-1;
    if(new_page>=0) go_to_page(new_page);
    }
    function next(pages){
      
            var new_page = parseInt($('#current_page').val())+1;
            //  alert(new_page)
            if(new_page<pages) go_to_page(new_page);
    }
   function go_to_page(pager_num){
           var show_per_page = <?php echo $per_page?>;
           var start_from = pager_num * show_per_page;
           var end_on = start_from + show_per_page;
           $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', '');
           $('.page_link[longdesc=' + pager_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
           $('#current_page').val(pager_num);
          
   }

</script>

