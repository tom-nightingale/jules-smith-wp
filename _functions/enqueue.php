<?php 
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('production', get_theme_file_uri() . '/dist/production-dist.js', ['jquery'], '', true);

        // Addon scripts that should only be loaded on certain pages...
        if(is_page(array('head-of-the-fable'))){
          wp_enqueue_script('hof', get_theme_file_uri() . '/dist/production-head-of-the-fable.js','', '', true);
        }

        // Localize the themeURL to our production file so we can use it to complete file paths
        wp_localize_script('production', 'themeURL', array(
          'themeURL' => get_stylesheet_directory_uri()
          )
		);
    });
