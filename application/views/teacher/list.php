<?php
if(empty($results)):
?>
<p class="text-error">No Instructors found.</p>
<?php
else:
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>Instructor ID</td>
			<td>Name</td>
			<td>Profile</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			$id = $result->user_id;
			$firstname = $result->fname;
			$middlename = $result->mname;
			$lastname = $result->lname;
			$fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
			$link = '';
		?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $fullname; ?></td>
				<td><?php echo $link; ?></td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>
<?php
endif;
?>