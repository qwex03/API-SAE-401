<?php
// src/Entity/Stocks.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Stocks")
*/
Class Stocks {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $stock_id;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="stocks", cascade={"persist"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
    */
    private Stores $store_id;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="stocks", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
    */
    private Products $product_id;

    /** @var int */
    /**
     * @ORM\Column(type="integer", nullable=true)
    */
    private ?int $quantity;

    /**
     * Get stock_id
     * 
     * @return int
    */
    public function getStockId () {
        return $this->stock_id;
    }

    /**
     * Get store_id
     * 
     * @return Stores
    */
    public function getStoreId () {
        return $this->store_id;
    }

    /**
     * Get product_id
     * 
     * @return Products
    */
    public function getProductId () {
        return $this->product_id;
    }

    /**
     * Get quantity
     * 
     * @return int
    */
    public function getQuantity () {
        return $this->quantity;
    }

    /**
     * Set store_id.
     * 
     * @param Stores $store_id
     * 
     * @return Stocks
    */
    public function setStoreId ($store_id) {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * Set product_id.
     * 
     * @param Products $product_id
     * 
     * @return Stocks
    */
    public function setProductId ($product_id) {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * Set product_name.
     * 
     * @param int $quantity
     * 
     * @return Stocks
    */
    public function setQuantity ($quantity) {
        $this->quantity = $quantity;
        return $this;
    }
}
?>