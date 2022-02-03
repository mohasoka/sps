<?php
    require_once("Admin.php");
    $admin = new Admin();
    $errorPath ='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';
    $files = array ("addStudent","addteacher","addClass","addsubject","movestudents","addmark","excelfile","studentInfo","addTeaching","addYear","resultsTemplate");
    $titles = array ("اضافة طالب ","اضافة مدرس ","اضافة صف ","اضافة مادة","ترحيل الطلاب ","اضافة علامة ","اضف العلامات كملف اكسل","الاستعلام عن طالب ","اضافة مدرس لمادة","بدء عام دراسي جديد","نموذج ملء علامات");
    session_start();
    if(isset($_SESSION['Aduser']) && $_SESSION['Aduser']===1 && isset($_SESSION['Uip']) && $_SESSION['Uip']===$_SERVER['REMOTE_ADDR'])
    {
    if($_SERVER['REQUEST_METHOD']=='POST' )
    {
        if(isset( $_POST['submit'] ))
        {
            if(isset($files[ $_POST['submit']-1 ]))
            {
                $includingFile ="./control/". $files[$_POST['submit']-1].".php";
                $title = $titles [$_POST['submit']-1];
            }
        }
        else if(isset($_POST['submit2']))
        {
            $title = $titles [$_POST['submit2']-1];
            $includingFile ="./control/".  $files [$_POST['submit2']-1].".php";
            switch ($_POST['submit2']) {
                case '1':
                    if(isset($_POST['stud_id'])&&isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['class'])&&isset($_POST['street'])&&isset($_POST['city'])&&isset($_POST['phone'])&&isset($_POST['reg'])&&isset($_POST['sc'])&&isset($_POST['pass']))
                    {

                    if($_POST['stud_id']&&$_POST['f_name']&&$_POST['l_name']&&$_POST['class']&&$_POST['street']&&$_POST['city']&&$_POST['reg']&&$_POST['sc']&&$_POST['phone']&&$_POST['pass'])
                    {
                        if(isset($_FILES['image'])){
                            
                            if($_FILES['image']['error']===0){
                                
                                $allowed =array('jpg','jpeg','png');
                                $imageName= $_FILES['image']['name'];
                                $imageType= $_FILES['image']['type'];
                                $imageSize= $_FILES['image']['size'];
                                $imageTmpName= $_FILES['image']['tmp_name']; 
                                $Ext = explode(".",$imageName);
                                $imageExt =strtolower(end($Ext));
                                if(in_array($imageExt,$allowed)){
                                    if($imageSize<1000000){
                                        $imageNewName = uniqid('',TRUE).".".$imageExt;
                                        $uploadPath = $_SERVER['DOCUMENT_ROOT']."/المدرسة السورية الخاصة/img/student/".$imageNewName;
                                        
                                        @move_uploaded_file($imageTmpName,$uploadPath);
                                    }else{
                                        $status_error='حجم الصورة كبير جدا';
                                    }

                                }else{
                                    $status_error = 'لايمكن رفع ملفات غير الصور';
                                }

                            }else if($_FILES['image']['error']!=4){
                                $status_error='هناك مشكلة في رفع الصورة';
                            }

                        }
                        if(isset($imageNewName)){
                            $status = ($admin->addStudent($_POST['stud_id'],$_POST['f_name'],$_POST['l_name'],$_POST['pass'],$_POST['phone'],$_POST['sc'],$_POST['reg'],$_POST['class'],$_POST['city'],$_POST['street'],$imageNewName));
                        
                        }
                        else if(!isset($status_error))
                            $status = ($admin->addStudent($_POST['stud_id'],$_POST['f_name'],$_POST['l_name'],$_POST['pass'],$_POST['phone'],$_POST['sc'],$_POST['reg'],$_POST['class'],$_POST['city'],$_POST['street']));
                        else {
                            $status=array(FALSE,$status_error);
                        }
                        if($status[0])
                            
                            $status_success=$status[1];
                        else {
                            $status_error=$status[1];
                        }
                        
                    }
                    else
                    {
                        $status_error ="لايسمح الا لحقل الصورة بأن يكون فارغ";
                    }
                    }
                    else {
                        $status_error ="حدث خطأ ما";
                    }
                    break;
                case '2':
                    if(isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['phone'])&&isset($_POST['reg'])&&isset($_POST['cert'])&&isset($_POST['cert_src']))
                    {

                    if($_POST['f_name']&&$_POST['l_name']&&$_POST['reg']&&$_POST['cert']&&$_POST['phone']&&$_POST['cert_src'])
                    {
                        if(isset($_FILES['image'])){
                            
                            if($_FILES['image']['error']===0&&$_FILES['image']['name']){
                                
                                $allowed =array('jpg','jpeg','png');
                                $imageName= $_FILES['image']['name'];
                                $imageType= $_FILES['image']['type'];
                                $imageSize= $_FILES['image']['size'];
                                $imageTmpName= $_FILES['image']['tmp_name']; 
                                $Ext = explode(".",$imageName);
                                $imageExt =strtolower(end($Ext));
                                if(in_array($imageExt,$allowed)){
                                    if($imageSize<1000000){
                                        $imageNewName = uniqid('',TRUE).".".$imageExt;
                                        $uploadPath = $_SERVER['DOCUMENT_ROOT']."/المدرسة السورية الخاصة/img/teacher/".$imageNewName;
                                        
                                        move_uploaded_file($imageTmpName,$uploadPath);
                                    }else{
                                        $status_error='حجم الصورة كبير جدا';
                                    }

                                }else{
                                    $status_error = 'لايمكن رفع ملفات غير الصور';
                                }

                            }else if($_FILES['image']['error']!=4){
                                $status_error='هناك مشكلة في رفع الصورة';
                            }

                        }
                        if(isset($imageNewName)){
                            $status = ($admin->addTeacher($_POST['f_name'],$_POST['l_name'],$_POST['phone'],$_POST['reg'],$_POST['cert'],$_POST['cert_src'],$imageNewName));
                        
                        }
                        else if(!isset($status_error))
                               $status = ($admin->addTeacher($_POST['f_name'],$_POST['l_name'],$_POST['phone'],$_POST['reg'],$_POST['cert'],$_POST['cert_src']));
                        else {
                            $status=array(FALSE,$status_error);
                        }
                        if($status[0])
                            
                            $status_success=$status[1];
                        else {
                            $status_error=$status[1];
                        }
                        
                    }
                    else
                    {
                        $status_error ="لايسمح الا لحقل الصورة بأن يكون فارغ";
                    }
                    }
                    else {
                        $status_error ="حدث خطأ ما";
                    }
                    break;
                case '3':
                    $status = $admin->addClass();
                    if($status[0])
                        $status_success= $status [1];
                    else
                        $status_error = $status [1]; 
                    break;
                case '4':
                    if(isset($_POST['s_name'])&&isset($_POST['class_id'])&&isset($_POST['sem']))
                    {
                       if($_POST['s_name']&&$_POST['class_id']&&$_POST['sem'])
                       {
                            $status=$admin->addSubject($_POST['s_name'],$_POST['class_id'],$_POST['sem']);
                            if($status[0])
                              $status_success=$status[1];
                            else {
                                $status_error=$status[1];
                            }
                       }
                       else 
                       {
                           $status_error='عذرا يرجى ملء جميع الحقول';
                       }
                    }
                    else
                    {
                       $status_error='هناك خطأ ما'; 
                    }
                  break;
                case '6':
                    if(isset($_POST['sub_id'])&&isset($_POST['stud_id'])&&isset($_POST['res'])&&isset($_POST['sc']))
                    {
                       if($_POST['sub_id']&&$_POST['stud_id']&&$_POST['res']&&$_POST['sc'])
                       {
                            $status=$admin->addResult($_POST['stud_id'],$_POST['sub_id'],$_POST['res'],$_POST['sc']);
                            if($status[0])
                              $status_success=$status[1];
                            else {
                                $status_error=$status[1];
                            }
                       }
                       else 
                       {
                           $status_error='عذرا يرجى ملء جميع الحقول';
                       }
                    }
                    else
                    {
                       $status_error='هناك خطأ ما'; 
                    }
                case '9':
                    if(isset($_POST['s_name'])&&isset($_POST['f_name'])&&isset($_POST['l_name']))
                    {
                       if($_POST['s_name']&&$_POST['f_name']&&$_POST['l_name'])
                       {
                            $status=$admin->addTaching($_POST['s_name'],$_POST['f_name'],$_POST['l_name']);
                            if($status[0])
                              $status_success=$status[1];
                            else {
                                $status_error=$status[1];
                            }
                       }
                       else 
                       {
                           $status_error='عذرا يرجى ملء جميع الحقول';
                       }
                    }
                    else
                    {
                       $status_error='هناك خطأ ما'; 
                    }
                    break;
                    case '10':
                        $status = $admin->addYear($admin->newYear()[1]);
                        if($status[0])
                            $status_success= $status [1];
                        else
                            $status_error = $status [1]; 
                        break;
                    case '11':
                        if(isset($_POST['class_id'])&&isset($_POST['s_id']))
                    {
                       if($_POST['class_id']&&$_POST['s_id'])
                       {
                        $status = $admin->generateExcel($_POST['class_id'],$_POST['s_id']);
                            if($status[0]){
                                $status_success=$status[1];
                              }
                            else {
                                $status_error=$status[1];
                            }
                       }
                       else 
                       {
                           $status_error='عذرا يرجى ملء جميع الحقول';
                       }
                    }
                    else
                    {
                       $status_error='هناك خطأ ما'; 
                    }
                        
                        break;
                default:
                    $status_error = 'هناك خطأ ما';
                    break;
            }
        }
    }
    else 
    {
        $includingFile = "./control/". $files['0'].".php";
        $title = $titles ['0'];
    }
    }
    else 
    {
        header("Location:".$errorPath);  
        
    }

    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <?php

            if (isset($status_success))
            {?>

                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2"></strong> <?php echo $status_success;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php }
            elseif(isset($status_error))
            {?>
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2">عذرا !</strong><?php echo $status_error;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            <?php }

    ?>
     <!-- Page Header-->
     <hr>
     <header class="bs-docs-header"  >
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <!-- Navigation-->
                <div class="col-md-10 col-lg-8 col-xl-7"><br><br>
                    <div class="site-heading text-center">
                        <h1 class="text-primary">لوحة تحكم بالمدرسة السورية الخاصة</h1><br>
                    </div>
                </div>
            </div>
        </div>
    </header> <hr><br><br>










