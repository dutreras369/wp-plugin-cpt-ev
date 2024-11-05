<?php
class Metaboxes_EV
{

    public function init()
    {
        add_action('add_meta_boxes', array($this, 'add_metaboxes'));
        add_action('save_post', array($this, 'save_metaboxes'));
    }

    public function add_metaboxes()
    {
        // Metabox para Contactos
        add_meta_box(
            'contacto_details',
            __('Detalles de Contacto', 'textdomain'),
            array($this, 'render_metabox_contacto'),
            'contacto',
            'normal',
            'high'
        );

        add_meta_box(
            'cliente_details',
            __('Detalles del Cliente', 'textdomain'),
            array($this, 'render_cliente_metabox'),
            'cliente',
            'normal',
            'high'
        );
    }

    public function render_metabox_contacto($post)
    {
        // Recuperar valores actuales
        $contact_name = get_post_meta($post->ID, '_contact_name', true);
        $contact_email = get_post_meta($post->ID, '_contact_email', true);
        $contact_message = get_post_meta($post->ID, '_contact_message', true);

        // Agregar nonce para verificación
        wp_nonce_field(basename(__FILE__), 'contacto_nonce');

?>
        <div class="form-group">
            <label for="contact_name"><?php _e('Nombre:', 'textdomain'); ?></label>
            <input type="text" name="contact_name" id="contact_name" class="form-control" value="<?php echo esc_attr($contact_name); ?>" />
        </div>

        <div class="form-group">
            <label for="contact_email"><?php _e('Correo Electrónico:', 'textdomain'); ?></label>
            <input type="email" name="contact_email" id="contact_email" class="form-control" value="<?php echo esc_attr($contact_email); ?>" />
        </div>

        <div class="form-group">
            <label for="contact_message"><?php _e('Mensaje:', 'textdomain'); ?></label>
            <textarea name="contact_message" id="contact_message" class="form-control" rows="5"><?php echo esc_textarea($contact_message); ?></textarea>
        </div>
    <?php
    }

    public function render_cliente_metabox($post)
    {
        // Recuperar valores actuales
        $cliente_nombre = get_post_meta($post->ID, '_cliente_nombre', true);
        $cliente_email = get_post_meta($post->ID, '_cliente_email', true);
        $cliente_telefono = get_post_meta($post->ID, '_cliente_telefono', true);
        $cliente_rut = get_post_meta($post->ID, '_cliente_rut', true);
        $nombre_emprendimiento = get_post_meta($post->ID, '_nombre_emprendimiento', true);
        $tiene_empresa = get_post_meta($post->ID, '_tiene_empresa', true);
        $rut_empresa = get_post_meta($post->ID, '_rut_empresa', true);
        $dominio_deseado = get_post_meta($post->ID, '_dominio_deseado', true);
        $direccion = get_post_meta($post->ID, '_direccion', true);

        wp_nonce_field(basename(__FILE__), 'cliente_nonce');

    ?>
        <div class="form-group">
            <label for="cliente_nombre"><?php _e('Nombre del Cliente:', 'textdomain'); ?></label>
            <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control" value="<?php echo esc_attr($cliente_nombre); ?>" />
        </div>
        <div class="form-group">
            <label for="cliente_email"><?php _e('Correo Electrónico:', 'textdomain'); ?></label>
            <input type="email" name="cliente_email" id="cliente_email" class="form-control" value="<?php echo esc_attr($cliente_email); ?>" />
        </div>
        <div class="form-group">
            <label for="cliente_telefono"><?php _e('Teléfono:', 'textdomain'); ?></label>
            <input type="text" name="cliente_telefono" id="cliente_telefono" class="form-control" value="<?php echo esc_attr($cliente_telefono); ?>" />
        </div>
        <div class="form-group">
            <label for="cliente_rut"><?php _e('RUT:', 'textdomain'); ?></label>
            <input type="text" name="cliente_rut" id="cliente_rut" class="form-control" value="<?php echo esc_attr($cliente_rut); ?>" />
        </div>
        <div class="form-group">
            <label for="nombre_emprendimiento"><?php _e('Nombre del Emprendimiento:', 'textdomain'); ?></label>
            <input type="text" name="nombre_emprendimiento" id="nombre_emprendimiento" class="form-control" value="<?php echo esc_attr($nombre_emprendimiento); ?>" />
        </div>
        <div class="form-group form-check row">
            <input type="checkbox" name="tiene_empresa" id="tiene_empresa" class="form-check-input col-2" <?php checked($tiene_empresa, 'on'); ?> />
            <label for="tiene_empresa" class="form-check-label col"><?php _e('¿Tiene una empresa constituida?', 'textdomain'); ?></label>
        </div>
        <div class="form-group" id="rut_empresa_field">
            <label for="rut_empresa"><?php _e('RUT de la Empresa:', 'textdomain'); ?></label>
            <input type="text" name="rut_empresa" id="rut_empresa" class="form-control" value="<?php echo esc_attr($rut_empresa); ?>" />
        </div>
        <div class="form-group">
            <label for="dominio_deseado"><?php _e('Dominio Deseado:', 'textdomain'); ?></label>
            <input type="text" name="dominio_deseado" id="dominio_deseado" class="form-control" value="<?php echo esc_attr($dominio_deseado); ?>" />
        </div>
        <div class="form-group">
            <label for="direccion"><?php _e('Dirección:', 'textdomain'); ?></label>
            <textarea name="direccion" id="direccion" class="form-control"><?php echo esc_textarea($direccion); ?></textarea>
        </div>
    <?php
    }

