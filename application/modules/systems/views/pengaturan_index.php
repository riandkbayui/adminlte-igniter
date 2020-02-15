<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card bg-white">
			<div class="card-header">
				<div class="float-left">
					<i class="fa fa-cog"></i> Form Pengaturan
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url('systems/pengaturan_save')); ?>
				<div class="form-group">
					<label>Nama Web</label>
					<?php echo form_input('setting_web_name', $setting_web_name, ["class"=>"form-control next", "autocomplete"=>"off"]); ?>
				</div>
				<div class="form-group">
					<label>Web Credit</label>
					<?php echo form_input('setting_web_credit', $setting_web_credit, ["class"=>"form-control next", "autocomplete"=>"off"]); ?>
				</div>
				<div class="form-group">
					<label>Web Credit Link</label>
					<?php echo form_input('setting_web_credit_href', $setting_web_credit_href, ["class"=>"form-control next", "autocomplete"=>"off"]); ?>
				</div>
				<div class="form-group">
					<label>Web Logo</label>
					<?php echo form_input('setting_web_logo', $setting_web_logo, ["class"=>"form-control next", "autocomplete"=>"off"]); ?>
				</div>
				<div class="form-group">
					<label>Web Icon</label>
					<?php echo form_input('setting_web_icon', $setting_web_icon, ["class"=>"form-control next", "autocomplete"=>"off"]); ?>
				</div>
				<div class="d-block">
					<button type="submit" class="btn btn-primary mr-2">Simpan</button>
					<button type="reset" class="btn btn-default">Setel Ulang</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>