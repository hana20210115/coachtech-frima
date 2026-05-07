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
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();
        $validated['image'] = $request->file('image')->store('items', 'public');

        $categoryIds = $validated['category_ids'];
        unset($validated['category_ids']);

        $item = Item::create($validated);
        $item->categories()->attach($categoryIds);

        return redirect()->route('mypage.index')->with('status', '商品を出品しました');
    }
    
}