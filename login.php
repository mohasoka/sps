<?php
    //Header
    $title = " تسجيل الدخول  ";
    require_once("./control/header.php");
    require_once("./control/signin.php");
?>
<!-- Main Content-->
<div class="container">
    <form method="POST" action="login.php" >
        <input type="text" name="id" class="form-control" placeholder="ادخل الرقم الخاص بك " value=<?php echo $id;?>><br>
        <?php if($emptyID) :?>
            <!-- Warning Alert -->
            <div class="alert alert-warning alert-dismissible d-flex align-items-center fade show " dir="rtl">
                <i class="bi-exclamation-octagon-fill"></i>
                <strong class="mx-2 "> عذرا !</strong> حقل الرقم لايمكن أن يكون فارغ 
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif($errorID):?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2">عذرا !</strong> الرقم الذي أدخلته غير صحيح 
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif ?>
        <input type="password" name ="pass" class="form-control" placeholder="ادخل كلمة السر" ><br>
        <?php if($emptyPass) :?>
            <!-- Warning Alert -->
            <div class="alert alert-warning alert-dismissible d-flex align-items-center fade show " dir="rtl">
                <i class="bi-exclamation-octagon-fill"></i>
                <strong class="mx-2 "> عذرا !</strong> حقل كلمة السر لايمكن أن يكون فارغ 
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif($errorPass):?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" dir="rtl">
                <i class="bi-exclamation-triangle-fill"></i>
                <strong class="mx-2">عذرا !</strong> المعلومات التي أدخلتها غير صحيحة 
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif ?>
        <center><input type="submit" name="submit" class="btn btn-primary" value="تسجيل الدخول"></center><br>
    </form>
    <br><br>
</div>



<?php
    //footer 
    require_once("./control/footer.php")
?>
