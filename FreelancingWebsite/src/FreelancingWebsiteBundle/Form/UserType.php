<?php

namespace FreelancingWebsiteBundle\Form;

use FreelancingWebsiteBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("email", TextType::class)
            ->add("password", TextType::class)
            ->add("firstName", TextType::class)
            ->add("lastName", TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data-class' => User::class
        ));
    }
}
