<?php
/*
Plugin Name: Make Feed to Post
Plugin URI: http://whatisblog.info
Description: This plugin allows you to transform items from a feed to wordpress's posts
Author: Paul Dev
Version: 0.1
Author URI: http://whatisblog.info
*/

require_once('feed2post_utils.php');
require_once('feed2post_admin.php');
require_once('feed2post.php');

define('FEED2POST_TABLENAME', 'f2p_items');

// Init : create the BDD table
register_activation_hook(__FILE__, 'feed2post_install');
//Delete table
register_deactivation_hook(__FILE__, 'feed2post_uninstall');


add_action('admin_menu', 'feed2post_panel');
add_action('deleted_post','deleted_post_feed');

function deleted_post_feed($id){
	if($id!=""){
		global $table_prefix, $wpdb;
		$sql = "DELETE FROM ".$table_prefix.FEED2POST_TABLENAME." WHERE postid = ".$id;

		$wpdb->query($sql);
	}
}
if (get_option('feed2post_auto'))
	add_action('wp_head', 'feed2post_autopublish');

?>