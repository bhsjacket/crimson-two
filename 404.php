<?php get_header(); ?>
<main id="error">
    <h1>Page not found</h1>
</main>

<style>
body.error404 {
    overflow: hidden;
}

main#error {
    height: 100vh;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/404.jpg');
    background-size: cover;
    background-attachment: fixed;
}

main#error > h1 {
    font-family: var(--display);
    font-style: italic;
    color: white;
    margin: 0;
    padding: 100px;
    font-size: 48px;
}

@media all and (max-width: 600px) {
    main#error {
        background-position: 50%;
        text-align: center;
    }
}
</style>
<?php get_footer(); ?>
