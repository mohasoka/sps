<?php 
  $title = "نتائج الطالب ";
  require_once("./control/header.php");
  if(!$status)
  {
    header("Location:./loginfirst");
  }
  require_once("./control/student.php");
  session_start();
  $student = new Student ( $_SESSION ['UD']) ;
  $studentInformation = $student -> studentInfo();
  $studentResults =  $student -> studentResults();
?>
        <!-- Main Content-->
        <center>
            <div class="container">
            <img src="./img/student/<?php echo htmlspecialchars( $studentInformation['image']);?>" class='img-fluid'>
            <h1><?php echo htmlspecialchars( $studentInformation['name']);?></h1>
            <h4><?php echo htmlspecialchars( $studentInformation['class']);?></h4>
            <h4>المعدل : <?php echo htmlspecialchars( $studentInformation['avg']);?></h4>  <br><br>
              <table class="table" dir="rtl">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" colspan="3"><center>علامات الفصل الأول</center></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"></th>
                    <td>المادة</td>
                    <td>النتيجة</td>
                  </tr>
                  <?php $i=0;?>
                  <?php foreach($studentResults as $subject) : if ($subject['semester']==1): ?>
                      <tr>
                        <th scope="row"><?Php echo ++$i;?></th>
                        <td><?php echo htmlspecialchars($subject['name']); ?></td>
                        <td><?php echo htmlspecialchars($subject['res']); ?></td>
                      </tr>
                  <?php endif;endforeach;?>
                </tbody>
              </table>
              <table class="table" dir="rtl">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" colspan="3"><center> علامات الفصل الثاني </center></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"></th>
                    <td>المادة</td>
                    <td>النتيجة</td>
                  </tr>
                  <?php $i=0;?>
                  <?php foreach($studentResults as $subject) : if ($subject['semester']==2): ?>
                      <tr>
                        <th scope="row"><?Php echo ++$i;?></th>
                        <td><?php echo htmlspecialchars($subject['name']); ?></td>
                        <td><?php echo htmlspecialchars($subject['res']); ?></td>
                      </tr>
                  <?php endif;endforeach;?>
                </tbody>
              </table></div>
        </center><br>
<?php
  require_once("./control/footer.php");
?>
