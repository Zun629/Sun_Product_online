<?php

class Functions{
    
    public function check_POST_Method(): bool{       
        if ($_SERVER["REQUEST_METHOD"] !== "POST"){
            return false;
        }else{
            return true;
        }
    }

    public function check_File_Not_Empty() : bool {
        if (empty($_FILES)){
            return false;
        }else{
            return true;
        }
    }

    public function check_File_Upload_No_Error(): bool{
        if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK){
            switch ($_FILES["image"]["error"]){
                case UPLOAD_ERR_PARTIAL:
                    exit("File only partially uploaded");
                case UPLOAD_ERR_NO_FILE:
                    header("Location: /ZNH ASSIGNMENT/views/signup.php?status=no_pfp");
                    exit();
                case UPLOAD_ERR_EXTENSION:
                    exit("File upload stopped by a PHP extension");
                case UPLOAD_ERR_FORM_SIZE:
                    exit("File exceeds MAX_FILE_SIZE in the HTML form");
                case UPLOAD_ERR_INI_SIZE:
                    exit("File exceeds upload_max_filesize in php.ini");
                case UPLOAD_ERR_NO_TMP_DIR:
                    exit("Temporary folder not found");
                case UPLOAD_ERR_CANT_WRITE:
                    exit("Failed to write file");
                default:
                    exit("Unknown upload error");
            }
        }else{
            return true;
        }
    } 

    public function check_Valid_File_Size(): bool{
        if ($_FILES["image"]["size"]>1048576){
            return false;
        }else{
            return true;
        }
    }
    
    public function check_Valid_File_Type(): bool{
        $finfo = new finfo(FILEINFO_MIME_TYPE);
    
        $mime_type = $finfo->file($_FILES["image"]["tmp_name"]);
    
        $mime_types = ["image/gif", "image/png", "image/jpeg"];
    
        if (!in_array($mime_type, $mime_types)){
            return false;
        }else{
            return true;
        }
    }

    public function rename_File($stored_folder_name, $status, $destination): string{
        
        
        $pathinfo = pathinfo($_FILES["image"]["name"]);
        $base = $pathinfo["filename"];
        $base = preg_replace("/[^\w-]/", "_", $base);

        if($status == "new_file"){
            $filename = $base . "." . $pathinfo["extension"];

        }else if ($status == "duplicate_file"){
            $i = 1;
            
            $function = new Functions();

            while (file_exists($destination)){
                $filename = $base. "($i).".$pathinfo["extension"];
                $destination = $function->create_File_Destination($stored_folder_name, $filename);    
            }
            return $destination;
        }
        return $filename;
    }


    public function no_Duplication($destination): bool{

        if (file_exists($destination)){
            return false;
        }else{
            return true;
        }
    }

    public function create_File_Destination($stored_folder_name,$file_name): string{
        
        $destination = __DIR__."/files/$stored_folder_name/". $file_name;

        return $destination;
    }

    public function move_File($destination): bool{
        if(! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)){
            exit("cant move file");
        }else{
            return true;
        }
    }
}