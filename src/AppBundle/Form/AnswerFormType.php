<?php

namespace AppBundle\Form;
use Pimcore\Model\DataObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnswerFormType extends AbstractType
{

    /**
     * Method containing basic structure of form
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
             ->add('content', TextareaType::class, [
                'label'    => 'Your Answer',
                'required' => true,
				'attr' => ['rows' => '3', 'cols'=>'40'],
            ])
            ->add('attachment', FileType::class, [
                'label' => 'Attachment',
            ])
            ->add('question', HiddenType::class)
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
