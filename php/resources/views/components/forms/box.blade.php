<form id="Box{{ $box->id }}" method="POST" action="{{ route('update_item') }}" style="width:100%;" class="mb-4">
    @csrf
    <input type="text" hidden="hidden" id="id" name="id" value="{{ $box->id }}"/>
    <div class="row">
        <div class="col-3">
            <input id="name" name="name" type="text" value="{{ $box->name }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror" required/>
            @error('name')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6">
            <textarea id="description" name="description" type="text"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror" required>{{ $box->description }}</textarea>
            @error('description')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-1 justify-content-center">
            <label for="active" class="mt-2 mb-0">Active</label>
            <input id="active" class="ml-3" name="active" value="1" type="checkbox" @if($box->active) checked="checked" @endif />
        </div>
        <div class="col-2 justify-content-end">
            <button type="submit" class="btn-primary btn mt-2">Save</button>
        </div>
    </div>
</form>
