<div class="container">
    <form action='<?php echo "./studentInfo.php"; ?>' method='POST'>
        <div class="row mb-3">
            <h6> البحث بالمعرف فقط  </h6>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="fname" class="form-label"> المعرف</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="fname" placeholder="ادخل المعرف هنا" name="stud_id" ></div>
        </div>
        <div class="row mb-3">
            <h6> البحث بالاسم والصف </h6>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="fname" class="form-label">الاسم الأول</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="fname" placeholder="الاسم الأول" name="f_name" ></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="lname" class="form-label">الاسم الثاني</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="lname" placeholder="الاسم الثاني" name='l_name'></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="class" class="form-label">الصف الحالي</label></div>
            <?php $classes = $admin->showClasses(); ?>
            <div class="col-md-10">
                <select class="form-select" aria-label="oneortow" name="class_id">
                    <option selected>اختر صفا</option>
                    <?php if ($classes) foreach ($classes as $class) : ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type='submit' name='submit2'>تسجيل</buuton>
    </form>
</div><br><br>