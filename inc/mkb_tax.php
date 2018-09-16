<?php
function aampv_vd_tax(){
$labels = array(
		'name'                 => _x( 'Category', 'aampv' ),
	);
	$args = array(
		'hierarchical'          => true,
		"public" 				=> true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'video-category' ),
	);
register_taxonomy('aampv_video_cat', 'aampv_video', $args);
}
add_action("init","aampv_vd_tax");
