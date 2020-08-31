<?php date_default_timezone_set( get_option('timezone_string') ); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.png">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="mobile-menu-outer">
        <div class="mobile-menu">
            <?php wp_nav_menu(array(
                'menu' => wp_get_nav_menu_name( 'sections' ),
                'menu_class' => "menu-items",
                'container' => "nav",
                'container_id' => "menu",
                'depth' => "1",
            )); ?>
        </div>
    </div>

    <header class="site-header">
        <?php if($_COOKIE['notification'] !== 'closed' && !empty(get_field('notification_url', 'option')) && !empty(get_field('notification_text', 'option'))) { ?>
        <a href="<?php echo esc_url(get_field('notification_url', 'option')); ?>" id="notification">
            <div class="notification-inner">
                <span class="notification-text"><?php echo esc_html(get_field('notification_text', 'option')); ?></span>
                <i class="far fa-times notification-close"></i>
            </div>
        </a>
        <?php } ?>
        <div class="search-dropdown header-dropdown">
            <div class="search-dropdown-inner">
                <form class="search-dropdown-form" method="get" action="<?php echo home_url('/'); ?>">
                    <i class="far fa-search"></i>
                    <input type="text" class="search-field" name="s" value="<?php the_search_query(); ?>" placeholder="Enter your search term and press enter...">
                </form>
            </div>
        </div>
        <div class="sections-dropdown header-dropdown">
            <div class="sections-dropdown-inner">
                <ul>
                <?php
                    wp_nav_menu(array(
                        'menu' => wp_get_nav_menu_name( 'sections' ),
                        'menu_class' => "menu-items",
                        'container' => "nav",
                        'container_id' => "menu",
                        'depth' => "1",
                    )); ?>
                </ul>
                <?php if(is_user_logged_in()) { ?>
                <a href="<?php echo wp_logout_url( get_site_url() ); ?>" class="login-link">Logout</a>
                <?php } else { ?>
                <a href="<?php echo wp_login_url(); ?>" class="login-link">Login</a>
                <?php } ?>
            </div>
        </div>
        <div class="donation-dropdown header-dropdown">
            <div class="donation-dropdown-inner">
                <div class="donation-dropdown-left">
                    <i class="far fa-newspaper"></i>
                    <span>Help us continue to provide a platform for professional-level student journalism.</span>
                </div>
                <div class="donation-dropdown-right">
                    <div class="donation-dropdown-form">
                        <form action="https://jeromepaulos.com/bhsjacket/donation/donation.php" method="post" target="_blank">
                            <input type="hidden" name="page" value="<?php echo get_site_url() . $_SERVER['REQUEST_URI']; ?>">
                            <select name="amount">
                                <option value="10.00">$10</option>
                                <option value="25.00" selected>$25</option>
                                <option value="50.00">$50</option>
                                <option value="100.00">$100</option>
                                <option value="Other">Other</option>
                            </select>
                            <input type="submit" value="Support the Jacket">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="default-header">
            <div class="header-inner">
                <div class="header-left">
                    <ul>
                        <li class="sections-toggle"><i class="far fa-bars"></i><span>Sections</span></li>
                        <li class="mobile-menu-toggle"><i class="far fa-bars"></i><span>Sections</span></li>
                        <li><a href="/section/news">News</a></li>
                        <li><a href="/section/features">Features</a></li>
                        <li><a href="/section/opinion">Opinion</a></li>
                    </ul>
                </div>
                <div class="header-center">
                    <a href="<?php echo get_site_url(); ?>">
                        <img class="header-logo" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-dark.svg">
                    </a>
                </div>
                <div class="header-right">
                    <ul>
                        <li><a href="/about/contact">Send Tips</a></li>
                        <li class="header-button">Support Us</li>
                        <li class="search-toggle search-toggle-mobile"><span>Search</span><i class="far fa-search"></i></li>
                        <li class="search-toggle"><i class="far fa-search"></i></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sticky-sections">
            <div class="sticky-sections-inner">
                <div class="sticky-sections-left">
                    <?php
                    wp_nav_menu(array(
                        'menu' => wp_get_nav_menu_name( 'sections' ),
                        'menu_class' => "menu-items",
                        'container' => "nav",
                        'container_id' => "menu",
                        'depth' => "1",
                    )); ?>
                </div>
                <div class="sticky-sections-right">
                    <ul>
                        <li><a href="/about/contact">Send Tips</a></li>
                        <li class="header-button">Support Us</li>
                        <li class="search-toggle"><i class="far fa-search"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if(is_singular(array('post', 'column'))) { ?>
        <div class="progress-bar"></div>
        <?php } ?>
    </header>