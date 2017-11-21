<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

use Sonata\AdminBundle\Form\FormMapper;

class ProductStatisticsAdmin  extends AbstractAdmin
{
    protected $baseRoutePattern = 'product-statistics';
    protected $baseRouteName = 'productStatistics';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list'));
    }
    
}