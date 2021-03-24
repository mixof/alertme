<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
 * Plugin Name: EMB Likes
 * Plugin URI: https://senseimarketing.com/
 * Description: This plugin will addlike/unlike functionality to website posts/comments
 * Version: 1.0.0
 * Author: Sensei Marketing
 * Text Domain: emb-likes
 * Author URI: https://senseimarketing.com/
 * Copyright: Sensei Marketing
 */

function emb_get_post_likes($post_id = false)
{

    if ($post_id == false && is_singular(['events'])) {
        //get current post ID
        $post_id = get_the_ID();
    }

    if(!empty($post_id)) {
        //get likes json
        $likes_array = get_post_meta($post_id, 'emb_likes');

        if (!empty($likes_array)) {

            return $likes_array;
        }
        else return [];
    }else  return false;


}


function emb_update_post_like($post_id)
{
    if (is_user_logged_in()) {

        $user_id = get_current_user_id();

        //get likes json
        $likes_array = get_post_meta($post_id, 'emb_likes');
        //if likes exists
        if (!empty($likes_array)) {
            //decose likes json to array

            //$likes_array = json_decode($likes_json, true);
            //Is user liked flag
            $is_liked = false;
            //If current user id is in likes array
            if (in_array($user_id, $likes_array)) $is_liked = true;
             var_dump(json_encode($likes_array));

            //Like already set, need to remove it
            if ($is_liked) {
                //find like by value and remove it
                $like_key = array_search($user_id, $likes_array);
                if (!empty($key)) unset($like_key, $likes_array);

            } else {
                //If user not already liked this than add user_id to likes array
                $likes_array[] = $user_id;
            }
            //Update post meta with likes array
           // update_post_meta($post_id, 'emb_likes', $likes_array);

        } else {
          //  update_post_meta($post_id, 'emb_likes', [$user_id]);
        }


    }
}



//add_action('init', 'emb_get_post_likes');