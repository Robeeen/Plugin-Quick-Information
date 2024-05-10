<?php
/*
Plugin Name: Quick Info
Plugin URI: https://shamskhan.xyz
Description: Display Quick Information on Dashboard
Author: Shams Khan
Version: 1.0.0
Domain: quick-info
Author URI: https://shamskhan.com
*/

if( !defined('ABSPATH'))
{
    exit; // Exit if accessed directly
}


//dashboard info start 
//
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
		printf($update['title']);
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
		echo bloginfo('version') . "</br>";
		echo esc_html__('Admin Email:  ');
		echo bloginfo('admin_email') . "</br>";
		echo esc_html__('Site Title:  ');
		echo bloginfo('name') . "</br>";
		echo esc_html__('Tagline:  ');
		echo bloginfo('description') . "</br>";
		echo esc_html__('WordPress directory size:  ');
		// Get the path of a directory
		$directory = get_home_path();
		// Get the size of directory in bytes.
		$result = get_dirsize( $directory );
		echo number_format($result / (1024 * 1024), 1) . "Mb";
		echo "</br>";
		$upload_dir = wp_upload_dir();
		$space_used = get_dirsize( $upload_dir['basedir'] ) / MB_IN_BYTES;
		echo number_format($space_used, 1) . "Mb";
		echo "</br>";
		echo esc_html__('Memory Limit:  ');
		echo ini_get('memory_limit') . "</br>";
		echo 'Post Max Size:  ' . ini_get('post_max_size') . "</br>";
		echo 'Max Execution Time:  ' . ini_get('max_execution_time') . "</br>";
		echo 'Hosting Server:  '  . gethostname() . "</br>";
		echo 'Php Version:  '  . phpversion() . "</br>";
		//Display Server OS and machine information
		echo 'Server Operating System:  ' . PHP_OS . " - " . php_uname('m') . "</br>";

	}
}

