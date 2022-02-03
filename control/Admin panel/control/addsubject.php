
    <!-- main content -->
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
            <div class="row mb-3">
            <div class="col-md-2">  <label for="subn" class="form-label">اسم المادة</label></div>
            <div class="col-md-10">  <input type="text" class="form-control" name='s_name' id="subn" placeholder="اسم المادة"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">  <label for="subn" class="form-label"> الصف</label></div>
              <div class="col-md-10">
                <?php $classes = $admin->showClasses();?>
                <select class="form-select" aria-label="oneortow" name="class_id">
                    <option selected>اختر صفا</option>
                    <?php  if($classes)foreach($classes as $class):?>
                    <option value="<?php echo $class['id'];?>"><?php echo $class['name'];?></option>
                    
                    <?php endforeach;?>
                  </select>
                  </div></div>
              <div class="row mb-3">
              <div class="col-md-2">  <label for="subn" class="form-label"> الفصل</label></div>
              <div class="col-md-10">  
                      <select class="form-select" aria-label="oneortow" name='sem'>
                          <option selected>اختر فصلاً</option>
                          <option value="1">الفصل الأول</option>
                          <option value="2">الفصل الثاني</option>
                        </select>
                    </div></div>
            <button type="submit" name ="submit2" value="4" class="btn btn-primary" >أضافة</button>
          </form></div><br><br>
