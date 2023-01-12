<!DOCTYPE html>
<html lang="zxx">
<head>
<meta name="description" content="<?php echo $global_config['institute_name'] ?>">
	<meta name="author" content="<?php echo $global_config['institute_name'] ?>">
	<title><?php echo translate('login');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link rel="stylesheet" href="<?php echo base_url('login_asset/assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('login_asset/assets/fonts/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('login_asset/assets/fonts/flaticon/font/flaticon.css');?>">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');?>">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('login_asset/assets/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('login_asset/assets/css/skins/default.css');?>">
    	<!-- sweetalert js/css -->
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/sweetalert/sweetalert-custom.css');?>">
	<script src="<?php echo base_url('assets/vendor/sweetalert/sweetalert.min.js');?>"></script>
    <script type="text/javascript">
		var base_url = '<?php echo base_url() ?>';
	</script>
</head>
<?php 

$branch_img = $this->db->where('id',$branch_id)->get('branch')->row_array();
$global_config = $this->db->where('id',1)->get('global_settings')->row_array();
?>
<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Login 16 start -->
<div class="login-16">
    <div class="login-16-inner">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0">
                    <div class="form-section align-self-center">
                        <div class="logo">
                            <a href="login-16.html">
                            <img src="<?=base_url('uploads/app_image/'.$branch_img['logo_file'])?>" height="54" alt="Logo">
                            </a>
                        </div>
                        <h3>Sign Into Your Account</h3>
                        <?php echo form_open($this->uri->uri_string()); ?>
                            <div class="form-group <?php if (form_error('email')) echo 'has-error'; ?> clearfix">
                                <div class="form-box">
                                    <input name="email" type="text" class="form-control" id="first_field" value="<?php echo set_value('email');?>" placeholder="<?php echo translate('username');?>">
                                    <i class="flaticon-mail-2"></i>
                                    <span class="error"><?php echo form_error('email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group <?php if (form_error('password')) echo 'has-error'; ?> clearfix">
                                <div class="form-box">
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" name="password" placeholder="<?php echo translate('password');?>">
                                    <i class="flaticon-password"></i>
                                    <span class="error"><?php echo form_error('password'); ?></span>
                                </div>
                            </div>
                            <div class="checkbox form-group clearfix">
                                <div class="form-check float-start">
                                    <input class="form-check-input" type="checkbox" name="remember"id="remember">
                                    <label class="form-check-label" for="rememberme">
                                        Remember me
                                    </label>
                                </div>
                                <a href="<?php echo base_url('authentication/forgot') . $this->authentication_model->getSegment(3);?>" class="link-light float-end forgot-password">Forgot your password?</a>
                            </div>
                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary btn-lg btn-theme w-100"><?php echo translate('login');?></button>
                            </div>
                        <?php echo form_close();?>

                        <!-- <p>Don't have an account? <a href="register-16.html">Register here</a></p> -->
                    </div>
                </div>
                <div class="col-lg-6 align-self-center pad-0 bg-img">
                    <div class="info clearfix">
                        <div class="box">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <div class="content">
                                <h3>We Make Spectacular</h3>
                                <div class="social-list">
                                    <a href="https://www.facebook.com/groups/edusofto" class="facebook-bg" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://www.facebook.com/edusofto2022" class="google-bg" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=qKBBbNmPA3U&list=PLKgRNQjQpLGs3mEUz7hDL7hu5Prsin-cM" class="twitter-bg" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                    
                                    <a href="https://www.linkedin.com/in/md-nazmus-sayadat-bayezid-784601145/" class="linkedin-bg" target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </div>
</div>
<!-- Login 16 end -->

<!-- External JS libraries -->
<script src="<?php echo base_url('login_asset/assets/js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('login_asset/assets/js/popper.min.js');?>"></script>
<script src="<?php echo base_url('login_asset/assets/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('login_asset/assets/js/app.js');?>"></script>
<!-- Custom JS Script -->
<?php
		$alertclass = "";
		if($this->session->flashdata('alert-message-success')){
			$alertclass = "success";
		} else if ($this->session->flashdata('alert-message-error')){
			$alertclass = "error";
		} else if ($this->session->flashdata('alert-message-info')){
			$alertclass = "info";
		}
		if($alertclass != ''):
			$alert_message = $this->session->flashdata('alert-message-'. $alertclass);
		?>
			<script type="text/javascript">
				swal({
					toast: true,
					position: 'top-end',
					type: '<?php echo $alertclass;?>',
					title: '<?php echo $alert_message;?>',
					confirmButtonClass: 'btn btn-default',
					buttonsStyling: false,
					timer: 8000
				})
			</script>
		<?php endif; ?>
</body>
</html>