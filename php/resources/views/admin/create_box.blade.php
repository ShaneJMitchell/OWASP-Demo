@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="text-left col-6">
                                Create Box
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('components.forms.create_box')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
