<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedbacks")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\FeedbackRepository")
 */
class Feedback
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
     * @ORM\Column(name="feedbackText", type="string", length=255)
     */
    private $feedbackText;

    /**
     * @var string
     *
     * @ORM\Column(name="feedbackScore", type="integer", nullable=true)
     */
    private $feedbackScore;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="feedbacks")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Contract
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Contract", mappedBy="freelancerFeedback", cascade={"persist"})
     */
    private $contract;

    public function __construct(User $user)
    {
        $this->feedbackText = "";
        $this->user = $user;
    }

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
     * Set feedbackText
     *
     * @param string $feedbackText
     *
     * @return Feedback
     */
    public function setFeedbackText($feedbackText)
    {
        $this->feedbackText = $feedbackText;

        return $this;
    }

    /**
     * Get feedbackText
     *
     * @return string
     */
    public function getFeedbackText()
    {
        return $this->feedbackText;
    }

    /**
     * Set feedbackScore
     *
     * @param string $feedbackScore
     *
     * @return Feedback
     */
    public function setFeedbackScore($feedbackScore)
    {
        $this->feedbackScore = $feedbackScore;

        return $this;
    }

    /**
     * Get feedbackScore
     *
     * @return string
     */
    public function getFeedbackScore()
    {
        return $this->feedbackScore;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Feedback
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $user
     *
     * @return Feedback
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\Contract $contract
     *
     * @return Feedback
     */
    public function setContract(Contract $contract = null)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\Contract
     */
    public function getContract()
    {
        return $this->contract;
    }
}

