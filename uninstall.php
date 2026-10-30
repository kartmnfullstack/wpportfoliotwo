<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

$bs_cards = get_posts( array(
    'post_type'   => 'bs_card',
    'post_status' => 'any',
    'numberposts' => -1,
) );

if ( ! empty( $bs_cards ) ) {
    foreach ( $bs_cards as $card ) {
        wp_delete_post( $card->ID, true );
    }
}