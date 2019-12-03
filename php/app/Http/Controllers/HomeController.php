<?php

namespace App\Http\Controllers;

use App\Address;
use App\PaymentMethod;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $address = $user->address;

        return view('profile', compact('user', 'address'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileById(Request $request, $id)
    {
        /** @var User $user */
        $user = User::find($id);
        $address = $user->address;

        return view('profile', compact('user', 'address'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'street' => 'required|string|max:85',
            'unit' => 'nullable|string|max:25',
            'city' => 'required|string|max:65',
            'state' => 'required|string|max:45',
            'zip' => 'required|string|max:24'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        if (!$user->address) {
            $address = new Address();
            $address->user_id = $user->id;
            $user->address = $address;
        }

        $user->address->street = $request->input('street');
        $user->address->unit = $request->input('unit');
        $user->address->city = $request->input('city');
        $user->address->state = $request->input('state');
        $user->address->zip = $request->input('zip');

        $user->address->save();

        return redirect('profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentInfo(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $card = $user->paymentMethod;

        return view('payment_info', compact('user', 'card'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentInfoById(Request $request, $id)
    {
        /** @var User $user */
        $user = User::find($id);
        $card = $user->paymentMethod;

        return view('payment_info', compact('user', 'card'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePaymentInfo(Request $request)
    {
        $request->validate([
            'number' => 'required|string|digits:16',
            'name' => 'required|string|max:45',
            'exp_month' => 'required|integer|digits_between:1,2',
            'exp_year' => 'nullable|integer|digits:4',
            'type' => 'required|string|in:' . implode(',', ['VISA', 'MASTERCARD']),
            'ccv' => 'required|integer|digits_between:3,4',
        ]);

        /** @var User $user */
        if (!$card = Auth::user()->paymentMethod) {
            $card = new PaymentMethod();
            $card->user_id = Auth::user()->id;
        }

        $card->card_number = $request->input('number');
        $card->name_on_card = $request->input('name');
        $card->exp_month = $request->input('exp_month');
        $card->exp_year = $request->input('exp_year');
        $card->type = $request->input('type');
        $card->ccv = $request->input('ccv');

        $card->save();

        return redirect('payment_info');
    }
}
