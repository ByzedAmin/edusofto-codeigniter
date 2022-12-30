<footer class="footer-area-sec">
    <div class="footer-area-wrap">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-6 col-md-4">
                    <div class="copyright-text text-white">© <?php echo $cms_setting['copyright_text']; ?></div>
                </div>
                <div class="col-sm-6 col-md-4 px-0">
                    <div class="social-links">
                        <ul class="d-flex align-items-center justify-content-md-center list-unstyled  py-3 mb-0">
                            <li class="d-inline"><a href="<?php echo $cms_setting['facebook_url']; ?>" class="text-white"><i class="fa-brands fa-facebook-f" target="_blank"></i></a></li>
                            <li class="d-inline"><a href="<?php echo $cms_setting['twitter_url']; ?>" class="text-white"><i class="fa-brands fa-twitter" target="_blank"></i></a></li>
                            <li class="d-inline"><a href="<?php echo $cms_setting['google_plus']; ?>" class="text-white"><i class="fa-brands fa-google-plus-g" target="_blank"></i></a></li>
                            <li class="d-inline"><a href="<?php echo $cms_setting['youtube_url']; ?>" class="text-white"><i class="fa-brands fa-youtube" target="_blank"></i></a></li>
                            <li class="d-inline"><a href="<?php echo $cms_setting['linkedin_url']; ?>" class="text-white"><i class="fa-brands fa-linkedin-in" target="_blank"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md-4 text-md-end">
                    <div class="create-author text-white"> Design & Developed by <a href="#" class="text-black" target="_blank">Imran Hosain</a></div>
                </div> -->
            </div>
        </div>
    </div>
</footer>
</div>



<?php if ($this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'admission') { ?>
    <!-- JS Files -->
    <script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/plugins/shuffle/jquery.shuffle.modernizr.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/select2/js/select2.full.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/custom.js'); ?>"></script>



    <!-- <script type="text/javascript">
        swal({
            toast: true,
            position: 'top-end',
            type: '<?php echo $alertclass ?>',
            title: '<?php echo $alert_message ?>',
            confirmButtonClass: 'btn btn-1',
            buttonsStyling: false,
            timer: 8000
        })
    </script> -->


<?php }  ?>

<!-- Include jQuery JS -->
<!-- <script src="common/assets/js/jquery.min.js"></script> -->
<!-- Include bootstrap JS -->
<script src="common/assets/js/bootstrap.bundle.min.js"></script>
<!-- Include aos JS -->
<script src="common/assets/js/aos.js"></script>
<!-- Include custom JS -->
<script src="common/assets/js/custom.js"></script>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<style>
    .navbar-toggler-icon{
      background: auto !important;
      margin-top: 10px;
    }
  </style>

</body>

</html>