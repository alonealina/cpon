<form id="freeword_form_sp" action="{{ route('search') }}" method="get">
    {!! Form::text('freeword' ,'', ['class' => 'freeword_text_sp', 'placeholder' => '店舗名・商品で検索'] ) !!}
    <button type="submit" class="fas_search_button_sp"><i class="fas fa-search"></i></button>
</form>