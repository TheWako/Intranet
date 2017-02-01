<?php
// src/IntranetBundle/Form/RegistrationType.php

namespace IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname' , TextType::class , array('label' => 'Prénom'));
        $builder->add('lastname' , TextType::class , array('label' => 'Nom'));
        $builder->add('birthdate' , DateType::class , array('label' => 'Date de naissance' , 'years' => range(date('Y') - 100, date('Y') - 10)));
        $builder->add('address' , TextType::class ,  array('label' => 'Adresse'));
        $builder->add('zipcode' , TextType::class , array('label' => 'Code Postal'));
        $builder->add('city' , TextType::class , array('label' => 'Ville'));
        $builder->add('phoneNumber' , TextType::class , array('label' => 'Numéro de téléphone'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}