<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Question;
use AppBundle\Entity\Choice;
use AppBundle\Form\QuestionType;

class QuestionController extends Controller
{
  public function addAction(Request $request)
  {
    $question = new Question();
    $choice1 = new Choice();
    $question->addChoice($choice1);

    $form = $this->createForm(new QuestionType(), $question);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice','Vote poll created');
       return $this->redirectToRoute('question_show_path', 
             array( 'id' => $question->getId()  ));
    }

    return $this->render('question/add.html.twig', array(
      'form' => $form->createView()
    ));
  }

  public function showAction(Question $question,Request $request)
  {
    $choices = $question->getChoices();

    $defaultData = array('message' => 'Type your message here');
    $form = $this->createFormBuilder($defaultData)
      ->add('choices', 'entity',array(
        'class' => 'AppBundle:Choice',
        'choices' => $question->getChoices(),
        'expanded' => false,
        'multiple' => false
      ))
        ->getForm();

    $form->handleRequest($request);
    if($form->isSubmitted() ){
      $em = $this->getDoctrine()->getManager();
      $choice = $em->getRepository('AppBundle:Choice')->find($form->get('choices')->getData());
      $choice->setVoteCount($choice->getVoteCount() + 1);
      $em->persist($question);
      $em->flush();
       return $this->redirectToRoute('question_notice_path'); 
    }

    return $this->render('question/show.html.twig', array(
      'question' => $question,
      'form' => $form->createView()
    ));
  }

  public function noticeAction()
  {
    return $this->render('question/notice.html.twig');
  }
}
