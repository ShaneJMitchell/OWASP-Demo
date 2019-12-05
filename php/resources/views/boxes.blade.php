@extends('layouts.app')

@section('content')
    <div class="container-fullwidth">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Dev Boxes</h1>
            </div>
        </div>
        <div class="row m-4">
            <div class="col ml-4">
                @include('components.forms.simple_search')
            </div>
        </div>
        <div class="row m-3" id="boxesWrapper">
            @foreach($boxes as $box)
                <div class="col-12 col-md-6 col-lg-4 p-3 text-center">
                    <span style="font-size:1.12rem; margin:10px 0;"><strong>{{ $box->name }}</strong></span>
                    <br/>{{ $box->month }}<span class="p-1">/</span>{{ $box->year }}
                    @foreach($box->items as $item)
                        <div class="row col-12">
                            {{ $item->name }}
                        </div>
                        <div class="row col-12 ml-3">
                            {{ $item->description }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>


    <script>
      $(document).ready(function () {
        $('#boxSearch').submit(function (e) {
          e.preventDefault();

          if ($('#search').val().length > 2) {
            $.ajax({
              type: 'POST',
              url: $('#boxSearch').attr('action'),
              data: $('#boxSearch').serialize(),
              success: function (response) {
                console.log(response);
                alert('success!!')
              },
              error: function (response) {
                console.log(response);
                alert('error!!');
              }
            })
          } else {
            alert('Search must contain at least 3 characters');
          }
        });
      });
    </script>
@endsection
