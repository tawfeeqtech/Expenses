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
                                <div class="form-group">
                                    <label for="name">الاسم
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"  class="form-control @error('name') parsley-error @enderror" id="name" name="name"
                                           value="{{ old('name',$section->name) }}" required autofocus>


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
                                        <option value="الدخل" @selected(old('type',$section->type) == 'الدخل') >الدخل</option>
                                        <option value="المصروف" @selected(old('type',$section->type) == 'المصروف') >المصروف</option>
                                    </select>

                                    @error('type')
                                    <ul class="parsley-errors-list filled mb-2">
                                        <li class="parsley-required">{{ $message }}.</li>
                                    </ul>
                                    @enderror
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

