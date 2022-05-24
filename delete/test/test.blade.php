
<ul class="nav nav-pills" id="myTabalt" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#الدخل" role="tab"
           aria-controls="home" aria-expanded="true">الدخل</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#المصروف" role="tab"
           aria-controls="profile">المصروف</a>
    </li>
</ul>

<div class="tab-content text-muted" id="myTabaltContent">
    <div role="tabpanel" class="tab-pane fade in active show" id="الدخل" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-lg-12">
                @foreach($incomeSections as $incomeSection)
                    @if(count($incomeSection->subsections) > 0)
                        <button  type="button" class="btn btn-purple waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-sm-{{$incomeSection->id}}">{{$incomeSection->name}}</button>

                        <div class="modal fade bs-example-modal-sm-{{$incomeSection->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel_{{$incomeSection->id}}" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mySmallModalLabel_{{$incomeSection->id}}">{{$incomeSection->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach($incomeSection->subsections as $subsection)
                                            <h5 class="btn-group mr-1 mt-1"> {{$subsection->name}}</h5>

                                        @endforeach
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    @else

                        <h5 class="btn-group mr-1 mt-1"> {{$incomeSection->name}}</h5>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="المصروف" role="tabpanel" aria-labelledby="profile-tab">
        @foreach($outlaySections as $outlaySection)
           <h3>{{$outlaySection->name}}</h3>
            <br>
        @endforeach
    </div>
</div>
