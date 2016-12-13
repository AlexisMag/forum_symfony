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
use ForumBundle\Form\MessageReplyType;

class ForumController extends Controller
{
    /**
    * @Route ("/forum/test")
    */
    public function test(Request $request){

        $forum = new Forum();
        $forum->setName("Bien le bonjour");


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
    * @Route("/forum/{forum_id}/create", name="create_subject")
    */
    public function createSubjectAction($forum_id, Request $request){

        $repository = $this->getDoctrine()->getRepository("ForumBundle:Forum");

        $forum = $repository->findOneById($forum_id);

        $subject = new Subject();
        $subject->setForum($forum);

        $message = new Message();
        $message->setSubject($subject);

        $form = $this->createForm(MessageType::class, $message);

        if($request->isMethod("POST") && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->redirect($this->generateUrl('messages', array(
                'slug' => $message->getSubject()->getSlug()
            )));
        }

        return $this->render("forum/create_subject.html.twig", array(
            'title' => 'New subject',
            'form' => $form->createView(),
            'forum_id' => $forum_id
        ));
    }

    /**
    * Reply to a subject
    * @Route("/forum/subject/{subject_id}/reply", name="reply")
    */
    public function replyAction($subject_id, Request $request){
        $repository = $this->getDoctrine()->getRepository('ForumBundle:Subject');

        $subject = $repository->findOneById($subject_id);

        $message = new Message();
        $message->setSubject($subject);
        $form = $this->createForm(MessageReplyType::class, $message);

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        return $this->redirect($this->generateUrl('messages', array(
            'slug' => $subject->getSlug()
        )));
    }

    /**
    * Discussion in a forum with messages
    * @Route("/forum/subject/{slug}", name="messages")
    */
    public function messagesAction($slug, Request $request){
        $repository = $this->getDoctrine()->getRepository("ForumBundle:Subject");
        $subject = $repository->findOneBySlug($slug);

        $message = new Message();
        $form = $this->createForm(MessageReplyType::class, $message);



        return $this->render('forum/messages.html.twig', array(
            'title' => $subject->getTitle(),
            'subject' => $subject,
            'form' => $form->createView()
        ));
    }

}
