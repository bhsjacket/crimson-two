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
    <?php } else { ?>
    <link href="<?php echo get_template_directory_uri(); ?>/css/single.css?version=<?php echo uniqid(); ?>" rel="stylesheet">
    <?php } ?>
    
    <link href="<?php echo get_template_directory_uri(); ?>/css/libs/balloon.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/libs/swiper.min.css" rel="stylesheet">

    <!-- Favicon & App Icons -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.png">
    
    <!-- Font Awesome & Fonts -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/load.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/erm4tbu.css?version=5edc8392a7d5b">

    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>

    <!-- wp_head(); -->
    <?php wp_head(); ?>
</head>
<?php
$bodyClasses = get_body_class();
foreach( $bodyClasses as $class ) {
    $classes = $classes . $class . ' ';
}
if($_COOKIE['dark-mode'] == 'true') {
    $classes = $classes . 'jkt-dark-theme';
}
?>
<body class="<?php echo $classes ?>">