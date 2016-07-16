<?php
/*
Plugin Name: Konnichiwa! Handle Expired Subscriptions
Description: This plugin can be used to delete or cancel expired subscriptions.
Version: 0.1
Author: admiralchip
Author URI: http://github.com/admiralchip
License: GPLv2 or later
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

/**
 * Notes:
 *
 * There is a bug in Konnichiwa! that tells a user who has an active subscription
 * that their subscription is expired. This is happens if the user had a previous subscription
 * that expired and they subsequently renewed their subscription. 
 *
 * This plugin can be used to change the status of expired subscriptions from active (1) to cancelled (2).
 * It can also be used to delete expired subscriptions to clear the database.
 */
 
 function adkonn_handle_expired_subs() {
	 global $wpdb;
	 $subs_tbl = $wpdb->prefix . 'konnichiwa_subscriptions';
	 
	 $subs_results = $wpdb->get_results( 'SELECT COUNT(id) FROM ' . $subs_tbl . ' WHERE expires <= CURDATE()' );
	 if($subs_results) {
		 //Update query. To update subscriptions, uncomment below.
		 //$query = $wpdb->prepare( 'UPDATE ' . $subs_tbl . ' SET status = %d WHERE expires <= CURDATE()', 2 );
		 //Delete query. To use, comment the update query and uncomment code below:
		 $query = "DELETE FROM $subs_tbl WHERE expires <= CURDATE()";
		 $wpdb->query($query);
	 }
 } 
 
 add_action('init', 'adkonn_handle_expired_subs');

?>
