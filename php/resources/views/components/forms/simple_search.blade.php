<form id="boxSearch" class="form-inline my-2 my-md-0" method="POST" action="{{ route('search') }}">
    @csrf
    <input name="search" id="search" class="form-control" type="text" placeholder="Search">
</form>
