<?php 
require_once('../../../wp-load.php');


$video = get_posts(array(
    'post_type' => 'video',
    'numberposts' =>- 1,
));

foreach ($videos as $video) {
    $video_id = get_post_meta($video->ID, 'video_id', true);
    $video_title = $video->post_title;

    echo '<div>';
    echo '<h3>' . esc_html($video_title) . '</h3>';
    echo '<a href="#" class="select-video" data-video-id="' . esc_attr($video_id) . '">Sélectionner</a>';
    echo '</div>';
}