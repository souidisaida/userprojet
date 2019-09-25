<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',
                TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'constraints' => [
                        new NotBlank(['message' => "champ obligatoire"]),
                    ],
                ]
            )
            ->add('email',
                EmailType::class,
                [
                    'attr' => [
                    'class' => 'form-control'
                    ],
                    'constraints' => [
                        new NotBlank(['message' => "champ obligatoire"]),
                        new Email(['message' => 'email n\'est pas valid']),
                    ],
                ]
            )
            ->add(
                'groups',
                EntityType::class,
                [
                    'attr'         => ['class' => "form-control selectpicker select2", 'multiple' => true,],
                    'class'        => 'App\Entity\GroupUser',
                    'choice_label' => 'groupName',
                    'label'        => '',
                    'constraints' => [
                        new NotBlank(['message' => "champ obligatoire"]),
                    ],
                    'expanded'     => false,
                    'multiple'     => true,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}
