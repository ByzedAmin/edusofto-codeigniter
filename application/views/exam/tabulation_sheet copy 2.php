<?php
$widget = (is_superadmin_loggedin() ? 2 : 3);
$branch = $this->db->where('id',$branch_id)->get('branch')->row_array();
?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<?php echo form_open('exam/tabulation_sheet', array('class' => 'validate')); ?>
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<div class="panel-body">
				<div class="row mb-sm">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-3 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
					<div class="col-md-<?=$widget?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('academic_year')?> <span class="required">*</span></label>
							<?php
								$arrayYear = array("" => translate('select'));
								$years = $this->db->get('schoolyear')->result();
								foreach ($years as $year){
									$arrayYear[$year->id] = $year->school_year;
								}
								echo form_dropdown("session_id", $arrayYear, set_value('session_id', get_session_id()), "class='form-control' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?=$widget?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('exam')?> <span class="required">*</span></label>
							<?php
								
								if(!empty($branch_id)){
									$arrayExam = array("" => translate('select'));
									$exams = $this->db->get_where('exam', array('branch_id' => $branch_id,'session_id' => get_session_id()))->result();
									foreach ($exams as $exam){
										$arrayExam[$exam->id] = $this->application_model->exam_name_by_id($exam->id);
									}
								} else {
									$arrayExam = array("" => translate('select_branch_first'));
								}
								echo form_dropdown("exam_id", $arrayExam, set_value('exam_id'), "class='form-control' id='exam_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>

					<div class="col-md-3 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
							<?php
								$arrayClass = $this->app_lib->getClass($branch_id);
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>

					<div class="col-md-<?=$widget?>">
						<div class="form-group">
							<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
							<?php
								$arraySection = $this->app_lib->getSections(set_value('class_id'), true);
								echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" name="submit" value="search" class="btn btn-default btn-block"><i class="fas fa-filter"></i> <?=translate('filter')?></button>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</section>

		<?php if (isset($get_subjects)) { ?>
			<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
				<header class="panel-heading">
					<h4 class="panel-title">
						<i class="fas fa-users"></i> <?=translate('tabulation_sheet')?>
					</h4>
				</header>
				<div class="panel-body">
					<div class="table-responsive mt-sm mb-md">
						<div id="printResult">
							<!-- hidden school information prints -->
							<div class="visible-print">
								<center>
									<h4 class="text-dark text-weight-bold"><?=$branch['name']?></h4>
									<h5 class="text-dark"><?=$branch['address']?></h5>
									
									<h5 class="text-dark text-weight-bold"><?=$this->application_model->exam_name_by_id(set_value('exam_id'))?> - Tabulation Sheet</h5>
									<h5 class="text-dark">
										<?php 
										echo translate('class') . ' : ' . get_type_name_by_id('class', set_value('class_id'));
										echo ' ( ' . translate('section') . ' : ' . get_type_name_by_id('section', set_value('section_id')) . ' )';
										?>
									</h5>
									<hr>
								</center>
							</div>
							<table class="table table-bordered table-hover table-condensed mb-none">
								<thead class="text-dark">
									<tr>
										<td rowspan="2"><?=translate('sl')?></td>
										<td rowspan="2"><?=translate('students')?></td>
										<!-- <td rowspan="2"><?=translate('register_no')?></td> -->
										<td rowspan="2"><?=translate('roll')?></td>
                                        <?php
									$getExam = $this->db->where(array('id' => set_value('exam_id')))->get('exam')->row_array();
									$markDistribution = json_decode($getExam['mark_distribution'], true);
									$colspan = count($markDistribution);
									
                                        foreach($get_subjects as $subject){
                                        	$fullMark = array_sum(array_column(json_decode($subject['mark_distribution'], true), 'full_mark')); ?>
											<td colspan="<?=$colspan+2?>" style="text-align: center;"><?php echo $subject['subject_name']; ?>(<?php echo $fullMark ?>)</td>
                                        <?php }?>
										
										<td rowspan="2"><?=translate('total_marks')?></td>
										<td rowspan="2">GPA</td>
										<td rowspan="2"><?=translate('result')?></td>
									</tr>
									<tr>


									<?php 
									foreach($get_subjects as $subject){
									foreach ($markDistribution as $id) { ?>
									<td><?php echo substr(get_type_name_by_id('exam_mark_distribution',$id), 0, 2);  ?></td>
									
									<?php } ?>
									<td>To</td>
									<td>Gp</td>
									<?php } ?>
									
								</tr>
								</thead>
								<tbody>
									<?php
									$count = 1;
									$enrolls = $this->db->get_where('enroll', array(
										'class_id' 		=> set_value('class_id'),
										'section_id' 	=> set_value('section_id'),
										'session_id' 	=> set_value('session_id'),
										'branch_id' 	=> $branch_id,
									))->result_array();
									if(count($enrolls)) {
										foreach($enrolls as $enroll):
											$stu = $this->db->select('CONCAT(first_name, " ", last_name) as fullname,register_no',)
											->where('id', $enroll['student_id'])
											->get('student')->row_array();
											?>
											
									<tr>
										<td><?php echo $count++; ?></td>
										<td><?php echo $stu['fullname']; ?></td>
										<!-- <td><?php echo $stu['register_no']; ?></td> -->
										<td><?php echo $enroll['roll']; ?></td>
										
										<?php
										$totalMarks 		= 0;
										$totalFullmarks 	= 0;
										$totalGradePoint 	= 0;
										$grand_result 		= 0;
										$unset_subject 		= 0;
										$result_status = 1;
										$totalAddGradePoint= 0;
										$total_op_point = 0;
										foreach ($get_subjects as $subject):
											
											?>
										<!-- <td> -->
										<?php
											$this->db->where(array(
												'class_id' 	 => set_value('class_id'),
												'exam_id'	 => set_value('exam_id'),
												'subject_id' => $subject['subject_id'],
												'student_id' => $enroll['student_id'],
												'session_id' => set_value('session_id')
											));
											
											$getMark = $this->db->get('mark')->row_array();
											if (!empty($getMark)) {
												if ($getMark['absent'] != 'on') {
													$totalObtained = 0;
													$totalFullMark = 0;
													$result1_status = 1;
													$fullMarkDistribution = json_decode($subject['mark_distribution'], true);
													$obtainedMark = json_decode($getMark['mark'], true);
													foreach ($fullMarkDistribution as $i => $val) {
														$obtained_mark = floatval($obtainedMark[$i]);
														if($obtained_mark!=0){
															echo '<td>' . $obtained_mark .'</td>';
														}else{
															echo '<td>' . 'N' .'</td>';
														}
														
														$totalObtained += $obtained_mark;
														$totalFullMark += $val['full_mark'];
														$passMark = floatval($val['pass_mark']);
														$fullMark = floatval($val['full_mark']);
														if ($obtained_mark < $passMark) {
															$result_status = 0;
														}
														if ($obtained_mark < $passMark) {
															$result1_status = 0;
														}
														$total_full_marks += $fullMark;
													}
													if($totalObtained){
														echo '<td>'.$totalObtained .'</td>';
													}else{
														echo '<td>'.'N' .'</td>';
													}
													
													
													if ($totalObtained != 0 && !empty($totalObtained)) {
														$percentage_grade = ($totalObtained * 100) / $totalFullMark;
														$grade = $this->exam_model->get_grade($percentage_grade, $branch_id);
														$totalGradePoint += $grade['grade_point'];
														if($subject['add_subject_code']==null){
															$total_op_point += $grade['grade_point'];
															
														}
													}
													// print_r($result1_status);
													if($result1_status==0){
														echo '<td>0</td>';
													}else{
														echo '<td>'.$grade['grade_point'] .'</td>';
													}
													
													$totalMarks += $totalObtained;
												} else {
													$result_status = 0;
													echo '<td colspan="'.$colspan.'">' . translate('absent') .'</td>';
													echo '<td>'.'N' .'</td>';
													echo '<td>'.'N' .'</td>';
													// echo translate('absent');
												}
												$totalFullmarks += $totalFullMark;
											} else {
												// echo "N/A";
												echo '<td>'.'N' .'</td>';
												echo '<td>'.'N' .'</td>';
												echo '<td colspan="'.$colspan.'">N/A</td>';
												$unset_subject++;
											}
										
											



										if($subject['sub_mark']){
											$this->db->select('m.mark as get_mark,IFNULL(m.absent, 0) as get_abs,subject.name as subject_name,subject.add_subject_code as additional_subject_code, te.mark_distribution');
											$this->db->from('mark as m');
											$this->db->join('subject', 'subject.id = m.subject_id', 'left');
											$this->db->join('timetable_exam as te', 'te.exam_id = m.exam_id and te.class_id = m.class_id and te.section_id = m.section_id and te.subject_id = m.subject_id', 'left');
											$this->db->where('m.exam_id', set_value('exam_id'));
											$this->db->where('m.student_id', $enroll['student_id']);
											$this->db->where('m.session_id', set_value('session_id'));
											$this->db->where('subject.add_subject_code', $subject['add_subject_code']);
											// $this->db->where('subject.sub_mark',180);
											$result['exam'] = $this->db->get()->result_array();

											$total_add_obtain_marks = 0;
											
											$l =0;
											
											$getMarksList = $result['exam'];
											foreach ($getMarksList as $row) {
												$fullMarkDistribution = json_decode($row['mark_distribution'], true);
												$obtainedMark = json_decode($row['get_mark'], true);
												
												foreach ($fullMarkDistribution as $m => $val) {
													$obtained_mark = floatval($obtainedMark[$m]);
													// print_r($obtained_mark);
													$fullMark = floatval($val['full_mark']);
													$passMark = floatval($val['pass_mark']);
												
								
													$total_add_obtain_marks += $obtained_mark;
													
												}	
												$l++;
											}
											// print_r($total_add_obtain_marks);
											$totalAddbtained = $total_add_obtain_marks/2;
											$percentage_grade = ($totalAddbtained * 100) / 100;
											$grade = $this->exam_model->get_grade($percentage_grade, $branch_id);
											
											$totalAddGradePoint += $grade['grade_point'];
											// $totalAddGradePoint += $totalAddGradePoint;
	
										}	
										?>
										<!-- </td> -->
										<?php endforeach; 
										$tota_cgpa = $total_op_point+$totalAddGradePoint;
										print_r($tota_cgpa); 
										echo ','
										?>

										<?php
										
									?>

										<td><?php echo ($totalMarks . '/' . $totalFullmarks); ?></td>
										<!-- 10-08-22 -->
										<?php 

										$totalOnSubjects = count($get_op_subjects)+count($get_n_subjects);

										?>
										<td>
										<?php
											if ($unset_subject == 0) {

												if ($result_status) {
													$totalSubjects = count($get_subjects)-$totalOnSubjects;

													$tota_cgpa =  $tota_cgpa-2;

													if(!empty($totalSubjects)) {
														echo number_format(($tota_cgpa / $totalSubjects), 2,'.','');
													}
												} else {
													echo '0';
												}
											}
										?>
										</td>
										<!-- 10-08-22 -->
										<td>
										<?php
											if ($unset_subject == 0) {
												// print_r($result_status);
												if ($result_status) {
													echo '<span class="label label-primary">PASS</span>';
												} else {
													echo '<span class="label label-danger">FAIL</span>';
												}
											}
										?>
										</td>
									</tr>
									<?php
									endforeach;
									}else{
										$colspan = ($get_subjects->num_rows() + 5);
										echo '<tr><td colspan="' . $colspan . '"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button onclick="fn_printElem('printResult')" class="btn btn-default btn-sm btn-block">
								<i class="fas fa-print"></i> <?=translate('print')?>
							</button>
						</div>
					</div>
				</footer>
			</section>
	<?php } ?>
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
