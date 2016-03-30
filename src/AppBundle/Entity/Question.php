<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Choice;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\QuestionRepository")
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Choice", mappedBy="question", cascade={"persist"})
     */
    private $choices;

    public function __construct()
    {
      $this->choices = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Question
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add choices
     *
     * @param \AppBundle\Entity\Choice $choices
     * @return Question
     */
    public function addChoice(\AppBundle\Entity\Choice $choices)
    {
        $this->choices[] = $choices;
        $choices->setQuestion($this);
        return $this;
    }

    /**
     * Remove choices
     *
     * @param \AppBundle\Entity\Choice $choices
     */
    public function removeChoice(\AppBundle\Entity\Choice $choices)
    {
        $this->choices->removeElement($choices);
    }

    /**
     * Get choices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoices()
    {
        return $this->choices;
    }
}
