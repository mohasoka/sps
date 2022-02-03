<?php 

session_start();
    $status = 0;
    require_once("./control/validation.php");
    $v = new Validation();
    if( isset($_SESSION['UP']) && isset($_SESSION['UD']) && isset($_SESSION['LOG']))
    {
        if( $_SESSION['UP'] == $_SERVER['REMOTE_ADDR'] )
        {
            if (! $v->valideUSER($_SESSION['UD'],$_SESSION['LOG']))
             {
              session_destroy();
              header("Location : ./loginfirst.php");
            }
            else 
            {
                $status = 1;
            }
        }
        else{
          if ( count($_COOKIE) > 0 )
          {
            if ( isset($_COOKIE['UD']) && isset($_COOKIE['LOG'] ) )
            {
                if ( $v->valideUSER($_COOKIE['UD'],$_COOKIE['LOG'])) 
                {
                    $_SESSION['UP'] =  $_SERVER['REMOTE_ADDR'] ;
                    $_SESSION['UD'] =  $_COOKIE['UD'] ;
                    $_SESSION['LOG'] = $_COOKIE['LOG'] ;
                    $status = 1 ;
                }
                else 
                {
                    setcookie ("UD","",time()-3600);
                    setcookie ("LOG","",time()-3600);
                }
            }
          }
          else 
          {
          session_destroy();
          }
        }
    }
    else 
    {
        if ( count($_COOKIE) > 0 )
        {
          if ( isset($_COOKIE['UD']) && isset($_COOKIE['LOG'] ) )
          {
              if ( $v->valideUSER($_COOKIE['UD'],$_COOKIE['LOG'])) 
              {
                  $_SESSION['UP'] =  $_SERVER['REMOTE_ADDR'] ;
                  $_SESSION['UD'] =  $_COOKIE['UD'] ;
                  $_SESSION['LOG'] = $_COOKIE['LOG'] ;
                  $status = 1 ;
              }
              else 
              {
                  setcookie ("UD","",time()-3600);
                  setcookie ("LOG","",time()-3600);
              }
          }
        }

    }
    $res_link = "./loginfirst.php";
    if ($status) 
    {   
        $res_link = "./student_information.php";
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send_message'])&& isset($_POST['content']) && isset($_POST['m_id']) && $_POST['content'] &&$_POST['m_id'] ){
        require_once('Message.php');
        $message = new Message();
        $sending_status = $message->addMessage($_POST['m_id'],$_POST['content']);
    }

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <title><?php echo htmlspecialchars($title); ?></title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">    
        <link href="./css/style.css" rel="stylesheet">
    </head>
        <body >
            <?php if(isset($sending_status)):?>
                <?php if($sending_status[0]) :?>
                    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2"></strong><?php echo $sending_status[1];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
                <?php else:?>
                    
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2">عذرا !</strong><?php echo $sending_status[1];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif;endif;?>
        
        <!-- Page Header-->
        <header  class="bs-docs-header"  style="background-image: url('img/cover.jpg');background-size: cover;height: 680px;">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light"  id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php" id="a" >المدرسة السورية الخاصة</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse"  id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0" dir="rtl">
                        <li class="nav-item" ><a class="nav-link px-lg-3 py-3 py-lg-4" id="a" href="index.php" >رئيسية</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" id="a" href="about.php">حول</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" id="a" href=<?php echo htmlspecialchars($res_link); ?>>نتائج الطالب</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" id="a" href="#contact">اتصل بنا</a></li>
                        <?php if($status):?>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" id="a" href="logout.php"> تسجبل الخروج</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
                    <div class="col-md-10 col-lg-8 col-xl-7"><br><br>
                        <div class="site-heading text-center">
                            <h1 class="text-primary">أهلاً بكم بالمدرسة السورية الخاصة</h1><br>
                            <h3 class="text-primary ">هنا ننشئ الأجيال</h3>
                        </div>
                    </div>
                </div>
            </div>
        </header> <br><br>