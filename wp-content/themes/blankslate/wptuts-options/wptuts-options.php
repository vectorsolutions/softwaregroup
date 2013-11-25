<?php
function wptuts_get_default_options() {
	$options = array(
		'logo' => '',
		'logo_ids'=>''		
	);
	return $options;
}


function wptuts_options_init() {
     $wptuts_options = get_option( 'theme_wptuts_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $wptuts_options ) {
		  // If not, we'll save our default options
          $wptuts_options = wptuts_get_default_options();
		  add_option( 'theme_wptuts_options', $wptuts_options );
     }
	 
     // In other case we don't need to update the DB
}
// Initialize Theme options
add_action( 'after_setup_theme', 'wptuts_options_init' );

function wptuts_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'wptuts_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'wptuts-settings' );
		if ( $referer != '' ) {
			return __('I want this to be my logo!', 'wptuts' );
		}
	}

	return $translated_text;
}

// Add "WPTuts Options" link to the "Appearance" menu
function wptuts_menu_options() {
	//add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     add_theme_page('Homepage Options', 'Homepage Options', 'edit_theme_options', 'wptuts-settings', 'wptuts_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'wptuts_menu_options');

function wptuts_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'WPTuts Options', 'wptuts' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'wptuts-settings-errors' ); ?>
			
			<form id="form-wptuts-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_wptuts_options');
					do_settings_sections('wptuts');
				?>
			
				<p class="submit">
					<input name="theme_wptuts_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'wptuts'); ?>" />
					<input name="theme_wptuts_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'wptuts'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}

