@extends('restaurant.show')

@section('comment_form')

<div class="comment_form">
    <form id="form" name="comment_form" action="{{ route('restaurant.comment_store') }}" method="post">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        <div class="comment_form_title">コメントの投稿</div>
        <div class="fivestar_title">注文の評価</div>
        <div class="rate-form">
            <input id="star5" type="radio" name="fivestar" value="5">
            <label for="star5">★</label>
            <input id="star4" type="radio" name="fivestar" value="4">
            <label for="star4">★</label>
            <input id="star3" type="radio" name="fivestar" value="3">
            <label for="star3">★</label>
            <input id="star2" type="radio" name="fivestar" value="2">
            <label for="star2">★</label>
            <input id="star1" type="radio" name="fivestar" value="1">
            <label for="star1">★</label>
        </div>
        <div class="comment_create_title">コメント記載</div>
        {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 6]) }}
        <div class="button_black">
            <a href="#" onclick="clickCommentButton()">コメントを投稿する</a>
        </div>
    </form>
</div>

@if(Session::has('flashmessage'))
aaa
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>
  $(window).load(function() {
  $('#modal_box').modal('show');
  });
</script>
 

@else
bbb
@endif
<!-- モーダルウィンドウの中身 -->
<div class="modal fade" id="modal_box" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">受講生 APP</h4>
  </div>
  <div class="modal-body">
  {{ session('flashmessage') }}
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
  </div>
  </div>
  </div>
</div>
@endsection