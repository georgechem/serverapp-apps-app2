<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'attr'=>['class'=>'Login__form__input'],
                'label_attr'=>['class'=>'Login__form__label'],
            ])
            ->add('password', PasswordType::class,[
                'attr'=>['class'=>'Login__form__input'],
                'label_attr'=>['class'=>'Login__form__label'],
            ])
            ->add('login',SubmitType::class,[
                'attr'=>['class'=>'Login__form__submit'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
