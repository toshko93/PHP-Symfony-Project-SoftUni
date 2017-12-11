<?php

namespace FreelancingWebsiteBundle\Form;

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
            ->add('jobDescription', TextType::class)
            ->add('clientBudget', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FreelancingWebsiteBundle\Entity\JobPost',
        ));
    }

    public function getBlockPrefix()
    {
        return 'freelancing_website_bundle_job_post_type';
    }
}
