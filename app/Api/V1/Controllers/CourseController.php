<?php

namespace App\Api\V1\Controllers;

use App\Api\Transformers\CourseTransformer;
use App\Course;
use App\Http\Requests\StoreCourse;
use App\Http\Requests\UpdateCourse;
use Illuminate\Http\Request;

class CourseController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collection = Course::query();
        $sortBy = 'start';
        $sortDir = 'DESC';
        if ($request->get('sortDir', false) && $request->get('sortBy', false)) {
            $sortBy = $request->get('sortBy');
            $sortDir = $request->get('sortDir');
        }
        return $collection->orderBy($sortBy, $sortDir)->paginate(10);
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
        return (new CourseTransformer)->transform(Course::findOrFail($id));
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
        $course = Course::findOrFail($id);
        $input = $request->all();
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
        //
    }
}
