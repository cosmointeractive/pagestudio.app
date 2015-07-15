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

/**
 * Helper Functions
 *
 * Helper functions are a collection of functions that helps you with tasks. 
 * Unlike most other systems, in this CMS, Helper Functions are not written 
 * in an Object Oriented format. They are simple, procedural functions. 
 * Each helper function performs one specific task, and may be dependent of one or 
 * more other Helper Functions.
 * Helper functions are not native to this application alone. They can be reused in 
 * other php applications. 
 *
 * @version:    Version 0.1.0 
 * @modified:   07/04/2015
 *
 * Table of Contents:
 * ------------------------------
 * - escape_and_addslashes()
 */

// ------------------------------------------------------------------------

/**
 * String sanitation 
 *
 * @syntax       escape_and_addslash($var)
 * @param        string $string (Required) The string to be processed
 *
 * @return       string
 */ 
if( ! function_exists('options_pane_widget_register')) {
    function options_pane_widget_register($widget) {
        global $options_pane_widgets;
        
        if(empty($options_pane_widgets)) {
            $options_pane_widgets = array();
        }
        
        if(is_array($widget)) {
            $options_pane_widgets[] = $widget;
        }
    }
}

/**
 * String sanitation 
 *
 * @syntax       escape_and_addslash($var)
 * @param        string $string (Required) The string to be processed
 *
 * @return       string
 */ 
if( ! function_exists('options_pane_widgets')) {
    function options_pane_widgets($param = false) {
        global $options_pane_widgets;        
        $widgets = '';

        if( ! empty($options_pane_widgets)) {
            foreach($options_pane_widgets as $widget) {
                $widgets .= '<div class="panel panel-default">';
                if( !empty($widget['title'])) {
                    $widgets .= '<div class="panel-heading">
                                    <h3 class="panel-title">' .$widget['title']. '</h3>
                                </div>';
                }
                if( !empty($widget['body'])) {
                    $widgets .= '<div class="panel-body">
                                    ' .$widget['body']. '
                                </div>';
                }
                if( !empty($widget['footer'])) {
                    $widgets .= '<div class="panel-footer">
                                    ' .$widget['title']. '
                                </div>';
                }
                $widgets .= '</div>';
            }
            
            if($param) { 
                echo $widgets; 
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

/* End of file admin_helper.php */
/* Location: ./application/helpers/admin_helper.php */