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
                        <?php
                        if (!is_null($balance)){
                            echo '<div class="alert alert-success">' . translate('your_sms_balance_is') . ' : ' . $balance . ' '. $branch['symbol'] ?? null .'</div>';
                        } else {
                            echo '<div class="alert alert-danger">' . translate('your_sms_balance_is') . ' : ' . translate('not_available') . '</div>';
                        }
                        ?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
