<form id="UpdatePaymentInfo" method="POST" action="{{ route('update_payment_info') }}">
    @csrf
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="number" class="mr-3">Card Number:</label>
        </div>
        <div class="col-9">
            <input id="number" name="number" type="text" value="{{ $card ? $card->card_number : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('number') is-invalid @enderror"/>
            @error('number')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="name" class="mr-3">Name On Card:</label>
        </div>
        <div class="col-9">
            <input id="name" name="name" type="text" value="{{ $card ? $card->name_on_card : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('name') is-invalid @enderror"/>
            @error('name')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="exp_month" class="mr-3">Exp Date:</label>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-6 justify-content-center">
                    <select id="exp_month" name="exp_month"
                           style="width:100%; padding:5px;"
                           class="form-inline @error('exp_month') is-invalid @enderror">
                        <option disabled></option>
                        <option value="1" @if($card && $card->exp_month == 1) selected="selected" @endif>1</option>
                        <option value="2" @if($card && $card->exp_month == 2) selected="selected" @endif>2</option>
                        <option value="3" @if($card && $card->exp_month == 3) selected="selected" @endif>3</option>
                        <option value="4" @if($card && $card->exp_month == 4) selected="selected" @endif>4</option>
                        <option value="5" @if($card && $card->exp_month == 5) selected="selected" @endif>5</option>
                        <option value="6" @if($card && $card->exp_month == 6) selected="selected" @endif>6</option>
                        <option value="7" @if($card && $card->exp_month == 7) selected="selected" @endif>7</option>
                        <option value="8" @if($card && $card->exp_month == 8) selected="selected" @endif>8</option>
                        <option value="9" @if($card && $card->exp_month == 9) selected="selected" @endif>9</option>
                        <option value="10" @if($card && $card->exp_month == 10) selected="selected" @endif>10</option>
                        <option value="11" @if($card && $card->exp_month == 11) selected="selected" @endif>11</option>
                        <option value="12" @if($card && $card->exp_month == 12) selected="selected" @endif>12</option>
                    </select>
                    @error('exp_month')
                    <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6 justify-content-center">
                    <select id="exp_year" name="exp_year"
                           style="width:100%; padding:5px;"
                           class="form-inline @error('exp_year') is-invalid @enderror">
                        <option disabled></option>
                        <option value="2019" @if($card && $card->exp_year == 2019) selected="selected" @endif>2019</option>
                        <option value="2020" @if($card && $card->exp_year == 2020) selected="selected" @endif>2020</option>
                        <option value="2021" @if($card && $card->exp_year == 2021) selected="selected" @endif>2021</option>
                        <option value="2022" @if($card && $card->exp_year == 2022) selected="selected" @endif>2022</option>
                        <option value="2023" @if($card && $card->exp_year == 2023) selected="selected" @endif>2023</option>
                        <option value="2024" @if($card && $card->exp_year == 2024) selected="selected" @endif>2024</option>
                        <option value="2025" @if($card && $card->exp_year == 2025) selected="selected" @endif>2025</option>
                        <option value="2026" @if($card && $card->exp_year == 2026) selected="selected" @endif>2026</option>
                        <option value="2027" @if($card && $card->exp_year == 2027) selected="selected" @endif>2027</option>
                        <option value="2028" @if($card && $card->exp_year == 2028) selected="selected" @endif>2028</option>
                        <option value="2029" @if($card && $card->exp_year == 2029) selected="selected" @endif>2029</option>
                        <option value="2030" @if($card && $card->exp_year == 2030) selected="selected" @endif>2030</option>
                        <option value="2031" @if($card && $card->exp_year == 2031) selected="selected" @endif>2031</option>
                        <option value="2032" @if($card && $card->exp_year == 2032) selected="selected" @endif>2032</option>
                        <option value="2033" @if($card && $card->exp_year == 2033) selected="selected" @endif>2033</option>
                        <option value="2034" @if($card && $card->exp_year == 2034) selected="selected" @endif>2034</option>
                        <option value="2035" @if($card && $card->exp_year == 2035) selected="selected" @endif>2035</option>
                        <option value="2036" @if($card && $card->exp_year == 2036) selected="selected" @endif>2036</option>
                        <option value="2037" @if($card && $card->exp_year == 2037) selected="selected" @endif>2037</option>
                        <option value="2038" @if($card && $card->exp_year == 2038) selected="selected" @endif>2038</option>
                        <option value="2039" @if($card && $card->exp_year == 2039) selected="selected" @endif>2039</option>
                    </select>
                    @error('exp_year')
                    <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3 text-right">
            <label for="type" class="mr-3">Card Type:</label>
        </div>
        <div class="col-3">
            <select id="type" name="type"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('type') is-invalid @enderror">
                <option disabled></option>
                <option value="VISA" @if($card && $card->type == 'VISA') selected="selected" @endif>VISA</option>
                <option value="MASTERCARD" @if($card && $card->type == 'MASTERCARD') selected="selected" @endif>MASTERCARD</option>
            </select>
            @error('type')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-3 text-right">
            <label for="ccv" class="mr-3">CCV:</label>
        </div>
        <div class="col-3">
            <input id="ccv" name="ccv" type="number" value="{{ $card ? $card->ccv : '' }}"
                   style="width:100%; padding:5px;"
                   class="form-inline @error('ccv') is-invalid @enderror"/>
            @error('ccv')
            <div class="alert alert-danger w-100 text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row m-1 justify-content-end">
        <button type="submit" class="btn-primary btn m-4">Save</button>
    </div>
</form>
