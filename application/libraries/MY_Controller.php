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

/**
 * Custom class to extend the default Controller. 
 * Provides a means to add functionality without hacking at the framework's core
 */
class MY_Controller extends Controller 
{	
    public function __construct()
    {
        parent::__construct();
        
        $this->init();
    }

	public function init()
	{
        /**
         * Check if a user session has already been created
         * else send the user to the login page.
         */
        if( ! Session::get('session_id')) {
            $this->redirect('login');
        }
	}
    
}

/* End of file main.php */
/* Location: ./application/libraries/MY_Controller.php */