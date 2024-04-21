<?php
/*
Plugin Name: Quick Info
Plugin URI: https://shamskhan.xyz
Description: Display Quick Information
Author: Shams Khan
Version: 1.0
Author URI: https://shamskhan.xyz
*/

if( !defined('ABSPATH'))
{
    exit; // Exit if accessed directly
}

add_action('wp_dashboard_setup', 'custom_dashboard_widget');
function custom_dashboard_widget(){
	if(current_user_can('manage_options')){
		wp_add_dashboard_widget('custom_dashboard_info', esc_html__('Quick Information'), 'custom_dashboard_details');
	}
}
if(!function_exists('custom_dashbaord_details')){
	function custom_dashboard_details(){
		echo esc_html__('Total Page Published:  ');
		$count_post = wp_count_posts($post_type = 'page');
		if($count_post){
			echo $total_posts = $count_post->publish . "</br>";		
		}
		echo esc_html__('Total Posts Published:  ');
		$count_draft = wp_count_posts($post_type = 'post');
		if($count_draft){
			echo $total_draft = $count_draft->publish  . "</br>";
		}
		echo esc_html__('Total Plugins Installed:  ');
		printf( count( get_plugins() ));
		echo "</br>";
		echo esc_html__('Update information:  ');
		$update = wp_get_update_data();
		printf ($update['title']);
		echo "</br>";
		echo esc_html__('Total Users:  ');
		$usercount = count_users();
		$result = $usercount['total_users'];
		printf($result);
		echo "</br>";
		echo esc_html__('Total Images Uploaded:  ');
		printf($image = array_sum((array)wp_count_attachments($mime_type='image')));
        echo "</br>";
		echo esc_html__('Theme Name:  ');
		$theme = wp_get_theme();
		printf($theme->get('Name'));
		echo "</br>";
		echo esc_html__('Present WordPress Version:  ');
		$version = wp_version_check();
		
		
	}
}

