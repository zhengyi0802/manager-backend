<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\BulletinItem;
use App\Http\Middleware\ImageUpload;
use Illuminate\Http\Request;

class BulletinItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $bulletinitems = BulletinItem::leftJoin('bulletins', 'bulletin_id', 'bulletins.id')
                        ->select('bulletin_items.*', 'bulletins.title as bulletin')
                        ->latest()->paginate(5);

       return view('bulletinitems.index', compact('bulletinitems'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bulletins = Bulletin::where('status', true)->get();

        return view('bulletinitems.create', compact('bulletins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
             'bulletin_id' => 'required',
             'type'        => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem = new BulletinItem;
        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->type        = $request->type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = $file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index')
               ->with('success','Bulletin Item created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function show(BulletinItem $bulletinitem)
    {
        $id = $bulletinitem->id;
        $bulletinitem = BulletinItem::leftJoin('bulletins', 'bulletin_id', 'bulletins.id')
                        ->select('bulletin_items.*', 'bulletins.title as bulletin')
                        ->where('bulletin_items.id', $id)->first();

        return view('bulletinitems.show', compact('bulletinitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BulletinItem $bulletinitem)
    {
        $bulletins = Bulletin::where('status', true)->get();

        return view('bulletinitems.edit', compact('bulletinitem'))
               ->with(compact('bulletins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BulletinItem $bulletinitem)
    {
        $request->validate([
             'bulletin_id' => 'required',
             'type'        => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->type        = $request->type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = $file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index')
               ->with('success','Bulletin Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulletinItem $bulletinitem)
    {
        $bulletinitem->delete();

        return redirect()->route('bulletinitems.index')
               ->with('success','Bulletin Item deleted successfully');
    }

    public function query(Request $request)
    {

    }

}
