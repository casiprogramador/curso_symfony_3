<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/insert/post", name="insert_post")
     */
    public function insertPost()
    {	
	$post = new Post();
        $post->setTitulo('New symfony 3');
        $post->setContenido('Cras ultricies ligula sed magna dictum porta.');
        $post->setAutor('Diego');
        $post->setFecha(new \DateTime('2018-06-11'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($post);

        $em->flush();

        return new Response('Se inserto nueva entrada con ID:'.$post->getId());
    }
    
    /**
     * @Route("/get/post", name="get_post")
     */
    public function getAllPost()
    {	
	 $em = $this->getDoctrine()->getManager();
         $repository = $em->getRepository('AppBundle:Post');
         $posts = $repository->findAll();
         dump($posts);
         return new Response('Datos Tabla Post'); 
    }
    
     /**
     * @Route("/update/post/{id}", name="update_post")
     */
    public function updatePost($id)
    {	
	$em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'El post con ID '.$productId.' no existe'
            );
        }
        $post->setTitulo('Symfony 3.3 Update');
        $post->setContenido('Donec sollicitudin molestie malesuada. Proin eget tortor risus.');
        $post->setAutor('David Bonaparte');
        $post->setFecha(new \DateTime('2017-07-28'));
        
        $em->flush();
        
        return new Response('Se actualizo entrada con ID:'.$id);
    } 
    
    /**
     * @Route("/delete/post/{id}", name="delete_post")
     */
    public function deletePost($id)
    {	
	$em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'El post con ID '.$productId.' no existe'
            );
        }
        $em->remove($post);
        $em->flush();
        
        return new Response('Se borro la entrada con ID:'.$id);
    } 
}
