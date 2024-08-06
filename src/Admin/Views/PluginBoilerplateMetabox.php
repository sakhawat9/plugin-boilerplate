<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package 	plugin-boilerplate
 * @subpackage 	plugin-boilerplate/src/Admin/Views
 * @author     	ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\PluginBoilerplate\Admin\Views;

use ThemeAtelier\PluginBoilerplate\Admin\Framework\Classes\PLUGIN_BOILERPLATE;

/**
 * Views class to create all metabox options for Domain For Sale Pro Shortcode generator.
 */
class PluginBoilerplateMetabox
{
	/**
	 * Create metabox for the Generator options.
	 *
	 * @param string $prefix Metabox key prefix.
	 * @return void
	 */
	public static function metaboxes($prefix)
	{
		PLUGIN_BOILERPLATE::createMetabox($prefix, array(
			'title'        => esc_html__('Domain For Sale Options', 'plugin-boilerplate'),
			'post_type'    => array("post", "page", "product"),
			'theme'        => 'light',
			'show_restore' => true,
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
	}
}
