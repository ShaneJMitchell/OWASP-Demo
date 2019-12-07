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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <select multiple id="modal-items" name="modal-items[]" type="text"
                            style="width:100%; padding:5px;" class="form-inline">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addItems()">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
