<?php
// src/AppBundle/EventListener/MenuBuilderListener.php

namespace AppBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $child = $menu->addChild('reports', [
            'label' => 'Daily and monthly reports',
            'route' => 'productStatistics_list',
        ])->setExtras([
            'icon' => '<i class="fa fa-bar-chart"></i>',
        ]);

    }
}