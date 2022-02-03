<?php
require_once("./../../control/DB.php");
final class Admin extends DB
{
    //properties
    public const CLASSES = array(
        '1' => 'الأول',
        '2' => 'الثاني',
        '3' => 'الثالث',
        '4' => 'الرابع',
        '5' => 'الخامس',
        '6' => 'السادس',
        '7' => 'السابع',
        '8' => 'الثامن',
        '9' => 'التاسع',
        '10' => 'العاشر',
        '11' => 'الحادي عشر',
        '12' => 'الثاني عشر',

    );
    private $errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

    //===================================CONSTRUCTER==========================================================
    public function __construct()
    {
        parent::__construct();
        if (!$this->connection) {
            header("location:".$this->errorPath);
        }
    }
    //==================================insert=============================================================
    final private function insert($sqlQuery)
    {
        $result = @mysqli_query($this->connection, "INSERT INTO " . $sqlQuery);
        return $result;
    }
    //==================================update=============================================================
    final private function update($sqlQuery)
    {
        $result = @mysqli_query($this->connection, "UPDATE " . $sqlQuery);
        return $result;
    }
    //==================================existClass=============================================================
    final public function existClass($id, $name = "")
    {
        $id = mysqli_real_escape_string($this->connection, $id);
        $name = mysqli_real_escape_string($this->connection, $name);
        $sqlQuery = "id from class where id = " . $id . " or name LIKE '" . $name . "'";
        $class_exist = parent::select($sqlQuery);
        return $class_exist || False;
    }
    //==================================existsubject=============================================================
    final public function existSubject($name, $class = '', $semester = '')
    {
        $class = mysqli_real_escape_string($this->connection, $class);
        $name = mysqli_real_escape_string($this->connection, $name);
        $semester = mysqli_real_escape_string($this->connection, $semester);
        if (!$class && !$semester) {
            $sqlQuery = "id from subject where id = '$name'";
        } else
            $sqlQuery = "id from subject where name LIKE '$name' and class LIKE '$class' and semester LIKE '$semester'";
        $subject_exist = parent::select($sqlQuery);
        return $subject_exist || False;
    }
    //======================================nextClass================================================
    public function nextClass()
    {
        $sqlQuery = "MAX(id) as c FROM class ";
        $c = parent::select($sqlQuery);
        if (!$c) {
            return array(FALSE, "عذرا حدث خطأ ما");
        }
        $id = $c[0]['c'];
        if ($id == 12) {
            return array(FALSE, "لقد تم بالفعل اضافة 12 صف الى المدرسة ");
        }
        $id = mysqli_real_escape_string($this->connection, $id);
        $name = SELF::CLASSES[++$id];
        return array($id, $name);
    }

    //==================================addclass=============================================================

