<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\GroupUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'groupName',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(['message' => "champ obligatoire"]),
                    ],
                ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupUser::class,
        ]);
    }
}
