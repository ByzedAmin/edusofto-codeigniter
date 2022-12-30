<section class="site-main-content">

    <!-- Main Slider Section Starts -->

    <script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script>

    <div class="banner-area-wrapper mb-3">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                foreach ($sliders as $key => $value) {
                    $elements = json_decode($value['elements'], true);
                ?>
                    <div class="carousel-item active" data-bs-interval="10000">
                        <a href="index.html">
                            <img style="height: 600px;" src="<?php echo base_url('uploads/frontend/slider/' . $elements['image']) ?>" class="d-block w-100" alt="image-not-found">
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
    <main>
        <!-- latest-announcement start -->
        <section class="notice-section">
            <div class="notice-sec-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="notice-content-wrap overflow-hidden">
                                <?php
                                $this->db->where('branch_id', $branchID);
                                $services_list = $this->db->get('front_cms_faq_list')->result_array();
                                $i = 0;
                                foreach ($services_list as $key => $value) {
                                ?>
                                    <div class="" data-toggle="collapse" data-target="#demo<?php echo $i; ?>">
                                        <div class="notice-item-groups overflow-hidden" data-aos="fade-right" data-aos-duration="500">
                                            <h4 class="notice-title overflow-hidden">
                                                <i class="fa-solid fa-envelope text-white"></i> <a class="text-black"> <?php echo $value['title']; ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div id="demo<?php echo $i; ?>" class="collapse card card-body" style="margin-bottom: 50px;">
                                        <?php echo $value['description']; ?>
                                    </div>

                                <?php $i = $i + 1;
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>


</section>
</div>