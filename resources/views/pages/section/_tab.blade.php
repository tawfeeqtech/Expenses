
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
        <div class="table-responsive">
            <table  class="table table-borderless datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th scope="col" class="">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                <div id="accordion">
                    @foreach($incomeSections as $incomeSection)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        @if(count($incomeSection->subsections) >0)
                            <td>
                                <a href="/" data-toggle="collapse" data-target="#collapse-{{$incomeSection->id}}" aria-expanded="true" aria-controls="collapse-{{$incomeSection->id}}">
                                    {{$incomeSection->name}}

                                    </a>
                                <div id="collapse-{{$incomeSection->id}}" class="collapse ml-4" aria-labelledby="headingOne" data-parent="#accordion">
                                    @foreach($incomeSection->subsections as $subsection)
                                        <blockquote class="blockquote blockquote-reverse text-right mb-0">
                                            <div class="d-flex justify-content-between pb-2">
                                                <h4 >{{$subsection->name}}</h4>
                                                <div>

                                                    <a href="{{route('subSections.edit',$subsection->id)}}" class="btn btn-success ">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    {{--                                                    <a href="{{route('sections.edit',$outlaySection->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>--}}
                                                    <form method="POST" style="display: inline" action="{{ route('sections.destroy', $incomeSection->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input type="hidden" name="section_id" value="{{$subsection->id}}">

                                                        <button type="submit" class="btn btn-danger show-alert-delete-box "><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>


                                        </blockquote>

                                    @endforeach
                                </div>
                            </td>
                            @else
                            <td>{{$incomeSection->name}}</td>
                        @endif
                        <td>
                            <a href="{{route('sections.edit',$incomeSection->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>

                            <form method="POST" style="display: inline" action="{{ route('sections.destroy', $incomeSection->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger show-alert-delete-box "><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </div>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="المصروف" role="tabpanel" aria-labelledby="profile-tab">
        <div class="table-responsive">
            <table  class="table table-borderless datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">الاجراءات</th>
                </tr>
                </thead>
                <tbody>
                <div id="accordion">
                    @foreach($outlaySections as $outlaySection)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            @if(count($outlaySection->subsections) >0)
                                <td>
                                    <a href="/" data-toggle="collapse" data-target="#collapse-{{$outlaySection->id}}" aria-expanded="true" aria-controls="collapse-{{$outlaySection->id}}">
                                        {{$outlaySection->name}}

                                    </a>
                                    <div id="collapse-{{$outlaySection->id}}" class="collapse ml-4" aria-labelledby="headingOne" data-parent="#accordion">
                                        @foreach($outlaySection->subsections as $subSection)
                                            <blockquote class="blockquote blockquote-reverse text-right mb-0">
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h4 >{{$subSection->name}}</h4>
                                                    <div>

                                                        <a href="{{route('subSections.edit',$subSection->id)}}" class="btn btn-success ">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        {{--                                                    <a href="{{route('sections.edit',$outlaySection->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>--}}
                                                        <form method="POST" style="display: inline" action="{{ route('sections.destroy', $outlaySection->id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-danger show-alert-delete-box "><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        @endforeach
                                    </div>
                                </td>
                            @else
                                <td>{{$outlaySection->name}}</td>
                            @endif

                            <td>
                                <a href="{{route('sections.edit',$outlaySection->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>

                                <form method="POST" style="display: inline" action="{{ route('sections.destroy', $outlaySection->id) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger show-alert-delete-box "><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
