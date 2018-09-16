<?php
// Create MKB CPT
function aampv_cpt() {
    $args = array(
        'public'   => true,
        'label'    => 'Popup Video',
        // 'menu_icon' => 'dashicons-book',
        'supports' => array('title')
    );
    register_post_type( 'aampv_video', $args );
}
add_action( 'init', 'aampv_cpt' );
