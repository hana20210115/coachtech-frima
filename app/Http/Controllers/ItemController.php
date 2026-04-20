<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Like; 
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->tab === 'mylist') {
            
            if (!auth()->check()) {
                $items = collect(); 
                return view('items.index', compact('items'));
            }

            $query = auth()->user()->likedItems(); 

            
            if ($request->filled('keyword')) {
                $query->where('name', 'LIKE', '%' . $request->keyword . '%');
            }

            $items = $query->get(); 
            return view('items.index', compact('items'));
        }

        $query = Item::query();

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        
        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        $items = $query->get();

        return view('items.index', compact('items'));
    }

   

    public function show($item_id)
    {
       
    $item = Item::with(['categories',  'condition', 'comments.user'])->findOrFail($item_id);

   

    return view('items.show', compact('item'));
    }

    public function Like($item_id)
    {
        $user_id = Auth::id();

       
        $like = Like::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if ($like) {
            
            $like->delete();
        } else {
            
            Like::create([
                'user_id' => $user_id,
                'item_id' => $item_id,
            ]);
        }

       
        return back();
    }

    public function store(ExhibitionRequest $request)
    {
       dd($request->category_id);

    
        $item = Item::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description'  => $validated['description'],
            'condition_id' => $validated['condition_id'],

            'brand'        => $request->brand,
            'user_id'      => Auth::id(),
     
        ]);

        
        
        
        if ($request->has('category_ids')) {
            $item->categories()->sync($request->category_ids);
        }

        
        return redirect()->route('items.show', $item->id);
    }

}
