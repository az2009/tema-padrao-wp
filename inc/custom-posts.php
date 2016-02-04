<?php
/**
*Custom Post Type Exemplo"
*/
// add_action( 'init', 'create_post_type_exemplo' );
// function create_post_type_exemplo() {
//     register_post_type( 'exemplo',
//         array(
//             'labels' => array(
//                 'name' => __( 'Post Type Exemplos' ),
//                 'singular_name' => __( 'post' ),
//                 'all_items' => __('Todas os post'),
//                 'add_new' => __('Novo post'),
//                 'add_new_item' => __('Adicionar evento'),
//             ),
//             'taxonomies'         => array('categoria-exemplo'), /*GET TAXONOMY - COMENTAR ESSA LINHA SE NÃO UTILIZAR TAXONOMIA*/
//             'public'             => true,
//             'publicly_queryable' => true,
//             'show_ui'            => true,
//             'show_in_menu'       => true,
//             'query_var'          => true,
//             'rewrite'            => array( 'slug' => 'exemplo' ),
//             'capability_type'    => 'post',
//             'has_archive'        => true,
//             'hierarchical'       => true,
//             'menu_position'      => 5,
//             'menu_icon'   => 'dashicons-hammer',
//             /* TROCAR ÍCONE https://developer.wordpress.org/resource/dashicons/ */
//             'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt')
//             /* array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields', ) */
//         )
//     );
// }


?>