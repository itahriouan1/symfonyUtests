<?php


namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
    /**
     * @Route("/newsAdmin", name="newsAdmin")
     * @return Response
     */
    public function newsAdminAction(){
        $news=$this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->render('newsAdmin.html.twig', ['news'=>$news]);
    }
    /**
     * @Route("/DeleteNews={id}", name="DeleteNews")
     * @return Response
     */
    public function deleteNewsAction($id){
        $news=$this->getDoctrine()->getRepository(News::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();
        return $this->json(['deleting'=> true]);
    }
    /**
     * @Route("/ModifyNews={id}&action={action}", name="ModifyNews")
     * @return Response
     */
    public function modifyNewsAction($id, $action, Request $request){
        $news=$this->getDoctrine()->getRepository(News::class)->find($id);

        if($action=='modify') {
            return $this->json(['form' => $this->renderView('formModifNews.html.twig', ['id' => $id, 'news'=>$news])]);
        }
        if($action=='save') {


            $em=$this->getDoctrine()->getManager();
            $news->setTitre($_POST['titre']);
            $news->setDescription($_POST['description']);
            $em->persist($news);
            $em->flush();

            return $this->json([
                'form'=> '<td>'.$request->request->get('titre').'</td>
                    <td>'.$request->request->get('description').'</td>
                    <td><a href="#" onclick="modifyNews('.$news->getId().')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td><a href="#" onclick="deleteNews('.$news->getId().')" >supprimer</a></td>'
            ]);


        }
    }



}
