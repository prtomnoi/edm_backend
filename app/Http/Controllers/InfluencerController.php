<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $namePage = 'Influencer';
    protected $folder = 'influencer';

    public function index()
    {
        $items = Influencer::all();
        return view("$this->folder.index", [
            'items' => $items,
            'name_page' => $this->namePage,
            'folder' => $this->folder,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("$this->folder.create", [
            'name_page' => $this->namePage,
            'folder' => $this->folder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'subscribe' => 'string|max:255',
                'facebook' => 'string|max:255',
                'twitter' => 'string|max:255',
                'youtube' => 'string|max:255',
                'instagram' => 'string|max:255',
                'icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
            ]);
            // Upload the image and save its path in the database
            if ($request->hasFile('icon')) {
                $upImage = Helper::upload_image($request->file('icon'), 'influencer/icon', 77, 77);
                $data['icon'] = $upImage['image'];
            }
            if ($request->hasFile('image')) {
                $upImage = Helper::upload_image($request->file('image'), 'influencer', 301, 399);
                $data['image'] = $upImage['image'];
            }
            Influencer::create($data);
            DB::commit();
            return redirect()->route("$this->folder.index")->with('success', "$this->namePage created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("$this->folder.index")->with('error', 'Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Influencer $Influencer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Influencer::findOrFail($id);
        return view("$this->folder.edit", [
            'name_page' => $this->namePage,
            'folder' => $this->folder,
            'row' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $influencer = Influencer::findOrFail($id);
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'subscribe' => 'string|max:255',
                'facebook' => 'string|max:255',
                'twitter' => 'string|max:255',
                'youtube' => 'string|max:255',
                'instagram' => 'string|max:255',
                'icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
            ]);
            
            // Upload the image and save its path in the database
            if ($request->hasFile('icon')) {
                if ($influencer->icon != null) {
                    Storage::disk('public')->delete($influencer->icon);
                }
                $upImage = Helper::upload_image($request->file('icon'), 'influencer/icon', 77, 77);
                $data['icon'] = $upImage['image'];
            }

            if ($request->hasFile('image')) {
                if ($influencer->image != null) {
                    Storage::disk('public')->delete($influencer->image);
                }
                $upImage = Helper::upload_image($request->file('image'), 'influencer', 301, 399);
                $data['image'] = $upImage['image'];
            }
            $influencer->update($data);
            DB::commit();
            return redirect()->route("$this->folder.index")->with('success', "$this->namePage created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("$this->folder.index")->with('error', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $data = Influencer::findOrFail($id);
            if ($data->image != null) {
                try {
                    Storage::disk('public')->delete($data->image);
                } catch (\Exception $e) {
                }
            }
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something broke'], 500);
        }
    }

    public function status($id = null)
    {
        $data = Influencer::findOrFail($id);
        $data->status = ($data->status == 'draft') ? 'published' : 'draft';
        if ($data->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
