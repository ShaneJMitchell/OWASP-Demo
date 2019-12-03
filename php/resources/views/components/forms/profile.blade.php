<form id="UpdateProfile" method="POST" action="{{ route('update_profile') }}">
    @csrf
    <div class="row ml-2 mt-4 mb-4">
        <img src="{{ asset('img/user_silhouette.png') }}" alt="" style="max-height: 65px; opacity: 0.3;"/>
    </div>

    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="name" class="mr-3">Name:</label>
        </div>
        <div class="col-9">
            <input id="name" name="name" type="text" value="{{ $user->name }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror"/>
            @error('name')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="name" class="mr-3">Email:</label>
        </div>
        <div class="col-9">
            <input id="email" name="email" type="email" value="{{ $user->email }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('email') is-invalid @enderror"/>
            @error('email')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row ml-3 mt-4 mb-2">
        <h2 class="text-center">Address</h2>
    </div>

    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="street" class="mr-3">Street:</label>
        </div>
        <div class="col-9">
            <input id="street" name="street" type="text" value="{{ $address ? $address->street : ''}}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('street') is-invalid @enderror"/>
            @error('street')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="unit" class="mr-3">Unit:</label>
        </div>
        <div class="col-9">
            <input id="unit" name="unit" type="text" value="{{ $address ? $address->unit : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('unit') is-invalid @enderror"/>
            @error('unit')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="city" class="mr-3">City:</label>
        </div>
        <div class="col-9">
            <input id="city" name="city" type="text" value="{{ $address ? $address->city : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('city') is-invalid @enderror"/>
            @error('city')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="state" class="mr-3">State:</label>
        </div>
        <div class="col-9">
            <input id="state" name="state" type="text" value="{{ $address ? $address->state : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('state') is-invalid @enderror"/>
            @error('state')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="zip" class="mr-3">Zip:</label>
        </div>
        <div class="col-9">
            <input id="zip" name="zip" type="text" value="{{ $address ? $address->zip : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('zip') is-invalid @enderror"/>
            @error('zip')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row m-1 justify-content-end">
        <button type="submit" class="btn-primary btn m-4">Save</button>
    </div>
</form>
