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

    /**
     * @var string
     *
     * @ORM\Column(name="feedbackToFreelancer", type="string", length=255, nullable=true)
     */
    private $feedbackToFreelancer;

    /**
     * @var string
     *
     * @ORM\Column(name="feedbackToClient", type="string", length=255, nullable=true)
     */
    private $feedbackToClient;

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
     * Contract constructor.
     */
    public function __construct()
    {
        $this->sumPaid = 0.00;
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

    /**
     * Set feedbackToFreelancer
     *
     * @param string $feedbackToFreelancer
     *
     * @return Contract
     */
    public function setFeedbackToFreelancer($feedbackToFreelancer)
    {
        $this->feedbackToFreelancer = $feedbackToFreelancer;

        return $this;
    }

    /**
     * Get feedbackToFreelancer
     *
     * @return string
     */
    public function getFeedbackToFreelancer()
    {
        return $this->feedbackToFreelancer;
    }

    /**
     * Set feedbackToClient
     *
     * @param string $feedbackToClient
     *
     * @return Contract
     */
    public function setFeedbackToClient($feedbackToClient)
    {
        $this->feedbackToClient = $feedbackToClient;

        return $this;
    }

    /**
     * Get feedbackToClient
     *
     * @return string
     */
    public function getFeedbackToClient()
    {
        return $this->feedbackToClient;
    }

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
}

