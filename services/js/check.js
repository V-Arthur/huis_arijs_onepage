$body = $("body");
var sendDate = (new Date()).getTime();
timer(sendDate);
//timeout = setTimeout(timer(sendDate), 1000);
$(function() {
    //$("#datepicker").datepicker();//DP without year selection
    $( document ).tooltip();
    $(".ui-selectable" ).selectable();
    $('.accordion').accordion({collapsible: true,heightStyle: "content",event: "click hoverintent",active:true});
    
    if ($(".datepicker")[0]){
        $('.datepicker').datetimepicker({
            timepicker:false, lang:'nl', format:'Y-m-d'
        });
    }
    
    if ($(".timepicker")[0]){
        $('.timepicker').datetimepicker({
            datepicker:false,format:'H:i:s',step:5
        });
    }
    
    
   //$("body").on("mouseover", function(){});
    $(".dropdowns").on("click", function(){
         if($( this ).hasClass('dropdowns open'))  $( this ).removeClass('open');
         else {
             $(".dropdowns").removeClass('open');
             $( this ).addClass('open');
         }
     });    
     
 });
 
$(window).on("load", function(){
    $("#loading").removeClass("loading");
    var radial_progress = document.getElementById("radial-progress");
    if(radial_progress != null) radial_progress.style.display='none';
});
function changeValue(id, value){ document.getElementById(id).value = value;}
//----------loading
  function timer(sendDate){
    var hour = 0;
    var sec = 00;
    var tot = (new Date()).getTime();
    var test =   Math.floor(((hour*60 + sec) / 100) * tot);
    setInterval(function(){
    var time =   Math.floor(((hour*60 + sec) / 100) * tot/1000000000);
    if(time>100) time = 99;

    $('#radial-progress').attr('data-progress', time);
    sec++;
    if(sec == 60){
         hour++;
         sec = 0;
         if (hour == 24) hour = 0;
    }
    if(time==1) time = 100;
    }, 350/*test*100*5*//*test :intersting*/);
}
//--------timer
 timer2();
 function timer2(){
     var hours=0;
     var mins=0;
     var secs=0;
    setInterval(function(){
    secs++;
    if(secs== 59){
         mins++;
         secs = 0;
         if (mins == 59) mins = 0;
    }
    if(mins == 59){
         hours++;
         mins = 0;
         if (hours == 24) hours = 0;
    }
    var time =   Math.floor(((hours*60*60 + mins*60 + secs)));
    $('.timer').html('('+time+')  '+hours+':'+mins+':'+secs+'<br/><br/>');
    }, 1000);
}
