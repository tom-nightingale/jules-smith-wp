<?php

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

// 2065 is the bio page.
$context['bio_image'] = get_field('image', 2065);
$context['bio_intro'] = get_field('intro', 2065);

Timber::render( [ 'page-'.$timber_post->slug.'.twig', 'page.twig' ], $context );
