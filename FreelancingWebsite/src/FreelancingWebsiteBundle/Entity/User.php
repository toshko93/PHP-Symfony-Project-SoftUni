<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRegistered", type="datetime")
     */
    private $dateRegistered;

    /**
     * @var string
     *
     * @ORM\Column(name="money_balance", type="decimal", precision=10, scale=2)
     */
    private $moneyBalance;

    /**
     * @var string
     *
     * @ORM\Column(name="money_earned", type="decimal", precision=10, scale=2)
     */
    private $moneyEarned;

    /**
     * @var string
     *
     * @ORM\Column(name="money_spent", type="decimal", precision=10, scale=2)
     */
    private $moneySpent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\JobPost", mappedBy="client")
     */
    private $jobPosts;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Proposal", mappedBy="freelancer")
     */
    private $proposals;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="FreelancingWebsiteBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")})
     */
    private $roles;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Contract", mappedBy="client")
     */
    private $contractsAsClient;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Contract", mappedBy="freelancer")
     */
    private $contractsAsFreelancer;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Feedback", mappedBy="freelancer")
     */
    private $feedbacksAsFreelancer;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Feedback", mappedBy="client")
     */
    private $feedbacksAsClient;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FreelancingWebsiteBundle\Entity\Notification", mappedBy="user")
     */
    private $notifications;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->dateRegistered = new \DateTime('now');
        $this->moneyEarned = 0;
        $this->moneySpent = 0;
        $this->moneyBalance = 100;
        $this->jobPosts = new ArrayCollection();
        $this->proposals = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->contractsAsClient = new ArrayCollection();
        $this->contractsAsFreelancer = new ArrayCollection();
        $this->feedbacksAsClient = new ArrayCollection();
        $this->feedbacksAsFreelancer = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateRegistered;
    }

    /**
     * Set moneyBalance
     *
     * @param string $moneyBalance
     *
     * @return User
     */
    public function setMoneyBalance($moneyBalance)
    {
        $this->moneyBalance = $moneyBalance;

        return $this;
    }

    /**
     * Get moneyBalance
     *
     * @return string
     */
    public function getMoneyBalance()
    {
        return $this->moneyBalance;
    }

    /**
     * Set moneySpent
     *
     * @param string $moneySpent
     *
     * @return User
     */
    public function setMoneySpent($moneySpent)
    {
        $this->moneySpent = $moneySpent;

        return $this;
    }

    /**
     * Get moneySpent
     *
     * @return string
     */
    public function getMoneySpent()
    {
        return $this->moneySpent;
    }

    /**
     * Set moneyEarned
     *
     * @param string $moneyEarned
     *
     * @return User
     */
    public function setMoneyEarned($moneyEarned)
    {
        $this->moneyEarned = $moneyEarned;

        return $this;
    }

    /**
     * Get moneyEarned
     *
     * @return string
     */
    public function getMoneyEarned()
    {
        return $this->moneyEarned;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobPosts()
    {
        return $this->jobPosts;
    }

    /**
     * @param JobPost $jobPost
     *
     * @return User
     */
    public function addJobPost(JobPost $jobPost)
    {
        $this->jobPosts[] = $jobPost;

        return $this;
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
     * @return User
     */
    public function addProposal(Proposal $proposal)
    {
        $this->proposals[] = $proposal;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];

        foreach ($this->roles as $role)
        {
            /** @var $role Role */
            $stringRoles[] = $role->getRole();
        }

        return $stringRoles;
    }

    /**
     * @param Role $role
     *
     * @return  User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    public function hasRole($inputStringRole)
    {
        $userRoles = $this->getRoles();

        foreach ($userRoles as $role) {
            if ($role == $inputStringRole) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }

    /**
     * @param Feedback $feedback
     *
     * @return User
     */
    public function addFeedback(Feedback $feedback)
    {
        $this->feedbacks[] = $feedback;

        return $this;
    }

    /**
     * @param JobPost $jobPost
     *
     * @return bool
     */
    public function isJobPostAuthor(JobPost $jobPost)
    {
        return $jobPost->getClientId() == $this->getId();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array('ROLE_ADMIN', $this->getRoles());
    }




    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

