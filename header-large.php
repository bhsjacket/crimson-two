<header class="large-header">
    <?php if($_COOKIE['notification'] !== 'closed' && !empty(get_field('notification_url', 'option')) && !empty(get_field('notification_text', 'option'))) { ?>
    <a href="<?php echo esc_url(get_field('notification_url', 'option')); ?>" id="notification">
        <div class="notification-inner">
            <span class="notification-text"><?php echo esc_html(get_field('notification_text', 'option')); ?></span>
            <i class="far fa-times notification-close"></i>
        </div>
    </a>
    <?php } ?>

    <div class="large-header-inner">
        <div class="large-header-top">
            <i class="far fa-search"></i>
            <a href="" class="button">Donate</a>
        </div>
        <div class="large-header-middle">
            <div class="large-header-motto">
                <span>The Voice of the Students</span>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-dark.svg">
            <div class="large-header-date">
                <time><?php echo date('l, F j, Y'); ?></time>
            </div>
        </div>
    </div>
</header>