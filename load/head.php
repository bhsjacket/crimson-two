<?php date_default_timezone_set( get_option('timezone_string') ); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="<?php echo get_template_directory_uri(); ?>/style.css?version=<?php echo uniqid(); ?>" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/dark-mode.css?version=<?php echo uniqid(); ?>" rel="stylesheet">
    <?php if(is_front_page()) { ?>
    <link href="<?php echo get_template_directory_uri(); ?>/css/front-page.css?version=<?php echo uniqid(); ?>" rel="stylesheet">
    <?php } ?>
    
    <link href="<?php echo get_template_directory_uri(); ?>/css/libs/balloon.min.css" rel="stylesheet">

    <!-- Favicon & App Icons -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.png">
    
    <!-- Font Awesome & Fonts -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/load.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/erm4tbu.css">

    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>

    <!-- wp_head(); -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>