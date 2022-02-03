<?php
require_once("DB.php");
final class Student extends DB{
    //properties
    private $id;
    private $name;
    private $image;
    private $class;
    private $avg;
    private $results;
    private $sc_year;
    private $errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

    //===================================CONSTRUCTER==========================================================
    public function __construct($id)
    {
        parent::__construct();
        
        if (!$this->connection && !filter_var($id,FILTER_VALIDATE_INT))
        {
           header("location:".$this->errorPath);
        }
        $this->id=mysqli_real_escape_string($this -> connection,$id);
        
        //===========================YEAR====================
        $sqlQuery = "sc_year from year  order by id DESC LIMIT 1";
        $year = parent :: select($sqlQuery); 
       if(!$year)
       {
          header("location:".$this->errorPath);
       }
       $this->sc_year=$year[0]['sc_year'];
        //=======================INFORAMTIONS===============
        $sqlQuery = " first_name,last_name,class,image from student where id =".$this->id;
        $data=parent::select($sqlQuery);
        if (!$data)
        {
            header("location:".$this->errorPath);
        }
        
        $this->name = $data[0]['first_name']." ".$data[0]['last_name'];
        $this->image = $data[0]['image'];
        $this->class = $data[0]['class'];
        
        
        //========================RESULTS===================
        $sqlQuery = " sub.name,re.res,sub.semester FROM (student as st join result as re) join subject as sub where st.id=".$this->id." and re.student_id=".$this->id." and sub.id=re.subject_id and st.sc_year = re.sc_year and st.sc_year LIKE '".$this->sc_year."'";
        $data=parent::select($sqlQuery);
        if (!$data)
        {
            if(mysqli_error($this->connection))
                header("location:".$this->errorPath);
        }
        $this->results =$data;
        

        //======================AVGERAGE====================

        $sqlQuery = "count(id) as count from subject where class = ".$this->class;
        $counts_of_subjects=parent::select($sqlQuery);
        if (!$counts_of_subjects){
            header("location:".$this->errorPath);
        }
        if (sizeof($data) == $counts_of_subjects[0]['count'])
        {
            $sqlQuery = " AVG(res) FROM (student as st join result as re) join subject as sub where st.id=".$this->id." and re.student_id= ". $this->id." and sub.id=re.subject_id and st.sc_year = re.sc_year and st.sc_year LIKE '".$this->sc_year."'";
            $avg=parent::select($sqlQuery);
            if (!$avg)
            {
                header("location:".$this->errorPath); 
            }
             $this->avg = $avg[0]['AVG(res)'];
        }
        else
        {
            $this->avg = "المعدل متاح بعد نهاية العام الدراسي " ;
        }
        //======================class=================================
        $sqlQuery = " name from class where id=".$this->class;
        $data=parent::select($sqlQuery);
        if (!$data)
        {
            header("location:".$this->errorPath);
        }
        $this->class = "الصف ".$data[0]['name'];
        
        parent::close();
    }
    //=======================================METHODS============================================================
    public function studentInfo()
    {
        $data=array(
            'name' => $this->name ,
             'image' => $this->image ,
             'class'=>$this->class,

             'avg' =>$this->avg);
        return $data;
    }
    public function studentResults ()
    {
        return $this->results;
    }
}

?>
