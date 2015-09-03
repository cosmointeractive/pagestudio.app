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
        $template->set('page', array(
            'title' => 'Posts',
            'heading' => 'The entries page',
            'description' => 'This is the entries page',
            'icon' => '<i class="icon x32 icon-tack"></i>'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('posts' , $this->loadEntries());
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
     * Add a entry into the database and build a template view
     * @access  public 
     */
    public function add()
    {
        $errors = array();  // Array to store errors 
        $bc = new Breadcrumb();
        $bc->addCrumb('Entries', BASE_URL . 'entries');
        $bc->addCrumb('Add Entry', BASE_URL . 'entries/add/');
        
        // Load models
        $entries = $this->loadModel('Entries_model');
        
        // Build the template view 
		$template = $this->loadView('entries/entries_new_view');
        $template->addJS(array( 
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        $template->set('page', array(
            'title' => 'New Article',
            'heading' => 'The entries page',
            'description' => 'Use this form to add a new article to your blog', 
            'icon' => '<i class="icon x32 icon-pencil"></i>'
        ));
        
        // Check if update form submitted 
        if(Input::exists('post')) {
            if(Input::get('save')) {
                //** Check if a page title was entered. */
                if( ! Input::get('post_title')) {
                    $errors[] = 'You must at least enter a title for the article before saving.';
                }
                
                /** Enter page details to db if there are no errors. */
                if( empty($errors)) {
                    /** Get current user id from the session */
                    $post_author = Session::get(Config::get('session/user_id'));
                    $entries->addEntry(
                        'cimp_posts', 
                        array(
                            'post_title' => escape_and_addslashes( Input::get('post_title') ),
                            'post_slug' => escape_and_addslashes( make_slug( Input::get('post_title')) ),
                            'post_content' => escape_and_addslashes( Input::get('post_content') ),
                            'post_author' => $post_author,
                            'post_type' => 'post'
                        )
                    );

                    $this->redirect('entries');
                } 
            } 
        } 
        $template->set('errors', $errors);
        $template->set('bread', $bc->makeBread());
		$template->render();
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
        $template->addJS(array( 
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        $template->set('page', array(
            'title' => 'Entry Edit',
            'heading' => 'The entries page',
            'description' => 'This is the entries page',
            'icon' => '<i class="icon x32 icon-pencil"></i>',
            'body_class' => 'bg-grey'
        ));

        // Check if update form submitted 
        if(Input::exists('post')) {                
            if(Input::get('save')) {
                /** Get current user id from the session */
                $post_author = Session::get(Config::get('session/user_id'));
                
                $entries->updateEntry(
                    Input::get('ID'),
                    Input::get('post_title'),
                    Input::get('post_content'),
                    Input::get('post_categories'), 
                    $post_author,
                    Input::get('post_status'), 
                    Input::get('post_visibility'), 
                    Input::get('post_password'), 
                    Input::get('is_featured'), 
                    Input::get('is_sticky'), 
                    Input::get('post_type')
                );
                
                // Get entry value from database
                $entry = $entries->getEntry(Url::segment(2));
                
                // Delete the cached post
                $this->clearCache($entry[0]->post_slug);
            } 
        } else {
            // Get entry value from database
            $entry = $entries->getEntry(Url::segment(2));
        }
        
        $template->set('bread', $bc->makeBread());
        $template->set('entry' , $entry);
        $template->set('categories', $entries->getCategories(Url::segment(2)));
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
        $entries = $this->loadModel('Entries_model');
        if( $entries->deleteEntry(Url::segment(2)) ) {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Event successfully deleted!');
        } else {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Event not deleted!');
        }
        $this->redirect('entries');
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Clear the page cache so latest changes will show
     * 
     * @access     Private
     * @param      string $key The page slug
     * @return     NULL
     */ 
    private function clearCache( $key )
    {
        $c = new Cache(array(
            'name' => Config::get('cache/name'),
            'path' => Config::get('cache/file_path'),
            'extension' => Config::get('cache/extension')
        ));
        
        // Check if chache exists
        if($c->isCached($key)) {
            $c->erase($key);
        }
    }
}

/* End of file entries.php */
/* Location: ./application/controllers/entries.php */