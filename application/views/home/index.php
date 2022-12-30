<!-- Main Slider Section Starts -->

<main>
    <!-- latest-announcement start -->
    <section class="latest-announcement-sec mb-3">
        <div class="latest-announcement-cont">
            <div class="row">
                <div class="col-lg-2 pe-0">
                    <div class="latest-announcement-title text-white">সর্বশেষ ঘোষনা</div>
                </div>
                <div class="col-lg-9 ps-0">
                    <marquee class="latest-announcement-desc">
                        <?php
                        $this->db->where('branch_id', $branchID);
                        $services_list = $this->db->get('front_cms_services_list')->result_array();
                        if (!empty($services_list)) {
                            foreach ($services_list as $key => $value) {
                        ?>
                                <i class="fa fa-stop-circle"></i> <a href="home/notice/<?php echo $cms_setting['url_alias']; ?>"><?php echo $value['title']; ?></a>
                        <?php }
                        } ?>
                        <!-- <i class="fa fa-stop-circle"></i> <a href="#">মাদ্রাসার ফাযিল পরিক্ষা শুরু হচ্ছে আগামি 30-03-2022</a>  -->
                        <!-- <i class="fa fa-stop-circle"></i> <a href="#">আমাদের শিক্ষা প্রতিষ্ঠানে আপনাদের স্বাগতম।</a> -->
                    </marquee>
                </div>
            </div>
        </div>
    </section>
    <section class="site-main-content">
        <div class="row">
            <div class="col-lg-9">
                <?php
                if (!empty($wellcome)) {
                    $elements = json_decode($wellcome['elements'], true);
                ?>
                    <div class="institution-sec-wrap" data-aos="fade-up" data-aos-duration="1000">

                        <h4 class="institution-title text-white"><?php echo $wellcome['title']; ?></h4>
                        <div class="institution-cont">
                            <img src="<?php echo base_url('uploads/frontend/home_page/' . $elements['image']); ?>" alt="image-not-found">
                            <p class="institute-history"> <?php echo nl2br($wellcome['description']); ?>
                                <!-- <a class="read-more text-white">read more</a> -->
                            </p>
                        </div>
                    </div>
                <?php } ?>
                <!-- speech-area start -->
                <div class="row speech-area mb-3" data-aos="fade-up" data-aos-duration="1000">
                    <?php
                    if (!empty($statistics)) {
                        $statisticsElem = json_decode($statistics['elements'], true);
                    ?>
                        <div class="col-lg-6">
                            <h4 class="category-title text-white overflow-hidden"><?php echo $statistics['title'] ?></h4>
                            <div class="profile">
                                <img src="<?php echo base_url('uploads/frontend/home_page/' . $statisticsElem['image']); ?>" alt="image-not-found">
                                <p class="speech-desc"> <?php echo nl2br($statistics['description']); ?>
                                    <!-- <a href="blog-details.html" class="read-more text-white">read more</a> -->
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (!empty($teachers)) {
                        $elements = json_decode($teachers['elements'], true);
                    ?>
                        <div class="col-lg-6">
                            <h4 class="category-title text-white overflow-hidden"><?php echo $teachers['title'] ?></h4>
                            <div class="profile">
                                <img src="<?php echo base_url('uploads/frontend/home_page/' . $elements['image']); ?>" alt="image-not-found">
                                <p class="speech-desc"> <?php echo nl2br($teachers['description']); ?>
                                    <!-- <a class="read-more text-white">read more</a> -->
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <style>
                    .item {
                        margin-bottom: -15px;
                    }
                </style>
                <!-- services-area -->
                <?php
                if (!empty($statistics)) {
                    $statisticsElem = json_decode($statistics['elements'], true);
                ?>
                    <div class="services-area" data-aos="fade-up" data-aos-duration="1000">

                        <div class="row">

                            <div class="col-lg-6">
                                <!-- info-area -->
                                <div class="info-area-wrap">
                                    <h4 class="info-area-title text-white">ছাত্র/ছাত্রী তথ্য/রেজাল্ট</h4>
                                    <div class="info-content overflow-hidden">
                                        <img src="common/assets/img/service/service3.png" alt="image-not-found">
                                        <?php for ($i = 1; $i < 6; $i++) { ?>
                                            <div class="student-info-content item">
                                                <ul class="list-unstyled mt-3">
                                                    <li><a href="<?php echo $statisticsElem['widget_icon_' . $i] ?>"><?php echo $statisticsElem['widget_title_' . $i]; ?></a></li>

                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- ebook-area -->
                                <div class="ebook-area-wrap">
                                    <h4 class="ebook-area-title text-white">ই-বুক</h4>
                                    <div class="ebook-content overflow-hidden">
                                        <img src="common/assets/img/service/service4.png" alt="image-not-found">
                                        <?php for ($i = 6; $i < 11; $i++) { ?>
                                            <div class="ebook-info-content item">
                                                <ul class="list-unstyled mt-3">
                                                    <li><a href="<?php echo $statisticsElem['widget_icon_' . $i] ?>"><?php echo $statisticsElem['widget_title_' . $i]; ?></a></li>

                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- info-area start -->
                    <div class="info-area" data-aos="fade-up" data-aos-duration="1000">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <h4 class="download-info-title text-white">ডাউনলোড</h4>
                                <div class="download-info-cont overflow-hidden">
                                    <img src="common/assets/img/service/service1.png" alt="image-not-found">
                                    <?php for ($i = 11; $i < 16; $i++) { ?>
                                        <div class="item">
                                            <ul class="list-unstyled download-info-item-wrap mt-3">
                                                <li><a href="<?php echo $statisticsElem['widget_icon_' . $i] ?>"><?php echo $statisticsElem['widget_title_' . $i]; ?></a></li>

                                            </ul>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="notice-info-title text-white">নোটিশ</h4>
                                <div class="notice-info-cont overflow-hidden">
                                    <img src="common/assets/img/service/service2.png" alt="image-not-found">
                                    <?php for ($i = 16; $i < 22; $i++) { ?>
                                        <div class="item">
                                            <ul class="list-unstyled notice-info-item-wrap mt-3">
                                                <li><a href="<?php echo $statisticsElem['widget_icon_' . $i] ?>"><?php echo $statisticsElem['widget_title_' . $i]; ?></a></li>

                                            </ul>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-3">
                <aside class="sidebar-area overflow-hidden">



                    <!-- notice-area start -->
                    <div class="notice-area" data-aos="fade-left" data-aos-duration="1000">
                        <h4 class="notice-title text-white">নোটিস বোর্ড</h4>
                        <div class="notice-box">
                            <marquee direction="up" scrollamount="3px" onmouseover="this.stop()" onmouseout="this.start()">
                                <ul class="list-unstyled overflow-hidden mt-2">
                                    <?php
                                    $this->db->where('branch_id', $branchID);
                                    $services_list = $this->db->get('front_cms_services_list')->result_array();
                                    foreach ($services_list as $key => $value) {
                                    ?>
                                        <li>
                                            <a href="home/notice/<?php echo $cms_setting['url_alias']; ?>"><?php echo $value['title']; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </marquee>
                        </div>
                    </div>


                    <div class="academy-info-wrap overflow-hidden" data-aos="fade-left" data-aos-duration="1000">
                        <ul class="list-unstyled">
                            <?php
                            $this->db->where('branch_id', $branchID);
                            $testimonials = $this->db->get('front_cms_testimonial')->result_array();
                            foreach ($testimonials as $value) {
                            ?>
                                <li><a href="<?php echo $value['surname']; ?>" class="text-white"><?php echo $value['name']; ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>

                    <!-- facebook-area start -->
                    <div class="facebook-area" data-aos="fade-left" data-aos-duration="1000">

                        <?php
                        if (!empty($cta_box)) {
                            $elements = json_decode($cta_box['elements'], true);
                        ?>
                            <div class="fb-title"><a class="text-white"><?php echo $cta_box['title']; ?></a></div>
                            <div class="fb-page fb_iframe_widget" data-href="<?php echo $elements['mobile_no']; ?>" data-tabs="timeline" data-width="390" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=0&amp;height=350&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FMongalkandi-Online-Madrasha-103298654924760&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=true&amp;tabs=timeline&amp;width=390"><span style="vertical-align: bottom;width: 390px;height: 350px;overflow: hidden;"><iframe name="f2c5048802e0414" width="390px" height="350px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.5/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df37c3b31dd453c8%26domain%3DSchool Management%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252FSchool Management%252Ff2ed103b4f9f2d4%26relation%3Dparent.parent&amp;container_width=0&amp;height=350&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FMongalkandi-Online-Madrasha-103298654924760&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=true&amp;tabs=timeline&amp;width=390" style="border: none; visibility: visible; width: 390px; height: 350px;" class="" __idm_id__="7962625"></iframe></span>
                            <?php } ?>
                            </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
</div>