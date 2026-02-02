<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Erwartet: $tree = FSD_Nav_Navigation_Service::get_navigation_tree( 'main' );
 */

if ( empty( $tree ) ) {
    return;
}

function fsd_nav_render_items( $items ) {
    if ( empty( $items ) ) {
        return;
    }

    echo '<ul class="fsd-nav">';
    foreach ( $items as $item ) {
        $has_children = ! empty( $item['children'] );
        $classes      = array( 'fsd-nav__item' );
        if ( $has_children ) {
            $classes[] = 'fsd-nav__item--has-children';
        }

        echo '<li class="' . esc_attr( implode( ' ', $classes ) ) . '">';
        echo '<a class="fsd-nav__link" href="' . esc_url( $item['url'] ) . '">';
        echo esc_html( $item['title'] );
        echo '</a>';

        if ( $has_children ) {
            fsd_nav_render_items( $item['children'] );
        }

        echo '</li>';
    }
    echo '</ul>';
}

fsd_nav_render_items( $tree );