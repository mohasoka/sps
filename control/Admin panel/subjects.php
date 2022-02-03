<?php
session_start();
$errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

if (isset($_SESSION['Aduser']) && $_SESSION['Aduser'] === 1 && isset($_SESSION['Uip']) && $_SESSION['Uip'] === $_SERVER['REMOTE_ADDR']) {
    require_once('./control/Admin.php');
    $admin = new Admin();
    $subjects = $admin->subjects();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>المواد </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>

    <body>
        <table class="table" dir="rtl" class="container">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="24">
                        <center class=text-primary>المواد</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan=6>
                        <center class=text-primary>المعرف</center>
                    </td>
                    <td colspan=6>
                        <center class=text-primary>المادة</center>
                    </td>
                    <td colspan=6>
                        <center class=text-primary>الفصل</center>
                    </td>
                    <td colspan=6>
                        <center class=text-primary>الصف</center>
                    </td>
                </tr>
                <?php if ($subjects[0]) foreach ($subjects[1] as $s) : ?>
                    <tr>

                        <td colspan=6>
                            <center class=text-dark><?php echo htmlspecialchars($s['id']); ?></center>
                        </td>
                        <td colspan=6>
                            <center class=text-dark><?php echo htmlspecialchars($s['name']); ?></center>
                        </td>
                        <td colspan=6>
                            <center class=text-dark><?php echo htmlspecialchars($s['semester']); ?></center>
                        </td>
                        <td colspan=6>
                            <center class=text-dark><?php echo htmlspecialchars($s['class']); ?></center>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else header("location:".$errorPath); ?>