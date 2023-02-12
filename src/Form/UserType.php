<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('password', TextType::class)
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'CEO' => 'CEO',
                    'CTO' => 'CTO',
                    'ADMIN' => 'ADMIN',
                    'SALES' => 'SALES',

                ],
                'multiple' => true,
            ])
        ;
    }
}