function wptuts_options_validate( $input ) {
	$default_options = wptuts_get_default_options();
	$valid_input = $default_options;
	
	$wptuts_options = get_option('theme_wptuts_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $wptuts_options['logo'] != $input['logo']  && $wptuts_options['logo'] != '' )
			delete_image( $wptuts_options['logo'] );

	
			$valid_input['logo'] = $input['logo'];
	 		$valid_input['logo_ids'] = $input['logo_ids'];
			
			$valid_input['logo02'] = $input['logo02'];
	 		$valid_input['logo_ids02'] = $input['logo_ids02'];
	 		$valid_input['headerimg_title'] = $input['headerimg_title'];			
	 		$valid_input['headerimg_title_link'] = $input['headerimg_title_link'];			
			
			
//	 		$valid_input['localservices_title'] = $input['localservices_title'];
			
//	 		$valid_input['search_title'] = $input['search_title'];
			

			$valid_input['logo03'] = $input['logo03'];
	 		$valid_input['logo_ids03'] = $input['logo_ids03'];
	 		$valid_input['act_title'] = $input['act_title'];
	 		$valid_input['act_details'] = $input['act_details'];			

			$valid_input['logo04'] = $input['logo04'];
	 		$valid_input['logo_ids04'] = $input['logo_ids04'];
	 		$valid_input['act_title_1'] = $input['act_title_1'];
	 		$valid_input['act_details_1'] = $input['act_details_1'];			

			$valid_input['logo05'] = $input['logo05'];
	 		$valid_input['logo_ids05'] = $input['logo_ids05'];
	 		$valid_input['act_title_2'] = $input['act_title_2'];
	 		$valid_input['act_details_2'] = $input['act_details_2'];			
//print_r($input);
//exit();

			$valid_input['logo06'] = $input['logo06'];
	 		$valid_input['logo_ids06'] = $input['logo_ids06'];
	 		$valid_input['client_text'] = $input['client_text'];


			$valid_input['logo07'] = $input['logo07'];
	 		$valid_input['logo_ids07'] = $input['logo_ids07'];
	 		$valid_input['client_text_2'] = $input['client_text_2'];


			$valid_input['logo08'] = $input['logo08'];
	 		$valid_input['logo_ids08'] = $input['logo_ids08'];
	 		$valid_input['client_text_3'] = $input['client_text_3'];


			$valid_input['wcu_1_htitle'] = $input['wcu_1_htitle'];
	 		$valid_input['wcu_1_title'] = $input['wcu_1_title'];
	 		$valid_input['logo09'] = $input['logo09'];
	 		$valid_input['logo_ids09'] = $input['logo_ids09'];
	 		$valid_input['wcu_1_detail'] = $input['wcu_1_detail'];


	 		$valid_input['wcu_2_title'] = $input['wcu_2_title'];
	 		$valid_input['logo10'] = $input['logo10'];
	 		$valid_input['logo_ids10'] = $input['logo_ids10'];
	 		$valid_input['wcu_2_detail'] = $input['wcu_2_detail'];


	 		$valid_input['wcu_3_title'] = $input['wcu_3_title'];
	 		$valid_input['logo11'] = $input['logo11'];
	 		$valid_input['logo_ids11'] = $input['logo_ids11'];
	 		$valid_input['wcu_3_detail'] = $input['wcu_3_detail'];



	 		$valid_input['wcu_ss_1_htitle'] = $input['wcu_ss_1_htitle'];
	 		$valid_input['wcu_ss_1_title'] = $input['wcu_ss_1_title'];
	 		$valid_input['logo12'] = $input['logo12'];
	 		$valid_input['logo_ids12'] = $input['logo_ids12'];
	 		$valid_input['wcu_ss_1_detail'] = $input['wcu_ss_1_detail'];


	 		$valid_input['wcu_ss_2_title'] = $input['wcu_ss_2_title'];
	 		$valid_input['logo13'] = $input['logo13'];
	 		$valid_input['logo_ids13'] = $input['logo_ids13'];
	 		$valid_input['wcu_ss_2_detail'] = $input['wcu_ss_2_detail'];


	 		$valid_input['wcu_ss_3_title'] = $input['wcu_ss_3_title'];
	 		$valid_input['logo14'] = $input['logo14'];
	 		$valid_input['logo_ids14'] = $input['logo_ids14'];
	 		$valid_input['wcu_ss_3_detail'] = $input['wcu_ss_3_detail'];







//	 		$valid_input['footer_text_address'] = $input['footer_text_address'];						
//	 		$valid_input['footer_text_phone'] = $input['footer_text_phone'];						
//	 		$valid_input['footer_text_email'] = $input['footer_text_email'];	


//	 		$valid_input['ads_text'] = $input['ads_text'];						
//	 		$valid_input['logo04'] = $input['logo04'];						
//	 		$valid_input['logo_ids04'] = $input['logo_ids04'];	
			
			



	
								

		
	}
	elseif ( $reset ) {
		delete_image( $wptuts_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
		$valid_input['logo_ids'] = $default_options['logo_ids'];			
	}
	elseif ( $delete_logo ) {
		delete_image( $wptuts_options['logo'] );
		$valid_input['logo'] = '';
		$valid_input['logo_ids'] = '';			
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	// We need to get the image's meta ID..
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function wptuts_options_enqueue_scripts() {
	wp_register_script( 'wptuts-upload', get_template_directory_uri() .'/wptuts-options/js/wptuts-upload.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_wptuts-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('wptuts-upload');
		
	}
	
}
add_action('admin_enqueue_scripts', 'wptuts_options_enqueue_scripts');


function wptuts_options_settings_init() {
	register_setting( 'theme_wptuts_options', 'theme_wptuts_options', 'wptuts_options_validate' );
	

// Image upload 1 
	
	add_settings_section('wptuts_settings_header', __( 'Logo Options', 'wptuts' ), 'wptuts_settings_header_text', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo',  __( 'Logo', 'wptuts' ), 'wptuts_setting_logo', 'wptuts', 'wptuts_settings_header');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview',  __( 'Logo Preview', 'wptuts' ), 'wptuts_setting_logo_preview', 'wptuts', 'wptuts_settings_header'); // Add Current Image Preview 



// Image upload 2

	add_settings_section('wptuts_settings_header2', __( 'Home Page Banner', 'wptuts' ), 'wptuts_settings_header_text2', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo2',  __( 'Banner Image', 'wptuts' ), 'wptuts_setting_logo2', 'wptuts', 'wptuts_settings_header2');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview2',  __( 'Banner Preview', 'wptuts' ), 'wptuts_setting_logo_preview2', 'wptuts', 'wptuts_settings_header2'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_mainImage_Field_title',  __( 'Button Title', 'wptuts' ), 'wptuts_setting_logo_Field_title', 'wptuts', 'wptuts_settings_header2');

	add_settings_field('wptuts_setting_mainImage_Field_title_link',  __( 'Link ', 'wptuts' ), 'wptuts_setting_logo_Field_title_link', 'wptuts', 'wptuts_settings_header2');	





// Local Services   
//	add_settings_section('wptuts_settings_header4', __( 'Local Services', 'wptuts' ), 'wptuts_settings_header_text4', 'wptuts'); // Add a form
//	add_settings_field('wptuts_setting_localservice_Field_title',  __( 'Local Services ', 'wptuts' ), 'wptuts_setting_localservice_Field_title', 'wptuts', 'wptuts_settings_header4');




// Search Options
//	add_settings_section('wptuts_settings_header5', __( 'Search Area', 'wptuts' ), 'wptuts_settings_header_text5', 'wptuts'); // Add a form
//	add_settings_field('wptuts_setting_search_Field_title',  __( 'Local Services ', 'wptuts' ), 'wptuts_setting_search_Field_title', 'wptuts', 'wptuts_settings_header5');







// Image upload 3   Action 1

	add_settings_section('wptuts_settings_header3', __( 'Action Area # 1 ', 'wptuts' ), 'wptuts_settings_header_text3', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo3',  __( 'Banner Image', 'wptuts' ), 'wptuts_setting_logo3', 'wptuts', 'wptuts_settings_header3');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview3',  __( 'Banner Preview', 'wptuts' ), 'wptuts_setting_logo_preview3', 'wptuts', 'wptuts_settings_header3'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_ads_Field_title',  __( 'Title', 'wptuts' ), 'wptuts_setting_ads_Field_title', 'wptuts', 'wptuts_settings_header3');
	
	add_settings_field('wptuts_setting_ads_Field_details',  __( 'Details', 'wptuts' ), 'wptuts_setting_ads_Field_details', 'wptuts', 'wptuts_settings_header3');	
	



// Image upload 3   Action 2

	add_settings_section('wptuts_settings_header3_1', __( 'Action Area # 2 ', 'wptuts' ), 'wptuts_settings_header_text3_1', 'wptuts'); // Add a form
	add_settings_field('wptuts_setting_logo3_1',  __( 'Banner Image', 'wptuts' ), 'wptuts_setting_logo3_1', 'wptuts', 'wptuts_settings_header3_1');// Add Logo uploader

	add_settings_field('wptuts_setting_logo_preview3_1',  __( 'Banner Preview', 'wptuts' ), 'wptuts_setting_logo_preview3_1', 'wptuts', 'wptuts_settings_header3_1'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_ads_Field_title_1',  __( 'Title', 'wptuts' ), 'wptuts_setting_ads_Field_title_1', 'wptuts', 'wptuts_settings_header3_1');

	add_settings_field('wptuts_setting_ads_Field_details_1',  __( 'Details', 'wptuts' ), 'wptuts_setting_ads_Field_details_1', 'wptuts', 'wptuts_settings_header3_1');	



// Image upload 3   Action 3

	add_settings_section('wptuts_settings_header3_2', __( 'Action Area # 3 ', 'wptuts' ), 'wptuts_settings_header_text3_2', 'wptuts'); // Add a form
	add_settings_field('wptuts_setting_logo3_2',  __( 'Banner Image', 'wptuts' ), 'wptuts_setting_logo3_2', 'wptuts', 'wptuts_settings_header3_2');// Add Logo uploader

	add_settings_field('wptuts_setting_logo_preview3_2',  __( 'Banner Preview', 'wptuts' ), 'wptuts_setting_logo_preview3_2', 'wptuts', 'wptuts_settings_header3_2'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_ads_Field_title_2',  __( 'Title', 'wptuts' ), 'wptuts_setting_ads_Field_title_2', 'wptuts', 'wptuts_settings_header3_2');

	add_settings_field('wptuts_setting_ads_Field_details_2',  __( 'Details', 'wptuts' ), 'wptuts_setting_ads_Field_details_2', 'wptuts', 'wptuts_settings_header3_2');	






// Ads upload 4

	add_settings_section('wptuts_settings_header7', __( 'Client # 1 ', 'wptuts' ), 'wptuts_settings_header_text7', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo4',  __( 'Image', 'wptuts' ), 'wptuts_setting_logo4', 'wptuts', 'wptuts_settings_header7');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview4',  __( 'Preview', 'wptuts' ), 'wptuts_setting_logo_preview4', 'wptuts', 'wptuts_settings_header7'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_Field7',  __( 'Title', 'wptuts' ), 'wptuts_setting_Field7', 'wptuts', 'wptuts_settings_header7');




// Ads upload 4

	add_settings_section('wptuts_settings_header8', __( 'Client # 2 ', 'wptuts' ), 'wptuts_settings_header_text8', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo5',  __( 'Image', 'wptuts' ), 'wptuts_setting_logo5', 'wptuts', 'wptuts_settings_header8');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview5',  __( 'Preview', 'wptuts' ), 'wptuts_setting_logo_preview5', 'wptuts', 'wptuts_settings_header8'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_Field8',  __( 'Title', 'wptuts' ), 'wptuts_setting_Field8', 'wptuts', 'wptuts_settings_header8');


	
// Ads upload 4

	add_settings_section('wptuts_settings_header9', __( 'Client # 3 ', 'wptuts' ), 'wptuts_settings_header_text9', 'wptuts'); // Add a form section for the Logo
	add_settings_field('wptuts_setting_logo6',  __( 'Banner Image', 'wptuts' ), 'wptuts_setting_logo6', 'wptuts', 'wptuts_settings_header9');// Add Logo uploader
	add_settings_field('wptuts_setting_logo_preview6',  __( 'Banner Preview', 'wptuts' ), 'wptuts_setting_logo_preview6', 'wptuts', 'wptuts_settings_header9'); // Add Current Image Preview 

	add_settings_field('wptuts_setting_Field9',  __( 'Title', 'wptuts' ), 'wptuts_setting_Field9', 'wptuts', 'wptuts_settings_header9');


		


	add_settings_section('wptuts_settings_whychoseus', __( 'Why Chose Us ', 'wptuts' ), 'wptuts_settings_header_whychoseus', 'wptuts'); // Add a form section for the Logo

	add_settings_field('wptuts_setting_1_Htitle',  __( 'Heading Title', 'wptuts' ), 'wptuts_setting_1_Htitle', 'wptuts', 'wptuts_settings_whychoseus');
	
	add_settings_field('wptuts_setting_1_title',  __( 'Title', 'wptuts' ), 'wptuts_setting_1_title', 'wptuts', 'wptuts_settings_whychoseus');
	add_settings_field('wptuts_setting_1_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_1_img', 'wptuts', 'wptuts_settings_whychoseus');// Add Logo uploader
	add_settings_field('wptuts_setting_1_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_1_img_preview', 'wptuts', 'wptuts_settings_whychoseus'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_1_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_1_detail', 'wptuts', 'wptuts_settings_whychoseus');


	add_settings_field('wptuts_setting_2_title',  __( 'Title', 'wptuts' ), 'wptuts_setting_2_title', 'wptuts', 'wptuts_settings_whychoseus');
	add_settings_field('wptuts_setting_2_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_2_img', 'wptuts', 'wptuts_settings_whychoseus');// Add Logo uploader
	add_settings_field('wptuts_setting_2_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_2_img_preview', 'wptuts', 'wptuts_settings_whychoseus'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_2_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_2_detail', 'wptuts', 'wptuts_settings_whychoseus');





	add_settings_field('wptuts_setting_3_title',  __( 'Title', 'wptuts' ), 'wptuts_setting_3_title', 'wptuts', 'wptuts_settings_whychoseus');
	add_settings_field('wptuts_setting_3_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_3_img', 'wptuts', 'wptuts_settings_whychoseus');// Add Logo uploader
	add_settings_field('wptuts_setting_3_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_3_img_preview', 'wptuts', 'wptuts_settings_whychoseus'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_3_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_3_detail', 'wptuts', 'wptuts_settings_whychoseus');








add_settings_section('wptuts_settings_sucessstories', __( 'Sucess Stories', 'wptuts' ), 'wptuts_settings_header_sucessstories', 'wptuts'); // Add a form section for the Logo

	add_settings_field('wptuts_setting_sucessstories_1_Htitle',  __( 'Heading Title', 'wptuts' ), 'wptuts_setting_sucessstories_1_Htitle', 'wptuts', 'wptuts_settings_sucessstories');
	
	add_settings_field('wptuts_setting_sucessstories_1_title',  __( 'Client Name', 'wptuts' ), 'wptuts_setting_sucessstories_1_title', 'wptuts', 'wptuts_settings_sucessstories');
	add_settings_field('wptuts_setting_sucessstories_1_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_sucessstories_1_img', 'wptuts', 'wptuts_settings_sucessstories');// Add Logo uploader
	add_settings_field('wptuts_setting_sucessstories_1_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_sucessstories_1_img_preview', 'wptuts', 'wptuts_settings_sucessstories'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_sucessstories_1_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_sucessstories_1_detail', 'wptuts', 'wptuts_settings_sucessstories');





	add_settings_field('wptuts_setting_sucessstories_2_title',  __( 'Client Name', 'wptuts' ), 'wptuts_setting_sucessstories_2_title', 'wptuts', 'wptuts_settings_sucessstories');
	add_settings_field('wptuts_setting_sucessstories_2_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_sucessstories_2_img', 'wptuts', 'wptuts_settings_sucessstories');// Add Logo uploader
	add_settings_field('wptuts_setting_sucessstories_2_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_sucessstories_2_img_preview', 'wptuts', 'wptuts_settings_sucessstories'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_sucessstories_2_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_sucessstories_2_detail', 'wptuts', 'wptuts_settings_sucessstories');


	add_settings_field('wptuts_setting_sucessstories_3_title',  __( 'Client Name', 'wptuts' ), 'wptuts_setting_sucessstories_3_title', 'wptuts', 'wptuts_settings_sucessstories');
	add_settings_field('wptuts_setting_sucessstories_3_img',  __( 'Image', 'wptuts' ), 'wptuts_setting_sucessstories_3_img', 'wptuts', 'wptuts_settings_sucessstories');// Add Logo uploader
	add_settings_field('wptuts_setting_sucessstories_3_img_preview',  __( 'Preview', 'wptuts' ), 'wptuts_setting_sucessstories_3_img_preview', 'wptuts', 'wptuts_settings_sucessstories'); // Add Current Image Preview 
	add_settings_field('wptuts_setting_sucessstories_3_detail',  __( 'Detail', 'wptuts' ), 'wptuts_setting_sucessstories_3_detail', 'wptuts', 'wptuts_settings_sucessstories');




// footer Options
//	add_settings_section('wptuts_settings_header6', __( 'Footer Area', 'wptuts' ), 'wptuts_settings_header_text6', 'wptuts'); // Add a form
//	add_settings_field('wptuts_setting_footer_Field_address',  __( 'Address', 'wptuts' ), 'wptuts_setting_footer_Field_address', 'wptuts', 'wptuts_settings_header6');
//	add_settings_field('wptuts_setting_footer_Field_phone',  __( 'Phone', 'wptuts' ), 'wptuts_setting_footer_Field_phone', 'wptuts', 'wptuts_settings_header6');
//	add_settings_field('wptuts_setting_footer_Field_email',  __( 'Email', 'wptuts' ), 'wptuts_setting_footer_Field_email', 'wptuts', 'wptuts_settings_header6');

	
	
	
}
add_action( 'admin_init', 'wptuts_options_settings_init' );



function wptuts_setting_logo_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo'] ); ?>" />
	</div>
	<?php
}

function wptuts_settings_header_text() {
	?>
		<p><?php _e( 'Manage Logo Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_logo() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url01" name="theme_wptuts_options[logo]" value="<?php echo esc_url( $wptuts_options['logo'] ); ?>" />
	<input type="hidden" id="img_ids01" name="theme_wptuts_options[logo_ids]" value="<?php echo  $wptuts_options['logo_ids'] ; ?>" />        
		<input id="upload_logo_button1" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo'] ): ?>
			<input id="delete_logo_button1" name="theme_wptuts_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}





function wptuts_setting_logo_preview2() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo02'] ); ?>" />
	</div>
	<?php
}

function wptuts_settings_header_text2() {
	?>
		<p><?php _e( 'Manage Logo Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_logo2() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url02" name="theme_wptuts_options[logo02]" value="<?php echo esc_url( $wptuts_options['logo02'] ); ?>" />
	<input type="hidden" id="img_ids02" name="theme_wptuts_options[logo_ids02]" value="<?php echo  $wptuts_options['logo_ids02'] ; ?>" />        
		<input id="upload_logo_button02" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo02'] ): ?>
			<input id="delete_logo_button02" name="theme_wptuts_options[delete_logo02]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}






function wptuts_setting_logo_preview3() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo03'] ); ?>" />
	</div>
	<?php
}










function wptuts_settings_header_text3() {
	?>
		<p><?php _e( 'Manage Logo Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}


function wptuts_settings_header_text3_1() {
	?>
		<p><?php _e( 'Manage Logo Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_logo3_1() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url04" name="theme_wptuts_options[logo04]" value="<?php echo esc_url( $wptuts_options['logo04'] ); ?>" />
	<input type="hidden" id="img_ids04" name="theme_wptuts_options[logo_ids04]" value="<?php echo  $wptuts_options['logo_ids04'] ; ?>" />        
		<input id="upload_logo_button04" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo04'] ): ?>
			<input id="delete_logo_button04" name="theme_wptuts_options[delete_logo04]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_logo_preview3_1() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo04'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_ads_Field_title_1() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_title_1]'
	);
	wp_editor( $wptuts_options1['act_title_1'] , 'act_title_1', $args );

	?>
		<span class="description"><?php _e('Title for ads Area.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_ads_Field_details_1() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 3,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_details_1]'
	);
	wp_editor( $wptuts_options1['act_details_1'] , 'act_details_1', $args );

	?>
		<span class="description"><?php _e('Title for ads Details.', 'wptuts' ); ?></span>
	<?php
}





function wptuts_settings_header_text3_2() {
	?>
		<p><?php _e( 'Manage Logo Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_logo3_2() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url05" name="theme_wptuts_options[logo05]" value="<?php echo esc_url( $wptuts_options['logo05'] ); ?>" />
	<input type="hidden" id="img_ids05" name="theme_wptuts_options[logo_ids05]" value="<?php echo  $wptuts_options['logo_ids05'] ; ?>" />        
		<input id="upload_logo_button05" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo05'] ): ?>
			<input id="delete_logo_button05" name="theme_wptuts_options[delete_logo05]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}




function wptuts_setting_logo_preview3_2() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo05'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_ads_Field_title_2() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_title_2]'
	);
	wp_editor( $wptuts_options1['act_title_2'] , 'act_title_2', $args );

	?>
		<span class="description"><?php _e('Title for ads Area.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_ads_Field_details_2() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 3,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_details_2]'
	);
	wp_editor( $wptuts_options1['act_details_2'] , 'act_details_2', $args );

	?>
		<span class="description"><?php _e('Title for ads Details.', 'wptuts' ); ?></span>
	<?php
}













function wptuts_setting_logo3() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url03" name="theme_wptuts_options[logo03]" value="<?php echo esc_url( $wptuts_options['logo03'] ); ?>" />
	<input type="hidden" id="img_ids03" name="theme_wptuts_options[logo_ids03]" value="<?php echo  $wptuts_options['logo_ids03'] ; ?>" />        
		<input id="upload_logo_button03" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo03'] ): ?>
			<input id="delete_logo_button03" name="theme_wptuts_options[delete_logo03]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}









function wptuts_setting_ads_Field_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_title]'
	);
	wp_editor( $wptuts_options1['act_title'] , 'act_title', $args );

	?>
		<span class="description"><?php _e('Title for ads Area.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_ads_Field_details() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 3,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[act_details]'
	);
	wp_editor( $wptuts_options1['act_details'] , 'act_details', $args );

	?>
		<span class="description"><?php _e('Title for ads Details.', 'wptuts' ); ?></span>
	<?php
}




function wptuts_setting_logo_Field_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[headerimg_title]'
	);
	wp_editor( $wptuts_options1['headerimg_title'] , 'headerimg_title', $args );

	?>
		<span class="description"><?php _e('Title for Header Image.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_logo_Field_title_link() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	?>
		<input type="text" id="headerimg_title_link" name="theme_homepage_options[headerimg_title_link]" value="<?php echo esc_url( $wptuts_options1['headerimg_title_link'] ); ?>" />
    
		<span class="description"><?php _e('Title for Header Image.', 'wptuts' ); ?></span>
	<?php
}





function wptuts_settings_header_text4() {
	?>
		<p><?php _e( 'Local Services Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}



function wptuts_setting_localservice_Field_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[localservices_title]'
	);
	wp_editor( $wptuts_options1['localservices_title'] , 'localservices_title', $args );

	?>
		<span class="description"><?php _e('Title for Local Services.', 'wptuts' ); ?></span>
	<?php
}






function wptuts_settings_header_text5() {
	?>
		<p><?php _e( 'Search Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}


function wptuts_settings_header_text6() {
	?>
		<p><?php _e( 'footer Options for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}







function wptuts_setting_search_Field_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => false,
		'textarea_name' => 'theme_wptuts_options[search_title]'
	);
	wp_editor( $wptuts_options1['search_title'] , 'search_title', $args );

	?>
		<span class="description"><?php _e('Title for Search Area.', 'wptuts' ); ?></span>
	<?php
}



function wptuts_setting_footer_Field_address() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[footer_text_address]'
	);
	wp_editor( $wptuts_options1['footer_text_address'] , 'footer_text_address', $args );

	?>
		<span class="description"><?php _e('footer Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_footer_Field_phone() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[footer_text_phone]'
	);
	wp_editor( $wptuts_options1['footer_text_phone'] , 'footer_text_phone', $args );

	?>
		<span class="description"><?php _e('footer Text Phone.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_footer_Field_email() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[footer_text_email]'
	);
	wp_editor( $wptuts_options1['footer_text_email'] , 'footer_text_email', $args );

	?>
		<span class="description"><?php _e('footer Text Email.', 'wptuts' ); ?></span>
	<?php
}






function wptuts_settings_header_text7() {
	?>
		<p><?php _e( 'Client logo for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}


function wptuts_setting_logo4() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url06" name="theme_wptuts_options[logo06]" value="<?php echo esc_url( $wptuts_options['logo06'] ); ?>" />
	<input type="hidden" id="img_ids06" name="theme_wptuts_options[logo_ids06]" value="<?php echo  $wptuts_options['logo_ids06'] ; ?>" />        
		<input id="upload_logo_button06" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo06'] ): ?>
			<input id="delete_logo_button06" name="theme_wptuts_options[delete_logo06]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_logo_preview4() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo06'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_Field7() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[client_text]'
	);
	wp_editor( $wptuts_options1['client_text'] , 'client_text', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}






function wptuts_settings_header_text8() {
	?>
		<p><?php _e( 'Client logo for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}


function wptuts_setting_logo5() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url07" name="theme_wptuts_options[logo07]" value="<?php echo esc_url( $wptuts_options['logo07'] ); ?>" />
	<input type="hidden" id="img_ids07" name="theme_wptuts_options[logo_ids07]" value="<?php echo  $wptuts_options['logo_ids07'] ; ?>" />        
		<input id="upload_logo_button07" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo07'] ): ?>
			<input id="delete_logo_button07" name="theme_wptuts_options[delete_logo07]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_logo_preview5() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo07'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_Field8() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[client_text_2]'
	);
	wp_editor( $wptuts_options1['client_text_2'] , 'client_text_2', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}










function wptuts_settings_header_text9() {
	?>
		<p><?php _e( 'Client logo for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}


function wptuts_setting_logo6() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url08" name="theme_wptuts_options[logo08]" value="<?php echo esc_url( $wptuts_options['logo08'] ); ?>" />
	<input type="hidden" id="img_ids08" name="theme_wptuts_options[logo_ids08]" value="<?php echo  $wptuts_options['logo_ids08'] ; ?>" />        
		<input id="upload_logo_button08" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo08'] ): ?>
			<input id="delete_logo_button08" name="theme_wptuts_options[delete_logo08]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_logo_preview6() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo08'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_Field9() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[client_text_3]'
	);
	wp_editor( $wptuts_options1['client_text_3'] , 'client_text_3', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}



function wptuts_settings_header_whychoseus() {
	?>
		<p><?php _e( 'Client logo for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_1_Htitle() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_1_htitle]'
	);
	wp_editor( $wptuts_options1['wcu_1_htitle'] , 'wcu_1_htitle', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_1_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_1_title]'
	);
	wp_editor( $wptuts_options1['wcu_1_title'] , 'wcu_1_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_1_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url09" name="theme_wptuts_options[logo09]" value="<?php echo esc_url( $wptuts_options['logo09'] ); ?>" />
	<input type="hidden" id="img_ids09" name="theme_wptuts_options[logo_ids09]" value="<?php echo  $wptuts_options['logo_ids09'] ; ?>" />        
		<input id="upload_logo_button09" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo09'] ): ?>
			<input id="delete_logo_button09" name="theme_wptuts_options[delete_logo09]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_1_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo09'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_1_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_1_detail]'
	);
	wp_editor( $wptuts_options1['wcu_1_detail'] , 'wcu_1_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}





function wptuts_setting_2_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_2_title]'
	);
	wp_editor( $wptuts_options1['wcu_2_title'] , 'wcu_2_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_2_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url10" name="theme_wptuts_options[logo10]" value="<?php echo esc_url( $wptuts_options['logo10'] ); ?>" />
	<input type="hidden" id="img_ids10" name="theme_wptuts_options[logo_ids10]" value="<?php echo  $wptuts_options['logo_ids10'] ; ?>" />        
		<input id="upload_logo_button10" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo10'] ): ?>
			<input id="delete_logo_button10" name="theme_wptuts_options[delete_logo10]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_2_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo10'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_2_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_2_detail]'
	);
	wp_editor( $wptuts_options1['wcu_2_detail'] , 'wcu_2_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}





function wptuts_setting_3_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_3_title]'
	);
	wp_editor( $wptuts_options1['wcu_3_title'] , 'wcu_3_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_3_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url11" name="theme_wptuts_options[logo11]" value="<?php echo esc_url( $wptuts_options['logo11'] ); ?>" />
	<input type="hidden" id="img_ids11" name="theme_wptuts_options[logo_ids11]" value="<?php echo  $wptuts_options['logo_ids11'] ; ?>" />        
		<input id="upload_logo_button11" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo11'] ): ?>
			<input id="delete_logo_button11" name="theme_wptuts_options[delete_logo11]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_3_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo11'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_3_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_3_detail]'
	);
	wp_editor( $wptuts_options1['wcu_3_detail'] , 'wcu_3_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}







function wptuts_settings_header_sucessstories() {
	?>
		<p><?php _e( 'Client logo for Home Page Option.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_sucessstories_1_Htitle() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_1_htitle]'
	);
	wp_editor( $wptuts_options1['wcu_ss_1_htitle'] , 'wcu_ss_1_htitle', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_sucessstories_1_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_1_title]'
	);
	wp_editor( $wptuts_options1['wcu_ss_1_title'] , 'wcu_ss_1_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_sucessstories_1_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url12" name="theme_wptuts_options[logo12]" value="<?php echo esc_url( $wptuts_options['logo12'] ); ?>" />
	<input type="hidden" id="img_ids12" name="theme_wptuts_options[logo_ids12]" value="<?php echo  $wptuts_options['logo_ids12'] ; ?>" />        
		<input id="upload_logo_button12" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo12'] ): ?>
			<input id="delete_logo_button12" name="theme_wptuts_options[delete_logo12]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_sucessstories_1_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo12'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_sucessstories_1_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_1_detail]'
	);
	wp_editor( $wptuts_options1['wcu_ss_1_detail'] , 'wcu_ss_1_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}












function wptuts_setting_sucessstories_2_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_2_title]'
	);
	wp_editor( $wptuts_options1['wcu_ss_2_title'] , 'wcu_ss_2_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_sucessstories_2_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url13" name="theme_wptuts_options[logo13]" value="<?php echo esc_url( $wptuts_options['logo13'] ); ?>" />
	<input type="hidden" id="img_ids13" name="theme_wptuts_options[logo_ids13]" value="<?php echo  $wptuts_options['logo_ids13'] ; ?>" />        
		<input id="upload_logo_button13" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo13'] ): ?>
			<input id="delete_logo_button13" name="theme_wptuts_options[delete_logo13]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_sucessstories_2_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo13'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_sucessstories_2_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_2_detail]'
	);
	wp_editor( $wptuts_options1['wcu_ss_2_detail'] , 'wcu_ss_2_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}









function wptuts_setting_sucessstories_3_title() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_3_title]'
	);
	wp_editor( $wptuts_options1['wcu_ss_3_title'] , 'wcu_ss_3_title', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_sucessstories_3_img() {
	$wptuts_options = get_option( 'theme_wptuts_options' );
	?>
		<input type="hidden" id="logo_url14" name="theme_wptuts_options[logo14]" value="<?php echo esc_url( $wptuts_options['logo14'] ); ?>" />
	<input type="hidden" id="img_ids14" name="theme_wptuts_options[logo_ids14]" value="<?php echo  $wptuts_options['logo_ids14'] ; ?>" />        
		<input id="upload_logo_button14" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options['logo14'] ): ?>
			<input id="delete_logo_button14" name="theme_wptuts_options[delete_logo14]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an Client logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_sucessstories_3_img_preview() {
	$wptuts_options = get_option( 'theme_wptuts_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo14'] ); ?>" />
	</div>
	<?php
}


function wptuts_setting_sucessstories_3_detail() {
	$wptuts_options1 = get_option( 'theme_wptuts_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'theme_wptuts_options[wcu_ss_3_detail]'
	);
	wp_editor( $wptuts_options1['wcu_ss_3_detail'] , 'wcu_ss_3_detail', $args );

	?>
		<span class="description"><?php _e('Client Text .', 'wptuts' ); ?></span>
	<?php
}





?>