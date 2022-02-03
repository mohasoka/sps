<?php
    //Header
    $title = "المدرسين";
    require_once("./control/header.php");
    //=============================================
    require_once("./control/teachers.php");
    $teachers = new Teachers ();
    $teachersData = $teachers->ourTeachers();
?>
        <!-- Main Content-->
<div class="container px-4 px-lg-5" id="con">
    <div class="row gx-3 gx-lg-4 justify-content-center">
      <?php foreach($teachersData as $data):?> 
        <div class="card" style="width: 30rem;">
            <img class="card-img-top img-fluid" src="img/teacher/<?php echo htmlspecialchars($data['image']);?>" width="90%" alt="اسم المدرس">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo htmlspecialchars($data['first_name']." ".$data['last_name']);?></h5>
                      <p class="card-text"><h6>مدرس <?php echo htmlspecialchars($data['sh']);?></h6></p>
                        <a class="btn btn-primary btn-lg" href=<?php echo "teachers_information.php?id=".$data['id'];?>>إظهار بيانات المدرس</a>
                </div>
        </div>
      <?php endforeach;?>
    </div>
</div>
<?php
    //Footer
    require_once("./control/footer.php");

?>