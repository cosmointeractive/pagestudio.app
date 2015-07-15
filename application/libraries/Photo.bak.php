<?php
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
 * Image Manipulation class
 *
 * @package		PageStudio
 * @subpackage	Libraries
 * @category	Photo
 * @author		Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @link		
 */
class Photo
{
    public  $max_file       = 10,    // Maximum file size in MB
            $max_width      = 2000,	 // Max width allowed for the large image
            $image_type     = '',	 // The image extension - the (.)
            $image_width    = '',
            $image_height   = '',
            $userfile_name  = '',
            $userfile_tmp   = '',
            $userfile_size  = '',
            $filename       = '',
            $file_ext       = '', 
            $image_location = '', 
            $mime_type      = '',

            $final_image    = array(); // Items to be called outside of object
            
    private $upload_path    = '';     // Upload path 
    
    /**
	 * Constructor
	 *
	 * @param	string
	 * @return	void
	 */
    public function __construct($upload_path, $image = 'image', $max_width_override = '')
    {
        ini_set('memory_limit', '-1');
        
        $this->upload_path = $upload_path;
        $this->max_width   = ( ! empty($max_width_override)) ? $max_width_override : $this->max_width;
        
        //Get the file information
        $this->userfile_name = $_FILES[$image]['name'];
        $this->userfile_tmp  = $_FILES[$image]['tmp_name'];
        $this->userfile_size = $_FILES[$image]['size'];
        $this->mime_type     = $_FILES[$image]['type'];
        $this->filename      = basename($_FILES[$image]['name']);
        $this->file_ext      = strtolower(substr(
                                   $this->filename, 
                                   strrpos($this->filename, '.') + 1
                               ));
        
        // Only images of these types are allowed for upload
        $allowed_image_types = array(
            'image/pjpeg'   => "jpg",
            'image/jpeg'    => "jpg",
            'image/jpg'     => "jpg",
            'image/png'     => "png",
            'image/x-png'   => "png",
            'image/gif'     => "gif"
        );
        $allowed_image_type = array_unique($allowed_image_types); // do not change this
        
        foreach ($allowed_image_type as $mime_type => $ext) {
            $this->image_type .= strtoupper($ext)." ";
        }
        
        //Only process if the file is a JPG, PNG or GIF and below the allowed limit
        if(( ! empty($_FILES[$image])) && ($_FILES[$image]['error'] == 0)) {
            
            foreach ($allowed_image_types as $mime_type => $ext) {
                /**
                 * loop through the specified image types and if 
                 * they match the extension then break out 
                 * everything is OK so go and check file size
                 */
                if($this->file_ext == $ext && $this->mime_type == $mime_type) {
                    $error = "";
                    break;
                } else {
                    $error = "Only <strong>".$this->image_type."</strong> images accepted for upload<br />";
                }
            }
            //check if the file size is above the allowed limit
            if ($this->userfile_size > ($this->max_file * 1048576)) {
                $error .= "Images must be under ".$this->max_file."MB in size";
            }
            
        } else {
            $error = "You must first select an image to upload!";
        }        
        
        //Everything is OK, so we can upload the image.
        if (strlen($error) === 0) {
            $this->move_file();
            
            // Get image dimensions            
            $this->image_width    = $this->getWidth($this->upload_path . $this->userfile_name);
            $this->image_height   = $this->getHeight($this->upload_path . $this->userfile_name);
            $this->image_location = $this->upload_path . $this->userfile_name;
            
            $resizeObj = new resize($this->image_location);
            $resizeObj-> resizeImage(150, 100, 'crop');
            $resizeObj-> saveImage($this->upload_path . 'output.jpg', 100);
        }

    }
    
    public function move_file()
    {
        if (isset($this->userfile_name)) {            
            move_uploaded_file(
                $this->userfile_tmp, 
                $this->upload_path . $this->userfile_name
            );
            chmod($this->upload_path . $this->userfile_name, 0777);
            
            $width  = $this->getWidth($this->upload_path . $this->userfile_name);
            $height = $this->getHeight($this->upload_path . $this->userfile_name);
            
            // Scale the image if it is greater than the width set above
            if ($width > $this->max_width) {
                $scale = $this->max_width/$width;
                $uploaded = $this->resize($this->upload_path . $this->userfile_name, $width, $height, $scale);
            } else {
                $scale = 1;
                $uploaded = $this->resize($this->upload_path . $this->userfile_name, $width, $height, $scale);
            }					
        }
    }
    
