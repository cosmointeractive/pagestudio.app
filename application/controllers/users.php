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

class Users extends MY_Controller
{	
	public function index()
	{        
        $bc = new Breadcrumb();
        $bc->addCrumb('Users', BASE_URL . 'users');
        
		$template = $this->loadView('users/users_view');
        $template->addCSS(array( 
            'http://google.com',
            'http://bing.com'
        ));
        $template->set('page', array(
            'title' => 'Users',
            'heading' => 'The users page',
            'description' => 'Manage accounts',
            'icon' => '<i class="icon x32 icon-users"></i>'
        ));
        $template->set('bread', $bc->makeBread());
        $template->set('users' , $this->loadUsers());
		$template->render();
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Load all categories
     * @access      Private 
     */
    private function loadUsers()
    {
        $users = $this->loadModel('Users_model');
        return $users->getUsers();
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
            if(Input::get('submit')) {                
                $entries->addEntry(
                    'cimp_categories', 
                    array(
                        'category_title' => escape_and_addslashes( Input::get('category_title') ),
                        'category_slug' => escape_and_addslashes( make_slug(Input::get('category_title')) ),
                        'category_description' => escape_and_addslashes( Input::get('category_description') )
                    )
                ); 
            } 
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
        // Load models
        $entries = $this->loadModel('users_model');
        $errors = array();
                
        // Check if update form submitted 
        if(Input::exists('post')) { 
            if(Input::get('submit')) {
                /** Check if a token was submitted and validate it */
                if(Token::validate(Input::get('token'))) {
                    /** Validate user Input. */
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'username' => array(
                            'required' => false,
                            'min' => 5,
                            'max' => 20,
                            'unique' => 'users'
                        ),
                        'password' => array(
                            'required' => true,
                            'min' => 8,
                            'max' => 50,
                            'unique' => 'users'
                        )
                    ));
                    
                     /** 
                     * If validations passed redirect the user the main page. 
                     * Else return the errors to the errors array.
                     */
                    if($validate->passed()) {  
                        // if( $this->verifyDatabase() ) {
                            // /** Store a login successful message in the session. */
                            // Session::flash('success', 'You have successfully signed in!');

                            // /** Redirect to the default controller. */
                            // $this->redirect(Config::get('admin_controller'));
                        // } else {

                        // }
                    } else {
                        foreach($validate->errors() as $error) {
                            $errors[] = $error . '<br />';
                        }
                    }
                } else {
                    $errors[] = 'Token mismatch. It looks like you tried to refresh your browser. Try clicking the update button to submit your changes.'; 
                }
            
                // Get entry value from database
                $entry = $entries->getUser(Url::segment(2));
            
                /** Delete form session token to prevent duplicated submissions. */
                Session::delete(Config::get('session/session_token'));             
            } 
        } else {
            // Get entry value from database
            $entry = $entries->getUser(Url::segment(2));
        }
        
        /**
         * Build the user view 
         */
        $bc = new Breadcrumb();
        $bc->addCrumb('Users', BASE_URL . 'users');
        $bc->addCrumb('Edit', BASE_URL . 'users/edit/' . Url::segment(2));

        // Build the template view 
		$template = $this->loadView('users/user_edit_view');
        $template->set('page', array(
            'title' => 'Edit user account',
            'heading' => 'The category edit page',
            'description' => '', 
            'icon' => '<i class="icon x32 icon-pencil"></i>',
            'body_class' => 'bg-grey'
        ));
        $template->set('bread', $bc->makeBread());        
        $template->set('entry', $entry);
        $template->set('errors', $errors);
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
            Session::flash('success', 'Event successfully deleted!');
        } else {
            /** Store a delete successful message in the session. */
            Session::flash('success', 'Event not deleted!');
        }
        $this->redirect('categories');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */