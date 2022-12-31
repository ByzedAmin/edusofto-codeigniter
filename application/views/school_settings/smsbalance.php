<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
                    <li>
                        <a href="<?=base_url('school_settings/smsconfig' . $url)?>"><i class="far fa-envelope"></i> <?=translate('sms_config')?></a>
                    </li>
					<li>
						<a href="<?=base_url('school_settings/smstemplate' . $url)?>"><i class="fas fa-sitemap"></i> <?=translate('sms_triggers')?></a>
					</li>
                    <li class="active">
                        <a href="#sms_balance" data-toggle="tab"><i class="fas fa-money-bill"></i> <?=translate('Smsbalance')?></a>
                    </li>
				</ul>
				<div class="tab-content">
					<div id="sms_balance" class="tab-pane active">
                        <section class="panel panel-custom">
                            <?php echo form_open('school_settings/check_sms_balance' . $url, array( 'class' => 'frm-submit-msg')); ?>
                            <input type="hidden" name="branch_id" value="<?=$branch_id?>">
                            <div class="panel-body panel-body-custom">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6 mb-sm">
                                        <label class="control-label"><?=translate('activated_sms_gateway')?> <span class="required">*</span></label>
                                        <?php
                                        $sms_service_provider = $this->application_model->smsServiceProvider($branch_id);
                                        $arraySMS = array(
                                            "1" 		=> "Twilio",
                                            "2" 		=> "Clickatell",
                                            "3" 		=> "Msg91",
                                            "4" 		=> "MyDokani",
                                            "5" 		=> "Textlocal",
                                            "6" 		=> "SMS country",
                                            "7" 		=> "Bulksmsbd.net",
                                        );
                                        echo form_dropdown("sms_service_provider", $arraySMS, set_value('sms_service', $sms_service_provider), "class='form-control'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
                                        ?>
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer panel-footer-custom">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-2">
                                        <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
                                            <i class="fas fa-bars-progress"></i> <?=translate('Check')?>
                                        </button>
                                    </div>
                                </div>
                            </footer>
                            <?php echo form_close();?>
                        </section>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
