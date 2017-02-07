<?php

namespace IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;  

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('label' => 'Prénom: '))
            ->add('lastname', TextType::class, array('label' => 'Nom: '))
            ->add('birthdate', DateType::class, array('label' => 'Date de naissance: '))
            ->add('address', TextType::class, array('label' => 'Adresse: '))
            ->add('zipcode', TextType::class, array('label' => 'Code Postal: '))
            ->add('city', TextType::class, array('label' => 'Ville: '))
            ->add('phoneNumber', TextType::class, array('label' => 'Numéro de téléphone: '))
            ->add('subjects', EntityType::class, array('label' => 'Matières: ',
            'class'     => 'IntranetBundle\Entity\Subject',
            'choice_label' => 'name', 'multiple' => true, 'expanded' => true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntranetBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'intranetbundle_user';
    }


}
