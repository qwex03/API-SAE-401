<?php
// src/Entity/Products.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Brands;

/**
 * @ORM\Entity
 * @ORM\Table(name="Products")
*/
class Products {
    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $product_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $product_name;

    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="brand_id")
    */
    private Brands $brand_id;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
    */
    private $category_id;

    /** @var int */
    /**
     * @ORM\Column(type="integer")
    */
    private int $model_year;

    /** @var string */
    /**
     * @ORM\Column(type="decimal")
    */
    private string $list_price;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="product_id")
    */
    private Collection $stocks;

    /**
     * Get product_id
     * 
     * @return int
    */
    public function getProductId(){
        return $this->product_id;
    }

    /**
     * Get product_name
     * 
     * @return string
    */
    public function getProductName(){
        return $this->product_name;
    }

    /**
     * Get brand_id
     * 
     * @return int
    */
    public function getBrandId(){
        return $this->brand_id;
    }

    /**
     * Get brand_id
     * 
     * @return int
    */
    public function getCategoryId(){
        return $this->category_id;
    }

    /**
     * Get model_year
     * 
     * @return int
    */
    public function getModelYear(){
        return $this->model_year;
    }

    /**
     * Get list_price
     * 
     * @return string
    */
    public function getListPrice(){
        return $this->list_price;
    }

    /**
     * Get stocks
     * 
     * @return Stocks
    */
    public function getStocks(){
        return $this->stocks;
    }

     /**
     * Set product_name.
     * 
     * @param string $name
     * 
     * @return Products
    */
    public function setProductname($name) {
        $this->product_name = $name;
        return $this; 
    }

     /**
     * Set brand_id.
     * 
     * @param Brands $brand_id
     * 
     * @return Products
    */
    public function setBrandId($brand_id) {
        $this->brand_id = $brand_id;
        return $this; 
    }

    /**
     * Set category_id.
     * 
     * @param Categories $category_id
     * 
     * @return Products
    */
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
        return $this; 
    }

    /**
     * Set model_year.
     * 
     * @param int $model_year
     * 
     * @return Products
    */
    public function setModelYear($model_year) {
        $this->model_year = $model_year;
        return $this; 
    }

    /**
     * Set list_price.
     * 
     * @param string $list_price
     * 
     * @return Products
    */
    public function setListPrice($list_price) {
        $this->list_price = $list_price;
        return $this; 
    }
}

?>