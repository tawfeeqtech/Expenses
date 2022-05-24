{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'انشاء جهة اتصال')

@push('style')

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
                        <li class="breadcrumb-item"><a href="{{route('contacts.index')}}">جهات الاتصال</a></li>
                        <li class="breadcrumb-item active">اضافة جهة اتصال</li>
                    </ol>
                </div>
                <h4 class="page-title">اضافة جهة اتصال جديدة</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card-box">
                <div class="row ">
                    <div class="col">
                        <form method="POST" action="{{ route('contacts.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">الاسم
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"  class="form-control @error('name') parsley-error @enderror" id="name" name="name" placeholder="اسم جهة الاتصال">


                                @error('name')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div class="row">
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
    <!-- Datatable plugin js -->

@endpush
