<?php

namespace PGMB;

use  PGMB\Configuration ;
use  PGMB\DependencyInjection\Container ;
use  PGMB\EventManagement\EventManager ;
use  WP_Site ;
class Plugin
{
    const  DOMAIN = 'post-to-google-my-business' ;
    const  VERSION = '3.1.10' ;
    const  DASHICON = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIEZpcmV3b3JrcyAxMCwgRXhwb3J0IFNWRyBFeHRlbnNpb24gYnkgQWFyb24gQmVhbGwgKGh0dHA6Ly9maXJld29ya3MuYWJlYWxsLmNvbSkgLiBWZXJzaW9uOiAwLjYuMSAgLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyBpZD0iZGFzaGljb24uZnctUGFnZSUyMDEiIHZpZXdCb3g9IjAgMCAyMDcgMjA3IiBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjojZmZmZmZmMDAiIHZlcnNpb249IjEuMSINCgl4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4bWw6c3BhY2U9InByZXNlcnZlIg0KCXg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjA3cHgiIGhlaWdodD0iMjA3cHgiDQo+DQoJPGcgaWQ9IkxheWVyJTIwMSI+DQoJCTxwYXRoIGQ9Ik0gMTQ5Ljk5OTEgMTEyIEMgMTcwLjEyMzYgMTEyIDE4Ni40OTk0IDEyOC4zNzM0IDE4Ni41IDE0OC40OTkxIEMgMTg2LjUgMTY4LjYyNzIgMTcwLjEyMzYgMTg1IDE0OS45OTkxIDE4NSBDIDEyOS44NzQgMTg1IDExMy41IDE2OC42MjcyIDExMy41IDE0OC40OTkxIEMgMTEzLjUgMTI4LjM3MzQgMTI5Ljg3NCAxMTIgMTQ5Ljk5OTEgMTEyIFpNIDE1Ny4yMzUgOTMuMjkgQyAxNTEuOTAyMyAxMDIuNzQ5NiAxNDEuNTYgMTA4Ljg0MyAxMzAuNSAxMDguODQzIEMgMTIxLjMzMDQgMTA4Ljg0MyAxMDkuNjM5MSAxMDQuNDI5MyAxMDMuNTIgOTMuMDk1IEMgOTcuNjYxMSAxMDMuNzAyIDg3LjI2NzcgMTA4Ljg0MyA3Ni44NzUgMTA4Ljg0MyBDIDY1LjU5ODQgMTA4Ljg0MyA1NS42ODIgMTAyLjQ5NjYgNTAuNDA1IDkzLjMxNSBDIDQ0LjM5OTQgMTA0LjExMDkgMzMuNDA1NyAxMDguNzg5IDIzLjYyNSAxMDguNzg5IEMgMTkuNTUxIDEwOC43ODkgMTUuNDQwOSAxMDguMTA1NyAxMS41NCAxMDYuNTEgTCAxMS41NDIgMTgwLjYyMjEgQyAxMS41NDIgMTg4LjA2MjUgMTcuNjI5OSAxOTQuMTUwNCAyNS4wNzAzIDE5NC4xNTA0IEwgMTgyLjYwNDUgMTk0LjE1MDQgQyAxOTAuMDQ1NCAxOTQuMTUwNCAxOTYuMTMyOCAxODguMDYyNSAxOTYuMTMyOCAxODAuNjIyMSBMIDE5Ni4xMzUgMTA2LjIyIEMgMTkyLjI5MjQgMTA3LjkzMzcgMTg4LjA4MzMgMTA4Ljg3NSAxODMuNzUgMTA4Ljg3NSBDIDE3NC40OTk3IDEwOC44NzUgMTYzLjgyMzMgMTA0LjU5OCAxNTcuMjM1IDkzLjI5IFpNIDE0OS45OTkxIDE4My4zMjY5IEMgMTY5LjIwMDcgMTgzLjMyNjkgMTg0LjgyMjkgMTY3LjcwMzEgMTg0LjgyMjkgMTQ4LjQ5OTEgQyAxODQuODIyOSAxMjkuMjk2MyAxNjkuMjAwNyAxMTMuNjczNiAxNDkuOTk5MSAxMTMuNjczNiBDIDEzMC43OTYzIDExMy42NzM2IDExNS4xNzM2IDEyOS4yOTYzIDExNS4xNzM2IDE0OC40OTkxIEMgMTE1LjE3MzYgMTY3LjcwMzEgMTMwLjc5NjkgMTgzLjMyNjkgMTQ5Ljk5OTEgMTgzLjMyNjkgWk0gMTc3LjQ3MzIgMTMzLjQ3NjQgQyAxNzkuOTE4OSAxMzcuOTM2NiAxODEuMzA5NSAxNDMuMDU1OCAxODEuMzA4OSAxNDguNDk5NyBDIDE4MS4zMDg5IDE2MC4wNTEyIDE3NS4wNDc4IDE3MC4xMzY0IDE2NS43MzkyIDE3NS41NjQ4IEwgMTc1LjMwMzQgMTQ3LjkxMTYgQyAxNzcuMDkwNyAxNDMuNDQ1NSAxNzcuNjg0MSAxMzkuODczNiAxNzcuNjg0MSAxMzYuNjk2MiBDIDE3Ny42ODQxIDEzNS41NDQ1IDE3Ny42MDc5IDEzNC40NzM4IDE3Ny40NzMyIDEzMy40NzY0IFpNIDE1MC41NDg1IDE1MS4yMzggTCAxNjAuMTc0IDE3Ny42MDY2IEMgMTYwLjIzNjUgMTc3Ljc2MTYgMTYwLjMxMjcgMTc3LjkwMzkgMTYwLjM5NjggMTc4LjAzOCBDIDE1Ny4xNDIgMTc5LjE4MjUgMTUzLjY0NTMgMTc5LjgxMyAxNDkuOTk5MSAxNzkuODEzIEMgMTQ2LjkyNTQgMTc5LjgxMyAxNDMuOTU5IDE3OS4zNjE4IDE0MS4xNTQxIDE3OC41MzczIEwgMTUwLjU0ODUgMTUxLjIzOCBaTSAxNzEuMTM2NSAxNDYuOTE5IEMgMTcxLjEzNjUgMTQ5LjU5OTUgMTcwLjEwNjMgMTUyLjcxMDMgMTY4Ljc1MjcgMTU3LjA0MTIgTCAxNjUuNjI5NiAxNjcuNDc3OSBMIDE1NC4zMTQ0IDEzMy44MTg1IEMgMTU2LjE5ODIgMTMzLjcxOTUgMTU3Ljg5ODEgMTMzLjUxOTkgMTU3Ljg5ODEgMTMzLjUxOTkgQyAxNTkuNTg0NyAxMzMuMzIwMyAxNTkuMzg2NCAxMzAuODQxMiAxNTcuNjk3MyAxMzAuOTQwNyBDIDE1Ny42OTczIDEzMC45NDA3IDE1Mi42MjcxIDEzMS4zMzgxIDE0OS4zNTI3IDEzMS4zMzgxIEMgMTQ2LjI3NiAxMzEuMzM4MSAxNDEuMTA1MiAxMzAuOTQwNyAxNDEuMTA1MiAxMzAuOTQwNyBDIDEzOS40MTc5IDEzMC44NDEyIDEzOS4yMjAxIDEzMy40MjEgMTQwLjkwNzQgMTMzLjUxOTkgQyAxNDAuOTA3NCAxMzMuNTE5OSAxNDIuNTA0NyAxMzMuNzE5NSAxNDQuMTkwOCAxMzMuODE4NSBMIDE0OS4wNjkxIDE0Ny4xODQ4IEwgMTQyLjIxNjkgMTY3LjczNiBMIDEzMC44MTQ4IDEzMy44MTk2IEMgMTMyLjcwMjIgMTMzLjcyMDcgMTM0LjM5ODQgMTMzLjUyMTEgMTM0LjM5ODQgMTMzLjUyMTEgQyAxMzYuMDg0NSAxMzMuMzIxNiAxMzUuODg1NSAxMzAuODQyNCAxMzQuMTk3NiAxMzAuOTQxOSBDIDEzNC4xOTc2IDEzMC45NDE5IDEyOS4xMjgxIDEzMS4zMzkzIDEyNS44NTMgMTMxLjMzOTMgQyAxMjUuMjY1IDEzMS4zMzkzIDEyNC41NzI3IDEzMS4zMjM4IDEyMy44MzgxIDEzMS4zMDE4IEMgMTI5LjQzNjcgMTIyLjgwMDggMTM5LjA2MDQgMTE3LjE4ODMgMTQ5Ljk5OTEgMTE3LjE4ODMgQyAxNTguMTUwNiAxMTcuMTg4MyAxNjUuNTcyNCAxMjAuMzA0NCAxNzEuMTQyOSAxMjUuNDA4IEMgMTcxLjAwNzggMTI1LjQwMDMgMTcwLjg3NjEgMTI1LjM4MyAxNzAuNzM3MiAxMjUuMzgzIEMgMTY3LjY2MjQgMTI1LjM4MyAxNjUuNDc5NCAxMjguMDYyNCAxNjUuNDc5NCAxMzAuOTQwNyBDIDE2NS40Nzk0IDEzMy41MTk5IDE2Ni45NjcxIDEzNS43MDQyIDE2OC41NTQzIDEzOC4yODM0IEMgMTY5Ljc0NjUgMTQwLjM2OTMgMTcxLjEzNjUgMTQzLjA0OTMgMTcxLjEzNjUgMTQ2LjkxOSBaTSAxMTguNjg4MSAxNDguNDk5MSBDIDExOC42ODgxIDE0My45NTk2IDExOS42NjE2IDEzOS42NTAyIDEyMS4zOTg5IDEzNS43NTYgTCAxMzYuMzM0NyAxNzYuNjc5NiBDIDEyNS44OTA2IDE3MS42MDM5IDExOC42ODgxIDE2MC44OTMxIDExOC42ODgxIDE0OC40OTkxIFpNIDE2MS4zNzUgNzcuMDU1IEMgMTYxLjcyMDIgODAuMDc4NCAxNjEuNjQxMSA4My40NTQzIDE2MyA4Ni42MjUgQyAxNjcuNSA5Ni44NzUgMTc2IDEwMC42MjUgMTgzLjc1IDEwMC42MjUgQyAxODguMDkzNCAxMDAuNjI1IDE5Mi40MzkgOTkuMzE5NSAxOTYuMTM1IDk2Ljk3IEMgMjAyLjAxMjEgOTMuMjMzOSAyMDYuMjUgODYuODU2IDIwNi4yNSA3OC44NzUgQyAyMDYuMjUgNzUuMTI1IDE5My43NSAzMC42MjUgMTkyLjUgMjQuMTI1IEMgMTkxLjc1IDIwLjEyNSAxODkuMjUgMTMuMzc1IDE4My41IDEzLjM3NSBMIDE1My4yNSAxMy4zNzUgTCAxNTMuMjUgMTQuODc1IEMgMTUzLjI1IDE1LjM3NSAxNTYuNzUgNDAuNjI1IDE1OC4yNSA1My4zNzUgQyAxNTkuMjUgNjAuNjI1IDE2MC41IDY4LjM3NSAxNjEuMjUgNzYuMTI1IEMgMTYxLjI5NjkgNzYuNDMgMTYxLjMzOTIgNzYuNzQxOCAxNjEuMzc1IDc3LjA1NSBaTSAxMDggNzcuMDU1IEwgMTA4IDc5LjM0MyBDIDEwOCA3OS44NDMgMTA4LjI1IDgyLjg0MyAxMDguNzUgODQuMzQzIEMgMTEyLjI1IDk2LjA5MyAxMjIgMTAwLjU5MyAxMzAuNSAxMDAuNTkzIEMgMTQxLjI1IDEwMC41OTMgMTUyLjI1IDkyLjU5MyAxNTMgNzguNTkzIEwgMTUyLjggNzcuMDU1IEwgMTQ0LjUgMTMuMzQzIEwgMTA4IDEzLjM0MyBMIDEwOCA3Ny4wNTUgWk0gNTQuNjI1IDc3LjA1NSBMIDU0LjYyNSA4MC4zNDMgQyA1NC42MjUgODAuODQzIDU1LjM3NSA4NC44NDMgNTYuMTI1IDg2Ljg0MyBDIDYwLjg3NSA5Ny4wOTMgNjkuMzc1IDEwMC41OTMgNzcuMTI1IDEwMC41OTMgQyA4Ni42MjUgMTAwLjU5MyA5Ni44NzUgOTQuMzQzIDk5LjM3NSA4MS4wOTMgTCA5OS4zNzUgNzcuMDU1IEwgOTkuMzc1IDEzLjM0MyBMIDYyLjg3NSAxMy4zNDMgTCA1NC42MjUgNzYuMzQzIEwgNTQuNjI1IDc3LjA1NSBaTSAxMS41NCA5Ny4wNSBDIDE1LjEzMzggOTkuMjcwOSAxOS4zMzAzIDEwMC41MzkgMjMuNjI1IDEwMC41MzkgQyAzMy42MjUgMTAwLjUzOSA0NC4zNzUgOTQuMDM5IDQ2LjM3NSA3OS43ODkgTCA0Ni4zNzUgNzguMzQzIEwgNDYuMzc1IDc3LjA1NSBMIDQ2LjM3NSA3NS4wMzkgTCA1NC4zNzUgMTMuMjg5IEwgMjMuODc1IDEzLjI4OSBDIDIyLjEyNSAxMy4yODkgMTkuMTI1IDE0LjUzOSAxNy42MjUgMTYuNzg5IEMgMTYuODc1IDE3LjUzOSAxNi4zNzUgMTguNTM5IDE2LjEyNSAxOS41MzkgQyAxMy42MjUgMjguMjg5IDExLjM3NSAzNy41MzkgOS4xMjUgNDYuNTM5IEMgOC4zNzUgNDguNzg5IDcuNjI1IDUxLjc4OSA3LjEyNSA1NC4yODkgQyA2LjEyNSA1OC4yODkgNS4xMjUgNjIuNzg5IDMuODc1IDY2Ljc4OSBDIDIuODc1IDcwLjc4OSAwLjg3NSA3Ny43ODkgMC44NzUgNzguNTM5IEMgMC44NzUgODYuNDY5MiA1LjMwMjYgOTMuMTk0NCAxMS41NCA5Ny4wNSBaIiBmaWxsPSIjOWVhM2E4Ii8+DQoJPC9nPg0KPC9zdmc+' ;
    protected  $container ;
    private  $loaded ;
    public function __construct( $file, \Freemius $freemius )
    {
        $this->container = new Container( [
            'plugin_basename'      => plugin_basename( $file ),
            'plugin_domain'        => self::DOMAIN,
            'plugin_path'          => plugin_dir_path( $file ),
            'plugin_relative_path' => basename( plugin_dir_path( $file ) ),
            'plugin_url'           => plugin_dir_url( $file ),
            'plugin_version'       => self::VERSION,
            'plugin_dashicon'      => self::DASHICON,
            'freemius'             => $freemius,
        ] );
        $this->loaded = false;
    }
    
