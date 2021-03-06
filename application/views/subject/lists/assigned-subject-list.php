<?php
if(empty($results)):
?>
<p class="text-error">No Subjects found.</p>
<?php
else:
?>
<table class="table table-bordered view-table">
	<thead>
		<tr>
			<td>Subject Code</td>
			<td>Description</td>
			<td>Unit</td>
			<td>Year</td>
			<!--<td class="action">Action</td>-->
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			$id = $result->subj_id;
			$code = $result->subj_code;
			$name = $result->subj_desc;
			$unit = $result->subj_unit;

			
			if(!isset($result->grade_level)){
				$grade_level = $result->year_level;
			}else{
				$grade_level = $result->grade_level;
			}
			//$grade_level = $result->grade_level;
			$link = '';
		?>
			<tr>
				<td><?php echo $code; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $unit; ?></td>
				<td><?php echo $grade_level; ?></td>
				<!--<td>
					<a href="#" data-id="<?php echo $id; ?>" data-code="<?php echo $code; ?>" data-name="<?php echo $name; ?>" data-unit="<?php echo $unit; ?>" class="btn btn-primary btn-edit" title="Edit">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a href="#" data-id="<?php echo $id; ?>" class="btn btn-danger btn-delete" title="Delete">
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>-->
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>
<?php
endif;
?>