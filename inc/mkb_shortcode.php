<?php
add_shortcode( 'popup-video', 'aampv_video_shortcode' );
function aampv_video_shortcode($atts, $content=null){

		$defaults = array(
			"show"	=> "-1",
			"cat"	=> "",
		);
		$params 					= shortcode_atts($defaults, $atts);
		$show						= $params['show'];
		$cat						= $params['cat'];
		
ob_start();
?>
<div class="aampv-video-list" id="">
	<ul>
     <?php
     if(!empty($cat)){
        $args = array (
                'post_type'  => array( 'aampv_video' ),
                'posts_per_page' => $show,
                    'tax_query' => array(
                            array(
                            'taxonomy' => 'aampv_video_cat',
                            'field' => 'slug',
                            'terms' => $cat
                            )
                        )
                    );
                }else{
$args = array (
                'post_type'  => array( 'aampv_video' ),
                'posts_per_page' => $show
             );
                }
     $loop = new WP_Query( $args );
     while ($loop->have_posts()) {
        $loop->the_post(); 
		$values = get_post_custom(get_the_id());                 
    ?>  
<li><a href="<?php echo aampv_get_video_url(get_the_id()); ?>" class='aampv-video-item'>
    
    <img src="<?php echo aampv_get_video_thumbnail(get_the_id()); ?>" alt="">
  <div class='yt-video-details'>
    <img src="<?php echo plugin_dir_url(__FILE__)."images/player.png"; ?>" />
    <h3></h3><?php the_title(); ?></h3>
</div>
</a></li>
<?php 
} 
wp_reset_query();
?>
</ul>
	<script type="text/javascript">
		jQuery(function(){
			jQuery("a.aampv-video-item").YouTubePopUp();
			// jQuery("a.bla-2").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
		});
	</script>
</div>
<?php
$content = ob_get_clean();
return $content;
}


add_shortcode( 'popup-video-by-cat', 'aampv_all_video_by_cat');
function aampv_all_video_by_cat($atts, $content=null){

		$defaults = array(
			"show"	=> "-1",
			"cat"	=> "0",
		);
		$params 					= shortcode_atts($defaults, $atts);
		$show						= $params['show'];
		$cat						= $params['cat'];
		
ob_start();
// echo $cat;
$term = get_terms('aampv_video_cat');
// print_r($term);
if($term){

foreach ($term as $_term) {
	$trcat = $_term->term_id;
?>
<h4 class='aampv-video-cat-name'><?php echo $_term->name; ?></h4>
<div class="aampv-video-list" id="">
	<ul>
     <?php
     $count =1;
        $args = array (
                'post_type'  => array( 'aampv_video' ),
                'posts_per_page' => $show,
                    'tax_query' => array(
                            array(
                            'taxonomy' => 'aampv_video_cat',
                            'field' => 'id',
                            'terms' => $trcat
                            )
                        )
                    );
                
     $loop = new WP_Query( $args );
            while ($loop->have_posts()) {
                $loop->the_post();            
    ?>  
  <li><a href="<?php echo aampv_get_video_url(get_the_id()); ?>" class='aampv-video-item'><img src="<?php echo aampv_get_video_thumbnail(get_the_id()); ?>" alt="">
  <div class='yt-video-details'>
    <img src="<?php echo plugin_dir_url(__FILE__)."images/player.png"; ?>" />
    <h3></h3><?php the_title(); ?></h3>
</div>
  </a></li>
<?php 
$count++; 
} 
wp_reset_query();
?>
</ul>
</div>
<?php
}
?>
	<script type="text/javascript">
		jQuery(function(){
			jQuery("a.aampv-video-item").YouTubePopUp();
			// jQuery("a.bla-2").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
		});
	</script>
<?php 
} 
else{
 _e('<div class=err>Sorry, No Videos Found </div>');
}

$content = ob_get_clean();
return $content;
}
