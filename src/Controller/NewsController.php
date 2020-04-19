<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function indexAction(){
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
}