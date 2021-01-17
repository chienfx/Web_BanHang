<?php
if ( ! function_exists( 'get_editable_roles' ) ) {
	require_once ABSPATH . 'wp-admin/includes/user.php';
}
$editable_roles = array_reverse( get_editable_roles() );
foreach ( $editable_roles as $role_id => $role_data) {
	$user_roles[$role_id] = translate_user_role( $role_data['name'] );
}
$user_roles = apply_filters( 'xoo_el_admin_user_roles', $user_roles );

$settings = array(

	/** MAIN **/
	array(
		'callback' 		=> 'links',
		'title' 		=> 'Registration Fields',
		'id' 			=> 'fake',
		'section_id' 	=> 'gl_main',
		'args' 			=> array(
			'options' 	=> array(
				admin_url('admin.php?page=xoo-el-fields') => 'Manage'
			)
		)
	),

	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Enable Registration',
		'id' 			=> 'm-en-reg',
		'section_id' 	=> 'gl_main',
		'default' 		=> 'yes',
	),


	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Auto Login User on Sign up',
		'id' 			=> 'm-auto-login',
		'section_id' 	=> 'gl_main',
		'default' 		=> 'yes',
	),


	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Handle Reset Password',
		'id' 			=> 'm-reset-pw',
		'section_id' 	=> 'gl_main',
		'default' 		=> 'yes',
		'desc' 			=> 'If checked, allow users to set a new password in form.'
	),

	array(
		'callback' 		=> 'select',
		'title' 		=> 'User Role',
		'id' 			=> 'm-user-role',
		'section_id' 	=> 'gl_main',
		'args'			=> array(
			'options' => $user_roles
		),
		'default' 		=> class_exists( 'woocommerce' ) ? 'customer' : 'subscriber'
	),


	array(
		'callback' 		=> 'text',
		'title' 		=> 'Login Redirect',
		'id' 			=> 'm-red-login',
		'section_id' 	=> 'gl_main',
		'default' 		=> '',
		'desc' 			=> 'Leave empty to redirect on the same page.'
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Register Redirect',
		'id' 			=> 'm-red-register',
		'section_id' 	=> 'gl_main',
		'default' 		=> '',
		'desc' 			=> 'Leave empty to redirect on the same page.'
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Logout Redirect',
		'id' 			=> 'm-red-logout',
		'section_id' 	=> 'gl_main',
		'default' 		=> '',
		'desc' 			=> 'Leave empty to redirect on the same page.'
	),

);


if( class_exists( 'woocommerce' ) ){
	$settings[] = array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Replace myaccount form',
		'id' 			=> 'm-en-myaccount',
		'section_id' 	=> 'gl_wc',
		'default' 		=> 'yes',
		'desc' 			=> 'If checked , this will replace woocommerce myaccount page form.'
	);

	$settings[] = array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Replace checkout login form',
		'id' 			=> 'm-en-chkout',
		'section_id' 	=> 'gl_wc',
		'default' 		=> 'yes',
		'desc' 			=> 'If checked & login on checkout is enabled, this will replace login form.'
	);
}


$autoOpen = array(
	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Auto open Popup',
		'id' 			=> 'ao-enable',
		'section_id' 	=> 'gl_ao',
		'default' 		=> 'no',
	),

	array(
		'callback' 		=> 'textarea',
		'title' 		=> 'On Pages',
		'id' 			=> 'ao-pages',
		'section_id' 	=> 'gl_ao',
		'default' 		=> '',
		'desc' 			=> 'Use post type/page id/slug separated by comma. For eg: 19,contact-us,shop .Leave empty for every page.'
	),

	array(
		'callback' 		=> 'number',
		'title' 		=> 'Delay',
		'id' 			=> 'ao-delay',
		'section_id' 	=> 'gl_ao',
		'default' 		=> 500,
		'desc' 			=> 'Trigger popup after seconds. 1000 = 1 second'
	),

);

$settings = array_merge( $settings, $autoOpen );

return apply_filters( 'xoo_el_admin_settings', $settings, 'general' );

?>