@extends('layouts.default')

@section('content')

<div class="card">
  <div class="card-header">
    タブ設定
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-10">
        <h3>タブ一覧</h3>
      </div>
      <div class="col-md-2">

        <!-- Button trigger modal -->
        <button type="button" style="margin-bottom:10px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          新規追加
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">タブの新規追加</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{url('/tab')}}" method="post">
              <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputTab">追加するタブ名</label>
                    <input type="text" class="form-control" name="tab_name" id="exampleInputTab" placeholder="Enter tab" required>
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
        <!-- Modal End -->
      </div>
    </div>
    <div class="card">
      <ul class="list-group list-group-flush">
        @if($tabs->isNotEmpty())
          @foreach ($tabs as $tab)
          <li class="list-group-item">
            <div class="row">
              <div class="col-md-10">
                {{$tab->tab_name}}
              </div>
              <div class="col-md-1">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModalCenter">編集</a>
              </div>
              <div class="col-md-1 text-right">
                <a href="#" class="btn btn-danger btn-sm" onClick="kakunin({{$tab->id}})">削除</a>
              </div>
            </div>
          </li>

              <!-- Modal -->
              <div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="updateModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateModalCenterTitle">タスクの編集</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="post" action="{{url('/tab/update/'.$tab->id)}}">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group">
                <label for="UpdateTab">タブ名</label>
                <input type="text" class="form-control" name="tab_name" id="UpdateTab" value="{{ $tab->tab_name }}" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <input type="submit" class="btn btn-primary" value="編集">
            </div>
            </form>
          </div>
        </div>
      </div>
        <!-- Modal End -->

          @endforeach
        @else
          <li class="list-group-item">現在、タブはありません。</li>
        @endif
      </ul>
    </div>
  </div>
</div>

<script>
  function kakunin(id){
    $.ajax({
      method: "GET",
      url: "/api/tab/cnt/"+ id,
      dataType: "json",
    })
    //受け取り完了時　失敗は.fail
    .done(function( msg ) {
      console.log(msg);
      ret = confirm("未実行のタスクが" + msg.yet_cnt + "件あります。本当に削除しますか？");
      if (ret == true){
        location.href = "/tab/destroy/"+ id;
      }else{
        return true;
      }
    });
  }
</script>
@endsection
