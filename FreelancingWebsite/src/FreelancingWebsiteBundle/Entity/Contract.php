<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Contract
 *
 * @ORM\Table(name="contracts")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\ContractRepository")
 */
class Contract
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
     * @ORM\Column(name="sumAgreed", type="decimal", precision=7, scale=2)
     */
    private $sumAgreed;

    /**
     * @var string
     *
     * @ORM\Column(name="sumPaid", type="decimal", precision=7, scale=2)
     */
    private $sumPaid;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="feedbackToFreelancer", type="string", length=255, nullable=true)
//     */
//    private $feedbackToFreelancer;
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="feedbackToClient", type="string", length=255, nullable=true)
//     */
//    private $feedbackToClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_requested_payment", type="boolean")
     */
    private $isRequestedPayment;

    /**
     * @var int
     *
     * @ORM\Column(name="jobPostId", type="integer")
     */
    private $jobPostId;

    /**
     * @var JobPost
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\JobPost", inversedBy="contract")
     * @ORM\JoinColumn(name="jobPostId", referencedColumnName="id")
     */
    private $jobPost;

    /**
     * @var int
     *
     * @ORM\Column(name="proposalId", type="integer")
     */
    private $proposalId;

    /**
     * @var Proposal
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Proposal", inversedBy="contract")
     * @ORM\JoinColumn(name="proposalId", referencedColumnName="id")
     */
    private $proposal;

    /**
     * @var int
     *
     * @ORM\Column(name="clientId", type="integer")
     */
    private $clientId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="contractsAsClient")
     * @ORM\JoinColumn(name="clientId", referencedColumnName="id")
     */
    private $client;

    /**
     * @var int
     *
     * @ORM\Column(name="freelacerId", type="integer")
     */
    private $freelacerId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="contractsAsFreelancer")
     * @ORM\JoinColumn(name="freelacerId", referencedColumnName="id")
     */
    private $freelacer;

    /**
     * @var int
     *
     * @ORM\Column(name="freelancerFeedbackId", type="integer")
     */
    private $freelancerFeedbackId;

    /**
     * @var Feedback
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Feedback", inversedBy="contract")
     * @ORM\JoinColumn(name="freelancerFeedbackId", referencedColumnName="id")
     */
    private $freelancerFeedback;

    /**
     * @var int
     *
     * @ORM\Column(name="clientFeedbackId", type="integer")
     */
    private $clientFeedbackId;

    /**
     * @var Feedback
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Feedback", inversedBy="contract")
     * @ORM\JoinColumn(name="clientFeedbackId", referencedColumnName="id")
     */
    private $clientFeedback;

    /**
     * Contract constructor.
     */
    public function __construct()
    {
        $this->sumPaid = 0.00;
        $this->isRequestedPayment = false;
        $this->startDate = new \DateTime('now');
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
     * Set sumAgreed
     *
     * @param string $sumAgreed
     *
     * @return Contract
     */
    public function setSumAgreed($sumAgreed)
    {
        $this->sumAgreed = $sumAgreed;

        return $this;
    }

    /**
     * Get sumAgreed
     *
     * @return string
     */
    public function getSumAgreed()
    {
        return $this->sumAgreed;
    }

    /**
     * Set sumPaid
     *
     * @param string $sumPaid
     *
     * @return Contract
     */
    public function setSumPaid($sumPaid)
    {
        $this->sumPaid = $sumPaid;

        return $this;
    }

    /**
     * Get sumPaid
     *
     * @return string
     */
    public function getSumPaid()
    {
        return $this->sumPaid;
    }

//    /**
//     * Set feedbackToFreelancer
//     *
//     * @param string $feedbackToFreelancer
//     *
//     * @return Contract
//     */
//    public function setFeedbackToFreelancer($feedbackToFreelancer)
//    {
//        $this->feedbackToFreelancer = $feedbackToFreelancer;
//
//        return $this;
//    }
//
//    /**
//     * Get feedbackToFreelancer
//     *
//     * @return string
//     */
//    public function getFeedbackToFreelancer()
//    {
//        return $this->feedbackToFreelancer;
//    }
//
//    /**
//     * Set feedbackToClient
//     *
//     * @param string $feedbackToClient
//     *
//     * @return Contract
//     */
//    public function setFeedbackToClient($feedbackToClient)
//    {
//        $this->feedbackToClient = $feedbackToClient;
//
//        return $this;
//    }
//
//    /**
//     * Get feedbackToClient
//     *
//     * @return string
//     */
//    public function getFeedbackToClient()
//    {
//        return $this->feedbackToClient;
//    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Contract
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Contract
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set isRequestedPayment
     *
     * @return Contract
     */
    public function setIsRequestedPayment(bool $isRequestedPayment)
    {
        $this->isRequestedPayment = $isRequestedPayment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsRequestedPayment()
    {
        return $this->isRequestedPayment;
    }

    /**
     * @param integer $jobPostId
     *
     * @return Contract
     */
    public function setJobPostId(int $jobPostId)
    {
        $this->jobPostId = $jobPostId;

        return $this;
    }

    /**
     * @return int
     */
    public function getJobPostId()
    {
        return $this->jobPostId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\JobPost $jobPost
     *
     * @return Contract
     */

    public function setJobPost(JobPost $jobPost = null)
    {
        $this->jobPost = $jobPost;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\JobPost
     */
    public function getJobPost()
    {
        return $this->jobPost;
    }


    /**
     * @param integer $proposalId
     *
     * @return Contract
     */
    public function setProposalId(int $proposalId)
    {
        $this->proposalId = $proposalId;

        return $this;
    }

    /**
     * @return int
     */
    public function getProposalId()
    {
        return $this->proposalId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\Proposal $proposal
     *
     * @return Contract
     */

    public function setProposal(Proposal $proposal = null)
    {
        $this->proposal = $proposal;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\Proposal
     */
    public function getProposal()
    {
        return $this->proposal;
    }

    /**
     * @param integer $freelancerFeedbackId
     *
     * @return Contract
     */
    public function setFreelancerFeedbackId(int $freelancerFeedbackId)
    {
        $this->freelancerFeedbackId = $freelancerFeedbackId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFreelancerFeedbackId()
    {
        return $this->freelancerFeedbackId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\Feedback $freelancerFeedback
     *
     * @return Contract
     */

    public function setFreelancerFeedback(Feedback $freelancerFeedback = null)
    {
        $this->freelancerFeedback = $freelancerFeedback;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\Feedback
     */
    public function getFreelancerFeedback()
    {
        return $this->freelancerFeedback;
    }

    /**
     * @param integer $clientFeedbackId
     *
     * @return Contract
     */
    public function setClientFeedbackId(int $clientFeedbackId)
    {
        $this->clientFeedbackId = $clientFeedbackId;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientFeedbackId()
    {
        return $this->clientFeedbackId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\Feedback $clientFeedback
     *
     * @return Contract
     */

    public function setClientFeedback(Feedback $clientFeedback = null)
    {
        $this->clientFeedback = $clientFeedback;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\Feedback
     */
    public function getClientFeedback()
    {
        return $this->clientFeedback;
    }



    /**
     * @param int $clientId
     *
     * @return Contract
     */
    public function setClientId(int $clientId)
    {
        $this->clientId = $clientId;

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
     * @param int $freelancerId
     *
     * @return Contract
     */
    public function setFreelancerId($freelancerId)
    {
        $this->freelacerId = $freelancerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFreelancerId()
    {
        return $this->freelacerId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $freelancer
     */
    public function setFreelancer(User $freelancer = null)
    {
        $this->freelacer = $freelancer;

        return $this;
    }

    /**
     * @return \FreelancingWebsiteBundle\Entity\User
     */
    public function getFreelancer()
    {
        return $this->freelacer;
    }
}

