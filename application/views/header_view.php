<!DOCTYPE html>
<html lang="en">
<head>    
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="asset-host" content="">
    <meta name="asset-provider" content="default">
    
    <title><?php echo ( isset($page['title']) ) ? $page['title'] : 'Welcome to PageStudio'; ?></title>
    <meta name="description" content="A simple content management system for folks who want to get things done!">
    <meta name="author" content="Cosmo Mathieu">
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
    
    <!-- stylesheets
	============================================= -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>public_html/themes/_system/css/style.css" media="screen" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>public_html/themes/_system/css/menu.css" media="screen" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>public_html/themes/_system/css/ui-icons.css" media="screen" rel="stylesheet">
    <link href="http://localhost/php_playground/fullcalendar-2.1.1/lib/jquery-ui.min.css" media="screen" rel="stylesheet">
    <?php 
    // Display page level stylesheets set in the page level controller classes
    if($this->pageCSS()) {
        foreach( $this->pageCSS() as $stylesheet ) {
            echo '<link href="' . $stylesheet . '" rel="stylesheet">' . "\n";
        }; 
    }
    ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
    
    <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>public_html/themes/_system/ico/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>public_html/themes/_system/ico/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE_URL; ?>public_html/themes/_system/ico/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE_URL; ?>public_html/themes/_system/ico/apple-touch-icon-114x114.png">
    
