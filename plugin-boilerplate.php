<?php
/*
Plugin Name: 	Plugin Boilerplate
Plugin URI: 	https://www.themeatelier.net
Description: 	Plugin boilerplate description.
Author: 		ThemeAtelier
Version: 		1.0.0
Author:         ThemeAtelier
Author URI:     https://themeatelier.net/
License:        GPL-2.0+
License URI:    https://www.gnu.org/licenses/gpl-2.0.html
Requirements:   PHP 5.2.4 or above, WordPress 5.4 or above.
Text Domain:    plugin-boilerplate
Domain Path:    /languages
*/

// Block Direct access
if (!defined('ABSPATH')) {
    die('You should not access this file directly!.');
}
require_once __DIR__ . '/vendor/autoload.php';

use ThemeAtelier\PluginBoilerplate\PluginBoilerplate;

define('PLUGIN_BOILERPLATE_VERSION', '3.0.0');
define('PLUGIN_BOILERPLATE_FILE', __FILE__);
define('PLUGIN_BOILERPLATE_ALERT_MSG', esc_html__('You should not access this file directly.!', 'plugin-boilerplate'));
define('PLUGIN_BOILERPLATE_DIRNAME', dirname(__FILE__));
define('PLUGIN_BOILERPLATE_DIR_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_BOILERPLATE_DIR_URL', plugin_dir_url(__FILE__));
define('PLUGIN_BOILERPLATE_BASENAME', plugin_basename(__FILE__));


function plugin_boilerplate_run()
{
    // Launch the plugin.
    $PLUGIN_BOILERPLATE = new PluginBoilerplate();
    $PLUGIN_BOILERPLATE->run();
}

// kick-off the plugin
plugin_boilerplate_run();