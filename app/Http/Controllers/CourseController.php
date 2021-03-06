<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Record;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'administrador')
        {   $courses = Course::OrderBy('theme')->get();
            $users = User::OrderBy('name')->get();
        }
        else
        {   $courses = Course::where('user_id', auth()->user()->id)->get();
            $users = User::where('name', auth()->user()->name)->get();
        }
        return view('courses')
        ->with('courses', $courses)
        ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course($request->all());
        $course->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = Record::where('course_id', $id)->get();
        $users = User::OrderBy('name')->get();
        $courses = Course::where('id', $id)->get();
        return view('recordsshow')
        ->with('users', $users)
        ->with('courses', $courses)
        ->with('records', $records);
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
    public function update(Request $request, $id)
    {
        $course = Course::find($request->id);
        $course->user_id = $request->user_id;
        $course->theme = $request->theme;
        $course->type = $request->type;
        $course->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $course = Course::find($request->id);
        $course->delete();
        return back();
    }
}
