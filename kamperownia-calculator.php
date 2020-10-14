<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Kamperownia kalkulator
 *
 * @wordpress-plugin
 * Plugin Name:       Kamperownia calculator
 * Plugin URI:        http://soyokaze.pl/kamperownia-calculator-uri/
 * Description:       Calculates prices on given dates.
 * Version:           1.0.0
 * Author:            Soyokaze.pl
 * Author URI:        http://soyokaze.pl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kamperownia-calculator
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!defined("KAMPEROWNIACALCULATOR_PLUGIN_DIR"))
    define("KAMPEROWNIACALCULATOR_PLUGIN_DIR", plugin_dir_path(__FILE__));
if (!defined("KAMPEROWNIACALCULATOR_PLUGIN_URL"))
    define("KAMPEROWNIACALCULATOR_PLUGIN_URL", plugins_url() . "/kamperownia_calculator");

add_action('phpmailer_init', 'send_smtp_email');

function send_smtp_email(PHPMailer $phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_HOST;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
//    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username = SMTP_USERNAME;
    $phpmailer->Password = SMTP_PASSWORD;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_FROMNAME;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('KAMPEROWNIA_CALCULATOR_VERSION', '1.0.0');
define('KAMPEROWNIA_OPTION_NAME', 'calculator');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kamperownia-calculator-activator.php
 */
function activate_kamperownia_calculator() {

    require_once plugin_dir_path(__FILE__) . 'includes/class-kamperownia-calculator-tables.php';
    $tables = new Kamperownia_Calculator_Tables();
    require_once plugin_dir_path(__FILE__) . 'includes/class-kamperownia-calculator-activator.php';
    $kamperowniacalculatoractivator = new Kamperownia_Calculator_Activator($tables);
    $kamperowniacalculatoractivator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kamperownia-calculator-deactivator.php
 */
function deactivate_kamperownia_calculator() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-kamperownia-calculator-tables.php';
    $tables = new Kamperownia_Calculator_Tables();
    require_once plugin_dir_path(__FILE__) . 'includes/class-kamperownia-calculator-deactivator.php';
    $kamperowniacalculatordeactivate = new Kamperownia_Calculator_Deactivator($tables);
    $kamperowniacalculatordeactivate->deactivate();
}

register_activation_hook(__FILE__, 'activate_kamperownia_calculator');
register_deactivation_hook(__FILE__, 'deactivate_kamperownia_calculator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-kamperownia-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kamperownia_calculator() {

    $plugin = new Plugin_Name();
    $plugin->run();
}

run_kamperownia_calculator();
