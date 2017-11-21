<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use Sonata\TranslationBundle\Filter\TranslationFieldFilter;

class PostAdmin extends AbstractAdmin
{
    
    public $supportsPreviewMode = true;
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('title', 'text')
                ->add('body', 'textarea')
            ->end()
                
                
             
            ->with('Meta data', array('class' => 'col-md-3'))
               
                // ->add('categories', 'sonata_type_model',  array('multiple' => true, 'by_reference' => false))
                ->add('categories', 'sonata_type_model_autocomplete',  array('multiple' => true, 'by_reference' => false, 'property'=>'name'))

                  
                
              
                    // 
                
                /*
                ->add('category', 'sonata_type_model', array(
                    'class' => 'AppBundle\Entity\Category',
                    'property' => 'name',
                ))
                 * 
                 */
            ->end()
              
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
       
        $listMapper->addIdentifier('id');
        $listMapper->add('title');
        $listMapper->add('body');
        $listMapper->add('draft');
        $listMapper->add('categories');
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('title', TranslationFieldFilter::class)
                ->add('categories')
                /*
                ->add('categories', null, array(), 'entity', array(
                    'class'    => 'AppBundle\Entity\Category',
                    'choice_label' => 'name', // In Symfony2: 'property' => 'name'
                ))
                 * 
                 */
                ;
    }
    
     public function getDashboardActions()
    {
        $actions = parent::getDashboardActions();
        
        /*
        $actions['import'] = array(
            'label'              => 'Import',
            'url'                => $this->generateUrl('import'),
            'icon'               => 'import',
            'translation_domain' => 'SonataAdminBundle', // optional
            'template'           => 'SonataAdminBundle:CRUD:dashboard__action.html.twig', // optional
        );
         * 
         */

        // unset($actions['list']);

        return $actions;
    }
    
    /*
    public function getExportFields()
    {
       return array('title', 'body', 'category.name');
    }
     * 
     */
    
    public function getExportFormats()
    {
        return array_merge(parent::getExportFormats(), array('pdf', 'html'));
    }
    
    
    // change template 
    
    public function getTemplate($name)
    {
        switch ($name) {
            case 'preview':
                return 'AppBundle:CRUD:preview.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
     
     
    
    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }
    
    
    // after add translation global search not working, we should add this 
     public function getRequest()
        {
            if (!$this->request) {
                //  throw new \RuntimeException('The Request object has not been set');
                $this->request = $this->getConfigurationPool()->getContainer()->get('Request');
            }

            return $this->request;
        }
}