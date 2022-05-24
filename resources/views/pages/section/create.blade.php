{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'انشاء قسم')

@push('style')
    <style>
        .sub-section {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            background-color: #e9ecef;
            border-radius: 0.25rem;
        }
    </style>
    <link href="{{asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/libs/multiselect/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="{{route('sections.index')}}">الاقسام</a></li>
                        <li class="breadcrumb-item active">اضافة قسم</li>
                    </ol>
                </div>
                <h4 class="page-title">اضافة قسم جديد</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card-box">
                <div class="row ">
                    <div class="col">
                        <form method="POST" action="{{ route('sections.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-section">
                                        <div class="switchery-demo float-right">
                                            <input type="checkbox"  data-plugin="switchery" data-color="#64b0f2" data-size="small" />
                                        </div>
                                        <div class="breadcrumb-item ">اضافة قسم فرعي</div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">الاسم
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"  class="form-control @error('name') parsley-error @enderror" id="name" name="name" placeholder="اسم القسم">


                                @error('name')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div>
                                <label>نوع القسم</label>
                                <select class="custom-select mb-2" name="type" id="type">
                                    <option></option>
                                    <option value="الدخل">الدخل</option>
                                    <option value="المصروف">المصروف</option>
                                </select>

                                @error('type')
                                <ul class="parsley-errors-list filled mb-2">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div id="local_section" style="display: none;">
                                <label>قسم داخلي</label>
                                <input type="hidden" name="isVisible" id="isVisible">
                                <select class="custom-select" name="section_id" id="parent_section">
                                    <option value="">اختر قسم</option>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-danger btn-block waves-effect waves-light">حفظ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            $("input[type=checkbox]").change(function () {
                $("#local_section").toggle();
                if($("#local_section").is(":visible")){
                    $("#isVisible").val('true');
                }else{
                    $("#isVisible").val('false');
                }
            });

                $('#type').on('change', function () {
                    const sectionId = this.value;
                    console.log(sectionId);
                    $('#parent_section').html('');
                    $.ajax({
                        url:'{{ route('sections.sectionType') }}?type='+sectionId,
                        type: 'get',
                        success:function(res){
                            // console.log(res);
                            // return false;
                            // console.log(res);
                            // $('#parent_section').html('');
                            $.each(res, function (key, value) {
                                const name = value.name;
                                // const type = value.type; //data-type="'+type+'"
                                const id = value.id;

                                $('#parent_section').append('<option  value="'+id+'">'+name+'</option>');
                            });
                        }
                    });
                });

        });
    </script>
    <!-- select2 plugin js -->
    <script src="{{asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('assets/libs/switchery/switchery.min.js')}}"></script>

    <script src="{{asset('assets/libs/multiselect/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>

    <!-- form advanced init -->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

@endpush
