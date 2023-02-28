<style type="text/css">
	@media print {
		.pagebreak {
			page-break-before: always;
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
</style>
<?php
		$student = $result['student'];
		$getMarksList = $result['exam'];
		$getMarksListOp = $result['op_exam'];
		$getExam = $this->db->where(array('id' => $examID))->get('exam')->row_array();
		$getSchool = $this->db->where(array('id' => $getExam['branch_id']))->get('branch')->row_array();
		$schoolYear = get_type_name_by_id('schoolyear', $sessionID, 'school_year');
		$branch_img = $this->db->where('id',$getExam['branch_id'])->get('branch')->row_array();
		?>
	<div class="mark-container">
		<table border="0" style="margin-top: 20px; height: 100px;">
			<tbody>
				<tr>
				<td style="width:40%;vertical-align: top;"><img style="max-width:225px;" src="<?=base_url('uploads/app_image/'.$branch_img['report_card'])?>"></td>
				<td style="width:60%;vertical-align: top;">
					<table align="right" class="table-head text-right" >
						<tbody>
							<tr><th style="font-size: 26px;" class="text-right"><?=$getSchool['school_name']?></th></tr>
							<tr><th style="font-size: 14px; padding-top: 4px;" class="text-right">Academic Session : <?=$schoolYear?></th></tr>
							<tr><td><?=$getSchool['address']?></td></tr>
							<tr><td><?=$getSchool['mobileno']?></td></tr>
							<tr><td><?=$getSchool['email']?></td></tr>
						</tbody>
					</table>
				</td>
				</tr>
			</tbody>
		</table>
		<div style="width: 100%;">
			<div style="width: 80%; float: left;">
				<table class="table table-bordered" style="margin-top: 20px;">
					<tbody>
						<tr>
							<th>Name</td>
							<td><?=$student['first_name'] . " " . $student['last_name']?></td>
							<th>Register No</td>
							<td><?=$student['register_no']?></td>
							<th>Roll Number</td>
							<td><?=$student['roll']?></td>
						</tr>
						<tr>
							<th>Father Name</td>
							<td><?=$student['father_name']?></td>
							<th>Admission Date</td>
							<td><?=_d($student['admission_date'])?></td>
							<th>Date of Birth</td>
							<td><?=_d($student['birthday'])?></td>
						</tr>
						<tr>
							<th>Mother Name</td>
							<td><?=$student['mother_name']?></td>
							<th>Class</td>
							<td><?=$student['class_name'] . " (" . $student['section_name'] . ")"?></td>
							<th>Gender</td>
							<td><?=ucfirst($student['gender'])?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="width: 20%; float: left; text-align: right;">
				<img src="<?php echo get_image_url('student', $student['photo']); ?>" style="margin-top: 20px; border-radius: 10px;" height="120">
			</div>
		</div>
		<table class="table table-condensed table-bordered mt-lg">
			<thead>
				<tr>
					<th>Subjects</th>
				<?php 
				$markDistribution = json_decode($getExam['mark_distribution'], true);
				foreach ($markDistribution as $id) {
					?>
					<th><?php echo get_type_name_by_id('exam_mark_distribution',$id)  ?></th>
				<?php } ?>
				<?php if ($getExam['type_id'] == 1) { ?>
					<th>Total</th>
				<?php } elseif($getExam['type_id'] == 2) { ?>
					<th>Grade</th>
					<th>Point</th>
					<th>Remark</th>
				<?php } elseif ($getExam['type_id'] == 3) { ?>
					<th>Total</th>
					<th>Grade</th>
					<th>Point</th>
					<th>Remark</th>
				<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php
			$colspan = count($markDistribution) + 1;
			$total_grade_point = 0;
			$grand_obtain_marks = 0;
			$grand_full_marks = 0;
			$result_status = 1;
			$k=1;
			$t1_grade_point = 0;
			$total2_grade_point = 0;
			foreach ($getMarksList as $row) {
			?>
				<tr>
					<td valign="middle" width="35%"><?=$row['subject_name']?></td>
				<?php 
				$total_obtain_marks = 0;
				$total_full_marks = 0;
				$fullMarkDistribution = json_decode($row['mark_distribution'], true);
				$obtainedMark = json_decode($row['get_mark'], true);
				foreach ($fullMarkDistribution as $i => $val) {
					$obtained_mark = floatval($obtainedMark[$i]);
					$fullMark = floatval($val['full_mark']);
					$passMark = floatval($val['pass_mark']);
					if ($obtained_mark < $passMark) {
						$result_status = 0;
					}

					$total_obtain_marks += $obtained_mark;
					$obtained = $row['get_abs'] == 'on' ? 'Absent' : $obtained_mark;
					$total_full_marks += $fullMark;
					?>
				<?php if ($getExam['type_id'] == 1 || $getExam['type_id'] == 3){ ?>

					<td valign="middle">
						<?php 
							if ($row['get_abs'] == 'on') {
								echo 'Absent';
							} else {
								echo $obtained_mark . '/' . $fullMark;
							}
						?>
					</td>
				<?php } if ($getExam['type_id'] == 2) { ?>
					<td valign="middle">
						<?php 
							if ($row['get_abs'] == 'on') {
								echo 'Absent';
							} else {
								$percentage_grade = ($obtained_mark * 100) / $fullMark;
								$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
								echo $grade['name'];
							}
						?>
					</td>
				<?php } ?>
				<?php
				}
				$grand_obtain_marks += $total_obtain_marks;
				$grand_full_marks += $total_full_marks;
				$result1 = 1;
				foreach ($fullMarkDistribution as $i => $val) {
					$obtained_mark = floatval($obtainedMark[$i]);
					
					$fullMark = floatval($val['full_mark']);
					
					$passMark = floatval($val['pass_mark']);
				?>
				<?php 
					if ($obtained_mark < $passMark) {
						$result1 = 0;
					}
					
				}
				?>
				<?php if($getExam['type_id'] == 1 || $getExam['type_id'] == 3) { ?>
					<!-- custom -->
					<?php if ($row['sub_mark']) {?>
					<?php 
						$this->db->select('m.mark as get_mark,IFNULL(m.absent, 0) as get_abs,subject.name as subject_name,subject.add_subject_code as additional_subject_code, te.mark_distribution');
						$this->db->from('mark as m');
						$this->db->join('subject', 'subject.id = m.subject_id', 'left');
						$this->db->join('timetable_exam as te', 'te.exam_id = m.exam_id and te.class_id = m.class_id and te.section_id = m.section_id and te.subject_id = m.subject_id', 'left');
						$this->db->where('m.exam_id', $examID);
						$this->db->where('m.student_id', $student['id']);
						$this->db->where('m.session_id', $sessionID);
						$this->db->where('subject.add_subject_code', $row['additional_subject_code']);
						// $this->db->where('subject.sub_mark',180);
						$result['exam'] = $this->db->get()->result_array();
						$total_obtain_markss = 0;
						$result_status_add =1;
						$getMarksList1 = $result['exam'];
						foreach ($getMarksList1 as $row1) {
							$fullMarkDistribution1 = json_decode($row1['mark_distribution'], true);
							$obtainedMark = json_decode($row1['get_mark'], true);
							
							foreach ($fullMarkDistribution1 as $m => $val1) {
								$obtained_mark1 = floatval($obtainedMark[$m]);
								$fullMark = floatval($val1['full_mark']);
								$passMark = floatval($val1['pass_mark']);
								if ($obtained_mark1 < $passMark) {
									$result_status_add = 0;
								}
			
								$total_obtain_markss += $obtained_mark1;
								
							}
						}
						// print_r($total_obtain_markss);
						$this->db->select('m.mark as get_mark,IFNULL(m.absent, 0) as get_abs,subject.name as subject_name,subject.add_subject_code as additional_subject_code, te.mark_distribution');
						$this->db->from('mark as m');
						$this->db->join('subject', 'subject.id = m.subject_id', 'left');
						$this->db->join('timetable_exam as te', 'te.exam_id = m.exam_id and te.class_id = m.class_id and te.section_id = m.section_id and te.subject_id = m.subject_id', 'left');
						$this->db->where('m.exam_id', $examID);
						$this->db->where('m.student_id', $student['id']);
						$this->db->where('m.session_id', $sessionID);
						$this->db->where('subject.add_subject_code', $row['additional_subject_code']);
						$this->db->where('subject.sub_mark',null);
						$query=$this->db->get();

						$row2=$query->row();
						$getMarksList2 = $row2;
						// print_r(json_decode($getMarksList1->get_mark));
						// $fullMarkDistribution1 = $row2['get_mark'];
						// print_r( $row2->get_mark);
						$total_obtain_marks2 =0;
						foreach(json_decode($getMarksList2->get_mark) as $mark){
							// print_r($mark);
							$total_obtain_marks2 += $mark;
							
							
						}
						// print_r($total_obtain_marks2);
						
					?>
					<td valign="middle" rowspan="2"><?=$total_obtain_markss ."/" . '200'?></td>

					<?php }else{ ?>
					<?php if (empty($row['additional_subject_code'])) {?>
						<td valign="middle">
							<!--start 18-11-22 -->
							<?php if($result1==1){ ?>
								<?=$total_obtain_marks . "/" . $total_full_marks?>
							<?php }else{ ?>
								0
							<?php } ?>
							<!-- end 18-11-22 -->
						</td>
					<?php } ?>
					<?php } ?>
					<!--end custom -->
				<?php } if($getExam['type_id'] == 2) { 
					$colspan += 1;
					$percentage_grade = ($total_obtain_marks * 100) / $total_full_marks;
					$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
					$total_grade_point += $grade['grade_point'];
					
					?>

					<?php if ($row['sub_mark']) {?>
						<?php if($grade['name']=="F"){ ?>
						<td valign="middle" rowspan="2"><?=$grade['name']?></td>
						<td valign="middle" rowspan="2"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
						<?php } ?>
						<?php }else{ ?>
					<?php if (empty($row['additional_subject_code'])) 
					$count_list = count($getMarksList);
					
					{?>
						<!--start 18-11-22 -->
						<?php if($result1==1){ ?>
							<td valign="middle"><?=$grade['name']?></td>
							<td valign="middle"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
						<?php }else{ ?>
							<td valign="middle">F</td>
							<td valign="middle">0.00</td>
						<?php } ?>
						<!-- end 18-11-22 -->
						<?php } ?>
					<?php } ?>

					<td valign="middle"><?=$grade['remark']?></td>
				<?php } if ($getExam['type_id'] == 3) {
					$colspan += 2;
					$percentage_grade = ($total_obtain_marks * 100) / $total_full_marks;
					$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
					$total_grade_point += $grade['grade_point'];
					?>


					<?php if ($row['sub_mark']) {?>
						<?php if($grade['name']=="F"){ ?>
							<td valign="middle" rowspan="2"><?=$grade['name']?></td>
							<td valign="middle" rowspan="2"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
						<?php }else{
							$colspan += 2;
							$percentage_grade = ($total_obtain_marks2 * 100) / $total_full_marks;
							
							$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
							$total_grade_point += $grade['grade_point'];
						 ?>
						 <?php if($grade['name']=="F"){ ?>
						<td valign="middle" rowspan="2"><?=$grade['name']?></td>
						<td valign="middle" rowspan="2"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
						<?php }else{ 
							
							$colspan += 2;
							$passed_mark = 0;
							$passed_mark = $total_obtain_markss/2;
							$percentage_grade = ($passed_mark * 100) / $total_full_marks;
							$percentage_grade = intval($percentage_grade);
							$grade3 = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
							$total_grade_point += $grade3['grade_point'];
							$t1_grade_point +=$grade3['grade_point'];
						 ?>
						 <!--start 18-11-22 -->
						<?php if($result_status_add==1){ ?>
							<td valign="middle" rowspan="2"><?=$grade3['name']?></td>
							<td valign="middle" rowspan="2"><?=number_format($grade3['grade_point'], 2, '.', '')?></td>
						<?php }else{ ?>
							<td valign="middle" rowspan="2">F</td>
							<td valign="middle" rowspan="2">0.00</td>
						<?php } ?>
						<!-- end 18-11-22 -->
						<?php } ?>
						<?php } ?>
						<?php }else{ ?>
						<?php if (empty($row['additional_subject_code'])) {?>
							<?php $total2_grade_point += $grade['grade_point'];
						?>
							<!--start 18-11-22 -->
						<?php if($result1==1){ ?>
							<td valign="middle"><?=$grade['name']?></td>
							<td valign="middle"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
						<?php }else{ ?>
							<td valign="middle">F</td>
							<td valign="middle">0.00</td>
						<?php } ?>
						<!-- end 18-11-22 -->
							<?php } ?>
					<?php } ?>


					<td valign="middle"><?=$grade['remark']?></td>
					<?php if($k==1){ 
						$this->db->select('m.mark as get_mark,subject.name as subject_name,subject.sub_mark');
						$this->db->from('mark as m');
						$this->db->join('subject', 'subject.id = m.subject_id', 'left');
						$this->db->where('m.exam_id', $examID);
						$this->db->where('m.student_id', $student['id']);
						$this->db->where('m.session_id', $sessionID);
						$this->db->where('subject.sub_mark!=', null);
						$result['exam2'] = $this->db->get()->result_array();
						?>
					<?php  $count_list = count($getMarksList)-count($result['exam2']);
					?>
				<?php } ?>
				<?php $k++ ?>
				<?php } ?>
				</tr>
			<?php } 
			$grade_total_point = $total2_grade_point+$t1_grade_point;
			if($grade_total_point ==0){
				$grade_total_point = $total_grade_point;
			}
			?>

			
			</tbody>
			<tbody>
			<tr>
				<th>Additional Subject</th>
			</tr>
			<?php
			$colspan = count($markDistribution) + 1;
			$total_grade_pointOp = 0;
			$grand_obtain_marksOp = 0;
			$grand_full_marksOp = 0;
			$result_statusOp = 1;
			$optionalPoint = 0;
			foreach ($getMarksListOp as $rowOp) {
				$obtainedMark = json_decode($rowOp['get_mark'], true);
			?>
			<?php if($obtainedMark[1]!=null || $rowOp['get_abs'] == 'on') { ?>
				<tr>
					<td valign="middle" width="35%"><?=$rowOp['subject_name']?></td>
				<?php 
				$total_obtain_marks = 0;
				$total_full_marks = 0;
				$fullMarkDistribution = json_decode($rowOp['mark_distribution'], true);
				$obtainedMark = json_decode($rowOp['get_mark'], true);
				foreach ($fullMarkDistribution as $i => $val) {
					$obtained_mark = floatval($obtainedMark[$i]);
					$fullMark = floatval($val['full_mark']);
					$passMark = floatval($val['pass_mark']);
					if ($obtained_mark < $passMark) {
						$result_statusOp = 0;
					}

					$total_obtain_marks += $obtained_mark;
					$obtained = $rowOp['get_abs'] == 'on' ? 'Absent' : $obtained_mark;
					$total_full_marks += $fullMark;
					?>
				<?php if ($getExam['type_id'] == 1 || $getExam['type_id'] == 3){ ?>
					<td valign="middle">
						<?php 
							if ($rowOp['get_abs'] == 'on') {
								echo 'Absent';
							} else {
								echo $obtained_mark . '/' . $fullMark;
							}
						?>
					</td>
				<?php } if ($getExam['type_id'] == 2) { ?>
					<td valign="middle">
						<?php 
							if ($rowOp['get_abs'] == 'on') {
								echo 'Absent';
							} else {
								$percentage_grade = ($obtained_mark * 100) / $fullMark;
								$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
								echo $grade['name'];
							}
						?>
					</td>
				<?php } ?>
				<?php
				}
				$grand_obtain_marksOp += $total_obtain_marks;
				$grand_full_marks += $total_full_marks;
				?>
				<?php if($getExam['type_id'] == 1 || $getExam['type_id'] == 3) { ?>
					<td valign="middle"><?=$total_obtain_marks . "/" . $total_full_marks?></td>
				<?php } if($getExam['type_id'] == 2) { 
					$colspan += 1;
					$percentage_grade = ($total_obtain_marks * 100) / $total_full_marks;
					$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
					$total_grade_pointOp += $grade['grade_point'];
					?>
					<td valign="middle"><?=$grade['name']?></td>
					<td valign="middle"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
					<td valign="middle"><?=$grade['remark']?></td>
				<?php } if ($getExam['type_id'] == 3) {
					$colspan += 2;
					$percentage_grade = ($total_obtain_marks * 100) / $total_full_marks;
					$grade = $this->exam_model->get_grade($percentage_grade, $getExam['branch_id']);
					$total_grade_pointOp += $grade['grade_point'];
					?>
					<td valign="middle"><?=$grade['name']?></td>
					<td valign="middle"><?=number_format($grade['grade_point'], 2, '.', '')?></td>
					<td valign="middle"><?=$grade['remark']?></td>
				<?php } ?>
				</tr>
			<?php } ?>
			<?php } ?>
			<?php if (isset($getExam['type_id']) == 1 || isset($getExam['type_id']) == 3) { ?>
				<tr class="text-weight-semibold">
					<td valign="top" >GRAND TOTAL :</td>
					<?php $totalmark = $grand_obtain_marks+$grand_obtain_marksOp;
					?>
					<td valign="top" colspan="<?=$colspan?>"><?=$totalmark . '/' . $grand_full_marks; ?>, Average : <?php $percentage = ($totalmark * 100) / $grand_full_marks; echo number_format($percentage, 2, '.', '')?>%</td>
				</tr>
				<!-- <tr class="text-weight-semibold">
					<td valign="top" >GRAND TOTAL IN WORDS :</td>
					<td valign="top" colspan="<?=$colspan?>">
						<?php
						// $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
						// echo ucwords($f->format($totalmark));
						?>
					</td>
				</tr> -->
				<?php 
				if($result_statusOp==1){
					$optionalPoint = $total_grade_pointOp-$rowOp['cut_point'];
					$totalGrossPoint = $optionalPoint + $grade_total_point;
				}else{
					$optionalPoint = $total_grade_pointOp;
					$totalGrossPoint = $optionalPoint + $grade_total_point;
				}
					// $optionalPoint = $total_grade_pointOp-$rowOp['cut_point'];
					// $totalGrossPoint = $optionalPoint + $grade_total_point;
				?>
			<?php } if ($getExam['type_id'] == 2) { ?>
				<tr class="text-weight-semibold">
					<td valign="top" >GPA :</td>
					<!-- custom 19-11-22 -->
					<?php if($result_status == 1) { ?>
						<?php if(number_format(($totalGrossPoint / $count_list), 2, '.', '')>=5) {?>
						<td valign="top" colspan="<?=$colspan+1?>">5.00</td>
						<?php }else{ ?>
							<td valign="top" colspan="<?=$colspan+1?>"><?=number_format(($totalGrossPoint / $count_list), 2, '.', '')?></td>
						<?php } ?>
					<?php }else {?>
						<td  valign="middle" colspan="7">0.00</td>
					<?php }?>
					<!-- custom 19-11-22 -->
					
				</tr>
			<?php } if ($getExam['type_id'] == 3) { ?>
				<tr class="text-weight-semibold">
					<td valign="top" >GPA :</td>
					<!-- custom 19-11-22 -->
					<?php if($result_status == 1) { ?>
						<?php if(number_format(($totalGrossPoint / $count_list), 2, '.', '')>=5) {?>
						<td valign="top" colspan="<?=$colspan+1?>">5.00</td>
						<?php }else{ ?>
							<td valign="top" colspan="<?=$colspan+1?>"><?=number_format(($totalGrossPoint / $count_list), 2, '.', '')?></td>
						<?php } ?>
					<?php }else {?>
						<td  valign="middle" colspan="7">0.00</td>
					<?php }?>
					<!-- custom 19-11-22 -->
				</tr>
			<?php } if ($getExam['type_id'] == 1 || $getExam['type_id'] == 3) { ?>
				<tr class="text-weight-semibold">
					<td valign="top" >RESULT :</td>
					<td valign="top" colspan="<?=$colspan?>"><?=$result_status == 0 ? 'Fail' : 'Pass'; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		<div style="width: 100%; display: flex;">
			<div style="width: 50%; padding-right: 15px;">
				<?php
				if ($attendance == 1) {
					$year = explode('-', $schoolYear);
					$getTotalWorking = $this->db->where(array('student_id' => $userID, 'status !=' => 'H', 'year(date)' => $year[0]))->get('student_attendance')->num_rows();
					$getTotalAttendance = $this->db->where(array('student_id' => $userID, 'status' => 'P', 'year(date)' => $year[0]))->get('student_attendance')->num_rows();
					$attenPercentage = empty($getTotalWorking) ? '0.00' : ($getTotalAttendance * 100) / $getTotalWorking;
					?>
				<table class="table table-bordered table-condensed">
					<tbody>
						<tr>
							<th colspan="2" class="text-center">Attendance</th>
						</tr>
						<tr>
							<th style="width: 65%;">No. of working days</th>
							<td><?=$getTotalWorking?></td>
						</tr>
						<tr>
							<th style="width: 65%;">No. of days attended</th>
							<td><?=$getTotalAttendance?></td>
						</tr>
						<tr>
							<th style="width: 65%;">Attendance Percentage</th>
							<td><?=number_format($attenPercentage, 2, '.', '') ?>%</td>
						</tr>
					</tbody>
				</table>
				<?php } ?>
			</div>
	<?php
	if ($grade_scale == 1) {
		if ($getExam['type_id'] != 1) {
			?>
			<div style="width: 50%; padding-left: 15px;">
				<table class="table table-condensed table-bordered">
					<tbody>
						<tr>
							<th colspan="3" class="text-center">Grading Scale</th>
						</tr>
						<tr>
							<th>Grade</th>
							<th>Min Percentage</th>
							<th>Max Percentage</th>
						</tr>
					<?php 
					$grade = $this->db->where('branch_id', $getExam['branch_id'])->get('grade')->result_array();
					foreach ($grade as $key => $row) {
					?>
						<tr>
							<td style="width: 30%;"><?=$row['name']?></td>
							<td style="width: 30%;"><?=$row['lower_mark']?>%</td>
							<td style="width: 30%;"><?=$row['upper_mark']?>%</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
	<?php } } ?>
		</div>
		<table style="width:100%; outline:none; margin-top: 35px;">
			<tbody>
				<tr>
					<td style="font-size: 15px; text-align:left;">Print Date : <?=_d($print_date)?></td>
					<td style="border-top: 1px solid #ddd; font-size:15px;text-align:left">Principal Signature</td>
					<td style="border-top: 1px solid #ddd; font-size:15px;text-align:center;">Class Teacher Signature</td>
					<td style="border-top: 1px solid #ddd; font-size:15px;text-align:right;">Parent Signature</td>
				</tr>
			</tbody>
		</table>
	</div>

