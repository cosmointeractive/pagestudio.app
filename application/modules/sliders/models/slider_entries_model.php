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

class Sliders_entries_model extends Model 
{
    /**
     * NOT YET IMPLEMENTED
     *
     * Creates and entry in the database 
     *
     * @access     Private
     * @param      string $table  
     * @param      array $fields Array of table key and value
     * @param      int $photo_id 
     * @return     bool true or false
     */
    private function insert($table, $fields, $slider_author, $slider_id)
	{
		$query = Database::getInstance()->insert(
            $table, $fields
        );
        
        // Check if query is successful, and get the total photo count for that slideshow 
        if( ! $query) {
            $this->errors[] = 'The query to add the photo details of slideshow ' . $slider_id . ' failed!';
            log_message('E_USER_ERROR', 'The query to add the photo details of slideshow ' . $slider_id . ' failed!', __FILE__, __LINE__);
            
            return false;
        } else {
            $query = Database::getInstance()->query(
                "SELECT photo_id FROM cimp_pageslider_entries WHERE slider_id = ?", array($slider_id)
            );

            if( ! $query->count()) {
                $this->errors[] = 'The query to get the photo count of slideshow ' . $slider_id . ' failed!';
                log_message('E_USER_ERROR', 'The query to get the photo count of slideshow ' . $slider_id . ' failed!', __FILE__, __LINE__);
            } else {
                $photo_count = $query->count();
                
                $query = Database::getInstance()->update(
                    "cimp_pagesliders", $slider_id, array(
                        'slider_author' => $slider_author,
                        'photo_count' => $photo_count,
                        'slider_modified' => date("Y-m-d H:i:s")
                    )
                );
                
                if( ! $query) {
                    $this->errors[] = 'The query to update the photo count of slideshow ' . $slider_id . ' failed!';
                    log_message('E_USER_ERROR', 'The query to update the photo count of slideshow ' . $slider_id . ' failed!', __FILE__, __LINE__);
                } else {
                    return true;
                }
            }
        }
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Edit slider entry in the database
     *
     * @access     Private
     * @param      int $photo_id 
     * @return     bool
     */
    private function update($photo_id, $slider_id)
    {
        
    }
    
    // --------------------------------------------------------------------
    
    /**
     * NOT YET IMPLEMENTED
     *
     * Delete slider entry in the database
     *
     * Removes an entry in the slider entries table and updates the slider table image count
     *
     * @access     Private
     * @param      int $photo_id
     * @param      int $slider_id
     * @return     bool
     */
    private function delete($photo_id, $slider_id, $slider_author)
    {
        $query = Database::getInstance()->delete(
            'cimp_pageslider_entries', array('photo_id', '=', $photo_id)
        );
        
        // Check if query is successful, and get the total photo count for that slideshow 
        if( ! $query) {
            $this->errors[] = 'The query to delete the slideshow photo ' . $photo_id . ' failed!';
            log_message('E_USER_ERROR', 'The query to delete the slideshow photo ' . $photo_id . ' failed!', __FILE__, __LINE__);
            
            return false;
        } else {
            $query = Database::getInstance()->query(
                "SELECT photo_id FROM cimp_pageslider_entries WHERE slider_id = ?", array($slider_id)
            );

            if($query->error()) {
                $this->errors[] = 'The query to get the photo count of slideshow ' . $slider_id . ' failed!';
                log_message('E_USER_ERROR', 'The query to get the photo count of slideshow ' . $slider_id . ' failed!', __FILE__, __LINE__);
            } else {
                $photo_count = $query->count();
                
                $query = Database::getInstance()->update(
                    "cimp_pagesliders", $slider_id, array(
                        'slider_author' => $slider_author,
                        'photo_count' => $photo_count,
                        'slider_modified' => date("Y-m-d H:i:s")
                    )
                );
                
                if( ! $query) {
                    $this->errors[] = 'The query to update the photo count of slideshow ' . $slider_id . ' failed!';
                    log_message('E_USER_ERROR', 'The query to update the photo count of slideshow ' . $slider_id . ' failed!', __FILE__, __LINE__);
                } else {
                    return true;
                }
            }
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Update the slider entries table 
     *
     * @access     Private
     * @param      int $photo_id
     * @param      int $slider_id
     * @param      string $slider_author
     * @return     bool
     */
    private function updateAuthor($photo_id, $slider_id, $slider_author)
    {
        
    }
}

/* End of file Sliders_entries_model.php */
/* Location: ./application/modules/sliders/models/Sliders_entries_model.php */