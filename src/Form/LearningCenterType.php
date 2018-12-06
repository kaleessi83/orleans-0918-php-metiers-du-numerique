<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\LearningCenter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LearningCenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('mail')
            ->add('link')
            ->add('jobs', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name'
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LearningCenter::class,
        ]);
    }
}