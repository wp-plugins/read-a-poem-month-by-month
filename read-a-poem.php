<?php
    /*
    Plugin Name:	Read a Poem - Month by Month
    Plugin URI: 	http://dandelionwebdesign.com/downloads/poems/
    Description:	Use this plugin to display content that changes each month. Assign each post(poem) to a month then use the shortcode [poem-current]
    Version: 		1.0.0
    Author: 		Dandelion Web Design Inc.
    Author URI:		http://dandelionwebdesign.com/


    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    ( at your option ) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */


    /* ADDS */
    add_shortcode( 'poem', 'poem_shortcode');
    add_shortcode( 'poem-current', 'poem_current_shortcode');
    add_action( 'init', 'poem_init');
    add_filter( 'manage_edit-poem_columns', 'poem_modify_poem_table' );
    add_filter( 'manage_posts_custom_column', 'poem_modify_poem_table_row', 10, 2 );

    register_activation_hook( __FILE__, 'poem_activate' );
    function poem_activate() {
        update_option( 'poem', serialize( array() ) );
    }

    /*
     * Init
     */
    function poem_init() {
        load_plugin_textdomain('read-a-poem', false, 'read-a-poem/languages/');


        $labels = array( 
            'name' => __( 'Poems'),
        	'singular_name' => __('Poem'),
        	'add_new' => __('Add New'),
            'add_new_item' => __('Add New Poem'),
            'edit_item' => __('Edit Poem'),
            'new_item' => __('New Poem'),
        	'all_items' => __('All Poems'),
            'view_item' => __('View Poem'),
            'search_items' => __('Search  Poems'),
            'not_found' =>  __('No Poems found'),
            'not_found_in_trash' => __('No Poems found in Trash'), 
            'parent_item_colon' => '',
        	'menu_name' => __('Read a Poem')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'supports' => array( 'title', 'editor' ),
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true, 
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 8,
            'can_export' => true,
        );

        register_post_type( 'poem', $args );

        //add styles
        wp_enqueue_style( 'read-a-poem', plugins_url('/css/read-a-poem.css', __FILE__) );
    }

    /*
    /*
     * Add Column to WordPress Admin 
     * Displays the shortcode needed to show a single poem
     *
     */
     
    function poem_modify_poem_table( $column ) { 
    	$columns = array(
    		'cb'       			=> '<input type="checkbox" />',
    		'title'    			=> 'Title',
    		'poem_shortcode'    => 'Shortcode',
    		'date'     			=> 'Date'
    	);

    	return $columns;
    }

    function poem_modify_poem_table_row( $column_name, $post_id ) {
     	if($column_name == "poem_shortcode") {
     		echo "[poem id={$post_id}]";
     	}
    }
    
    add_action('admin_menu', 'poem_add_submenu');
    function poem_add_submenu() {
        add_submenu_page( 'edit.php?post_type=poem', 'Assign Poem', 'Assign to Month', 'manage_options', 'poem-assign-poem', 'poem_assign_poem_to_month' );
    }

    /**
     * Assigns poem to a month
     * @return void
     */
    function poem_assign_poem_to_month() {
         //get all resource type categories
        $poemsList = new WP_Query(array('post_type' => 'poem', 'posts_per_page' => -1));
        $poems = array();
        if( $poemsList->have_posts() ){
            while( $poemsList->have_posts() ): $poemsList->the_post();
                $poems[get_the_ID()] = get_the_title();
            endwhile;
        } 
        
        $months = array(
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December'
            );
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-users"><br></div>
        <h2 style="margin-bottom: 5px">Assign Poem to a Month</h2>
        <?php        
            //If the form is submitted save changes to the database    
            if( isset($_POST['submitted']) && $_POST['submitted'] == 1 ) {                

                //verify nonce and continue
                $nonce = $_POST['poem-nonce'];
                if ( wp_verify_nonce( $nonce, plugin_basename(__FILE__) ) ) {

                    $postData = $_POST;

                    unset( $postData['submitted'] );
                    unset( $postData['poem_nonce'] );
                    unset( $postData['_wp_http_referer'] );

                    if( update_option( 'poem', serialize($postData) ) ) {
                        echo "<div id='message' class='updated'>",
                             "<p>Poems were assigned successfully.</p>",
                             "</div>";               
                    } else {
                        echo "<div id='message' class='error'>",
                             "Please try again.",
                             "</div>";
                    }

                } else {
                    echo "<div id='message' class='error'>",
                         "Please try again.",
                         "</div>";
                }

            }

            $options = unserialize( get_option('poem') );
        ?>
        <div class="contentArea"> 
            <form method="post" action="">
                 <?php for($month = 1; $month <= 12; $month++): ?>
                    <div class="monthWrap">
                      <span class="left width5"><?php echo $month ?>.&nbsp;</span>
                      <span class="left width10"><?php echo $months[ $month ] ?></span>
                      
                      <select name="poem-<?php echo $month ?>" id="poem" class="poemWrap left">
                        <?php 
                            if( !empty($poems) ) {
                                $selectedValue =  $options[ 'poem-' . $month ];
                                foreach($poems as $pid => $poem) {                                
                                    $selected = ($pid == $selectedValue) ? "selected" : '';
                                    echo "<option value='{$pid}' $selected>{$poem}</option>";
                                }
                            }
                        ?>           
                      </select>
                      
                      <div class="clear"></div>
                    </div>
                <?php endfor; ?>
                <input type='hidden' name='submitted' value='1' />
                <?php wp_nonce_field(plugin_basename(__FILE__), 'poem-nonce'); ?>
                <input type="submit" value="Assign" class="button button-primary" />
            </form>
        </div>
    <?php    
         wp_reset_postdata();
    }

    /**
     * Displays poem on shortcode call
     * @param  array $atts Shortcode attributes
     * @return void
     */
    function poem_shortcode( $atts ) {
      
       $poem = new WP_Query(array('post_type' => 'poem', 'p' => $atts['id']));

       $output = '';
       if( $poem->have_posts() ) {
            while( $poem->have_posts() ) {
                $poem->the_post();                
                $output .= '<div class="poem-current">';
                $output .= "<h2>" . get_the_title() . "</h2>";
                $output .= "<p>" . get_the_content() . "</p>";
                $output .= "</div>";
            }
       }

       wp_reset_postdata();

       return $output;

     }

    /**
     * Displays poem as per month assigned.
     * @param  integer $months 1 to 12
     * @return void
     */
    function display_poem_for_month( $month ) {
       $options = unserialize( get_option( 'poem' ) );
      
       return do_shortcode( '[poem id=' . $options['poem-' . $month] . ']' );
    }

    /**
     * Shortcode for current month poem.
     * @return void
     */
    function poem_current_shortcode() {
        return display_current_month_poem();
    }

    /**
     * Display current month poem.
     * @return void
     */
    function display_current_month_poem( ) {
        $month = date('n');
        
        return display_poem_for_month( $month );
    }


    /**      
     * Deletes poem option on deactivation
     */
    register_deactivation_hook( __FILE__, 'poem_deactivate' );
    function poem_deactivate() {
        delete_option( 'poem' );
    }
