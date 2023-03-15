<?php 
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('production', get_theme_file_uri() . '/dist/production-dist.js', ['jquery'], '', true);

        // Addon scripts that should only be loaded on certain pages...
        if(is_page(array('head-of-the-fable'))){
          wp_enqueue_script('hof', get_theme_file_uri() . '/dist/production-head-of-the-fable.js','', '', true);
        }

        if(is_single()){
          wp_enqueue_script('comment-replies', get_theme_file_uri() . '/dist/production-comment-reply-form.js','', '', true);
        }

        if(is_page(array('testimonials', 'make-a-monstory'))){
          wp_enqueue_script('review-cards', get_theme_file_uri() . '/dist/production-review-cards.js','', '', true);
        }

        // Localize the themeURL to our production file so we can use it to complete file paths
        wp_localize_script('production', 'themeURL', array(
          'themeURL' => get_stylesheet_directory_uri()
          )
		);
    });

//Include the comment reply Javascript
add_action('wp_print_scripts', function(){
  if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
});

/* function to return first image in post */
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "/_resources/images/logo.svg";
  }
  return $first_img;
}
