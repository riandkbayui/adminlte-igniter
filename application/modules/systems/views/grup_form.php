<?php 
	$id = $this->input->get('id');
	$db = array();
	if (isset($id)) {
		$db = $this->db->where('group_id', $id)->get('_group')->row();
		$sb = $this->db->get('_v_sidebar')->result();
	} else {
		$sb = $this->db->get('_v_sidebar')->result();
	}
?>

<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card bg-white">
			<div class="card-header">
				<div class="float-left">
					<i class="fa fa-users"></i> Form Grup
				</div>
				<div class="float-right">
					<button id="btn-cek-semua" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Semua</button>
					<button id="btn-cek-un" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Hapus Semua</button>
					<button id="btn-cek-baca" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Lihat</button>
					<button id="btn-cek-buat" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Buat</button>
					<button id="btn-cek-ubah" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Ubah</button>
					<button id="btn-cek-hapus" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Hapus</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url('systems/group_save')); ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php if ($id): ?>
							<input type="hidden" class="d-none" name="group_id" value="<?php echo $id ?>">
						<?php endif ?>
						<label>Nama Grup</label>
						<input type="text" class="form-control" autocomplete="off" name="group_label" value="<?php echo isset($id) ? $db->group_label : '' ?>">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<label>Menu</label>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
						<label>Lihat</label>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
						<label>Buat</label>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
						<label>Ubah</label>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
						<label>Hapus</label>
					</div>
				</div>
				<?php foreach ($sb as $key => $var): ?>
					<?php 
						$create = '';
						$read = '';
						$update = '';
						$delete = '';
						if (isset($id)) {
							$sbar = $this->db->where('group_id', $id)->where('sidebar_id', $var->sidebar_id)->get('_sidebar_access')->row();
							$create = @$sbar->create;
							$read = @$sbar->read;
							$update = @$sbar->update;
							$delete = @$sbar->delete;
						}
					?>
					<div class="row mt-3">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label><?php echo $var->sidebar_label ?></label>
							<input type="hidden" class="d-none" name="sidebar_id[]" value="<?php echo $var->sidebar_id ?>">
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input <?php echo $read ? 'checked=""' : '' ?> type="checkbox" name="read[<?php echo $var->sidebar_id ?>]" value="1" class="read form-control input-sm">
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input <?php echo $create ? 'checked=""' : '' ?> type="checkbox" name="create[<?php echo $var->sidebar_id ?>]" value="1" class="create form-control input-sm">
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input <?php echo $update ? 'checked=""' : '' ?> type="checkbox" name="update[<?php echo $var->sidebar_id ?>]" value="1" class="update form-control input-sm">
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input <?php echo $delete ? 'checked=""' : '' ?> type="checkbox" name="delete[<?php echo $var->sidebar_id ?>]" value="1" class="delete form-control input-sm">
						</div>
					</div>
				<?php endforeach ?>
				<div class="row mt-3">
					<button type="submit" class="btn btn-primary mr-2">Simpan</button>
					<button type="reset" class="btn btn-default">Setel Ulang</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#btn-cek-semua').click(function(event) {
		$('input[type="checkbox"]').prop('checked', true);
	});
	$('#btn-cek-un').click(function(event) {
		$('input[type="checkbox"]').prop('checked', false);
	});
	$('#btn-cek-baca').click(function(event) {
		$('input[type="checkbox"].read').prop('checked', true);
	});
	$('#btn-cek-buat').click(function(event) {
		$('input[type="checkbox"].create').prop('checked', true);
	});
	$('#btn-cek-ubah').click(function(event) {
		$('input[type="checkbox"].update').prop('checked', true);
	});
	$('#btn-cek-hapus').click(function(event) {
		$('input[type="checkbox"].delete').prop('checked', true);
	});
</script>