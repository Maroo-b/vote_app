<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Question;

/**
 * Choice
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChoiceRepository")
 */
class Choice
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
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote_count", type="integer")
     */
    private $vote_count=0;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="choices")
     */
    private $question;

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
     * Set value
     *
     * @param string $value
     * @return Choice
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set question
     *
     * @param \AppBundle\Entity\Question $question
     * @return Choice
     */
    public function setQuestion(\AppBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \AppBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set vote_count
     *
     * @param integer $voteCount
     * @return Choice
     */
    public function setVoteCount($voteCount)
    {
        $this->vote_count = $voteCount;

        return $this;
    }

    /**
     * Get vote_count
     *
     * @return integer 
     */
    public function getVoteCount()
    {
        return $this->vote_count;
    }
    public function __toString() 
    {
          return $this->getValue();

    }
}
