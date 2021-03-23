<?php
namespace WordLand\Frontend\Dashboard;

use Ramphor\User\Abstracts\MyProfileAbstract;

class MyPropertiesList extends MyProfileAbstract
{
    const FEATURE_NAME = 'my_properties';

    public function getName()
    {
        return static::FEATURE_NAME;
    }

    public function getMenuItem()
    {
        return array(
            'label' => __('My properties list', 'wordland'),
            'url' => '#',
        );
    }

    public function render()
    {
    }
}
