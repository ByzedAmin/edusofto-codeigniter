<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - School Management</title>
    <!-- Include fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- Include aos css -->
    <link rel="stylesheet" href="common/assets/css/aos.css" />
    <!-- Include bootstrap CSS -->
    <link rel="stylesheet" href="common/assets/css/bootstrap.min.css" />
    <!-- Include stylesheet CSS -->
    <link rel="stylesheet" href="common/assets/css/style.css" />
  </head>
  <body>
    <div class="body-wrap overflow-hidden">
      <!-- back-to-top start -->
      <div class="backtotop position-fixed">
        <a href="#!" class="scroll d-flex justify-content-center align-items-center position-relative">
           <i class="fas fa-arrow-up fw-bold text-white"></i>
        </a>
     </div>
     <!-- back-to-top end -->
      <div class="container site-main">
        <!-- header area start -->
        <header>
          <div class="logo-area">
            <a href="index.html">
              <img src="common/assets/img/logo/logo.jpg" alt="image-not-found" />
            </a>
          </div>
          <!-- navbar area start -->
          <div class="navbar-content-wrapper mb-2">
            <nav class="navbar navbar-expand-lg justify-content-end p-0">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav flex-wrap my-lg-0">
                      <li class="nav-item">
                        <a title="প্রচ্ছদ" class="nav-link text-white active" aria-current="page" href="index.html">প্রচ্ছদ</a>
                      </li>
                      <li class="nav-item">
                        <a title="সুবর্ণজয়ন্তী কর্ণার" class="nav-link text-white" href="corner.html">সুবর্ণজয়ন্তী কর্ণার</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a title="প্রশাসন" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            প্রশাসন
                        </a>
                        <ul class="dropdown-menu">
                          <li><a title="সভাপতি" class="dropdown-item text-white" href="#">সভাপতি</a></li>
                          <li><a title="অধ্যক্ষ" class="dropdown-item text-white" href="#">অধ্যক্ষ</a></li>
                          <li><a title="শিক্ষকবৃন্দ" class="dropdown-item text-white" href="teachers.html">শিক্ষকবৃন্দ</a></li>
                          <li><a title="গভর্ণিং বডি" class="dropdown-item text-white" href="#">গভর্ণিং বডি</a></li>
                          <li><a title="সাবেক সভাপতিগনের তালিকা" class="dropdown-item text-white" href="#">সাবেক সভাপতিগনের তালিকা</a></li>
                          <li><a title="সাবেক অধ্যক্ষগনের তালিকা" class="dropdown-item text-white" href="#">সাবেক অধ্যক্ষগনের তালিকা</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a title="মাদ্রাসা তথ্য" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           মাদ্রাসা তথ্য
                        </a>
                        <ul class="dropdown-menu">
                          <li><a title="প্রতিষ্ঠাতা" class="dropdown-item text-white" href="#">প্রতিষ্ঠাতা</a></li>
                          <li><a title="যাদের ত্যাগে প্রতিষ্ঠানটি আলোকিত" class="dropdown-item text-white" href="#">যাদের ত্যাগে প্রতিষ্ঠানটি আলোকিত</a></li>
                          <li><a title="স্বীকৃতি" class="dropdown-item text-white" href="#">স্বীকৃতি</a></li>
                          <li><a title="অধিভুক্তি" class="dropdown-item text-white" href="#">অধিভুক্তি</a></li>
                          <li><a title="এমপিও ভুক্তি" class="dropdown-item text-white" href="#">এমপিও ভুক্তি</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a title="শিক্ষার্থীদের তথ্য" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            শিক্ষার্থীদের তথ্য
                        </a>
                        <ul class="dropdown-menu">
                          <li><a title="৬ষ্ঠ শ্রেণী" class="dropdown-item text-white" href="#">৬ষ্ঠ শ্রেণী</a></li>
                          <li><a title="৭ম শ্রেণী" class="dropdown-item text-white" href="#">৭ম শ্রেণী</a></li>
                          <li><a title="৮ম শ্রেণী" class="dropdown-item text-white" href="#">৮ম শ্রেণী</a></li>
                          <li><a title="৯ম শ্রেণী" class="dropdown-item text-white" href="#">৯ম শ্রেণী</a></li>
                          <li><a title="১০ম শ্রেণী" class="dropdown-item text-white" href="#">১০ম শ্রেণী</a></li>
                          <li><a title="একাদ্বশ শ্রেণী" class="dropdown-item text-white" href="#">একাদ্বশ শ্রেণী</a></li>
                          <li><a title="দ্বাদশ শ্রেণী" class="dropdown-item text-white" href="#">দ্বাদশ শ্রেণী</a></li>
                          
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a title="নোটিশ" class="nav-link text-white" href="#">নোটিশ</a>
                      </li>
                      <li class="nav-item">
                        <a title="ব্লগ" class="nav-link text-white" href="#">ব্লগ</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a title="গ্যালারী" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            গ্যালারী
                        </a>
                        <ul class="dropdown-menu">
                          <li><a title="ফটোগ্যালারী" class="dropdown-item text-white" href="#">ফটোগ্যালারী</a></li>
                          <li><a title="ভিডিও গ্যালারী" class="dropdown-item text-white" href="#">ভিডিও গ্যালারী</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a title="বিভিন্ন তথ্য" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           বিভিন্ন তথ্য
                        </a>
                        <ul class="dropdown-menu">
                          <li><a title="কক্ষ সংখ্যা" class="dropdown-item text-white" href="#">কক্ষ সংখ্যা</a></li>
                          <li><a title="কম্পিউটার ব্যবহার" class="dropdown-item text-white" href="#">কম্পিউটার ব্যবহার</a></li>
                          <li><a title="ছাত্রছাত্রীর আসন সংখ্যা" class="dropdown-item text-white" href="#">ছাত্রছাত্রীর আসন সংখ্যা</a></li>
                          <li><a title="ভৌতকাঠমো" class="dropdown-item text-white" href="#">ভৌতকাঠমো</a></li>
                          <li><a title="মাল্টিমিডিয়া ক্লাসরুম" class="dropdown-item text-white" href="#">মাল্টিমিডিয়া ক্লাসরুম</a></li>
                          <li><a title="যানবাহন সুবিধা" class="dropdown-item text-white" href="#">যানবাহন সুবিধা</a></li>
                          <li><a title="শূণ্যপদের তালিকা" class="dropdown-item text-white" href="#">শূণ্যপদের তালিকা</a></li>
                          <li><a title="ছুটির তালিকা" class="dropdown-item text-white" href="#">ছুটির তালিকা</a></li>
                          <li><a title="সহপাঠ" class="dropdown-item text-white" href="#">সহপাঠ</a></li>
                          <li><a title="সার্কুলার" class="dropdown-item text-white" href="#">সার্কুলার</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a title="আইন/নীতিমালা" class="nav-link text-white" href="#">আইন/নীতিমালা</a>
                      </li>
                      <li class="nav-item">
                        <a title="লগইন" class="nav-link text-white" href="#">লগইন</a>
                      </li>
                    </ul>
                  </div>
              </nav>
          </div>
          <!-- banner area start -->
          <div class="banner-area-wrapper mb-3">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-bs-interval="10000">
                    <a href="index.html">
                        <img src="common/assets/img/banner/slide1.jpg" class="d-block w-100" alt="image-not-found">
                    </a>
                  </div>
                  <div class="carousel-item" data-bs-interval="2000">
                    <a href="index.html">
                        <img src="common/assets/img/banner/slide2.jpg" class="d-block w-100" alt="image-not-found">
                    </a>
                  </div>
                  <div class="carousel-item">
                    <a href="index.html">
                        <img src="common/assets/img/banner/slide3.jpg" class="d-block w-100" alt="image-not-found">
                    </a>
                  </div>
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
        <!-- main content start -->
        <main>
            <!-- latest-announcement start -->
            <section class="latest-announcement-sec mb-3">
              <div class="latest-announcement-cont">
                <div class="row">
                    <div class="col-lg-2 pe-0">
                        <div class="latest-announcement-title text-white">সর্বশেষ ঘোষনা</div>
                    </div>
                    <div class="col-lg-10 ps-0">
                        <marquee class="latest-announcement-desc"> <i class="fa fa-stop-circle"></i> <a href="#">২৬ এপ্রিল পর্যন্ত রমজান মাসে যথারীতী ক্লাস চলবে</a> <i class="fa fa-stop-circle"></i> <a href="#">মাদ্রাসার ফাযিল পরিক্ষা শুরু হচ্ছে আগামি 30-03-2022</a> <i class="fa fa-stop-circle"></i> <a href="#">আমাদের শিক্ষা প্রতিষ্ঠানে আপনাদের স্বাগতম।</a></marquee>
                    </div>
                </div>  
            </div>
            </section>
            <!-- site-main-content start -->
            <section class="site-main-content">
              <div class="row">
                <div class="col-lg-9">
                    <div class="institution-sec-wrap" data-aos="fade-up"
                    data-aos-duration="1000">
                        <h4 class="institution-title text-white">প্রতিষ্ঠানের ইতিহাস</h4>
                        <div class="institution-cont">
                            <img src="common/assets/img/institute/institute.jpg" alt="image-not-found">
                            <p class="institute-history">১৯৭৯  সালে প্রতিষ্ঠিত মঙলকান্দি ইসলামিয়া ফাযিল (ডিগ্রি) মাদ্রাসা  এর ধারাবাহিক সাফল্যে এলাকাবসীর দাবী ও শিক্ষার্থীদের চাহিদার প্রেক্ষিতে ডিজিটাল বাংলাদেশ গড়ার প্রত্যয়ে প্রতিষ্ঠিত করা হয়েছে। এই প্রতিষ্ঠানটি বর্তমানে কুমিল্লা জেলার অন্যতম শিক্ষা প্রতিষ্ঠানে পরিনত হয়েছে। এটি প্রতিষ্ঠানের পরিচালকবৃন্দ, শিক্ষকবৃন্দ, অভিভাবকবৃন্দ, শিক্ষার্থীদের ও সর্বোপরি এলাকাবাসীর সমন্বিত প্রচেষ্টার ফল। এলাকাবাসীর সেবার মনোভাব নিয়ে মান সম্পন্ন শিক্ষা প্রসারে এবং কৃতিত্বপূর্ণ <a href="blog-details.html" class="read-more text-white">read more</a></p>
                        </div>
                    </div>
                    <!-- speech-area start -->
                    <div class="row speech-area mb-3" data-aos="fade-up"
                    data-aos-duration="1000">
                        <div class="col-lg-6">
                            <h4 class="category-title text-white overflow-hidden">সভাপতির বাণী</h4>
                            <div class="profile">
                                <img src="common/assets/img/profile/profile1.jpg" alt="image-not-found">
                                <p class="speech-desc"> পড়! তোমার রবের নামে যিনি সৃষ্টি করেছেন (সূরা-আল্লাক্ব :১)। ডিজিটাল বাংলাদেশ গড়ার লক্ষ্যে মাদরাসা শিক্ষা শিক্ষাব্যবস্থাকে বেগবান ও আধুনিকায়ন করতে মাল্টিমিডিয়া ক্লাসসহ বিভিন্ন স্তরে তথ্য-প্রযুক্তি যে অবদান রাখছে তার জন্য বর্তমান গণপ্রজাতন্ত্রী বাংলাদেশ সরকার তথা মাননীয় প্রধানমন্ত্রী ও শিক্ষামন্ত্রীসহ সংশ্লিষ্ট সকলকে  জানাই আন্তরিক মোবারকবাদ। দেশের দ্বিমুখী শিক্ষা ব্যবস্থার প্রেক্ষাপটে ইসলামী ও আধুনিক শিক্ষার বাস্তব সমন্বয় <a href="blog-details.html" class="read-more text-white">read more</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="category-title text-white overflow-hidden">অধ্যক্ষের বাণী</h4>
                            <div class="profile">
                                <img src="common/assets/img/profile/profile2.jpg" alt="image-not-found">
                                <p class="speech-desc"> প্রিয়, সচেতন অভিভাকবৃন্দ। মানব জাতির সূচনা লগ্ন থেকে প্রাকৃতিক পরিবেশ ও বাস্তব অভিজ্ঞতা থেকে মানুষ প্রতিনিয়ত জ্ঞান ও কৌশল আয়ত্ব করে চলছে। আর শত সহস্র বছরের সঞ্চিত ও অর্জিত জ্ঞান শেখানো হয় শিক্ষা প্রতিষ্ঠানে। যুগের প্রয়োজনে মানবের কল্যাণে সমাজ হিতৈষী ব্যক্তিরা কখনো কখনো শিক্ষা প্রতিষ্ঠানের ভূমিকায় অবতীর্ণ হন। এমনিই ভাবেই দক্ষ, অভিজ্ঞ, জ্ঞানে সু-গভীর ও <a href="blog-details.html" class="read-more text-white">read more</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- services-area -->
                    <div class="services-area" data-aos="fade-up"
                    data-aos-duration="1000">
                      <div class="row">
                        <div class="col-lg-6">
                          <!-- info-area -->
                          <div class="info-area-wrap">
                            <h4 class="info-area-title text-white">ছাত্র/ছাত্রী তথ্য/রেজাল্ট</h4>
                            <div class="info-content overflow-hidden">
                              <img src="common/assets/img/service/service3.png" alt="image-not-found">
                              <div class="student-info-content">
                                <ul class="list-unstyled mt-3">
                                  <li><a href="#">অনলাইন ভর্তি</a></li>
                                  <li><a href="#">পরিক্ষা এডমিট কার্ড</a></li>
                                  <li><a href="#">সার্টিফিকেট</a></li>
                                  <li><a href="#">রেজাল্ট (মঙ্গলকান্দি মাদ্রাসা)</a></li>
                                  <li><a href="#">রেজাল্ট ( IAU ) ফাজিল ও কামিল</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <!-- ebook-area -->
                          <div class="ebook-area-wrap">
                            <h4 class="ebook-area-title text-white">ই-বুক</h4>
                            <div class="ebook-content overflow-hidden">
                              <img src="common/assets/img/service/service4.png" alt="image-not-found">
                              <div class="ebook-info-content">
                                <ul class="list-unstyled mt-3">
                                  <li><a href="#">ইবতেদায়ি স্তর</a></li>
                                  <li><a href="#">দাখিল স্তর</a></li>
                                  <li><a href="#">ইসলামিক বই</a></li>
                                  <li><a href="#">সিলেবাস (BMEB)</a></li>
                                  <li><a href="#">সিলেবাস (IAU)</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- info-area start -->
                    <div class="info-area" data-aos="fade-up"
                    data-aos-duration="1000">
                      <div class="row mb-3">
                        <div class="col-lg-6">
                            <h4 class="download-info-title text-white">ডাউনলোড</h4>
                            <div class="download-info-cont overflow-hidden">
                                <img src="common/assets/img/service/service1.png" alt="image-not-found">
                                <ul class="list-unstyled download-info-item-wrap mt-3">
                                    <li><a href="#">১ম সাময়িকি পরীক্ষার রুটিন ডাউনলোড</a></li>
                                    <li><a href="#">এসএসসি পরীক্ষার রুটিন ডাউনলোড</a></li>
                                    <li><a href="#">ছুটির নোটিশ ডাউনলোড</a></li>
                                    <li><a href="#">ভর্তি ফরম ডাউনলোড</a></li>
                                    <li><a href="#">পরীক্ষার রুটিন ডাউনলোড</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="notice-info-title text-white">নোটিশ</h4>
                            <div class="notice-info-cont overflow-hidden">
                                <img src="common/assets/img/service/service2.png" alt="image-not-found">
                                <ul class="list-unstyled notice-info-item-wrap mt-3">
                                    <li><a href="#">নোটিশ (ইসলামি আরবি বিশ্ববিদ্যালয়)</a></li>
                                    <li><a href="#">নোটিশ (মাদ্রাাসা শিক্ষা অধিদপ্তর)</a></li>
                                    <li><a href="#">নোটিশ (বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড)</a></li>
                                    <li><a href="#">নোটিশ (উপবৃত্তি)</a></li>
                                    <li><a href="#">নোটিশ (এনটিআরসিএ)</a></li>
                                    <li><a href="#">নোটিশ তিতাস উপজেলা</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                    <aside class="sidebar-area overflow-hidden">
                        <div class="academy-info-wrap overflow-hidden" data-aos="fade-left" data-aos-duration="1000">
                          <ul class="list-unstyled">
                            <li><a href="#" class="text-white">সুবর্ণজয়ন্তী কর্ণার</a></li>
                            <li><a href="#" class="text-white">শিক্ষা মন্ত্রণালয়</a></li>
                            <li><a href="#" class="text-white">মাদ্রাসা শিক্ষা অধিদপ্তর</a></li>
                            <li><a href="#" class="text-white">ইসলামি আরবী বিশ্ববিদ্যালয়</a></li>
                            <li><a href="#" class="text-white">বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড</a></li>
                            <li><a href="#" class="text-white">প্রধানমন্ত্রীর শিক্ষা সহায়তা ট্রাস্ট</a></li>
                            <li><a href="#" class="text-white">(এনটিআরসিএ)</a></li>
                            <li><a href="#" class="text-white">তিতাস উপজেলা</a></li>
                            <li><a href="#" class="text-white">সকল অনলাইন পত্রিকা</a></li>
                          </ul>
                        </div>
                        <!-- notice-area start -->
                        <div class="notice-area" data-aos="fade-left" data-aos-duration="1000">
                          <h4 class="notice-title text-white">নোটিস বোর্ড</h4>
                          <div class="notice-box">
                            <marquee direction="up" scrollamount="3px" onmouseover="this.stop()" onmouseout="this.start()">
                              <ul class="list-unstyled overflow-hidden mt-2">
                                <li>
                                  <a href="#">আগামী নির্বাচনী পরীক্ষা ৩১ মার্চের পরিবর্তে ৫ জুন অনুষ্ঠিত হবে</a>
                                </li>
                                <li>
                                  <a href="#">আগামী ১২ এপ্রিল বিজ্ঞান বিভাগের পরীক্ষা</a>
                                </li>
                                <li>
                                  <a href="#">স্কুলের ভিতর মোবাইল ব্যবহার করা সম্পূর্ণ নিষেধ</a>
                                </li>
                                <li>
                                  <a href="#">আমাদের শিক্ষা প্রতিষ্ঠানে আপনাদের স্বাগতম</a>
                                </li>
                              </ul>
                            </marquee>
                          </div>
                        </div>
                        <!-- facebook-area start -->
                        <div class="facebook-area" data-aos="fade-left" data-aos-duration="1000">
                          <div class="fb-title"><a href="#" class="text-white">Our Facebook Page</a></div>
                          <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/Mongalkandi-Online-Madrasha-103298654924760" data-tabs="timeline" data-width="390" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=0&amp;height=350&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FMongalkandi-Online-Madrasha-103298654924760&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=true&amp;tabs=timeline&amp;width=390"><span style="vertical-align: bottom;width: 390px;height: 350px;overflow: hidden;"><iframe name="f2c5048802e0414" width="390px" height="350px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.5/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df37c3b31dd453c8%26domain%3DSchool Management%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252FSchool Management%252Ff2ed103b4f9f2d4%26relation%3Dparent.parent&amp;container_width=0&amp;height=350&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FMongalkandi-Online-Madrasha-103298654924760&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=true&amp;tabs=timeline&amp;width=390" style="border: none; visibility: visible; width: 390px; height: 350px;" class="" __idm_id__="7962625"></iframe></span>
                          </div>
                        </div>
                    </aside>
                </div>
            </div>
            </section>
          </main>
      </div>
        <!-- footer area start -->
        <footer class="footer-area-sec">
            <div class="footer-area-wrap">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-6 col-md-4">
                            <div class="copyright-text text-white">© All rights reserved  S-Management</div>
                        </div>
                        <div class="col-sm-6 col-md-4 px-0">
                            <div class="social-links">
                                <ul class="d-flex align-items-center justify-content-md-center list-unstyled  py-3 mb-0">
                                    <li class="d-inline"><a href="#" class="text-white"><i class="fa-brands fa-facebook-f" target="_blank"></i></a></li>
                                    <li class="d-inline"><a href="#" class="text-white"><i class="fa-brands fa-twitter" target="_blank"></i></a></li>
                                    <li class="d-inline"><a href="#" class="text-white"><i class="fa-brands fa-google-plus-g" target="_blank"></i></a></li>
                                    <li class="d-inline"><a href="#" class="text-white"><i class="fa-brands fa-youtube" target="_blank"></i></a></li>
                                    <li class="d-inline"><a href="#" class="text-white"><i class="fa-brands fa-linkedin-in" target="_blank"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="create-author text-white"> Design & Developed by <a href="#" class="text-black" target="_blank">Imran Hosain</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Include jQuery JS -->
    <script src="common/assets/js/jquery.min.js"></script>
    <!-- Include bootstrap JS -->
    <script src="common/assets/js/bootstrap.bundle.min.js"></script>
    <!-- Include aos JS -->
    <script src="common/assets/js/aos.js"></script>
    <!-- Include custom JS -->
    <script src="common/assets/js/custom.js"></script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  </body>
</html>
