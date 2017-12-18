<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * JobPost
 *
 * @ORM\Table(name="job_posts")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\JobPostRepository")
 */
class JobPost
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
     * @ORM\Column(name="jobTitle", type="string", length=255)
     */
    private $jobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="jobDescription", type="text")
     */
    private $jobDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="clientBudget", type="decimal", precision=7, scale=2)
     */
    private $clientBudget;

    /**
     * @var int
     *
     * @ORM\Column(name="clientId", type="integer")
     */
    private $clientId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="jobPosts")
     * @ORM\JoinColumn(name="clientId", referencedColumnName="id")
     */
    private $client;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Proposal", mappedBy="jobPost")
     */
    private $proposals;

    /**
     * @var Contract
     *
     * @ORM\OneToOne(targetEntity="FreelancingWebsiteBundle\Entity\Contract", mappedBy="jobPost")
     */
    private $contract;

    /**
     * JobPost constructor.
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
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return JobPost
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set jobDescription
     *
     * @param string $jobDescription
     *
     * @return JobPost
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    /**
     * Get jobDescription
     *
     * @return string
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return JobPost
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
     * Set clientBudget
     *
     * @param string $clientBudget
     *
     * @return JobPost
     */
    public function setClientBudget($clientBudget)
    {
        $this->clientBudget = $clientBudget;

        return $this;
    }

    /**
     * Get clientBudget
     *
     * @return string
     */
    public function getClientBudget()
    {
        return $this->clientBudget;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     *
     * @return JobPost
     */
    public function setClientId($clientId)
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
     *
     * @return JobPost
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }

    /**
     * @param Proposal $proposal
     *
     * @return JobPost
     */
    public function addProposal(Proposal $proposal)
    {
        $this->proposals[] = $proposal;

        return $this;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\Contract $contract
     *
     * @return JobPost
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

