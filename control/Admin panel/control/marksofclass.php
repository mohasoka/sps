
    <!-- main content -->
    <div class="container">
    <form>
    <div class="col-md-2"> <label for="class" class="form-label" ></label></div>
            <?php $classes = $admin->showClasses();?>
            <div class="col-md-10">
            <select class="form-select" aria-label="oneortow" name="class"  >
                <option selected>اختر صفا</option>
                <?php  if($classes)foreach($classes as $class):?>
                <option value="<?php echo $class['id'];?>"><?php echo $class['name'];?></option>
                
                <?php endforeach;?>
              </select></div>
        <a class="btn btn-primary" href="#">استعلام</a>
      </form><br><br></div>
