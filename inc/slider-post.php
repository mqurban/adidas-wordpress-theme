<?php

// Register Custom Post Type for Slider
function custom_slider_post_type()
{
    $labels = array(
        'name'                  => ('Slides'),
        'singular_name'         => ('Slide'),
        'menu_name'             => ('Slides'),
        'all_items'             => ('All Slides'),
        'add_new_item'          => ('Add New Slide'),
        'add_new'               => ('Add New'),
        'new_item'              => ('New Slide'),
        'edit_item'             => ('Edit Slide'),
        'update_item'           => ('Update Slide'),
        'view_item'             => ('View Slide'),
        'view_items'            => ('View Slide'),
    );
    $args = array(
        'label'                 => ('Slide'),
        'description'           => ('Post type for slider'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'public'                => true,
    );
    register_post_type('slider', $args);
}
add_action('init', 'custom_slider_post_type', 0);
