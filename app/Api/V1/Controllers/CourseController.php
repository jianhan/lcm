<?php

namespace App\Api\V1\Controllers;

use App\Api\Requests\StoreCourse;
use App\Api\Requests\UpdateCourse;
use App\Api\Transformers\CourseTransformer;
use App\Api\V1\BaseController;
use App\Course;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collection = Course::query();
        if ($request->get('query', '') !== '') {
            $collection->where(function ($q) use ($request) {
                $likeStr = '%' . $request->get('query') . '%';
                $q->where('name', 'LIKE', $likeStr)->orWhere('description', 'LIKE', $likeStr);
            });
        }
        $sortBy = 'start';
        $sortDir = 'DESC';
        if ($request->get('sortDir', false) && $request->get('sortBy', false)) {
            $sortBy = $request->get('sortBy');
            $sortDir = $request->get('sortDir');
        }
        return $this->response->paginator($collection->orderBy($sortBy, $sortDir)->paginate(10), new CourseTransformer);
    }

    /** * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {
        return Course::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->response->item(Course::findOrFail($id), new CourseTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourse $request, $id)
    {
        Course::findOrFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
    }
}
