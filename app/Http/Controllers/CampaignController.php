<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $namePage = 'Campaigns';
    protected $folder = 'campaign';

    public function index()
    {
        $items = Campaign::all();
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
                'title' => 'required|string|max:255',
                'short_detail' => 'required|string',
                'detail' => 'required|string',
                'reward1' => 'string|max:255',
                'reward2' => 'string|max:255',
                'reward3' => 'string|max:255',
                'reward4' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
            ]);
            
            // Upload the image and save its path in the database
            if ($request->hasFile('image')) {
                $upImage = Helper::upload_image($request->file('image'), 'campaign', 412, 300);
                $data['image'] = $upImage['image'];
            }
            Campaign::create($data);
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
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Campaign::findOrFail($id);
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
        $campaign = Campaign::findOrFail($id);
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'short_detail' => 'required|string',
                'detail' => 'required|string',
                'reward1' => 'string|max:255',
                'reward2' => 'string|max:255',
                'reward3' => 'string|max:255',
                'reward4' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
            ]);
            
            // Upload the image and save its path in the database
            if ($request->hasFile('image')) {
                if ($campaign->image != null) {
                    Storage::disk('public')->delete($campaign->image);
                }
                $upImage = Helper::upload_image($request->file('image'), 'campaign', 412, 300);
                $data['image'] = $upImage['image'];
            }
            $campaign->update($data);
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
            $data = Campaign::findOrFail($id);
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
        $data = Campaign::findOrFail($id);
        $data->status = ($data->status == 'draft') ? 'published' : 'draft';
        if ($data->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
