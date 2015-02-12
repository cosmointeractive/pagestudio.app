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
 
class Error extends MY_Controller {
	
	public function index()
	{
		$this->error404();
	}
	
	private function error404()
	{
        //return results to the view
        $template = $this->loadView('error_view');
        $template->set('page', array(
            'title' => '404 Error',
            'heading' => '404 Error',
            'message' => 'Looks like this page doesn\'t exist'
        ));
        //$template->set('errors', $this->_errors);
        $template->render();
	}    
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */