<?php
require_once("DB.php");
final class Validation extends DB{
    private $errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

    public function __construct(){
        parent::__construct();
        if (!$this->connection ){
            header("location:".$this->errorPath);
         }
        }
    public function valideID($number){
        if(filter_var($number,FILTER_VALIDATE_INT)){
            $number = mysqli_real_escape_string($this->connection,$number);
            $sqlQuer = "id FROM student where student.id=".$number;
            $data =parent::select($sqlQuer);
            if($data)
                return TRUE;
        }
        return FALSE;
    }
    public function valideADMIN_Name($string){
            $string = mysqli_real_escape_string($this->connection,$string);
            $sqlQuer = "id FROM admin where admin.name=".$string;
            $data =parent::select($sqlQuer);
            if($data)
                return TRUE; 
             return FALSE;
    }
    public function valideUSER($id,$password){
        $id = mysqli_real_escape_string($this->connection,$id);
        $password = mysqli_real_escape_string($this->connection,$password);
        $sqlQuer = "id,password FROM student where student.id=".$id;
        $data =parent::select($sqlQuer);
            if(!$data)
                return False; 
            if(password_verify($password,$data[0]['password']))
             return True;
            else 
             return False;
    }
    public function valideADMIN($name,$password){
        $sqlQuer = "name,password FROM student where admin.name=".$name." and admin.password like ".$password;
        $data =parent::select($sqlQuer);
            if($data)
                return TRUE; 
             return FALSE;
    }


}

?>