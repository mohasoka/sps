<div class="container text-dark">
    <center>
        <h3 >اضافة عام دراسي  يجب أن تتم بالرتيب </h3>
        <h4>العام التالي   <?php echo $admin->newYear()[1];?></h4>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name=second>
        <button type=submit value="10" name="submit2" class="btn btn-primary" >تأكيد</button>
        </form>
    </center>
</div>