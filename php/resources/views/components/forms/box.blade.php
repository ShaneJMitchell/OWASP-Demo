<form id="Box{{ $box->id }}" method="POST" action="{{ route('update_box') }}" style="width:100%;" class="mb-4">
    @csrf
    <input type="text" hidden="hidden" id="id" name="id" value="{{ $box->id }}"/>
    <div class="row">
        <div class="col-4">
            <input id="name" name="name" type="text" value="{{ $box->name }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror" required/>
            @error('name')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
            <div class="text-center mt-1">
                {{ $box->month }} / {{ $box->year }}
            </div>
        </div>
        <div class="col-6">
            <select multiple id="items" data-box="{{ $box->id }}" name="items[]" type="text"
                    style="width:100%; padding:5px;"
                    class="form-inline @error('items') is-invalid @enderror">
                @foreach($items as $item)
                    {{ $item->selected = 0 }}
                    @foreach($box->items as $i)
                        @if ($item->id == $i->id) {{ $item->selected = 1 }} @endif
                    @endforeach
                    <option @if($item->selected) selected="selected" @endif value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('items')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-2 justify-content-end">
            <button type="submit" class="btn-primary btn mt-2">Save</button>
        </div>
    </div>
</form>
