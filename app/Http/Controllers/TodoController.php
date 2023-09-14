<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class TodoController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }

    public function show($id)
    {
        $todo = Item::find($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if( $existingItem) {
            if($existingItem->completed) {
                $existingItem->completed = false;
            } else {
                $existingItem->completed = true;
            }
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now()->format('Y-m-d') : null;
            $existingItem->save();
            var_dump($existingItem->completed);
            var_dump($existingItem);

            return $existingItem;
        }

        return "Item not found.";
    }

    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if( $existingItem) {
            $existingItem->delete();

            return "Item successfully deleted";
        }

        return "Item not found.";
    }

    public function summary()
    {
        $items = Item::orderBy('created_at', 'DESC')->where('completed', true)->get();
        return response()->json($items);
    }
}
