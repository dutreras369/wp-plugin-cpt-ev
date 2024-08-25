<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CPT_EV {

    public function init() {
        add_action( 'init', array( $this, 'register_custom_post_types' ) );
    }

    public function register_custom_post_types() {
        // Registrar Custom Post Type: Proyecto
        $this->register_post_type(
            'proyecto',
            'Proyectos',
            'Proyecto',
            'dashicons-admin-site'
        );

        // Registrar Custom Post Type: Testimonios
        $this->register_post_type(
            'testimonials',
            'Testimonios',
            'Testimonio',
            'dashicons-testimonial'
        );

        // Registrar Custom Post Type: Equipo
        $this->register_post_type(
            'team',
            'Equipo',
            'Usuario',
            'dashicons-buddicons-buddypress-logo'
        );

        // Registrar Custom Post Type: Cliente
        $this->register_post_type(
            'cliente',
            'Clientes',
            'Cliente',
            'dashicons-businessman'
        );
    }

    private function register_post_type( $post_type, $plural_name, $singular_name, $icon ) {
        $labels = array(
            'name'                  => _x( $plural_name, 'Post Type General Name', 'custom' ),
            'singular_name'         => _x( $singular_name, 'Post Type Singular Name', 'custom' ),
            'menu_name'             => __( $plural_name, 'custom' ),
            'name_admin_bar'        => __( $singular_name, 'custom' ),
            'archives'              => __( 'Archivo', 'custom' ),
            'attributes'            => __( 'Atributos', 'custom' ),
            'parent_item_colon'     => __( $singular_name . ' Padre', 'custom' ),
            'all_items'             => __( 'Mostrar ' . $plural_name, 'custom' ),
            'add_new_item'          => __( 'Agregar ' . $singular_name, 'custom' ),
            'add_new'               => __( 'Agregar ' . $singular_name, 'custom' ),
            'new_item'              => __( 'Nuevo ' . $singular_name, 'custom' ),
            'edit_item'             => __( 'Editar ' . $singular_name, 'custom' ),
            'update_item'           => __( 'Actualizar ' . $singular_name, 'custom' ),
            'view_item'             => __( 'Ver ' . $singular_name, 'custom' ),
            'view_items'            => __( 'Ver ' . $singular_name, 'custom' ),
            'search_items'          => __( 'Buscar ' . $singular_name, 'custom' ),
            'not_found'             => __( 'No Encontrado', 'custom' ),
            'not_found_in_trash'    => __( 'No Encontrado en Papelera', 'custom' ),
            'featured_image'        => __( 'Imagen Destacada', 'custom' ),
            'set_featured_image'    => __( 'Guardar Imagen destacada', 'custom' ),
            'remove_featured_image' => __( 'Eliminar Imagen destacada', 'custom' ),
            'use_featured_image'    => __( 'Utilizar como Imagen Destacada', 'custom' ),
            'insert_into_item'      => __( 'Insertar en ' . $singular_name, 'custom' ),
            'uploaded_to_this_item' => __( 'Agregado en ' . $plural_name, 'custom' ),
            'items_list'            => __( 'Lista de ' . $plural_name, 'custom' ),
            'items_list_navigation' => __( 'Navegación de ' . $plural_name, 'custom' ),
            'filter_items_list'     => __( 'Filtrar ' . $singular_name, 'custom' ),
        );

        $args = array(
            'label'                 => __( $plural_name, 'custom' ),
            'description'           => __( $plural_name . ' para el Sitio Web', 'custom' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => $icon,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( $post_type, $args );
    }
}
