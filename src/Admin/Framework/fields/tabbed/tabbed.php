<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: tabbed
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
use ThemeAtelier\PluginBoilerplate\Admin\Framework\Classes\PLUGIN_BOILERPLATE;

if ( ! class_exists( 'PLUGIN_BOILERPLATE_Field_tabbed' ) ) {
  class PLUGIN_BOILERPLATE_Field_tabbed extends PLUGIN_BOILERPLATE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unallows = array( 'tabbed' );

      echo $this->field_before();

      echo '<div class="plugin-boilerplate-tabbed-nav" data-depend-id="'. esc_attr( $this->field['id'] ) .'">';
      foreach ( $this->field['tabs'] as $key => $tab ) {

        $tabbed_icon   = ( ! empty( $tab['icon'] ) ) ? '<i class="plugin-boilerplate--icon '. esc_attr( $tab['icon'] ) .'"></i>' : '';
        $tabbed_active = ( empty( $key ) ) ? 'plugin-boilerplate-tabbed-active' : '';

        echo '<a href="#" class="'. esc_attr( $tabbed_active ) .'"">'. $tabbed_icon . esc_attr( $tab['title'] ) .'</a>';

      }
      echo '</div>';

      echo '<div class="plugin-boilerplate-tabbed-contents">';
      foreach ( $this->field['tabs'] as $key => $tab ) {

        $tabbed_hidden = ( ! empty( $key ) ) ? ' hidden' : '';

        echo '<div class="plugin-boilerplate-tabbed-content'. esc_attr( $tabbed_hidden ) .'">';

        foreach ( $tab['fields'] as $field ) {

          if ( in_array( $field['type'], $unallows ) ) { $field['_notice'] = true; }

          $field_id      = ( isset( $field['id'] ) ) ? $field['id'] : '';
          $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
          $field_value   = ( isset( $this->value[$field_id] ) ) ? $this->value[$field_id] : $field_default;
          $unique_id     = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .']' : $this->field['id'];

          PLUGIN_BOILERPLATE::field( $field, $field_value, $unique_id, 'field/tabbed' );

        }

        echo '</div>';

      }
      echo '</div>';

      echo $this->field_after();

    }

  }
}
