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
 * Image upload and manipulation class 
 * 
 * <code> 
 *    $file = new Photo('images/cars/large/input.jpg');
 *    $file->resizeImage(150, 100, 0);
 *    $file->saveImage('images/cars/large/output.jpg', 100);
 * </code>
 *
 * @note        This class relies heavily on the GD library being installed. 
 *              Efforts are still being made to remove such dependency. 
 *
 * @package		PageStudio
 * @subpackage	Libraries
 * @author      http://stackoverflow.com/questions/17231648/transparent-background-of-png-saves-as-black
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @source      http://code.tutsplus.com/tutorials/image-resizing-made-easy-with-php--net-10362
 * @updated     01/23/2014
 */
class Photo
{   
    public  $max_file       = 10,    // Maximum file size in MB
            $max_width      = 2000,	 // Max width allowed for the large image in Pixels
            $image_type     = '',	 // The image extension - the (.)
            $image_width    = '',    // The image width
            $image_height   = '',    // The image height         
            $userfile_name  = '',    // The uploaded filename
            $userfile_tmp   = '',    // The temporary name of the image
            $userfile_size  = '',    // The uploaded image size 
            $filename       = '',
            $file_ext       = '', 
            $image_location = '', 
            $mime_type      = '',
            $upload_path    = '',     // Upload path 

            $final_image    = array(); // Items to be called outside of object
    
    private $image,
            $width,
            $height,
            $imageResized;
    
    /**
	 * Constructor
	 *
	 * @param	string
	 * @return	void
	 */
    public function __construct(
        $upload_path,
        $file = 'image', 
        $filename = '', 
        $userfile_tmp = '',  
        $max_width_override = ''
    ) {
        /**
         * Increase PHP's memory limit as the image processing gets a bit hungry 
         */ 
        ini_set('memory_limit', '64M');        
        
        if( ! empty($upload_path)) {
            $this->upload_path = $upload_path;
            
            //Get the file information
            $this->userfile_name = $_FILES[$file]['name'];
            $this->userfile_tmp  = $_FILES[$file]['tmp_name'];
            $this->userfile_size = $_FILES[$file]['size'];
            $this->mime_type     = $_FILES[$file]['type'];
            $this->file_ext      = strtolower(substr(
                                       $this->userfile_name, 
                                       strrpos($this->userfile_name, '.') + 1
                                   )); 
            $this->filename      = $this->make_unique_filename( $this->userfile_name, $this->upload_path );            
            // Remove the extension from the file
            $this->file_basename = basename($this->filename, '.'.$this->file_ext); 

            move_uploaded_file($this->userfile_tmp, $this->filename);
            chmod($this->filename, 0777);
        } 
        else {
            $this->filename = $filename;
        }
        
        $this->max_width = (strlen($max_width_override) > 0) ? $max_width_override : $this->max_width;
			
        // *** Open up the file
        $this->image = $this->openImage($this->filename);

        /**
         * Get width and height 
         * 
         * This method relies on the GDlibrary being installed. If GD isn't 
         * installed then use getimagesize() as a fallback. getimagesize() 
         * also gives access to more details on the image file. 
         */
        if (extension_loaded('gd') && function_exists('gd_info')) {
            // PHP GD library is installed proceed
            $this->width  = imagesx($this->image);
            $this->height = imagesy($this->image);
        }
        else {
            // PHP GD library is NOT installed use this method
            $this->width  = getWidth($this->image);
            $this->height = getHeight($this->image);
        }
        
        // *** Resize image if larger than max_width
        $this->checkSize();
    }    

    // --------------------------------------------------------------------    

    private function openImage($file)
    {
        // *** Get file extension
        $extension = strtolower(strrchr($file, '.'));

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                $img = @imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = @imagecreatefromgif($file);
                break;
            case '.png':
                $img = @imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

	// --------------------------------------------------------------------

	public function resizeImage(
        $newWidth, 
        $newHeight, 
        $option = "auto", 
        $start_width = 0, 
        $start_height = 0
    ) {
        // *** Get optimal width and height - based on $option
        $optionArray = $this->getDimensions($newWidth, $newHeight, $option);

        $optimalWidth = $optionArray['optimalWidth'];
        $optimalHeight = $optionArray['optimalHeight'];

        // *** Resample - create image canvas of x, y size
        $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);

        // *** EDIT BY JDUB - add transparent background, for png images
        //2. Create an alpha-transparent color and fill the image with it */
        imagealphablending($this->imageResized, false);
        imagesavealpha($this->imageResized, true);
        $bg = imagecolorallocatealpha($this->imageResized, 0, 0, 0, 127);
        imagefilledrectangle($this->imageResized, 0, 0, $optimalWidth, $optimalHeight, $bg);
        imagecolortransparent($this->imageResized, $bg);
        // *** END EDIT BY JDUB

        imagecopyresampled($this->imageResized, $this->image, 0, 0, $start_width, $start_height, $optimalWidth, $optimalHeight, $this->width, $this->height);

        // *** if option is 'crop', then crop too
        if ($option == 'crop') {
            $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
        }
    }

    // --------------------------------------------------------------------

