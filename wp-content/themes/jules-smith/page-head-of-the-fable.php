<?php

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$terms = get_terms( array(
    'taxonomy' => 'book-categories',
    'hide_empty' => false,
) );

$context['book_categories'] = $terms;

$args = [
    'post_type' => 'books',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
];

$context['books'] = new Timber\PostQuery($args);

Timber::render( [ 'page-'.$timber_post->slug.'.twig', 'page.twig' ], $context );
