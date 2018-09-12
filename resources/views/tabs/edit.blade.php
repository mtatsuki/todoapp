@extends('layouts.default')

@section('content')

<div class="card">
  <div class="card-header">
    タブ設定
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <h3>編集画面</h3>
            <form action="{{ url('tab/update/'.$tabs->id) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputTab">新しいタブ名</label>
                    <input type="text" class="form-control" name="tab_name" id="exampleInputTab" placeholder="{{ $tabs->tab_name }}" required>
                    <input type="submit" class="btn btn-primary btn-sm" value="追加">
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection
