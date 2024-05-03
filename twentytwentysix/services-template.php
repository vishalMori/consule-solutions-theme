<?php

/**
 * Template Name: Services Template
 *
 * @package WordPress
 */

get_header();

the_content();

$meta_args = array(
  array(
    'key' => 'featured',
    'value' => 'yes',
  ),
);

$tax_args = array(
  array(
    'taxonomy' => "service_cat",
    'field' => 'slug',
    'terms' => 'health',
  ),
);

$args = array(
  'post_type' => 'service',
  'orderby' => 'title',
  'meta_query' => $meta_args,
  'tax_query' => $tax_args,
  'order' => 'ASC',
  'post_per_page' => 10,
);

$services = new WP_Query($args);

if ($services->have_posts()) :
  echo '<ol class="list-group list-group-numbered">';
  while ($services->have_posts()) : $services->the_post();
    $title = $services->post->post_title;
    echo '<li class="list-group-item">' . $title . '</li>';
  endwhile;
  echo '</ol>';
endif;


get_footer();
