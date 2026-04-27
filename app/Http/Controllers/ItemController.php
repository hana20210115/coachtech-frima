<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Like; 
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        if ($request->query('tab') === 'mylist') {
            if (auth()->check()) {
                $query = auth()->user()->likedItems();
            } else {
                return view('items.index', ['items' => collect()]);
            }
        }

        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        $items = $query->get();

        return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
        $item = Item::with(['categories', 'condition', 'comments.user'])->findOrFail($item_id);
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

    public function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $conditions = Condition::orderBy('id', 'asc')->get();

        return view('sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'user_id'      => Auth::id(),
            'condition_id' => $request->condition_id,
            'name'         => $request->name,
            'brand'        => $request->brand,
            'description'  => $request->description,
            'price'        => $request->price,
            'image'        => $imagePath,
        ]);

        $item->categories()->attach($request->category_ids);

        
        return redirect()->route('mypage.index')->with('status', '商品を出品しました');
    }
}