<?php get_header(); ?>
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
		<div class="job-detail-sec">
		<h1><?php echo get_the_title();?></h1>

			<?php 
			
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
			

	        

	        $buffer = '<div class="job-list-item">';	 


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

	        echo $buffer;


			?>


		 <h4 class="job-desc-title"><?php echo __( 'Job Description', 'ps-job-board' ); ?></h4>
		<?php the_content(); ?>
		</div>

		<?php include('apply-form.php'); ?>

	<?php 

	} // end while
} // end if
?>
<?php get_footer(); ?>