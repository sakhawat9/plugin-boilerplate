<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: textarea
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
use ThemeAtelier\PluginBoilerplate\Admin\Framework\Classes\PLUGIN_BOILERPLATE;

if ( ! class_exists( 'PLUGIN_BOILERPLATE_Field_textarea' ) ) {
  class PLUGIN_BOILERPLATE_Field_textarea extends PLUGIN_BOILERPLATE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      echo $this->field_before();
      echo $this->shortcoder();
      echo '<textarea name="'. esc_attr( $this->field_name() ) .'"'. $this->field_attributes() .'>'. $this->value .'</textarea>';
      echo $this->field_after();

    }

    public function shortcoder() {

      if ( ! empty( $this->field['shortcoder'] ) ) {

        $shortcodes = ( is_array( $this->field['shortcoder'] ) ) ? $this->field['shortcoder'] : array_filter( (array) $this->field['shortcoder'] );
        $instances  = ( ! empty( PLUGIN_BOILERPLATE::$shortcode_instances ) ) ? PLUGIN_BOILERPLATE::$shortcode_instances : array();

        if ( ! empty( $shortcodes ) && ! empty( $instances ) ) {

          foreach ( $shortcodes as $shortcode ) {

            foreach ( $instances as $instance ) {

              if ( $instance['modal_id'] === $shortcode ) {

                $id    = $instance['modal_id'];
                $title = $instance['button_title'];

                echo '<a href="#" class="button button-primary plugin-boilerplate-shortcode-button" data-modal-id="'. esc_attr( $id ) .'">'. esc_html( $title ) .'</a>';

              }

            }

          }

        }

      }

    }
  }
}
