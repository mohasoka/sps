<?php
require_once("DB.php");
final class Teacher extends DB{
    //properties
    private $id;
    private $name;
    private $image;
    private $certifecation;
    private $certifecationSource;
    private $teachedCourses=[];
    private $errorPath='http://localhost:81/%D8%A7%D9%84%D9%85%D8%AF%D8%B1%D8%B3%D8%A9%20%D8%A7%D9%84%D8%B3%D9%88%D8%B1%D9%8A%D8%A9%20%D8%A7%D9%84%D8%AE%D8%A7%D8%B5%D8%A9/error/error.php';

    //===================================CONSTRUCTER============================================================
    public function __construct($id){
        parent::__construct();
        if (!$this->connection && !filter_var($id,FILTER_VALIDATE_INT)){
           header("Location:".$this->errorPath);
        }
        $this->id=$id;
        $sqlQuery = " * FROM teacher  where teacher.id=".($this->id);
        $teacher_data=parent::select($sqlQuery)[0];
        if (!$teacher_data){
           
            header("Location:".$this->errorPath);

        }
        $sqlQuery = " s.name FROM (teacher join teaching as th) join subject as s where teacher.id=".$this->id." and teacher.id=th.teacher_id and s.id=th.subject_id";
        $subjects_data=parent::select($sqlQuery);
        if (!$subjects_data)
            header("Location:".$this->errorPath);
        $this->name = $teacher_data['first_name']." ".$teacher_data['last_name'];
        $this->image = $teacher_data['image'];
        $this->certifecation = $teacher_data['sh'];
        $this->certifecationSource = $teacher_data['sh_source'];
        $this->teachedCourses=$subjects_data;
        parent::close();
    }
    //=======================================METHODS============================================================
    public function teacherInfo(){
        $data=array(
            'name' => $this->name ,
             'image' => $this->image ,
             'certifecation' => $this->certifecation,
             'certifecatSource' => $this->certifecationSource,
             'teachedCourses' => $this->teachedCourses);
        return $data;
    }
}



?>
