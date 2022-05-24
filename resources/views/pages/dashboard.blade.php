{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'لوحة التحكم')

@push('style')
    <!-- Chartist Chart CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/chartist/chartist.min.css')}}">
@endpush

{{-- Content --}}
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">لوحة التحكم</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row justify-content-md-center">
        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-info text-white text-center">اليوم</h5>
                @foreach($data['today'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-info text-white text-center">الاسبوع الحالي</h5>
                @foreach($data['currentWeek'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-info text-white text-center">الشهر الحالي</h5>
                @foreach($data['thisMonth'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-pink text-white text-center">أمس</h5>
                @foreach($data['yesterdays'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-dark text-white text-center">الاسبوع السابق</h5>
                @foreach($data['lastWeeks'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-xl-3 col-md-3">
            <div class="card-box tilebox-two">
                <h5 class="rounded p-2 mb-2 bg-dark text-white text-center">الشهر السابق</h5>
                @foreach($data['previousMonth'] as $key => $value)
                    @if($key ==='الدخل')
                        <h5>الدخل: <span data-plugin="counterup">{{$value}}</span></h5>
                    @else
                        <h5>المصروف: <span data-plugin="counterup">{{$value}}</span></h5>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <span class="header-title">احصائيات شهرية</span>

                <div class="row text-center">
                    <div class="col-6">
                        <h4 data-plugin="counterup" class="text-success">1,507</h4>
                        <p class="text-muted">اجمالي الدخل</p>
                    </div>
                    <div class="col-6">
                        <h4 data-plugin="counterup" class="text-danger">916</h4>
                        <p class="text-muted">اجمالي المصاريف</p>
                    </div>

                </div>
                {{--style="height: 300px;"--}}

                <div id="chart">
                </div>

            </div>
        </div><!-- end col-->


    </div>
    <!-- end row -->

@endsection

@push('scripts')
    <!--Morris Chart-->
    <script src="{{asset('assets/js/pages/apex-charts.js')}}"></script>

    <!-- widget init -->

    <script>

    </script>
    <script>
        const data1 = [];
        let countA = 0;
        let countB = 0;

        const data2 = [];
        const category = [];

        $.ajax({
            url:'{{ route('dashboard.getWeeks') }}',
            type: 'get',
            success:function(res){
                console.log(res);
                const values = Object.values(res);
                category.push(Object.keys(res));
                $.each(values, function (key, value) {
                    countA +=value['الدخل'];
                    console.log(value['الدخل'] +"\n\n");
                    countB +=value['المصروف'];
                    data1.push(value['الدخل']);
                    data2.push(value['المصروف']);
                });
            },complete: function () {
                console.log(countA);
                console.log(countB);
                // console.log(category);
                printWithAjax();
            }
        });


        function printWithAjax() {
            var options = {
                series: [{
                    name: ' الدخل',
                    data: data1
                }, {
                    name: ' المصاريف',
                    data: data2
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    stackType: '100%'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                xaxis: {
                    categories: category[0],
                    // categories: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4'],
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'right',
                    offsetX: 0,
                    offsetY: 50
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
@endpush
