<?php

include_once "../controller/config.php";

class DataAccess extends Database{

    

    public function log_In($username,$password) {

        $dataAccess = new DataAccess();

        $user_login=$dataAccess->retrieve_User_By_Email($username);
        if(!empty($user_login)){

            if($user_login["PASSWORD"]===$password){
                return $user_login;
            }else{
                return "Wrong Password";
            }
            
        }else{
            $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_users WHERE username = ?;');

            if(!$prepared_statement->execute(array($username))){
                $prepared_statement=null;
                exit("AN ERROR OCCURRED WHEN FINDING USER WITH USERNAME");
            }
            
            $user_login = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($user_login)){
                if($password == $user_login["PASSWORD"]){
                    return $user_login;   
                }else{
                    return "Wrong Password";
                }
            }else{
                return "NO USER WITH THIS EMAIL FOUND!";
            }
            
        }
    }
    public function create_User($username, $email, $password, $file_destination){


        $id = $this->gen_uuid();
        
        $prepared_statement = $this->connect()->prepare('INSERT INTO tb_users (id, username, email, password, role, profile) VALUES (?,?,?,?,?,?);');

        if (!isset($prepared_statement)) {
            echo "Prepared statement is undefined.";
            exit;
        }

        if(!$prepared_statement->execute(array($id, $username, $email, $password, 0,  $file_destination))){
            $prepared_statement=null;
            exit("Error Saving User to Database");
        }

        return $username;
    }
    public function retrieve_User_By_Email(string $email): array {
        // Prepare the SQL statement with a placeholder for the email
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_users WHERE email = ?');
        
        // Execute the statement with the provided email
        if (!$prepared_statement->execute(array($email))) {
            // Clean up and handle error if execution fails
            $prepared_statement = null;
            exit("Error retrieving user by email from the database.");
        }
    
        // Fetch the result as an associative array
        $user = $prepared_statement->fetch(PDO::FETCH_ASSOC);
    
        // Return the result or an empty array if no user is found
        return $user ?: [];
    }
    public function retrieve_User_By_Name(string $name): array {
        try {
            // Prepare the SQL statement
            $prepared_statement = $this->connect()->prepare(
                'SELECT USERNAME, EMAIL FROM tb_users WHERE username = ?'
            );
    
            // Execute the statement
            $prepared_statement->execute([$name]);
    
            // Fetch the result as an associative array
            $user = $prepared_statement->fetch(PDO::FETCH_ASSOC);
    
            // Return the user data or an empty array if not found
            return $user ?: [];
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
    
    public function delete_User($name){
        try {
            // Prepare the SQL DELETE statement
            $sql = "DELETE FROM tb_users WHERE username = :name";
    
            // Prepare the statement
            $stmt = $this->connect()->prepare($sql);
    
            // Bind the name parameter to prevent SQL injection
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    
            // Execute the statement
            $stmt->execute();
    
            // Check if any rows were affected (i.e., user was deleted)
            if ($stmt->rowCount() > 0) {
                return true; // Deletion successful
            } else {
                return false; // No rows affected, deletion failed
            }
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    
    public function update_User(string $name, string $field, string $value): bool {
        try {
            // Prepare the SQL statement with the dynamic field
            $sql = "UPDATE tb_users SET $field = :value WHERE username = :name";
            $prepared_statement = $this->connect()->prepare($sql);
    
            // Bind parameters
            $prepared_statement->bindParam(':value', $value, PDO::PARAM_STR);
            $prepared_statement->bindParam(':name', $name, PDO::PARAM_STR);
    
            // Execute the statement and return the status (true or false)
            return $prepared_statement->execute();
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Update error: " . $e->getMessage());
            return false;
        }
    }
    
    
    public function retrieve_All_Users(): array {
        // Prepare the SQL statement to retrieve all users
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_users');
        
        // Execute the query
        if (!$prepared_statement->execute()) {
            // If execution fails, clean up and exit with an error
            $prepared_statement = null;
            exit("Error retrieving all users from the database.");
        }
    
        // Fetch all results as an associative array
        $all_users = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Return the fetched results
        return $all_users;
    }
    public function create_category(){
        
    }
    public function delete_category(){

    }
    public function create_Product($product_name, $product_price, $product_category, $product_status, $product_description, $seller_id, $destination) {
        $id = $this->gen_uuid();
        
        $prepared_statement = $this->connect()->prepare('INSERT INTO tb_products (ID, PRODUCT_NAME, PRICE, POST_DATE, DESCRIPTION, SELLER_ID, CATEGORY_ID, STATUS, PRODUCT_IMAGE) VALUES (?,?,?,?,?,?,?,?,?);');
        if (!isset($prepared_statement)) {
            echo "Prepared statement is undefined.";
            exit;
        }

        if(!$prepared_statement->execute(array($id, $product_name, $product_price, date("d/m/Y"), $product_description, $seller_id, $product_category, $product_status, $destination))){
            $prepared_statement=null;
            exit("Error Saving Product to Database");
        }

        return true;
    }
    public function retrieve_Product($product_name) {
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_products WHERE product_name = ?');
         // Execute the statement with the provided email
         if (!$prepared_statement->execute(array($product_name))) {
            // Clean up and handle error if execution fails
            $prepared_statement = null;
            exit("Error retrieving product by name from the database.");
        }

        // Fetch the result as an associative array
        $product = $prepared_statement->fetch(PDO::FETCH_ASSOC);

        // Return the result or an empty array if no product is found
        return $product ?: [];
    }

    public function retrieve_Product_By_ID($product_ID) {
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_products WHERE ID = ?');
         // Execute the statement with the provided email
         if (!$prepared_statement->execute(array($product_ID))) {
            // Clean up and handle error if execution fails
            $prepared_statement = null;
            exit("Error retrieving product by name from the database.");
        }

        // Fetch the result as an associative array
        $product = $prepared_statement->fetch(PDO::FETCH_ASSOC);

        // Return the result or an empty array if no product is found
        return $product ?: [];
    }

    public function retrieve_Product_By_Category($category) {
        
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_products WHERE CATEGORY_ID = ?');
         // Execute the statement with the provided email
         if (!$prepared_statement->execute(array($category))) {
            // Clean up and handle error if execution fails
            $prepared_statement = null;
            exit("Error retrieving product by name from the database.");
        }

        // Fetch the result as an associative array
        $product = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        // Return the result or an empty array if no product is found
        return $product ?: [];
    
    }

    public function retrieve_All_Products(){
        // Prepare the SQL statement to retrieve all users
        $prepared_statement = $this->connect()->prepare('SELECT * FROM tb_products');
        
        // Execute the query
        if (!$prepared_statement->execute()) {
            // If execution fails, clean up and exit with an error
            $prepared_statement = null;
            exit("Error retrieving all users from the database.");
        }
    
        // Fetch all results as an associative array
        $all_products = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Return the fetched results
        return $all_products;
    }
    public function update_Product() {
    }
    public function delete_Product() {
    }

    public function search_Product($query) {
        $pdo = $this->connect(); // Use the existing connection method
    
        // Prepare the SQL statement with OR condition and a single LIMIT clause
        $stmt = $pdo->prepare('
            SELECT * 
            FROM tb_products 
            WHERE PRODUCT_NAME LIKE :query 
            OR CATEGORY_ID LIKE :categoryQuery 
            LIMIT 10
        ');
    
        // Execute the statement with the provided query parameter
        $stmt->execute([
            ':query' => "%$query%",
            ':categoryQuery' => "%$query%"
        ]);
    
        // Fetch all results as an associative array
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the results
        return $products;
    }
    

    public function change_Role() {
    }



    public function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}

