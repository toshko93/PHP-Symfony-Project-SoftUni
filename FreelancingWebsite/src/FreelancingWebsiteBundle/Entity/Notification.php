<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="targetLink", type="string", length=255)
     */
    private $targetLink;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FreelancingWebsiteBundle\Entity\User", inversedBy="notifications")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

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
     * Set message
     *
     * @param string $message
     *
     * @return Notification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set targetLink
     *
     * @param string $targetLink
     *
     * @return Notification
     */
    public function setTargetLink($targetLink)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get targetLink
     *
     * @return string
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Notification
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Notification
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserIdId()
    {
        return $this->userId;
    }

    /**
     * @param \FreelancingWebsiteBundle\Entity\User $user
     *
     * @return Notification
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
}

