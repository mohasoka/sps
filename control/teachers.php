<?php
require_once("DB.php");
final class Teachers extends DB{
    private $errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

//===================================CONSTRUCTER============================================================
    public function __construct(){
        parent::__construct();
        if (!$this -> connection ){
            header("location:".$this->errorPath);
        }
    }
//=======================================METHODS============================================================
    public function ourTeachers(){
        $s_q =" id,first_name,last_name,sh,image FROM teacher";
        $data = parent::select($s_q);
        if (!$data){
            header("location:".$this->errorPath);
            return FALSE;
        }
        parent::close();
        return $data; 
    }

}

?>