    /** 
     * Resize Image Function
     *
     * Long description of the function 
     * 
     * @param      
     * @return     $param;
     */ 
    public function resize(
        // $thumb_image_name, 
        $image, 
        $width, 
        $height, 
        $scale,
        $start_width = 0, 
        $start_height = 0
    ) {
        $thumb_image_name = $image;
            
        $newImageWidth  = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);        
        $newImage       = imagecreatetruecolor($newImageWidth, $newImageHeight);
        
        switch($this->mime_type) {
            case "image/gif":
                $imagecreatefrom = imagecreatefromgif($image); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $imagecreatefrom = imagecreatefromjpeg($image); 
                break;
            case "image/png":
            case "image/x-png":
                $imagecreatefrom = imagecreatefrompng($image);                 
                break;
        }
        
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $bg = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
        imagefilledrectangle($newImage, 0, 0, $newImageWidth, $newImageHeight, $bg);
        
        imagecopyresampled($newImage,$imagecreatefrom,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        
        switch($this->mime_type) {
            case "image/gif":
                imagegif($newImage,$thumb_image_name); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$thumb_image_name,90); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);	// Save the image
                break;
        }
        
        chmod($thumb_image_name, 0777);
    }
    
    /**
     * Image Crop
     * 
     * Peform image crop based on parameters passed. 
     * 
     * @param      
     * @return     $param;
     */ 
    public function crop($imgSrc,$thumbnail_width,$thumbnail_height,$imagecreatefrom ) 
    { 
        //getting the image dimensions 
        list($width_orig, $height_orig) = getimagesize($imgSrc); 
        $myImage    = $imagecreatefrom($imgSrc);
        $ratio_orig = $width_orig/$height_orig;
       
        if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
           $new_height = $thumbnail_width/$ratio_orig;
           $new_width  = $thumbnail_width;
        } else {
           $new_width  = $thumbnail_height*$ratio_orig;
           $new_height = $thumbnail_height;
        }
       
        $x_mid      = $new_width/2;  //horizontal middle
        $y_mid      = $new_height/2; //vertical middle       
        $process    = imagecreatetruecolor(round($new_width), round($new_height));
        
        imagealphablending($process, false);
        imagesavealpha($process, true);
        $bg = imagecolorallocatealpha($process, 0, 0, 0, 127);
        imagefilledrectangle($process, 0, 0, $newImageWidth, $newImageHeight, $bg);
        imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
        
        $thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
        $bg = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
        imagefilledrectangle($thumb, 0, 0, $newImageWidth, $newImageHeight, $bg);
        imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);

        imagedestroy($process);
        imagedestroy($myImage);
        
        return $thumb;
    }

    /**
     * Return the image height
     * 
     * Long description of the function 
     * 
     * @param      
     * @return     $param;
     */ 
    public function getHeight($image) {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
    }
    
    /**
     * Return the image width
     * 
     * Long description of the function 
     * 
     * @param      
     * @return     $param;
     */ 
    public function getWidth($image) {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
    }
    
    public function get($key)
    {
        return $this->$key;
    }

}

# $resizeObj = new resize('images/cars/large/input.jpg');
# $resizeObj -> resizeImage(150, 100, 0);
# $resizeObj -> saveImage('images/cars/large/output.jpg', 100);

/**
 * class.photo_crop.php
 * 
 * @author      http://stackoverflow.com/questions/17231648/transparent-background-of-png-saves-as-black
 * @source      http://code.tutsplus.com/tutorials/image-resizing-made-easy-with-php--net-10362
 * @updated     01/23/2014
 */
class resize {
    // *** Class variables
    private $image;
    private $width;
    private $height;
    private $imageResized;

    public function __construct($fileName, $userfile_tmp = '') 
	{
		//move_uploaded_file($userfile_tmp, $fileName);
		//chmod($fileName, 0777);
			
        // *** Open up the file
        $this->image = $this->openImage($fileName);

        // *** Get width and height
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    ## --------------------------------------------------------

    private function openImage($file)
    {
        // *** Get extension
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

	## --------------------------------------------------------

	public function resizeImage($newWidth, $newHeight, $option = "auto")
	{
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

        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);

        // *** if option is 'crop', then crop too
        if ($option == 'crop') {
        $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
        }
    }

    ## --------------------------------------------------------

    private function getDimensions($newWidth, $newHeight, $option)
	{
        switch ($option)
        {
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
            case 'auto':
                $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    ## --------------------------------------------------------

    private function getSizeByFixedHeight($newHeight)
    {
        $ratio = $this->width / $this->height;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    private function getSizeByFixedWidth($newWidth)
    {
        $ratio = $this->height / $this->width;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }

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

    ## --------------------------------------------------------

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

    ## --------------------------------------------------------

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

    ## --------------------------------------------------------

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
}