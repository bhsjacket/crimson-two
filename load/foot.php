<script src="<?php echo get_template_directory_uri(); ?>/js/js.cookie.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/medium-zoom.min.js"></script>

<?php if( is_singular('post') ) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/single.js"></script>
<?php } ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/javascript.js"></script>

<?php wp_footer(); ?>
</body>
</html>