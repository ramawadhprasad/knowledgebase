<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{

    /**
     * Method containing basic structure of form
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('firstname', TextType::class, [
                'label'       => 'Firstname',
                'required'    => true
            ])
            ->add('lastname', TextType::class, [
                'label'    => 'Lastname',
                'required' => true
            ])
            ->add('username', TextType::class, [
                'label' => 'Username'
            ])
            ->add('email', EmailType::class, [
                'label'    => 'E-Mail',
                'required' => true,
                'attr'     => [
                    'placeholder' => 'example@example.com'
                ]
            ])
			->add('password', PasswordType::class, [
                'label' => 'Password'
            ])
            
            ->add('gender', ChoiceType::class, [
                'label'    => 'Gender',
                'required' => true,
                'choices'  => [
                    'Female' => 'female',
                    'Male'   => 'male'
                ]
            ])
			->add('_target_path', HiddenType::class)
            ->add('_submit', SubmitType::class);
            
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
          //  $resolver->setDefaults(array(
           // 'data_class' => Post::class,
        //));
    }
}
