<?php
// src/Repository/EmployeesRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Entity\Employees;

class EmployeesRepository extends EntityRepository
{
    public function addEmployee($employeeData)
    {
        $employee = new Employees();
        $employee->setEmployeeName($employeeData['employee_name']);
        $employee->setStoreId($employeeData['store_id']);
        $employee->setEmployeeEmail($employeeData['employee_email']);
        $employee->setEmployeePassword($employeeData['employee_password']);
        $employee->setEmployeeRole($employeeData['employee_role']);

        $this->persist($employee);
        $this->flush();

        return $employee;
    }

    public function getAllEmployeesAsJson()
    {
        $employees = $this->findAll();
        $data = [];

        foreach ($employees as $employee) {
            $data[] = [
                'employee_id' => $employee->getId(),
                'employee_name' => $employee->getEmployeeName(),
                'store_id' => $employee->getStoreId(),
                'employee_email' => $employee->getEmployeeEmail(),
                'employee_password' => $employee->getEmployeePassword(),
                'employee_role' => $employee->getEmployeeRole()
            ];
        }

        return json_encode($data);
    }
}
?>