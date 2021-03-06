<?php

namespace Test\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryHolder
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Test\BlogBundle\Entity\CategoryHolderRepository")
 */
class CategoryHolder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Test\BlogBundle\Entity\Categorie", mappedBy="categoryHolder")
     */
    private $categories;

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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \Test\BlogBundle\Entity\Categorie $category
     *
     * @return CategoryHolder
     */
    public function addCategory(\Test\BlogBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Test\BlogBundle\Entity\Categorie $category
     */
    public function removeCategory(\Test\BlogBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
