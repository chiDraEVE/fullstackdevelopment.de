<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$tree = isset( $tree ) ? $tree : FSD_Nav_Navigation_Service::get_navigation_tree( 'footer' );

/*if ( empty( $tree ) ) {
    return;
}*/

echo '<nav class="fsd-footer-legal" aria-label="Rechtliches">';
echo '<ul class="fsd-footer-legal__list">';

foreach ( $tree as $item ) {
    echo '<li class="fsd-footer-legal__item">';
    echo '<a class="fsd-footer-legal__link" href="' . esc_url( $item['url'] ) . '">';
    echo esc_html( $item['title'] );
    echo '</a>';
    echo '</li>';
}

echo '</ul>';
echo '</nav>';