<?php

$context = Timber::context();
$context['post'] = new Timber\Post();

// 2065 is the bio page.
$context['bio_image'] = get_field('image', 2065);
$context['bio_intro'] = get_field('intro', 2065);

Timber::render( [ 'front-page.twig' ], $context );
