<?php

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();

$context['categories'] = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

$context['banner_image'] = get_field('banner_image', 5387);
$context['banner_content'] = get_field('banner_content', 5387);

Timber::render( [ 'index.twig' ], $context );

?>

<script type="text/javascript">
  document.querySelector('.current_page_parent').classList.add('current-menu-item');
</script>
