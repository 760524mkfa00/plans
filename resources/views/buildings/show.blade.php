@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @include('./_partials/error')
                @include('./_partials/message')
                <h1>{{ $building->building_name }}</h1>
                <p>{{ $building->street . ', ' . $building->town . ', ' . $building->postal }}</p>
                <p>{{ $building->description }}</p>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($building->pictures->chunk(4) as $set)
                            <div class="row">
                                @foreach($set as $picture)
                                    <div class="col-md-3">
                                        <a href="{{ asset($picture->path) }}" data-lity>
                                            <img src="{{ asset($picture->thumbnail_path) }}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Location</th>
                                <th>Type</th>
                                <th>File Name</th>
                                <th>File Type</th>
                                <th>File</th>
                                @if($user->hasRole('manager'))
                                    <th>Edit</th>
                                @endif
                                </thead>
                                @foreach($building->plans as $plan)
                                    <tr>
                                        <td>{{ $plan->floors->name ?? 'Please Edit' }}</td>
                                        <td>{{ $plan->types->name ?? 'Please Edit' }}</td>
                                        <td>{{ $plan->name }}</td>
                                        @if($plan->file_type <> "pdf")
                                            <td style="color:blue"><i
                                                        class="fa fa-pencil-square-o"></i> {{$plan->file_type}}</td>
                                        @else
                                            <td style="color:red"><i
                                                        class="fa fa-file-{{$plan->file_type}}-o"></i> {{$plan->file_type}}
                                            </td>
                                        @endif
                                        <td><a href="{{ route('plan.download', [$plan->id])  }}">Download File</a></td>
{{--                                        @if($user->hasRole('manager'))--}}
                                            <td><a href="{{ route('plan.edit', [$plan]) }}">Edit</a></td>
                                        {{--@endif--}}
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @if($user->hasRole('Manager'))
                    <div class="row">
                        <div class="col-md-12">

                            <div id="uploader">
                                <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                            </div>
                            <hr/>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection

@section('footer')

    {{--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js" charset="UTF-8"></script>--}}

    <script type="text/javascript" src="/js/jquery-ui.min.js" charset="UTF-8"></script>

    <script type="text/javascript" src="/js/plupload.full.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/js/jquery.ui.plupload.min.js" charset="UTF-8"></script>


    {{--<link href="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript">--}}

    {{--<link href="{{ asset('js/plupload.full.min.js') }}" type="text/javascript">--}}
{{--    <link href="{{ asset('js/jquery.ui.plupload.min.js') }}" type="text/javascript">--}}
    <script>
        // Initialize the widget when the DOM is ready

        $(document).ready(function() {
            $(function () {
                $("#uploader").plupload({

                    // General settings
                    runtimes: 'html5,flash,silverlight,html4',
                    url: "{{ route('plan.upload', ['buildingName' => $building->building_name]) }}",

                    // Maximum file size
                    max_file_size: '10gb',

                    chunk_size: '2mb',

                    // Resize images on clientside if we can
                    resize: {
                        width: 200,
                        height: 200,
                        quality: 90,
                        crop: true // crop to exact dimensions
                    },

                    // Specify what files to browse for
                    filters: [
                        {title: "Image files", extensions: "jpg,gif,png"},
                        {title: "PDF files", extensions: "pdf"}
                    ],

                    multipart_params: {building_id: "{{$building->id}}"},

                    // Rename files by clicking on their titles
                    rename: true,

                    // Sort files
                    sortable: true,

                    // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
                    dragdrop: true,

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },


                    // Views to activate
                    views: {
                        list: true,
                        thumbs: false, // Show thumbs
                        active: 'list'
                    },

                    // Flash settings
                    flash_swf_url: '/plupload/js/Moxie.swf',

                    // Silverlight settings
                    silverlight_xap_url: '/plupload/js/Moxie.xap'


                });
            });
        });
    </script>

@endsection