<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package plugin-boilerplate
 * @subpackage plugin-boilerplate/src/Admin/Views/PluginBoilerplateOptions
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\PluginBoilerplate\Admin\Views;

use ThemeAtelier\PluginBoilerplate\Admin\Framework\Classes\PLUGIN_BOILERPLATE;

class PluginBoilerplateOptions
{

    /**
     * Create Option fields for the setting options.
     *
     * @param string $prefix Option setting key prefix.
     * @return void
     */
    public static function options($prefix)
    {
        PLUGIN_BOILERPLATE::createOptions($prefix, array(
            'menu_title'       => esc_html__('Plugin Boilerplate', 'plugin-boilerplate'),
            'menu_slug'        => 'plugin-boilerplate',
            'framework_title'  => esc_html__('Plugin Boilerplate', 'plugin-boilerplate'),
            'show_bar_menu'    => false,
            'menu_icon'        => 'dashicons-admin-settings',
            'footer_text'      => __('If you love the plugin don\'t forgot to add a review at <a target="_blank" href="https://wordpress.org/support/plugin/plugin-boilerplate/reviews/#new-post">WordPress plugin repository</a>. ', 'plugin-boilerplate'),
            'theme'            => 'light',
            'ajax_save'        => true,
            'show_reset_all'   => false,
            'show_search'      => false,
            'show_all_options' => false,
            'show_sub_menu'    => false,
            'nav'              => 'inline',
            'menu_position'    => 58,
        ));


        // Main options
        PLUGIN_BOILERPLATE::createSection($prefix, array(
            'title'  => esc_html__('Main Options', 'plugin-boilerplate'),
            'icon'   => 'icofont-home',
            'fields' => array(
                // Enable plugin boilerplate mode
                array(
                    'id'    => 'plugin_boilerplate_title',
                    'type'  => 'text',
                    'title' => esc_html__('Title', 'plugin-boilerplate'),
                    'label' => esc_html__('Set title', 'plugin-boilerplate'),
                ),

                array(
                    'id'    => 'plugin_boilerplate_description',
                    'type'  => 'textarea',
                    'title' => esc_html__('Description', 'plugin-boilerplate'),
                    'label' => esc_html__('Set description', 'plugin-boilerplate'),
                ),
            )
        ));
        // Main options
        PLUGIN_BOILERPLATE::createSection($prefix, array(
            'title'  => esc_html__('Color', 'plugin-boilerplate'),
            'icon'   => 'icofont-home',
            'fields' => array(
                // Enable plugin boilerplate mode
                array(
                    'id'    => 'plugin_boilerplate_title_color',
                    'type'  => 'color',
                    'title' => esc_html__('Title Color', 'plugin-boilerplate'),
                    'label' => esc_html__('Set title color', 'plugin-boilerplate'),
                ),

                array(
                    'id'    => 'plugin_boilerplate_description_color',
                    'type'  => 'color',
                    'title' => esc_html__('Description Color', 'plugin-boilerplate'),
                    'label' => esc_html__('Set description color', 'plugin-boilerplate'),
                ),
            )
        ));
    }
}
