<?php 
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

add_action( 'add_meta_boxes', 'aampv_video_meta_box_add' );
function aampv_video_meta_box_add(){
    add_meta_box( 'aampv-video-info-meta', 'Video INFO', 'aampv_video_info_meta_box', 'aampv_video', 'normal', 'high' );
}



function aampv_video_info_meta_box($post){
$values = get_post_custom( $post->ID );
$vtp = $values['aampv_video_type'][0];
?>

<div class='sec'>
    <label for="mep_ev_2"> Video Type: </label>
<select name="aampv_video_type" id="">
    <option value="youtube" <?php if($vtp=='youtube'){ echo "selected"; } ?>>YouTube</option>
    <option value="vimeo" <?php if($vtp=='vimeo'){ echo "selected"; } ?>>Vimeo</option>
</select>
</div>

<div class='sec'>
    <label for="mep_ev_2"> Video ID: </label>
    <span><input id='mep_ev_2' type="text" name='pty_video_id' value='<?php echo $values['pty_video_id'][0]; ?>'> </span>
</div>

<?php
}




add_action('save_post','aampv_video_meta_save');
function aampv_video_meta_save($post_id){
    global $post; 
    $pid = $post->ID;
    if ($post->post_type != 'aampv_video'){
        return;
    }
    $pty_video_id         = strip_tags($_POST['pty_video_id']);
    $aampv_video_type         = strip_tags($_POST['aampv_video_type']);
    $update_aampvvid        = update_post_meta( $pid, 'pty_video_id', $pty_video_id);
    $aampv_video_type        = update_post_meta( $pid, 'aampv_video_type', $aampv_video_type);
}