</head>
<body>

    <div class="wrapper">

        <nav id="main_navigation" class="nav-menu-panel-left">            
            <ul class="nav-main">					
                <li class="first <?php 
                    if(Url::segment(0) === 'admin') {
                        echo 'active';
                    }
                ?>">
                    <a href="<?php echo BASE_URL . 'admin/'; ?>" class="dashboard nav-main-tooltip-right" title="Dashboard"><i class="icon flat icon-dashboard-o"></i> </a>
                </li>
                <li <?php 
                    if( Url::segment(0) === 'plugins' && Url::segment(1) === 'filemanager' || 
                        Url::segment(0) === 'addons' && Url::segment(2) === 'sliders'
                    ) {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#nav-sub-media" class="nav-main-tooltip-right" title="Media&nbsp;files" data-toggle="tab"><i class="icon flat icon-picture-o"></i></a>
                </li>
                <li <?php 
                    if(Url::segment(0) === 'pages') {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#nav-sub-pages" class="nav-main-tooltip-right" title="Manage&nbsp;Pages" data-toggle="tab"><i class="icon flat icon-pages"></i></a>
                </li>
                <li <?php 
                    if(Url::segment(0) === 'entries' || Url::segment(0) === 'categories') {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#nav-sub-posts" class="nav-main-tooltip-right" title="Manage&nbsp;articles" data-toggle="tab"><i class="icon flat icon-plus-circle-o"></i></a></li>	
                <li>
                    <a href="#" class="nav-main-tooltip-right" title="View&nbsp;comments" data-toggle="tab"><i class="icon flat icon-comment-o"></i></a>
                </li>
                <li <?php 
                    if(Url::segment(2) === 'calendar') {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#nav-sub-calendar" class="nav-main-tooltip-right" title="Calendar" data-toggle="tab"><i class="icon flat icon-calendar-o"></i></a>
                </li>
                <li <?php 
                    if(Url::segment(0) === 'users') {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#nav-sub-users" class="nav-main-tooltip-right" title="Manage&nbsp;users" data-toggle="tab"><i class="icon flat icon-user"></i></a>
                </li>
                <li>
                    <a href="#nav-sub-settings" class="nav-main-tooltip-right" title="Site&nbsp;Settings" data-toggle="tab"><i class="icon flat icon-cog-o"></i></a>
                </li>
            </ul>
            <div class="nav-menu-panel-bottom">
                <div class="system-info rotate">
                    Page Studio
                    <br />
                    <span class="version">v 1.1.0</span>
                </div>
                <div class="social-links">
                    <a href="<?php echo BASE_URL . 'login/logout/';?>" class="nav-main-tooltip-right" title="Logout"><i class="icon flat icon-power-off"></i></a>
                </div>
            </div>
        </nav>

        <!-- Add class .open-options-pane to open options-pane -->
        <!-- Add class .collapse-options-pane to close options-pane -->
        <div class="workspace open-left-pane <?php if(options_pane_widgets()) echo 'open-options-pane'; ?>">
            <header class="header">
                <div class="content-header">
                    <h1>
                        <?php echo ( ! empty($page['icon'])) ? $page['icon'] : ''; ?>
                        <?php echo ( ! empty($page['title'])) ? $page['title'] : 'Page Studio'; ?>
                        <small><?php echo ( ! empty($page['description'])) ? $page['description'] : '&nbsp;&nbsp;'; ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <!--
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Calendar</li>
                        -->
                        <?php if(isset($bread)) echo '<i class="fa fa-home"></i> '. $bread; ?> 
                        <?php if(isset($top_action_buttons)) echo $top_action_buttons; ?>
                    </ol>                        
                </div>
            </header>
        
            <!-- #main section -->
            <section class="main_panes">
                <!-- left-pane -->
                <div class="left-pane">
                    <div id="leftPane" class="scrollable">
                        <!-- nav-menu-panel-right -->
                        <nav class="nav-menu-panel-right">
                            <ul id="nav-sub-dashboard" class="nav-sub <?php 
                                if(Url::segment(0) === 'admin') {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Dashboard
                                </li>
                                <li class="menu-widget">
                                    <div class="alert alert-warning">
                                        The main idea of the dashboard is to give you a place where you can get an at-a-glance overview of what’s happening with your site/blog. You can catch up on news, view your draft posts, see who’s linking to you or how popular your content’s been, quickly put out a no-frills post, or check out and moderate your latest comments. It’s like a bird’s eye view of operations, from which you can swoop down into the particular details.
                                    </div>
                                </li>
                                <li class="line"></li>
                                <li>
                                    <a href="<?php echo BASE_URL . 'user_guide/'?>" target="_blank">User Manual</a>
                                    <a href="#" class="nav-sub__config" title="Settings"><i class="fa fa-book"></i></a>
                                </li>
                                <li class="active">
                                    <a href="gallery.html">Video Tutorials</a>
                                    <a href="gallery.html" class="nav-sub__config" title="Settings"><i class="fa fa-file-video-o"></i></a>
                                </li>
                                <li class="tree">
                                    <ul>
                                        <li>
                                            <ul>
                                                <li><a href=""><i class="fa fa-file-video-o"></i>&nbsp; Managing pages</a></li>
                                                <li><a href=""><i class="fa fa-file-video-o"></i>&nbsp; Managing blog articles</a></li>
                                            </ul>
                                        </li>
                                    </ul>                            
                                </li>
                                <li><a href="#"></a></li>
                                <li class="menu-widget">
                                    <ul class="list-group">
                                      <li class="list-group-item"><i class="fa fa-cubes"></i> Modules</li>
                                      <li class="list-group-item"><i class="fa fa-plug"></i> Plugins</li>
                                      <li class="list-group-item"><i class="fa fa-database"></i> Database</li>
                                      <li class="list-group-item"><i class="fa fa-exclamation-triangle"></i> System Health Status</li>
                                      <li class="list-group-item"><i class="fa fa-map-marker"></i> Map Locations</li>
                                    </ul>
                                </li>
                            </ul>
                            <ul id="nav-sub-media" class="nav-sub  <?php 
                                if( Url::segment(0) === 'plugins' && Url::segment(1) === 'filemanager' ||
                                    Url::segment(0) === 'addons' && Url::segment(2) === 'sliders'
                                ) {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Media
                                </li>
                                <li class="menu-widget">
                                    <div class="col-md-">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li <?php if(Url::segment(0) === 'plugins' && Url::segment(1) === 'filemanager') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'plugins/filemanager/'?>">Media Manager</a>
                                    <a href="#" class="nav-sub__config" title="Settings"><i class="fa fa-picture-o"></i></a>
                                </li>
                                <li <?php if(Url::segment(0) === 'addons' && Url::segment(2) === 'sliders') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'addons/load/sliders/'?>">Page Sliders</a>
                                    <a href="#" class="nav-sub__config" title="Settings"><i class="fa fa-picture-o"></i></a>
                                </li>
                                <li class="tree">
                                    <ul>
                                        <li><a href="<?php echo BASE_URL . 'addons/load/sliders/add/'?>"><i class="fa fa-plus"></i> New</a></li>
                                    </ul>                            
                                </li>
                                <li class="menu-widget">                                    
                                    <ul class="list-group">
                                      <li class="list-group-item"><i class="fa fa-desktop"></i>&nbsp; Home page primary</li>
                                      <li class="list-group-item">Dapibus ac facilisis in</li>
                                    </ul>
                                </li>
                            </ul>	
                            <ul id="nav-sub-pages" class="nav-sub <?php 
                                if(Url::segment(0) === 'pages') {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Pages
                                </li>
                                <li class="menu-widget">
                                    <div class="col-md-">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                 Pages are for content such as "About," "Contact," etc. Pages live outside of the normal 
                                                 blog chronology, and are often used to present timeless information about yourself or 
                                                 your site &mdash; information that is always applicable. 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li <?php if(Url::segment(0) === 'pages' && ! Url::segment(1)) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'pages'?>">All Pages</a>
                                    <span class="nav-sub__config"><i class="fa fa-files-o"></i></span>
                                </li>
                                <li <?php if(Url::segment(0) === 'pages' && Url::segment(1) === 'add') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'pages/add/'?>">Add New</a>
                                    <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL . 'pages/add/'?>">Navigation</a>
                                    <span class="nav-sub__config"><i class="fa fa-cog"></i></span>
                                </li>
                                <br/>
                                <li>
                                    <a href="<?php echo BASE_URL . 'pages/add/'?>">Sitemap</a>
                                    <span class="nav-sub__config"><i class="fa fa-sitemap"></i></span>
                                </li>
                                <li class="tree">
                                    <ul>
                                        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
                                        <li>
                                            <i class="fa fa-folder-o"></i> <a href="">About</a>
                                            <ul>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Mission</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                            </ul>
                                        </li>
                                        <li><a href=""><i class="fa fa-file-o"></i> Page</a></li>
                                        <li><a href=""><i class="fa fa-file-o"></i> Private</a></li>
                                        <li>
                                            <a href=""><i class="fa fa-folder-o"></i> About</a>
                                            <ul>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Mission</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                                <li><a href=""><i class="fa fa-file-o"></i> Our Story</a></li>
                                            </ul>
                                        </li>
                                        <li><a href=""><i class="fa fa-image"></i> Portfolio</a></li>
                                        <li><a href=""><i class="fa fa-file-o"></i> Contact</a></li>
                                    </ul>                            
                                </li>
                            </ul>	
                            <ul id="nav-sub-users" class="nav-sub <?php 
                                if(Url::segment(0) === 'users') {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Users                                    
                                </li>
                                <li class="line"><br /></li>
                                <li <?php if(Url::segment(0) === 'users' && ! Url::segment(1)) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'users'?>">All Users</a>
                                    <span class="nav-sub__config"><i class="fa fa-users"></i></span>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL . 'users/add/'?>">Add New</a>
                                    <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
                                </li>						
                                <li <?php if(Url::segment(0) === 'users' && (Url::segment(2) === Session::get(Config::get('session/user_id')))) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'users/edit/' . Session::get(Config::get('session/user_id')); ?>" alt="Change account settings">Your Profile</a>
                                    <span class="nav-sub__config"><i class="fa fa-user"></i></span>
                                </li>
                                <li class="line"></li>
                                <li class="heading">
                                    Extensions
                                </li>
                                <li>
                                    <a href="index.php?module=staff">Staff</a>
                                    <span class="nav-sub__config"><i class="fa fa-users"></i></span>
                                </li>
                            </ul>
                            <!-- Calendar -->
                            <ul id="nav-sub-calendar" class="nav-sub <?php 
                                if(Url::segment(2) === 'calendar') {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Calendar
                                </li>
                                <li class="menu-widget">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            Posts are entries listed in reverse chronological order on the blog home page or on the posts page. 
                                        </div>
                                    </div>
                                </li>
                                <li <?php if(Url::segment(0) === 'addons' && Url::segment(2) === 'calendar' && ! Url::segment(3)) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'addons/load/calendar/'?>">Calendar</a>
                                    <span class="nav-sub__config"><i class="fa fa-calendar"></i></span>
                                </li>
                                <li <?php if(Url::segment(0) === 'addons' && Url::segment(3) === 'table') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'addons/load/calendar/table/'?>">Event List</a>
                                    <span class="nav-sub__config"><i class="fa fa-bars"></i></span>
                                </li>
                            </ul>
                            <!-- Entries and Categories -->
                            <ul id="nav-sub-posts" class="nav-sub <?php 
                                if(Url::segment(0) === 'entries' || Url::segment(0) === 'categories') {
                                    echo 'active';
                                }
                            ?>">
                                <li class="heading">
                                    Posts
                                </li>
                                <li class="menu-widget">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            Posts are entries listed in reverse chronological order on the blog home page or on the posts page. 
                                        </div>
                                    </div>
                                </li>        
                                <li <?php if(Url::segment(0) === 'entries' && Url::segment(1) === 'add') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'entries/add/' ?>">Add New</a>
                                    <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
                                </li>
                                <li <?php if(Url::segment(0) === 'entries' && ! Url::segment(1)) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'entries/' ?>">View All</a>
                                </li>
                                <li class="heading">
                                    Categories
                                </li>
                                <li class="menu-widget">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            Each post in can be filed under one or more Categories. This aids in navigation and allows posts/articles to be grouped with others of similar content. 
                                        </div>
                                    </div>
                                </li>        
                                <li <?php if(Url::segment(0) === 'categories' && Url::segment(1) === 'add') echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'categories/add/' ?>">Add New</a>
                                    <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
                                </li>
                                <li <?php if(Url::segment(0) === 'categories' && ! Url::segment(1)) echo 'class="active"'; ?>>
                                    <a href="<?php echo BASE_URL . 'categories/' ?>">View All</a>
                                </li>
                            </ul>
                            <ul id="nav-sub-settings" class="nav-sub">
                                <li class="heading">
                                    System Settings
                                </li>
                                <li class="menu-widget">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            The system settings and controls screen allows you to manage some of the most basic configuration settings for your site: 
                                            your site's title and location, who may register an account at your site, and how dates and times are calculated and displayed. 
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.php?page_id=5">General</a>
                                    <span class="nav-sub__config"><i class="fa fa-cog"></i></span>
                                </li>
                                <li>
                                    <a href="index.php?page_id=17">Website</a>
                                    <span class="nav-sub__config"><i class="fa fa-cog"></i></span>
                                </li>
                                <li class=""><a href="">Blog</a></li>					
                                <li class=""><a href="">Media</a></li>					
                                <li class=""><a href="">Theme</a></li>					
                                <li class="heading">
                                    E-mail
                                </li>
                                <li class="line"></li>
                                <li class="">
                                    <a href="#email-templates/">Templates</a>
                                </li>
                                <li>
                                    <a href="index.php?page_id=18">Settings</a>
                                    <span class="nav-sub__config"><i class="fa fa-cog"></i></span>
                                </li>				
                                <li class="line"></li>
                                <li class="heading">
                                    Extra
                                </li>
                                <li class="line"></li>
                                <li class="">
                                    <a href="#phpinfo/">PHP Info</a>
                                </li>
                                <li class="">
                                    <a href="#sitemap/">Generate Sitemap</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- // nav-menu-panel-right -->
                    </div>
                </div>
                <!-- // Menu pane -->
                
                <!-- workspace -->
                <div class="edit-pane">
                    <div id="editPane" <?php if( ! empty( $page['body_class'] )) echo body_class($page['body_class']); ?>>