<?php
session_start();
$errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2'])  && isset($_SESSION['Aduser']) && isset($_SESSION['Uip']) && $_SESSION['Aduser'] && $_SESSION['Uip'] == $_SERVER['REMOTE_ADDR']) {
    require_once("./../student.php");
    require_once("./control/Admin.php");
    $admin = new Admin();
    $status_error = '';
    $status_success = '';
    if (isset($_POST['stud_id']) && $_POST['stud_id']) {
        if ($_POST['submit2'] == 2 && isset($_POST['pass']) && isset($_POST['sc']) && isset($_POST['class']) && isset($_POST['phone']) && isset($_POST['st_addr']) && isset($_POST['c_addr']))
            if ( $_POST['sc'] && $_POST['class'] && $_POST['phone'] && $_POST['st_addr'] && $_POST['c_addr']) {
                $status = $admin->updateStudentInfo($_POST['stud_id'], $_POST['pass'], $_POST['class'], $_POST['sc'], $_POST['phone'], $_POST['st_addr'], $_POST['c_addr']);
                if ($status[0])
                    $status_success_update = $status[1];
                else {
                    $status_error = $status[1];
                }
            } else {
                $status_error = 'لايجب ترك حقول فارغة في معلومات الطالب';
            }
        $id = $_POST['stud_id'];
        $data = $admin->studentInformation($id);
        if(!$data){
            $status_error='الطالب غير موجود';
        }
        else{
        $student = new Student($id);
        $s_info = $student->studentInfo();
        $s_results = $student->studentResults();
        $status_success = 1;
            $data = $data[0];
        }
        
    } else if (isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['class_id']) && $_POST['class_id'] && $_POST['f_name'] && $_POST['l_name']) {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $class_id = $_POST['class_id'];
        $data = $admin->studentInformation(NULL, $f_name, $l_name, $class_id);
        if (!$data) {
            $status_error = 'لم يتم ايجاد الطالب ';
        } else {
            if (count($data) > 1) {
                $status_error = 222;
            } else {
                $data = $data[0];
                $status_success = 1;
                $student = new Student($data['id']);
                $s_info = $student->studentInfo();
                $s_results = $student->studentResults();
            }
        }
    } else {
        $status_error = 'يجب ملء الحقول بشكل صحيح حسب طريقة البحث';
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />

        <title><?php echo "معلومات الطالب "; ?></title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="./css/style.css" rel="stylesheet">
    </head>

    <body>
        <?php
        if ($status_error === 222) { ?>
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                <table class="table" dir="rtl" class="container">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" colspan="11">
                                <center class=text-primary>يوجد اكثر من طالب بهذا الاسم</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                المعرف
                            </td>
                            <td>
                                الاسم الاول
                            </td>
                            <td>
                                الاسم الثاني
                            </td>
                            <td>
                                رقم الهاتف
                            </td>
                            <td>
                                الحي
                            </td>
                            <td>
                                المدينة
                            </td>
                            <td>
                                اختيار
                            </td>
                        </tr>
                        <?php foreach ($data as $student) : echo "<tr>"; ?>
                            <td>
                                <?php echo htmlspecialchars($student['id']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['first_name']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['last_name']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['phone']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['street_addr']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['city_addr']); ?>
                            </td>
                            <td>
                                <input type="hidden" name='stud_id' value='<?php echo htmlspecialchars($student['id']); ?>'>
                                <button class="btn btn-primary" type=submit name='submit2' value=1>اختيار</buuton>
                            </td>
                        <?php
                            echo "</tr>";
                        endforeach;
                        echo "</form>";
                    } else  if ($status_error) { ?>

                        <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" dir="rtl">
                            <i class="bi-exclamation-triangle-fill"></i>
                            <strong class="mx-2">عذرا !</strong> <?php echo $status_error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php
                    } else {
                        if (isset($status_success_update)) { ?>

                            <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" dir="rtl">
                                <i class="bi-exclamation-triangle-fill"></i>
                                <strong class="mx-2"></strong> <?php echo $status_success_update; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php }
                        ?>


                        <table class="table" dir="rtl" class="container">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" colspan="12">
                                        <center class=text-primary>معلومات الطالب</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        المعرف
                                    </td>
                                    <td>
                                        الاسم الاول
                                    </td>
                                    <td>
                                        الاسم الثاني
                                    </td>
                                    <td>
                                        كلمة المرور
                                    </td>
                                    <td>
                                        العام الدراسي
                                    </td>
                                    <td>
                                        عام التسجيل
                                    </td>
                                    <td>
                                        الصف
                                    </td>
                                    <td>
                                        الحي
                                    </td>
                                    <td>
                                        المدينة
                                    </td>
                                    <td>
                                        الهاتف
                                    </td>
                                    <td>
                                        المعدل
                                    </td>
                                    <td>
                                        تعديل البيانات
                                    </td>
                                </tr>
                                <tr>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" ?>
                                        <td>
                                            <?php echo htmlspecialchars($data['id']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($data['first_name']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($data['last_name']); ?>
                                        </td>
                                        <td>
                                        
                                            <input type=text name='pass' class="form-control">
                                           
                                        </td>
                                        <td>
                                            <input type=text name='sc' class="form-control" value='<?php echo htmlspecialchars($data['sc_year']); ?>'>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($data['reg_year']); ?>
                                        </td>
                                        <td>
                                            <input type=text name='class' class="form-control" value='<?php echo htmlspecialchars($data['class']); ?>'>
                                        </td>
                                        <td>
                                            <input type=text name='st_addr' class="form-control" value='<?php echo htmlspecialchars($data['street_addr']); ?>'>
                                        </td>
                                        <td>
                                            <input type=text name='c_addr' class="form-control" value='<?php echo htmlspecialchars($data['city_addr']); ?>'>
                                        </td>
                                        <td>
                                            <input type=text name='phone' class="form-control" value='<?php echo htmlspecialchars($data['phone']); ?>'>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($s_info['avg']); ?>
                                        </td>
                                        <td>
                                            <input type="hidden" value='<?php echo htmlspecialchars($data['id']); ?>' name='stud_id' ?>
                                            <button class="btn btn-primary" type=submit name='submit2' value=2>تعديل</buuton>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <th scope="col" colspan="12">
                                        <center class=text-primary>نتائج الطالب</center>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <center>المادة</center>
                                    </td>
                                    <td colspan="6">
                                        <center>النتيجة</center>
                                    </td>
                                </tr>
                                <?php foreach ($s_results as $r) : ?>
                                    <tr>
                                        <td colspan="6">
                                            <center><?php echo htmlspecialchars($r['name']); ?></center>
                                        </td>
                                        <td colspan="6">
                                            <center><?php echo htmlspecialchars($r['res']); ?></center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                        <?php }
                } else {
                    header("location:".$errorPath);
                }
                        ?>
                            </tbody>
                        </table>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>

    </html>