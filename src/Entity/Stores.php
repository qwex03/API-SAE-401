<?php
// src/Entity/Stores.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Stores")
*/

class Stores {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $store_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $store_name;

    /** @var string */
    /**
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $phone;

    /** @var string */
    /**
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $email;

    /** @var string */
    /** 
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $street;

    /** @var string */
    /** 
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $city;

    /** @var string */
    /** 
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $state;

    /** @var string */
    /** 
     * @ORM\Column(type="string", nullable=true)
    */
    private ?string $zip_code;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="store_id")
     */
    private Collection $stocks;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="store_id")
     */
    private Collection $employees;

    public function __toString() {
        return "Stores {$this->store_id} {$this->store_name} {$this->phone} {$this->email} {$this->street} {$this->city} {$this->state} {$this->zip_code}";
    }

    /**
     * Get store_id
     * 
     * @return int
    */
    public function getStoreId() {
        return $this->store_id;
    }

    /**
     * Get store_name
     * 
     * @return string
    */
    public function getStoreName() {
        return $this->store_name;
    }

    /**
     * Get phone
     * 
     * @return string
    */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Get email
     * 
     * @return string
    */
    public function getEmail () {
        return $this->email;
    }

    /**
     * Get street
     * 
     * @return string
    */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Get city
     * 
     * @return string
    */
    public function getCity() {
        return $this->city;
    }

    /**
     * Get state
     * 
     * @return string
    */
    public function getState() {
        return $this->state;
    }

    /**
     * Get zip_code
     * 
     * @return string
    */
    public function getZipCode() {
        return $this->zip_code;
    }

     /**
     * Set store_name.
     * 
     * @param string $store_name
     * 
     * @return Stores
    */
    public function setStoreName($store_name) {
        $this->store_name = $store_name;
        return $this;
    }

     /**
     * Set phone.
     * 
     * @param string $phone
     * 
     * @return Stores
    */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set email.
     * 
     * @param string $email
     * 
     * @return Stores
    */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Set street.
     * 
     * @param string $street
     * 
     * @return Stores
    */
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    /**
     * Set city.
     * 
     * @param string $city
     * 
     * @return Stores
    */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Set state.
     * 
     * @param string $state
     * 
     * @return Stores
    */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Set zip_code.
     * 
     * @param string $zip_code
     * 
     * @return Stores
    */
    public function setZipCode($zip_code) {
        $this->zip_code = $zip_code;
        return $this;
    }

}
?>