    public function save_metabox($post_id)
    {
        // Verificar nonce para contacto y cliente
        if ((! isset($_POST['contacto_nonce']) || ! wp_verify_nonce($_POST['contacto_nonce'], basename(__FILE__))) &&
            (! isset($_POST['cliente_nonce']) || ! wp_verify_nonce($_POST['cliente_nonce'], basename(__FILE__)))
        ) {
            return $post_id;
        }

        // Verificar si es una autosave o si el usuario tiene permisos para editar el post
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if (! current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        // Guardar datos de Contacto si están presentes
        if (isset($_POST['contact_name'])) {
            update_post_meta($post_id, '_contact_name', sanitize_text_field($_POST['contact_name']));
        }

        if (isset($_POST['contact_email'])) {
            update_post_meta($post_id, '_contact_email', sanitize_email($_POST['contact_email']));
        }

        if (isset($_POST['contact_message'])) {
            update_post_meta($post_id, '_contact_message', sanitize_textarea_field($_POST['contact_message']));
        }

        // Guardar datos de Cliente si están presentes
        if (isset($_POST['cliente_nombre'])) {
            update_post_meta($post_id, '_cliente_nombre', sanitize_text_field($_POST['cliente_nombre']));
        }

        if (isset($_POST['cliente_email'])) {
            update_post_meta($post_id, '_cliente_email', sanitize_email($_POST['cliente_email']));
        }

        if (isset($_POST['cliente_telefono'])) {
            update_post_meta($post_id, '_cliente_telefono', sanitize_text_field($_POST['cliente_telefono']));
        }

        if (isset($_POST['cliente_rut'])) {
            update_post_meta($post_id, '_cliente_rut', sanitize_text_field($_POST['cliente_rut']));
        }

        if (isset($_POST['nombre_emprendimiento'])) {
            update_post_meta($post_id, '_nombre_emprendimiento', sanitize_text_field($_POST['nombre_emprendimiento']));
        }

        if (isset($_POST['tiene_empresa'])) {
            update_post_meta($post_id, '_tiene_empresa', 'on');
        } else {
            update_post_meta($post_id, '_tiene_empresa', 'off');
        }

        if (isset($_POST['rut_empresa'])) {
            update_post_meta($post_id, '_rut_empresa', sanitize_text_field($_POST['rut_empresa']));
        }

        if (isset($_POST['dominio_deseado'])) {
            update_post_meta($post_id, '_dominio_deseado', sanitize_text_field($_POST['dominio_deseado']));
        }

        if (isset($_POST['direccion'])) {
            update_post_meta($post_id, '_direccion', sanitize_textarea_field($_POST['direccion']));
        }
    }
}
