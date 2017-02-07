<?php

namespace IntranetBundle\Controller;

use IntranetBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("user")
 */
class UserController extends Controller
{

    /**
     * Lists all student entities.
     *
     * @Route("/", name="index_show")
     */
    public function indexAction()
    {
        return $this->render('IntranetBundle:User:user.html.twig');
    }

    /**
     * Lists all student entities.
     *
     * @Route("/student", name="student_show")
     */
    public function studentShowAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$connection = $em->getConnection();
        $statement = $connection->prepare("SELECT id, firstname, lastname FROM `user` WHERE roles = 'a:0:{}'");
        $statement->execute();
        $statement2 = $connection->prepare("SELECT user_id, name FROM subject JOIN user_subject ON subject_id = id order by user_id");
        $statement2->execute();
        $users = $statement->fetchAll();
        $subjects = $statement2->fetchAll();

        return $this->render('IntranetBundle:User:student.html.twig', array(
            'users' => $users,
            'subjects' => $subjects,
        ));
    }

    /**
     * Lists all student entities.
     *
     * @Route("/student/{id}", name="student_id_show")
     */
    public function studentIdShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM user LEFT JOIN report ON user.id = user_id LEFT JOIN subject ON subject.id = subject_id WHERE roles = 'a:0:{}' AND user.id =".$id);
        $statement->execute();
        $statement2 = $connection->prepare("SELECT * FROM user LEFT JOIN user_subject ON user.id = user_id LEFT JOIN subject ON subject.id = subject_id WHERE roles = 'a:0:{}' AND user.id =".$id);
        $statement2->execute();
        $subjects = $statement2->fetchAll();
        $user = $statement->fetchAll();

        return $this->render('IntranetBundle:User:studentId.html.twig', array(
            'user' => $user,
            'subjects' => $subjects,
        ));
    }

    /**
     * Displays a form to edit an existing subject entity.
     *
     * @Route("/student/{id}/edit", name="student_edit")
     * @Method({"GET", "POST"})
     */
    public function studentEditAction(Request $request, User $user)
    {
        $editForm = $this->createForm('IntranetBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_id_show', array('id' => $user->getId()));
        }

        return $this->render('IntranetBundle:User:studentEdit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
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
        $statement = $connection->prepare("SELECT id, firstname, lastname FROM `user` WHERE roles = 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'");
        $statement->execute();
        $statement2 = $connection->prepare("SELECT user_id, name FROM subject JOIN user_subject ON subject_id = id order by user_id");
        $statement2->execute();
        $users = $statement->fetchAll();
        $subjects = $statement2->fetchAll();

        return $this->render('IntranetBundle:User:professor.html.twig', array(
            'users' => $users,
            'subjects' => $subjects,
        ));
    }

    /**
     * Lists all student entities.
     *
     * @Route("/professor/{id}", name="professor_id_show")
     */
    public function professorIdShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM user WHERE user.id =".$id);
        $statement->execute();
        $statement2 = $connection->prepare("SELECT * FROM user LEFT JOIN user_subject ON user.id = user_id LEFT JOIN subject ON subject.id = subject_id WHERE roles = 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}' AND user.id =".$id);
        $statement2->execute();
        $subjects = $statement2->fetchAll();
        $user = $statement->fetchAll();

        return $this->render('IntranetBundle:User:professorId.html.twig', array(
            'user' => $user,
            'subjects' => $subjects,
        ));
    }

    /**
     * Displays a form to edit an existing subject entity.
     *
     * @Route("/professor/{id}/edit", name="professor_edit")
     * @Method({"GET", "POST"})
     */
    public function professorEditAction(Request $request, User $user)
    {
        $editForm = $this->createForm('IntranetBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professor_id_show', array('id' => $user->getId()));
        }

        return $this->render('IntranetBundle:User:professorEdit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }
}