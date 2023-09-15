<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Console\Commands\SendReminderEmail;

class TodoController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();

        if (count($items) > 1) {
            $response = [
                'code' => 00,
                'status' => true,
                'message' => 'success',
                'data' => $items
            ];
        } else {
            $response = [
                'code' => 01,
                'status' => false,
                'message' => 'Data not exist',
                'data' => null
            ];
        }

        return $response;
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

            $response = [
                'code' => 00,
                'status' => true,
                'message' => 'success',
                'data' => $existingItem
            ];

            return $response;
        }

        $response = [
            'code' => 01,
            'status' => false,
            'message' => 'Item not found',
            'data' => $existingItem
        ];

        return $response;
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
        $completedItem = Item::orderBy('created_at', 'DESC')->where('completed', true)->get();
        $incompletItem = Item::orderBy('created_at', 'DESC')->where('completed', '!=', true)->get();

        $response = [
            'code' => 00,
            'status' => true,
            'message' => 'success',
            'data' => [
                'completed_item' => $completedItem,
                'incomplete_item' => $incompletItem,
            ]
        ];

        return $response;
    }

    public function sendReminderEmail(Request $request)
    {   
        SendReminderEmail::sendReminderEmail($request);
    }
}
