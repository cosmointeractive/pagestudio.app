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

class Register extends Controller 
{
    private $_formResult,
            $_errors = array();
    
    public function index() 
    {        
        if(Input::exists('post')) {                
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
                
                if($validate->passed()) {
                    $this->_formResult = 'Success!';
                } else {
                    $errors = $validate->errors();
                    foreach($errors as $error) {
                        $this->_errors[] = $error . '<br />';
                    }
                }
            }
        }
        
        //return results to the view
        $template = $this->loadView('register_view');
        $template->set('page', array(
            'title' => 'Login',
            'description' => 'This is the login page'
        ));
        $template->set('success', $this->_formResult);
        $template->set('errors', $this->_errors);
        $template->render();
    }
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */