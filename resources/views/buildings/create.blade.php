@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('buildings') }}" class="form-horizontal details" method="post" role="form" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    @include('buildings._partials.form', ['submitButtonText' => 'Create Building'])
                </form>
            </div>
        </div>
    </div>
@endsection