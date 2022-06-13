<h2>Пополнить баланс</h2>
@if(cache()->has('balance')) {{ cache()->get('balance') }}
@else 0
@endif
<form action="{{route('payment.create')}}" method="post">
    @csrf
    <input type="text" name="amount">
    <input type="submit">
</form>
