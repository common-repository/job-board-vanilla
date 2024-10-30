<?php 
function psjb_init(){   
    
     /* create default pages */ 
    
   if(!get_option('psjb_default_pages')) {
		
		$pages_args = array();          
		
		$pages_args[] = array(
			'template' 	=> '',
			'args'		=>	array( 
								'post_type'    => 'page', 
								'post_title'    => 'Jobs', 
								'post_name'     => 'jobs', 
								'post_content'  => '[job_list]', 
								'post_status'   => 'publish', 
								'post_author'   => 1 
							)
		);
		
         
          
		psjb_theme_default_pages($pages_args);
        add_option( 'psjb_default_pages', '1', '', 'yes' ); 
        
    }
	
     
   

	/*Register post type for Job*/
	$labels_job = array( 
		'name'               => esc_attr__( 'Jobs', 'post type general name', 'ps-job-board' ), 
		'singular_name'      => esc_attr__( 'Job', 'post type singular name', 'ps-job-board' ), 
		'menu_name'          => esc_attr__( 'Jobs', 'admin menu', 'ps-job-board' ), 
		'name_admin_bar'     => esc_attr__( 'Job', 'add new on admin bar', 'ps-job-board' ), 
		'add_new'            => esc_attr__( 'Add New', 'job', 'ps-job-board' ), 
		'add_new_item'       => esc_attr__( 'Add New Job', 'ps-job-board' ), 
		'new_item'           => esc_attr__( 'New Job', 'ps-job-board' ), 
		'edit_item'          => esc_attr__( 'Edit Job', 'ps-job-board' ), 
		'view_item'          => esc_attr__( 'View Job', 'ps-job-board' ), 
		'all_items'          => esc_attr__( 'All Jobs', 'ps-job-board' ), 
		'search_items'       => esc_attr__( 'Search Jobs', 'ps-job-board' ), 
		'parent_item_colon'  => esc_attr__( 'Parent Jobs:', 'ps-job-board' ), 
		'not_found'          => esc_attr__( 'No job found.', 'ps-job-board' ), 
		'not_found_in_trash' => esc_attr__( 'No job found in Trash.', 'ps-job-board' ) 
	); 

	$args_job = array( 
		'labels'             => $labels_job, 
		'description'        => esc_attr__( 'Description.', 'ps-job-board' ), 
		'public'             => true, 
		'publicly_queryable' => true, 
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true, 
		'rewrite'            => array( 'slug' => 'job' ), 
		'capability_type'    => 'post', 
		'has_archive'        => true, 
		'hierarchical'       => false, 
		'menu_position'      => null, 
		'supports'           => array( 'title', 'editor', 'excerpt') 
	); 
	register_post_type( 'job', $args_job ); 


	/*Register Taxonomy for Occupations*/
	$labels_occ = array( 
		'name' => esc_attr__( 'Occupations', 'taxonomy general name' ), 
		'singular_name' => esc_attr__( 'Occupations', 'taxonomy singular name' ), 
		'search_items' =>  esc_attr__( 'Search Occupations', 'ps-job-board'  ), 
		'popular_items' => esc_attr__( 'Popular Occupations', 'ps-job-board'), 
		'all_items' => esc_attr__( 'All Occupations', 'ps-job-board'), 
		'parent_item' => null, 
		'parent_item_colon' => null, 
		'edit_item' => esc_attr__( 'Edit Occupations', 'ps-job-board' ), 
		'update_item' => esc_attr__( 'Update Occupations', 'ps-job-board' ), 
		'add_new_item' => esc_attr__( 'Add New Occupations', 'ps-job-board' ), 
		'new_item_name' => esc_attr__( 'New Occupations Name', 'ps-job-board' ), 
		'separate_items_with_commas' => esc_attr__( 'Separate Occupations with commas', 'ps-job-board' ), 
		'add_or_remove_items' => esc_attr__( 'Add or remove occupations', 'ps-job-board' ), 
		'choose_from_most_used' => esc_attr__( 'Choose from the most used occupations', 'ps-job-board' ), 
		'menu_name' => esc_attr__( 'Occupations', 'ps-job-board'), 
	); 
	register_taxonomy('occupations',array('job'),array( 
		'hierarchical' => true, 
		'labels' => $labels_occ, 
		'show_ui' => true, 
		'show_admin_column' => true, 
		'update_count_callback' => '_update_post_term_count', 
		'query_var' => true, 
		'rewrite' => array( 'slug' => 'occupations' ), 
	));


	/*Register Taxonomy for Skills */
	$labels_skills = array( 
		'name' => esc_attr__( 'Skills', 'taxonomy general name' ), 
		'singular_name' => esc_attr__( 'Skills', 'taxonomy singular name' ), 
		'search_items' =>  esc_attr__( 'Search Skills', 'ps-job-board'  ), 
		'popular_items' => esc_attr__( 'Popular Skills', 'ps-job-board'), 
		'all_items' => esc_attr__( 'All Skills', 'ps-job-board'), 
		'parent_item' => null, 
		'parent_item_colon' => null, 
		'edit_item' => esc_attr__( 'Edit Skills', 'ps-job-board' ), 
		'update_item' => esc_attr__( 'Update Skills', 'ps-job-board' ), 
		'add_new_item' => esc_attr__( 'Add New Skills', 'ps-job-board' ), 
		'new_item_name' => esc_attr__( 'New Skills Name', 'ps-job-board' ), 
		'separate_items_with_commas' => esc_attr__( 'Separate Skills with commas', 'ps-job-board' ), 
		'add_or_remove_items' => esc_attr__( 'Add or remove Skills', 'ps-job-board' ), 
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Skills', 'ps-job-board' ), 
		'menu_name' => esc_attr__( 'Skills', 'ps-job-board'), 
	); 
	register_taxonomy('skills',array('job'),array( 
		'hierarchical' => true, 
		'labels' => $labels_skills, 
		'show_ui' => true, 
		'show_admin_column' => true, 
		'update_count_callback' => '_update_post_term_count', 
		'query_var' => true, 
		'rewrite' => array( 'slug' => 'skills' ), 
	));

	
	/*Register Taxonomy for Employment Types*/
	$emp_type_labels = array( 
		'name' => esc_attr__( 'Employment Types', 'taxonomy general name' ), 
		'singular_name' => esc_attr__( 'Employment Type', 'taxonomy singular name' ), 
		'search_items' =>  esc_attr__( 'Search Employment Type', 'ps-job-board'  ), 
		'popular_items' => esc_attr__( 'Popular Employment Type', 'ps-job-board'  ), 
		'all_items' => esc_attr__( 'All Employment Types', 'ps-job-board' ), 
		'parent_item' => null, 
		'parent_item_colon' => null, 
		'edit_item' => esc_attr__( 'Edit Employment Type', 'ps-job-board' ), 
		'update_item' => esc_attr__( 'Update Employment Type', 'ps-job-board' ), 
		'add_new_item' => esc_attr__( 'Add New Employment Type', 'ps-job-board' ), 
		'new_item_name' => esc_attr__( 'New Employment Type Name', 'ps-job-board' ), 
		'separate_items_with_commas' => esc_attr__( 'Separate Employment Type with commas', 'ps-job-board' ), 
		'add_or_remove_items' => esc_attr__( 'Add or remove Employment Type', 'ps-job-board' ), 
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Employment Type', 'ps-job-board' ), 
		'menu_name' => esc_attr__( 'Employment Types', 'ps-job-board' ), 
	); 

	register_taxonomy('employment_type',array('job'),array( 
		'hierarchical' => true, 
		'labels' => $emp_type_labels, 
		'show_ui' => true, 
		'show_admin_column' => true, 
		'update_count_callback' => '_update_post_term_count', 
		'query_var' => true, 
		'rewrite' => array( 'slug' => 'employment_type' ), 
	));
	
	/*Register Taxonomy for Category*/
	$labels_cat = array( 
		'name' => esc_attr__( 'Category', 'taxonomy general name' ), 
		'singular_name' => esc_attr__( 'Category', 'taxonomy singular name' ), 
		'search_items' =>  esc_attr__( 'Search Category', 'ps-job-board'  ), 
		'popular_items' => esc_attr__( 'Popular Category', 'ps-job-board' ), 
		'all_items' => esc_attr__( 'All Category', 'ps-job-board' ), 
		'parent_item' => null, 
		'parent_item_colon' => null, 
		'edit_item' => esc_attr__( 'Edit Category', 'ps-job-board' ), 
		'update_item' => esc_attr__( 'Update Category', 'ps-job-board' ), 
		'add_new_item' => esc_attr__( 'Add New Category', 'ps-job-board' ), 
		'new_item_name' => esc_attr__( 'New Category Name', 'ps-job-board' ), 
		'separate_items_with_commas' => esc_attr__( 'Separate Category with commas', 'ps-job-board' ), 
		'add_or_remove_items' => esc_attr__( 'Add or remove category', 'ps-job-board' ), 
		'choose_from_most_used' => esc_attr__( 'Choose from the most used category', 'ps-job-board' ), 
		'menu_name' => esc_attr__( 'Category', 'ps-job-board' ), 
	); 

	register_taxonomy('job-category',array('job'),array( 
		'hierarchical' => true, 
		'labels' => $labels_cat, 
		'show_ui' => true, 
		'show_admin_column' => true, 
		'update_count_callback' => '_update_post_term_count', 
		'query_var' => true, 
		'rewrite' => array( 'slug' => 'job-category' ),
	));
} 


