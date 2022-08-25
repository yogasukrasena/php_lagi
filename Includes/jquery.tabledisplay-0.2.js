/*
 * jQuery Table Display
 *
 * Copyright (c) 2008 Gabriel Langhans, Lucas Leite, Maicon Martins
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2008-08-06 14:01:12 +0300 (Wed, 06 Aug 2008) $
 */
(function($){

   $.fn.toggleRow = function() {
      if($(this).css('display')=='none') {
         $(this).showRow();
      } else {
         $(this).hideRow();
      }
   };

   $.fn.hideRow = function() {
      $(this).hide();
   };

   $.fn.showRow = function() {
      if($(this).css('display')=='none'){
         if ($.browser.msie) {
            $(this).css('display', 'block');
         }
         else{
            $(this).css('display', 'table-row');
         }
      }
   };
   
})(jQuery);