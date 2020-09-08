<?php

function prfx_conditional_user_content( $attributes, $content = null ) {

    if( is_user_logged_in() ) {
        $meta = $attributes['meta'];
        $value = $attributes['value'];
        $current_user_meta = get_userdata( get_current_user_id() );

        if( $current_user_meta->$meta === $value ) {
            return $content;
        }
    }

    return '';

}

add_shortcode( 'conditional-content', 'prfx_conditional_user_content' );