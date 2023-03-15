<?php 

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

Timber::render( [ 'single.twig' ], $context );

if (is_single()) { ?>
<script type="text/javascript">
  const links = document.querySelectorAll('nav .blog');
  if(links.length > 0) {
    links.forEach((link) => {
      link.classList.add('current');
    });
  }
</script>
<?php }
