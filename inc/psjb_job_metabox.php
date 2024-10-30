<?php 

abstract class Psjb_Job_Metabox{
 
 
    /**
     * Set up and add the meta box.
     */
    public static function add() {


       $metabox_title = __( 'Job Fields', 'ps-job-board' );

        $screens = [ 'job' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'psjb_job',          // Unique ID
                $metabox_title, // Box title
                [ self::class, 'html' ],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }
 
 
    /**
     * Save the meta box selections.
     *
     * @param int $post_id  The post ID.
     */
    public static function save( int $post_id ) {
        if ( array_key_exists( 'psjb_exp', $_POST ) ) {
            update_post_meta(
                $post_id,
                'psjb_exp',
                $_POST['psjb_exp']
            );
        }

        if ( array_key_exists( 'psjb_sal', $_POST ) ) {
            update_post_meta(
                $post_id,
                'psjb_sal',
                $_POST['psjb_sal']
            );
        }

        if ( array_key_exists( 'psjb_location', $_POST ) ) {
            update_post_meta(
                $post_id,
                'psjb_location',
                $_POST['psjb_location']
            );
        }


    }
 
 
    /**
     * Display the meta box HTML to the user.
     *
     * @param \WP_Post $post   Post object.
     */
    public static function html( $post ) {

        $psjb_exp = get_post_meta( $post->ID, 'psjb_exp', true );
        $psjb_sal = get_post_meta( $post->ID, 'psjb_sal', true );
        $psjb_location = get_post_meta( $post->ID, 'psjb_location', true );

        $exp_label = __( 'Experience', 'ps-job-board' );
        $sal_label = __( 'Salary', 'ps-job-board' );
        $location_label = __( 'Location', 'ps-job-board' );


        ?>
        
        <p>
        <label for="psjb_exp"><?php echo $exp_label; ?></label>
        <select name="psjb_exp" id="psjb_exp" class="postbox">
            <option value="">0</option>
            <option value="1" <?php selected( $psjb_exp, '1' ); ?>>1</option>
            <option value="2" <?php selected( $psjb_exp, '2' ); ?>>2</option>
            <option value="3" <?php selected( $psjb_exp, '3' ); ?>>3</option>
            <option value="4" <?php selected( $psjb_exp, '4' ); ?>>4</option>
            <option value="5" <?php selected( $psjb_exp, '5' ); ?>>5</option>
            <option value="6" <?php selected( $psjb_exp, '6' ); ?>>6</option>
            <option value="7" <?php selected( $psjb_exp, '7' ); ?>>7</option>
            <option value="8" <?php selected( $psjb_exp, '8' ); ?>>8</option>
            <option value="9" <?php selected( $psjb_exp, '9' ); ?>>9</option>
            <option value="10" <?php selected( $psjb_exp, '10' ); ?>>10</option>
        </select>
        </p>

        <p>
        <label for="psjb_sal"><?php echo $sal_label; ?></label>
        <input type="number" name="psjb_sal" id="psjb_sal" value="<?php echo $psjb_sal ; ?>" required/>    
        </p>


        <p>
        <label for="psjb_location"><?php echo $location_label; ?></label>
        <input type="text" name="psjb_location" id="psjb_location" value="<?php echo $psjb_location ; ?>" required/>    
        </p>



        <?php
    }
}
 
add_action( 'add_meta_boxes', [ 'Psjb_Job_Metabox', 'add' ] );
add_action( 'save_post', [ 'Psjb_Job_Metabox', 'save' ] );