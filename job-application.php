<?php 

	global $wpdb; 	
	$table_name = $wpdb->prefix . "psjb_job_appy";

    if(isset($_POST['note_form_submit'])){

	$note_hcs = $_POST['note_hcs'];
	$app_id = $_POST['app_id'];

	$wpdb->update( $table_name, array( 'note' => $note_hcs ),array('id'=>$app_id));

	} 
	

	if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;

	
	$total_pages_sql = "SELECT COUNT(*) FROM $table_name";
	$result = $wpdb->get_results($total_pages_sql,ARRAY_N);
	$total_rows = $result[0][0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);


	$job_tracking_data 	= $wpdb->get_results("SELECT job_app.*
							FROM $table_name as job_app
							join ".$wpdb->prefix ."posts as post on post.ID = job_app.job_id 
							where post.post_type = 'job' AND post.post_status = 'publish' LIMIT $offset, $no_of_records_per_page",ARRAY_A);


?>
<div class="job-app-list"> 
    <section> 
        <div class="container">
            <div class="job-app-header">				
				<h1 class="job-app-title"><?php esc_html_e( 'Job Application', 'ps-job-board' ); ?></h1>
				<div class="divider"></div> 				
			</div>			
			<div class="job-app-body">
				<table cellpadding="2" cellspacing="2" border="2" class="psjb_job_application_tracking dataTable table stripe" id="psjb_job_application_tracking">
					<thead>
						<tr>							
							<th><?php esc_html_e( 'Date Applied', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Applicant', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Email', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Phone', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Location', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Resume', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Job', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Status', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Action', 'ps-job-board' ); ?></th>
							<th><?php esc_html_e( 'Note', 'ps-job-board' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($job_tracking_data as $val){
							
							
							if($val['status'] == 0){
								$status	=	"Pending";
							}else if($val['status'] == 1){
								$status	=	"Approve";
							}else if($val['status'] == 2){
								$status	=	"Reject";
							}
							?>
							<tr>								
								<td scope="col"><?php echo date_i18n('d-m-Y',strtotime($val['apply_date'])); ?></td>
								<td scope="col"><?php echo $val['fname'].' '.$val['lname']; ?></td>
								<td scope="col"><?php echo $val['email']; ?></td>
								<td scope="col"><?php echo $val['phone']; ?></td>
								<td scope="col"><?php echo $val['location']; ?></td>								
								<td scope="col"><a href="<?php echo wp_get_attachment_url($val['resume']); ?>"><?php esc_html_e( 'Resume', 'ps-job-board' ); ?></a></td>
								<td scope="col"><a href="<?php echo get_permalink($val['job_id']); ?>"><?php echo get_the_title($val['job_id']);?></a></td>
								<td scope="col"><?php esc_html_e( $status, 'ps-job-board' ); ?></td>
								<td scope="col">
									
									<?php if($val['status'] == 1){ ?>

										<span><?php esc_html_e( 'Approve', 'ps-job-board' ); ?></span>

									<?php }else{ ?>

									<a title="<?php esc_html_e( 'Approve', 'ps-job-board' ); ?>" href="<?php echo wp_nonce_url(APPLICATIONTRACKING_ADMIN.'&action=accept&status=1&id='.$val['id'].'&job_id='.$val['job_id'], 'action_applications', 'action_applications_nonce'); ?>" ><?php esc_html_e( 'Approve', 'ps-job-board' ); ?></a> 

								    <?php } ?> 
								     

								    <?php if($val['status'] == 2){ ?>

										<span><?php esc_html_e( 'Reject', 'ps-job-board' ); ?></span>

									<?php }else{ ?>

									<a title="<?php esc_html_e( 'Reject', 'ps-job-board' ); ?>" href="<?php echo  wp_nonce_url(APPLICATIONTRACKING_ADMIN.'&action=reject&status=2&id='.$val['id'].'&job_id='.$val['job_id'], 'action_applications', 'action_applications_nonce'); ?>"><?php esc_html_e( 'Reject', 'ps-job-board' ); ?></a>

								     <?php } ?>


									<a  onclick="return confirm('Are you sure you want to delete?')" title="<?php esc_html_e( 'Delete', 'ps-job-board' ); ?>" href="<?php echo wp_nonce_url(APPLICATIONTRACKING_ADMIN.'&action=delete&id='.$val['id'], 'action_applications', 'action_applications_nonce'); ?>"><?php esc_html_e( 'Delete', 'ps-job-board' ); ?></a>
										
								</td>
								<td>
							    <a href="javascript:void(0);" class="note-form-open"><?php esc_html_e( 'Note', 'ps-job-board' ); ?></a>
								<div class="note-section">
								<form name="note-form-hcs" class="note-form-hcs" id="note-form-hcs" method="post" action="">
								<textarea name="note_hcs" class="note-field"><?php echo $val['note'];?></textarea>
								<input type="hidden" name="app_id" value="<?php echo $val['id'];?>">
								<input type="submit" value="<?php esc_html_e( 'save', 'ps-job-board' ); ?>" class="note-form-submit" name="note_form_submit">
								</form>
								</div>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>

				<div class="pagination">
				<span><a href="<?php echo APPLICATIONTRACKING_ADMIN;?>&pageno=1">|<</a></span>
				<span class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
				<a href="<?php if($pageno <= 1){ echo '#'; } else { echo APPLICATIONTRACKING_ADMIN."&pageno=".($pageno - 1); } ?>"><</a>
				</span>
				<span class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
				<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo APPLICATIONTRACKING_ADMIN."&pageno=".($pageno + 1); } ?>">></a>
				</span>
				<span><a href="<?php echo APPLICATIONTRACKING_ADMIN;?>&pageno=<?php echo $total_pages; ?>">>|</a></li>
				</div>
			</div>
		</div>
	</section>
</div>