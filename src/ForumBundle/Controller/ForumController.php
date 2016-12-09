<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ForumBundle\Entity\Forum;

class ForumController extends Controller
{
    /**
    * @Route ("/forum/test")
    */
    public function test(Request $request){

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT f.id, f.name
            FROM ForumBundle:Forum f
            WHERE f.slug = :slug1 OR f.slug = :slug2
            ORDER BY f.slug DESC
            '
        )
        ->setParameter('slug1', 'html-css')
        ->setParameter('slug2', 'php');

        $forums = $query->getResult();
        dump($forums);


        return new Response("ok");
    }

    /**
    * All forums
    * @Route("/forum", name="list_forum")
    */
    public function forumAction(Request $request){
        //Get all forums from database
        $repository = $this->getDoctrine()->getRepository('ForumBundle:Forum');
        $forums = $repository->findAll();

        return $this->render("forum/forums.html.twig", array(
            "title" => "Forums",
            "forums" => $forums
        ));
    }

    /**
    * All subjects of a forum
    * @Route("/forum/category/{slug}", name="subjects")
    */
    public function subjectsAction($slug){

        //Get all subjects from this forum
        $repository = $this->getDoctrine()->getRepository('ForumBundle:Forum');
        $forum = $repository->findOneBySlug($slug);

        $repository = $this->getDoctrine()->getRepository('ForumBundle:Subject');
        $subjects = $repository->findByForumId($forum->getId());



        return $this->render('forum/subjects.html.twig', array(
            'title' => $forum->getName(),
            'forum' => $forum,
            'subjects' => $subjects
        ));
    }

    /**
    * Discussion in a forum with messages
    * @Route("/forum/subject/{slug}", name="messages")
    */
    public function messagesAction(Request $request){

    }

    /**
    * Form to add a message
    * @Route("/form/category/create", name="form_message")
    */
    public function addMessageAction(Request $request){

    }
}
