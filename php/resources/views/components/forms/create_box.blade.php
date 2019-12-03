<form id="CreateBox" method="POST" action="{{ route('create_box') }}">
    @csrf
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="items" class="mr-3">Choose Items:</label>
        </div>
        <div class="col-9">
            <select multiple id="items" name="items[]" type="text"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('items') is-invalid @enderror">
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('items')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="name" class="mr-3">Box Name:</label>
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
            <label for="month" class="mr-3">Box Month:</label>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-6 justify-content-center">
                    <select id="month" name="month"
                            style="width:100%; padding:5px;"
                            class="form-inline @error('month') is-invalid @enderror">
                        <option disabled>Month</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    @error('month')
                    <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6 justify-content-center">
                    <select id="year" name="year"
                            style="width:100%; padding:5px;"
                            class="form-inline @error('year') is-invalid @enderror">
                        <option disabled>Year</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                    @error('year')
                    <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="row m-1 justify-content-end">
        <button type="submit" class="btn-primary btn m-4">Save</button>
    </div>
</form>
