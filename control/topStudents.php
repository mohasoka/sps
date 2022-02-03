<?php
require_once("DB.php");
final class TopStudents extends DB{
    private $classes;
    private $tops;
    private $sc_year;
    private $errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

    public function __construct(){
        parent::__construct();
        if (!$this->connection ){
            header("location:".$this->errorPath);
         }
         $sqlQuery = "sc_year from year  order by id DESC LIMIT 1";
        $scYear  = parent :: select($sqlQuery);
        if (!$scYear)
        {
            header("location:".$this->errorPath);

        }
        $scYear = $scYear[0]['sc_year'];
        $this->sc_year=$scYear;
         $sqlQuery="* FROM class";
         $data =parent::select($sqlQuery);
        if(!$data){
            header("location:".$this->errorPath);
        }
        $this->classes = $data;
        
        foreach($this->classes as $class){
        
            $sqlQuery="  * FROM student as s join (SELECT student_id,AVG(res) as a FROM `result` WHERE sc_year LIKE '". $this->sc_year  ."' group by student_id ) as av WHERE s.id=av.student_id and s.class=".$class['id']." ORDER by av.a DESC LIMIT 3";
            $data =parent::select($sqlQuery);
            if(!$data && mysqli_error($this->connection)){

                header("location:".$this->errorPath);
            }
            $this->tops[$class['name']] = $data ;
        }
    }
    public function topsInfo(){
        return $this->tops;
    }


}


?>
