<?php
    //Header
    $title = "الأوائل على الصفوف ";
    require_once("./control/header.php");
    require_once("./control/topStudents.php");
    $data=new TopStudents();
    $data=$data->topsInfo();

?>
    <!-- Main Content-->
    <center>
        <?php 
            foreach($data as $className=>$students)
                if($students){
                echo "<h1> الصف ".htmlspecialchars($className) ."</h1> ";
                foreach($students as $student)
                    echo "<h4>". htmlspecialchars($student['first_name']." ".$student['last_name']." /".$student['a']) ."/</h4>";                   
                echo "<hr>";}
        ?>
    </center><br>
<?php
    //footer
    require_once("./control/footer.php");

?>