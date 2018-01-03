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
     * @ORM\Column(name="freelancer_feedback_text", type="string", length=255, nullable=true)
     */
    private $freelancerFeedbackText;

    /**
     * @var string
     *
     * @ORM\Column(name="freelancer_feedback_score", type="integer", nullable=true)
     */
    private $freelancerFeedbackScore;

    /**
     * @var int
     *
     * @ORM\Column(name="freelancer_id", type="integer")
     */
    private $freelancerId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="feedbacksAsFreelancer")
     * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")
     */
    private $freelancer;

    /**
     * @var string
     *
     * @ORM\Column(name="client_feedback_text", type="string", length=255, nullable=true)
     */
    private $clientFeedbackText;

    /**
     * @var string
     *
     * @ORM\Column(name="client_feedback_score", type="integer", nullable=true)
     */
    private $clientFeedbackScore;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="feedbacksAsClient")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var int
     *
     * @ORM\Column(name="contractId", type="integer")
     */
    private $contractId;

    /**
     * @var Contract
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Contract", inversedBy="feedback")
     * @ORM\JoinColumn(name="contractId", referencedColumnName="id")
     */
    private $contract;

    /**
     * Feedback constructor.
     */
    public function __construct(User $freelancer, User $client, Contract $contract)
    {
        $this->freelancer = $freelancer;
        $this->client = $client;
        $this->contract = $contract;
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
     * Set freelancerFeedbackText
     *
     * @param string $freelancerFeedbackText
     *
     * @return Feedback
     */
    public function setFreelancerFeedbackText(string $freelancerFeedbackText) : Feedback
    {
        $this->freelancerFeedbackText = $freelancerFeedbackText;

        return $this;
    }

    /**
     * Get freelancerFeedbackText
     *
     * @return string
     */
    public function getFreelancerFeedbackText()
    {
        return $this->freelancerFeedbackText;
    }

    /**
     * Set freelancerFeedbackScore
     *
     * @param string $freelancerFeedbackScore
     *
     * @return Feedback
     */
    public function setFreelancerFeedbackScore($freelancerFeedbackScore)
    {
        $this->freelancerFeedbackScore = $freelancerFeedbackScore;

        return $this;
    }

    /**
     * Get feedbackScore
     *
     * @return string
     */
    public function getFreelancerFeedbackScore()
    {
        return $this->freelancerFeedbackScore;
    }

    /**
     * Set freelancerId
     *
     * @param integer $freelancerId
     *
     * @return Feedback
     */
    public function setFreelancerId($freelancerId)
    {
        $this->freelancerId = $freelancerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFreelancerId()
    {
        return $this->freelancerId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $freelancer
     *
     * @return Feedback
     */
    public function setFreelancer(User $freelancer = null)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\User
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }



    /**
     * Set clientFeedbackText
     *
     * @param string $clientFeedbackText
     *
     * @return Feedback
     */
    public function setClientFeedbackText($clientFeedbackText)
    {
        $this->clientFeedbackText = $clientFeedbackText;

        return $this;
    }

    /**
     * Get clientFeedbackText
     *
     * @return string
     */
    public function getClientFeedbackText()
    {
        return $this->clientFeedbackText;
    }

    /**
     * Set clientFeedbackScore
     *
     * @param string $clientFeedbackScore
     *
     * @return Feedback
     */
    public function setClientFeedbackScore($clientFeedbackScore)
    {
        $this->clientFeedbackScore = $clientFeedbackScore;

        return $this;
    }

    /**
     * Get clientFeedbackScore
     *
     * @return string
     */
    public function getClientFeedbackScore()
    {
        return $this->clientFeedbackScore;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     *
     * @return Feedback
     */
    public function setClientId($clientId)
    {
        $this->$clientId = $clientId;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $client
     *
     * @return Feedback
     */
    public function setClient(User $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\User
     */
    public function getClient()
    {
        return $this->client;
    }




    /**
     * Set contractId
     *
     * @param integer $contractId
     *
     * @return Feedback
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;

        return $this;
    }

    /**
     * @return int
     */
    public function getContractId()
    {
        return $this->contractId;
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

