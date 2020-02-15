<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card bg-white">
			<div class="card-header">
				<div class="float-left">
					<i class="fa fa-user"></i> Manajemen User
				</div>
				<div class="float-right">
					<?php 
						$set = [
							'label'=>'Tambah User', 
							'type'=>'link', 
							'icon'=>'fa fa-plus', 
							'id'=>'btn-add',
							'href'=>base_url('systems/user_form'),
							'security'=>true,
							'crud'=>'create',
						];
						$this->adminlte->button_create($set) 
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-inverse table-hover">
					<thead>
						<tr>
							<th width="75px">No</th>
							<th>Nama Depan</th>
							<th>Nama Belakang</th>
							<th>Telepon</th>
							<th>Username</th>
							<th>Email</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button id="btn-save" type="button" class="btn btn-primary">Simpan Perubahan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	var table = $('table').DataTable({
		"ajax":{
			"url"       : "<?php echo base_url('systems/user_table_fetch') ?>",
			"dataSrc"   : "data",
			"type"      : "POST"
		},
		"processing"    : true,
		"serverSide"    : true,
		"columns"       : [
			{data       : 'number', searchable: false},
			{data       : 'user_firstname'},
			{data       : 'user_lastname'},
			{data       : 'user_phone'},
			{data       : 'user_username'},
			{data       : 'user_email'},
			{data       : 'status_id'},
			{data       : 'action'},
		],
		"paging"        : true,
		"lengthChange"  : true,
		"searching"     : true,
		"ordering"      : false,
		"info"          : true,
		"autoWidth"     : false,
    });

    function launch_modal(t) {
    	$('.modal-title').html($(t).attr('data-title'));
    	$.get($(t).attr('data-url')).done(function(data) {
    		$('.modal-body').html(data);
    		$('#modal-default').modal('show');
    	});
    }

    function remove(t) {
    	var url = $(t).attr('data-url');
    	var conf = confirm('Ada akan menghapus item yang dipilih ?');
    	if (conf) {
    		$.get(url).done(function(data) {
    			table.ajax.reload();
    		});
    	}
    }
    
</script>