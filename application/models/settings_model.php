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

class Settings_model extends Model 
{
    public function __construct()
    {
        
    }
    
    public static function get($var = '')
    {
        if (! empty($var)) {            
            $query = Database::getInstance()->get(
                'cimp_options', array(
                    'option_name', '=', trim( $var )
                )
            ); 
            
            $results = $query->results();
            
            return ( ! $query->count()) ? false : $results[0]->option_value;
            
        } else {
            return false;
        }
    }
}