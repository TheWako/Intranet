<?php

namespace IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="IntranetBundle\Repository\ReportRepository")
 */
class Report
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="grade", type="float")
     */
    private $grade;

    /**
     * @ORM\OneToOne(targetEntity="IntranetBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="IntranetBundle\Entity\Subject", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grade
     *
     * @param float $grade
     *
     * @return Report
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return float
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set user
     *
     * @param \IntranetBundle\Entity\User $user
     *
     * @return Report
     */
    public function setUser(\IntranetBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \IntranetBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set subject
     *
     * @param \IntranetBundle\Entity\Subject $subject
     *
     * @return Report
     */
    public function setSubject(\IntranetBundle\Entity\Subject $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \IntranetBundle\Entity\Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
