<?php

// REGISTER SITE OPTIONS PAGE

acf_add_options_page([
    'page_title' => 'Site Options',
    'menu_title' => 'Site Options',
    'menu_slug' => 'site-options',
    'capability' => 'edit_posts',
    'position' => '2.1',
    'icon_url' => 'dashicons-laptop',
    'redirect' => true,
    'post_id' => 'options',
    'autoload' => false,
    'update_button' => 'Update',
    'updated_message' => 'Updated',
]);

// REGISTER BLOCKS

acf_register_block_type([
    'name' => 'cta',
    'title' => 'Call to Action',
    'category' => 'layout',
    'keywords' => [ 'cta', 'call to action', 'podcast', 'newsletter', 'donation', 'money', 'subscribe', 'traffic', 'click', 'link' ],
    'mode' => 'auto',
    'render_template' => 'blocks/cta.php',
    'enqueue_style' => get_template_directory_uri() . '/blocks/cta.css',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/><path d="M22,9v6c0,1.1-0.9,2-2,2h-1l0-2h1V9H4v6h6v2H4c-1.1,0-2-0.9-2-2V9c0-1.1,0.9-2,2-2h16C21.1,7,22,7.9,22,9z M14.5,19 l1.09-2.41L18,15.5l-2.41-1.09L14.5,12l-1.09,2.41L11,15.5l2.41,1.09L14.5,19z M17,14l0.62-1.38L19,12l-1.38-0.62L17,10l-0.62,1.38 L15,12l1.38,0.62L17,14z M14.5,19l1.09-2.41L18,15.5l-2.41-1.09L14.5,12l-1.09,2.41L11,15.5l2.41,1.09L14.5,19z M17,14l0.62-1.38 L19,12l-1.38-0.62L17,10l-0.62,1.38L15,12l1.38,0.62L17,14z"/></g></svg>',
    'supports' => [
        'align' => false,
        'mode' => false,
        'multiple' => true,
    ],
]);

acf_register_block_type([
    'name' => 'embed',
    'title' => 'Custom HTML',
    'category' => 'embed',
    'keywords' => [ 'embed', 'advanced', 'iframe', 'html', 'code' ],
    'mode' => 'edit',
    'align_content' => null,
    'render_template' => 'blocks/embed.php',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>',
    'supports' => [
        'align' => false,
        'mode' => false,
        'multiple' => true,
        '__experimental_jsx' => false,
        'align_content' => false,
    ],
]);

acf_register_block_type([
    'name' => 'extended-image',
    'title' => 'Image',
    'category' => 'common',
    'keywords' => [ 'image', 'photo', 'picture' ],
    'mode' => 'auto',
    'align_content' => null,
    'render_template' => 'blocks/image.php',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4.86 8.86l-3 3.87L9 13.14 6 17h12l-3.86-5.14z"/></svg>',
    'supports' => [
        'align' => [ 'left', 'center', 'right', 'wide', 'full' ],
        'mode' => false,
        'multiple' => true,
        '__experimental_jsx' => false,
        'align_content' => false,
    ],
]);

acf_register_block_type([
    'name' => 'podcast',
    'title' => 'Podcast',
    'category' => 'embed',
    'keywords' => [ 'podcast', 'berkeley high jacket podcast', 'jacket podcast', 'radio', 'audio' ],
    'mode' => 'auto',
    'align' => 'center',
    'render_template' => 'blocks/podcast.php',
    'enqueue_style' => get_template_directory_uri() . '/blocks/podcast.css',
    'enqueue_script' => get_template_directory_uri() . '/blocks/podcast.js',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s-1-.45-1-1V5zm6 6c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>',
    'supports' => [
        'align' => false,
        'mode' => false,
        'multiple' => false,
    ],
]);

acf_register_block_type([
    'name' => 'video',
    'title' => 'Video',
    'category' => 'embed',
    'keywords' => [ 'video', 'youtube', 'embed', 'movie' ],
    'mode' => 'auto',
    'render_template' => 'blocks/video.php',
    'enqueue_style' => get_template_directory_uri() . '/blocks/video.css',
    'enqueue_script' => get_template_directory_uri() . '/blocks/video.js',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>',
    'supports' => [
        'align' => [ 'center', 'wide' ],
        'mode' => false,
        'multiple' => true,
    ],
]);

acf_register_block_type([
    'name' => 'audio',
    'title' => 'Audio',
    'category' => 'embed',
    'keywords' => [ 'audio', 'sound', 'embed', 'upload' ],
    'mode' => 'edit',
    'render_template' => 'blocks/audio.php',
    'enqueue_style' => get_template_directory_uri() . '/blocks/audio-block.css',
    'enqueue_script' => get_template_directory_uri() . '/blocks/audio.js',
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>',
    'supports' => [
        'align' => [ 'center' ],
        'mode' => false,
        'multiple' => true,
    ],
]);