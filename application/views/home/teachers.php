<section class="teacher-section">
            <div class="teacher-sec-wrap">
              <div class="container">
                <div class="teacher-content-wrap overflow-hidden">
                  <div class="row g-3 mb-5">
                  <?php foreach ($doctor_list as $row) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="500">
                      <div class="teacher-thumb">
                        <a>
                          <img src="<?php echo get_image_url('staff', $row['photo']); ?>" alt="image-not-found">
                        </a>
                      </div>
                      <div class="teacher-info text-center">
                        <h4><a  style="font-size: 20px;font-weight: 600;"><?php echo $row['name']; ?></a></h4>
                        <h5><a><?php echo $row['qualification']; ?></a></h5>
                      </div>
                    </div>
                 
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </section>


          </main>
</div>