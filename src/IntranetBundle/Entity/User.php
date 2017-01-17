<?php

namespace IntranetBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="IntranetBundle\Entity\Subject", cascade={"persist"})
     */
    private $subjects;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add subject
     *
     * @param \IntranetBundle\Entity\Subject $subject
     *
     * @return User
     */
    public function addSubject(\IntranetBundle\Entity\Subject $subject)
    {
        $this->subjects[] = $subject;

        return $this;
    }

    /**
     * Remove subject
     *
     * @param \IntranetBundle\Entity\Subject $subject
     */
    public function removeSubject(\IntranetBundle\Entity\Subject $subject)
    {
        $this->subjects->removeElement($subject);
    }

    /**
     * Get subjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
}
