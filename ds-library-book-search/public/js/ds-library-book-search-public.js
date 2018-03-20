jQuery(document).ready(function ($) { 

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
    jQuery("body").delegate("#pager a", "click", function (e) {
        //$( this ).toggleClass( "chosen" );
//});
//jQuery("#pager a").click(function(e){
        e.preventDefault();
        jQuery("#paged").val(jQuery(this).text());
        jQuery("#dslbssearch").trigger('click');
    });
    jQuery("#dslbssearch").click(function () {
        jQuery.blockUI({message: '<h1>Just a moment...</h1>'});
        jQuery.ajax({
            type: 'POST',
            url: DSlbsAjax.ajaxurl,
            data: {
                action: 'AjaxFunction',
                formdata: $("#Ds_library_book_search").serializeObject()
            },
            success: function (data, textStatus, XMLHttpRequest) {
                jQuery.unblockUI();
                jQuery("#output").html('');
                jQuery("#pager").remove();
                jQuery("#output").append(data);
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                console.log("err");
                alert(errorThrown);
            }
        });
    });

    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };


})(jQuery);
