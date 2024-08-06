<?php
/**
 *
 * Field: repeater
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
use ThemeAtelier\PluginBoilerplate\Admin\Framework\Classes\PLUGIN_BOILERPLATE;

if ( ! class_exists( 'PLUGIN_BOILERPLATE_Field_repeater' ) ) {
  class PLUGIN_BOILERPLATE_Field_repeater extends PLUGIN_BOILERPLATE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'max'          => 0,
        'min'          => 0,
        'button_title' => '<i class="icofont-plus"></i>',
      ) );

      if ( preg_match( '/'. preg_quote( '['. $this->field['id'] .']' ) .'/', $this->unique ) ) {

        echo '<div class="plugin-boilerplate-notice plugin-boilerplate-notice-danger">'. esc_html__( 'Error: Field ID conflict.', 'plugin-boilerplate' ) .'</div>';

      } else {

        echo $this->field_before();

        echo '<div class="plugin-boilerplate-repeater-item plugin-boilerplate-repeater-hidden" data-depend-id="'. esc_attr( $this->field['id'] ) .'">';
        echo '<div class="plugin-boilerplate-repeater-content">';
        foreach ( $this->field['fields'] as $field ) {

          $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
          $field_unique  = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .'][0]' : $this->field['id'] .'[0]';

          PLUGIN_BOILERPLATE::field( $field, $field_default, '___'. $field_unique, 'field/repeater' );

        }
        echo '</div>';
        echo '<div class="plugin-boilerplate-repeater-helper">';
        echo '<div class="plugin-boilerplate-repeater-helper-inner">';
        echo '<i class="plugin-boilerplate-repeater-sort fas fa-arrows-alt"></i>';
        echo '<i class="plugin-boilerplate-repeater-clone far fa-clone"></i>';
        echo '<i class="plugin-boilerplate-repeater-remove plugin-boilerplate-confirm fas fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'plugin-boilerplate' ) .'"></i>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="plugin-boilerplate-repeater-wrapper plugin-boilerplate-data-wrapper" data-field-id="['. esc_attr( $this->field['id'] ) .']" data-max="'. esc_attr( $args['max'] ) .'" data-min="'. esc_attr( $args['min'] ) .'">';

        if ( ! empty( $this->value ) && is_array( $this->value ) ) {

          $num = 0;

          foreach ( $this->value as $key => $value ) {

            echo '<div class="plugin-boilerplate-repeater-item">';
            echo '<div class="plugin-boilerplate-repeater-content">';
            foreach ( $this->field['fields'] as $field ) {

              $field_unique = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .']['. $num .']' : $this->field['id'] .'['. $num .']';
              $field_value  = ( isset( $field['id'] ) && isset( $this->value[$key][$field['id']] ) ) ? $this->value[$key][$field['id']] : '';

              PLUGIN_BOILERPLATE::field( $field, $field_value, $field_unique, 'field/repeater' );

            }
            echo '</div>';
            echo '<div class="plugin-boilerplate-repeater-helper">';
            echo '<div class="plugin-boilerplate-repeater-helper-inner">';
            echo '<i class="plugin-boilerplate-repeater-sort fas fa-arrows-alt"></i>';
            echo '<i class="plugin-boilerplate-repeater-clone far fa-clone"></i>';
            echo '<i class="plugin-boilerplate-repeater-remove plugin-boilerplate-confirm fas fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'plugin-boilerplate' ) .'"></i>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $num++;

          }

        }

        echo '</div>';

        echo '<div class="plugin-boilerplate-repeater-alert plugin-boilerplate-repeater-max">'. esc_html__( 'You cannot add more.', 'plugin-boilerplate' ) .'</div>';
        echo '<div class="plugin-boilerplate-repeater-alert plugin-boilerplate-repeater-min">'. esc_html__( 'You cannot remove more.', 'plugin-boilerplate' ) .'</div>';
        echo '<a href="#" class="button button-primary plugin-boilerplate-repeater-add">'. $args['button_title'] .'</a>';

        echo $this->field_after();

      }

    }

    public function enqueue() {

      if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
      }

    }

  }
}
