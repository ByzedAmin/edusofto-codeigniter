<!-- header area start -->
<header>
  <div class="logo-area">
    <a href="home/index/<?php echo $cms_setting['url_alias']; ?>">
      <img src="<?php echo base_url('uploads/frontend/images/' . $cms_setting['logo']); ?>" alt="Logo">
      <!-- <img src="common/assets/img/logo/logo.jpg" alt="image-not-found" /> -->
    </a>
  </div>


  <!-- navbar area start -->
  <div class="navbar-content-wrapper mb-2">
    <nav class="navbar navbar-expand-lg justify-content-end p-0">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="background: none; vertical-align: center;"> <i class="fa fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav flex-wrap my-lg-0">
          <?php
          $school = '';
          $last   = $this->uri->total_segments();
          $page   = $this->uri->segment(2);
          if ($page == 'page') {
            if ($last > 3) {
              $school = $this->uri->segment($last);
            }
          } else {
            if ($last > 2) {
              $school = $this->uri->segment($last);
            }
          }
          $result = $this->home_model->menuList($school);
          foreach ($result as $key => $row) {
            $active_menu   = '';
            $submenu     = '';
            $op_new_tab   = '';
            $submenu_active = '';
            $currentURL   = base_url(uri_string());
            if (uri_string() == '') {
              $currentURL .= 'home/index';
            }
            if (uri_string() == 'home') {
              $currentURL .= '/index';
            }
            if ($currentURL == $row['url']) {
              $active_menu = ' active';
            }

            // if (!empty($row['submenu']) && is_array($row['submenu'])) {
            //   $submenu = ' dropdown';
            //   $arrayURL = array_column($row['submenu'], 'url');
            //   if (in_array($currentURL, $arrayURL)) {
            //     $submenu_active = ' active';
            //   }
            //   $row['title'] = $row['title'] . '<span class="arrow"></span>';
            // }
            if ($row['open_new_tab']) {
              $op_new_tab = "target='_blank'";
            }
            if ($cms_setting['online_admission'] == 0 && $row['alias'] == 'admission') continue;
          ?>


            <!-- <li class="nav-item dropdown">
              <a title="<?php echo $row['title']; ?>" class="nav-link text-white dropdown-toggle" href="<?php echo $row['url']; ?>">
                <?php echo $row['title']; ?>
              </a>
              <?php if (!empty($row['submenu'])) { ?>
                <ul class="dropdown-menu">
                  <?php foreach ($row['submenu'] as $row2) {
                    $active_menu   = '';
                    $op_new_tab   = '';
                    if ($currentURL == $row2['url']) {
                      $active_menu = ' active';
                    }
                    if ($row2['open_new_tab']) {
                      $op_new_tab = "target='_blank'";
                    }
                  ?>
                    <a title="<?php echo $row2['title']; ?>" class="dropdown-item text-white" href="<?php echo $row2['url']; ?>"><?php echo $row2['title']; ?></a>
                  <?php } ?>
                </ul>
              <?php } ?>
            </li> -->



            <?php if (empty($row['submenu'])) { ?>
              <li class="nav-item">
                <a title="<?php echo $row['title']; ?>" class="nav-link text-white" href="<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a>
              </li>
            <?php } else { ?><li class="nav-item dropdown">
                <a title="<?php echo $row['title']; ?>" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $row['title']; ?>
                </a>
                <ul class="dropdown-menu">
                  <?php foreach ($row['submenu'] as $row2) {
                    $active_menu   = '';
                    $op_new_tab   = '';
                    if ($currentURL == $row2['url']) {
                      $active_menu = ' active';
                    }
                    if ($row2['open_new_tab']) {
                      $op_new_tab = "target='_blank'";
                    }
                  ?>
                    <li><a title="<?php echo $row2['title']; ?>" class="dropdown-item text-white" href="<?php echo $row2['url']; ?>"><?php echo $row2['title']; ?></a></li>
                  <?php } ?>

                </ul>
              </li>

            <?php } ?>

          <?php } ?>
          <li class="nav-item dropdown">
            <a title="শিক্ষার্থীদের তথ্য" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              শিক্ষার্থীদের তথ্য
            </a>
            <ul class="dropdown-menu">
              <?php
              $this->db->where('branch_id', $branchID);
              $class = $this->db->get('class')->result_array();
              foreach ($class as $value) {
              ?>
                <li><a href="<?php echo base_url('home/studentView/' . $value['id']); ?>/<?php echo $cms_setting['url_alias']; ?>" title="<?php echo $value['name']; ?>" class="dropdown-item text-white" href="#"><?php echo $value['name']; ?></a></li>
              <?php } ?>


            </ul>
          </li>
          <li class="nav-item dropdown">
                <a title="Attendence" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Attendence                </a>
                <ul class="dropdown-menu">
                                      <li><a title="Student Attendence" class="dropdown-item text-white" href="home/student_attendence">Student Attendence</a></li>
                                      <li><a title="Employee" class="dropdown-item text-white" href="home/employee_attendence">Employee Attendence</a></li>
                  
                </ul>
              </li>
          <li class="nav-item">
            <a title="নোটিশ" class="nav-link text-white" href="home/notice/<?php echo $cms_setting['url_alias']; ?>">নোটিশ</a>
          </li>
          <?php if (!is_loggedin()) { ?>
            <li class="nav-item">
              <a title="লগইন" target="_blank" class="nav-link text-white" href="<?php echo base_url('authentication') . "/index/" . $cms_setting['url_alias']; ?>">লগইন</a>
            </li>
          <?php }else{   ?>
            <li class="nav-item">
            <a title="ড্যাশবোর্ড" target="_blank" class="nav-link text-white" href="<?php echo base_url('dashboard'); ?>">ড্যাশবোর্ড</a>
          </li>
         <?php }  ?>

        </ul>
      </div>
    </nav>
  </div>
  <!-- banner area start -->
  <div class="banner-area-wrapper mb-3">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        foreach ($sliders as $key => $value) {
          $elements = json_decode($value['elements'], true);
        ?>
          <div class="carousel-item active" data-bs-interval="10000">
            <a href="index.html">
              <img src="<?php echo base_url('uploads/frontend/slider/' . $elements['image']) ?>" class="d-block w-100" alt="image-not-found">
            </a>
          </div>
        <?php } ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </div>

</header>