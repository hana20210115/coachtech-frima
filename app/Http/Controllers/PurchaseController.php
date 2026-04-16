<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
       
        $item = Item::findOrFail($item_id);

        
        return view('purchase.create', compact('item'));
    }
}
