<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\News;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::all();
        return view('news.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try{
            DB::beginTransaction();
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'detail' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
                'provider_id' => 'required|exists:providers,id',
            ]);
            // Upload the image and save its path in the database
            if ($request->hasFile('image')) {
                $upImage = Helper::upload_image($request->file('image'),'news',412,300);
                // $imagePath = $request->file('image')->store('news_images', 'public');
                $data['image'] = $upImage['image'];
            }
            News::create($data);
            DB::commit();
            return redirect()->route('news.index')->with('success', 'News created successfully!');
       }
       catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('news.index')->with('error', 'Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        $providers = Provider::all();
        return view('news.edit', compact('news', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'provider_id' => 'required|exists:providers,id',
        ]);

        // Associate the user who updated the news item
        $data['updated_by'] = $request->user()->id;

        // Upload the image and save its path in the database
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $news = News::findOrFail($id);
            if($news->image != null){
                try { Storage::disk('public')->delete($news->image); } catch (\Exception $e) {}
            }
            $news->delete();
            DB::commit();
            return response()->json(['message' => 'Successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something broke'], 500);
        }
    }
}
