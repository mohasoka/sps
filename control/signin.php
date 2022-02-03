<?php
    //variables 
    $emptyID=0;
    $emptyPass=0;
    $errorID=0;
    $errorPass=0;
    $id="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['id'])&&isset($_POST['pass'])&&isset($_POST['submit'])){
            $id=$_POST['id'];
            if(empty($_POST['id']))
                $emptyID=1;
            else if(empty($_POST['pass'])){
                $emptyPass=1;
            }
            else{
                require_once("./control/validation.php");
                $v=new Validation();
                if($v->valideID(htmlspecialchars($_POST['id']))){
                    
                    
                    if($v->valideUSER($_POST['id'],$_POST['pass'])){
                        //========================session====================
                        //===================================ENCRYPTING SESSION ===================
                        session_start();
                        $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
                        $_SESSION['UD'] = $_POST['id'] ;
                        $_SESSION['LOG'] = $pass;
                        $_SESSION['UP'] = $_SERVER ['REMOTE_ADDR'];
                        if(count($_COOKIE)>0)
                        {
                            setcookie("UD",$_SESSION['UD'],time()+3600*24,"/");
                            setcookie("LOG",$_SESSION['LOG'],time()+3600*24,"/");
                        }
                        header("Location:./student_information.PHP");
                        
                    }
                    else{
                        $errorPass=1;
                    }
                }
                else if($_POST['id']==="Admin"){
                    if($_POST['pass']==='M12345')
                    {
                        
                        $_SESSION['Aduser']=1;
                        $_SESSION['Uip'] =$_SERVER['REMOTE_ADDR'];
                        header("Location:./control/Admin panel/");
                       
                    }
                    else{
                        $errorID=1;
                    }
                }
                else{
                    $errorID=1;
                }

            }
        }

    }

?>