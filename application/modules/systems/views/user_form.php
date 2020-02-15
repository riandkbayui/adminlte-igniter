<?php 
	$id = $this->input->get('id');
	$db = array();
	if (isset($id)) {
		$db = $this->db->where('user_id', $id)->get('_user')->row();
	}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card bg-white">
			<div class="card-header">
				<div class="float-left">
					<i class="fa fa-user"></i> Form User
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url('systems/user_save')); ?>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>Nama Depan</label>
						<?php if ($id): ?>
							<input type="hidden" class="d-none" name="user_id" value="<?php echo $id ?>">
						<?php endif ?>
						<input type="text" autocomplete="off" class="form-control next" name="user_firstname" value="<?php echo isset($id) ? $db->user_firstname : '' ?>">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>Nama Belakang</label>
						<input type="text" autocomplete="off" class="form-control next" name="user_lastname" value="<?php echo isset($id) ? $db->user_lastname : '' ?>">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>Jenis Kelamin</label>
						<select class="form-control next" name="user_gender" required="">
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<label>Tempat Lahir</label>
						<input type="text" autocomplete="off" class="form-control next" name="user_birth_place" value="<?php echo isset($id) ? $db->user_birth_place : '' ?>">
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<label>Tanggal Lahir</label>
						<input type="text" autocomplete="off" class="form-control next date" name="user_birth_date" value="<?php echo isset($id) ? date_mysql_to_id($db->user_birth_date) : '' ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label>Alamat</label>
						<textarea class="form-control" name="user_address"><?php echo isset($id) ? $db->user_address : '' ?></textarea>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>E-mail</label>
						<input type="email" autocomplete="off" class="form-control next" name="user_email" value="<?php echo isset($id) ? $db->user_email : '' ?>">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>Telepon</label>
						<input type="number" autocomplete="off" class="form-control next" name="user_phone" value="<?php echo isset($id) ? $db->user_phone : '' ?>">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<label>Grup</label>
						<select class="form-control next" name="group_id">
							<option value="">- Pilih Grup -</option>
							<?php 
								$set = [
									'table' => '_group',
									'id' => isset($id) ? $db->group_id : '',
									'val_id' => 'group_id',
									'val_text' => 'group_label',
								];
								echo $this->select2->option_create($set);
							?>
						</select>
					</div>					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<label>Username</label>
						<input type="text" autocomplete="off" class="form-control next" name="user_username" value="<?php echo isset($id) ? $db->user_username : '' ?>">
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<label>Password <?php echo isset($id) ? '<sup class="text-success">Boleh dikosongkan!</sup>' : '' ?></label>
						<input type="password" autocomplete="off" class="form-control next" name="user_password">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br>
						<button type="submit" class="btn btn-primary next">Simpan</button>
						<button type="reset" class="btn btn-danger">Setel Ulang</button>
					</div>
				</div>
				<?php echo form_close();  ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('select[name="user_gender"]').select2();

	$('select[name="group_id"]').select2();

	$('.date').datepicker();

	<?php 
		if (isset($id)) {
			echo select2_preselect('select[name="user_gender"]', $db->user_gender, true);
		}
	?>
</script>
