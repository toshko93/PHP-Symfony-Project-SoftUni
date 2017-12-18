<?php

namespace FreelancingWebsiteBundle\Form;

use FreelancingWebsiteBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
//            ->add("register_as_freelancer", CheckboxType::class)
//            ->add("register_as_client", CheckboxType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data-class' => User::class
        ));
    }
}
