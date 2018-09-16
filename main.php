<?php
/*
Plugin Name: aaM Popup Video
Plugin URI: https://wordpress.org/plugins/aam-popup-video/
Description: A Nice Popup Video Plugin for Vimeo and Youtube
Author: Mahin
Version: 1.0
Author URI: http://fb.com/a.a.mahin
License: GPLv2 or later
Text Domain: aampv
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


// Include Required Lib & Others
require_once (dirname(__FILE__)."/inc/mkb_cpt.php");
require_once (dirname(__FILE__)."/inc/mkb_tax.php");
require_once (dirname(__FILE__)."/inc/aampv_meta.php");
require_once (dirname(__FILE__)."/inc/mkb_shortcode.php");





// Enque Required Style & Scripts
function aampv_assets_libs() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'aampv-main-scripts', plugin_dir_url( __FILE__ ) . 'js/YouTubePopUp.jquery.js', array('jquery'), '1', true ); 
		
	wp_enqueue_style('aampv-main-styles',plugin_dir_url( __FILE__ ) .'css/YouTubePopUp.css');
	wp_enqueue_style('aampv-ct-styles',plugin_dir_url( __FILE__ ) .'css/aampv-custom-style.css');
}
add_action( 'wp_enqueue_scripts', 'aampv_assets_libs' );


function aampv_get_video_url($id){
	$values = get_post_custom( $id);
	$vtp = $values['aampv_video_type'][0];
	$vt_id = $values['pty_video_id'][0];

	if($vtp=='youtube'){
		$url = "https://www.youtube.com/watch?v=$vt_id";
	}else{
		$url = "https://vimeo.com/$vt_id";
	}
return $url;
}

function aampv_getVimeoThumb($id){
$vimeo = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$id.php"));
// echo $small = $vimeo[0]['thumbnail_small'];
// return $medium = $vimeo[0]['thumbnail_medium'];
echo $large = $vimeo[0]['thumbnail_large'];
}


function aampv_get_video_thumbnail($id){
	$values = get_post_custom( $id);
	$vtp = $values['aampv_video_type'][0];
	$vt_id = $values['pty_video_id'][0];

	if($vtp=='youtube'){
		$img = "https://img.youtube.com/vi/$vt_id/hqdefault.jpg";
	}else{
		$img = aampv_getVimeoThumb($vt_id);
	}
	return $img;
}
