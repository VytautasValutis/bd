@if($user_status && $user_status->role > 5)
<form action="{{route('money-create', $hist)}}" method="post">
    <button type="submit" class="btn btn-outline-primary">Donate :</button>
    <input name="value" type="text" value="0.00">
    <input name="user_id" type="hidden" value={{$user_status->id}}>
    <input name="hist_id" type="hidden" value={{$hist->id}}>
    @csrf
</form>
@endif
