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

class Pages extends MY_Controller 
{	
	public function index()
	{        
        $bc = new Breadcrumb();
        $bc->addCrumb('Pages', BASE_URL . 'pages');
        
		$template = $this->loadView('pages/pages_view');
        $template->set('page', array(
            'title' => 'Pages',
            'heading' => '',
            'description' => 'Manage pages',
            'icon' => '<i class="icon x32 icon-open-book"></i>'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('pages' , $this->loadEntries());
		$template->render();
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Load table containing all entries in the database
     * @access      Public 
     */
    public function loadEntries()
    {
        $entries = $this->loadModel('Pages_model');
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
        $bc->addCrumb('Pages', BASE_URL . 'pages');
        $bc->addCrumb('Add Page', BASE_URL . 'pages/add/');
        
        // Load models
        $entries = $this->loadModel('Pages_model');
        
        // Check if update form submitted 
        if(Input::exists('post')) {
            if(Input::get('save')) {
                
                /** Check if a page title was entered. */
                if( ! Input::get('page_title')) {
                    $errors[] = 'You must at least enter a title for the page before saving.';
                }
                
                /** Enter page details to db if there are no errors. */
                if( empty($errors)) {                
                    /** Get current user id from the session */
                    $page_author = Session::get(Config::get('session/user_id'));
                    
                    $entries->addEntry(
                        'cimp_pages', 
                        array(
                            'page_title' => escape_and_addslashes( Input::get('page_title') ),
                            'page_slug' => escape_and_addslashes( make_slug(Input::get('page_title')) ),
                            'page_content' => escape_and_addslashes( Input::get('page_content') ),
                            'page_editor' => $page_author
                            // 'page_type' => 'post'
                        )
                    ); 
                    
                    $this->redirect('pages');
                }   
            } 
        } 
        
        // Build the template view 
		$template = $this->loadView('pages/new_page_view');
        $template->addJS(array( 
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        $template->set('page', array(
            'title' => 'New Page',
            'heading' => '',
            'description' => '',
            'icon' => '<i class="icon x32 icon-pencil"></i>'
        ));
        $template->set('top_action_buttons', 
            '<input type="button" class="btn btn-primary" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
        );
        $template->set('errors', $errors);
        // $template->set('bread', $bc->makeBread());
        // options_pane_widget_register(array(
            // 'body' => '<input type="button" class="btn btn-default" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
        // ));
		$template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Method to edit a specific page
     *
     * Retrieve page info from database and build a template view
     * @access  public 
     */
    public function edit()
    {
        $bc = new Breadcrumb();
        // $bc->addCrumb('Pages', BASE_URL . 'pages');
        // $bc->addCrumb('Page Edit', BASE_URL . 'pages/edit/' . Url::segment(2));
        
        // Load models
        $pages = $this->loadModel('Pages_model');
        
        // Check if update form submitted 
        if(Input::exists('post')) {
            if(Input::get('save')) {
                $pages->updateEntry(
                    Input::get('ID'),
                    escape_and_addslashes( Input::get('page_title')),
                    escape_and_addslashes( Input::get('page_slug')),
                    escape_and_addslashes( Input::get('page_content'))
                );
                
                // Get page value from database
                $page = $pages->getEntry(Url::segment(2));
                
                $this->clearCache($page[0]->page_slug);
            } 
        } else {
            // Get page value from database
            $page = $pages->getEntry(Url::segment(2));  
        }
        
        // Build the template view 
		$template = $this->loadView('pages/page_edit_view');
        $template->addJS(array( 
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/tinymce.min.js',
            BASE_URL . 'public_html/themes/_system/js/plugins/tinymce/custom_init.js'
        ));
        $template->set('page', array(
            'title' => $page[0]->page_title,
            'heading' => '',
            'description' => 'Page edit',
            'icon' => '<i class="icon x32 icon-pencil"></i>',
            'body_class' => 'bg-grey'
        ));
        // $template->set('bread', $bc->makeBread());
        $template->set('top_action_buttons', 
            '<a href="' . BASE_URL . $page[0]->page_slug . '" target="_blank">Preview</a> ' .
            '<input type="button" class="btn btn-primary" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
        );
        $template->set('pages' , $page);
        // options_pane_widget_register(array(
            // 'body' => '<input type="button" class="btn btn-default" onclick="document.getElementById(\'editor\').submit();" value="Save Changes">'
        // ));
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
        $pages = $this->loadModel('Pages_model');
        if( $pages->deleteEntry(Url::segment(2)) ) {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Page successfully deleted!');
        } else {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Page not deleted!');
        }
        /** Redirect to pages controller. */
        $this->redirect('pages');
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

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */