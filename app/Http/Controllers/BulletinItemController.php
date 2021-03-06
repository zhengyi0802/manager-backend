<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\BulletinItem;
use App\Http\Middleware\MediaUpload;
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
                        ->select('bulletin_items.*', 'bulletins.title as bulletin', 'bulletins.message as message')
                        ->latest()->paginate(5);

       return view('bulletinitems.index', compact('bulletinitems'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index2(Bulletin $bulletin)
    {
       $bulletinitems = BulletinItem::where('bulletin_id', $bulletin->id)->latest()->paginate(5);

       return view('bulletinitems.index2', compact('bulletinitems'))
              ->with(compact('bulletin'))
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

    public function create2(Bulletin $bulletin)
    {
        return view('bulletinitems.create2', compact('bulletin'));
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
             'mime_type'   => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem = new BulletinItem;
        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->mime_type   = $request->mime_type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;

        if ($request->file()) {
            $file = MediaUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = env('APP_URL').$file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index')
               ->with('success','Bulletin Item created successfully');
    }

    public function store2(Bulletin $bulletin, Request $request)
    {
        $request->validate([
             'bulletin_id' => 'required',
             'mime_type'   => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem = new BulletinItem;
        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->mime_type   = $request->mime_type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;

        if ($request->file()) {
            $file = MediaUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = env('APP_URL').$file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index2')
               ->with(compact('bulletin'))
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
                        ->select('bulletin_items.*', 'bulletins.title as bulletin', 'bulletins.message as message')
                        ->where('bulletin_items.id', $id)->first();

        return view('bulletinitems.show', compact('bulletinitem'));
    }

    public function show2(Bulletin $bulletin, BulletinItem $bulletinitem)
    {
        return view('bulletinitems.show2', compact('bulletinitem'))
               ->with(compact('bulletin'));
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

    public function edit2(Bulletin $bulletin, BulletinItem $bulletinitem)
    {
        return view('bulletinitems.edit2', compact('bulletinitem'))
               ->with(compact('bulletin'));
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
             'mime_type'   => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->mime_type   = $request->mime_type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;
        var_dump(json_encode($bulletinitem));

        if ($request->file()) {
            $file = MediaUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = env('APP_URL').$file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index')
               ->with('success','Bulletin Item updated successfully');
    }

    public function update2(Request $request, Bulletin $bulletin, BulletinItem $bulletinitem)
    {
        $request->validate([
             'bulletin_id' => 'required',
             'mime_type'   => 'required',
             'status'      => 'required',
        ]);

        $bulletinitem->bulletin_id = $request->bulletin_id;
        $bulletinitem->mime_type   = $request->mime_type;
        $bulletinitem->url         = $request->url;
        $bulletinitem->status      = $request->status;

        if ($request->file()) {
            $file = MediaUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $bulletinitem->url = env('APP_URL').$file->file_path;
        }

        $bulletinitem->save();

        return redirect()->route('bulletinitems.index')
               ->with(compact('bulletin'))
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
