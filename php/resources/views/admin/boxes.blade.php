@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="text-left col-6">
                                Manage Boxes
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row ml-3 mb-2">
                            @foreach($boxes as $box)
                                @include('components.forms.box')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
