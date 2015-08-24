<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PageStudio
 *
 * A web application for managing website content. For use with PHP 5.4+
 *
 * This application is based on the PHP framework,
 * PIP http://gilbitron.github.io/PIP/. PIP has been greatly altered to
 * work for the purposes of our development team. Additional resources
 * and concepts have been borrowed from CodeIgniter,
 * http://codeigniter.com for further improvement and reliability.
 *
 * @package     PageStudio
 * @author      Cosmo Mathieu <cosmo@cimwebdesigns.com>
 */

// ------------------------------------------------------------------------

class Calendar extends Addons
{
	public function index()
	{
        $this->fullCal(); // load the calendar view by default
    }
    
    // --------------------------------------------------------------------

    /**
     * Load a the events of the website in full month calendar format
     *
     * @access     private
     * @param
     * @return     void
     */
    private function fullCal()
    {
        // $sliders = $this->loadModel(array('module' => 'calendar', 'model' => 'Sliders_model'));
        // $slideshows = $sliders->getSliders();

        $bc = new Breadcrumb();
        $bc->addCrumb('Calendar', BASE_URL . 'addons/load/calendar');

		$template = $this->loadView('fullcalendar_view', 'calendar');
        $template->set('page', array(
            'title' => 'Calendar',
            'heading' => '',
            'description' => 'This plugin allows you to manage the calendar for your site',
            'icon' => '<i class="icon x32 icon-calendar-day"></i>'
        ));        
        $template->addCSS(array(
            'jquery-ui' => BASE_URL . "public_html/themes/_system/css/lib/jquery-ui.min.css",
            'fullcalendar' => BASE_URL . "public_html/themes/_system/css/plugins/fullcalendar/fullcalendar.css",
            'datepicker' => BASE_URL . "public_html/themes/_system/css/plugins/bootstrap-datetimepicker.css",
            // 'fullcalendar-print' => BASE_URL . "public_html/themes/_system/css/plugins/fullcalendar/fullcalendar.print.css"
        ));
        $template->addJS(array(
            'moment'        => BASE_URL . "public_html/themes/_system/js/lib/moment.min.js",
            'fullcalendar'  => BASE_URL . "public_html/themes/_system/js/plugins/fullcalendar/fullcalendar.min.js",
            'datepicker'    => BASE_URL . "public_html/themes/_system/js/plugins/datetime-picker/bootstrap-datetimepicker.min.js",
            'tinyMCE'       => BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            'tinyMCEinit'   => BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        
        $template->addScript(array(
            'init' => APPPATH . 'modules/calendar/views/js/init.php'
        ));

        $template->set('bread', $bc->makeBread());
		$template->render();
    }

    // --------------------------------------------------------------------
	
	public function table()
	{
		$bc = new Breadcrumb();
        $bc->addCrumb('Modules > Calendar', BASE_URL . 'addons/load/calendar/table');
        $bc->addCrumb('Table', BASE_URL . 'addons/load/calendar/table');
        
        $events = $this->loadModel(array('module' => 'calendar', 'model' => 'Calendar_model'));
        $events = $events->getEvents();

		$template = $this->loadView('table_view', 'calendar');
        $template->set('page', array(
            'title' => 'Calendar: Event List',
            'heading' => '',
            'description' => 'This plugin allows you to manage the calendar for your site',
            'icon' => '<i class="icon x32 icon-calendar-day"></i>'
        ));

        $template->set('bread', $bc->makeBread());
        $template->set('events', $events);
		$template->render();
	}
	
    // --------------------------------------------------------------------

    /**
     * Create new slider
     *
     * @param
     * @return     void
     */
    public function add()
    {
        // $errors = array();
        // $sliders = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        // $slideshows = $sliders->getSliders();

        // $bc = new Breadcrumb();
        // $bc->addCrumb('Sliders', BASE_URL . 'addons/load/sliders/add');

        // // Check if update form submitted
        // if(Input::exists('post')) {
            // if(Input::get('save')) {

                // /** Check if a page title was entered. */
                // if( ! Input::get('slider_title')) {
                    // $errors[] = 'You must at least enter a title for the slider before saving.';
                // }

                // /** Enter page details to db if there are no errors. */
                // if( empty($errors)) {
                    // /** Get current user id from the session */
                    // $slider_author = Session::get(Config::get('session/user_id'));

                    // $sliders->addEntry(
                        // 'cimp_pagesliders',
                        // array(
                            // 'slider_title' => escape_and_addslashes( Input::get('slider_title') ),
                            // 'slider_description' => escape_and_addslashes( Input::get('slider_description') ),
                            // 'slider_author' => $slider_author
                        // )
                    // );
                    // // Everything is OK, redirect to the all sliders page
                    // $this->redirect('addons/load/sliders/');
                // }
            // }
        // }

		// $template = $this->loadView('add_view', 'sliders');
        // $template->set('page', array(
            // 'title' => 'New Slider',
            // 'heading' => '',
            // 'description' => 'Create a new slideshow',
            // 'body_class' => 'bg-grey',
            // 'icon' => '<i class="icon x32 icon-media"></i>'
        // ));
        // $template->set('bread', $bc->makeBread());
        // $template->set('errors', $errors);
		// $template->render();
    }
    
    // --------------------------------------------------------------------

    public function edit()
    {        
        $event  = $this->loadModel(array('module' => 'calendar', 'model' => 'Calendar_model'));
        $errors = array();
        
        /**
         * Check if the form was submitted and perform checks and validation
         */
        if(Input::exists('post')) {
            if(Input::get('save')) {

                /** Check if required fields are left empty. */
                if( ! Input::get('title')) {
                    $errors[] = 'The event title cannot be left empty.';
                }
                if( ! Input::get('description')) {
                    $errors[] = 'The event description cannot be left empty.';
                }

                /** Enter the database if there are no errors. */
                if( empty($errors)) {
                    /** Get current user id from the session */
                    $event_author = Session::get(Config::get('session/user_id'));
                    $event_start = date('Y-m-d H:i:s', strtotime(
                            remove_am_pm(
                                Input::get('start')
                            )
                        )
                    );
                    $event_end = date('Y-m-d H:i:s', strtotime(
                            remove_am_pm(
                                Input::get('end')
                            )
                        )
                    );

                    $update = $event->update( Input::get('id'),
                        array(
                            'title' => Input::get('title'),
                            'description' => Input::get('description'),
                            'start' => $event_start,
                            'end' => $event_end,
                            'modified' =>  date('Y-m-d H:i:s', time()),
                            'event_author' => $event_author
                        )
                    );

                    if($update) {
                        Session::set('success', 'Event details updated successfully!');
                    } else {
                        $errors[] = 'Something went wrong and the database was not updated.';
                    }
                }
            }
        } 
        
        /**
         * Load the event information from the database but we'll only display 
         * values from the db if they do not exist in $_POST.
         */
        $event = $event->getEvent(Url::segment(4));
        
        /**
         * Build the template and ready for rendering
         */
		$template = $this->loadView('edit_event_view', 'calendar');
        $template->set('page', array(
            'title' => 'Calendar: Event Edit',
            'heading' => '',
            'description' => 'This plugin allows you to manage the calendar for your site',
            'icon' => '<i class="icon x32 icon-calendar-day"></i>'
        ));
        $template->addCSS(array(
            'datepicker' => BASE_URL . "public_html/themes/_system/css/plugins/bootstrap-datetimepicker.css"
        ));
        $template->addJS(array(
            'moment'        => BASE_URL . "public_html/themes/_system/js/lib/moment.min.js",
            'datepicker'    => BASE_URL . "public_html/themes/_system/js/plugins/datetime-picker/bootstrap-datetimepicker.min.js",
            'tinyMCE'       => BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            'tinyMCEinit'   => BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        $template->set('top_action_buttons', 
            '<input type="button" class="btn btn-primary" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
        );
        $template->set('event', $event);
        $template->set('errors', $errors);
		$template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Delete a slideshow from the database and any associated image(s) with it
     * 
     * @access     Public 
     * @return     bool true|false 
     */
    public function delete()
    {
        $event    = $this->loadModel(array('module' => 'calendar', 'model' => 'Calendar_model'));
        $errors   = array();
        
        if($event->delete(Url::segment(4))) {
            Session::set('success', 'Event deleted successfully!');
        } else {
            Session::set('success', 'Something went wrong and the database was not updated.');
        }
        
        // Everything is OK, redirect to the all sliders page
        $this->redirect('addons/load/calendar/table/');
    }
    
}
