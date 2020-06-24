<?php
/*
Color Values:
- 'red-accent'
- 'yellow-accent'
- 'green-accent'
- 'blue-accent'
- 'purple-accent'
- 'black-line' (only for title)
- 'gray-accent'
*/
?>

<?php get_header(); ?>
<main id="front-page">

<?php

while ( have_rows('sections', 'option') ) : the_row();

    if( get_row_layout() == 'dense' ): // Dense Layout
        set_query_var( 'params', get_sub_field( 'dynamic_content' ) );
        get_template_part( 'parts/front-page/dense' );

    elseif( get_row_layout() == 'row' ): // Row Layout
        set_query_var( 'params', [
            'title' => get_sub_field( 'title' ) ?? '',
            'posts' => get_sub_field( 'posts' ) ?? '4',
            'style_options' => get_sub_field( 'style_options' ) ?? '',
            'color' => get_sub_field( 'color' ) ?? 'red-accent',
            'tag' => get_sub_field( 'tag' ) ?? '',
            'category' => get_sub_field( 'category' ) ?? '',
            'offset' => get_sub_field( 'offset' ) ?? 0,
        ] );
        get_template_part( 'parts/front-page/row' );

    elseif( get_row_layout() == 'title' ): // Standalone Title
        set_query_var( 'params', [
            'text' => get_sub_field( 'text' ) ?? '',
            'color' => get_sub_field( 'color' ) ?? 'red-accent',
        ] );
        get_template_part( 'parts/front-page/title' );

    elseif( get_row_layout() == 'two_columns' ): // Two Column Layout
        set_query_var( 'params', [
            'title' => get_sub_field( 'title' ) ?? '',
            'color' => get_sub_field( 'color' ) ?? 'red-accent',
            'tag' => get_sub_field( 'tag' ) ?? '',
            'category' => get_sub_field( 'category' ) ?? '',
            'offset' => get_sub_field( 'offset' ) ?? 0,
            'position' => get_sub_field( 'position' ) ?? 'large-on-right',
        ] );
        get_template_part( 'parts/front-page/two-columns' );

    elseif( get_row_layout() == 'columnists' ):
        get_template_part( 'parts/front-page/columnists' );

    endif;

endwhile;

?>

</main>
<?php get_footer(); ?>