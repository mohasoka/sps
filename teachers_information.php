<?php
//Header
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "error";
}
require_once("./control/teacher.php");
$teacher = new Teacher($id);
$teacherData = $teacher->teacherInfo();

$title = "المدرس " . $teacherData['name'];
require_once("./control/header.php");
?>
<!-- Main Content-->
<center>

    <img src="./img/teacher/<?php echo htmlspecialchars($teacherData['image']); ?>" class='img-fluid' >
    <h1><?php echo htmlspecialchars($teacherData['name']); ?></h1>
    <h4><?php echo htmlspecialchars($teacherData['certifecation']); ?></h4>
    <h4><?php echo htmlspecialchars($teacherData['certifecatSource']); ?> </h4>
    <h4>المواد التي درسها في المدرسة</h4>
    <h4>
        <?php foreach ($teacherData['teachedCourses'] as $subject) {
            echo htmlspecialchars($subject['name'] . " ");
        }
        ?>
    </h4>
</center>
<?php
//Footer
require_once("./control/footer.php");
?>