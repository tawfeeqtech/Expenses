{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'جهات الاتصال')

@push('style')
    <!-- Sweet Alert-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Notification css (Toastr) -->
    <link href="{{asset('assets/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
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
                        <li class="breadcrumb-item active">جهات الاتصال</li>
                    </ol>
                </div>
                <h4 class="page-title">جهات الاتصال</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title float-left">
                    <a href="{{route('contacts.create')}}"
                       class="btn btn-lg btn-success btn-block waves-effect waves-light">
                        انشاء جهة اتصال
                        <i class="mdi mdi-plus mr-1"></i>
                    </a>
                </h4>

                <div class="table-responsive">

                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>

                                <td>{{$contact->name}}</td>
                                <td>
                                    <a href="{{route('contacts.edit',$contact->id)}}"
                                       class="btn btn-success">تعديل</a>

                                    <form method="POST" style="display: inline"
                                          action="{{ route('contacts.destroy', $contact->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger show-alert-delete-box ">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center table-danger" colspan="3">لا يوجد ببيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

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
                confirmButtonText: "نعم ، احذفها!",
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

    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

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
