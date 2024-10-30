<?php 

$msg = "";

if(isset($_POST['submit'])){


	$fname = strip_tags($_POST['fname']);
	$lname = strip_tags($_POST['lname']);
	$email = strip_tags($_POST['email']);
	$phone = strip_tags($_POST['phone']);
	$occupation = strip_tags($_POST['occupation']);
	$experience = strip_tags($_POST['experience']);
	$education = strip_tags($_POST['education']);
	$location = strip_tags($_POST['location']);
	$resume = $_FILES['resume'];

	global $wpdb,$post;

	$table = $wpdb->prefix . "psjb_job_appy";

	$resumt_id = psjb_front_media_upload($resume,'resume');	
	$job_id 		  = $post->ID;	
	$table_name = $wpdb->prefix . "psjb_job_appy";

	$data = array(
            'job_id' => $job_id,   
			'fname' => $fname,  
			'lname' => $lname,  
			'email' => $email,  
			'phone' => $phone,  
			'occupation' => $occupation,  
			'experience' => $experience,  
			'education' => $education,  
			'location' => $location,  
			'resume' => $resumt_id     
            
        );

    $result = $wpdb->insert($table_name, $data);

    $from_email = $email;
    $to_email = get_option('admin_email');

	$job_name		 = get_the_title($job_id);

	$temp_arr = array(
					'from' => $from_email,
					'to' => $to_email,
					'job_name' => $job_name
					);

	$temp_arr = array_merge($temp_arr,$data);

	

    if($result){
    	 
    	 psjb_send_mail_autoreponder($temp_arr, 2);     	 

    	 $msg = __( 'Your Application Form sent successfully.', 'ps-job-board' );

    }

   
    
}

?>

<form method="post" action=""  enctype="multipart/form-data">
		
		<table>

		<?php if($msg != ""){ ?>
		<tr>
			<td colspan="2">
				<p><?php echo $msg; ?></p>
			</td>			
		</tr>
	   <?php } ?>
		<tr>
			<td colspan="2">
				<h4><?php echo __( 'Fill up Form to Apply', 'ps-job-board' ); ?></h4>
			</td>			
		</tr>

		<tr>
			<td>
				<label for="fname"><?php echo __( 'First Name', 'ps-job-board' ); ?></label>
			</td>
			<td>
				<input type="text" name="fname" id="fname" required />
			</td>
		</tr>

		<tr>
			<td>
				<label for="lname"><?php echo __( 'Last Name', 'ps-job-board' ); ?></label>
			</td>
			<td>
				<input type="text" name="lname" id="lname" required />
		    </td>
		</tr>
		<tr>
			<td>
				<label for="email"><?php echo __( 'Email Address', 'ps-job-board' ); ?></label>
			</td>
			<td>
			<input type="email" name="email" id="email" required />
			</td>
		</tr>
		<tr>
			<td>
			<label for="phone"><?php echo __( 'Phone No', 'ps-job-board' ); ?></label>
			</td>
			<td>
			<input type="text" name="phone" id="phone" required />
			</td>
		</tr>

		<tr>
			<td>
				<label for="occupation"><?php echo __( 'Occupation', 'ps-job-board' ); ?></label>
			</td>
			<td>
				<input type="text" name="occupation" id="occupation" required />
			</td>
		</tr>
		<tr>
			<td>
				<label for="experience"><?php echo __( 'Experience', 'ps-job-board' ); ?></label>
			</td>
			<td>
			<select name="experience" id="experience" >
	            <option value="0">0</option>
	            <option value="1">1</option>
	            <option value="2">2</option>
	            <option value="3">3</option>
	            <option value="4">4</option>
	            <option value="5">5</option>
	            <option value="6">6</option>
	            <option value="7">7</option>
	            <option value="8">8</option>
	            <option value="9">9</option>
	            <option value="10">10</option>
	        </select>
	        </td>
        </tr>	
        <tr>
	        <td>
				<label for="education"><?php echo __( 'Education', 'ps-job-board' ); ?></label>
			</td>
			<td>
			<input type="text" name="education" id="education" required />
			</td>
		</tr>
		<tr>
			<td>
			<label for="location"><?php echo __( 'Location', 'ps-job-board' ); ?></label>
			</td>
			<td>
			<input type="text" name="location" id="location" required />
		     </td>
		</tr>
		<tr>
			<td>
				<label for="resume"><?php echo __( 'Resume', 'ps-job-board' ); ?></label>
			</td>
			<td>
				<input type="file" name="resume" id="resume" required />
		    </td>
		</tr>

		<tr>
			<td colspan="2">		
				<input type="submit" name="submit" id="submit" value="Submit" />
			</td>
		</tr>

		</table>

		</form>