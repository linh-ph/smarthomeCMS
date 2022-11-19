	@extends('layout')

	@section('js')
	<!-- third party js -->
	<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/buttons.flash.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
	<script src="{{asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>
	<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
	<script src="{{asset('assets/libs/pdfmake/vfs_fonts.js') }}"></script>
	<!-- Sweet Alerts js -->
	<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

	<!-- Sweet alert init js-->
	<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
	<!-- third party js ends -->
	@if(session('success'))
	<script>
		swal.fire("{{ session('success') }}", "", "success")
	</script>
	@endif
	@if(session('error'))
	<script>
		swal.fire("{{ session('error') }}", "", "error")
	</script>
	@endif
	<!-- Datatables init -->
	<!-- <script src="{{asset('assets/js/pages/datatables.init.js') }}"></script> -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("#tinh-nang-datatable").DataTable({
				language: {
					paginate: {
						previous: "<i class='mdi mdi-chevron-left'>",
						next: "<i class='mdi mdi-chevron-right'>"
					}
				},
				drawCallback: function() {
					$(".dataTables_paginate > .pagination").addClass("pagination-rounded")
				}
			});
		});
	</script>
	@endsection

	@section('css')
	<!-- third party css -->
	<link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- third party css end -->
	@endsection

	@section('main-content')
	<h1>Cài đặt</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<br />
					<br />
					<br />
					<table id="tinh-nang-datatable" class="table dt-responsive nowrap">
						<thead>
							<tr>
								<th>ID</th>
								<th>Chức năng</th>
								<th>Log</th>
								<th>Mức cảnh báo</th>
								<th>Trạng thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($settings as $setting)
							<tr>
								<td>{{ $setting->id }}</td>
								<td>{{ $setting->feature->name }}</td>
								<td>{{ $setting->log }}</td>
								<td>{{ $setting->muc_canh_bao }}</td>
								<td>{{ $setting->trang_thai }}</td>
								<td>
									<button data-toggle="modal" data-target="#CapNhat{{$setting->id}}" type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-pen"></i></button>
								</td>
							</tr>

							<div class="modal fade" id="CapNhat{{$setting->id}}" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Cập nhật setting</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('setting.xl-cap-nhat',$setting->id) }}" method="POST">
												@csrf
												<div class="form-group">
													<label for="log">Log</label>
													<input type="text" class="form-control" value="{{ $setting->log }}" id="log" name="log">
												</div>
												<div class="form-group">
													<label for="muc_canh_bao">Múc cảnh báo</label>
													<input type="text" class="form-control" value="{{ $setting->muc_canh_bao }}" id="muc_canh_bao" name="muc_canh_bao">
												</div>
												<div class="form-group">
													<label for="trang_thai">Trạng thái</label>
													<input type="text" class="form-control" value="{{ $setting->trang_thai }}" id="trang_thai" name="trang_thai">
												</div>
												<button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save"></i> Lưu</button>

											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: aliceblue; color: #6c757d;">Close</button>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</tbody>
					</table>

				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>

	<script>
		function capNhat($id) {
			$url = 'setting/cap-nhat/' + $id;
			open($url, "_self");
		}
	</script>
	@endsection