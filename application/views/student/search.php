<?php if (!empty($query)):?>
	<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-user-graduate"></i> <?php echo translate('student_list');?></h4>
		</header>
		<div class="panel-body mb-md">
			<table class="table table-bordered table-condensed table-hover table-export">
				<thead>
					<tr>
						<th><?=translate('sl')?></th>
						<th width="80"><?=translate('photo')?></th>
					<?php if (is_superadmin_loggedin()) { ?>
						<th><?=translate('branch')?></th>
					<?php } ?>
						<th><?=translate('name')?></th>
						<th><?=translate('register_no')?></th>
						<th><?=translate('roll')?></th>
						<th><?=translate('age')?></th>
						<th><?=translate('father_name')?></th>
						<th><?=translate('mohter_name')?></th>
						<th><?=translate('mobile_no')?></th>
						<th><?=translate('class')?></th>
						<th><?=translate('section')?></th>
						<th><?=translate('email')?></th>
						<th><?=translate('action')?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					$students = $query->result();
					foreach($students as $row):
					?>
					<tr>
						<td class="center"><?php echo $count++; ?></td>
						<td class="center"><img class="rounded" src="<?=get_image_url('student', $row->photo)?>" width="40" height="40"/></td>
					<?php if (is_superadmin_loggedin()) { ?>
						<td><?php echo get_type_name_by_id('branch', $row->branch_id);?></td>
					<?php } ?>
						<td><?php echo $row->first_name .' '.$row->last_name;?></td>
						<td><?php echo $row->register_no;?></td>
						<td><?php echo $row->roll;?></td>
						<td>
							<?php
							if(!empty($row->birthday)){
								$birthday 	= new DateTime($row->birthday);
								$today   	= new DateTime('today');
								$age 		= $birthday->diff($today)->y;
								echo html_escape($age);
							}else{
								echo "N/A";
							}
							?>
						</td>
						<!-- <td><?php echo !empty($row->parent_name) ? $row->parent_name : 'N/A';?></td> -->
						<td><?php echo $row->father_name;?></td>
						<td><?php echo $row->mother_name;?></td>
						<td><?php echo $row->mobileno;?></td>
						<td><?php echo $row->class_name;?></td>
						<td><?php echo $row->section_name;?></td>
						<td><?php echo $row->email;?></td>
						<td class="min-w-c">
						<?php if (get_permission('student', 'is_edit')): ?>
							
							<!-- pay fees -->
							<!-- collect payment -->
							<?php if (get_permission('collect_fees', 'is_add')) { ?>
								<a href="<?php echo base_url('fees/invoice/' . $row->student_id);?>" class="btn btn-default btn-circle">
									<i class="far fa-arrow-alt-circle-right"></i> <?=translate('collect')?>
								</a>
							<?php } ?>
							<!-- update link -->
							<a href="<?php echo base_url('student/profile/' . $row->student_id);?>" class="btn btn-default icon btn-circle" data-toggle="tooltip" data-original-title="<?=translate('details')?>">
								<i class="far fa-arrow-alt-circle-right"></i> <?=translate('details')?>
							</a>
							<!-- delete link -->
						<!-- <?php endif; if (get_permission('student', 'is_delete')): ?>
							<?php echo btn_delete('student/delete_data/' . $row->id . '/' . $row->student_id);?>
						<?php endif; ?> -->
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</section>
	<?php endif;?>