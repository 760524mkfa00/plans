@extends('layouts.app')

@section('content')
    <div class="container">
        @include('./_partials/error')
        @include('./_partials/message')
        <div class="row">
            <div class="col-md-12">
                @if($user->hasRole('Manager'))
                    <form action="{{ route('building.update', [$building]) }}" class="form-horizontal details" method="post" role="form" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{ $building->id }}">
                        {{ csrf_field() }}
                        @include('buildings._partials.form', ['submitButtonText' => 'Update Building'])
                    </form>
                @else
                    <p>You do not have permission to create a building.</p>
                @endif
            </div>
        </div>
    </div>
@endsection