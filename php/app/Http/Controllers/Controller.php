<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('main');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function boxes()
    {
        $now = new \DateTime();
        // Default show boxes for current month and later
        $boxes = DB::select(DB::raw("SELECT b.* FROM boxes b "
            . "WHERE (b.year = " . $now->format('Y')
                . " AND b.month >= " . $now->format('m')
            . ") OR b.year > " . $now->format('Y')
            . " ORDER BY b.year, b.month"));

        foreach ($boxes as $key => $box) {
            $box->items = DB::select(DB::raw("SELECT i.* from items i JOIN box_item bi on i.id = bi.item_id WHERE bi.box_id = " . $box->id));
            $boxes[$key] = $box;
        }

        return view('boxes', compact('boxes'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function boxItemsExposed(Request $request, $id)
    {
        return response()->json(DB::select(DB::raw("SELECT i.* from items i JOIN box_item bi on i.id = bi.item_id WHERE bi.box_id = " . $id)));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function boxItems(Request $request, $id)
    {
        if (!intval($id)) return response()->json('Invalid Box Id Provided', 422);

        return response()->json(DB::select(DB::raw("SELECT i.* from items i JOIN box_item bi on i.id = bi.item_id WHERE bi.box_id = " . $id)));
    }

    /**
     * Function designed to expose an input to SQL injection
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchExposed(Request $request)
    {
        $input = $request->input('search');

        $boxes = DB::select(DB::raw("SELECT b.* FROM boxes b JOIN box_item bi on b.id = bi.box_id JOIN items i on bi.item_id = i.id WHERE b.name LIKE '%" . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . "%' OR  i.name LIKE '%" . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . "%' OR i.description LIKE '%" . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . "%' GROUP BY b.id"));

        return response()->json($boxes);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $input = $request->input('search');

        $itemBoxes = [];
        $items = Item::query()
            ->where('items.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orWhere('items.description', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->get();
        /** @var Item $item */
        foreach ($items as $item) {
            foreach ($item->boxes()->get() as $box) {
                if (!in_array($box->id, $itemBoxes)) $itemBoxes[] = $box->id;
            }
        }

        $boxes = DB::table('boxes')
            ->where('boxes.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orWhere('boxes.id', 'IN', '(' . implode(',', $itemBoxes) . ')')
            ->orderBy('boxes.year')
            ->orderBy('boxes.month')
            ->get();


        return response()->json($boxes);
    }
}
