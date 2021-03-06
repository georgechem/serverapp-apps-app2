<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', FileType::class,[
                'label_attr'=>['class'=>'Upload__container__label'],
                'attr'=>['class'=>'Upload__container__input'],
            ] )
            ->add('name', TextType::class,[
                'attr'=>['class'=>'Upload__container__userInput'],
                'label_attr'=>['class'=>'Upload__container__userInput--label'],
                'required'=>true,
            ])
            ->add('submit', SubmitType::class,[
                'attr'=>['class'=>'Upload__container__submit']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
