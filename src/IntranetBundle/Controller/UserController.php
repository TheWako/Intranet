<?php

namespace IntranetBundle\Controller;

use IntranetBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all student entities.
     *
     * @Route("/student", name="student_show")
     */
    public function studentShowAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM user JOIN user_subject ON user.id = user.id JOIN subject ON subject.id = subject_id WHERE roles = 'a:0:{}' and user.id = user_id order by user.id");
        $statement->execute();
        $users = $statement->fetchAll();

        return $this->render('IntranetBundle:User:student.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Lists all professor entities.
     *
     * @Route("/professor", name="professor_show")
     */
    public function professorShowAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM user JOIN user_subject ON user.id = user.id JOIN subject ON subject.id = subject_id WHERE roles = 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}' and user.id = user_id order by user.id");
        $statement->execute();
        $users = $statement->fetchAll();

        return $this->render('IntranetBundle:User:student.html.twig', array(
            'users' => $users,
        ));
    }
}