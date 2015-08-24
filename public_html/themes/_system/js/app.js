/**
 * Application JavaScript initialization file
 *
 * Contains the initialization functions and vars that makes the CMS work. 
 * 
 * @category   
 * @package    Page Studio CMS
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @copyright  Cosmo Interactive (c) 2014 http://www.cosmointeractive.co/
 * @license    MIT
 * @version    0.1.0
 * @modified   07/28/2015
 *
 * ---------------------------
 * Table of Contents
 * ---------------------------
 * 	- Document Ready functions
 *		- Twitter Bar remove
 *	- Custom Plugins
 *  - Functions  
 *      - bootstrap switch buttons
 * 		- ui to top
 */ 
 
/**
 * Global variables. If you change any of these vars, don't forget 
 * to change the values in the less files!
 */
$(function() {
    "use strict";

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {

        } else {
            //Else, enable content stretching
            $(".workspace").toggleClass("open-left-pane");
        }
    });
    
    //Enable sidebar toggle if page left-pane already collapse
    $("[data-toggle='tab']").click(function(e) {
        e.preventDefault();
       //Else, enable content stretching
        // $(".workspace").addClass("open-left-pane");
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();

    /*     
     * Add collapse and remove events to boxes
     */
    $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });

    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
    $(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");
     */

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });
    
    /*
     * Initialize SlimScroll plugin
     * ----------------------------
     */
    $('#leftPane').slimScroll({
        wheelStep: 2,
        height: '100%',
        color: '#d0d0d0',
    });
    $('#editPane').slimScroll({
        wheelStep: 2,
        height: '100%',
        color: '#181818',
        animate: 'true'
    });
    
    /**
     * Auto-open bootstrap (3) modal with url hash.
     */
    if (window.location.hash.indexOf("photoEditModal") !== -1) {
        $("#photoEditModal").modal();
    }
    
    /**
     * Checkbox multi-select 
     */
    $('#checkAll').click(function() {
        if ($(this).is(':checked') == true) {
            $('.autoCheck').prop('checked', true);
        } else {
            $('.autoCheck').prop('checked', false);
        }
    });
    
    // /**
     // * Prompt to save before navigating away from page.
     // * @see      http://www.java2s.com/Tutorial/JavaScript/0200__Form/TextareaonChange.htm
     // */
    // $('textarea.mceAdvanced').change(function() {
        // if( $(this).val() != "" ) {
            // window.onbeforeunload = "Are you sure you want to leave?";
        // }
    // });
    
    /**
     * Reset form after bootstrap modal closes
     * 
	 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
	 */ 
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
        $('#display').text("");
    });
    
});

$(function () {
	// $('#datetimepicker6').datetimepicker();
	// $('#datetimepicker7').datetimepicker();
	// $("#datetimepicker6").on("dp.change", function (e) {
		// $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
	// });
	// $("#datetimepicker7").on("dp.change", function (e) {
		// $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
	// });
});

/**
 * INITIALIZE TOOLTIP
 * 
 * Main navigation tooltip
 */
$(document).ready(function(){
    $(".nav-main-tooltip-left").tooltip({placement : 'left'});
    $(".nav-main-tooltip-right").tooltip({placement : 'right'});
    $(".nav-main-tooltip-top").tooltip({placement : 'top'});
    $(".nav-main-tooltip-bottom").tooltip({placement : 'bottom'});
    
    /**
     * Linked datetime pickers
     * @note    Requires the moment library 
     */
    $('#datetime-picker-a').datetimepicker({
        'format' : 'YYYY/MM/DD HH:mm A',
    }).on('dp.change', function(e){
        // https://github.com/eternicode/bootstrap-datepicker/issues/57
        $('#datetime-picker-b').data("DateTimePicker").minDate(e.date);
    });

    // Set default date for time picker after they are clicked
    $('#datetime-picker-b').datetimepicker({
        'format' : 'YYYY/MM/DD HH:mm A'
    }).on("dp.change", function (e) {
        $('#datetime-picker-a').data("DateTimePicker").maxDate(e.date);
    });
});
    
/*
 * --------------------------------------------------------------------------
 * DOCUMENT READY
 * --------------------------------------------------------------------------
 */
