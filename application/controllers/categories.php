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
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>   
 */
 
// ------------------------------------------------------------------------

class Categories extends MY_Controller
{	
	public function index()
	{        
        $bc = new Breadcrumb();
        $bc->addCrumb('Categories', BASE_URL . 'categories');
        
		$template = $this->loadView('categories/categories_view');
        $template->addCSS(array( 
            'http://google.com',
            'http://bing.com'
        ));
        $template->set('page', array(
            'title' => 'Categories',
            'heading' => 'The entries page',
            'description' => 'This is the entries page'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('categories' , $this->loadEntries());
		$template->render();
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Load all categories
     * @access      Private 
     */
    private function loadEntries()
    {
        $entries = $this->loadModel('Categories_model');
        $allEntries = $entries->getEntries();
        return $allEntries;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Method to edit a specific entry
     *
     * Add a entry into the database and build a template view
     * @access  public 
     */
    public function add()
    {
        $bc = new Breadcrumb();
        $bc->addCrumb('Categories', BASE_URL . 'categories');
        $bc->addCrumb('Add Entry', BASE_URL . 'categories/add/');
        
        // Load models
        $entries = $this->loadModel('Categories_model');
        
        // Build the template view 
		$template = $this->loadView('categories/categories_new_view');
        $template->set('page', array(
            'title' => 'Add Category',
            'heading' => '',
            'description' => ''
        ));
        
        // Check if update form submitted 
        if(Input::exists('post')) {                
            if(Input::get('save')) {                
                $entries->addEntry(
                    'cimp_categories', 
                    array(
                        'category_title' => escape_and_addslashes( Input::get('category_title') ),
                        'category_slug' => escape_and_addslashes( make_slug(Input::get('category_title')) ),
                        'category_description' => escape_and_addslashes( Input::get('category_description') )
                    )
                ); 
            }
            $this->redirect('categories');              
        } 
        $template->set('bread', $bc->makeBread());
		$template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Update a single category entry in the database 
     * 
     * @param      
     */ 
    public function edit()
    {
        $bc = new Breadcrumb();
        $bc->addCrumb('Categories', BASE_URL . 'categories');
        $bc->addCrumb('Category Edit', BASE_URL . 'categories/edit/' . Url::segment(2));
        
        // Load models
        $entries = $this->loadModel('Categories_model');
        
        // Build the template view 
		$template = $this->loadView('categories/category_edit_view');
        $template->set('page', array(
            'title' => 'Category Edit',
            'heading' => 'The category edit page',
            'description' => ''
        ));
        
        // Check if update form submitted 
        if(Input::exists('post')) {                
            if(Input::get('save')) {
                $entries->updateEntry(
                    Input::get('ID'),
                    Input::get('category_title'),
                    Input::get('category_description')
                );
                
                // Get entry value from database
                $entry = $entries->getEntry(Url::segment(2));   
            } 
        } else {
            // Get entry value from database
            $entry = $entries->getEntry(Url::segment(2));
        }
        $template->set('bread', $bc->makeBread());        
        $template->set('entry', $entry);
		$template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Method to edit a specific entry
     *
     * Retrieve entry info from database and build a template view
     * @access  public 
     */
    public function delete()
    {
        $entries = $this->loadModel('Categories_model');
        if( $entries->deleteEntry(Url::segment(2)) ) {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Category successfully deleted!');
        } else {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Category not deleted!');
        }
        $this->redirect('categories');
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */