<?php
header("Access-Control-Allow-Origin: *");	
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,X-Requested-With");

// StoresApi.php
require __DIR__ . '/bootstrap.php';

use Entity\Products;
use Entity\Employees;
use Entity\Stores;
use Entity\Stocks;
use Entity\Brands; 
use Entity\Categories;

$StocksRepository = $entityManager->getRepository(Stocks::class);
$StoreRepository = $entityManager->getRepository(Stores::class);
$ProductsRepository = $entityManager->getRepository(Products::class);
$EmployeesRepository = $entityManager->getRepository(Employees::class);
$CategorieRepository = $entityManager->getRepository(Categories::class);
$BrandRepository = $entityManager->getRepository(Brands::class);
$request_method=$_SERVER["REQUEST_METHOD"];

if ($request_method != "GET") {
    if (empty($_REQUEST["access_key"]) || $_REQUEST["access_key"] != "e8f1997c763") {
        $response = array("status" => 0, "status_message" => 'Access denied');
        echo json_encode($response);
        exit; 
    }
}

switch($request_method){
    case "GET":
    if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getProducts") {
        $p = $ProductsRepository->findAll();
        if ($p != null) {
            $responce = array();
            foreach ($p as $P) {
                $responce[]= array(
                    "id" => $P->getProductId(),
                    "name" => $P->getProductName(),
                    "brand" => $P->getBrandId()->getBrandName(),
                    "category" => $P->getCategoryId()->getCategoryName(),
                    "model year" => $P->getModelYear(),
                    "list price" => $P->getListPrice(),
                );
            }
            echo json_encode($responce);
        } else {
            $response=array("status" => 0,"status_message" =>'Products not found.');
            echo json_encode($response);
        }
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getProduct" && !empty($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        $Pid = $ProductsRepository->find($id);
        if ($Pid != null) {
            $responce[]= array(
                "id" => $Pid->getProductId(),
                "name" => $Pid->getProductName(),
                "brand" => $Pid->getBrandId()->getBrandName(),
                "category" => $Pid->getCategoryId()->getCategoryName(),
                "model year" => $Pid->getModelYear(),
                "list price" => $Pid->getListPrice(),
            );
            echo json_encode($responce);
        } else {
            $response=array("status" => 0,"status_message" =>'Product not found.');
            echo json_encode($response);
        }
    }
    else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getEmployeesByStores" && !empty($_REQUEST["id"])) {
        $store_id = $_REQUEST["id"];
        $es = $EmployeesRepository->findBy(["store_id"=>$store_id]);
        $responce = array();
        if ($es != null) {
            foreach ($es as $e) {
                $responce[]=array(
                    "name"=>$e->getEmployeeName(),
                    "email"=>$e->getEmployeeEmail(),
                    "role"=>$e->getEmployeeRole(),
                    "stores"=>$e->getStoreId()->getStoreName(),
                );
            }
            echo json_encode($responce);
        } else {
            $response=array("status" => 0,"status_message" =>'Employees not found.');
            echo json_encode($response);
        }
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getAllEmployees") {
        $allE = $EmployeesRepository->findAll();
        $responce = array();
        if ($allE != null) {
            foreach ($allE as $E) {
                $responce[]=array(
                    "name"=>$E->getEmployeeName(),
                    "email"=>$E->getEmployeeEmail(),
                    "role"=>$E->getEmployeeRole(),
                    "stores"=>$E->getStoreId()->getStoreName(),
                );
            }
            echo json_encode($responce);
        } else {
            $response=array("status" => 0,"status_message" =>'Employees not found.');
            echo json_encode($response);
        }
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getStores") {
        $allS = $StoreRepository->findAll();
        $responce = array();
        if ($allS != null) {
            foreach ($allS as $S) {
                $responce[]=array(
                    "id"=>$S->getStoreId(),
                    "name"=>$S->getStoreName(),
                    "phone"=>$S->getPhone(),
                    "email"=>$S->getEmail(),
                    "street"=>$S->getStreet(),
                    "city"=>$S->getCity(),
                    "state"=>$S->getState(),
                    "zip_code"=>$S->getZipCode()
                );
            }
            echo json_encode($responce);
        }
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getBrand") {
        $allb = $BrandRepository->findAll();
        $responce = array();
        if ($allb != null) {
            foreach ($allb as $b) {
            $responce[]=array(
                "id"=>$b->getBrandId(),
                "name"=>$b->getBrandName()
            );
            }
        }
        echo json_encode($responce);
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getCategorie") {
        $allc = $CategorieRepository->findAll();
        $responce = array();
        if ($allc != null) {
            foreach ($allc as $c) {
            $responce[]=array(
                "id"=>$c->getCategoryId(),
                "name"=>$c->getCategoryName()
            );
            }
        }
        echo json_encode($responce);
    } else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getStocks") {
        $alls = $StocksRepository->findAll();
        $responce = array();
        if ($alls != null) {
            foreach ($alls as $s) {
            $responce[]=array(
                "id"=>$s->getStockId(),
                "name"=>$s->getProductId()->getProductName(),
                "store_id"=>$s->getStoreId()->getStoreId()
            );
            }
        }
        echo json_encode($responce);
    } 
    else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getStock" && !empty($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        $stock = $StocksRepository->find($id);
        if ($stock != null) {
            $response = array(
                "id" => $stock->getStockId(),
                "product_name" => $stock->getProductId()->getProductName(),
                "store_id" => $stock->getStoreId()->getStoreId(),
                "quantity" => $stock->getQuantity()
            );
            echo json_encode($response);
        } else {
            $response = array("status" => 0, "status_message" => 'Stock not found.');
            echo json_encode($response);
        }
    }
    else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getStore" && !empty($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        $store = $StoreRepository->find($id);
        if ($store != null) {
            $response = array(
                "id" => $store->getStoreId(),
                "name" => $store->getStoreName(),
                "phone" => $store->getPhone(),
                "email" => $store->getEmail(),
                "street" => $store->getStreet(),
                "city" => $store->getCity(),
                "state" => $store->getState(),
                "zip_code" => $store->getZipCode()
            );
            echo json_encode($response);
        } else {
            $response = array("status" => 0, "status_message" => 'Store not found.');
            echo json_encode($response);
        }
    }
    else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getbrand" && !empty($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        $brand = $BrandRepository->find($id);
        if ($brand != null) {
            $response = array(
                "id" => $brand->getBrandId(),
                "name" => $brand->getBrandName()
            );
            echo json_encode($response);
        } else {
            $response = array("status" => 0, "status_message" => 'Brand not found.');
            echo json_encode($response);
        }
    }
    else if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "getCategory" && !empty($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        $category = $CategorieRepository->find($id);
        if ($category != null) {
            $response = array(
                "id" => $category->getCategoryId(),
                "name" => $category->getCategoryName()
            );
            echo json_encode($response);
        } else {
            $response = array("status" => 0, "status_message" => 'Category not found.');
            echo json_encode($response);
        }
    }
    break;
    case "POST":
        if (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addEmployee") {
            $employeeData = json_decode(file_get_contents("php://input"), true);

            $requiredFields = ['employee_name', 'employee_email', 'employee_password', 'employee_role', 'store_id'];
            foreach ($requiredFields as $field) {
                if (empty($employeeData[$field])) {
                    echo json_encode(array("success" => false, "message" => "Error: Field '$field' is required."));
                    return;  
                }
            }
            
            $store = $StoreRepository->find($employeeData["store_id"]);
            if (!$store) {
                echo json_encode(array("success" => false, "message" => "Error: Store not found."));
                return;  
            }
            
            $employee = new Employees();
            $employee->setEmployeeName($employeeData['employee_name']);
            $employee->setStoreId($store);
            $employee->setEmployeeEmail($employeeData['employee_email']);
            $employee->setEmployeePassword($employeeData['employee_password']);
            $employee->setEmployeeRole($employeeData['employee_role']);
            
            $entityManager->persist($employee);
            $entityManager->flush();
            
            $response = array("success" => true, "message" => "Employee added successfully");
            echo json_encode($response);
            
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addEmployeeBystore" && !empty($_REQUEST["id"])) {
            $employeeData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            if (
                empty($employeeData['employee_name']) ||
                empty($employeeData['employee_email']) ||
                empty($employeeData['employee_password']) ||
                empty($employeeData['employee_role']) ||
                empty($id)
            ) {
                $response = array("success" => false, "message" => "Missing required data");
                echo json_encode($response);
                exit;
            }
            $store = $entityManager->getRepository(Stores::class)->find($id);
            if (!$store) {
                $response = array("success" => false, "message" => "Store not found");
                echo json_encode($response);
                exit;
            }
            $employee = new Employees();
            $employee->setEmployeeName($employeeData['employee_name']);
            $employee->setStoreId($store);
            $employee->setEmployeeEmail($employeeData['employee_email']);
            $employee->setEmployeePassword($employeeData['employee_password']);
            $employee->setEmployeeRole($employeeData['employee_role']);
            $entityManager->persist($employee);
            $entityManager->flush();
            $response = array("success" => true, "message" => "Employee added successfully");
            echo json_encode($response);
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addBrand") {
            $brandData = json_decode(file_get_contents("php://input"), true);
            if (empty($brandData['brand_name'])) {
                $response = array("success" => false, "message" => "Missing required data");
                echo json_encode($response);
                exit;
            }
            $brand = new Brands();
            $brand->setBrandName($brandData["brand_name"]);
            $entityManager->persist($brand);
            $entityManager->flush();
            $response = array("success" => true, "message" => "Brand added successfully");
            echo json_encode($response);
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addCategorie") {
            $categorieData = json_decode(file_get_contents("php://input"), true);
            if (!empty($categorieData["category_name"])) {
                $categorie = new Categories();
                $categorie->setCategoriesName($categorieData["category_name"]);
                $entityManager->persist($categorie);
                $entityManager->flush();
                $response = array("success" => true, "message" => "Categorie added successfully");
                echo json_encode($response);
            } else {
                $response=array("status" => 0,"status_message" =>'some data are not set');
                echo json_encode($response);
            }
            
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addProducts") {
            $productData = json_decode(file_get_contents("php://input"), true);
            if (
                empty($productData['brand_id']) ||
                empty($productData['categorie_id']) ||
                empty($productData['product_name']) ||
                empty($productData['model_year']) ||
                empty($productData['list_price'])
            ) {
                $response = array("success" => false, "message" => "Missing required data");
                echo json_encode($response);
                exit;
            }
            $brand = $BrandRepository->find($productData["brand_id"]);
            $categorie = $CategorieRepository->find($productData["categorie_id"]);
            if (!$brand || !$categorie) {
                $response = array("success" => false, "message" => "Brand or category not found");
                echo json_encode($response);
                exit;
            }
            $product = new Products();
            $product->setProductname($productData["product_name"]);
            $product->setBrandId($brand);
            $product->setCategoryId($categorie);
            $product->setModelYear($productData["model_year"]);
            $product->setListPrice($productData["list_price"]);
            $entityManager->persist($product);
            $entityManager->flush();
            $response = array("success" => true, "message" => "Product added successfully");
            echo json_encode($response);
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addStores") {
            $storeData = json_decode(file_get_contents("php://input"), true);
            if (
                empty($storeData['store_name']) ||
                empty($storeData['phone']) ||
                empty($storeData['email']) ||
                empty($storeData['street']) ||
                empty($storeData['city']) ||
                empty($storeData['state']) ||
                empty($storeData['zip_code'])
            ) {
                $response = array("success" => false, "message" => "Missing required data");
                echo json_encode($response);
                exit;
            }
            $store = new Stores();
            $store->setStoreName($storeData["store_name"]);
            $store->setPhone($storeData["phone"]);
            $store->setEmail($storeData["email"]);
            $store->setStreet($storeData["street"]);
            $store->setCity($storeData["city"]);
            $store->setState($storeData["state"]);
            $store->setZipCode($storeData["zip_code"]);
            $entityManager->persist($store);
            $entityManager->flush();
            $response = array("success" => true, "message" => "Store added successfully");
            echo json_encode($response);
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "addStocks") {
            $stockData = json_decode(file_get_contents("php://input"), true);
            $product = $ProductsRepository->find($stockData["product_id"]);
            $store = $StoreRepository->find($stockData["store_id"]);

            if (empty($stockData["product_id"]) || empty($stockData["store_id"]) || empty($stockData["quantity"])) {
                $response=array("status" => 0,"status_message" =>'some data are not set');
                echo json_encode($response);
            }
            $stock = new Stocks();
            $stock->setProductId($product);
            $stock->setStoreId($store);
            $stock->setQuantity($stockData["quantity"]);
            $entityManager->persist($stock);
            $entityManager->flush();
            $response = array("success" => true, "message" => "Stocks added successfully");
            echo json_encode($response);
        } elseif (!empty($_REQUEST["action"]) && $_REQUEST["action"] == "login") {
            $requestData = json_decode(file_get_contents("php://input"), true);
            $email = $requestData['email'];
            $password = $requestData['password'];
            $employee = $EmployeesRepository->findOneBy(['employee_email' => $email, 'employee_password' => $password]);
            if ($employee) {
                $storeId = $employee->getStoreId()->getStoreId();
                $employeeRole = $employee->getEmployeeRole();
                $employeeId = $employee->getEmployeeId();
        
                $response = array("success" => true, "employee_role" => $employeeRole, "store_id" => $storeId, "employee_id" => $employeeId);
                echo json_encode($response);
            } else {
                $response = array("error" => false, "message" => "Email ou mot de passe incorrect");
                echo json_encode($response);
            }
        }
    break;
    case "DELETE":
            if ($_REQUEST["action"] == "deleteProducts" && !empty($_REQUEST["id"])) {
                $id = $_REQUEST["id"];
                $product = $ProductsRepository->find($id);

                if ($product == null) {
                    echo json_encode(["status" => "failed", "message" => "Product not found"]);
                } else {
                    try {
                        $entityManager->remove($product);
                        $entityManager->flush();
                        echo json_encode(["status" => "success", "message" => "Product delete"]);
                    } catch (\Exception $e) {
                        echo json_encode(["status" => "failed", "message" => "Failed to delete product"]);
                    }
                }
            } elseif ($_REQUEST["action"] == "deleteBrand" && !empty($_REQUEST["id"])) {
                $id = $_REQUEST["id"];
                $brand = $BrandRepository->find($id);

                if ($brand == null) {
                    echo json_encode(["status" => "failed", "message" => "Brand not found"]);
                } else {
                    $products = $ProductsRepository->findBy(["brand_id" => $brand]);
                    if (!empty($products)) {
                        echo json_encode(["status" => "failed", "message" => "Cannot delete brand as it is associated with products"]);
                    } else {
                        try {
                            $entityManager->remove($brand);
                            $entityManager->flush();
                            echo json_encode(["status" => "success", "message" => "Brand delete"]);
                        } catch (\Exception $e) {
                            echo json_encode(["status" => "failed", "message" => "Failed to delete brand"]);
                        }
                    }
                }
            } elseif ($_REQUEST["action"] == "deleteCategorie" && !empty($_REQUEST["id"])) {
                $id = $_REQUEST["id"];
                $categorie = $CategorieRepository->find($id);
            
                if ($categorie == null) {
                    echo json_encode(["status" => "failed", "message" => "Category not found"]);
                } else {
                    $products = $ProductsRepository->findBy(["category_id" => $categorie]);
                    if (!empty($products)) {
                        echo json_encode(["status" => "failed", "message" => "Cannot delete category as it is associated with products"]);
                    } else {
                        try {
                            $entityManager->remove($categorie);
                            $entityManager->flush();
                            echo json_encode(["status" => "success", "message" => "Category delete"]);
                        } catch (\Exception $e) {
                            echo json_encode(["status" => "failed", "message" => "Failed to delete category"]);
                        }
                    }
                }
            } elseif ($_REQUEST["action"] == "deleteStores" && !empty($_REQUEST["id"])) {
                $id = $_REQUEST["id"];
                $store = $StoreRepository->find($id);
            
                if ($store == null) {
                    echo json_encode(["status" => "failed", "message" => "Store not found"]);
                } else {
                    try {
                        $entityManager->remove($store);
                        $entityManager->flush();
                        echo json_encode(["status" => "success", "message" => "Store delete"]);
                    } catch (\Exception $e) {
                        echo json_encode(["status" => "failed", "message" => "Failed to delete store"]);
                    }
                }
            } elseif ($_REQUEST["action"] == "deleteStocks" && !empty($_REQUEST["id"])) {
                $id = $_REQUEST["id"];
                $stock = $StocksRepository->find($id);
            
                if ($stock == null) {
                    echo json_encode(["status" => "failed", "message" => "Stock not found"]);
                } else {
                    try {
                        $entityManager->remove($stock);
                        $entityManager->flush();
                        echo json_encode(["status" => "success", "message" => "Stock delete"]);
                    } catch (\Exception $e) {
                        echo json_encode(["status" => "failed", "message" => "Failed to delete stock"]);
                    }
                }
        }    
    break;
    case "PUT":
        if ($_REQUEST["action"] == "ModifyProduct" && !empty($_REQUEST["id"])) {
            $productData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $p = $ProductsRepository->find($id);
            $brand = $BrandRepository->find($productData["brand_id"]);
            $categorie = $CategorieRepository->find($productData["categorie_id"]);
            $p->setProductname($productData["product_name"]);
            $p->setBrandId($brand);
            $p->setCategoryId($categorie);
            $p->setModelYear($productData["model_year"]);
            $p->setListPrice($productData["list_price"]);
            $entityManager->persist($p);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if  ($_REQUEST["action"] == "ModifyLogin" && !empty($_REQUEST["id"])) {
            $employeeData  = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $e = $EmployeesRepository->find($id);
            $e->setEmployeeEmail($employeeData["employee_email"]);
            $e->setEmployeePassword($employeeData["employee_password"]);
            $entityManager->persist($e);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if  ($_REQUEST["action"] == "ModifyBrand" && !empty($_REQUEST["id"])) {
            $brandData  = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $b = $BrandRepository->find($id);
            $b->setBrandName($brandData["brand_name"]);
            $entityManager->persist($b);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if ($_REQUEST["action"] == "ModifyCategory" && !empty($_REQUEST["id"])) {
            $categoryData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $c = $CategorieRepository->find($id);
            $c->setCategoriesName($categoryData["category_name"]);
            $entityManager->persist($c);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if ($_REQUEST["action"] == "ModifyStores" && !empty($_REQUEST["id"])) {
            $storeData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $s = $StoreRepository->find($id);
            $s->setStoreName($storeData["store_name"]);
            $s->setPhone($storeData["phone"]);
            $s->setEmail($storeData["email"]);
            $s->setStreet($storeData["street"]);
            $s->setCity($storeData["city"]);
            $s->setState($storeData["state"]);
            $s->setZipCode($storeData["zip_code"]);
            $entityManager->persist($s);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if ($_REQUEST["action"] == "ModifyLogin" && !empty($_REQUEST["id"])) {
            $loginData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $l = $EmployeesRepository->find($id);
            $s->SetEmployeeEmail($loginData["employee_email"]);
            $s->SetEmployeePassword($loginData["employee_password"]);
            $entityManager->persist($l);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        } else if ($_REQUEST["action"] == "ModifyStocks" && !empty($_REQUEST["id"])) {
            $stockData = json_decode(file_get_contents("php://input"), true);
            $id = $_REQUEST["id"];
            $s = $StocksRepository->find($id);
            $s->setQuantity($stockData["quantity"]);
            $entityManager->persist($s);
            $entityManager->flush();
            echo json_encode(["status" => "success"]);
        }
    
    break;
}