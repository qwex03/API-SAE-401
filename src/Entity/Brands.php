<?php
// src/Entity/Brands.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Products;

/**
 * @ORM\Entity
 * @ORM\Table(name="Brands")
*/

Class Brands {
    
    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $brand_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $brand_name;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="brand_id")
     */
    private Collection $products;

    public function __toString(){
        return "Brands {$this->brand_id} {$this->brand_name}";
    }

    /**
     * Get brand_id.
     * 
     * @return int
     */
    public function getBrandId() {
        return $this->brand_id;
    }

    /**
     * Get brand_name
     * 
     * @return string
     */
    public function getBrandName() {
        return $this->brand_name;
    }

    /**
     * Get products
     * 
     * @return Collection
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * Set brand_name.
     * 
     * @param string $brand_name
     * 
     * @return Brands
    */
    public function setBrandName($brand_name){
        $this->brand_name=$brand_name;
        return $this;
    }
}