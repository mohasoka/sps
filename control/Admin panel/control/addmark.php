
    <!-- main content -->
    <div class="container">
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method ='POST' >
        <div class="row mb-3">
            <div class="col-md-2"> <label for="subname" class="form-label">معرف المادة</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="subname" placeholder="معرف المادة" name='sub_id' value="<?php if(isset($status_error)&&isset($_POST['sub_id']))echo $_POST['sub_id'];?>"></div>
        </div>
        <div class="row mb-3">
        <div class="col-md-2">  <label for="sname" class="form-label">معرف  الطالب</label></div>
        <div class="col-md-10">  <input type="text" class="form-control" id="sname" placeholder="معرف الطالب" name='stud_id' value="<?php if(isset($status_error)&&isset($_POST['stud_id']))echo $_POST['stud_id'];?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="year" class="form-label">العام الدراسي</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="year" placeholder="العام الدراسي" readonly value='<?php echo $admin->schoolYear();?>' name='sc' ></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="mark" class="form-label">العلامة</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="mark" placeholder="العلامة" name='res' value="<?php if(isset($status_error)&&isset($_POST['res']))echo $_POST['res'];?>"></div>
        </div>
        
        <button class="btn btn-primary" type=submit name='submit2' value=6>اضافة</buuton>
      </form></div><br><br>