add_action('init', 'psjb_init'); 



/*Create multiple pages for theme*/
function psjb_theme_default_pages($pages_args){

	if(!empty($pages_args) && is_admin()){		

		foreach($pages_args as $pages_arg ){
			$template 	= $pages_arg['template'];
			$args 		= $pages_arg['args'];			
			$page_name 	= $args['post_title'];
			if(get_page_by_title( $page_name ) == NULL ){	
				$page_id 	=  wp_insert_post($args);
				if($template!=''){
					update_post_meta($page_id, '_wp_page_template', $template);
				}				
			}
		}
	}
	
}



add_shortcode('job_list','job_list_func');
function job_list_func($atts){

	global $paged;		

	$a = shortcode_atts( array(
	'posts_per_page' => 10	
	), $atts );



	$buffer = '<section class="ps-job-sec">';

	$job_list_title = __( '', 'ps-job-board' );
	$buffer .= '<h6>'.$job_list_title.'</h6>';
    $q = new WP_Query(array(
        'post_type' => 'job',
        'posts_per_page' => $a['posts_per_page'],
        'paged' => $paged
    ));
    
    if ( $q->have_posts() ) {

	    while ($q->have_posts()) {
	        
	        $q->the_post();      

	        global $post;



			$occupations = get_the_terms( $post->ID, 'occupations' );
			$occupations = join(', ', wp_list_pluck($occupations, 'name'));

			$skills = get_the_terms( $post->ID, 'skills' );
			$skills = join(', ', wp_list_pluck($skills, 'name'));

			$employment_type = get_the_terms( $post->ID, 'employment_type' );
			$employment_type = join(', ', wp_list_pluck($employment_type, 'name'));


			$job_category = get_the_terms( $post->ID, 'job-category' );
			$job_category = join(', ', wp_list_pluck($job_category, 'name'));


			$psjb_exp = get_post_meta( $post->ID, 'psjb_exp', true );
			$psjb_sal = get_post_meta( $post->ID, 'psjb_sal', true );
			$psjb_location = get_post_meta( $post->ID, 'psjb_location', true );
			

	        $title = get_the_title();

	        $buffer .= '<div class="job-list-item">';
	        
	        $buffer .= '<h4>'.$title.'</h4>'; 



	        if($skills != ''){
		        $skill_title = __( 'Skills', 'ps-job-board' );
		        $buffer .= '<p><span>'.$skill_title.'</span> : '.$skills.'</p>'; 
	        }



	        if($employment_type != ''){
	        $time_title = __( 'Time', 'ps-job-board' );
	        $buffer .= '<p><span>'.$time_title.'</span> : '.$employment_type.'</p>'; 
	        }


	        if($psjb_exp != ''){
	        $exp_title = __( 'Experience', 'ps-job-board' );
	        $years_label = get_option('psjb_exp_in');
	        $buffer .= '<p><span>'.$exp_title.'</span> : '.$psjb_exp.' '.$years_label.'</p>'; 
	        }

	        if($psjb_sal != ''){
	        $sal_title = __( 'Salary', 'ps-job-board' );
	        $curr_label = get_option('psjb_curr_in');
	        $buffer .= '<p><span>'.$sal_title.'</span> : '.$curr_label.' '.$psjb_sal.'</p>';
	        }

	        
	        if($psjb_location != ''){
	        $loc_title = __( 'Location', 'ps-job-board' );
	        $buffer .= '<p><span>'.$loc_title.'</span> : '.$psjb_location.'</p>';
	        }


	        $btn_text = __( 'Apply', 'ps-job-board' );

	        $btn_link = get_permalink();
	       
	        $buffer .= '<a href="'.$btn_link.'">'.$btn_text.'</a>';         

	        $buffer .= '</div>';


	    }



			$big = 999999999; 
			 
			$pagination = paginate_links( array(
			    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			    'format' => '?paged=%#%',
			    'current' => max( 1, get_query_var('paged') ),
			    'total' => $q->max_num_pages,
			    'show_all' => true,
			    'prev_text' => '<span> < </span>',
			    'next_text' => '<span> > </span>'

			) );


		    $buffer .= '<div class="pagination-sec">';
		    $buffer .= $pagination;    
		    $buffer .= '</div>';

		    wp_reset_postdata();

    }else{

	     $no_job_msg .= __( 'No any Jobs Found', 'ps-job-board' );
	     $buffer .= '<p>'.$no_job_msg.'</p>';
    }


    $buffer .= '</section>';

    return $buffer;

}



