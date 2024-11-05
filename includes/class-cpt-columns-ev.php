<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CPT_Columns_EV {

    public function init() {
        add_filter( 'manage_contacto_posts_columns', array( $this, 'set_custom_edit_contacto_columns' ) );
        add_action( 'manage_contacto_posts_custom_column', array( $this, 'custom_contacto_column' ), 10, 2 );
    }

    public function set_custom_edit_contacto_columns( $columns ) {
        $columns['name'] = 'Nombre';
        $columns['email'] = 'Correo Electrónico';
        $columns['message'] = 'Mensaje';
        return $columns;
    }

    public function custom_contacto_column( $column, $post_id ) {
        switch ( $column ) {
            case 'name':
                $name = get_post_meta( $post_id, '_contact_name', true );
                echo esc_html( $name );
                break;

            case 'email':
                $email = get_post_meta( $post_id, '_contact_email', true );
                echo esc_html( $email );
                break;

            case 'message':
                $message = get_post_meta( $post_id, '_contact_message', true );
                echo esc_html( wp_trim_words( $message, 10 ) );
                break;
        }
    }
}
