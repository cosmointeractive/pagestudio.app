<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    
    <title><?php echo $page['title']; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/error.css" type="text/css" media="screen" />
</head>
<body>
    <div id="container">        
        <h1><?php echo $page['heading']; ?></h1>
        <p><?php echo $page['message']; ?></p>        
    </div>
</body>
</html>
<?php

/* End of file error_view.php */
/* Location: ./application/views/error_view.php */