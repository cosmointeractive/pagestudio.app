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

final class Login extends Controller 
{
    private $_user_id,
            $_username,
            $_password,
            $_formResult,
            $_remember,
            $_errors = array();
            
    public function index() 
    {
        /** Check if the user is already logged in. Send to default page. */
        if( $this->isLoggedIn() ) {
            $this->redirect(Config::get('admin_controller'));
        } else {
            /** Run login method if user not logged in. */
            $this->auth_login();
        }        
    }
    
    // --------------------------------------------------------------------
    
    public function isLoggedIn() 
    {
        /**
         * Check if a user session has already been created
         * else check if the remember feature was set. 
         * If not, send the user to the login page.
         */
        if( ! Session::get('session_id')) {        
            if( Cookie::exists(Config::get('remember/cookie_name')) && ! Session::get('session_id')) {               
                $hash = Cookie::get(Config::get('remember/cookie_name'));
                
                $hashCheck = Database::getInstance()->get(
                    'cimp_user_sessions', 
                    array('hash', '=', $hash)
                );
                
                if($hashCheck->count()) {
                    foreach($hashCheck->results() as $item) {
                        $this->_user_id = $item->user_id;
                    }
                    
                    /**
                     * Check database table for username and password
                     */		        
                    $query = Database::getInstance()->query(
                        "SELECT username, password, access
                        FROM cimp_users 
                        WHERE id = ?", 
                        array($this->_user_id)
                    );

                    if( $query->count()) {
                        /** Loop through our query result. */
                        foreach($query->results() as $item) {
                            $this->_username = $item->username;
                            $this->_access = $item->access;
                        }
                        
                        /** Check for password match if user account is not disabled. */
                        if( $item->access !== '0') {
                            /** Store a login successful message in the session. */
                            Session::flash('success', 'You have successfully signed in!');
                            /** Store the user session id. */
                            Session::set('session_id', Token::gen());
                            /** Set user id in the session */
                            Session::set(Config::get('session/user_id'), $this->_user_id);
                            /** Set cookie to remember user if requested. */
                            $this->rememberMe();
                            /** Redirect to the default controller. */
                            $this->redirect(Config::get('admin_controller'));
                        } else {
                            $this->_errors[] = 'Your account has been disabled';
                        }
                    } 
                }
            }
        } 
    }
    
    // --------------------------------------------------------------------
    
    /**
     * User Login authentication
     * @access    private
     * @access    final
     */
    final private function auth_login() 
    {   
        /**
         * Check if the form was submitted then check if a unique token was 
         * generated with it. Validate our token to protect against cross site
         * forgery and to make sure that the login request is sent once per
         * iteration. Last, validate the form field values and allow access if passed.
         */
        if(Input::exists('post')) { 
            /** Check if a token was submitted and validate it */
            if(Token::validate(Input::get('token'))) {
                /** Validate user input */
                if(Input::get('login')) {
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
                        if( $this->verifyDatabase() ) {
                            /** Store a login successful message in the session. */
                            Session::flash('success', 'You have successfully signed in!');
                            /** Store the user session id. */
                            Session::set('session_id', Token::gen());
                            /** Set user id in the session */
                            Session::set(Config::get('session/user_id'), $this->_user_id);
                            /** Set cookie to remember user if requested. */
                            $this->rememberMe();
                            /** Redirect to the default controller. */
                            $this->redirect(Config::get('admin_controller'));
                        } else {
                            if(isset($this->_access) && $this->_access === '0') {
                                $this->_errors[] = 'Your account has been disabled';
                            } else {
                                $this->_errors[] = 'Wrong username and password combination.';
                            }
                        }
                    } else {
                        $errors = $validate->errors();
                        foreach($errors as $error) {
                            $this->_errors[] = $error . '<br />';
                        }
                    }
                }
                
                /** Delete form session token */
                Session::delete(Config::get('session/session_token'));
            }// End if()
        }
        
        //return results to the view
        $template = $this->loadView('login/login_view');
        $template->set('page', array(
            'title' => 'Login',
            'heading' => 'The login page',
            'description' => 'This is the login page'
        ));
        $template->set('errors', $this->_errors);
        $template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Method to allow remember functionality
     *
     */
    private function rememberMe()
    {           
        /** Check form for user input. */
        $this->_remember = (Input::get('remember') === 'on') ? true : false;
        
        if($this->_remember) {
            // Generate a unique hash
            $hash = Token::gen();
            // Check database for existing hash for current user
            $hashCheck = Database::getInstance()->get('cimp_user_sessions', array(
                'user_id', '=', $this->_user_id
            ));
            
            /**
             * Check if the hash exists for current user. Insert if it doesn't 
             * already exists.
             */
            if( ! $hashCheck->count()) {
                Database::getInstance()->insert('cimp_user_sessions', array(
                    'user_id' => $this->_user_id,
                    'hash' => $hash
                ));
                
                /** Store a cookie for the user. */
                Cookie::set(
                    Config::get('remember/cookie_name'), 
                    $hash,
                    Config::get('remember/cookie_expiry')
                );
            } else {
                echo 'Hash already exists!';
            }
            
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
	 * Check database for user credentials
     *
	 * @param       string $_username 
	 * @param       string $_password
	 * @return      bool Return true if a match was found
	 */
	private function verifyDatabase()
	{
		$hasher = new PasswordHash( 8, TRUE );
		
        $this->_username = ! isset($this->_username) ? Input::get('username') : $this->_username;
        $this->_password = ! isset($this->_password) ? Input::get('password') : $this->_password;
        
		/**
		 * Check database table for username and password
		 */		        
        $query = Database::getInstance()->query(
            "SELECT id, username, password, access
            FROM cimp_users 
            WHERE username = ?", 
            array($this->_username)
        );
        
        if( $query->count()) {
            /** Loop through our query result. */
            foreach($query->results() as $item) {
                $this->_access = $item->access;
                $this->_user_id = $item->id;
                /** Check for password match if user account is not disabled. */
                if( $item->access !== '0') {
                    return ( $hasher->CheckPassword($this->_password, $item->password) ) ? 1 : 0;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }	
	}

    // --------------------------------------------------------------------

    /**
     * Provides a method to end the user session (end all sessions).
     * @access      public 
     */
    public function logout() 
    {
        /** Remove cookie from database */
        Database::getInstance()->delete(
            'cimp_user_sessions', 
            array('user_id', '=', Session::get(Config::get('session/user_id')))
        );
        /** Remove cookie */
        Cookie::delete(Config::get('remember/cookie_name'));
        /** End all sessions */
        Session::destroy();
        /** Redirect to the default controller. */
        $this->redirect(Config::get('admin_controller'));
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */