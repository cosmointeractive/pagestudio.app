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

class Dashboard extends MY_Controller 
{	
	public function index()
	{        
		$bc = new Breadcrumb();
        
        // no special book is requested, we'll show a list of all available books
		$template = $this->loadView('main_view');
        $template->set('bread', $bc->makeBread());
		$template->render();
	}
    
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */