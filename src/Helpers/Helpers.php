<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package plugin-boilerplate
 * @subpackage plugin-boilerplate/src/Helpers
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\PluginBoilerplate\Helpers;

/**
 * The Helpers class to manage all public facing stuffs.
 *
 * @since 1.0.0
 */
class Helpers
{
    /**
     * The min of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $min   The slug of this plugin.
     */
    private $min;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name       The name of the plugin.
     * @param      string $version    The version of this plugin.
     */
    public function __construct()
    {
        $this->min   = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
    }

    /**
     * Register the All scripts for the public-facing side of the site.
     *
     * @since    2.0
     */
    public function register_all_scripts()
    {
        wp_register_style('ico-font', PLUGIN_BOILERPLATE_ASSETS . 'css/icofont' . $this->min . '.css', array(), '1.0.0', 'all');
        wp_register_style('plugin-boilerplate-style', PLUGIN_BOILERPLATE_ASSETS . 'css/plugin-boilerplate-style' . $this->min . '.css', array(), PLUGIN_BOILERPLATE_VERSION, 'all');

        wp_register_script('plugin-boilerplate-script', PLUGIN_BOILERPLATE_ASSETS . 'js/plugin-boilerplate-script' . $this->min . '.js', array('jquery'), PLUGIN_BOILERPLATE_VERSION, true);
    }
}
