<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Admin;

/**
 * Description of CarAdmin
 *
 * @author alpha
 */

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

use  Sonata\AdminBundle\Show\ShowMapper;

class CarAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('libelle', 'text', array('label'  => 'label.libelle'));
        $formMapper->add('datefabriquation', 'sonata_type_datetime_picker', array(
                    'label'                 => 'label.datefabriquation',
                    'format'                => 'dd/MM/yyyy',
                    'dp_side_by_side'       => false,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
            ));
        $formMapper->add('nombredeporte', 'integer',  array('label'  => 'label.nombredeporte'));
        $formMapper->add('picture', 'sonata_type_model_list', array('label'  => 'label.picture'), array('link_parameters' => array('context' => 'news')));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
         $datagridMapper->add('libelle');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('libelle');
        $listMapper->add('datefabriquation');
        $listMapper->add('nombredeporte');
        $listMapper->add('_action', null, array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
                'delete' => array(),
                'clone' => array(
                    'template' => 'AppBundle:CRUD:list__action_clone.html.twig'
                )
            )
        ));
    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('clone', $this->getRouterIdParameter().'/clone');
    }
    
    public function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
        
        $showMapper

             // The default option is to just display the
             // value as text (for boolean this will be 1 or 0)
            ->add('libelle')
            ->add('datefabriquation', null, array('label' => 'Date de Fabriquation'))
            ->add('picture');
    }
}
