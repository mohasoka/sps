<?php
session_start();
$errorPath='http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

if (isset($_SESSION['Aduser']) && $_SESSION['Aduser'] === 1 && isset($_SESSION['Uip']) && $_SESSION['Uip'] === $_SERVER['REMOTE_ADDR']) {
    require_once('./control/Admin.php');
    $admin = new Admin();
    $messages = $admin->newMessages();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>الرسائل </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>

    <body>
        <center ><h4 class='text-primary' > احرص على قراءة الرسائل كلها لانها لن تكون متاحة بعد الان</h4> </center>
        <table class="table" dir="rtl" class="container">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="24">
                        <center class=text-primary>الرسائل</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan=6>
                        <center class=text-primary>من</center>
                    </td>
                    <td colspan=18>
                        <center class=text-primary>المحتوى</center>
                    </td>
                    
                </tr>
                <?php if ($messages[0]) foreach ($messages[1] as $s) : ?>
                    <tr>

                        <td colspan=6>
                            <center class=text-dark><?php echo htmlspecialchars($s['fr']); ?></center>
                        </td>
                        <td colspan=18>
                            <center class=text-dark><?php echo htmlspecialchars($s['content']); ?></center>
                        </td>
                       
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else header("location:".$errorPath); ?>