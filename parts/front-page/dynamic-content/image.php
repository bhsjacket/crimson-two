<style>
    .image-dc img {
        object-fit: cover;
        object-position: left;
        width: 100%!important;
        height: 100%!important;
    }
</style>

<a href="<?php echo get_field('dynamic_content_image_url', 'option'); ?>" class="image-dc">
    <img src="<?php echo get_field('dynamic_content_image', 'option') ?>">
</a>