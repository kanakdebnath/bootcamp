<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateCourcesRequest;
use App\DataTables\ServiceCategoryDataTable;

class ServiceCategoryController extends AppBaseController
{

    public function index(ServiceCategoryDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('category.index');
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
        return view('category.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $model = new ServiceCategory();
        $model->name = $request->name;
        $model->save();

        Session::flash('success', 'Service Category saved successfully.');

        return redirect(route('category.index'));
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
        $category = ServiceCategory::find($id);
        return view('category.edit',compact('category'));
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
            'name' => 'required|string',
        ]);


        $model = ServiceCategory::find($id);

        if (empty($model)) {
            Session::flash('failed', 'Service Category not found');

            return redirect(route('category.index'));
        }

        $model->name = $request->name;
        $model->status = $request->status;
        $model->save();

        Session::flash('success', 'Service Category updated successfully.');

        return redirect(route('category.index'));

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
        $class = ServiceCategory::find($id);

        if (empty($class)) {
            Session::flash('failed', 'Service Category not found');

            return redirect(route('category.index'));
        }

        $class->delete();

        Session::flash('success', 'Service Category deleted successfully.');

        return redirect(route('category.index'));
    }
}
