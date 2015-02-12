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

echo 'Outside Module <br />';

class Pages extends Controller
{	
    public function __construct()
    {
        $this->index();
    }
    
	public function index()
	{        
		echo 'Hello from inside Modules/Site <br />';
    }
    
}

/* End of file pages.php */
/* Location: ./application/modules/site/controllers/pages.php */