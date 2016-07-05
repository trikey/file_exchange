{!! Form::open(
array(
'class' => '',
'novalidate' => 'novalidate',
'url' => strstr($_SERVER["REQUEST_URI"], 'users') ? '/users/search' : '/search',
'id' => 'search_form',
'method' => 'get'
)) !!}
<div class="form-search">
    {!! Form::text('query', isset($search) ? $search : null, array('placeholder'=>'Начните вводить запрос например RHG-2427', 'class' => 'form-control search-input', 'id' => 'search')) !!}
    {!! Form::submit('', array('class' => 'btn-search')) !!}
</div>
{!! Form::close() !!}