    public function is_loaded()
    {
        return $this->loaded;
    }
    
    public function init()
    {
        if ( $this->is_loaded() ) {
            return;
        }
        $this->container->configure( [
            Configuration\SettingsConfiguration::class,
            Configuration\ProxyAPIConfiguration::class,
            Configuration\EventManagementConfiguration::class,
            Configuration\NotificationManagerConfiguration::class,
            Configuration\AdminConfiguration::class,
            Configuration\BackgroundProcessConfiguration::class,
            Configuration\PostTypeConfiguration::class,
            Configuration\MetaboxConfiguration::class,
            Configuration\ComponentConfiguration::class
        ] );
        foreach ( $this->container['subscribers'] as $subscriber ) {
            $this->container['event_manager']->add_subscriber( $subscriber );
        }
        $this->load_textdomain();
        mbp_fs()->add_filter( 'plugin_icon', [ $this, 'fs_custom_icon' ] );
        $this->register_image_sizes();
        add_action( 'admin_init', [ $this, 'admin_init' ] );
        $this->loaded = true;
    }
    
    public static function activate( $network_active )
    {
        
        if ( $network_active ) {
            $site_ids = get_sites( [
                'fields'     => 'ids',
                'network_id' => get_current_network_id(),
            ] );
            foreach ( $site_ids as $site_id ) {
                switch_to_blog( $site_id );
                self::activate_single_site();
                restore_current_blog();
            }
            return;
        }
        
        self::activate_single_site();
    }
    
