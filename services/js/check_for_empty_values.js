/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
//-------------superfunction part 1
/*
 * EXAMPLE: THIS CODE YOU PUT ON THE PAGE WHERE THE JS FILE INCLUDED
 $(function() {
    $(".button_check").click(function(){
        $(".formnote").text('');
        check_empty_vals('.class', "this is fout.");
         if($(".formnote").text()!='') return false; else return true;
            $.ajax({
            type:"post",
            url:"pagename.php",
            data:$('.form').serialize(),
            dataType:'text/html',
            cache: false,
            success: function(data)location.reload();
            });
    });
});
*/
//-------------superfunction part 2
 function check_empty_vals(id, text){
    var emailregex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var btwregex = /^[a-zA-Z]{2}[0-9]{10}$/m;
    var btwregex1 = /^[A-Z]{2}\s[0-9]{4}.[0-9]{3}.[0-9]{3}$/m;
    var btwregex2 = /^[A-Z]{2}[0-9]{4}.[0-9]{3}.[0-9]{3}$/m;
    //var rekeningregex = /^[a-zA-Z]{2}[0-9]{14}$/m;
    var noerror  = 0;
    var error  = 0;
    var inputs = $(id);
    var chkid;
    var txt = '';
        for(var i = 0; i < inputs.length; i++){
           var valuex = $.trim((inputs[i]).value);
            inputs.find('option:selected').each(function(){
               if(valuex!='' && id != '.email' && id != '.klantNR') noerror++;
            });
            if(noerror == 0 && id != '.email' && id != '.klantNR'){
               if(valuex!='') noerror++;
            }
            if(id == '.email'){
                var temp = valuex;
                if(((emailregex.test(temp)==false && valuex!=''))){
                    chkid = $(id);
                    txt = text;
                    error++;
                }
            }
            //--klantNR;
             if(id == '.klantNR'){
                var temp = valuex;
                if(btwregex.test($.trim(temp))==false && btwregex1.test($.trim(temp))==false && btwregex2.test($.trim(temp))==false){
                    chkid = $(id);
                    txt = text;
                    error++;
                }
            }
            //--END klantNR
        }
         if(noerror == 0 && id != '.email'  && id != '.klantNR' && error==0){
                chkid = $(id);
                txt = text;
         } else if(error==0 && noerror == 0) txt=''
        returnsomthing($(id), txt, id);
}
//-------------superfunction part 3
function returnsomthing(chkid, txt, id){
        if(txt!=''){
            $(".formnote").text(txt);
            chkid.css({borderColor:"#FF0000"});
        }
        else chkid.css({borderColor:"#DDDDDD"});
}
//-------------end superfunctions