    private function getDimensions($newWidth, $newHeight, $option)
	{
        switch ($option)
        {
            case 'scale':
                $scale = 200/$newWidth;
                $optimalWidth  = ceil($newWidth * $scale);
                $optimalHeight = ceil($newHeight * $scale);
                break;
            case 'exact':
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
                break;
            case 'portrait':
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
                break;
            case 'landscape':
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            // case 'auto':
            default:
                $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    // --------------------------------------------------------------------

    private function getSizeByFixedHeight($newHeight)
    {
        $ratio = $this->width / $this->height;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }
    
    // --------------------------------------------------------------------

    private function getSizeByFixedWidth($newWidth)
    {
        $ratio = $this->height / $this->width;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }
    
    // --------------------------------------------------------------------

    private function getSizeByAuto($newWidth, $newHeight)
    {
        if ($this->height < $this->width)
        // *** Image to be resized is wider (landscape)
        {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        }
        elseif ($this->height > $this->width)
        // *** Image to be resized is taller (portrait)
        {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        }
        else
        // *** Image to be resized is a square
        {
            if ($newHeight < $newWidth) {
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            } else if ($newHeight > $newWidth) {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
            } else {
                // *** Sqaure being resized to a square
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
            }
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    // --------------------------------------------------------------------

    private function getOptimalCrop($newWidth, $newHeight)
    {
        $heightRatio = $this->height / $newHeight;
        $widthRatio  = $this->width /  $newWidth;
        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $this->height / $optimalRatio;
        $optimalWidth  = $this->width  / $optimalRatio;

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    // --------------------------------------------------------------------       

    private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
	{
		// *** Find center - this will be used for the crop
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
		$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);


		// *** Now crop from center to exact requested size
		$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);

		if (imagetypes() & IMG_PNG) {
			imagealphablending($this->imageResized, false);
			imagesavealpha($this->imageResized, true);
			$bg = imagecolorallocatealpha($this->imageResized, 255, 255, 255, 127);
			imagefilledrectangle($this->imageResized, 0, 0, $optimalWidth, $optimalHeight, $bg);

		}

		imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
	}

    // --------------------------------------------------------------------

    public function saveImage($savePath, $imageQuality = "100")
    {
        // *** Get extension
        $extension = strrchr($savePath, '.');
        $extension = strtolower($extension);

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
                break;
            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath);
                }
                break;
            case '.png':
                // *** Scale quality from 0-100 to 0-9
                $scaleQuality = round(($imageQuality/100) * 9);
                // *** Invert quality setting as 0 is best, not 9
                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                    imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
                break;
            // ... etc
            default:
                // *** No extension - No save.
                break;
        }

        imagedestroy($this->imageResized);
    }

    // --------------------------------------------------------------------
    
    /**
     * Resize the image using x, y coordinates 
     * 
     * @note       This may be a repeat of the $this->resize() function 
     * 
     * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
     * @access     Public
     * @param      
     * @return     void
     */
     public function resizeThumbnailImage(
        $thumb_image_name, 
        $width, 
        $height, 
        $start_width, 
        $start_height, 
        $scale
    ) {
        $newImageWidth      = ceil($width * $scale);
        $newImageHeight     = ceil($height * $scale);
        $this->imageResized = imagecreatetruecolor($newImageWidth,$newImageHeight);

        imagecopyresampled(
            $this->imageResized,
            $this->image,
            0,0,$start_width,$start_height,
            $newImageWidth,
            $newImageHeight,
            $width,
            $height
        );    
    }

    // --------------------------------------------------------------------
    
    /**
     * Resize the image if larger the the max width
     * 
     * Long description of the function 
     * 
     * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
     * @access     Private
     * @param      
     * @return     void
     */ 
    private function checkSize()
    {
        if ($this->width > $this->max_width) {
            $scale        = $this->max_width/$this->width;
            $this->width  = ceil($this->width * $scale);
            $this->height = ceil($this->height * $scale);
            
            $this->resizeImage($this->width, $this->height, '');
            $this->saveImage($this->filename);
        }
    }
    
    /**
     * Return the image height
     * 
     * Long description of the function 
     * 
     * @access     Private
     * @param      
     * @return     $param
     */ 
    private function getHeight($image) {
        $size   = getimagesize($image);
        $height = $size[1];
        return $height;
    }
    
    /**
     * Return the image width
     * 
     * Long description of the function 
     * 
     * @access     Private
     * @param      
     * @return     $param
     */ 
    private function getWidth($image) {
        $size  = getimagesize($image);
        $width = $size[0];
        return $width;
    }
    
    /**
     * Method to access public class variables
     * 
     * @access     Public
     * @param      var $key The key to look for
     * @return     var $key 
     */
    public function get($key)
    {
        return $this->$key;
    }

    // --------------------------------------------------------------------
    
    /**
     * Ensure unique filenames in the target directory
     *
     * @access     Protected
     * @param      string $file The original file name
     * @param      string $destination Full path to the target directory
     * @return     string A unique file name
     */
    protected function make_unique_filename($filename, $destination = '')
    {
        $i = 1;
        $path_parts = pathinfo(strtolower($filename));
        $filename   = make_slug($path_parts['filename']);
        
        if(file_exists($destination.$filename.'.'.$path_parts['extension'])) {
            while (file_exists($destination.$filename.'.'.$path_parts['extension'])) {
                $filename = make_slug($path_parts['filename']).'-('.$i.')';
                $i++;
            }
        }

        return $destination.$filename.'.'.$path_parts['extension'];
    }

}