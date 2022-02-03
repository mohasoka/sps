 <!-- Footer-->
<footer class="border-top" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <br>
                        <center><h3>تواصل معنا </h3></center>
                        <form actio="<?php echo $_SERVER['PHP_SELF'];?>" method='POST' >
                            <input type="text" placeholder="ادخل ايميلك أو رقم هاتفك" class="form-control" name='m_id'><br>
                            <textarea placeholder="حدثنا عما ترغب" class="form-control" name='content'></textarea><br>
                           <center> <button class="btn btn-primary" type="submit" name='send_message'>ارسال</button></center>
                        </form>
                        <br>
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!"><img src="img/instagram.ico" alt="instagram" width="50"/>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><img src="img/facebook.ico" alt="Facebook" width="50"/>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><img src="img/youtube.ico" alt="youtube" width="50"/>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Syrian private school 2021</div>
                        <br>
                    </div>
                </div>
            </div>
        </footer>
 
 <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>