    public static function activate_single_site( $upgrade = false )
    {
        if ( !$upgrade ) {
            $created = add_option( 'pgmb_activated', 1 );
        }
        self::configure_roles_caps();
    }
    
    public static function deactivate( $network_active )
    {
        
        if ( $network_active ) {
            $site_ids = get_sites( [
                'fields'     => 'ids',
                'network_id' => get_current_network_id(),
            ] );
            foreach ( $site_ids as $site_id ) {
                switch_to_blog( $site_id );
                self::deactivate_single_site();
                restore_current_blog();
            }
            return;
        }
        
        self::deactivate_single_site();
    }
    
    public static function deactivate_single_site()
    {
        global  $wpdb ;
        $wpdb->query( "\n\t\t\tDELETE FROM {$wpdb->options} \n\t\t\tWHERE option_name LIKE '_transient_timeout_mbp_%' \n\t\t\tOR option_name LIKE '_transient_mbp_%'\n\t\t\tOR option_name LIKE '_transient_pgmb_%'\n\t\t\tOR option_name LIKE '_transient_timeout_pgmb_%'\n\t\t" );
        if ( function_exists( 'wp_unschedule_hook' ) ) {
            wp_unschedule_hook( 'pgmb_do_evergreen_post' );
        }
    }
    
    public static function uninstall()
    {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            return;
        }
        self::uninstall_single_site();
    }
    
    public static function uninstall_single_site()
    {
        $settings = get_option( 'mbp_misc' );
        if ( !isset( $settings['uninstall_cleanup'] ) || !is_array( $settings['uninstall_cleanup'] ) ) {
            return;
        }
        
        if ( in_array( 'delete_settings', $settings['uninstall_cleanup'] ) ) {
            global  $wpdb ;
            $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'mbp_%' OR option_name LIKE 'pgmb_%'" );
        }
        
        
        if ( in_array( 'delete_posttypes', $settings['uninstall_cleanup'] ) ) {
            $posts = get_posts( [
                'post_type'      => [ 'mbp_post_entity', 'mbp-google-subposts', 'mbp-google-posts' ],
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ] );
            foreach ( $posts as $id ) {
                wp_delete_post( $id, true );
            }
        }
    
    }
    
    public static function insert_site( $blog_id_or_site )
    {
        
        if ( $blog_id_or_site instanceof WP_Site ) {
            $site_id = $blog_id_or_site->id;
        } elseif ( is_int( $blog_id_or_site ) ) {
            $site_id = $blog_id_or_site;
        } else {
            return;
        }
        
        switch_to_blog( $site_id );
        self::activate_single_site();
        restore_current_blog();
    }
    
    public function admin_init()
    {
        $this->load_admin_styles();
    }
    
    public function load_admin_styles()
    {
        wp_enqueue_style(
            'mbp_admin_styles',
            $this->container['plugin_url'] . '/css/style.css',
            array( 'dashicons' ),
            $this->container['plugin_version']
        );
    }
    
    public function load_textdomain()
    {
        $dir = $this->container['plugin_relative_path'] . '/languages/';
        load_plugin_textdomain( 'post-to-google-my-business', false, $dir );
    }
    
    public function fs_custom_icon()
    {
        return dirname( __FILE__ ) . '/../img/plugin-icon.png';
    }
    
    public static function configure_roles_caps()
    {
        //if(get_option('pgmb_roles_configured')){ return; }
        $administrator_role = get_role( 'administrator' );
        
        if ( $administrator_role instanceof \WP_Role ) {
            $administrator_role->add_cap( 'pgmb_manage_google_accounts' );
            $administrator_role->add_cap( 'pgmb_see_others_accounts' );
        }
        
        //update_option('pgmb_roles_configured', true);
        /*
         * additional roles to be considered + permission management screen
         *
         * delete_pgmb_posts
         * publish_pgmb_posts
         * edit_pgmb_posts
         * edit_others_pgmb_posts
         * edit_published_pgmb_posts
         * delete_published_pgmb_posts
         */
    }
    
    public static function premium_version_activation()
    {
    }
    
    public static function free_version_reactivation()
    {
        remove_role( 'pgmb_agency_client' );
    }
    
    public function register_image_sizes()
    {
        add_image_size( 'pgmb-post-image', 1200, 900 );
    }
    
    /**
     * @return Container
     */
    public function get_container()
    {
        return $this->container;
    }
    
    /**
     * @return EventManager|bool
     */
    public function get_event_manager()
    {
        if ( !$this->is_loaded() ) {
            return false;
        }
        return $this->container['event_manager'];
    }
    
    public function get_autopost_factory()
    {
        if ( !$this->is_loaded() ) {
            return false;
        }
        return $this->container['factory.autopost_factory'];
    }

}