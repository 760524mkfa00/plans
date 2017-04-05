@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($user->hasRole('manager'))
                    <form action="{{ route('buildings') }}" class="form-horizontal details" method="post" role="form" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        @include('buildings._partials.form', ['submitButtonText' => 'Create Building'])
                    </form>
                @else
                    <p>You do not have permission to create a building.</p>
                @endif
            </div>
        </div>
    </div>
@endsection