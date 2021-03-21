<?php
namespace WordLand\Admin;

use Ramphor\Wallery\Wallery;
use Ramphor\Wallery\Factory\MetaboxFactory;
use WordLand\Admin\Property\MetaBox\PropertyInformation;
use WordLand\Admin\Menu\Dashboard;
use WordLand\PostTypes;

class Admin
{
    protected $wallery;

    public function __construct()
    {
        $this->initHooks();
    }

    protected function initHooks()
    {
        add_action('admin_init', array($this, 'initProperty'));

        $dashboard = new Dashboard();
        add_action('admin_menu', array($dashboard, 'registerDashboard'));

        add_action('add_meta_boxes', array($this, 'registerGalleryMetabox'));

        if ( class_exists( Wallery::class ) ) {
            $walleryFactory  = new MetaboxFactory(__('Property Images', 'wordland'));
            $this->wallery = new Wallery( $walleryFactory );

            $this->wallery->setId( 'wordland_property_gallery_images' );
        }


        $scripts = new Scripts();
        add_action('admin_enqueue_scripts', array($scripts, 'register'));
    }

    public function initProperty()
    {
        $propertyMetabox = new PropertyInformation();
        add_action('add_meta_boxes', array($propertyMetabox, 'registerMetaboxes'));
    }

    public function registerGalleryMetabox() {
        add_meta_box(
            'wordland-property-gallery',
            __( 'Property Gallery', 'wordland' ),
            array( $this->wallery, 'render' ),
            PostTypes::get()
        );
    }
}
