/*! based on jQuery UI - v1.11.4 - 2015-03-11
* http://jqueryui.com
* Copyright 2015 jQuery Foundation and other contributors; Licensed MIT
* File that including this JS file must also include "jquery-ui.js" & "select2.js"
*
* Copyright 2015 Ekaterina Evstratova-Bourgois Contact: webvisio@webvisiondesign.net
* Version: 2.1 Timestamp: Th Okt 15 10:53:45 PDT 2015
*
 Licensed under the Apache License, Version 2.0 (the "License"); you may not use this work except in
 compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:
 http://www.apache.org/licenses/LICENSE-2.0
 Unless required by applicable law or agreed to in writing, software distributed under the License is
 distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and limitations under the License.
* */
/**
* //RUN EXAMPLE for use of mix_selectable_select2()
$('.geselecteerde').select2();
 $(function(){
        var klass = 'yourclassname';
        mix_selectable_select2(klass, add_new);// additional class of '.geselecteerde'
    });
*/
/**
 *
 * @param {type} klass
 * @returns {undefined}
 */
  function mix_selectable_select2(klass, add_new){
      $("."+klass+" .select2-results" ).selectable({
        stop: function() {
        var result= $( "."+klass+" .select2-choices" );
        var active1 = 'select2-dropdown-open';
        var active2 = 'select2-container-active';
        $( ".ui-selected", this ).each(function() {
          var index = $(this).text();

          var idfind;
         var rss;
          $("#"+klass+' option:contains(' + index + ')').each(function(){
              if ($(this).text() == index) {
                  $(this).attr('selected', 'selected');
                  $(this).attr('class', 'fld_'+($(this).val()));
                  idfind = $(this).val();
                  return false;
              }
              return true;
          });

          if(idfind!=='undefined' && add_new == true)rss = "<input type='hidden' value='"+index+"' name='new_"+klass+"[]'/>"; else rss=''
           var searresult=
           "<li class='select2-search-choice opt_"+idfind+"'>"+ index+ rss+
            "<a href='javascript:void(0)' "+
            "onclick=\""+
            "$(this).parent().remove();$('."+klass+"').removeClass('"+active1+"');$('."+klass+"').removeClass('"+active2+"');"+
            "$('.inputx').val('');$('.select2-result').removeClass('select2-disabled');$('.fld_"+idfind+"').removeAttr('selected');"+
            "\" class='select2-search-choice-close' tabindex='-1'></a></li>";
          if(add_new == true || (add_new == false && idfind>=0))  result.append(searresult);
        });
        $("."+klass+" .select2-result" ).addClass('select2-disabled');
        $("."+klass).removeClass(active1);
        $("."+klass).removeClass(active2);
        $('.select2-drop').css({"display": "none"});
        $('.select2-search-field').css({"width": "400px", "height": "20px"});
        $('.inputx').val('').focus().css({"width": "250px", "height": "20px"});
        $("."+klass+" .select2-results" ).selectable();
        }
      });
    }
