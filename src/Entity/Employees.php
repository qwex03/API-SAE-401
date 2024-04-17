<?php
// src/Entity/Employees.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Stores;

/**
 * @ORM\Entity
 * @ORM\Table(name="Employees")
*/

class Employees {
    
    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private int $employee_id;

     /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="employees", cascade={"persist"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
    */
    private Stores $store_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $employee_name;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $employee_email;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $employee_password;

    /** @var string */
    /**
     * @ORM\Column(type="string")
    */
    private string $employee_role;

    /**
     * Get employee_id
     * 
     * @return string
    */
    public function getEmployeeId() {
        return $this->employee_id;
    }

    /**
     * Get store_id
     * 
     * @return Stores
    */
    public function getStoreId() {
        return $this->store_id;
    }

    /**
     * Get employee_name
     * 
     * @return string
    */
    public function getEmployeeName() {
        return $this->employee_name;
    }

    /**
     * Get employee_email
     * 
     * @return string
    */
    public function getEmployeeEmail() {
        return $this->employee_email;
    }

    /**
     * Get employee_password
     * 
     * @return string
    */
    public function getEmployeePass() {
        return $this->employee_password;
    }

    /**
     * Get employee_role
     * 
     * @return string
    */
    public function getEmployeeRole() {
        return $this->employee_role;
    }
    
    /**
     * Set store_id.
     * 
     * @param Stores $store_id
     * 
     * @return Employee
    */
    public function SetStoreId($store_id) {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * Set employee_name.
     * 
     * @param string $employee_name
     * 
     * @return Employee
    */
    public function SetEmployeeName($employee_name) {
        $this->employee_name = $employee_name;
        return $this;
    }

    
    /**
     * Set employee_email.
     * 
     * @param string $employee_email
     * 
     * @return Employee
    */
    public function SetEmployeeEmail($employee_email) {
        $this->employee_email = $employee_email;
        return $this;
    }

    /**
     * Set employee_password.
     * 
     * @param string $employee_password
     * 
     * @return Employee
    */
    public function SetEmployeePassword($employee_password) {
        $this->employee_password = $employee_password;
        return $this;
    }

    /**
     * Set employee_role.
     * 
     * @param string $employee_role
     * 
     * @return Employee
    */
    public function SetEmployeeRole($employee_role) {
        $this->employee_role = $employee_role;
        return $this;
    }
}