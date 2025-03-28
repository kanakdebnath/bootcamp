<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supports = Support::where('parent_id',null)->latest()->paginate(10);

        return view('frontend.support.index',compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.support.create');
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
            'subject' => 'required|string',
            'details' => 'required',
        ]);

        // Handle the image upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Moves to public/images
        }

        $orderNum  = mt_rand(1000000, 9999999);

        $support = new Support();
        $support->subject = $request->subject;
        $support->details = $request->details;
        $support->user_id = auth()->id();
        $support->support_id = $orderNum;
        $support->photo = $imageName ?? null;
        $support->save();

        return redirect()->route('user.support.index')->with('success', 'Support Ticket Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $support = Support::findOrFail($id);
        $last = Support::with('employee','user')->where('parent_id',$id)->latest()->first();
        $supports = Support::where('parent_id',$id)->latest()->get();
        return view('frontend.support.show',compact('support','last','supports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'details' => 'required',
        ]);

        // Handle the image upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Moves to public/images
        }

        $support = new Support();
        $support->details = $request->details;
        $support->parent_id = $id;
        $support->user_id = auth()->id();
        $support->photo = $imageName ?? null;
        $support->save();

        return redirect()->route('user.support.show',$id)->with('success', 'Support Ticket Reply Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();

        return redirect()->route('user.support.index')->with('success', 'Support Ticket deleted successfully');
    }
}
