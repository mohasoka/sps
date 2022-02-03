<?php require_once("./control/header.php"); ?>

<!-- main content -->
<div class="container">
    <div class="row">
        <div class="col-md-10" style="border:solid 1px #ddd4d4">
            <center>
                <h3 class="text-primary">
                    <?php echo "<br>" . $title . "<br><br><br>"; ?>
                </h3>
                <?php require_once($includingFile); ?>
            </center>

        </div>
        <div class="col-md-2">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <ul class="list-group">
                    <li class="list-group-item <?php if ($_POST['submit'] == 1) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=1>تسجيل طالب</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 2) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=2>تسجيل مدرس</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 3) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=3>إضافة صف</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 4) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=4>إضافة مادة</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 5) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=5>ترحيل طلاب</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 6) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=6>إضافة علامة</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 7) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=7>علامات كملف اكسل</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 8) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=8>الاستعلام عن طالب</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 9) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=9> اضافة مدرس لمادة </button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 10) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=10>عام دراسي جديد</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 11) echo "border-primary"; ?>">
                        <center><button class="btn btn-primary" type=submit name=submit value=11>نموذج ملء علامات</button></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 12) echo "border-primary"; ?>">
                        <center><a class="btn btn-primary" href='subjects.php'>المواد</a></center>
                    </li>
                    <li class="list-group-item <?php if ($_POST['submit'] == 12) echo "border-primary"; ?>">
                        <center><a class="btn btn-primary" href='messages.php'>الرسائل <span class="text-primary" style='background-color:#fff;border-radius:30px;width:30px;height: 30px;' ><?php echo $admin->unReadMessages();?></span></a></center>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div><br><br><br>
<!-- Bootstrap core JS-->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>