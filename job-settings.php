  <?php if(isset($_POST['submit'])){                 
       
       $exp_option = strip_tags($_POST['psjb_exp_in']);
       $curr_option = strip_tags($_POST['psjb_curr_in']);

       update_option( 'psjb_exp_in', $exp_option );   
       update_option( 'psjb_curr_in', $curr_option );    

  } ?>
  <div>
  <h2><?php esc_html_e( 'Simple Job Board', 'ps-job-board' ); ?></h2>
  <form method="post" action="" >  
  <p><?php esc_html_e( 'Please Change setting here according to your site', 'ps-job-board' ); ?></p>  
  <table>
  <tr valign="top">
  <th scope="row"><label for="psjb_exp_in">Experience In </label></th>
  <td><input type="text" id="psjb_exp_in" name="psjb_exp_in" value="<?php echo get_option('psjb_exp_in'); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="psjb_curr_in">Currency In </label></th>
  <td><input type="text" id="psjb_curr_in" name="psjb_curr_in" value="<?php echo get_option('psjb_curr_in'); ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="<?php esc_html_e( 'Save', 'ps-job-board' ); ?>" class="button" ></td>
  </tr>
  </table>
  </form>
  </div>


