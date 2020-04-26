<?php


namespace App\Controller;


use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;

class CommentController extends AbstractController
{
    /**
     * @Route("/Comment={id}", name="Comment")
     * @return Response
     */
public function addCommentAction($id, Request $request){
    $News=$this->getDoctrine()->getRepository(News::class)->find($id);
    $Comment=new Comment();
    $Comment->setNews($News);
    $form=$this->createFormBuilder($Comment)
        ->add('text',TextareaType::class)
        ->add('save', SubmitType::class)
        ->getForm();
    $form->handleRequest($request);
    if($form->isSubmitted()&&$form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Comment);
        $em->flush();
    }
    return  $this->render('CommentNews.html.twig',['id'=> $id,'News'=>$News, 'Comment_form'=>$form->createView()]);
}
}