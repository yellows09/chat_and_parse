<form action="{{route('login')}}" method="post">
    @csrf
    <input type="text" placeholder="email" name="email">
    <input type="text" placeholder="password" name="password">
    <input type="submit" value="Login">
</form>
