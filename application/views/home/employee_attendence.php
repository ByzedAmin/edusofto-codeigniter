<?php $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<style>
	.select2-container .select2-selection, .select2-selection__rendered, .select2-selection__arrow {
    border-radius: 0 !important;
    height: 40px !important;
    line-height: 20px !important;
}
.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    margin-left: -1px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    width: 41px;
}

</style>
<section class="panel">
	<?php echo form_open($this->uri->uri_string()); ?>
    <header class="panel-heading">
		<h4 class="panel-title"><?=translate('select_ground')?></h4>
	</header>
	<div class="panel-body">
		<div class="row mb-sm">
			<?php if (is_superadmin_loggedin() ): ?>
				<div class="col-md-4 mb-sm">
					<div class="form-group">
						<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
					</div>
					<span class="error"><?=form_error('branch_id')?></span>
				</div>
			<?php endif; ?>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('role')?> <span class="required">*</span></label>
					<?php
						$role_list = $this->app_lib->getRoles();
						echo form_dropdown("staff_role", $role_list, set_value('staff_role'), "class='form-control'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
				</div>
			</div>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('month')?> <span class="required">*</span></label>
					<div class="input-group">
						<input type="text" class="form-control" name="timestamp" style="height: 38px;" value="<?=set_value('timestamp', date('Y-F'))?>" data-plugin-datepicker required
						data-plugin-options='{ "format": "yyyy-MM", "minViewMode": "months", "orientation": "bottom"}' />
						<span class="input-group-addon"><i class="icon-event icons"></i></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-offset-10 col-md-2">
				<button type="submit" name="search" value="1" class="btn btn btn-default btn-block" style="color: black;background-color: gainsboro;font-size: 14px;">
					<i class="fas fa-filter"></i> <?=translate('filter')?>
				</button>
			</div>
		</div>
	</footer>
	<?php echo form_close(); ?>
</section>

<?php if (isset($stafflist)): ?>
	<section class="panel appear-animation mt-sm" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-users"></i> <?=translate('attendance_report')?></h4>
		</header>
		<div class="panel-body">
			<div class="row mt-sm">
				<div class="col-md-offset-8 col-md-4">
					<table class="table table-condensed table-bordered text-dark text-center">
						<tbody>
							<tr>
								<td>Present : <i class="far fa-check-circle hidden-print text-success"></i><span class="visible-print">P</span></td>
								<td>Absent : <i class="far fa-times-circle hidden-print text-danger"></i><span class="visible-print">A</span></td>
								<td>Holiday : <i class="fas fa-hospital-symbol hidden-print text-info"></i><span class="visible-print">H</span></td>
								<td>Late : <i class="far fa-clock hidden-print text-tertiary"></i><span class="visible-print">L</span></td>
								<td>Half Holiday : <i class="fas fa-bold text-warning" style='font-size:11px'></i><span class="visible-print">B</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="export_title">Employees Attendance Sheet on <?=date("F Y", strtotime($year.'-'.$month))?></div>
					<table class="table table-bordered table-hover table-condensed mb-none text-dark table-export">
						<thead>
							<tr>
								<td><?=translate('employee')?></td>
<?php
for($i = 1; $i <= $days; $i++){
$date = $year . '-' . $month . '-' . $i;
?>
								<td class="text-center"><?php echo date('D', strtotime($date)); ?> <br> <?php echo date('d', strtotime($date)); ?></td>
<?php } ?>
								<td class="text-center text-success">Total<br>Present</td>
								<td class="text-center text-danger">Total<br>Absent</td>
								<td class="text-center text-tertiary">Total<br>Late</td>
							</tr>
						</thead>
						<tbody>
							<?php									 
							foreach ($stafflist as $row):
							$staffID = $row['id'];
							?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<?php
									$total_present = 0;
									$total_absent = 0;
									$total_late = 0;
									for ($i = 1; $i <= $days; $i++) {
										$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
										$getAttendance = $this->db->get_where('staff_attendance', array('staff_id' => $staffID,'date' => $date))->row_array();
										$status = $getAttendance['status'];
										echo '<td class="center"><span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="' . $getAttendance['remark'] . '">'; ?>
										<?php if ($getAttendance['status'] == 'A') { $total_absent++; ?>
											<i class="far fa-times-circle text-danger"></i><span class="visible-print">A<?php if($getAttendance['remark']) { ?> / <?php } ?></span><br/><span><?php echo $getAttendance['remark'] ; ?></span>
										<?php } if ($getAttendance['status'] == 'P') { $total_present++; ?>
																			<i class="far fa-check-circle text-success"></i><span class="visible-print">P<?php if($getAttendance['remark']) { ?> / <?php } ?></span><br/><span><?php echo $getAttendance['remark'] ; ?></span>
										<?php } if ($getAttendance['status'] == 'L') { $total_late++; ?>
																			<i class="far fa-clock text-info"></i><span class="visible-print">L<?php if($getAttendance['remark']) { ?> / <?php } ?></span><br/><span><?php echo $getAttendance['remark'] ; ?></span>
										<?php } if ($getAttendance['status'] == 'H'){ ?>
																			<i class="fas fa-hospital-symbol text-tertiary"></i><span class="visible-print">H<?php if($getAttendance['remark']) { ?> / <?php } ?></span><br/><span><?php echo $getAttendance['remark'] ; ?></span>
										<?php } if ($getAttendance['status'] == 'B'){ ?>
																			<i class="fas fa-bold text-warning" style='font-size:11px'></i><span class="visible-print">B<?php if($getAttendance['remark']) { ?> / <?php } ?></span><br/><span><?php echo $getAttendance['remark'] ; ?></span>
										<?php } ?><?php
										echo '</span></td>';
									}
								?>
								<td class="center"><?=$total_present?></td>
								<td class="center"><?=$total_absent?></td>
								<td class="center"><?=$total_late?></td>
								<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>