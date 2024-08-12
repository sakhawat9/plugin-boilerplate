<?php

/**
 * The file of the PluginBoilerplate class.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package PluginBoilerplate
 */

namespace ThemeAtelier\PluginBoilerplate;

use ThemeAtelier\PluginBoilerplate\Loader;
use ThemeAtelier\PluginBoilerplate\Helpers\Helpers;
use ThemeAtelier\PluginBoilerplate\Admin\Admin;
use ThemeAtelier\PluginBoilerplate\Frontend\Frontend;

// don't call the file directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main class of the plugin.
 *
 * Handle all the class and methods of the plugin.
 *
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class PluginBoilerplate
{
    /**
     * Plugin version
     *
     * @since    1.0.0
     * @access   protected
     * @var string
     */
    protected $version;

    /**
     * Plugin slug
     *
     * @since    1.0.0
     * @access   protected
     * @var string
     */
    protected $plugin_slug;

    /**
     * Main Loader.
     *
     * The loader that's responsible for maintaining and registering all hooks that empowers
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var object
     */
    protected $loader;
    /**
     * Constructor for the PluginBoilerplate class.
     *
     * Sets up all the appropriate hooks and actions within the plugin.
     */
    public function __construct()
    {
        $this->version     = PLUGIN_BOILERPLATE_VERSION;
        $this->plugin_slug = 'plugin-boilerplate';
        $this->load_dependencies();
        $this->define_constants();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        add_action('plugins_loaded', array($this, 'plugin_boilerplate_load_textdomain'));
        add_action('plugin_loaded', array($this, 'init_plugin'));
        add_action('activated_plugin', array($this, 'redirect_to'));
        $active_plugins = get_option('active_plugins');
        foreach ($active_plugins as $active_plugin) {
            $_temp = strpos($active_plugin, 'plugin-boilerplate.php');
            if (false != $_temp) {
                add_filter('plugin_action_links_' . $active_plugin, array($this, 'plugin_boilerplate_action_links'));
            }
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The slug of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_slug()
    {
        return $this->plugin_slug;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    // load text domain from plugin folder
    function plugin_boilerplate_load_textdomain()
    {
        load_plugin_textdomain('', false, PLUGIN_BOILERPLATE_DIRNAME . "/languages");
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('PLUGIN_BOILERPLATE_URL', plugins_url('', PLUGIN_BOILERPLATE_FILE));
        define('PLUGIN_BOILERPLATE_ASSETS', PLUGIN_BOILERPLATE_URL . '/src/assets/');
        define('PLUGIN_BOILERPLATE_ADMIN', PLUGIN_BOILERPLATE_URL . '/src/Admin');
    }

    public function redirect_to($plugin)
    {
        if (PLUGIN_BOILERPLATE_BASENAME === $plugin) {
            $redirect_url = esc_url(admin_url('admin.php?page=plugin-boilerplate'));
            exit(wp_kses_post(wp_safe_redirect($redirect_url)));
        }
    }

    /**
     * Load the plugin after all plugins are loaded.
     *
     * @return void
     */
    public function init_plugin()
    {
        do_action('PLUGIN_BOILERPLATE_loaded');
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Loader. Orchestrates the hooks of the plugin.
     * - Teamproi18n. Defines internationalization functionality.
     * - Admin. Defines all hooks for the admin area.
     * - Frontend. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        $this->loader = new Loader();
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Frontend($this->get_plugin_slug(), $this->get_version());
        $plugin_helpers = new Helpers($this->get_plugin_slug(), $this->get_version());
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the admin dashboard functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Admin($this->get_plugin_slug(), $this->get_version());
        $plugin_helpers = new Helpers($this->get_plugin_slug(), $this->get_version());
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    // Plugin settings in plugin list
    public function plugin_boilerplate_action_links(array $links)
    {
        $url = get_admin_url() . "admin.php?page=plugin-boilerplate#tab=main-options";
        $settings_link = '<a href="' . esc_url($url) . '">' . esc_html__('Settings', 'plugin-boilerplate') . '</a>';
        $links[] = $settings_link;
        return $links;
    }
}
