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

class Entries extends MY_Controller 
{	
	public function index()
	{        
        $bc = new Breadcrumb();
        $bc->addCrumb('Entries', BASE_URL . 'entries');
        
		$template = $this->loadView('entries/entries_view');
        $template->addCSS(array( 
            'http://google.com',
            'http://bing.com'
        ));
        $template->set('page', array(
            'title' => 'Entries',
            'heading' => 'The entries page',
            'description' => 'This is the entries page'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('entries' , $this->loadEntries());
		$template->render();
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Load table containing all entries in the database
     * @access      Public 
     */
    public function loadEntries()
    {
        $entries = $this->loadModel('Entries_model');
        $allEntries = $entries->getEntries();
        return $allEntries;
    }
   
    // --------------------------------------------------------------------
    
    /**
     * Method to edit a specific entry
     *
     * Retrieve entry info from database and build a template view
     * @access  public 
     */
    public function edit()
    {
        $bc = new Breadcrumb();
        $bc->addCrumb('Entries', BASE_URL . 'entries');
        $bc->addCrumb('Entry Edit', BASE_URL . 'entries/edit/' . Url::segment(2));
        
        // Load models
        $entries = $this->loadModel('Entries_model');
        
        // Build the template view 
		$template = $this->loadView('entries/entry_edit_view');
        $template->set('page', array(
            'title' => 'Entry Edit',
            'heading' => 'The entries page',
            'description' => 'This is the entries page'
        ));
        
        // Check if update form submitted 
        if(Input::exists('post')) {                
            if(Input::get('submit')) {
                $entries->updateEntry(
                    Input::get('ID'),
                    Input::get('post_title'),
                    Input::get('post_content')
                );
                
                // Get entry value from database
                $entry = $entries->getEntry(Url::segment(2));   
            } 
        } else {
            // Get entry value from database
            $entry = $entries->getEntry(Url::segment(2));   
        }
        $template->set('bread', $bc->makeBread());
        $template->set('entry' , $entry);
		$template->render();
    }
}

/* End of file entries.php */
/* Location: ./application/controllers/entries.php */