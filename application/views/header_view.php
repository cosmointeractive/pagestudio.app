<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    
    <title><?php echo ( isset($page['title']) ) ? $page['title'] : 'Welcome to PIP'; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <?php 
    // Display page level stylesheets set in the page level controller classes
    if($this->pageCSS()) {
        foreach( $this->pageCSS() as $stylesheet ) {
            echo '<link rel="stylesheet" href="' . $stylesheet . '" type="text/css" />' . "\n";
        }; 
    }
    ?>
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/style.css" type="text/css" media="screen" />
</head>
<body>
