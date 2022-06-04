<form action="{{route('sendOrderData')}}" method="post">
    @csrf
    <input type="text" placeholder="name" name="name">
    <input type="text" placeholder="email" name="email">
    <input type="submit" value="Order">
</form>
