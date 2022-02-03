<div class="container">
        <form action="<?php echo "students_move.php"?>" method = "POST">
           <?php $classes = $admin->showClasses();?>
            <select class="form-select" aria-label="oneortow" name="class_id">
                <option selected>اختر صفا</option>
                <?php  if($classes)foreach($classes as $class):?>
                <option value="<?php echo $class['id'];?>"><?php echo $class['name'];?></option>
                
                <?php endforeach;?>
              </select>
            <button type="submit" name ="submit2" value="5" class="btn btn-primary" >ترحيل </button>
          </form></div><br><br>