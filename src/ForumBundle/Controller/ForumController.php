<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    /**
    * All forums
    * @Route("/forum", name="list_forum")
    */
    public function forumAction(Request $request){

    }

    /**
    * All subjects of a forum
    * @Route("/forum/category/{slug}", name="subjects")
    */
    public function subjectsAction(Request $request){
        
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
