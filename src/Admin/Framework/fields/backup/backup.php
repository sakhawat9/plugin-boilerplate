<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'PLUGIN_BOILERPLATE_Field_backup' ) ) {
  class PLUGIN_BOILERPLATE_Field_backup extends PLUGIN_BOILERPLATE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'PLUGIN_BOILERPLATE_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'plugin-boilerplate-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="PLUGIN_BOILERPLATE_import_data" class="plugin-boilerplate-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary plugin-boilerplate-confirm plugin-boilerplate-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'plugin-boilerplate' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="plugin-boilerplate-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary plugin-boilerplate-export" target="_blank">'. esc_html__( 'Export & Download', 'plugin-boilerplate' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="PLUGIN_BOILERPLATE_transient[reset]" value="reset" class="button plugin-boilerplate-warning-primary plugin-boilerplate-confirm plugin-boilerplate-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'plugin-boilerplate' ) .'</button>';

      echo $this->field_after();

    }

  }
}
