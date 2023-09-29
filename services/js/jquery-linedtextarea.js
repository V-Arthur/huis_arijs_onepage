/**
 * jQuery Lined Textarea Plugin
 *   http://alan.blog-city.com/jquerylinedtextarea.htm
 * Copyright (c) 2010 Alan Williamson
 * Version: $Id: jquery-linedtextarea.js 464 2010-01-08 10:36:33Z alan $
 * Released under the MIT License: http://www.opensource.org/licenses/mit-license.php
 * Usage:Displays a line number count column to the left of the textarea
 *  Class up your textarea with a given class, or target it directly
 *   with JQuery Selectors: $(".lined").linedtextarea({selectedLine: 10, selectedClass: 'lineselect'});
 */
(function($) {
	$.fn.linedtextarea = function(options) {
		var opts = $.extend({}, $.fn.linedtextarea.defaults, options);
		var fillOutLines = function(codeLines, h, lineNo){
			while ( (codeLines.height() - h ) <= 0 ){
				if ( lineNo == opts.selectedLine ) codeLines.append("<div class='lineno lineselect'>" + lineNo + "</div>");
				else codeLines.append("<div class='lineno'>" + lineNo + "</div>");
				lineNo++;
			}
			return lineNo;
		};
		/*
		 * Iterate through each of the elements are to be applied to
		 */
		return this.each(function() {
			var lineNo = opts.selectedLine;
			var textarea = $(this);
			textarea.attr("wrap", "on");
			textarea.css({resize:"none"});//none
			var originalTextAreaWidth = textarea.outerWidth();
                        if(textarea.parent().attr('class')!='linedtextarea')
                        {
                            //textarea.wrap("<div class='linedtextarea'></div>");
                            var linedTextAreaDiv = textarea.parent().wrap("<div class='linedwrap linedtextarea' style='width:" + originalTextAreaWidth + "px;height:99%'></div>");
                        }
                            var linedWrapDiv = linedTextAreaDiv.parent();
                           linedWrapDiv.prepend("<div class='lines' style='width:50px;height:100%'></div>");
                            var linesDiv = linedWrapDiv.find(".lines");
                            linesDiv.append( "<div class='codelines' style='overflow:hidden'></div>" );
                            var codeLinesDiv	= linesDiv.find(".codelines");
                            lineNo = fillOutLines( codeLinesDiv, textarea.outerHeight(), 1 );
                           linesDiv.css = ( {'height': '99%'} );
                           codeLinesDiv.css( {'margin-top': (-1*textarea.position) + "px"} );
                          /* opts.selectedLine = (lineNo);*/
			if ( opts.selectedLine != -1 && !isNaN(opts.selectedLine) ){
				var fontSize = parseInt( textarea.height() / (lineNo-2) );
				var position = parseInt( fontSize * opts.selectedLine ) - (textarea.height()/2);
				textarea[0].scrollTop = position;
			}
			/* Set the width */
			var sidebarWidth = linesDiv.outerWidth();
			var paddingHorizontal = parseInt( linedWrapDiv.css("border-left-width") ) + parseInt( linedWrapDiv.css("border-right-width") ) + parseInt( linedWrapDiv.css("padding-left") ) + parseInt( linedWrapDiv.css("padding-right") );
			var linedWrapDivNewWidth = originalTextAreaWidth - paddingHorizontal;
			var textareaNewWidth= originalTextAreaWidth - sidebarWidth - paddingHorizontal - 20;
                        var textareaNewHeight= textarea.outerHeight();

			textarea.width( textareaNewWidth );
                        textarea.height( textareaNewHeight );
			linedWrapDiv.width( linedWrapDivNewWidth );
                        //linedWrapDiv.height = $('.text').height();
                        linedWrapDiv.height( textareaNewHeight +8);
                       //linedWrapDiv.css( {'height':'100' + "%"} );
			textarea.scroll( function(tn){
				var domTextArea		= $(this)[0];
				var scrollTop 		= domTextArea.scrollTop;
				var clientHeight 	= domTextArea.clientHeight;//textarea.outerHeight()
				codeLinesDiv.css( {'margin-top': (-1*scrollTop) + "px"} );
				lineNo = fillOutLines( codeLinesDiv, scrollTop + clientHeight, lineNo );
			});
			/* Should the textarea get resized outside of our control */
			textarea.resize( function(tn){
				var domTextArea	= $(this)[0];
				linesDiv.height( domTextArea.clientHeight + 6 );
                                linesDiv.width( domTextArea.clientWidth + 6 );
			});
		});
	};
  $.fn.linedtextarea.defaults = {
  	//selectedLine: -1,
  	selectedClass: 'lineselect'
  };
})(jQuery);