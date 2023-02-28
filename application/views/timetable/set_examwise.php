<?php $widget = (is_superadmin_loggedin() ? 3 : 4); ?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><?=translate('select_ground')?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
	<div class="panel-body">
		<div class="row mb-sm">
			<?php if (is_superadmin_loggedin()): ?>
			<div class="col-md-3 mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' required id='branch_id'
						data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
					?>
				</div>
			</div>
			<?php endif; ?>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('exam_name')?> <span class="required">*</span></label>
					<?php
						$arrayExam = array("" => translate('select_branch_first'));
						if(!empty($branch_id)){
							$exams = $this->db->get_where('exam', array('branch_id' => $branch_id,'session_id' => get_session_id()))->result();
							foreach ($exams as $exam){
								$arrayExam[$exam->id] = $this->application_model->exam_name_by_id($exam->id);
							}
						}
						echo form_dropdown("exam_id", $arrayExam, set_value('exam_id'), "class='form-control' id='exam_id' required
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
				</div>
			</div>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
					<?php
						$arrayClass = $this->app_lib->getClass($branch_id);
						echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
						required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
				</div>
			</div>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
					<?php
						$arraySection = $this->app_lib->getSections(set_value('class_id'));
						echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required 
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
				</div>
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-offset-10 col-md-2">
				<button type="submit" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
			</div>
		</div>
	</footer>
	<?php echo form_close();?>
</section>

<?php if(!empty($branch_id) && !empty($class_id)):?>
		<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations']?>" data-appear-animation-delay="100">
		<?php
			echo form_open('timetable/exam_create', array('class' => 'frm-submit-msg'));
			$data = array(
				'exam_id' => $exam_id,
				'class_id' => $class_id,
				'section_id' => $section_id,
				'branch_id' => $branch_id
			);
			echo form_hidden($data);
		?>
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-clock"></i> <?=translate('add') . " " . translate('schedule')?></h4>
			</header>
			<div class="panel-body" >
				<div class="table-responsive">
					<table class="table table-bordered table-condensed mt-md">
						<thead>
							<th><?=translate('subject')?> <span class="required">*</span></th>
							<th><?=translate('date')?> <span class="required">*</span></th>
							<th><?=translate('starting_time')?> <span class="required">*</span></th>
							<th><?=translate('ending_time')?> <span class="required">*</span></th>
							<th><?=translate('hall_room')?> <span class="required">*</span></th>
							<?php
							// getting exist exam distribution
							$examDistribution = $this->db->where('id', $exam_id)->get('exam')->row()->mark_distribution;
							$distribution = json_decode($examDistribution, true);
							foreach ($distribution as $id) {
							?>
							<th><?=get_type_name_by_id('exam_mark_distribution', $id)?> <span class="required">*</span></th>
							<?php } ?>	
							<!-- <th><?=translate('Action')?></th> -->
						</thead>
						<tbody id="timetable_entry_append">
							<?php 
							if (!empty($exist_data)) {
							foreach ($exist_data as $key => $value) { ?>
								<?php echo form_hidden(array('i[]' => $value['id'])); ?>
							<tr class="iadd">
								<?php echo form_hidden(array("old_id[$key]" => $value['id'])); ?>
								<td width="20%">
									<div class="form-group">
										<?php
										$selDis = ($value['break']) ? ' disabled ' : '';
											$arraySubject = array("" => translate('select'));
											$subjectAssign = $this->db->get_where('subject_assign', array(
												'class_id' => $class_id,
												'section_id' => $section_id,
												'session_id' => get_session_id(),
												'branch_id' => $branch_id
											))->result();
											foreach ($subjectAssign as $assign){
												$arraySubject[$assign->subject_id] = get_type_name_by_id('subject', $assign->subject_id);
											}
											echo form_dropdown("subject_id[]", $arraySubject, $value['subject_id'], "class='form-control' $selDis
											data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
										?>
										<span class="error"></span>
									</div>
								</td>
								<td width="20%">
									<div class="form-group">
										<?php
											$arrayTeacher = $this->app_lib->getStaffList($branch_id, 3);
											echo form_dropdown("timetable[$key][teacher]", $arrayTeacher, $value['teacher_id'], "class='form-control' $selDis
											data-plugin-selectTwo data-width='100%' ");
										?>
										<span class="error"></span>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="far fa-clock"></i></span>
											<input type="text" name="timetable[<?php echo $key ?>][time_start]" data-plugin-timepicker data-plugin-options ="{'timeFormat': 'HH:mm:ss'}" class="form-control" value="<?php echo $value['time_start'] ?>" />
										</div>
										<span class="error"></span>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="far fa-clock"></i></span>
											<input type="text" name="timetable[<?php echo $key ?>][time_end]" data-plugin-timepicker class="form-control" value="<?php echo $value['time_end'] ?>" />
										</div>
										<span class="error"></span>
									</div>
								</td>
								<td class="timet-td">
									<input type="text" class="form-control" name="timetable[<?php echo $key ?>][class_room]" value="<?php echo $value['class_room'] ?>">
									<button type="button" class="btn btn-danger removeTR"><i class="fas fa-times"></i> </button>
								</td>
							</tr>
						<?php } } else { ?>
							<tr class="iadd">
								<?php echo form_hidden(array('old_id[]' => 0)); ?>
								<td width="20%">
									<div class="form-group">
										<?php
											$arraySubject = array("" => translate('select'));
											$subjectAssign = $this->db->get_where('subject_assign', array(
												'class_id' => $class_id,
												'section_id' => $section_id,
												'session_id' => get_session_id(),
												'branch_id' => $branch_id
											))->result();
											foreach ($subjectAssign as $assign){
												$arraySubject[$assign->subject_id] = get_type_name_by_id('subject', $assign->subject_id);
											}
											echo form_dropdown("subject_id[]", $arraySubject, "", "class='form-control' data-plugin-selectTwo
											data-width='100%' data-minimum-results-for-search='Infinity' ");
										?>
										<span class="error"></span>
									</div>
								</td>
								<td class="min-w-sm">
									<div class="form-group mb-none">
										<input type="text" class="form-control" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' autocomplete="off"
										name="timetable[<?=$key?>][date]" value="<?=$row['exam_date']?>" />
										<span class="error"></span>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="far fa-clock"></i></span>
											<input type="text" name="timetable[0][time_start]" data-plugin-timepicker data-plugin-options ="{'timeFormat': 'HH:mm:ss'}" class="form-control" />
										</div>
										<span class="error"></span>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="far fa-clock"></i></span>
											<input type="text" name="timetable[0][time_end]" data-plugin-timepicker class="form-control" />
										</div>
										<span class="error"></span>
									</div>
								</td>

								<td class="min-w-sm">
								<div class="form-group mb-none">
									<?php
										if(!empty($branch_id)){
											$hall_array = array("" => translate('not_selected'));
											$halls = $this->db->get_where('exam_hall', array('branch_id' => $branch_id))->result();
											foreach ($halls as $hall){
												$hall_array[$hall->id] = $hall->hall_no;
											}
										}else{
											$hall_array = array("" => translate('select_branch_first'));
										}
										echo form_dropdown("hall_id[]", $hall_array, $row['hall_id'], "class='form-control' data-plugin-selectTwo
										data-width='100%' data-minimum-results-for-search='Infinity' ");
									?>
									<span class="error"></span>
								</div>
							</td>
							<?php
// getting exist mark
$getMark = json_decode($row['mark_distribution'], true);
foreach ($distribution as $id) {
	$full_mark = isset($getMark[$id]['full_mark']) ? $getMark[$id]['full_mark'] : "";
	$pass_mark = isset($getMark[$id]['pass_mark']) ? $getMark[$id]['pass_mark'] : "";
	?>

							<td>
								<div class="mark-inline">
								<div class="form-group mb-none mr-xs">
									<input type="text" class="form-control" style="width: 86px" autocomplete="off" placeholder="Full Mark" name="timetable[0][full_mark][<?=$id?>]" value="<?=$full_mark?>" />
									<span class="error"></span>
								</div>
								<div class="form-group mb-none">
									<input type="text" class="form-control" style="width: 86px" autocomplete="off" placeholder="Pass Mark" name="timetable[0][pass_mark][<?=$id?>]" value="<?=$pass_mark?>" />
									<span class="error"></span>
								</div>
								</div>
							
<?php } ?>
<!-- <div class="form-group mb-none">
<button type="button" class="btn btn-sm removeTR"> </button>
								</div> -->
								
</td>
							</tr>


						<?php } ?>
						</tbody>
					</table>
				</div>
				<input type="hidden" name="class_id" id="classID" value="<?=$class_id?>" />
				<input type="hidden" name="section_id" id="sectionID" value="<?=$section_id?>" />
				<input type="hidden" name="day" id="day" value="<?=$day?>" />
				<input type="hidden" name="branch_id" id="branchID" value="<?=$branch_id?>" />
				<button type="button" class="btn btn-default mt-xs mb-md" onclick="append_timetable_entry()">
					<i class="fas fa-plus-circle"></i> <?=translate('add_more')?>
				</button>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						 <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
						 	<i class="fas fa-plus-circle"></i> <?=translate('save')?>
						 </button>
					</div>
				</div>
			</footer>
			<?php echo form_close(); ?>
		</section>
		
		<script type="text/javascript">
			var lenght_div = <?php echo (empty($exist_data)) ? 1 : count($exist_data); ?>;
			
			$(document).on('change', "#timetable_entry_append input[type='checkbox']", function() {
				$(this).closest('tr').find('select').prop('disabled', this.checked);
			})
			
			function append_timetable_entry(){
				$("#timetable_entry_append").append(getDynamicInput(lenght_div));
				lenght_div++;
				
				$(".selectTwo").each(function() {
					var $this = $(this);
					$this.themePluginSelect2({});
				});
				$(".timepicker").each(function() {
					var $this = $(this);
					$this.themePluginTimePicker({});
				});
				$(".datepicker").each(function() {
					var $this = $(this);
					$this.themePluginDatePicker({});
				});
			}
			
			function getDynamicInput(value) {
				var row = "";
				row += '<tr class="iadd">';
				row += '<input type="hidden" name="old_id[' + value + ']" class="form-control" value="0" >';
				row += '<td width="20%"><div class="form-group">';
				row += '<select id="subject_id_' + value + '" name="subject_id[]" class="form-control selectTwo" data-width="100%">';
				row += '<option value=""><?php echo translate('select'); ?></option>';
<?php foreach ($subjectAssign as $assign): ?>
				row += '<option value="<?php echo $assign->subject_id ?>"><?php echo get_type_name_by_id('subject', $assign->subject_id) ?></option>';
<?php endforeach; ?>
				row += '</select>';
				row += '<span class="error"></span></div></td>';
				row += '<td class="center" width="90"><div class="form-group mb-none">';
				row += '<input type="text" class="form-control datepicker" name="timetable[' + value + '][date]">';
				row += '<span class="error"></span></div></td>';
				row += '<td><div class="form-group">';
				row += '<div class="input-group">';
				row += '<span class="input-group-addon"><i class="far fa-clock"></i></span>';
				row += '<input type="text" name="timetable[' + value + '][time_start]" class="form-control timepicker" >';
				row += '</div><span class="error"></span></div></td>';
				row += '<td><div class="form-group">';
				row += '<div class="input-group">';
				row += '<span class="input-group-addon"><i class="far fa-clock"></i></span>';
				row += '<input type="text" name="timetable[' + value + '][time_end]" class="form-control timepicker" >';
				row += '</div><span class="error"></span></div></td>';
				row += '<td width="20%"><div class="form-group">';
				row += '<select id="hall_id_' + value + '" name="hall_id[]" class="form-control selectTwo" data-width="100%">';
				row += '<option value=""><?php echo translate('select'); ?></option>';
<?php foreach ($halls  as $hall): ?>
				row += '<option value="<?php echo $hall->id ?>"><?php echo $hall->hall_no; ?></option>';
<?php endforeach; ?>
				row += '</select>';
				row += '<span class="error"></span></div></td>';
				<?php
// getting exist mark
$examDistribution = $this->db->where('id', $exam_id)->get('exam')->row()->mark_distribution;
$getMark = json_decode($row['mark_distribution'], true);
foreach ($distribution as $id) {
	$full_mark = isset($getMark[$id]['full_mark']) ? $getMark[$id]['full_mark'] : "";
	$pass_mark = isset($getMark[$id]['pass_mark']) ? $getMark[$id]['pass_mark'] : "";
	?>
				row += '<td><div class="mark-inline">';
				row += '<div class="form-group mb-none mr-xs">';
				row += '<input type="text" style="width: 86px" name="timetable[' + value + '][full_mark][<?=$id?>]" class="form-control" placeholder="Full Mark" autocomplete="off">';
				row += '<span class="error"></span></div>';
				row += '<div class="form-group mb-none mr-xs">';
				row += '<input type="text" style="width: 86px" name="timetable[' + value + '][pass_mark][<?=$id?>]" class="form-control" placeholder="Pass Mark" autocomplete="off">';
				row += '<span class="error"></span></div>';
				<?php } ?>
				row += '</td>';
				row += '<td>';
				row += '<button type="button" class="btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
				row += '</td>';
				row += '</tr>';
				return row;
			}
		</script>
		<?php endif;?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on("change", function() {
			var branchID = $(this).val();
			getClassByBranch(branchID);
			getExamByBranch(branchID);
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#timetable_entry_append").on('click', '.removeTR', function () {
			$(this).parent().parent().remove();
		});
	});
</script>