<?php 
	$id = $this->input->get('id');
	$db = array();
	if (isset($id)) {
		$db = $this->db->where('sidebar_id', $id)->get('_sidebar')->row();
	}
?>


<?php echo form_open(base_url('systems/sidebar_save')); ?>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<label>Parent</label>
		<?php if ($id): ?>
			<input type="hidden" class="d-none" name="sidebar_id" value="<?php echo $id ?>">
		<?php endif ?>
		<select class="form-control select2" name="sidebar_parent">
			<option value="">Pilih Parent</option>
			<?php 
				$set = [
					'table' => '_sidebar',
					'id' => isset($id) ? $db->sidebar_parent : '',
					'val_id' => 'sidebar_id',
					'val_text' => 'sidebar_label',
				];
				echo $this->select2->option_create($set);
			?>
		</select>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<label>Label</label>
		<input type="text" autocomplete="off" class="form-control next" name="sidebar_label" value="<?php echo isset($id) ? $db->sidebar_label : '' ?>">
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<label>Href</label>
		<input type="text" autocomplete="off" class="form-control next" name="sidebar_href" value="<?php echo isset($id) ? $db->sidebar_href : '' ?>">
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<label>Index</label>
		<input type="number" autocomplete="off" class="form-control next" name="sidebar_index" value="<?php echo isset($id) ? $db->sidebar_index : '' ?>">
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<label>Icon</label>
		<input type="text" autocomplete="off" class="form-control next" name="sidebar_icon" value="<?php echo isset($id) ? $db->sidebar_icon : '' ?>">
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<label>Status</label>
		<select class="form-control select2" name="status_id">
			<?php 
				$set = [
					'table' => '_status',
					'id' => isset($id) ? $db->status_id : '1',
					'val_id' => 'status_id',
					'val_text' => 'status_label',
				];
				echo $this->select2->option_create($set);
			?>
		</select>
	</div>
</div>
<?php echo form_close();  ?>

<script type="text/javascript">
	$('.date').datepicker();
	$('.select2').select2();

	$('select[name="sidebar_parent"]').change(function(event) {
		$.get('<?php echo base_url('systems/sidebar_index') ?>', {'sidebar_parent':this.value}, function(data) {
			$('input[name="sidebar_index"]').val(data);
		});
	});
</script>
<script type="text/javascript">
	$('form').submit(function(event) {
		$.post(this.action, $(this).serialize()).done(function(data, textStatus, xhr) {
			$('#modal-default').modal('hide');
			$('table').DataTable().ajax.reload();
		});
		return false;
	});
</script>