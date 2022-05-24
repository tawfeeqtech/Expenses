{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'تعديل قسم')

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
                        <li class="breadcrumb-item active">تعديل قسم</li>
                    </ol>
                </div>
                <h4 class="page-title">تعديل قسم</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card-box">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('sections.update',$section->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="typeHidden" id="typeHidden" value="{{$section->type}}">
                            <input type="hidden" name="subsection_id" value="{{$section->id}}">


                            <div class="form-group">
                                <label for="name">الاسم
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') parsley-error @enderror" id="name"
                                       name="name"
                                       value="{{ old('name',$section->name) }}" required autofocus>
                                {{--                                       value="{{ old('name',$section->subsections[0]->name) }}" required autofocus>--}}


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
                                    <option value="الدخل" @selected(old(
                                    'type',$section->type) == 'الدخل') >الدخل</option>
                                    <option value="المصروف" @selected(old(
                                    'type',$section->type) == 'المصروف') >المصروف</option>
                                </select>

                                @error('type')
                                <ul class="parsley-errors-list filled mb-2">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div>
                                <label>القسم الرئيسي</label>
                                <select class="custom-select" name="section_id" id="parent_section">
                                    @foreach($section->all as $asd)
                                        <option
                                            value="{{$asd->id}}" {{$asd->id === $section->section_id ? 'selected' : ''}}> {{$asd->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-lg btn-danger btn-block waves-effect waves-light">حفظ
                                    </button>
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

            $('#type').on('change', function () {
                const sectionId = this.value;
                $('#parent_section').html('');
                $.ajax({
                    url: '{{ route('sections.sectionType') }}?type=' + sectionId,
                    type: 'get',
                    success: function (res) {
                        $.each(res, function (key, value) {
                            const name = value.name;
                            const id = value.id;
                            $('#parent_section').append('<option  value="' + id + '">' + name + '</option>');
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
