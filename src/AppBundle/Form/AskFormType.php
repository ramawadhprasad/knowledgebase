<?php

namespace AppBundle\Form;
use Pimcore\Model\DataObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AskFormType extends AbstractType
{

    /**
     * Method containing basic structure of form
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $listCategories = new DataObject\Category\Listing();
		
		foreach($listCategories as $category){
			$c[$category->getName()] = $category->getId();
		} 
		$categories = $c;
		$builder
            
            ->add('title', TextType::class, [
                'label'       => 'Title',
                'required'    => true
            ])
            ->add('blurb', TextareaType::class, [
                'label'    => 'Blurb',
                'required' => true,
				'attr' => ['rows' => '3', 'cols'=>'40'],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
				'attr' => ['rows' => '10', 'cols'=>'40'],
            ])
            /*
            ->add('content', CKEditorType::class, array(
                'config'=>array('uiColor' => '#ffffff' )
                ))*/
            ->add('category', ChoiceType::class, [
                'label' => 'Category',
				'choices'  => $categories,
            ])
            ->add('type', ChoiceType::class, [
                'required'=>true,
                'choices' =>['Post Type'=>'', 'Question' => 'question', 'Article'=>'article', 'Document'=>'document','Plugin or Reusable Code'=>'code'],
            ])
			->add('attachment', FileType::class, [
                'label' => 'Attachment',
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
