<?php


namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function indexAction(Request $request){
        $x=12;
        $x2=4;
        return $this->render("index.html.twig",['x'=>$x, 'x2'=> $x2]);
    }
    /**
     * @Route("/news={p}", name="news")
     * @return Response
     */
    public function newsAction($p){
        $c= new \stdClass();
        $c->nom='php';
        $c->description='description';
        $html="<a href='index.html.twig'>index</a>";
        $t= array(array(1,2,3),array(4,5,6),array(7,8,9));
        return $this->render("news.html.twig",['p'=>$p, 'c'=> $c, 't'=>$t, 'html'=>$html]);
    }
    /**
     * @Route("/newsForm", name="newsForm")
     * @return Response
     */
    public function insertAction(Request $request){
        $news= new News();
        $form=$this->createForm(NewsType::class,$news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em=$this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();
        }
        return $this->render('formNews.html.twig', ['formNews' =>$form->createView()]);
    }
}