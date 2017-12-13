<?php

namespace FreelancingWebsiteBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jobTitle', TextType::class)
            ->add('jobDescription', TextareaType::class)
            ->add('clientBudget', NumberType::class, array(
                'scale' => 2,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FreelancingWebsiteBundle\Entity\JobPost',
        ));
    }
}
