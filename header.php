<?php get_template_part('load/head'); ?>

<div class="mobile-menu-outer">
    <div class="mobile-menu">
              <?php
                wp_nav_menu(array(
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
			<a href="<?php echo wp_logout_url(get_site_url()) ?>" class="login-link">Logout</a>
			<?php } else { ?>
            <a href="/login?token=<?php echo uniqid(); ?>" class="login-link">Login</a>
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
					<?php if(is_front_page()) { ?>
					<svg class="header-logo" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="0 0 400 44.548">
						<style>
							<![CDATA[
							.logo-animated {
								transform: translateY(0%);
								transition: transform 750ms cubic-bezier(0.75, 0, 0.175, 1);
							}
							.logo-animate {
								transform: translateY(100%);
							}
							]]>
						</style>
						<path class="logo-animated" d="M172.384 0q3.48 0 7.057-2.744 3.529-2.696 3.529-8.381v-29.061q0-2.794 1.715-3.676h-9.164q1.715.588 1.715 3.676v29.061q0 3.186-1.127 6.126-1.323 3.333-3.725 4.999zm22.593-11.125v-20.779q0-.196.098-.196.588 0 1.274 1.323.539 1.176.686 1.912.588 2.989 1.029 5.194.441 2.206.735 3.725l1.225 6.616q.491 1.96.883 3.431.392 1.47.686 2.45h7.89q-.686-.686-1.201-1.299-.514-.612-.857-1.151-.637-1.079-1.324-3.725-.196-.735-.441-1.74t-.49-2.279l-1.764-8.625q-.882-4.509-1.813-5.685-1.029-1.47-2.892-1.764-.343-.049-.588-.049h-.392q-.147-.049-.294-.294.049-.147.196-.294 1.96-2.353 3.112-3.676 1.152-1.323 1.495-1.715 2.401-2.402 5.685-4.117h-7.841q.784.49.784 1.666 0 1.275-1.422 2.99l-3.528 4.313q-.098.147-.539.392-.392 0-.392-.784v-4.901q0-2.794 1.715-3.676h-9.164q1.715.588 1.715 3.676v29.061q0 2.941-1.715 3.676h9.164q-1.715-.98-1.715-3.676zm32.639-32.737h-16.222v10.145h.294q.735-3.774 1.961-6.224 1.225-2.353 2.254-2.353.735 0 .735.588v30.581q0 2.941-1.715 3.676h9.164q-1.715-.98-1.715-3.676v-30.581q0-.588.735-.588 1.029 0 2.205 2.059 1.471 2.597 2.059 6.518h.245v-10.145z" fill-rule="evenodd" />
						<path class="logo-animated" d="M288.165 44.548q3.479 0 7.057-2.745 3.528-2.695 3.528-8.38V4.362q0-2.794 1.716-3.676h-9.165q1.715.588 1.715 3.676v29.061q0 3.186-1.127 6.126-1.323 3.333-3.724 4.999zm16.613-13.771l3.186-18.133q3.038 0 4.312 6.861l2.108 11.958q.147.833.147 1.911 0 2.549-1.47 3.725h10.34q-2.303-1.029-3.136-5.538L314.972.686h-9.165q1.961 1.372 1.961 4.313 0 .882-.049 1.078L303.21 31.61q-.098.392-.196.71-.098.319-.196.564-1.176 3.137-3.235 4.215h7.842q-1.569-.833-2.157-1.887-.588-1.054-.588-2.916 0-.49.025-.882.024-.392.073-.637zm5.979-19.897h-2.45l.441-2.549q.245-1.47.465-2.573.221-1.102.319-1.837.49 2.597.809 4.312.318 1.716.416 2.647zm27.15 4.116V0q-1.764 1.274-2.058 1.176-3.087-.784-3.92-.784-3.872 0-6.715 4.166-2.891 4.214-2.891 12.203 0 6.126 2.793 13.477 2.794 7.351 7.548 7.351 2.646 0 4.067-2.794 1.961-3.969 1.961-9.458 0-1.568-.736-1.568-1.127 0-1.127 1.029 0 5.293-1.078 8.723-.784 2.549-2.646 2.549-1.618 0-2.5-2.745-.392-1.274-.661-2.328-.27-1.053-.466-1.886-.441-5.195-.441-8.136-.147-3.136-.147-4.655 0-3.627.147-6.371.147-2.745.49-4.656.539-3.333 2.941-3.333 1.372 0 1.911 1.127.637 1.471.784 3.186v1.715q0 .833.049 1.667.049 1.421.735 2.989.833 1.764 1.96 2.352zm11.076 18.427V12.644q0-.196.098-.196.588 0 1.274 1.323.539 1.176.686 1.911.589 2.99 1.03 5.195.441 2.206.735 3.725l1.225 6.616q.49 1.96.882 3.43.392 1.471.686 2.451h7.89q-.686-.686-1.2-1.299-.515-.613-.858-1.152-.637-1.078-1.323-3.724-.196-.735-.441-1.74t-.49-2.279l-1.765-8.625q-.882-4.509-1.813-5.685-1.029-1.47-2.891-1.764-.343-.049-.588-.049h-.393q-.146-.049-.293-.294.048-.147.196-.294 1.96-2.353 3.112-3.676 1.151-1.323 1.494-1.715 2.402-2.402 5.685-4.117h-7.841q.784.49.784 1.666 0 1.275-1.421 2.99l-3.529 4.313q-.098.147-.539.392-.392 0-.392-.785v-4.9q0-2.794 1.715-3.676h-9.164q1.715.588 1.715 3.676v29.061q0 2.941-1.715 3.676h9.164q-1.715-.98-1.715-3.676zm17.398 3.676h15.486V25.974h-.245q-.441 3.038-1.764 5.93-1.862 3.774-4.166 3.774-1.862 0-1.862-2.157V14.212q0-1.568 1.568-1.568 1.617 0 2.892 3.087 1.029 2.598 1.029 4.509h.294v-9.262h-5.783V4.215q0-1.667 1.568-1.667 3.284 0 4.901 2.745 1.323 2.303 1.323 5.783h.245V.686h-15.486q1.715.588 1.715 3.676v29.061q0 1.715-.588 2.5-.833 1.078-1.127 1.176zM400 .686h-16.222v10.145h.295q.735-3.774 1.96-6.224 1.225-2.353 2.254-2.353.735 0 .735.588v30.581q0 2.941-1.715 3.676h9.165q-1.716-.98-1.716-3.676V2.842q0-.588.735-.588 1.029 0 2.206 2.059 1.47 2.597 2.058 6.518H400V.686zM205.048 12.252v21.171q0 2.941-1.716 3.676h9.165q-1.715-.98-1.715-3.676V4.362q0-2.794 1.715-3.676h-9.165q1.716.588 1.716 3.676v6.518H200V4.362q0-2.794 1.715-3.676h-9.164q1.715.588 1.715 3.676v29.061q0 2.941-1.715 3.676h9.164Q200 36.119 200 33.423V17.496q-.098-1.176.27-2.132.367-.956 1.053-1.642.686-.686 1.642-1.078.956-.392 2.083-.392zm17.741 21.171V4.362q0-2.794 1.715-3.676h-9.165q1.716.588 1.716 3.676v29.061q0 2.941-1.716 3.676h9.165q-1.715-.98-1.715-3.676zm21.416 4.264V14.898q0-2.793 1.715-3.675h-9.164q1.715.686 1.715 3.675v19.015q0 1.961-1.127 1.961-1.765 0-2.402-3.872-1.029-5.93-1.029-15.682 0-6.077.931-11.321.539-3.039 2.647-3.039 2.107 0 2.94 2.745.098.686.196 1.151.098.466.147.809.441 2.156 2.549 3.333V0q-.441.392-.882.809-.442.416-1.177.416-.392 0-1.274-.343-.98-.392-1.225-.441-.245-.049-.686-.049h-1.127q-2.01 0-4.313 1.862-5.293 4.362-5.293 14.507 0 4.9 1.372 9.458 1.569 5.293 4.362 8.38 2.402 2.794 4.607 2.794.735 0 2.107-.539 1.47-.539 2.156-.539 1.226 0 2.255 1.372zm15.535-25.435v21.171q0 2.941-1.715 3.676h9.164q-1.715-.98-1.715-3.676V4.362q0-2.794 1.715-3.676h-9.164q1.715.588 1.715 3.676v6.518h-5.048V4.362q0-2.794 1.716-3.676h-9.165q1.716.588 1.716 3.676v29.061q0 2.941-1.716 3.676h9.165q-1.716-.98-1.716-3.676V17.496q-.098-1.176.27-2.132.368-.956 1.054-1.642.686-.686 1.641-1.078.956-.392 2.083-.392zM26.464 4.754q0-4.068-6.665-4.068H8.233q-.196 0-.563-.049-.368-.049-.515-.049H6.077q-2.549 0-4.215 1.372Q0 3.431 0 5.881 0 7.89 1.372 9.458q1.421 1.569 3.284 1.569 2.156 0 2.744-.98-2.744-.54-2.744-3.725 0-1.617.882-2.793.882-1.177 2.45-1.177 2.353 0 2.353 2.01v29.061q0 2.206-1.716 3.676h7.645q2.99 0 5.048-2.157.98-.98 1.691-1.935.711-.956 1.25-1.789 3.283-5.244 3.283-10.782 0-8.233-7.841-9.409 6.763-2.549 6.763-6.273zm-10.39 29.551V13.33q0-.98.932-.98 4.508 0 4.508 9.801 0 4.852-.637 7.45-1.421 5.978-3.626 5.978-1.177 0-1.177-1.274zm0-25.092v-5.39q0-1.618 2.353-1.618 1.274 0 2.083.809.808.809.808 2.083 0 2.254-1.617 3.773-1.666 1.569-2.744 1.569-.883 0-.883-1.226zm14.311 27.886h15.486V25.974h-.245q-.441 3.038-1.764 5.93-1.863 3.774-4.166 3.774-1.862 0-1.862-2.157V14.212q0-1.568 1.568-1.568 1.617 0 2.892 3.087 1.029 2.598 1.029 4.509h.294v-9.262h-5.783V4.215q0-1.667 1.568-1.667 3.284 0 4.901 2.745 1.323 2.303 1.323 5.783h.245V.686H30.385q1.715.588 1.715 3.676v29.061q0 1.715-.588 2.5-.833 1.078-1.127 1.176zM56.212 9.703V4.362q0-2.108 1.911-2.108 2.548 0 2.548 3.137 0 2.009-1.274 3.528-1.274 1.471-2.499 1.471-.686 0-.686-.687zM62.044.686H48.763q1.715.588 1.715 3.676v29.061q0 2.941-1.715 3.676h9.164q-1.715-.98-1.715-3.676V12.987q2.107.245 2.597 2.646.343 1.422.809 4.093.465 2.67 1.151 6.64 1.177 6.861 2.206 10.733h7.743q-2.107-1.372-2.793-3.627-.981-4.264-1.691-7.4-.711-3.136-1.103-5.342-.539-2.793-.808-5.121-.27-2.328-.27-4.19-2.401.539-4.019.539-.441 0-.955-.049-.515-.049-1.103-.147 3.627-.686 5.881-2.156 3.087-1.961 3.087-4.999 0-1.961-1.519-2.99-1.274-.931-3.381-.931zm19.015 32.737V12.644q0-.196.098-.196.588 0 1.274 1.323.539 1.176.686 1.911.588 2.99 1.029 5.195.441 2.206.735 3.725l1.225 6.616q.49 1.96.882 3.43.392 1.471.687 2.451h7.89q-.686-.686-1.201-1.299-.514-.613-.857-1.152-.638-1.078-1.324-3.724-.196-.735-.441-1.74t-.49-2.279l-1.764-8.625q-.882-4.509-1.813-5.685-1.03-1.47-2.892-1.764-.343-.049-.588-.049h-.392q-.147-.049-.294-.294.049-.147.196-.294 1.96-2.353 3.112-3.676 1.152-1.323 1.495-1.715 2.401-2.402 5.685-4.117h-7.842q.784.49.784 1.666 0 1.275-1.421 2.99L81.99 9.655q-.098.147-.539.392-.392 0-.392-.785v-4.9q0-2.794 1.715-3.676h-9.165q1.716.588 1.716 3.676v29.061q0 2.941-1.716 3.676h9.165q-1.715-.98-1.715-3.676zm17.397 3.676h15.487V25.974h-.245q-.441 3.038-1.765 5.93-1.862 3.774-4.165 3.774-1.863 0-1.863-2.157V14.212q0-1.568 1.569-1.568 1.617 0 2.891 3.087 1.029 2.598 1.029 4.509h.294v-9.262h-5.783V4.215q0-1.667 1.569-1.667 3.283 0 4.9 2.745 1.324 2.303 1.324 5.783h.245V.686H98.456q1.715.588 1.715 3.676v29.061q0 1.715-.588 2.5-.833 1.078-1.127 1.176zm33.178 0V25.974h-.294q-.392 3.038-1.764 5.881-1.862 3.823-4.166 3.823-1.127 0-1.127-2.157V4.362q0-2.794 1.716-3.676h-9.165q1.715.588 1.715 3.676v29.061q0 2.941-1.715 3.676h14.8zm2.843 0h15.486V25.974h-.245q-.441 3.038-1.764 5.93-1.862 3.774-4.166 3.774-1.862 0-1.862-2.157V14.212q0-1.568 1.568-1.568 1.618 0 2.892 3.087 1.029 2.598 1.029 4.509h.294v-9.262h-5.783V4.215q0-1.667 1.568-1.667 3.284 0 4.901 2.745 1.323 2.303 1.323 5.783h.245V.686h-15.486q1.715.588 1.715 3.676v29.061q0 1.715-.588 2.5-.833 1.078-1.127 1.176zM162.852.686h-9.997q1.568.735 2.303 2.45l3.725 8.724v21.563q0 2.941-1.716 3.676h9.165q-1.715-.98-1.715-3.676V11.86l3.234-7.351q1.176-2.745 3.725-3.823h-6.028q1.029.686 1.029 1.96 0 1.422-.294 2.059l-2.108 4.753-2.009-4.753q-.49-1.127-.49-2.059 0-1.372 1.176-1.96z" />
					</svg>
					<?php } else { ?>
					<img class="header-logo" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-dark.svg">
					<?php } ?>
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