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
 * Short description for file
 *
 * Long description for file (if any)...
 * 
 * @category   
 * @package    PageStudio
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co> 
 * @copyright  Cosmo Interactive (c) 2014 http://www.cosmointeractive.co/
 * @license    MIT
 * @date       7/3/2015
 * @version    0.1.0
 * @return     void
 */ 
class Delete_Image
{
	private $_errors,
            $_delSuccess;
    
	public  $_fileLocation,
            $slider,
            $slideFolder,
            $var,
            $allErrors,
            $photoID,
            $photoName,
            $photoInfo 	= array(),
            $action,
            $confirmDelete;
	
	public function __construct()
	{
		$this->action    	 = isset($_GET['mod_action']) ? 1 : 0;
		$this->confirmDelete = (($this->action) && ($_GET['mod_action'] == 'delete')) ? 1 : 0;
		$this->slider 		 = ($this->confirmDelete) ? $this->filter($_GET['slider']) : '';
		$this->photoID 		 = ($this->confirmDelete) ? $this->filter2($_GET['image']) : '';
		$this->slideFolder 	 = ($this->confirmDelete) ? $this->slider() : '';
		$this->_errors		 = array();
		$this->_allErrors	 = '';
		$this->photoName	 = '';
		$this->_fileLocation = SLIDER_PATH.'/sliders/';
		//$this->_fileLocation = chmod($this->_fileLocation, 0777);
		$this->_delSuccess 	 = 0;
	}
	
	// Trigger function
	public function isDeleted()
	{
		($this->action) ? $this->verifyData() : '';
		
		return $this->_delSuccess;
	}
	
	public function verifyData()
	{
		try
		{		
			if ( ! $this->imageExists())   throw new Exception('The image was not found!');
			if ( ! $this->deleteFromDB())  throw new Exception('Image deleted from Database only. Please contact support to correct this issue!');
			if ( ! $this->deleteFromDir()) throw new Exception('Image deleted from Directory only. Please contact support to correct this issue!');

			$this->_delSuccess = 1;		
		}
		catch(Exception $e)
		{
			$this->_errors[] = $e->getMessage();
		}
	}
	
	public function imageExists()
	{
		return ( ! $this->checkDB() && ! $this->checkDir()) ? 0 : 1;
	}
	
    // checkDB
	public function checkDB()
	{
		global $_DB;
		//select image_name from db where == photo_id
		if($_DB->photoExist($this->photoID)) {
			$this->photoInfo  = $_DB->getPhotoInfo($this->photoID);
			$this->photoName  = $this->photoInfo['img_name'].$this->photoInfo['type'];
			
			return 1;
		} else {
			return 0;
		}
	}
	
    // checkDir
	public function checkDir()
	{
		if ($this->photoName != '') {
			return (file_exists($this->_fileLocation.$this->photoName)) ? 1 : 0;			
		} 
	}
	
	public function deleteFromDB()
	{
		global $_DB;
		
		return ($_DB->delPhoto ($this->photoID)) ? 1 : 0;
	}
	
	public function deleteFromDir()
	{
		unlink($this->_fileLocation.$this->photoName);		//delete large image		
		unlink($this->_fileLocation.'thumbnails/tb_'.$this->photoName); // delete thumbnail image
		
		return ($this->checkDir()) ? 0 : 1;
	}
		
	//Catch errors 
	public function showErrors() 
	{
		$cnt = 0;
		$this->_allErrors = '<b>ERROR!: </b>';

		foreach($this->_errors as $key=>$value) { 
            $this->_allErrors .= $value; 
            $cnt++; 
            
            if ($cnt > 1) { 
                $this->_allErrors .=  '<br />'; 
            } 
        }
		
		return $this->_allErrors;
	}
}