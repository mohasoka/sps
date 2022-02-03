
    <!-- main content -->
    <div class="container">
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method ='POST' >
        <div class="row mb-3">
            <div class="col-md-2"> <label for="subname" class="form-label">اسم المادة</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="subname" placeholder="اسم المادة" name='s_name' value="<?php if(isset($status_error)&&isset($_POST['s_name']))echo $_POST['s_name'];?>"></div>
        </div>
        <div class="row mb-3">
        <div class="col-md-2">  <label for="sname" class="form-label"> اسم  المدرس الاول</label></div>
        <div class="col-md-10">  <input type="text" class="form-control" id="sname" placeholder="اسم المدرس الاول" name='f_name' value="<?php if(isset($status_error)&&isset($_POST['f_name']))echo $_POST['f_name'];?>"></div>
        </div>
        <div class="row mb-3">
        <div class="col-md-2">  <label for="sname" class="form-label">اسم  المدرس الثاني</label></div>
        <div class="col-md-10">  <input type="text" class="form-control" id="sname" placeholder="اسم المدرس الثاني" name='l_name' value="<?php if(isset($status_error)&&isset($_POST['l_name']))echo $_POST['l_name'];?>"></div>
        </div>
        <button class="btn btn-primary" type=submit name='submit2' value=9>اضافة</buuton>
      </form></div><br><br>
