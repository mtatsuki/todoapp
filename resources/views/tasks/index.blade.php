@extends('layouts.default')

@section('content')

<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-10">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="/task">ALL</a>
          </li>
          <li class="nav-item">
          @if ($tabs->isNotEmpty())
            @foreach ($tabs as $tab)
            <li class="nav-item">
              <a class="nav-link" href="{{ action('TasksController@show', $tab->id)}}">{{$tab->tab_name}}</a>
            </li>
            @endforeach
          @endif
        </ul>
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
        <small class="form-text text-muted text-center">タブ管理から新しいタブを追加してください。</small>
      @endif
  </div>
</div>

@endsection
