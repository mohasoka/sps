<?php
session_start();
$errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2']) && isset($_SESSION['Aduser']) && isset($_SESSION['Uip']) && $_SESSION['Aduser'] && $_SESSION['Uip'] == $_SERVER['REMOTE_ADDR']) {

        if (isset($_FILES['excel'])) {

            if ($_FILES['excel']['error'] === 0 && $_FILES['excel']['name']) {

                $allowed = array('xls', 'csv','xlsx');
                $excelName = $_FILES['excel']['name'];
                $excelType = $_FILES['excel']['type'];
                $excelSize = $_FILES['excel']['size'];
                $excelTmpName = $_FILES['excel']['tmp_name'];
                $Ext = explode(".", $excelName);
                $excelExt = strtolower(end($Ext));
                if (in_array($excelExt, $allowed)) {
                    if ($excelSize < 1000000) {
                        $excelNewName = uniqid('', TRUE) . "." . $excelExt;
                        $uploadPath = "./control/Xls/result/" . $excelNewName;

                        move_uploaded_file($excelTmpName, $uploadPath);
                    } else {
                        $error = 'حجم الملف كبير جدا';
                    }
                } else {
                    $error = 'لايمكن رفع ملفات غير ملف XLSوCSV';
                }
            } else {
                $error = 'هناك مشكلة في رفع الملف';
            }
            if (isset($error)) { ?>
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                    <i class="bi-exclamation-triangle-fill"></i>
                    <strong class="mx-2">عذرا !</strong><?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>

                <?php } else if (isset($uploadPath)) {
                $path = $uploadPath;
                require_once("./control/Classes/PHPExcel.php");
                $sheet_object = (PHPExcel_IOFactory::createReaderForFile($path))->load($path);
                $worksheets = $sheet_object->getWorksheetIterator();
                $firstWorksheet = $sheet_object->getSheet('0');
                $class = $firstWorksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(1) . '1')->getValue();
                $subject = $firstWorksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(3) . '1')->getValue();
                require_once("./control/Admin.php");
                $admin = new Admin();
                $sc_year = $admin->schoolYear();
                if ($class && $subject) {
                    if (!$admin->existClass($class) && !$admin->existSubject($subject)) {
                        $error = "الصف أو المادة غير موجودين";
                    }
                } else {
                    $error = "خلية الصف والمادة يجب أن تكون ممتلئة";
                }

                if (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                        <i class="bi-exclamation-triangle-fill"></i>
                        <strong class="mx-2">عذرا !</strong><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                <?php } else {
                ?>
                    <table class="table" dir="rtl" class="container">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" colspan="6">
                                    <center class=text-primary>اضافة النتائج </center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>المعرف</td>
                                <td>اسم الطالب</td>
                                <td>النتيجة</td>
                                <td>الحالة</td>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($worksheets as $worksheet) {
                                $length = $worksheet->getHighestRow();
                                $width = ($worksheet->getHighestDataColumn());
                                $width = PHPExcel_Cell::columnIndexFromString($width);
                                $row = 2;
                                if ($i == 0)
                                    $row = 3;
                                if (($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue())) {
                                    for (; $row <= $length; $row++) {
                                        $id = ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue());
                                        $result = ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(2) . $row)->getValue());
                                        $name = ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(1) . $row)->getValue());
                                        $inserted_status = $admin->addResult($id, $subject, $result, $sc_year);
                                        if (!$inserted_status[0])
                                            $status_error = $inserted_status[1];
                                        else
                                            $status_success = $inserted_status[1];
                                        $i++;
                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $result; ?></td>
                                            <td class=<?php if (isset($status_success)) echo "text-success";
                                                        else echo "text-danger" ?>><?php if (isset($status_success)) echo $status_success;
                                                                                    else echo $status_error; ?></td>
                                        </tr>
                        <?php
                                    }
                                }
                            }
                        }
                        echo "</tbody> </table>";
                    } else { ?>
                        <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                            <i class="bi-exclamation-triangle-fill"></i>
                            <strong class="mx-2">عذرا !</strong>حدث خطأ ما
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>

                    <?php }
                } else { ?>
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" style="z-index:10;" dir="rtl">
                        <i class="bi-exclamation-triangle-fill"></i>
                        <strong class="mx-2">عذرا !</strong>حدث خطأ ما
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

            <?php }
            }else{header("location:".$errorPath);}
            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>