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
 * @modified   07/03/2015
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
		$("#page_slider_list").sortable(
		{
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

// function myFunction() {
    // document.getElementById("editor").submit();
// }

//custom_alert();
//custom_alert("Display Message");
//custom_alert("Display Message", "Set Title");

/* function custom_alert(output_msg, title_msg)
{
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
function confirm_delete(agree) 
{
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
/* (function($){
	// Easy pie charts
	var calendar = $('#calendar').fullCalendar({
	header: {
		left: 'prev,next',
		center: 'title',
		right: 'today month,basicWeek,basicDay'
	},
	selectable: true,
	selectHelper: true,
	select: function(start, end, allDay) {
		var title = prompt('Event Title:');
		if (title) {
			calendar.fullCalendar('renderEvent',
				{
					title: title,
					start: start,
					end: end,
					allDay: allDay
				},
				true // make the event "stick"
			);
		}
		calendar.fullCalendar('unselect');
	},
	droppable: true, // this allows things to be dropped onto the calendar !!!
	drop: function(date, allDay) { // this function is called when something is dropped
	
		// retrieve the dropped element's stored Event Object
		var originalEventObject = $(this).data('eventObject');
		
		// we need to copy it, so that multiple events don't have a reference to the same object
		var copiedEventObject = $.extend({}, originalEventObject);
		
		// assign it the date that was reported
		copiedEventObject.start = date;
		copiedEventObject.allDay = allDay;
		
		// render the event on the calendar
		// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
		$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		
		// is the "remove after drop" checkbox checked?
		if ($('#drop-remove').is(':checked')) {
			// if so, remove the element from the "Draggable Events" list
			$(this).remove();
		}
		
	},
	editable: true,
	defaultDate: '2014-06-12',
	// US Holidays
	events: [
				{
					gcalFeed: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
					color: '#00A65A',   // an option!
					textColor: '#fff' // an option!
				},
				{
					title: 'All Day Event',
					start: '2014-06-01',
					allDay: true
				},
				{
					title: 'Long Event',
					start: '2014-06-07T16:30:00',
					end: '2014-06-10T13:30:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-06-12T10:30:00',
					end: '2014-06-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-06-12T12:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-06-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-06-28'
				}
			]
	
	});
})(jQuery);
$('#external-events div.external-event').each(function() {

	// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	// it doesn't need to have a start or end
	var eventObject = {
		title: $.trim($(this).text()) // use the element's text as the event title
	};
	
	// store the Event Object in the DOM element so we can get to it later
	$(this).data('eventObject', eventObject);
	
	// make the event draggable using jQuery UI
	$(this).draggable({
		zIndex: 999999999,
		revert: true,      // will cause the event to go back to its
		revertDuration: 0  //  original position after the drag
	});
	
}); */




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

/*
 * --------------------------------------------------------------------------
 * UItoTop jQuery Plugin 1.1
 * http://www.mattvarone.com/web-design/uitotop-jquery-plugin/
 * --------------------------------------------------------------------------
 */
(function($){
	$.fn.UItoTop = function(options) {

 		var defaults = {
			text: 'To Top',
			min: 200,
			inDelay:600,
			outDelay:400,
  			containerID: 'toTop',
			containerHoverID: 'toTopHover',
			scrollSpeed: 1200,
			easingType: 'linear'
 		};

 		var settings = $.extend(defaults, options);
		var containerIDhash = '#' + settings.containerID;
		var containerHoverIDHash = '#'+settings.containerHoverID;
		
		$('body').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
		$(containerIDhash).hide().click(function(){
			$('html, body').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
			$('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay, settings.easingType);
			return false;
		})
		.prepend('<span id="'+settings.containerHoverID+'"></span>')
		.hover(function() {
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 1
				}, 600, 'linear');
			}, function() { 
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 0
				}, 700, 'linear');
			});
					
		$(window).scroll(function() {
			var sd = $(window).scrollTop();
			if(typeof document.body.style.maxHeight === "undefined") {
				$(containerIDhash).css({
					'position': 'absolute',
					'top': $(window).scrollTop() + $(window).height() - 50
				});
			}
			if ( sd > settings.min ) 
				$(containerIDhash).fadeIn(settings.inDelay);
			else 
				$(containerIDhash).fadeOut(settings.Outdelay);
		});

    };
})(jQuery);