<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card bg-white">
			<div class="card-header">
				<div class="float-left">
					<i class="fa fa-users"></i> Manajemen Grup
				</div>
				<div class="float-right">
					<?php 
						$set = [
							'label' => 'Tambah Grup',
							'icon' => 'fa fa-plus',
							'type' => 'link',
							'href' => base_url('systems/group_modal/grup_form'),
							'security' => true,
							'crud' => 'create',
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
							<th>Nama</th>
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
	$('table').DataTable({
		"ajax":{
			"url"       : "<?php echo base_url('systems/group_table_fetch') ?>",
			"dataSrc"   : "data",
			"type"      : "POST"
		},
		"processing"    : true,
		"serverSide"    : true,
		"columns"       : [
			{data       : 'number', searchable: false},
			{data       : 'group_label'},
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

    $('#btn-save').click(function(event) {
    	$('form').submit();
    });
</script>