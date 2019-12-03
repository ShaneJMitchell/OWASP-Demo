<form id="CreateBox" method="POST" action="{{ route('create_item') }}">
    @csrf
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="name" class="mr-3">Name:</label>
        </div>
        <div class="col-9">
            <input id="name" name="name" type="text" value=""
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror" required/>
            @error('name')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="description" class="mr-3">Description:</label>
        </div>
        <div class="col-9">
            <textarea id="description" name="description" type="text"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror" required></textarea>
            @error('description')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row m-1 justify-content-end">
        <button type="submit" class="btn-primary btn m-4">Save</button>
    </div>
</form>
