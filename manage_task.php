<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM task_list where id = " . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form method="post">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" id="project_id" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
		<div class="form-group">
			<label for="">Task</label>
			<input type="text" class="form-control form-control-sm" id="task" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="description" cols="30" rows="10" class="summernote form-control">
				<?php echo isset($description) ? $description : '' ?>
			</textarea>
		</div>
		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="status" class="custom-select custom-select-sm">
				<option value="Pending">Pending</option>
				<option value="On-Progress">On-Progress</option>
				<option value="Done">Done</option>
			</select>
		</div>

		<!--date time picker-->

		<div class="form-group">
			<div class="row">
				<div class="col-2">
					<input class="form-control form-control-sm" name="val" id="val" placeholder="Set Time Value" type="text" />
				</div>
				<div class="col-6">
					<input type="radio" name="st" id="hour" value="hour" checked="checked" autofocus> Hour
					<input type="radio" name="st" id="day" value="day"> Day
				</div>
				<div class="card-footer">
					<button type="submit" id="save" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$('.summernote').summernote({
			height: 200,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				['table', ['table']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		});
	});

	$(document).ready(function() {
		$('#save').click(function() {
			var task = document.getElementById("task").value;
			var description = document.getElementById("description").value;
			var status = document.getElementById("status").value;
			var val = document.getElementById("val").value;
			var project_id = document.getElementById("project_id").value;
			if (document.getElementById('hour').checked) {
				var st = document.getElementById('hour').value;
			}
			if (document.getElementById('day').checked) {
				var st = document.getElementById('day').value;
			}
			$.ajax({
				type: 'post',
				url: 'insert_task.php',
				data: {
					task: task,
					description: description,
					status: status,
					val: val,
					st: st,
					project_id: project_id
				},
				cache: false,
				success: function(resp) {
					if (resp == 1) {
						alert_toast('Data successfully saved', "success");
						setTimeout(function() {
							location.reload()
						}, 1500)
					}
				}
			});
			return false;
		});
	});
</script>