<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Metaboxes_EV {

    public function init() {
        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );
        add_action( 'save_post', array( $this, 'save_metaboxes' ) );
    }

    public function add_metaboxes() {
        add_meta_box(
            'proyecto_details',
            __( 'Detalles del Proyecto', 'textdomain' ),
            array( $this, 'render_metabox' ),
            'proyecto',
            'normal',
            'high'
        );
    }

    public function render_metabox( $post ) {
        // Recuperar valores actuales
        $custom_field_value = get_post_meta( $post->ID, '_custom_field_key', true );

        // Agregar nonce para verificación
        wp_nonce_field( basename( __FILE__ ), 'proyecto_nonce' );

        ?>
        <p>
            <label for="custom_field"><?php _e( 'Campo Personalizado:', 'textdomain' ); ?></label>
            <input type="text" name="custom_field" id="custom_field" value="<?php echo esc_attr( $custom_field_value ); ?>" size="30" />
        </p>
        <?php
    }

    public function save_metaboxes( $post_id ) {
        // Verificar nonce
        if ( ! isset( $_POST['proyecto_nonce'] ) || ! wp_verify_nonce( $_POST['proyecto_nonce'], basename( __FILE__ ) ) ) {
            return $post_id;
        }

        // Verificar si el usuario tiene permisos para editar el post
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        // Guardar datos
        $new_value = ( isset( $_POST['custom_field'] ) ? sanitize_text_field( $_POST['custom_field'] ) : '' );
        update_post_meta( $post_id, '_custom_field_key', $new_value );
    }
}
