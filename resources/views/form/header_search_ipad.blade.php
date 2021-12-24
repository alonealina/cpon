<form id="freeword_form_ipad" action="{{ route('search') }}" method="get">
    {!! Form::text('freeword' ,'', ['class' => 'freeword_text_ipad', 'placeholder' => 'キーワードで検索'] ) !!}
    <button type="submit" class="fas_search_button"><i class="fas fa-search"></i></button>
</form>