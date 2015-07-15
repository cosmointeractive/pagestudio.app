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

class Page_sliders extends MY_Controller
{
    public function __construct()
    {
        // $this->index();
    }
    
    public function index()
    {
        $sliders = $this->loadModel('Page_Sliders_model');
        $sliders = $sliders->all();
      
        var_dump($sliders);
    }
    
    public function add()
    {
        $bc = new Breadcrumb();
        $bc->addCrumb('Sliders', BASE_URL . 'page_sliders');
        $bc->addCrumb('Add New', BASE_URL . 'page_sliders/add/');
        
        // Load models
        $sliders = $this->loadModel('Page_Sliders_model');
        
        // Build the template view 
		$template = $this->loadView('page_sliders/addnew_view');
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
    
    public function upload()
    {
        
    }
    
    public function update()
    {
        
    }
    
    public function delete()
    {
        
    }
}

/* End of file page_sliders.php */
/* Location: ./application/controllers/page_sliders.php */