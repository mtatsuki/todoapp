@extends('layouts.default')

@section('content')

<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-10">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" href="/task">ALL</a>
          </li>
          <li class="nav-item">
          @if ($tabs->isNotEmpty())
            @foreach ($tabs as $tab)
            <li class="nav-item">
              <a class="nav-link <?php if ($tab->tab_id == $tab_id) echo 'active' ?>" href="{{ action('TasksController@show', $tab->tab_id)}}">{{$tab->tab_name}}</a>
            </li>
            @endforeach
          @endif
        </ul>
      </div>

      <div class="col-md-2 text-right">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
          追加
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">タスクの追加</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="post" action="{{url('/task')}}">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                    <label for="InputTask">タスク名</label>
                    <input type="text" class="form-control" name="task" id="InputTask" placeholder="Enter task" required>
                    <input type="hidden" value="{{$tab_id}}" name="tab_id">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <input type="submit" class="btn btn-primary" value="追加">
              </div>
              </form>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="card-body">
    @if ($items->isNotEmpty())
      @foreach($items as $item)
      <div class="row">
        <div class="col-md-10">
          @if($item->do_flg == 'done')
            <del>{{$item -> task}}</del>
          @else
            {{$item -> task}}
          @endif
        </div>
        <div class="col-md-1">
          <a href="{{ action('TasksController@check', $item->task_id)}}" class="btn btn-success btn-sm">Check</a>
        </div>
        <div class="col-md-1">
          <a href="{{ action('TasksController@destroy', $item->task_id)}}" class="btn btn-danger btn-sm">del</a>
        </div>

      </div>
      <hr>
      @endforeach
    @else
      <div class="col text-center">まだ投稿がありません。</div>
    @endif
  </div>
</div>
@endsection
