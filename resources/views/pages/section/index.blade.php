{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'الاقسام')

@push('style')
    <!-- Sweet Alert-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Notification css (Toastr) -->
    <link href="{{asset('assets/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>


    <!-- Table datatable css -->
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endpush


{{-- Content --}}
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الاقسام</li>
                    </ol>
                </div>
                <h4 class="page-title ssssssssss">الاقسام</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title float-right">
                    <a href="{{route('sections.create')}}"
                       class="btn btn-dark waves-effect waves-light">
                        اضافة قسم
                        <i class="mdi mdi-plus mr-1"></i>
                    </a>
                </h4>
                @include("pages.section._tab")
            </div>
        </div>
    </div>
@endsection


@push('scripts')

    <!-- Datatable plugin js -->
    <script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Datatables init -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Sweet alert init js-->
    {{--    <script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>--}}
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function (event) {
            const form = $(this).closest("form");

            event.preventDefault();

            Swal.fire({
                title: "هل أنت واثق؟",
                text: "لن تتمكن من التراجع عن هذا!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#348cd4",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "نعم ، احذف!",
                cancelButtonText: 'الغاء',
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        icon: "success",
                        type: "success",
                        title: "تم الحذف بنجاح",
                        showConfirmButton: !1,
                        timer: 1000,
                        onClose: function () {
                            form.submit();
                        }
                    });
                }
            })
        });
    </script>

    <!-- Toastr js -->
    <script src="{{asset('assets/libs/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>
    <script>
        @if(Session::has('message'))
            toastr.options =
            {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{ session('message') }}");
        @endif
    </script>

@endpush
