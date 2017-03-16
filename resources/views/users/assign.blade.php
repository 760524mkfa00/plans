@foreach ($users->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $user)
            <div class="col-xs-6">
                <input type="checkbox" name="user_id[]" value="{{ $user->id }}" {{ ($role->users->contains($user->id)) ? 'checked="checked"' : '' }}>
                {{ $user->first_name . ' ' . $user->last_name }}
            </div>
        @endforeach
    </div>
@endforeach