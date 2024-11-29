<?php
include_once "dataAccess.php";
include_once "functions.php";

$function = new Functions();

if($function->check_POST_Method()){
$dataAccess = new DataAccess();
    if (isset($_POST["sign-up"])){

        if (
        $function->check_File_Not_Empty() &&
        $function->check_File_Upload_No_Error() &&
        $function->check_Valid_File_Size() &&
        $function->check_Valid_File_Type()) {
            
            $file_name = $function->rename_File("profile", "new_file", " ");
            $destination = $function->create_File_Destination("profile", $file_name);
            
            if ($function->no_Duplication($destination) == false){
                $destination = $function->rename_File("profile", "duplicate_file", $destination);
            }

           

            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"]; 

            if (!empty($dataAccess->retrieve_User_By_Email($email))){
                exit("An account with this email already exist.");
            }else{

                if (session_status() !== PHP_SESSION_ACTIVE){
                    session_start();
                }
                
                $_SESSION["username"] = $dataAccess->create_User($username, $email, $password, $destination);
            }

            $function->move_File($destination);

            // echo $username;
            // echo $email;
            // echo $password;
            // echo $destination;

            header("Location: /ZNH ASSIGNMENT/views/index.php?status=loggedin");
            exit();

            // setcookie("name", $username, time() + 86400);

            
            
        } else{
            if ($function->check_File_Not_Empty() == false) {
                echo "Error: The uploaded file is empty.";
            } elseif ($function->check_File_Upload_No_Error() == false) {
                echo "Error: There was an error during file upload.";
            } elseif ($function->check_Valid_File_Size() == false) {
                echo "Error: The uploaded file size is invalid or exceeds the limit.";
            } elseif ($function->check_Valid_File_Type() == false) {
                echo "Error: The uploaded file type is not allowed.";
            } else {
                echo "Unknown Error Occurred";
            }
        }
        
    }
        
    if (isset($_POST["login"])){
    

        $email = $_POST["email"];
        $password = $_POST["password"];   

        $login_data = $dataAccess->log_In($email,$password);

        if(!empty($login_data && $login_data !== "NO USER WITH THIS NAME/EMAIL FOUND!")){
    
            //print_r($login_data["USERNAME"]);
            //Start the session if not already started    
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
                try {
                $_SESSION["username"] = $login_data["USERNAME"];
                $_SESSION["user_id"] = $login_data["ID"];
                }catch(Error $e){
                    header("Location: /ZNH ASSIGNMENT/views/login.php?error=login_failed");
                    exit();
                }
                if($login_data["ROLE"]===1){
                    $_SESSION["user_role"] = "ADMIN";
                    
                }

            }
        
            header("Location: /ZNH ASSIGNMENT/views/index.php?status=loggedin");
            exit();

        }else{
            header("Location: /ZNH ASSIGNMENT/views/login.php?error=login_failed");
            exit();
        }
    }

    if (isset($_POST["list-product"])){

        if ($function->check_File_Not_Empty() &&
            $function->check_File_Upload_No_Error() &&
            $function->check_Valid_File_Size() &&
            $function->check_Valid_File_Type()) {
                
                $file_name = $function->rename_File("product", "new_file", " ");
                $destination = $function->create_File_Destination("product", $file_name);
                
                if ($function->no_Duplication($destination) == false){
                    $destination = $function->rename_File("product", "duplicate_file", $destination);
                }

                

                $product_name = $_POST["product_name"];
                $product_price = $_POST["product_price"];
                $product_category = $_POST["product_category"]; 
                $product_status = $_POST["product_status"]; 
                $product_description = $_POST["product_description"]; 


                if (!empty($dataAccess->retrieve_Product($product_name))){
                    exit("Product with this name already exist.");
                }else{
                    if (session_status() !== PHP_SESSION_ACTIVE){
                        session_start();
                    }
                    $product_creation_status = $dataAccess->create_Product($product_name, $product_price, $product_category, $product_status, $product_description, $_SESSION["username"], $destination);
                }

                $function->move_File($destination);

                header("Location: /ZNH ASSIGNMENT/views/index.php?product_listed");
                exit();
        }else{
            if ($function->check_File_Not_Empty() == false) {
                echo "Error: The uploaded file is empty.";
            } elseif ($function->check_File_Upload_No_Error() == false) {
                echo "Error: There was an error during file upload.";
            } elseif ($function->check_Valid_File_Size() == false) {
                echo "Error: The uploaded file size is invalid or exceeds the limit.";
            } elseif ($function->check_Valid_File_Type() == false) {
                echo "Error: The uploaded file type is not allowed.";
            } else {
                echo "Unknown Error Occurred";
            }
        }
    }
    
    if (isset($_POST["logout"])){
        if (session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        session_unset();
        header("Location: /ZNH ASSIGNMENT/views/index.php?loggedout");
            exit();
    }

    if (isset($_POST["remove_item"])) {
        // Start the session if it is not already active
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    
        // Get the product ID from the POST data
        $product_id = $_POST["product_id"];
    
        // Check if the product ID exists in the session cart
        if (isset($_SESSION['cart'][$product_id])) {
            // Remove the product from the cart
            unset($_SESSION['cart'][$product_id]);
        }
    
        // Redirect back to the checkout page with a success flag
        header("Location: /ZNH ASSIGNMENT/views/checkout.php?removed");
        exit();
    }

    if (isset($_POST["order"])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        unset($_SESSION['cart']);

        header("Location: /ZNH ASSIGNMENT/views/checkout.php?status=ordered");
        exit();
    }

    if (isset($_POST["search"])){
        $query = $_POST["query"];
        
    }

    if (isset($_POST["change"])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $field = $_POST["field"];
        $value = $_POST["value"];
        $username = $_SESSION["username"];

        $result = $dataAccess->update_User($username, $field, $value);

        if ($result){

            if ($field==="USERNAME"){
                $_SESSION["username"]=$value;
            }
            header("Location: /ZNH ASSIGNMENT/views/user_details.php?status=success");
            exit();
        }else{
            header("Location: /ZNH ASSIGNMENT/views/user_details.php?status=failed");
            exit();
        }
    }

    if (isset($_POST["delete"])){
        if (session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        echo $name = $_SESSION["username"];
        
        $status = $dataAccess->delete_User($name);
        
        if($status){
            
            session_unset();
            header("Location: /ZNH ASSIGNMENT/views/index.php?loggedout");
                exit();
        }else{
            header("Location: /ZNH ASSIGNMENT/views/user_details.php?status=failed");
            exit();
        }
    }

    if (isset($_POST["filter"])){
        $category = $_POST["category"];
        header("Location: /ZNH ASSIGNMENT/views/index.php?category=". $category);
                exit();
    }
}else{
    echo "REQUEST METHOD IS NOT POST";
}