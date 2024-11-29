<?php

class Database{
    protected function connect(){
        try{
            $username = "root";
            $password = "";
            $db = new PDO('mysql:host=localhost;dbname=sun_product_db',$username,$password);
        }catch(PDOException $e){
            print "Error".$e->getMessage()."<br>";
            die();
        }
        return $db;
    }

}