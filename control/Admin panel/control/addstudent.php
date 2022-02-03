<!-- main content -->
<div class="container">
    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST' enctype="multipart/form-data">  
    <div class="row mb-3">
            <div class="col-md-2"> <label for="year" class="form-label">المعرف</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="year" placeholder="العام الدراسي" readonly value='<?php echo $admin->generateId()[1]; ?>' name='stud_id'></div>
        </div>
        <div class="row mb-3">
            <h6> : الاسم</h6>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="fname" class="form-label">الاسم الأول</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="fname" placeholder="الاسم الأول" name="f_name" value="<?php if (isset($status_error) && isset($_POST['f_name'])) echo $_POST['f_name']; ?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="lname" class="form-label">الاسم الثاني</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="lname" placeholder="الاسم الثاني" name='l_name' value="<?php if (isset($status_error) && isset($_POST['l_name'])) echo $_POST['l_name']; ?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="class" class="form-label">الصف الحالي</label></div>
            <?php $classes = $admin->showClasses(); ?>
            <div class="col-md-10">
                <select class="form-select" aria-label="oneortow" name="class">
                    <option selected>اختر صفا</option>
                    <?php if ($classes) foreach ($classes as $class) : ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="image" class="form-label">أضف صورة</label></div>
            <div class="col-md-10"> <input type="file" class="form-control" id="image" name='image'></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="num" class="form-label">رقم الهاتف</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="num" placeholder="رقم الهاتف" name='phone' value="<?php if (isset($status_error) && isset($_POST['phone'])) echo $_POST['phone']; ?>"></div>
        </div>
        <div class="row mb-3">
            <h6> : العنوان</h6>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="nebr" class="form-label">الحي</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="nebr" placeholder="الحي" name='street' value="<?php if (isset($status_error) && isset($_POST['street'])) echo $_POST['street']; ?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="city" class="form-label">المدينة</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="city" placeholder="المدينة" name='city' value="<?php if (isset($status_error) && isset($_POST['city'])) echo $_POST['city']; ?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="year" class="form-label">العام الدراسي</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="year" placeholder="العام الدراسي" readonly value='<?php echo $admin->schoolYear(); ?>' name='sc'></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="addtime" class="form-label">تاريخ التسجيل</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="addtime" readonly value='<?php echo $admin->schoolYear(); ?>' name='reg'></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="addtime" class="form-label">كلمة المرور</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" id="addtime" name='pass'></div>
        </div>
        <button class="btn btn-primary" type=submit name='submit2' value=1>تسجيل</buuton>
    </form>
</div><br><br>
<!-- Bootstrap core JS-->