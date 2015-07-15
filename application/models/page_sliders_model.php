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

class Page_Sliders_model extends Model
{
    public function __construct()
    {

    }
    
    public function all()
    {
        $query = Database::getInstance()->query(
            "SELECT 
                id, 
                dir
            FROM cimp_page_sliders "
        );
        
        return ( ! $query->count()) ? false : $query->results();
    }
    
    public function insert()
    {
        
    }
    
    public function update()
    {
        
    }
    
    public function delete($ID)
    {
        
    }
}