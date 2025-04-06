<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Batch;
use App\Models\Service;
use App\Models\BatchUser;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\DataTables\ServiceDataTable;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateCourcesRequest;

class ServiceController extends AppBaseController
{

    public function index(ServiceDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('services.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new Cources.
     *
     * @return Response
     */
    public function create()
    {
        $categories = ServiceCategory::where('status','Active')->pluck('name', 'id')->toArray();
        return view('services.create',compact('categories'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'delivery_time' => 'required',
        ]);

         // Handle the image upload
         if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/service'), $imageName); // Moves to public/images
        }

        $model = new Service();
        $model->title = $request->title;
        $model->category_id = $request->category_id;
        $model->description = $request->description;
        $model->price = $request->price;
        $model->discount_price = $request->discount_price;
        $model->photo = $imageName ?? null;
        $model->delivery_time = $request->delivery_time;
        $model->save();

        Session::flash('success', 'Service saved successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Display the specified Cources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cources = $this->courcesRepository->find($id);

        if (empty($cources)) {
            Flash::error('Cources not found');

            return redirect(route('cources.index'));
        }

        return view('cources.show')->with('cources', $cources);
    }

    /**
     * Show the form for editing the specified Cources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $service = Service::find($id);
        $categories = ServiceCategory::where('status','Active')->pluck('name', 'id')->toArray();


        return view('services.edit',compact('categories','service'));

    }

    /**
     * Update the specified Cources in storage.
     *
     * @param int $id
     * @param UpdateCourcesRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'delivery_time' => 'required',
        ]);

        $model = Service::find($id);

        if (empty($model)) {
            Session::flash('failed', 'Service not found');
            return redirect(route('services.index'));
        }

         // Handle the image upload
         if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/service'), $imageName); // Moves to public/images

            $model->photo = $imageName ?? null;
        }

        $model->title = $request->title;
        $model->category_id = $request->category_id;
        $model->description = $request->description;
        $model->price = $request->price;
        $model->discount_price = $request->discount_price;
        $model->delivery_time = $request->delivery_time;
        $model->status = $request->status;
        $model->save();

        Session::flash('success', 'Service Update successfully.');

        return redirect(route('services.index'));

    }

    /**
     * Remove the specified Cources from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if (empty($service)) {
            Session::flash('failed', 'Service not found');

            return redirect(route('services.index'));
        }

        $service->delete();

        Session::flash('success', 'Service deleted successfully.');

        return redirect(route('services.index'));
    }
}
