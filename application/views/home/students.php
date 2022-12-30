<section class="teacher-section">
            <div class="teacher-sec-wrap">
              <div class="container">
                <div class="teacher-content-wrap overflow-hidden">
                  <div class="row g-3 mb-5">
                    
                   
                    
                   
                   
                    
                    
                  <?php foreach ($students as $row) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="500">
                      <div class="teacher-thumb">
                        <a href="#">
                          <img src="<?php echo get_image_url('student', $row['photo']); ?>" alt="image-not-found">
                        </a>
                      </div>
                      <div class="teacher-info text-center">
                        <h4><a><?php echo $row['fullname'];?></a></h4>
                        <h5><a><?php echo $row['class_name'];?></a></h5>
                        <h5><a>Roll No:  <?php echo $row['roll'];?></a></h5>
                        <h5><a> Register No: <?php echo $row['register_no'];?></a></h5>
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