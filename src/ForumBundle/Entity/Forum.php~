<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Forum
 *
 * @ORM\Table(name="forum")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ForumRepository")
 */
class Forum
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     */
    private $slug;

    /**
    * @ORM\OneToMany(targetEntity="Subject", mappedBy="forum")
    */
    private $subjects;

    public function __construct(){
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Forum
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Forum
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add subject
     *
     * @param \ForumBundle\Entity\Subject $subject
     *
     * @return Forum
     */
    public function addSubject(\ForumBundle\Entity\Subject $subject)
    {
        $this->subjects[] = $subject;

        return $this;
    }

    /**
     * Remove subject
     *
     * @param \ForumBundle\Entity\Subject $subject
     */
    public function removeSubject(\ForumBundle\Entity\Subject $subject)
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
