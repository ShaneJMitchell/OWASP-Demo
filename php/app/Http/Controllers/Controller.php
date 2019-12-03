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
     * Function designed to expose an input to SQL injection
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchExposed(Request $request)
    {
        $input = $request->input('search');

        $boxes = DB::select(DB::raw("SELECT b.id FROM boxes b WHERE b.name LIKE '%" . $input . "%'"));
        $items = DB::select(DB::raw("SELECT i.id FROM items i WHERE i.name LIKE '%" . $input . "%' OR i.description LIKE '%" . $input . "%'"));

        $boxIds = [];
        foreach ($boxes as $box) {
            if (!in_array($box->id, $boxIds)) $boxIds[] = $box->id;
        }
        $itemIds = [];
        foreach ($items as $item) {
            if (!in_array($item->id, $itemIds)) $itemIds[] = $item->id;
        }

        $boxes = DB::select(DB::raw("SELECT b.* FROM boxes b LEFT JOIN box_item bi on b.id = bi.box_id WHERE b.id IN (" . implode(',', $boxIds) . ") OR bi.item_id IN (" . implode(',', $itemIds) . ") ORDER BY b.year, b.month"));

        foreach ($boxes as $key => $box) {
            $box->items = DB::select(DB::raw("SELECT i.* from items i JOIN box_item bi on i.id = bi.item_id WHERE bi.box_id = " . $box->id));
            $boxes[$key] = $box;
        }

        return response()->json($boxes);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $input = $request->input('search');

        $boxes = DB::table('boxes')
            ->where('boxes.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->get('boxes.id');

        $items = DB::table('items')
            ->orWhere('items.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orWhere('items.description', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->get('items.id');
return response()->json([$boxes, $items]);
        $boxes = DB::table('boxes')
            ->join('box_item', 'boxes.id', '=', 'box_item.box_id')
            ->join('items', 'box_item.item_id', '=', 'items.id')
            ->where('boxes.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orWhere('items.name', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orWhere('items.description', 'LIKE', '%' . str_replace(['%', '_', "'"], ['\%', '\_', "\'"], $input) . '%')
            ->orderBy('boxes.year')
            ->orderBy('boxes.month')
            ->get();
        foreach ($boxes as $key => $box) {
            $box->items = DB::select(DB::raw("SELECT i.* from items i JOIN box_item bi on i.id = bi.item_id WHERE bi.box_id = " . $box->id));
            $boxes[$key] = $box;
        }
        return response()->json($boxes);
    }
}
