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
	        $("#linh-vuc-datatable").DataTable({
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
	<h1>Danh sách quản trị viên</h1>
	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
	                <div class="row">
	                    <div class="col-sm-12 col-md-6">
	                        <button data-toggle="modal" data-target="#ThemMoi" class="btn btn-info waves-effect waves-light">
	                            <i class="mdi mdi-plus-box"></i> Thêm quản trị viên
	                        </button>
	                    </div>
	                    <div class="col-sm-12 col-md-6" style="text-align: right;">
	                        <a href="{{route('quan-tri-vien.thung-rac')}}" class="btn btn-info waves-effect waves-light">
	                            <i class="mdi mdi-delete-empty"></i> Thùng rác
	                        </a>
	                    </div>
	                </div>
	                <br />
	                <br />
	                <br />
	                <table id="linh-vuc-datatable" class="table dt-responsive nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Họ và tên</th>
	                            <th>Tên đăng nhập</th>
	                            <th>Số điện thoại</th>
	                            <th>Email</th>
	                            <th>Ngày tạo</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($quanTriVien as $QuanTriVien)
	                        <tr>
	                            <td>{{ $QuanTriVien->id }}</td>
	                            <td>{{ $QuanTriVien->name }}</td>
	                            <td>{{ $QuanTriVien->username }}</td>
	                            <td>{{ $QuanTriVien->phone }}</td>
	                            <td>{{ $QuanTriVien->email }}</td>
	                            <td>{{ $QuanTriVien->created_at }}</td>
	                            <td>
	                                <!-- <button data-toggle="modal" data-target="#CapNhat{{$QuanTriVien->id}}" type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-pen"></i></button> -->
	                                <button onclick="Xoa({{$QuanTriVien->id}})" type="button" class="btn btn-danger waves-effect waves-light"><i class=" mdi mdi-delete"></i></button>
	                            </td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>

	            </div> <!-- end card body-->
	        </div> <!-- end card -->
	    </div><!-- end col-->
	</div>

	<div class="modal fade" id="ThemMoi" role="dialog">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Thêm mới quản trị viên</h4>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <div class="modal-body">
	                <form action="{{ route('quan-tri-vien.them-moi') }}" method="POST">
	                    @csrf
	                    <div class="form-group">
	                        <div class="form-group">
	                            <label for="name">Họ và tên</label>
	                            <input value="{{ old('name') }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập tên người dùng" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="username">Tên đăng nhập</label>
	                            <input value="{{ old('username') }}" type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="phone">Số điện thoại</label>
	                            <input value="{{ old('phone') }}" type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="username">Email</label>
	                            <input value="{{ old('email') }}" type="text" class="form-control" id="email" name="email" placeholder="Nhập email" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="username">Mật khẩu</label>
	                            <input value="{{ old('password') }}" type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="username">Nhập lại mật khẩu</label>
	                            <input value="{{ old('repassword') }}" type="password" class="form-control" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" required>
	                        </div>
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

	<script>
	    function Xoa($id) {
	        Swal.fire({
	            title: 'Bạn có Muốn Xóa Không?',
	            type: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Ok. Xóa nó!',
	            cancelButtonText: 'Không'
	        }).then((result) => {
	            if (result.value) {
	                $url = 'quan-tri-vien/xoa/' + $id;
	                open($url, "_self")
	            }
	        })
	    };

	    function capNhat($id) {
	        $url = 'quan-tri-vien/cap-nhat/' + $id;
	        open($url, "_self");
	    }
	</script>
	@endsection