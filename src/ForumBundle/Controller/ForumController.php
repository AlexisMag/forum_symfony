<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ForumBundle\Entity\Forum;
use ForumBundle\Entity\Subject;
use ForumBundle\Entity\Message;
use ForumBundle\Form\SubjectType;
use ForumBundle\Form\MessageType;

class ForumController extends Controller
{
    /**
    * @Route ("/forum/test")
    */
    public function test(Request $request){



        return new Response("<body></body>");
    }

    /**
    * All forums
    * @Route("/forum", name="forums")
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

        return $this->render('forum/subjects.html.twig', array(
            'title' => $forum->getName(),
            'forum' => $forum
        ));
    }
    /**
    * Form to add a message
    * @Route("/forum/subject/create/{forum_id}", name="create_subject")
    */
    public function createSubjectAction($forum_id){

        $message = new Message();

        $form = $this->createForm(MessageType::class, $message);

        return $this->render("forum/create_subject.html.twig", array(
            'title' => 'New subject',
            'form' => $form->createView()
        ));
    }

    /**
    * Discussion in a forum with messages
    * @Route("/forum/subject/{slug}", name="messages")
    */
    public function messagesAction(Request $request){

    }

}
