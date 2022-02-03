
    <!-- main content -->
    <div class="container">
        <form action = '<?php echo $_SERVER['PHP_SELF'];?>' method= 'POST' enctype="multipart/form-data">
            <div class="row mb-3"><h6> : الاسم</h6></div>
            <div class="row mb-3">
            <div class="col-md-2">  <label for="fname" class="form-label">الاسم الأول</label></div>
            <div class="col-md-10">  <input type="text" class="form-control" id="fname" placeholder="الاسم الأول" name="f_name" value="<?php if(isset($status_error)&&isset($_POST['f_name'])) echo $_POST['f_name'];?>"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2"> <label for="lname" class="form-label">الاسم الثاني</label></div>
                <div class="col-md-10"> <input type="text" class="form-control" id="lname" placeholder="الاسم الثاني" name="l_name" value="<?php if(isset($status_error)&&isset($_POST['l_name'])) echo $_POST['l_name'];?>"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2"> <label for="certi" class="form-label">الشهادة</label></div>
                <div class="col-md-10"> <input type="text" class="form-control" id="certi" placeholder="الشهادة" name="cert" value="<?php if(isset($status_error)&&isset($_POST['cert'])) echo $_POST['cert'];?>"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2"> <label for="num" class="form-label">رقم الهاتف</label></div>
                <div class="col-md-10"> <input type="text" class="form-control" id="num" placeholder="رقم الهاتف" name="phone" value="<?php if(isset($status_error)&&isset($_POST['phone'])) echo $_POST['phone'];?>"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2"> <label for="cityofcerti" class="form-label" >مصدر الشهادة</label></div>
                <div class="col-md-10"> <input type="text" class="form-control" id="cityofcerti" placeholder="مصدر الشهادة" name="cert_src" value="<?php if(isset($status_error)&&isset($_POST['cert_src'])) echo $_POST['cert_src'];?>"></div>
            </div>  
                <div class="row mb-3">
                <div class="col-md-2"> <label for="addtime" class="form-label">تاريخ التسجيل في المدرسة</label></div>
                <div class="col-md-10"> <input type="text" class="form-control" id="addtime" readonly value='<?php echo $admin->schoolYear();?>' name='reg'></div>
            </div>
            <br/>
            <div class="row mb-3">
            <div class="col-md-2"> <label for="image" class="form-label">أضف صورة</label></div>
            <div class="col-md-10"> <input type="file" class="form-control" id="image" name='image'></div>
            </div>
            <button class="btn btn-primary" type =submit name='submit2' value=2>تسجيل</button >
          </form></div><br><br>



