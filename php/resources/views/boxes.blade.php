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
                <div class="col-12 col-md-6 col-lg-4 p-3 text-center" data-item="box" id="box-{{ $box->id }}">
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
@endsection

@section('js')
    <script defer>
      $(document).ready(function () {
        let boxes = [];

        $('#boxSearch').submit(function (e) {
          e.preventDefault();
          boxes = []

          if ($('#search').val().length > 2) {
            $('[data-item="box"]').remove();

            $.ajax({
              type: 'POST',
              url: $('#boxSearch').attr('action'),
              data: $('#boxSearch').serialize(),
              success: function (response) {
                if (response.length > 0 && response !== undefined) {
                  for (var i in response) {
                    boxes.push(response[i].id);

                    $('#boxesWrapper').append('<div class="col-12 col-md-6 col-lg-4 p-3 text-center" data-item="box" id="box-' + response[i].id + '">'
                      + '<span style="font-size:1.12rem; margin:10px 0;"><strong>' + response[i].name + '</strong></span>'
                      + '<br />' + response[i].month + '<span class="p-1">/</span>' + response[i].year
                      + '</div>'
                    );
                  }

                  boxes.forEach(function (id) {
                    $.ajax({
                      url: '/box/' + id + '/items',
                      success: function (items) {
                        if (items.length > 0) {
                          for (var j in items) {
                            $('#box-' + id)
                              .append('<div class="row col-12">' + items[j].name + '</div>')
                              .append('<div class="row col-12 ml-3">' + items[j].description + '</div>');
                          }
                        }
                      }
                    });
                  });
                } else {
                  alert('There was an issue with your search');
                }
              },
              error: function (response) {
                console.log(response);
                alert('error!!');
              }
            })
          } else if ($('#search').val().length === 0) {
            location.reload();
          } else {
            alert('Search must contain at least 3 characters');
          }
        });
      });
    </script>
@endsection
