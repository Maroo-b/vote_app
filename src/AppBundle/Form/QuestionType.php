<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
      {
        $builder
          ->add('title','text')
          ->add('description','textarea')
          ->add('choices','collection', array(
            'block_name' => 'my_name',
            'type' => new ChoiceType(),
            'options' => array('label' => false),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
          ))
          ;

      }

 public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Question'
        ));
    }

    public function getName()
    {
        return 'app_question';
    }
}
