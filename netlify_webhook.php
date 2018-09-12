<?php
  /*
    Plugin Name: Netlify webhook plugin
    description: Setting up Netlify webhook
    Author: Ivor Grisel
    Version: 1.0.1
  */
  class netlify_webhook_plugin {
    public function __construct() {
      // Hook into the admin menu
      add_action('admin_menu', array($this, 'create_plugin_settings_page'));

      add_action( 'admin_init', array( $this, 'setup_sections' ) );
      add_action( 'admin_init', array( $this, 'setup_fields' ) );

      add_action('publish_page', array( $this , 'start_build'));
      add_action('publish_post', array( $this , 'start_build'));
      add_action('deleted_post', array( $this , 'start_build'));
      add_action('trashed_post', array( $this , 'start_build'));
      add_action('untrashed_post', array( $this , 'start_build'));
      add_action('edit_post', array( $this , 'start_build'));
    }

    public function create_plugin_settings_page() {
      // Add the menu item and page
      $page_title = 'Netlify webhook settings page';
      $menu_title = 'Netlify webhook';
      $capability = 'manage_options';
      $slug = 'netlify_webhook';
      $callback = array( $this, 'plugin_settings_page_content' );
      $icon = 'dashicons-admin-plugins';
      $position = 100;

      add_submenu_page(
        'options-general.php',
        $page_title,
        $menu_title,
        $capability,
        $slug,
        $callback,
        $position );
    }

    public function plugin_settings_page_content() { ?>
      <div class="wrap">
          <h2>Netlify webhook page</h2>
          <form method="post" action="options.php">
              <?php
                  settings_fields( 'netlify_webhook_fields' );
                  do_settings_sections( 'netlify_webhook_fields' );
                  submit_button();
              ?>
          </form>
      </div> <?php
    }

    public function setup_sections() {
      add_settings_section(
        'main_section',
        'Netlify webhook location',
        array( $this, 'section_callback' ),
        'netlify_webhook_fields' );
    }

    public function section_callback( $arguments ) {
      switch( $arguments['id'] ){
        case 'main_section':
          echo 'Fill in the Netlify webhook below. Be sure to first get a webhook by <a href="https://www.netlify.com/docs/webhooks/">following the tutorial on the Netlify website</a>.';
          break;
      }
    }

    public function setup_fields() {
      $fields = array(
        array(
            'uid' => 'netlify_webhook_url',
            'label' => 'Netlify webhook URL',
            'section' => 'main_section',
            'type' => 'text',
            'options' => false,
            'placeholder' => 'https://api.netlify.com/build_hooks/379sdfl2356d3d9d9254',
            'helper' => '',
            'supplemental' => '',
            'default' => ''
        )
      );
      foreach( $fields as $field ){
        add_settings_field(
          $field['uid'],
          $field['label'],
          array( $this, 'field_callback' ),
          'netlify_webhook_fields',
          $field['section'],
          $field
        );
        register_setting( 'netlify_webhook_fields', $field['uid'] );
      }
    }

    public function field_callback( $arguments ) {
      $value = get_option( $arguments['uid'] );
      if( ! $value ) { // If no value exists
        $value = $arguments['default']; // Set to our default
      }
      // Check which type of field we want
      switch( $arguments['type'] ){
        case 'text': // If it is a text field
          printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
          break;
      }

      // If there is help text
      if( $helper = $arguments['helper'] ){
        printf( '<span class="helper"> %s</span>', $helper );
      }

      // If there is supplemental text
      if( $supplimental = $arguments['supplemental'] ){
          printf( '<p class="description">%s</p>', $supplimental );
      }
    }

    public function start_build() {
      $url = get_option('netlify_webhook_url');
      // Only perform action when webhook url is set
      if( $url ) {
        // We don't need to send anything in the body, so this is empty
        $body = array();
        $args = array(
          'body' => $body,
          'timeout' => '5',
          'redirection' => '5',
          'httpversion' => '1.0',
          'blocking' => true,
          'headers' => array(),
          'cookies' => array()
        );
        $response = wp_remote_post( $url, $args );
      }
    }
  }

  new netlify_webhook_plugin();


?>