<form id="boxSearch" class="form-inline my-2 my-md-0" method="POST" action="{{ route('search') }}">
    @csrf
    <input name="search" id="search" class="form-control" type="text" placeholder="Search">
</form>

{{--<script>--}}
  {{--$(document).ready(function() {--}}
    {{--$('#boxSearch').submit(function(e) {--}}
      {{--e.preventDefault();--}}

      {{--if ($('#search').val().length > 2) {--}}
        {{--$.ajax({--}}
          {{--type: 'POST',--}}
          {{--url: $('#boxSearch').attr('action'),--}}
          {{--data: $('#boxSearch').serialize(),--}}
          {{--success: function(response) {--}}
            {{--console.log(response);--}}
            {{--alert('success!!')--}}
          {{--},--}}
          {{--error: function(response) {--}}
            {{--console.log(response);--}}
            {{--alert('error!!');--}}
          {{--}--}}
        {{--})--}}
      {{--} else {--}}
        {{--alert('Search must contain at least 3 characters');--}}
      {{--}--}}
    {{--});--}}
  {{--});--}}
{{--</script>--}}
