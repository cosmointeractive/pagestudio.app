<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    
    <title>{{ site_title }}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Display page level stylesheets set in the page level controller classes -->
    {{ if page_style }}
        {{ page_style }}
            <link rel="stylesheet" href="{{ source }}" type="text/css" media="screen" />
        {{ /page_style }}
    {{ else }}
        <link rel="stylesheet" href="{{ BASE_URL }}static/css/style.css" type="text/css" media="screen" />
    {{ endif }}
</head>
<body>