(function($){
	$(document).ready(function() {
		
		/*-------------------------------------
		 * Dashboard sortable widgets script
		 * @see      http://stackoverflow.com/questions/2509801/jquery-connected-sortable-lists-save-order-to-mysql
		$("#sortable_1, #sortable_2, #sortable_3").sortable(
		{
			connectWith: '.column',
			handle: ".portlet-header",
			placeholder: "portlet-placeholder ui-corner-all",
			update : function () { 			
				$.post( "lib/process-dashboard-sortables.php", 
				{ 
					sort1: $("#sortable_1").sortable('serialize'),
					sort2: $("#sortable_2").sortable('serialize'),
					sort3: $("#sortable_3").sortable('serialize')
				})
				.done(function( data ) {
					//alert( data );
				});
			}
		});
		 */
		
		/*-------------------------------------
		 * Albums module sortable image table rows
		 * @see      http://www.foliotek.com/devblog/make-table-rows-sortable-using-jquery-ui-sortable/
		// Return a helper with preserved width of cells
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
		// Perform actual sorting
		$("#albums-module-table tbody").sortable({
			helper: fixHelper,
			update : function () {
				$.post( "lib/process-album-image-sort.php", 
				{ 
					order: $(this).sortable('serialize')
				})
				.done(function( data ) {
					//alert( data );
				});
			}
		}).disableSelection();
		 */	
        
        // ------------------------------------------------------------------
        
        /**
		 * Page slider sort order update script
         * 
         * @note       base_url is defined in the template footer file. 
         * 
		 * @see        http://stackoverflow.com/questions/2509801/jquery-connected-sortable-lists-save-order-to-mysql
		 * @see        For disabling sortable 
         *             http://stackoverflow.com/questions/18305271/jquery-ui-sortable-error-cannot-call-methods-on-sortable-prior-to-initializat
         */
        // var getUrl = window.location;
        // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + getUrl.pathname.split('/')[2];
		$("#page_slider_list").sortable({
			handle: ".handle",
			// placeholder: "portlet-placeholder ui-corner-all",
			update : function () { 
				$.post(base_url + "application/helpers/process-slider-sort.php",
				{ 
					order: $(this).sortable('serialize')
				})
                // .done(function(data) {
                    // alert( "Success: " + data );
                // })
                .fail(function() {
                    alert( "Error: Your changes were not saved!" );
                });
			}
		});
		
		/*------------------------------------
		 * Apply dataTable plugin to specific tables
		 */
		$('#dataTables-example').dataTable();
		$('#make-searchable').dataTable();
		$('#make-searchable-5').dataTable({ "iDisplayLength": 5 });
		$('#make-searchable-25').dataTable({ "iDisplayLength": 25 });
		$('#view-all-albums').dataTable();
		$('#dataTables-pages').dataTable({
            "iDisplayLength": 25,
            "aaSorting": [[0]]
        });
        
	});
})(window.jQuery);

/**
 * Make iframes full height of browser window
 * 
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @source     http://stackoverflow.com/questions/20125340/can-i-use-jquery-to-resize-an-iframe-to-fill-the-remaining-window-space
 */
$(window).on('load resize', function(){
    $window = $(window);
    $('iframe.fullheight').height(function(){
        return $window.height()-$(this).offset().top;   
    });
});

/*
 * --------------------------------------------------------------------------
 * DOCUMENT READY
 * --------------------------------------------------------------------------
 *  - Script for Delete Warning
 */
function confirmSubmit() {
	var agree = confirm("Are you sure you want to permanently delete this?");
	if (agree)
	return true;
	else
	return false;
}

//custom_alert();
//custom_alert("Display Message");
//custom_alert("Display Message", "Set Title");

/* function custom_alert(output_msg, title_msg){
	if (!title_msg)
		title_msg = 'Alert';

	if (!output_msg)
		output_msg = 'No Message to Display.';

	$("<div></div>").html(output_msg).dialog({
		title: title_msg,
		resizable: false,
		modal: true,
		buttons: {
			"Ok": function() 
			{
				$( this ).dialog( "close" );
			}
		}
	});
}  */

/*
 * Confirm Action Warning 
function confirm_delete(agree) {
	// Get error msg from function 
	if(agree !== undefined)
		return confirm(agree);
	// Else show default confirm
	else 		
		var agree = 'Are you sure?';
		return confirm(agree);
} 
 */

/*
 * Auto Remove ALERT Messages 
 */
$(document).ready(function () {
	fadeMyDiv(4000); //call fade in 3 seconds
});
function fadeMyDiv() {
	$("[AutoHide]").fadeOut(5000);
}

/*
 * Remove Notification Messages 
 */
function deleteline(buttonObj)
{
	var node = buttonObj;
	do {
		node = node.parentNode;
	}
	while
	(node.nodeType != 1 && node.nodeName != 'div');
	node.parentNode.removeChild(node);
}

/*
 * Hide div boxes
 */
jQuery(document).ready(function () {
	//hide a div after 3 seconds
	setTimeout
	(
		function()
		{ 
			jQuery("#imgBox").fadeOut(2000); 
		}, 3000
	);
}); 

/*
 * This script checks and unchecks boxes on a form 
 * Checks and unchecks unlimited number in the group...
 * Pass the Checkbox group name...
 */
function selectToggle(toggle, form) {
	 var myForm = document.forms[form];
	 for( var i=0; i < myForm.length; i++ ) { 
		  if(toggle) {
			   myForm.elements[i].checked = "checked";
		  } 
		  else {
			   myForm.elements[i].checked = "";
		  }
	 }
}
//  End -->
	
/*
 * --------------------------------------------------------------------------
 * CUSTOM PLUGINS
 * --------------------------------------------------------------------------
 *
 *	(function($){
 *	 
 *	})(jQuery);
 */ 


/*
 * --------------------------------------------------------------------------
 * FUNCTIONS
 * --------------------------------------------------------------------------
 */
 
/*
 * Bootstrap switch buttons
(function() {
	
	$('.btn-toggle').click(function() {
		$(this).find('.btn').toggleClass('active');  
		
		if ($(this).find('.btn-primary').size()>0) {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		if ($(this).find('.btn-danger').size()>0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		if ($(this).find('.btn-success').size()>0) {
			$(this).find('.btn').toggleClass('btn-success');
		}
		if ($(this).find('.btn-info').size()>0) {
			$(this).find('.btn').toggleClass('btn-info');
		}
		
		$(this).find('.btn').toggleClass('btn-default');
		   
	});

	$('form').submit(function(){
		alert($(this["options"]).val());
		return false;
	});
	
})();
 */