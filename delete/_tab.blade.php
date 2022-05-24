
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
            <table class="table table-hover table-bordered mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الإجراءات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($incomeSections as $incomeSection)
                    <tr>
                        <th scope="row">{{$loop->index +1 }}</th>
                        <td>{{$incomeSection->name}}</td>
                        <td>
                            <a href="{{route('sections.edit',$incomeSection->id)}}"
                               class="btn btn-success">تعديل</a>

                            <form method="POST" style="display: inline" action="{{ route('sections.destroy', $incomeSection->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger show-alert-delete-box ">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="tab-pane fade" id="المصروف" role="tabpanel" aria-labelledby="profile-tab">

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
                @foreach($outlaySections as $outlaySection)
                    <tr>
                        <th scope="row">{{$loop->index +1 }}</th>
                        <td>{{$outlaySection->name}}</td>
                        <td>
                            <a href="{{route('sections.edit',$outlaySection->id)}}"
                               class="btn btn-success">تعديل</a>

                            <form method="POST" style="display: inline" action="{{ route('sections.destroy', $outlaySection->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger show-alert-delete-box ">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
