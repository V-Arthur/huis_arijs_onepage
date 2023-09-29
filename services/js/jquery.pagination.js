/**
 *
 * http://web.enavu.com
 */
 $('.hiden').css('display', 'none');
$(document).ready(function(){
        var show_per_page_val = document.getElementById('show_per_page');
        if(show_per_page_val != null) var show_per_page =  show_per_page_val.value; else show_per_page= 22;
	var number_of_items = $('#content').children().size();
	var number_of_pages = Math.ceil(number_of_items/show_per_page);
	$('#current_page').val(0);
	$('#show_per_page').val(show_per_page);
	var navigation_html = '<li><a class="previous_link" href="javascript:previous()">&laquo;Prev</a></li>';
	var current_link = 0;
        //var limit = 0;
        //var link = '';
       //  alert(current_link);
	while(number_of_pages >current_link){
                //if(current_link * 6 >= 12 && limit ==0) limit = current_link * 6; else  limit = 0;//alert('+limit+');
                ///if(limit!=0) link =self.location.href+'&limit='+limit; else link ='';
		navigation_html += '<li><a class="page_link" onclick="" href="javascript:go_to_page(' + current_link +');" longdesc="' + current_link +'">'+ (current_link+1) +'</li></a>';
		current_link++;
               
	}
	navigation_html += '<li><a class="next_link" href="javascript:next(' + current_link +');">Next&raquo;</a></li>';
	$('#page_navigation').html(navigation_html);
	$('#page_navigation .page_link:first').addClass('active_page');
	$('#content').children().css('display', 'none');
        $('.hiden').css('display', '');
	$('#content').children().slice(0, show_per_page).css('display', '');
});

function previous(){
	new_page = parseInt($('#current_page').val())-1;
	if(new_page>=0) go_to_page(new_page);
}
function next(pages){
	new_page = parseInt($('#current_page').val()) + 1;
	if(new_page<pages) go_to_page(new_page);
}
function go_to_page(page_num){
  
	var show_per_page = parseInt($('#show_per_page').val());
	var start_from = page_num * show_per_page;
	var end_on = start_from + show_per_page;
	$('#content').children().css('display', 'none').slice(start_from, end_on).css('display', '');
	$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
	$('#current_page').val(page_num);
}
