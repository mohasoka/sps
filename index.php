<?php
    //Header
    $title = "المدرسة السورية الخاصة ";
    require_once("./control/header.php");
?>
<!-- Main Content-->
        <div class="container px-4 px-lg-5" id="con">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7" id="b">
                    
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="teachers.php" id="links">
                            <h2 class="post-title">معلومات عن المدرسين</h2>
                            <h3 class="post-subtitle">يمكنك هنا رؤية كل طاقم تدريسنا وخبرات كل منهم</h3>
                        </a>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="Toponclases.php" id="links"><h2 class="post-title">الأوائل على الصفوف</h2>
                        <h3 class="post-subtitle">نهتم بالنشر والتديل المستمر لدعم وتحفيز الطلاب</h3>
                    </a>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                   
                    <?php
                    if (!$status)
                    {

                    echo '<div class="post-preview">
                        <a href="login.php" id="links">
                            <h2 class="post-title">تسجيل الدخول</h2>
                            <h3 class="post-subtitle">نهتم بقيامك بتسجيل الدخول لمتابعة كل ما يتعلق بإبنك</h3>
                        </a>
                    </div><hr class="my-4" />';
                    }
                    ?>
                    
                </div>
            </div>
        </div>        

<?php
    //footer 
    require_once("./control/footer.php")
?>

