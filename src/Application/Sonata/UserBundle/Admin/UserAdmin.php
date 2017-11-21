<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAdmin
 *
 * @author alpha
 */
namespace Application\Sonata\UserBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends SonataUserAdmin
{
    /**
        * {@inheritdoc}
        */
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper->remove('dateOfBirth');

        $formMapper
                ->tab('User')
                ->with('Profile')
                    ->add('dateOfBirth', 'sonata_type_date_picker', [
                        'dp_min_date' => '1-1-1900',
                        'required' => false,
                        'format'=>'dd/MM/yyyy'
                    ])
               ->end()
                ->end();
 
    }
     
}