function psjb_front_media_upload($psjb_file,$field_name){
	$upload_dir = wp_upload_dir();
	if($psjb_file['name']!=''){
		$new_file_path 	  = $upload_dir['path'] . '/' . $psjb_file['name'];
		$new_file_baseurl = $upload_dir['baseurl'] . '/' . $psjb_file['name'];
		$new_file_mime = mime_content_type( $psjb_file['tmp_name'] );
		
		if( move_uploaded_file( $psjb_file['tmp_name'], $new_file_path ) ) {
			$upload_id = wp_insert_attachment( array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $new_file_mime,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $psjb_file['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			), $new_file_path );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
			
			return $upload_id;

		}
	}	
}

add_action( 'admin_menu', 'psjb_report_menu' );
function psjb_report_menu(){
	add_submenu_page(
		'edit.php?post_type=job',
		__( 'Job Application', 'ps-job-board' ),
		__( 'Job Application', 'ps-job-board' ),
		'manage_options',
		'psys_job_application',
		'psys_job_application_function'
	);


	add_submenu_page(
		'edit.php?post_type=job',
		__( 'Job Settings', 'ps-job-board' ),
		__( 'Job Settings', 'ps-job-board' ),
		'manage_options',
		'psys_job_settings',
		'psys_job_settings_function'
	);


}


function psys_job_application_function(){
	include(PS_JB_PLUGIN_DIR_PATH. '/job-application.php');
}

function psys_job_settings_function(){
	include(PS_JB_PLUGIN_DIR_PATH. '/job-settings.php');
}


define('APPLICATIONTRACKING_ADMIN',admin_url('edit.php?post_type=job&page=psys_job_application'));



add_action ('wp_loaded', 'psjb_custom_redirect');
function psjb_custom_redirect() {
		    if( isset( $_REQUEST['action_applications_nonce'] ) && wp_verify_nonce( $_REQUEST['action_applications_nonce'], 'action_applications' ) ){
			
		    		global $wpdb; 	
					$table_name = $wpdb->prefix . "psjb_job_appy";
					
					$status	=	$_REQUEST['status'];
					$attnd_quiz_id	=	$_REQUEST['id'];
					$job_id	=	$_REQUEST['job_id'];

					$table_name = $wpdb->prefix . "psjb_job_appy";
					$job_application 	= $wpdb->get_row("SELECT job_app.* FROM $table_name as job_app where job_app.id='{$attnd_quiz_id}'",ARRAY_A);
					
					
					if($_REQUEST['action']	==	"delete"){
						$deleted = $wpdb->delete(
							$table_name,
							array( 'id' => $attnd_quiz_id ),
							array( '%d' )
						);
					}else{
				        $data = array(
				            'status' => $status
				        );

				        $where = array(
				            'id' => $attnd_quiz_id
				        );
						$wpdb->update( $table_name, $data, $where );

					}

					$statusArr		 = array('0' => 'pending','1' => 'Active','2' => 'Dective');
					$approval_status = $statusArr[$status];
					$to_email = $job_application['email'];
					$from_email = get_option('admin_email');	
					$job_name		 = get_the_title($job_id);
					$temp_arr = array(
									'from'				=> $from_email,
									'to'				=> $to_email,
									'job_name' 			=> $job_name
									);
					
					psjb_send_mail_autoreponder($temp_arr, 1); 
					
					wp_redirect(APPLICATIONTRACKING_ADMIN);
					exit;

		}
}   


add_action('wp_enqueue_scripts', 'scripts_front_mapdata');

function scripts_front_mapdata() {

	wp_enqueue_style( 'psjb-front-style', PS_JB_PLUGIN_URL . 'css/custom.css');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('psjb_front', PS_JB_PLUGIN_URL .'js/psjb_front.js', array(), true );

}

add_action( 'admin_enqueue_scripts', 'psjb_admin_enqueue_scripts' ); 

function psjb_admin_enqueue_scripts() {

	
	wp_enqueue_style( 'psjb-admin-style', PS_JB_PLUGIN_URL . 'css/admin.css');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'psjb_admin_js', PS_JB_PLUGIN_URL . 'js/psjb_admin.js', false, '1.0.0' ); 
}


function psjb_send_mail_autoreponder($temp_arr, $tempalte_id){
	global $post,$wpdb;
	
	$from_email = $temp_arr['from'];
	$to_email = $temp_arr['to'];	
	$sitename = get_bloginfo('name');
	$cur_year = date('Y');	


	if( $tempalte_id == 1 ){		
		
		$job_title = $temp_arr['job_name'];

		$subject = "Application shortlisted";

		$message = "<p>Your application for the job $job_title has been shortlisted.</p>";

	}

	if( $tempalte_id == 2 ){

		$job_title = $temp_arr['job_name'];

		$subject = "Application for the Job";

		$message = "<p>find below application details for the job $job_title</p>";
		$message .= "<table>";
		$message .= "<tbody>";
		$message .= "<tr>";
		$message .= "<td>First Name</td>";
		$message .= "<td>".$temp_arr['fname']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Last Name</td>";
		$message .= "<td>".$temp_arr['lname']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Email</td>";
		$message .= "<td>".$temp_arr['email']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Phone</td>";
		$message .= "<td>".$temp_arr['phone']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Occupation</td>";
		$message .= "<td>".$temp_arr['occupation']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Experience</td>";
		$message .= "<td>".$temp_arr['experience']." Years </td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Education</td>";
		$message .= "<td>".$temp_arr['education']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Location</td>";
		$message .= "<td>".$temp_arr['location']."</td>";
		$message .= "</tr>";		
		$message .= "</tbody>";
		$message .= "<table>";
	}


	$new_body = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0px auto; padding:0px;">
	<tbody bgcolor="#8d8e90" style="padding:0px; font-family:Arial, Helvetica, sans-serif; color:#4f4f4f; font-size:13px;">
		<tr bgcolor="#282828">
			<td align="center" style="padding:10px;"><h2 style="color:#ffffff;">'.$sitename.'</h2></td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td style="padding:20px;">';
	$new_body .= $message;
	$new_body .='</td>
		</tr>
		<tr bgcolor="#131313">			
			<td align="center" style="padding:12px; font-size:11px; color:#a0a0a0;">'.$sitename.' © '.$cur_year.', All Right Reserved</td>
		</tr>
		</tbody>
	</table>';
	$from = "'From: ".$from_email."'"; 
	$headers[] = 	$from; 
	$headers[] = 	'Content-Type: text/html; charset=UTF-8';
		
		wp_mail($to_email, $subject, $new_body, $headers ); 
		
}