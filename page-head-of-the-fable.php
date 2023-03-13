<?php

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$terms = get_terms( array(
    'taxonomy' => 'book-categories',
    'hide_empty' => false,
) );

$context['book_categories'] = $terms;

Timber::render( [ 'page-'.$timber_post->slug.'.twig', 'page.twig' ], $context );
