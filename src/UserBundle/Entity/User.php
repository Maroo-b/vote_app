<?php

namespace UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Question;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Question", mappedBy="user", cascade={"persist"})
     */
    private $questions;

    public function __construct()
    {
      $this->questions = new ArrayCollection();
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
     * Add questions
     *
     * @param \UserBundle\Entity\Question $questions
     * @return User
     */
    public function addQuestion(\AppBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
        $questions->setUser($this);

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \UserBundle\Entity\Question $questions
     */
    public function removeQuestion(\AppBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
