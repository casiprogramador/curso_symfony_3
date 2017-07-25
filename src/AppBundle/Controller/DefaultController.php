<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {	
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Post');
        $posts = $repository->findAll();
	return $this->render('AppBundle:Home:index.html.twig',
                array('posts'=>$posts)
                );
    }
	
    /**
     * @Route("/post/{id}", name="simple_post")
     */
    public function simplePost($id)
    {	
	return $this->render('AppBundle:Post:simple.html.twig', array(
		'id' => $id
	));
    }   
}
