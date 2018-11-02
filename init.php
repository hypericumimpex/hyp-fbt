<?php
/**
 * Plugin Name: HYP Fbt
 * Plugin URI: https://github.com/hypericumimpex/hyp-fbt/
 * Description: <code><strong>HYP Frequently Bought Together</strong></code> permite creșterea conversiei magazinului, prin afișarea mai frecventă a unei oferte cu produsele achiziționate împreună. În acest fel, utilizatorii sunt încurajați să adauge mai multe produse în coșul lor, la fel ca pe Amazon.
 * Version: 1.3.7
 * Author: Romeo C.
 * Author URI: https://github.com/romeo.covaci/
 * Text Domain: yith-woocommerce-frequently-bought-together
 * Domain Path: /languages/
 * WC requires at least: 2.6.0
 * WC tested up to: 3.5
 *
 * @author Romeo C.
 * @package HYP Fbt
 * @version 1.3.7
 */
/*  Copyright 2015  Your Inspiration Themes  (email : plugins@yithemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_wfbt_premium_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'YITH WooCommerce Frequently Bought Together Premium is enabled but not effective. It requires WooCommerce in order to work.', 'yith-woocommerce-frequently-bought-together' ); ?></p>
	</div>
<?php
}


if ( ! function_exists( 'yit_deactive_free_version' ) ) {
	require_once 'plugin-fw/yit-deactive-plugin.php';
}
yit_deactive_free_version( 'YITH_WFBT_FREE_INIT', plugin_basename( __FILE__ ) );


if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );


if ( ! defined( 'YITH_WFBT_VERSION' ) ){
	define( 'YITH_WFBT_VERSION', '1.3.7' );
}

if ( ! defined( 'YITH_WFBT' ) ) {
	define( 'YITH_WFBT', true );
}

if ( ! defined( 'YITH_WFBT_FILE' ) ) {
	define( 'YITH_WFBT_FILE', __FILE__ );
}

if ( ! defined( 'YITH_WFBT_URL' ) ) {
	define( 'YITH_WFBT_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'YITH_WFBT_DIR' ) ) {
	define( 'YITH_WFBT_DIR', plugin_dir_path( __FILE__ )  );
}

if ( ! defined( 'YITH_WFBT_TEMPLATE_PATH' ) ) {
	define( 'YITH_WFBT_TEMPLATE_PATH', YITH_WFBT_DIR . 'templates' );
}

if ( ! defined( 'YITH_WFBT_ASSETS_URL' ) ) {
	define( 'YITH_WFBT_ASSETS_URL', YITH_WFBT_URL . 'assets' );
}

if ( ! defined( 'YITH_WFBT_INIT' ) ) {
	define( 'YITH_WFBT_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_WFBT_PREMIUM' ) ) {
	define( 'YITH_WFBT_PREMIUM', '1' );
}

if ( ! defined( 'YITH_WFBT_META' ) ) {
    define( 'YITH_WFBT_META', '_yith_wfbt_data' );
}

if ( ! defined( 'YITH_WFBT_SLUG' ) ) {
	define( 'YITH_WFBT_SLUG', 'yith-woocommerce-frequently-bought-together' );
}

if ( ! defined( 'YITH_WFBT_SECRET_KEY' ) ) {
	define( 'YITH_WFBT_SECRET_KEY', 'PYFlvC0KPsVxJfIzPXyu' );
}

/* Plugin Framework Version Check */
if( ! function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( YITH_WFBT_DIR . 'plugin-fw/init.php' ) ) {
	require_once( YITH_WFBT_DIR . 'plugin-fw/init.php' );
}
yit_maybe_plugin_fw_loader( YITH_WFBT_DIR  );


function yith_wfbt_premium_init() {

	load_plugin_textdomain( 'yith-woocommerce-frequently-bought-together', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

	// Load required classes and functions
	require_once('includes/functions.yith-wfbt.php');
	require_once('includes/class.yith-wfbt.php');

	// Let's start the game!
	YITH_WFBT();
}
add_action( 'yith_wfbt_premium_init', 'yith_wfbt_premium_init' );


function yith_wfbt_premium_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'yith_wfbt_premium_install_woocommerce_admin_notice' );
	}
	else {
		do_action( 'yith_wfbt_premium_init' );
	}
}
add_action( 'plugins_loaded', 'yith_wfbt_premium_install', 11 );