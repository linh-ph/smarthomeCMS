@extends('layout')

@section('js')
<!-- third party js -->
<!-- third party js ends -->
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
<!-- Datatables init -->
@if ($thongBao == 1)
<script>
    $(document).ready(function() {
        swal.fire("Thêm thành công!", "", "success")
    });
</script>
@elseif ($thongBao == 2)
<script>
    $(document).ready(function() {
        swal.fire("Thêm thất bại!", "", "error")
    });
</script>
@endif
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
@endsection
@section('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Thêm quản trị viên</h4>
                <form action="{{ route('quan-tri-vien.xl-them-moi') }}" method="POST">
                    @csrf
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
                    <button type="submit" class="btn btn-info waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Lưu
                    </button>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
    <!-- end col -->
</div>
@endsection