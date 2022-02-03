<?php
session_start();
$errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2']) && isset($_POST['class_id']) && isset($_SESSION['Aduser']) && isset($_SESSION['Uip']) && $_SESSION['Aduser'] && $_SESSION['Uip'] == $_SERVER['REMOTE_ADDR']) {
    $class_id = $_POST['class_id'];
    require_once("./control/Admin.php");
    $admin = new Admin();
    $data = $admin->moveStudents($class_id);
    if (!$data[0])
        header("location:".$errorPath);
    else {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />

            <title>جار نقل الطلاب</title>
            <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
            <link href="./css/style.css" rel="stylesheet">
        </head>

        <body>

            <table class="table" dir="rtl" class="container">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="4">
                            <center class=text-primary>نقل الطلاب </center>
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
                    foreach ($data[1] as $id => $student) {
                        $i++;

                    ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['avg']; ?></td>
                            <td class=<?php if ($student['status'][0]) echo "text-success";
                                        else echo "text-danger" ?>><?php echo $student['status'][1]; ?></td>
                        </tr>
            <?php
                    }
                }
            } else {
                header("location:".$errorPath);
            }
            ?>
                </tbody>
            </table>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        </body>

        </html>