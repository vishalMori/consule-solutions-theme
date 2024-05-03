<?php

//Add css and js
function add_scripts()
{
  //CSS style list
  wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', '', '');
  wp_enqueue_style('bootstrap');

  wp_register_style('swiper-bundle.min', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', '', '');
  wp_enqueue_style('swiper-bundle.min');

  wp_register_style('header', get_stylesheet_directory_uri() . '/assets/css/header.css', '', '');
  wp_enqueue_style('header');

  wp_register_style('media', get_stylesheet_directory_uri() . '/assets/css/media.css', '', '');
  wp_enqueue_style('media');

  wp_register_style('style', get_stylesheet_directory_uri() . '/assets/css/style.css', '', '');
  wp_enqueue_style('style');

  //JS script list
  wp_register_script('jquery.min', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '', true);
  wp_enqueue_script('jquery.min');

  wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', '', '', true);
  wp_enqueue_script('bootstrap');

  wp_register_script('swiper-bundle', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '', true);
  wp_enqueue_script('swiper-bundle');

  wp_register_script('jquery-3.6.3.min', get_stylesheet_directory_uri() . '/assets/js/jquery-3.6.3.min.js', array('jquery'), '', true);
  wp_enqueue_script('jquery-3.6.3.min');

  wp_register_script('fileupload', get_stylesheet_directory_uri() . '/assets/js/fileupload.js', array('jquery'), '', true);
  wp_enqueue_script('fileupload');

  wp_register_script('setting', get_stylesheet_directory_uri() . '/assets/js/setting.js', array('jquery'), '', true);
  wp_enqueue_script('setting');
}

add_action('wp_enqueue_scripts', 'add_scripts');


//This function is for ajax demonstration
add_action("wp_enqueue_scripts", "add_custome_js");
function add_custome_js()
{
  wp_enqueue_script("show-all-post", get_stylesheet_directory_uri() . "/assets/js/show-all-post.js", array('jquery'));
  wp_localize_script(
    'show-all-post',
    'ajax_object',
    array(
      'ajaxurl' => admin_url('admin-ajax.php')
    )
  );
}

//Show few latest posts and show all post when click on show all button with wp_query and ajax
add_action('wp_ajax_show_all_post', 'show_all_post');
add_action('wp_ajax_nopriv_show_all_post', 'show_all_post');

function show_all_post()
{
  $posts = "";

  $args = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $posts .= get_template_part('template-part/image-formate');
    }
  }
  echo $posts;
  wp_reset_postdata();
  exit();
}

//Register custom taxonomy
add_action('init', 'custome_taxonomy');

function custome_taxonomy()
{
  register_taxonomy(
    'service_cat',
    'service',
    array(
      'label' => 'Service Category ',
      'rewrite' => array('slug' => 'service_cat'),
      'hierarchical' => true,
    )
  );
}

//Register custom service post type
add_action('init', 'custome_post_type');

function custome_post_type()
{
  $args =  array(
    'labels'        => array(
      'name'          => 'Service',
      'singular_name' => 'service',
    ),
    'supports'    => array('title', 'editor', 'thumbnail'),
    'menu_icon'   => 'dashicons-tag',
    'public'      => true,
    'has_archive' => true,
    'rewrite'     => array('slug' => 'service'),
    'taxonomies'  => array('service_category')
  );
  register_post_type(
    'Service',
    $args,
  );
}


//Custom REST API endpoint
add_action('rest_api_init', 'custom_rest_api_endpoint');

function custom_rest_api_endpoint()
{
  register_rest_route('api/v1', '/post_info', array(
    'method' => 'GET',
    'callback' => 'custom_api_point_callback',
  ));
}

//Custom REST API endpoint callback function
function custom_api_point_callback()
{
  $responce = array();
  $request_args = array(
    'post_type' => 'service',
    'posts_per_page' => 3,
    'orderby' => 'title',
  );

  $req = new WP_Query($request_args);
  if ($req->have_posts()) {
    while ($req->have_posts()) {
      $req->the_post();
      $responce[] = array(
        'title' => $req->post->post_title,
      );
    }
  }

  wp_reset_postdata();
  wp_send_json($responce);
}

//Register custome widget area
add_action('widgets_init', 'register_widget_area');

function register_widget_area()
{
  register_sidebar(array(
    'name' => 'Custom Widget',
    'id' => 'custom-widget',
  ));
}
