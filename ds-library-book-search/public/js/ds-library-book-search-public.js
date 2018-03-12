jQuery(document).ready(function($){

	

	/** 'use strict';
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 console.log("bfr ");
 var GreetingAll = jQuery("#GreetingAll").val();
jQuery("#PleasePushMe").click(function(){ jQuery.ajax({
  type: 'POST',
  url: DSlbsAjax.ajaxurl,
  data: {
  action: 'MyAjaxFunction',
  GreetingAll: GreetingAll,
  },
  success: function(data, textStatus, XMLHttpRequest){ console.log("success");
  jQuery("#test-div1").html('');
  jQuery("#test-div1").append(data);
  },
  error: function(MLHttpRequest, textStatus, errorThrown){console.log("err");
  alert(errorThrown);
  }
  });
  }); 

})( jQuery );
