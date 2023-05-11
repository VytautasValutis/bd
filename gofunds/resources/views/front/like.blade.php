@if($user_status && $user_status->role > 5 && !($likes->where('user_id', $user_status->id)->where('history_id', $hist->id)->first()))
<form action="{{route('like-create')}}" method="post">
    <button type="submit" class="btn btn-outline-primary">Like</button>
    <input type="hidden" name="user_id" value={{$user_status->id}}>
    <input type="hidden" name="hist_id" value={{$hist->id}}>
    @csrf
</form>
@endif