    final public function addClass($id = NULL, $name = NULL)
    {

        if (!$id && !$name) {
            $nC = $this->nextClass();
            if (!$nC[0])
                return array(FALSE, $nC[1]);
            $id = $nC[0];
            $name = $nC[1];
        }
        //check if class exist
        if ($this->existClass($id, $name)) {
            return array(FALSE, "الصف موجود بالفعل ");
        }
        //add class
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            $id = mysqli_real_escape_string($this->connection, $id);
            $name = mysqli_real_escape_string($this->connection, $name);
            $sqlQuery = "class  values (" . $id . ",'" . $name . "')";
            if ($this->insert($sqlQuery)) {

                return array(TRUE, "تمت اضافة الصف بنجاح ");
            } else {
                return array(FALSE, "لم يتم اضافة الصف ");
            }
        } else {
            array(FALSE, "لم يتم اضافة الصف ");
        }
    }
    //==================================addsubject=============================================================
    final public function addSubject($name, $class, $semester)
    {
        //check if subject exist
        if (!$this->existSubject($name, $class, $semester)) {
            //check if class exist
            if ($this->existClass($class)) {
                //check if semester valide
                if (in_array($semester, array('1', '2'), true)) {
                    $class = mysqli_real_escape_string($this->connection, $class);
                    $name = mysqli_real_escape_string($this->connection, $name);
                    $semester = mysqli_real_escape_string($this->connection, $semester);
                    $sqlQuery = " `subject` ( `name`, `class`, `semester`) VALUES ( '$name', '$class', '$semester')";

                    if ($this->insert($sqlQuery)) {
                        return array(TRUE, "تم اضافة المادة بنجاح ");
                    } else {
                        echo mysqli_error($this->connection) . "<br>";
                        return array(FALSE, "لم يتم اضافة المادة");
                    }
                } else {
                    echo $semester;
                    return array(FALSE, "الفصل غير متاح");
                }
            } else {
                return array(FALSE, "الصف غير موجود");
            }
        } else {
            return array(FALSE, " المادة موجودة بالفعل  ");
        }
    }
    //=========================================generateId==============================================
    public function generateId($teacher = 0)
    {
        //teacher if $teacher=1
        if ($teacher) {
            $tabel = "teacher";
        } else {
            $tabel = "student";
        }
        $sqlQuery = "max(id) FROM {$tabel}";

        $id = parent::select($sqlQuery);
        if (!$id) {
            return array(FALSE, "عذرا شيء ما خاطئ");
        }
        return array(TRUE, $id[0]['max(id)'] + 1);
    }
    //===================================schoolYear===============================================
    public function schoolYear()
    {
        $sqlQuery = "sc_year from year  order by id DESC LIMIT 1";
        $scYear  = parent::select($sqlQuery);
        if (!$scYear) {
            return array(FALSE, "عذرا حدث خطأ ما");
        }
        $scYear = $scYear[0]['sc_year'];
        return $scYear;
    }
    //====================================addStudent================================================
    public function addStudent($id, $firstName, $lastName, $password, $phone, $scYear, $regYear, $class, $cityaddr, $streetaddr, $image = "profile.PNG")
    {

        $id = mysqli_real_escape_string($this->connection, $id);
        $firstName = mysqli_real_escape_string($this->connection, $firstName);
        $lastName = mysqli_real_escape_string($this->connection, $lastName);
        $password = mysqli_real_escape_string($this->connection, $password);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $scYear = mysqli_real_escape_string($this->connection, $scYear);
        $regYear = mysqli_real_escape_string($this->connection, $regYear);
        $class = mysqli_real_escape_string($this->connection, $class);
        $cityaddr = mysqli_real_escape_string($this->connection, $cityaddr);
        $streetaddr = mysqli_real_escape_string($this->connection, $streetaddr);
        $image = mysqli_real_escape_string($this->connection, $image);
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sqlQuery = "id from student where `first_name` LIKE '$firstName' and `last_name` LIKE '$lastName' and `phone` LIKE '$phone' and `sc_year` LIKE '$scYear' and `class` LIKE '$class' and `city_addr` LIKE '$cityaddr' and `street_addr` LIKE '$streetaddr' and `reg_year` LIKE '$regYear'";
        $data = parent::select($sqlQuery);
        if ($data)
            return array(FALSE, "الطالب موجود بالفعل");
        if ($id && $firstName && $lastName && $password && $phone && $scYear && $regYear && $class && $cityaddr && $streetaddr && $image) {
            $sqlQuery = " `student` ( `id`,`first_name`, `last_name`, `password`, `image`, `sc_year`, `reg_year`, `city_addr`, `street_addr`, `phone`, `class`) VALUES ( {$id},'$firstName', '$lastName', '$password', '$image', '$scYear', '$regYear', '$cityaddr', '$streetaddr', '$phone', {$class})";;
            if (!$this->insert($sqlQuery)) {
                return array(False, " لم يتم تسجيل الطالب ");
            }
            return array(True, "تم تسجيل الطالب بنجاح");
        } else {
            return array(False, " لم يتم تسجيل الطالب ");
        }
    }
    //==================================================addTeacher=========================================
    public function addTeacher($firstName, $lastName, $phone, $regYear, $sh, $shSource, $image = "profile.PNG")
    {
        // $id = mysqli_real_escape_string ($this->connection,$id); 
        $firstName = mysqli_real_escape_string($this->connection, $firstName);
        $lastName = mysqli_real_escape_string($this->connection, $lastName);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $sh = mysqli_real_escape_string($this->connection, $sh);
        $regYear = mysqli_real_escape_string($this->connection, $regYear);
        $shSource = mysqli_real_escape_string($this->connection, $shSource);
        $image = mysqli_real_escape_string($this->connection, $image);
        $sqlQuery = "id from student where `first_name` LIKE '$firstName' and `last_name` LIKE '$lastName' and `phone` LIKE '$phone' and `sh` LIKE '$sh' and `sh_source` LIKE '$shSource'  and `reg_year` LIKE '$regYear'";
        $data = parent::select($sqlQuery);
        if ($data)
            return array(FALSE, "المدرس موجود بالفعل");
        if ($firstName && $lastName && $phone && $sh && $shSource && $image) {
            $sqlQuery = " `teacher` (`first_name`, `last_name`, `image`,  `reg_year`, `phone`, `sh`,`sh_source`) VALUES ( '$firstName', '$lastName', '$image', '$regYear', '$phone', '$sh','$shSource')";;
            if (!$this->insert($sqlQuery)) {

                return array(False, " لم يتم تسجيل المدرس ");
            }
            return array(True, "تم تسجيل المدرس بنجاح");
        } else {
            return array(False, " لم يتم تسجيل المدرس ");
        }
    }
    //==========================================addResult========================================
    public function addResult($student_id, $subject_id, $result, $sc_year)
    {
        $student_id = mysqli_real_escape_string($this->connection, $student_id);
        $subject_id = mysqli_real_escape_string($this->connection, $subject_id);
        $result = mysqli_real_escape_string($this->connection, $result);
        $sc_year = mysqli_real_escape_string($this->connection, $sc_year);

        $sqlQuery = "res from result where student_id = {$student_id} and subject_id = {$subject_id} ";

        if (parent::select($sqlQuery)) {
            return array(FALSE, "النتيجة مضافة سابقا ");
        }
        if ($student_id && $subject_id && $result && $sc_year) {
            $sqlQuery = "student.class FROM student where student.id = {$student_id} ";
            $studentClass = parent::select($sqlQuery);
            $sqlQuery = "class from subject where id = {$subject_id}";
            $subjectClass = parent::select($sqlQuery);

            if ($studentClass && $subjectClass) {
                if ($studentClass[0]['class'] != $subjectClass[0]['class']) {
                    return array(FALSE, "المادة تنتمي لصف لا يطابق صف الطالب ");
                }

                $sqlQuery = " `result` (`student_id`, `subject_id`, `res`,`sc_year`) VALUES ({$student_id}, {$subject_id}, {$result},'$sc_year')";;
                if (!$this->insert($sqlQuery)) {

                    return array(False, " لم يتم تثبيت العلامة ");
                }
                return array(True, "تم تثبيت العلامة بنجاح");
            } else {
                return array(False, " المادة أو الطالب غير موجودين");
            }
        } else {
            return array(False, " لم يتم تثبيت العلامة ");
        }
    }

    //============================================classResult========================================
    public function classResult($class_id)
    {
        $class_id = mysqli_real_escape_string($this->connection, $class_id);
        if (!$this->existClass($class_id)) {
            return array(FALSE, "الصف غير موجود ");
        }

        $sqlQuery = "sc_year from year  order by id DESC LIMIT 1";
        $scYear  = parent::select($sqlQuery);
        if (!$scYear) {
            return array(FALSE, "عذرا حدث خطأ ما");
        }
        $scYear = $scYear[0]['sc_year'];
        $sqlQuery = "id from student where class='$class_id' and sc_year like '$scYear'";
        $students = parent::select($sqlQuery);
        if (!$students) {
            return array(FALSE, "عذرا حدث خطأ ما");
        }
        require_once("student.php");
        $data = [];
        foreach ($students as $student) {
            $id = $student['id'];

            $s = new Student($id);

            $info = $s->studentInfo();

            $result = $s->studentResults();

            $data[$id] = array(
                'name' => $info['name'],
                'average' => $info['avg'],
                'results' => $result
            );
        }
        if (!$data) {
            return array(FALSE, "عذرا حدث خطأ ما ");
        }

        return array(TRUE, $data);
    }
    //============================newYear===============================
    public function newYear()
    {
        $prevYear = $this->schoolYear();

        $prevYear = explode("-", $prevYear);
        $sc_year = (int)$prevYear[1] . "-" . (int)($prevYear[1] + 1);
        if (!preg_match("/[0-9]+-[0-9]+/", $sc_year)) {
            return array(False, "حدث خطأ ما");
        }
        return array(TRUE, $sc_year);
    }
    //===================================================addYear===========================================
    public function addYear($sc_year = 0)
    {
        $prevYear = $this->schoolYear();
        $prevYear = explode("-", $prevYear);

        if ($sc_year != 0) {
            if (!preg_match("/[0-9]+-[0-9]+/", $sc_year)) {
                return array(False, "عذرا العام الدراسي لايطابق الادخال الصحييح (0000-0000)");
            }

            //comparing

            $newYear = explode("-", $sc_year);
            if ((int)($prevYear[1]) != (int)($newYear[0]) || ((int)($newYear[0]) + 1) != (int)($newYear[1])) {
                return array(False, "العام الدراسي غير صالح جرب " . (int)($prevYear[1] + 1) . "-" . (int)($prevYear[1]));
            }
        } else {
            $sc_year = (int)$prevYear[1] . "-" . (int)($prevYear[1] + 1);
        }
        $sc_year = mysqli_real_escape_string($this->connection, $sc_year);
        $sqlQuery = "year (sc_year) Values ('$sc_year')";
        if ($this->insert($sqlQuery)) {
            return array(TRUE, "تمت اضافة العام الدراسي بنجاح");
        }
        return array(FALSE, "عذرا لم تتم اضافة العام الدراسي ");
    }
    //=======================================showClasses================
    public function showClasses()
    {
        $sqlQuery = "* FROM class";
        $data = parent::select($sqlQuery);
        if (!$data) {

            return FALSE;
        } else {
            return $data;
        }
    }
    //=========================================moveStudents============================
    public function moveStudents($class_id)
    {
        //check if class exist
        $class_id = mysqli_real_escape_string($this->connection, $class_id);
        if (!$this->existClass($class_id)) {
            return array(FALSE, "الصف غير موجود ");
        }

        $scYear = $this->schoolYear();
        $sqlQuery = "id from student where class={$class_id} and sc_year like '$scYear'";
        $students = parent::select($sqlQuery);
        if (!$students) {
            if (mysqli_error($this->connection))
                return array(FALSE, "عذرا حدث خطأ ما");
            else
                return array(FALSE, "لايوجد طلاب");
        }
        require_once("./../../control/student.php");
        $error = [];
        $prevYear = $scYear;
        $prevYear = explode("-", $prevYear);
        $scYear = (int)$prevYear[1] . "-" . (int)($prevYear[1] + 1);

        foreach ($students as $student) {
            $id = $student['id'];

            $s = new Student($id);

            $info = $s->studentInfo();

            $newclass = $class_id + 1;
            if ((float)($info['avg']))
                if ((float)($info['avg']) > 50) {


                    $sqlQuery = " student SET `class`='$newclass',`sc_year` = '$scYear' where id= {$id}";
                    if (!$this->update($sqlQuery)) {
                        $status = array(False, "لم يتم نقل الطالب");
                    } else {
                        $status = array(TRUE, "نجاح الطالب الى الصف " . SELF::CLASSES[$newclass]);
                    }
                } else {
                    $sqlQuery = " student SET `sc_year` = '$scYear' where id= {$id}";
                    if (!$this->update($sqlQuery)) {
                        $status = array(False, "لم يتم نقل الطالب");
                    } else {
                        $status = array(False, "رسوب الطالب في الصف " . SELF::CLASSES[$newclass - 1]);
                    }
                }
            else {
                $status = array(FALSE, " لايمكن نقل الطالب حتى انتهاء العام الدراسي , ان كان هناك خطأ ما يمكنك مراجعة نتائج الطالب عن طريق معرفه و تعديل بياناته يدويا");
            }
            $info['status'] = $status;
            $data[$id] = $info;
        }
        $this->addYear($scYear);

        if ($data)
            return array(TRUE, $data);
        return array(False, "عذرا حدث خطأ ما");
    }
    //==================================================================================================
    public function studentInformation($id = Null, $first_name = NULL, $last_name = Null, $class = Null)
    {
        $id = mysqli_real_escape_string($this->connection, $id);
        $first_name = mysqli_real_escape_string($this->connection, $first_name);
        $last_name = mysqli_real_escape_string($this->connection, $last_name);
        $class = mysqli_real_escape_string($this->connection, $class);
        if ($id)
            $sqlQuery = "* FROM student where id ={$id}";
        else if ($first_name && $last_name && $class)
            $sqlQuery = "* FROM student where first_name like '$first_name' and last_name like '$last_name' and class={$class}";
        $data = parent::select($sqlQuery);
        if (!$data) {
            return False;
        }
        return $data;
    }
    //=====================================generateEXCEL=======================
    public function generateExcel($class_id, $subject_id)
    {

        $class_id = mysqli_real_escape_string($this->connection, $class_id);
        $subject_id = mysqli_real_escape_string($this->connection, $subject_id);

        if (!$this->existClass($class_id)) {
            return array(FALSE, "الصف غير موجود");
        }
        if (!$this->existSubject($subject_id)) {
            return array(FALSE, "المادة غير موجودة");
        }
        $path =  "c" . $class_id . "s" . $subject_id . ".xlsx";
        require_once("classes/PHPExcel/IOFactory.php");
        $phpExcel = new PHPExcel();
        
        $phpExcel->setActiveSheetIndex('0');
        $workSheet = $phpExcel->getActiveSheet();
        $workSheet->setCellValue("A1", "الصف");
        $workSheet->setCellValue("B1", $class_id);
        $workSheet->setCellValue("C1", "المادة");
        $workSheet->setCellValue("D1", $subject_id);
        $workSheet->setCellValue("A2", "المعرف");
        $workSheet->setCellValue("B2", "الاسم");
        $workSheet->setCellValue("C2", "النتيجة");
        $workSheet->getColumnDimension("B")->setAutoSize(TRUE);
        $scYear = $this->schoolYear();
        $sqlQuery = "id,concat(`first_name`,' ',`last_name`) as `name` from student where class={$class_id} and sc_year like '$scYear'";
        $data = parent::select($sqlQuery);
        if (!$data) {

            return array(FALSE, "عذرا حدث خطأ ما");
        }
        $i = 3;
        foreach ($data as $student) {
            $id = $student['id'];
            $name = $student['name'];
            $workSheet->setCellValue("A" . $i, $id);
            $workSheet->setCellValue("B" . $i, $name);
            $i++;
        }

        
        $obj_writer = new PHPExcel_Writer_Excel2007($phpExcel, 'Excel2007');
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $path . '"');
        header('Cache-Control: max-age=0');
        
        $obj_writer->save('php://output');
        exit;
        return array(TRUE, 'تمت العملية بنجاح');
    }
    //====================================updateStudentInfo==================
    public function updateStudentInfo($id, $pass = NULL, $class, $scYear, $phone, $street, $city)
    {
        $id = mysqli_real_escape_string($this->connection, $id);
        $pass = mysqli_real_escape_string($this->connection, $pass);
        $class = mysqli_real_escape_string($this->connection, $class);
        $scYear = mysqli_real_escape_string($this->connection, $scYear);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $street = mysqli_real_escape_string($this->connection, $street);
        $city = mysqli_real_escape_string($this->connection, $city);
        if ($pass)
            $sqlQuery = "student SET `password`='$pass' , `class` = {$class} , `sc_year`='$scYear' , `phone`='$phone' , `street_addr` = '$street' ,`city_addr` = '$city' where `id`={$id}";
        else {
            $sqlQuery = "student SET  `class` = {$class} , `sc_year`='$scYear' , `phone`='$phone' , `street_addr` = '$street' ,`city_addr` = '$city' where `id`={$id}";
        }
        if ($this->update($sqlQuery)) {

            return array(TRUE, "تم تحديث المعلومات بنجاح");
        }

        return array(FALSE, "لم يتم تحديث المعلومات");
    }

    //==========================addTeaching============================================
    public function addTaching($subject_name, $f_name, $l_name)
    {
        $subject_name = mysqli_real_escape_string($this->connection, $subject_name);
        $f_name = mysqli_real_escape_string($this->connection, $f_name);
        $l_name = mysqli_real_escape_string($this->connection, $l_name);
        $sqlQuery = "id from subject where name LIKE '$subject_name'";
        $s_id = parent::select($sqlQuery);
        if (!$s_id)
            return array(FALSE, "المادة غير موجودة");
        $s_id = $s_id[0]['id'];
        $sqlQuery = "id from teacher where first_name LIKE '$f_name' and last_name LIKE '$l_name'";
        $t_id = parent::select($sqlQuery);
        if (!$t_id)
            return array(FALSE, "المدرس غير موجود");
        $t_id = $t_id[0]['id'];
        $sqlQuery = "teaching value ({$t_id},{$s_id})";
        if ($this->insert($sqlQuery))
            return array(TRUE, 'تمت العملية بنجاح');
        return array(FALSE, 'حدث خطأ ما ');
    }


    //============================Subjects===================
    public function subjects()
    {
        $sqlQuery = '* from subject order by class';
        $data = parent::select($sqlQuery);
        if (!$data)
            return array(FALSE, 'هناك خطأ ما ');
        return array(TRUE, $data);
    }
    //===================newMessages=====================================================
    public function newMessages()
    {
        $sqlQuery = "* from message where watched = 0 order by id desc limit 5 ";
        $data = parent :: select($sqlQuery);
        if(!$data)
            return array(False,'حدث خطا ما ');
        foreach($data as $message){
            $id=$message['id'];
            $sqlQuery = "message set `watched`=1 where id={$id}";
            $this->update($sqlQuery);
        }
        return array(True,$data);
    }
    //===================================unReadMessages====================
    public function unReadMessages(){
        $sqlQuery = "* from message where watched = 0 order by id desc ";
        $data = parent :: select($sqlQuery);
        if(!$data)
            return False;
        return count($data);
    }
}
