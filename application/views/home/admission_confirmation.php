<style type="text/css">
    #print {
        margin-bottom: 20px;
        margin-top: 0px;
        padding: 2px 15px;
        font-size: 14px;
        font-weight: 500;
    }
    .main-banner {
        padding-top: 130px;
        padding-bottom: 70px;
        background-size: cover !important;
    }

    .main-banner h2 {
        margin-top: 0;
        margin-bottom: 0;
        color: #323232;
    }

    .main-banner h2::first-letter {
        color: #ff685c;
    }

    .main-banner h2 span {
        padding: 14px 50px 16px 30px;
        letter-spacing: 0.3px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 28px 0;
    }
</style>
<!-- Main Banner Starts -->
<!-- <div class="main-banner" style="background: url(<?php echo base_url('uploads/frontend/banners/' . $page_data['banner_image']); ?>) center top;">
    <div class="container px-md-0">
        <h2><span><?php echo $page_data['page_title']; ?></span></h2>
    </div>
</div> -->
<!-- Main Banner Ends -->
<div class="container px-md-0 main-container">
    <div class="row">
        <div class="col-md-12">
            <div class="box2 form-box">
                <?php
                if($this->session->flashdata('success')) {
                    echo '<div class="alert alert-success"><i class="icon-text-ml far fa-check-circle"></i>' . $this->session->flashdata('success') . '</div>';
                }
                ?>

                <div id="card_holder">
                    <button type="button" class="btn btn-1" id="print"><i class="fas fa-print"></i> <?=translate('print')?></button>
                    <div id="card">

                        <style type="text/css">
                            @media print {
                                .pagebreak {
                                    page-break-before: always;
                                }

                                tbody, td, tfoot, th, thead, tr {
                                    border-color: transparent!important;
                                    border-style: none!important;
                                }
                            }
                            .mark-container {
                                background: #fff;
                                width: 1000px;
                                position: relative;
                                z-index: 2;
                                margin: 0 auto;
                                padding: 20px 30px;
                            }
                            table {
                                border-collapse: collapse;
                                width: 100%;
                                margin: 0 auto;
                            }

                            .no-border tbody, .no-border td, .no-border tfoot, .no-border th, .no-border thead, .no-border tr {
                                border-color: transparent!important;
                                border-style: none!important;
                            }
                        </style>
                        <?php $getSchool = $this->db->where(array('id' => $student['branch_id']))->get('branch')->row_array(); ?>
                        <div class="mark-container">
                            <div class="container">
                                <table class="table no-border" style="margin-top: 20px; height: 100px;">
                                    <tbody>
                                    <tr style="text-align: center">
                                        <td style="vertical-align: top; text-align: center">
                                            <img style="max-width:100%;" src="<?=base_url('uploads/app_image/'.$getSchool['report_card'])?>">
                                        </td>
                                        <td style="width: 15%; text-align: left">
                                            <img src="/uploads/images/student/<?= $student['student_photo'] ?>" alt="" class="img-thumbnail" style="max-height: 100px">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align: center; margin-top: 50px">
                                <span style="font-weight: 900; border: 1px solid rgba(0,0,0,0.75); border-radius: 50px; padding: 5px 10px; box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -webkit-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -moz-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75);">
                                    <?=(empty($page_data['title'])) ? translate('admission_form') : $page_data['title'] ?>
                                </span>
                            </div>

                            <table class="table table-condensed table-bordered" style="margin-top: 30px;">
                                <tbody>
                                <tr>
                                    <th>ভর্তি নম্বর</td>
                                    <td colspan="2"><?=$student['id'] ?></td>
                                    <th>আবেদনের তারিখ</td>
                                    <td colspan="2"><?=_d($student['apply_date'])?></td>
                                </tr>
                                <tr>
                                    <th>শিক্ষাবর্ষ</td>
                                    <td><?=get_type_name_by_id('schoolyear', get_global_setting('session_id'), "school_year")?></td>
                                    <th>শ্রেণী</td>
                                    <td colspan><?=$student['class_name'] ?></td>
                                    <th>শাখা</td>
                                    <td><?=(empty($student['section_name'])) ? "প্রযোজ্য নয়" : $student['section_name'] ?></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-condensed table-bordered">
                                <tbody>
                                <tr>
                                    <td style="width: 3%"><?= translate('1.') ?></td>
                                    <td style="width: 20%">ছাত্র/ছাত্রীর নাম</td>
                                    <td style="width: 1%">:</td>
                                    <td><?=$student['first_name'] .' ' . $student['last_name']?> </td>
                                </tr>
                                <tr>
                                    <td><?= translate('2.') ?></td>
                                    <td>পিতার নাম</td>
                                    <td>:</td>
                                    <td><?=(empty($student['father_name'])) ? "প্রযোজ্য নয়" : $student['father_name'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('3.') ?></td>
                                    <td>মাতার নাম</td>
                                    <td>:</td>
                                    <td><?=(empty($student['mother_name'])) ? "প্রযোজ্য নয়" : $student['mother_name'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('4.') ?></td>
                                    <td>বর্তমান ঠিকানা</td>
                                    <td>:</td>
                                    <td><?=(empty($student['present_address'])) ? "প্রযোজ্য নয়" : $student['present_address'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('5.') ?></td>
                                    <td>স্থায়ী ঠিকানা</td>
                                    <td>:</td>
                                    <td><?=(empty($student['permanent_address'])) ? "প্রযোজ্য নয়" : $student['permanent_address'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('6.') ?></td>
                                    <td>জন্ম তারিখ</td>
                                    <td>:</td>
                                    <td><?=(empty($student['birthday'])) ? "প্রযোজ্য নয়" : _d($student['birthday']) ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('7.') ?></td>
                                    <td>জাতীয়তা</td>
                                    <td>:</td>
                                    <td><?=(empty($student['nationality'])) ? "বাংলাদেশী" : $student['nationality'] ?></td>
                                </tr>

                                <?php
                                $show_custom_fields = custom_form_table('student', $student['branch_id']);
                                $counter = 7;
                                if (count($show_custom_fields)) {
                                    foreach ($show_custom_fields as $fields) {
                                        $counter++;
                                        ?>
                                       <tr>
                                           <td><?= translate($counter.'.') ?></td>
                                           <td><?= $fields['field_label'] ?></td>
                                           <td>:</td>
                                           <td><?php echo get_table_custom_field_value($fields['id'], $student['id']);?></td>
                                       </tr>
                                    <?php } } ?>

                                <tr>
                                    <td><?= translate($counter +1 .'.') ?></td>
                                    <td colspan="3" style="padding-bottom: 0;">
                                        <table class="table table-condensed table-bordered" style="margin-bottom: 5px">
                                            <tbody>
                                            <tr>
                                                <td style="width: 3%">ক.</td>
                                                <td style="width: 17.1%">অভিভাবকের নাম</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['guardian_name'])) ? "প্রযোজ্য নয়" : $student['guardian_name'] ?></td>
                                                <td style="width: 3%">খ.</td>
                                                <td style="width: 17.1%">অভিভাবকের ঠিকানা</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_address'])) ? "প্রযোজ্য নয়" : $student['grd_address'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 3%">গ.</td>
                                                <td style="width: 17.1%">পেশা</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_occupation'])) ? "প্রযোজ্য নয়" : $student['grd_occupation'] ?></td>
                                                <td style="width: 3%">ঘ.</td>
                                                <td style="width: 17.1%">বাৎসরিক আয়</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_income'])) ? "প্রযোজ্য নয়" : $student['grd_income'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 3%">ঙ.</td>
                                                <td style="width: 17.1%">সম্পর্ক</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['guardian_relation'])) ? "প্রযোজ্য নয়" : $student['guardian_relation'] ?></td>
                                                <td style="width: 3%">চ.</td>
                                                <td style="width: 17.1%">মোবাইল নম্বর</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_mobile_no'])) ? "প্রযোজ্য নয়" : $student['grd_mobile_no'] ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= translate($counter +2 .'.') ?></td>
                                    <td>পূর্বে সে যে স্কুলে/ মাদ্রাসায় অদ্ধ্যায়ন করিয়াছে তার নাম</td>
                                    <td>:</td>
                                    <td>
                                        <?php $prevSchool = json_decode($student['previous_school_details'], true) ?>
                                        <?=(empty($prevSchool['school_name'])) ? "প্রযোজ্য নয়" : $prevSchool['school_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= translate($counter +3 .'.') ?></td>
                                    <td>কোন শ্রেণীতে ভর্তি হতে ইচ্ছুক</td>
                                    <td>:</td>
                                    <td><?=(empty($student['class_name'])) ? "প্রযোজ্য নয়" : $student['class_name'] ?></td>
                                </tr>
                                </tbody>
                            </table>

                            <div style="text-align: center; margin-top: 50px;">
                                <span style="font-weight: 900; border: 1px solid rgba(0,0,0,0.75); border-radius: 50px; padding: 5px 10px; box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -webkit-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -moz-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75);">
                                    <?=(empty($page_data['terms_conditions_title'])) ? "অঙ্গীকার নামা" : $page_data['terms_conditions_title'] ?>
                                </span>
                            </div>

                            <div style="margin-top: 20px">
                                <?=(empty($page_data['terms_conditions_description'])) ? "প্রযোজ্য নয়" : $page_data['terms_conditions_description'] ?>
                            </div>


                            <table class="table no-border" style="margin-top: 20px">
                                <tbody>
                                <tr>
                                    <td>
                                        <span style="border-top: 1px solid black">অভিভাবকের স্বাক্ষর</span><br>
                                        <span>তারিখঃ .......................</span>
                                    </td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">ছাত্র/ছাত্রীর স্বাক্ষর</span><br>
                                        <span>তারিখঃ .......................</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>শ্রেণী শিক্ষকের মন্তব্যঃ পরীক্ষা গ্রহণ করিয়া উক্ত ছাত্র/ছাত্রীকে <strong><?= $student['class_name'] ?></strong> শ্রেণীতে ভর্তি করার সুপারিশ করা হল।</td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">শ্রেণী শিক্ষকের স্বাক্ষর</span><br>
                                        <span>তারিখঃ .......................</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><?= $student['class_name'] ?></strong> শ্রেণীতে ভর্তি করার অনুমতি প্রদান করা হল।</td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">অধ্যক্ষের স্বাক্ষর</span><br>
                                        <span>তারিখঃ .......................</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <?php if ($student['payment_status'] == 1) {
                                $paymentDetails = json_decode($student['payment_details'], true);

                                ?>
                                <h4 style="padding-top: 30px">Payment Details</h4>
                                <table class="table" style="margin-top: 20px;">
                                    <tbody>
                                    <tr>
                                        <th>Paid Amount</td>
                                        <td><?=$student['symbol'] . " " .  $student['payment_amount'] ?></td>
                                        <th>Payment Method</td>
                                        <td colspan="2"><?=ucfirst($paymentDetails['payment_method'])?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#print').on('click', function(e){
            var oContent = document.getElementById('card').innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title></title>');
            frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/vendor/bootstrap/css/bootstrap.min.css">');
            frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/css/custom-style.css">');
            frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/css/certificate.css">');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(oContent);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>




