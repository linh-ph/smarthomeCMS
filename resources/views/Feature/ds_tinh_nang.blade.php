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
	<h1>Danh s??ch t??nh n??ng</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<button data-toggle="modal" data-target="#ThemMoi" class="btn btn-info waves-effect waves-light">
								<i class="mdi mdi-plus-box"></i> Th??m t??nh n??ng
							</button>
						</div>
						<div class="col-sm-12 col-md-6" style="text-align: right;">
							<a href="{{route('tinh-nang.thung-rac')}}" class="btn btn-info waves-effect waves-light">
								<i class="mdi mdi-delete-empty"></i> Th??ng r??c
							</a>
						</div>
					</div>
					<br />
					<br />
					<br />
					<table id="tinh-nang-datatable" class="table dt-responsive nowrap">
						<thead>
							<tr>
								<th>ID</th>
								<th>T??n t??nh n??ng</th>
								<th>Key</th>
								<th>Min</th>
								<th>Max</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($features as $feature)
							<tr>
								<td>{{ $feature->id }}</td>
								<td>{{ $feature->name }}</td>
								<td>{{ $feature->slug }}</td>
								<td>{{ $feature->min }}</td>
								<td>{{ $feature->max }}</td>
								<td>
									<button data-toggle="modal" data-target="#CapNhat{{$feature->id}}" type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-pen"></i></button>
									<button onclick="Xoa({{ $feature->id }})" type="button" class="btn btn-danger waves-effect waves-light"><i class=" mdi mdi-delete"></i></button>
								</td>
							</tr>

							<div class="modal fade" id="CapNhat{{$feature->id}}" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">C???p nh???t t??nh n??ng</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('tinh-nang.xl-cap-nhat',$feature->id) }}" method="POST">
												@csrf
												<div class="form-group">
													<label for="name">T??n t??nh n??ng</label>
													<input type="text" class="form-control" value="{{ $feature->name }}" id="name" name="name">
												</div>
												<div class="form-group">
													<label for="slug">Key</label>
													<input type="text" class="form-control" value="{{ $feature->slug }}" id="slug" name="slug">
												</div>
												<div class="form-group">
													<label for="min">Min</label>
													<input type="text" class="form-control" value="{{ $feature->min }}" id="min" name="min">
												</div>
												<div class="form-group">
													<label for="max">Max</label>
													<input type="text" class="form-control" value="{{ $feature->max }}" id="max" name="max">
												</div>
												<button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save"></i> L??u</button>

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
	<!-- Modal -->
	<div class="modal fade" id="ThemMoi" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Th??m m???i t??nh n??ng</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('tinh-nang.xl-them-moi') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">T??n t??nh n??ng</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="T??n t??nh n??ng">
						</div>
						<div class="form-group">
							<label for="slug">Key</label>
							<input type="text" class="form-control" id="slug" name="slug">
						</div>
						<div class="form-group">
							<label for="min">Min</label>
							<input type="text" class="form-control" id="min" name="min">
						</div>
						<div class="form-group">
							<label for="max">Max</label>
							<input type="text" class="form-control" id="max" name="max">
						</div>
						<button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save"></i> L??u</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: aliceblue; color: #6c757d;">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		function Xoa($id) {
			Swal.fire({
				title: 'B???n c?? ch???c ch???n mu???n x??a t??nh n??ng n??y ?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok. X??a n??!',
				cancelButtonText: 'Kh??ng'
			}).then((result) => {
				if (result.value) {
					$url = 'tinh-nang/xoa/' + $id;
					open($url, "_self")
				}
			})
		};

		function capNhat($id) {
			$url = 'tinh-nang/cap-nhat/' + $id;
			open($url, "_self");
		}
	</script>
	@endsection