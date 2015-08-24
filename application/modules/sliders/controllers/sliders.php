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

class Sliders extends Addons
{
	public function index()
	{
        $this->getAll();
    }

    private function getAll()
    {
        $sliders = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        $slideshows = $sliders->getSliders();

        $bc = new Breadcrumb();
        $bc->addCrumb('Sliders', BASE_URL . 'addons/load/sliders');

		$template = $this->loadView('all_view', 'sliders');
        $template->set('page', array(
            'title' => 'Sliders',
            'heading' => '',
            'description' => 'This plugin allows you to manage the images for your site',
            'icon' => '<i class="icon x32 icon-media"></i>'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('slideshows', $slideshows);
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
        $errors = array();
        $sliders = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        $slideshows = $sliders->getSliders();

        $bc = new Breadcrumb();
        $bc->addCrumb('Sliders', BASE_URL . 'addons/load/sliders/add');

        // Check if update form submitted
        if(Input::exists('post')) {
            if(Input::get('save')) {

                /** Check if a page title was entered. */
                if( ! Input::get('slider_title')) {
                    $errors[] = 'You must at least enter a title for the slider before saving.';
                }

                /** Enter page details to db if there are no errors. */
                if( empty($errors)) {
                    /** Get current user id from the session */
                    $slider_author = Session::get(Config::get('session/user_id'));

                    $sliders->addEntry(
                        'cimp_pagesliders',
                        array(
                            'slider_title' => escape_and_addslashes( Input::get('slider_title') ),
                            'slider_description' => escape_and_addslashes( Input::get('slider_description') ),
                            'slider_author' => $slider_author
                        )
                    );
                    // Everything is OK, redirect to the all sliders page
                    $this->redirect('addons/load/sliders/');
                }
            }
        }

		$template = $this->loadView('add_view', 'sliders');
        $template->set('page', array(
            'title' => 'New Slider',
            'heading' => '',
            'description' => 'Create a new slideshow',
            'body_class' => 'bg-grey',
            'icon' => '<i class="icon x32 icon-media"></i>'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('errors', $errors);
		$template->render();
    }

    // --------------------------------------------------------------------

    /**
     * Manage slider images
     * @return     void
     */
    public function manage()
    {
        $errors       = array();
        $thumb_width  = 1900;
        $thumb_height = 600;
        $max_width    = 2000;

        $sliders   = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        $slider_id = (Url::segment(4)) ? Url::segment(4) : '';
        $photo_id  = (Url::segment(6)) ? Url::segment(6) : '';
        $slider    = $sliders->getEntry($slider_id);
        /** Get current user id from the session */
        $slider_author = Session::get(Config::get('session/user_id'));
        
        $bc = new Breadcrumb();
        $bc->addCrumb('Sliders', BASE_URL . 'addons/load/sliders/add');

        // Check if update form submitted
        if(Input::exists('post')) {
            if(Input::get('submit') === 'Upload' && Input::exists('upload', 'userfile')) {
                $file = new Photo(
                    ABSPATH . Config::get('slider_upload_path'),
                    'userfile',
                    '',
                    '',
                    $max_width
                );
                
                /**
                 * Create various thumbnail sizes 
                 *
                 * The various size options are set in the config file. Create a thumb for 
                 * for every option set in the config.php file.
                 *
                 * $file->resizeImage(150, 150, 'crop');
                 * $file->saveImage($file->get('upload_path') . $file->get('file_basename') . '-150x150.' . $file->get('file_ext'), 100);
                 */
                foreach(Config::get('thumb_image_size') as $thumb_name => $thumb_dimension) {                   
                    $file->resizeImage($thumb_dimension['width'], $thumb_dimension['height'], 'crop');
                    $file->saveImage($file->get('upload_path') . $file->get('file_basename') . $thumb_name . '.' . $file->get('file_ext'), 100);
                }

                /** Enter page details in db if there are no errors. */
                if( empty($errors)) {
                    $sliders->addPhotoEntry(
                        'cimp_pageslider_entries',
                        array(
                            'photo_filename' => Config::get('slider_upload_path') . $file->get('file_basename') . '.'.$file->get('file_ext'),
                            'photo_title' => escape_and_addslashes( Input::get('image_title') ),
                            'photo_caption' => escape_and_addslashes( Input::get('image_caption') ),
                            'photo_alt' => escape_and_addslashes( make_slug(Input::get('image_title')) ),
                            'mime_type' => escape_and_addslashes( $file->get('mime_type') ),
                            'slider_id' => $slider_id
                        ), 
                        $slider_author, 
                        Url::segment(4)                        
                    );
                    // Everything is OK, redirect to the all sliders page
                    // $this->redirect('addons/load/sliders/');
                }
            } else {
                $errors[] = 'Something went wrong. Please be sure you have selected a file to upload.';
            }
        }
        
        // Process image deletion if delete segment set
        if( ! empty($photo_id) && URl::segment(5) === 'delete') { 
            $photo_info  = $sliders->getPhotoInfo($photo_id);            
            
            foreach($photo_info as $photo) {
                $photo_filename = $photo->photo_filename;
                $mime_type = $photo->mime_type;
            }
            
            // Delete file from the database and directory
            if($sliders->deletePhoto($photo_id, $slider_id, $slider_author)) {
                $this->deletePhoto($photo_filename, $mime_type);
            }
        }
        
        $slider_photos = $sliders->getSliderEntries(Url::segment(4));

        /**
         * Build the template components for the view
         */
        $template = $this->loadView('manage_view', 'sliders');
        $template->set('page', array(
            'title' => $slider[0]->slider_title,
            'heading' => '',
            'description' => 'Manage slideshow',
            'icon' => '<i class="icon x32 icon-media"></i>',
            'body_class' => 'bg-grey'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('errors', $errors);
        $template->set('slider', $slider);
        $template->set('slider_id', $slider_id);
        $template->set('slider_photos', $slider_photos);      // For testing purposes
		$template->render();
    }

    // --------------------------------------------------------------------
    
    /**
     * This function is a support function to manage() 
     *
     */
    private function deletePhoto($photo_filename, $mime_type)
    {
        $filename   = ABSPATH . str_replace("\\", "/", $photo_filename);
        $file_ext   = strtolower(substr(
                        $filename, 
                        strrpos($filename, '.') + 1
                    ));
        $filename_no_ext =  ABSPATH . str_replace("\\", "/", strstr($photo_filename, '.', true));
        
        /** Delete all thumbnails. */
        foreach(Config::get('thumb_image_size') as $thumb_name => $thumb_dimension) {
            $thumb_image = $filename_no_ext . $thumb_name .'.'. $file_ext;
            if(file_exists($thumb_image)) {
                unlink($thumb_image);
            }
        }
        
        /** Delete large image. */
        if(file_exists($filename)) {
            unlink($filename);
            if( ! file_exists($filename)) {
                return true;
            } else {
                // Something went wrong, the file has not been deleted!
            }
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------
    public function photo_edit()
    {
        
    }
    
    // --------------------------------------------------------------------

    public function edit()
    {
        $errors = array();
        $slider_id = Url::segment(4);
        $slider = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        $slideshow = $slider->getSlider($slider_id);
        /** Get current user id from the session */
        $slider_author = Session::get(Config::get('session/user_id'));
        
        $bc = new Breadcrumb();
        $bc->addCrumb('Sliders', BASE_URL . 'addons/load/sliders');

		$template = $this->loadView('edit_slider_view', 'sliders');
        $template->set('page', array(
            'title' => 'Sliders',
            'heading' => '',
            'description' => '',
            'body_class' => 'bg-grey'
        ));
        
        // Check form submission 
        if(Input::exists('post')) {
            if(Input::get('slideshow_edit') === 'true') {
                
                if (Input::get('slider_title')) {                    
                    $template->set('post', $_POST);
                    $update = $slider->updateEntry(
                        escape_and_addslashes( $slider_id ), 
                        escape_and_addslashes( Input::get('slider_title') ),
                        escape_and_addslashes( Input::get('slider_description') ),
                        $slider_author
                    );
                    
                    if( ! $update) {
                        $errors[] = 'The update did not complete successfully.';
                    } else {
                        Session::set('success', 'Slider updated successfully.');
                    }
                } else {
                    $errors[] = 'You must at least enter a title for the slider before saving.';
                }
            }
        }

        $template->set('errors', $errors);
        $template->set('bread', $bc->makeBread());
        $template->set('slideshow', $slideshow);
		$template->render();
    }

    // --------------------------------------------------------------------
    
    /**
     * Delete all images for a given slideshow 
     * 
     * @access     Public 
     * @return     bool true|false 
     */
    public function purge()
    {
        $errors = array();
        $slider_id = Url::segment(4);
        $slider = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        /** Get current user id from the session */
        $slider_author = Session::get(Config::get('session/user_id'));
        
        // Check if a slider ID was provided via URL 
        if ( ! empty($slider_id) && is_numeric($slider_id)) {
            // Get all images for the slider from the database if any            
            $slider_photos = $slider->getSliderEntries($slider_id);
            // var_dump($slider_photos);
            
            // Only attempt to delete images if the slider is not empty 
            if ( ! empty($slider_photos)) {                
                // Delete file from the database and directory
                foreach ($slider_photos as $photo) {
                    // Perform deletion from database 
                    if ($slider->deletePhoto($photo->photo_id, $slider_id, $slider_author)) {
                        $this->deletePhoto($photo->photo_filename, $photo->mime_type);
                    }
                }
            }

            // Redirect to the all sliders page and pass deletion status to the session
            $this->redirect('addons/load/sliders/');
            
        } else {
            $errors[] = 'The slider ID passed via the url is not a number.';
        }
        
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
        $errors = array();
        $slider_id = Url::segment(4);
        $slider = $this->loadModel(array('module' => 'sliders', 'model' => 'Sliders_model'));
        
        // Check if a slider ID was provided via URL 
        if ( ! empty($slider_id) && is_numeric($slider_id)) {
            // Get all images for the slider from the database if any            
            $slider_photos = $slider->getSliderEntries($slider_id);
            // var_dump($slider_photos);
            
            // Only attempt to delete images if the slider is not empty 
            if ( ! empty($slider_photos)) {                
                // Delete file from the database and directory
                foreach ($slider_photos as $photo) {
                    // Perform deletion from database 
                    if ($slider->deletePhoto($photo->photo_id, $slider_id, '')) {
                        // Perform physical file deletion
                        $this->deletePhoto($photo->photo_filename, $photo->mime_type);
                    }
                }
            }
            
            // Perform slider deletion from the database
            $slider->deleteSlider($slider_id);

            // Redirect to the all sliders page and pass deletion status to the session
            $this->redirect('addons/load/sliders/');
            
        } else {
            $errors[] = 'The slider ID passed via the url is not a number.';
        }
        
    }
    
}
