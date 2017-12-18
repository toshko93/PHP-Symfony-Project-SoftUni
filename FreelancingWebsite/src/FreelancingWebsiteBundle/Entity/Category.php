<?php

namespace FreelancingWebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="FreelancingWebsiteBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="category", mappedBy="parent")
     */

    private $children;
    /**
     *
     * @ORM\ManyToMany(targetEntity="category", inversedBy="children")
     * @ORM\JoinTable(name="sub_category",
     *  joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")}
     *     )
     */

    private $parent;
    /**
     * Constructor
     *
     * ArrayCollection
     */

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->parent = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

