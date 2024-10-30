<?php
/*
 * Plugin Name: Job Board Vanila
 * Description: A Job Board Vanila on your WordPress website where admin can post job requirements. Also, applicants can filter jobs and apply to a job in an easy and elegant way.
 * Version: 1.0
 * Author: Perception System PVT LTD
 * Author URI: https://perceptionsystem.com/
 * Text Domain: ps-job-board
*/
defined( 'ABSPATH' ) || die();
include_once(ABSPATH . 'wp-includes/pluggable.php');
	
if ( ! defined( 'PS_JB_DOMAIN' ) ) {
	define( 'PS_JB_DOMAIN', 'ps-job-board' );
}

if ( ! defined( 'PS_JB_PLUGIN_URL' ) ) {
	define( 'PS_JB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'PS_JB_PLUGIN_DIR_PATH' ) ) {
	define( 'PS_JB_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'PS_JB_PLUGIN_BASE_NAME' ) ) {
	define( 'PS_JB_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );
}

function active_ps_jobboard(){
    global $wpdb;
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );    
    
    update_option('users_can_register',1);


    $table_name = $wpdb->prefix . "psjb_job_appy";

    $sql = "CREATE TABLE $table_name (
			  `id` int(11) NOT NULL AUTO_INCREMENT,			  
			  `job_id` int(11) NOT NULL DEFAULT '0',			  
			  `fname` varchar(255) NOT NULL DEFAULT '',
			  `lname` varchar(255) NOT NULL DEFAULT '',
			  `email` varchar(255) NOT NULL DEFAULT '',
			  `phone` varchar(255) NOT NULL DEFAULT '',
			  `occupation` varchar(255) NOT NULL DEFAULT '',
			  `experience` int(11) NOT NULL DEFAULT '0',
			  `education` varchar(255) NOT NULL DEFAULT '',
			  `location` varchar(255) NOT NULL DEFAULT '',
			  `resume` int(11) NOT NULL DEFAULT '0',			 
			  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1= Approv, 2 = reject',
			  `note` text,			  
			  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			   UNIQUE KEY id (id)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    dbDelta( $sql ); 	

}

register_activation_hook( __FILE__, 'active_ps_jobboard' );
function ps_jobboard_deactivation() {
    delete_option( 'psjb_default_pages' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ps_jobboard_deactivation' );

add_filter('template_include', 'psjb_post_template');


function psjb_post_template( $template ) {
	
		$posttype = get_query_var('post_type');
		
		if(is_singular(array('job'))){
			$theme_files = array('single-'.$posttype.'.php', PS_JB_PLUGIN_DIR_PATH.'/single-'.$posttype.'.php');
			$exists_in_theme = locate_template($theme_files, false);
			if ( $exists_in_theme != '' ) {
			  return $exists_in_theme;
			} else {			
			  return $theme_files[1];
			}	
		}			
			
			
		  return $template;
}


require PS_JB_PLUGIN_DIR_PATH . '/inc/psjb-function.php';
require PS_JB_PLUGIN_DIR_PATH . '/inc/psjb_job_metabox.php';

