{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'تعديل محفظة')

{{-- Content --}}
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{route('wallets.index')}}">المحفظات</a></li>
                        <li class="breadcrumb-item active">تعديل محفظة</li>
                    </ol>
                </div>
                <h4 class="page-title">تعديل محفظة</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card-box">
                <div class="row ">
                    <div class="col">
                        <form method="POST" action="{{ route('wallets.update',$wallet->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">الاسم
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"  class="form-control @error('name') parsley-error @enderror" id="name" name="name"
                                       value="{{ old('name',$wallet->name) }}" required autofocus>


                                @error('name')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div>
                                <label>نوع العملة
                                </label>
                                <select class="custom-select mb-3" name="currency">
                                    <option value="شيكل"  @selected(old('currency',$wallet->currency) == 'شيكل') >شيكل</option>
                                    <option value="دولار"  @selected(old('currency',$wallet->currency) == 'دولار') >دولار</option>
                                    <option value="دينار"  @selected(old('currency',$wallet->currency) == 'دينار') >دينار</option>
                                </select>

                                @error('currency')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="balance">الرصيد الحالي
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('balance') parsley-error @enderror" id="balance" name="balance"
                                       value="{{ old('name',$wallet->balance) }}" >
                                @error('balance')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}.</li>
                                </ul>
                                @enderror
                            </div>
                            <div>
                                <label>نوع المحفظة
                                </label>

                                <select class="custom-select mb-3" name="type">
                                    <option value="نقدي"  @selected(old('currency',$wallet->currency) == 'نقدي') >نقدي</option>
                                    <option value="بطاقة ائتمان"  @selected(old('currency',$wallet->currency) == 'بطاقة ائتمان') >بطاقة ائتمان</option>
                                    <option value="اخرى"  @selected(old('currency',$wallet->currency) == 'اخرى') >اخرى</option>
                                </select>
                                @error('type')
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

