<?php 
add_action( 'init', 'register_navigations' );
function register_navigations() {
     register_nav_menus([
        'primary' => __('Main Menu', 'league'),
    ]);
}
?>
