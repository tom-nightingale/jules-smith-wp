<?php

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();

$context['category'] = new Timber\Term();

Timber::render( [ 'category.twig' ], $context );

?>
<script type="text/javascript">
  const links = document.querySelectorAll('nav .blog');
  if(links.length > 0) {
    links.forEach((link) => {
      link.classList.add('current');
    });
  }
</script>
