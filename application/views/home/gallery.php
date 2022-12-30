
<section class="corner-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="corner-sec-content">
                            <h4 class="corner-sec-title text-center">গ্যালারী</h4>
                            <div class="corner-gallery-content">
                                <div class="row g-3">
                                <?php foreach ($galleryList as $row) { ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="corner-gallery-item">
                                            <img src="<?php echo $this->gallery_model->get_image_url($row['thumb_image']); ?>" alt="image-not-found">
                                        </div>
                                    </div>
                                    <?php } ?>
                                  
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
          </section>

          </main>
</div>