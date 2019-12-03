<?php

namespace App\Http\Controllers;

use App\Address;
use App\Box;
use App\Item;
use App\PaymentMethod;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
    public function boxes()
    {
        $boxes = Box::all();
        $items = Item::all();

        return view('admin.boxes', compact('boxes', 'items'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function box()
    {
        $items = Item::all();

        return view('admin.create_box', compact('items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createBox(Request $request)
    {
        $request->validate([
            'items' => 'array|nullable',
            'name' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'month' => 'integer|digitsBetween:1,2'
        ]);


        $box = new Box();
        $box->name = $request->input('name');
        $box->month = $request->input('month');
        $box->year = $request->input('year');

        $box->save();

        if ($items = $request->input('items')) {
            $items = Item::find($request->input('items'));
            $box->items()->attach($items);
        }

        return redirect()->route('manage_boxes');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBox(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'items' => 'array|nullable',
            'name' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'month' => 'integer|digitsBetween:1,2',
            'sent' => 'required|date|nullable',
        ]);

        $box = Box::find($request->input('id'));

        $box->name = $request->input('name');
        $box->name = $request->input('year');
        $box->name = $request->input('month');
        $box->name = $request->input('sent');

        $box->save();

        if ($items = $request->input('items')) {
            $items = Item::find($request->input('items'));
            $box->items()->attach($items);
        }

        return redirect()->route('create_boxes');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function items()
    {
        $items = Item::all();

        return view('admin.items', compact('items'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function item()
    {
        return view('admin.create_item');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|max:255',
            'active' => 'integer|digits:1'
        ]);

        $item = Item::find($request->input('id'));

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->active = $request->input('active', false);

        $item->save();

        return redirect()->route('items');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->active = true;

        $item->save();

        return redirect()->route('items');
    }
}
