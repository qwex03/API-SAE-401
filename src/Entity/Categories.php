<?php
// src/Entity/Categories.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Products;

/**
 * @ORM\Entity
 * @ORM\Table(name="Categories")
*/

Class Categories{
    
    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $category_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $category_name;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="category_id")
    */
    private Collection $products;

    public function __toString(){
        return "Category {$this->category_id} {$this->category_name} {$this->products}";
    }

    /**
     * Get category_id.
     * 
     * @return int
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Get category_name.
     * 
     * @return string
     */
    public function getCategoryName() {
        return $this->category_name;
    }

    /**
     * Get products.
     * 
     * @return Collection
    */
    public function getProducts() {
        return $this->products;
    }

    
    /**
     * Set category_name.
     * 
     * @param string $category_name
     * 
     * @return Categories
     */
    public function setCategoriesName($category_name){
        $this->category_name=$category_name;
        return $this;
    }
}
?>