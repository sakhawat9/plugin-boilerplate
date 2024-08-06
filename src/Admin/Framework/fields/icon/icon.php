<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'PLUGIN_BOILERPLATE_Field_icon' ) ) {
  class PLUGIN_BOILERPLATE_Field_icon extends PLUGIN_BOILERPLATE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'plugin-boilerplate' ),
        'remove_title' => esc_html__( 'Remove Icon', 'plugin-boilerplate' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'PLUGIN_BOILERPLATE_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="plugin-boilerplate-icon-select">';
      echo '<span class="plugin-boilerplate-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary plugin-boilerplate-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button plugin-boilerplate-warning-primary plugin-boilerplate-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="plugin-boilerplate-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'PLUGIN_BOILERPLATE_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'PLUGIN_BOILERPLATE_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="plugin-boilerplate-modal-icon" class="plugin-boilerplate-modal plugin-boilerplate-modal-icon hidden">
        <div class="plugin-boilerplate-modal-table">
          <div class="plugin-boilerplate-modal-table-cell">
            <div class="plugin-boilerplate-modal-overlay"></div>
            <div class="plugin-boilerplate-modal-inner">
              <div class="plugin-boilerplate-modal-title">
                <?php esc_html_e( 'Add Icon', 'plugin-boilerplate' ); ?>
                <div class="plugin-boilerplate-modal-close plugin-boilerplate-icon-close"></div>
              </div>
              <div class="plugin-boilerplate-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'plugin-boilerplate' ); ?>" class="plugin-boilerplate-icon-search" />
              </div>
              <div class="plugin-boilerplate-modal-content">
                <div class="plugin-boilerplate-modal-loading"><div class="plugin-boilerplate-loading"></div></div>
                <div class="plugin-boilerplate-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
