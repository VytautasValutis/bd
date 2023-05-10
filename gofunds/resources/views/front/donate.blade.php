@if($user_status)
<form action="" method="post">
    <button type="submit" class="btn btn-outline-primary">Donate :</button>
    <input name="value" type="text" value="0.00">
    @csrf
    @method('put')
</form>
@endif
