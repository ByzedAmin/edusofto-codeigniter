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

<!-- Main Banner Ends -->
<div class="container px-md-0 main-container">
    <div class="row">
        <div class="col-md-12">
            <div class="box2 form-box">
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
                            <table class="table table-condensed no-border" style="margin-top: 30px;">
                                <tbody>
                                <tr style="text-align: center">
                                    <td style="vertical-align: top; text-align: center">
                                        <img style="max-width:100%;" src="<?=base_url('uploads/app_image/'.$getSchool['report_card'])?>">
                                    </td>
                                    <td style="width: 15%; text-align: left">
                                        <img src="/uploads/images/student/<?= $student['photo'] ?>" alt="" class="img-thumbnail" style="max-height: 100px">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center; margin-top: 50px">
                                <span style="font-weight: 900; border: 1px solid rgba(0,0,0,0.75); border-radius: 50px; padding: 5px 10px; box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -webkit-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -moz-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75);">
                                    <?=(empty($page_data['title'])) ? translate('admission_form') : $page_data['title'] ?>
                                </span>
                            </div>

                            <table class="table table-condensed table-bordered" style="margin-top: 30px;">
                                <tbody>
                                <tr>
                                    <th>??????????????? ???????????????</td>
                                    <td colspan="2"><?=$student['id'] ?></td>
                                    <th>????????????????????? ???????????????</td>
                                    <td colspan="2"><?=_d($student['apply_date'])?></td>
                                </tr>
                                <tr>
                                    <th>??????????????????????????????</td>
                                    <td><?=get_type_name_by_id('schoolyear', get_global_setting('session_id'), "school_year")?></td>
                                    <th>??????????????????</td>
                                    <td colspan><?=$student['class_name'] ?></td>
                                    <th>????????????</td>
                                    <td><?=(empty($student['section_name'])) ? "???????????????????????? ??????" : $student['section_name'] ?></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-condensed table-bordered">
                                <tbody>
                                <tr>
                                    <td style="width: 3%"><?= translate('1.') ?></td>
                                    <td style="width: 20%">???????????????/????????????????????? ?????????</td>
                                    <td style="width: 1%">:</td>
                                    <td><?=$student['first_name'] .' ' . $student['last_name']?> </td>
                                </tr>
                                <tr>
                                    <td><?= translate('2.') ?></td>
                                    <td>??????????????? ?????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['father_name'])) ? "???????????????????????? ??????" : $student['father_name'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('3.') ?></td>
                                    <td>??????????????? ?????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['mother_name'])) ? "???????????????????????? ??????" : $student['mother_name'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('4.') ?></td>
                                    <td>????????????????????? ??????????????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['present_address'])) ? "???????????????????????? ??????" : $student['present_address'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('5.') ?></td>
                                    <td>?????????????????? ??????????????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['permanent_address'])) ? "???????????????????????? ??????" : $student['permanent_address'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('6.') ?></td>
                                    <td>???????????? ???????????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['birthday'])) ? "???????????????????????? ??????" : _d($student['birthday']) ?></td>
                                </tr>
                                <tr>
                                    <td><?= translate('7.') ?></td>
                                    <td>?????????????????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['nationality'])) ? "???????????????????????????" : $student['nationality'] ?></td>
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
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">??????????????????????????? ?????????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['guardian_name'])) ? "???????????????????????? ??????" : $student['guardian_name'] ?></td>
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">??????????????????????????? ??????????????????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_address'])) ? "???????????????????????? ??????" : $student['grd_address'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">????????????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_occupation'])) ? "???????????????????????? ??????" : $student['grd_occupation'] ?></td>
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">????????????????????? ??????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_income'])) ? "???????????????????????? ??????" : $student['grd_income'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">?????????????????????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['guardian_relation'])) ? "???????????????????????? ??????" : $student['guardian_relation'] ?></td>
                                                <td style="width: 3%">???.</td>
                                                <td style="width: 17.1%">?????????????????? ???????????????</td>
                                                <td style="width: 1%">:</td>
                                                <td style="width: 27.4%"><?=(empty($student['grd_mobile_no'])) ? "???????????????????????? ??????" : $student['grd_mobile_no'] ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= translate($counter +2 .'.') ?></td>
                                    <td>?????????????????? ?????? ?????? ??????????????????/ ??????????????????????????? ??????????????????????????? ????????????????????? ????????? ?????????</td>
                                    <td>:</td>
                                    <td>
                                        <?php $prevSchool = json_decode($student['previous_school_details'], true) ?>
                                        <?=(empty($prevSchool['school_name'])) ? "???????????????????????? ??????" : $prevSchool['school_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= translate($counter +3 .'.') ?></td>
                                    <td>????????? ???????????????????????? ??????????????? ????????? ??????????????????</td>
                                    <td>:</td>
                                    <td><?=(empty($student['class_name'])) ? "???????????????????????? ??????" : $student['class_name'] ?></td>
                                </tr>
                                </tbody>
                            </table>

                            <div style="text-align: center; margin-top: 50px;">
                                <span style="font-weight: 900; border: 1px solid rgba(0,0,0,0.75); border-radius: 50px; padding: 5px 10px; box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -webkit-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75); -moz-box-shadow: 5px 5px 5px 0 rgba(0,0,0,0.75);">
                                    <?=(empty($page_data['terms_conditions_title'])) ? "???????????????????????? ????????????" : $page_data['terms_conditions_title'] ?>
                                </span>
                            </div>

                            <div style="margin-top: 20px">
                                <?=(empty($page_data['terms_conditions_description'])) ? "???????????????????????? ??????" : $page_data['terms_conditions_description'] ?>
                            </div>


                            <table class="table no-border" style="margin-top: 20px">
                                <tbody>
                                <tr>
                                    <td>
                                        <span style="border-top: 1px solid black">??????????????????????????? ????????????????????????</span><br>
                                        <span>?????????????????? .......................</span>
                                    </td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">???????????????/????????????????????? ????????????????????????</span><br>
                                        <span>?????????????????? .......................</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>?????????????????? ???????????????????????? ???????????????????????? ????????????????????? ??????????????? ??????????????? ???????????? ???????????????/???????????????????????? <strong><?= $student['class_name'] ?></strong> ???????????????????????? ??????????????? ???????????? ????????????????????? ????????? ?????????</td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">?????????????????? ???????????????????????? ????????????????????????</span><br>
                                        <span>?????????????????? .......................</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><?= $student['class_name'] ?></strong> ???????????????????????? ??????????????? ???????????? ?????????????????? ?????????????????? ????????? ?????????</td>
                                    <td style="text-align: right">
                                        <span style="border-top: 1px solid black">??????????????????????????? ????????????????????????</span><br>
                                        <span>?????????????????? .......................</span>
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




