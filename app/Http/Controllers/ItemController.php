<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
    $items = Item::all();
    return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
       
    $item = Item::findOrFail($item_id);

        
    return view('items.show', compact('item'));
    }

}
