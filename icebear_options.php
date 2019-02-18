<?php 
add_action('admin_menu', 'ice_bear_menu');
add_action( 'admin_init', 'register_icebear_settings' );

/**
* Registers Ice Bear Difficulty Setting
**/
function register_icebear_settings() {
    register_setting( 'icebear_options_group', 'icebear_difficulty', array('type' => 'number','default' => 2,)); 
} 


function ice_bear_menu() {
	add_options_page('IceBearOptions', 'IceBear', 'manage_options', 'ice-bear-options', 'ice_bear_options');
}

function ice_bear_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	echo '<h1>Ice Bear Options</h1>';
	echo '<div class="wrap">';
	echo '<p>Here is where you can manage icebear options.</p>';
	echo '</div>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'icebear_options_group' );
	do_settings_sections( 'icebear_options_group' );
	echo '<h2>Difficulty</h2>';
	echo '<label>Easy </label>';
	echo '<input name="icebear_difficulty" type="range" min="2" max="10" value="'.esc_attr( get_option('icebear_difficulty')).'">';
	echo '<label> Legendary</label>';
	submit_button();
	echo '</form>';

}



?>