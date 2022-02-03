<div class="container">
    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
        <div class="row mb-3">
            <div class="col-md-2"> <label for="class" class="form-label">الصف</label></div>
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
        <div class="row mb-3">
            <div class="col-md-2"> <label for="subn" class="form-label">معرف المادة</label></div>
            <div class="col-md-10"> <input type="text" class="form-control" name='s_id' id="subn" placeholder="معرف المادة"></div>
        </div>
        <button class="btn btn-primary" name='submit2' value='11'>انشاء رابط تحميل</button>
        <?php if(isset($link)) :?><a class="btn btn-primary" href='<?php echo $link;?>'>  تحميل</a><?php endif;?>
    </form>
    
    
    <br><br>
</div>