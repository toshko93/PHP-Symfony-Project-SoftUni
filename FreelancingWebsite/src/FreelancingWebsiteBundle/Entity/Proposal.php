<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposal
 *
 * @ORM\Table(name="proposals")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\ProposalRepository")
 */
class Proposal
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
     * @var int
     *
     * @ORM\Column(name="jobPostId", type="integer")
     */
    private $jobPostId;

    /**
     * @var JobPost
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\JobPost", inversedBy="proposals")
     * @ORM\JoinColumn(name="jobPostId", referencedColumnName="id")
     */
    private $jobPost;

    /**
     * @var string
     *
     * @ORM\Column(name="coverLetter", type="text")
     */
    private $coverLetter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="proposedPrice", type="decimal", precision=7, scale=2)
     */
    private $proposedPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="freelancerId", type="integer")
     */
    private $freelancerId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="proposals")
     * @ORM\JoinColumn(name="freelancerId", referencedColumnName="id")
     */
    private $freelancer;

    /**
     * Proposal constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
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
     * @param \FreelancingWebsiteBundle\Entity\JobPost $client
     *
     * @return Proposal
     */
    public function setJobPostId(User $jobPostId)
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
     * Set coverLetter
     *
     * @param string $coverLetter
     *
     * @return Proposal
     */
    public function setCoverLetter($coverLetter)
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

    /**
     * Get coverLetter
     *
     * @return string
     */
    public function getCoverLetter()
    {
        return $this->coverLetter;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Proposal
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set proposedPrice
     *
     * @param string $proposedPrice
     *
     * @return Proposal
     */
    public function setProposedPrice($proposedPrice)
    {
        $this->proposedPrice = $proposedPrice;

        return $this;
    }

    /**
     * Get proposedPrice
     *
     * @return string
     */
    public function getProposedPrice()
    {
        return $this->proposedPrice;
    }

    /**
     * Set freelancerId
     *
     * @param integer $freelancerId
     *
     * @return Proposal
     */
    public function setClientId($freelancerId)
    {
        $this->freelancerId = $freelancerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->freelancerId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $client
     *
     * @return Proposal
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
     * @param \FreelancingWebsiteBundle\Entity\JobPost $jobPost
     *
     * @return Proposal
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
}

