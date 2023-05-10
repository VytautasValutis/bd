@if($user_status)
<form action="" method="post">
    <button type="submit" class="btn btn-outline-primary">Like</button>
    <input type="hidden" name="user_id" value={{$user_status->id}}>
    @csrf
    @method('put')
</form>
@endif
