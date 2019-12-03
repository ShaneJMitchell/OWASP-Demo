@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="text-left col-6">
                                {{ ucfirst($user->name) }}'s Profile
                            </div>
                            <div style="font-size:0.68rem;" class="text-right col-6">
                                <span class="mr-2">
                                    Member Since:
                                </span>
                                <strong>{{ (new DateTime($user->created_at))->format('Y-m-d') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                       @include('components.forms.profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
