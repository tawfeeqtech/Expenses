
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
        <div id="basicTree" class="basicTree">
            <ul>
                @foreach($incomeSections as $incomeSection)
                    @if(count($incomeSection->subsections) >0)
                        <li data-jstree='{"opened":true}'>
                            {{$incomeSection->name}}
                            <ul>
                                @foreach($incomeSection->subsections as $subsection)
                                    <li data-jstree='{"type":"file"}'>{{$subsection->name}}</li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li data-jstree='{"icon":"mdi mdi-camera-timer"}'>{{$incomeSection->name}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>


    <div class="tab-pane fade" id="المصروف" role="tabpanel" aria-labelledby="profile-tab">
        <div id="basicTree" class="basicTree">
            <ul>
        @foreach($outlaySections as $outlaySection)
            @if(count($outlaySection->subsections) >0)
                <li data-jstree='{"opened":true}'>
                    {{$outlaySection->name}}
                    <ul>
                        @foreach($outlaySection->subsections as $sub_section)
                            <li data-jstree='{"type":"file"}'>{{$sub_section->name}}</li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li data-jstree='{"icon":"mdi mdi-camera-timer"}'>{{$outlaySection->name}}</li>
            @endif
        @endforeach
            </ul>
        </div>
    </div>
</div>
