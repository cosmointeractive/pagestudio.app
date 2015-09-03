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
 
class Blog extends Public_Controller
{
    private $posts = array();
    
    public function __construct()
    {
        $this->route();
    }
    
    private function route()
    {
        if(Url::segment(0) !== 'page') {
            $this->getPost();
        }
        
        if(Url::segment(1) && Url::segment(2)) {
            
            if(Url::segment(1) === 'page') {
                $pageNumber = Url::segment(2);
                // contains only 0-9
                if (preg_match('/^[0-9]+$/', $pageNumber)) {
                    echo 'Pagination detected: Fetch next results';
                } else {
                    // Search database for segment(1) and forget segment(2) was even passed
                    $this->getEntries(Url::segment(1));
                }
            } else {
                // Search the database for that blog entry
                // $this->getEntry(Url::segment(1));
                // $this->index();
            }
        } 
    }
    
    private function getPost()
    {
        $post       = Url::segment(1);
        $entries    = $this->loadModel(array('module' => 'site', 'model' => 'posts_model'));
        $themePath  = BASE_URL . Config::get('theme_path') . 'default/';
        
        
        // Allow posts with 'published' statuses to be viewed
        // if($entries->getEntries()) {
            // // An array of page url-slugs from the database
            // foreach($entries->getEntries() as $key) {
                // $posts[] = $key->post_slug;
            // }
        // }
        
        // // Allow posts with 'draft' statuses to be previewed if user is logged in
        // if(Session::exists(Config::get('session/session_id'))) {
            // // An array of page url-slugs from the database
            // if($entries->getEntries('draft')) {                
                // foreach($entries->getEntries('draft') as $key) {
                    // $posts[] = $key->post_slug;
                // }
            // }
        // }
        $this->posts[] = $entries->getEntry(Url::segment(1));

        // Check if the page requested is in the database, else show 404
        if (empty($this->posts)) {
            $this->redirect('error');
        } 
        else 
        {
            // Load default helpers
            $this->loadHelper('functions');  
            $this->loadHelper('shortcodes');
            $this->loadHelper('shortcode_list');
            
            $bc = new Breadcrumb(); 
            
            $data = array();
            $data['BASE_URL']       = BASE_URL;
            $data['page_style']     = array(
                array('source' => $themePath . '/assets/css/style.css'),
                array('source' => $themePath . '/assets/css/error.css')
            );
            $data['bread']          = $bc->makeBread();
            $data['copy']           = '&copy; Copyright ' . date('Y');
            
            foreach($this->posts as $entry) {
                // Only show pages that have been published to the user 
                // unless someone is logged. Then assume a preview state.
                if($entry->post_status !== 'published' && ! Session::exists(Config::get('session/session_id'))) {
                    $this->redirect('error');
                }
                
                // Everything is ok build the page
                $data['site_title']     = 'My Post Entry';
                $data['the_title']      = remove_slashes( $entry->post_title );
                $data['the_slug']       = remove_slashes( $entry->post_slug );
                $data['the_content']    = remove_slashes( $entry->post_content );
            }
            
            $data['the_content']        = shortcode_empty_paragraph_fix( $data['the_content'] );
            $data['the_content']		= do_shortcode( $data['the_content'] );
            $data['nav_primary']        = $this->buildMenu();
            
            $parser = new Lex_Parser();
            $parser->scopeGlue(':');
            $the_content = $parser->parse(
                file_get_contents($themePath . 'views/layouts/index.php'), 
                $data, 
                'my_callback'
            );
            
            // Build a cache version of the page 
            $this->buildCache($data['the_slug'], $the_content);
            
            // Show entry 
            $template = $this->loadView('render_view');
            $template->set('the_content', $the_content);
            $template->render();
        }
    }
            
    private function paginate()
    {
        
    }
    
    private function search()
    {
        
    }
    
    /**
     * Build the page cache 
     * 
     * @param      string $permalink
     * @param      string $page_content
     * @return     void
     */ 
    private function buildCache( $permalink, $page_content )
    {
        $c = new Cache(array(
            'name' => Config::get('cache/name'),
            'path' => Config::get('cache/file_path'),
            'extension' => Config::get('cache/extension')
        ));
        // store the built page
        $c->store($permalink, $page_content); 
    }
    
    /**
     * Build navigation menu
     * 
     * @syntax     function_name( $param ) 
     * @param      
     * @access     public       
     * @return     $param;
     */ 
    public function buildMenu( $base_url = BASE_URL)
    {
        $menu = menu::factory()
			->add('Home', $base_url, menu::factory())
			->add('About', $base_url . 'about/', menu::factory()
				->add('Our Story', $base_url . 'our-story/')
				->add('Our Beliefs', $base_url . 'our-beliefs/')
            )
			->add('News', $base_url . 'news/', menu::factory());

        $menu->attrs = array(
            'id' => 'navigation',
            'class' => 'menu',
        );

        $menu->current = '/level-three/';
        
        return $menu;
    }
}

function my_callback($name, $attr, $content)
{
    $result     = '';
    $theme_path = BASE_URL . Config::get('theme_path') . 'default/';
    
    if(isset($attr)) {        
        $parser = new Lex_Parser();
        foreach($attr as $key) {
            $filename = $theme_path . 'views/partials/'.$key.'.php';            
            $result = $parser->parse(file_get_contents($filename)); 
        }
    }
    
    return $result;
}