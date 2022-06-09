<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Record;
use App\Models\Activitie;

class RecordController extends Controller
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
            $records = Record::OrderBy('updated_at')->get();
        }
        else
        {   $courses = Course::OrderBy('theme')->get();
            $users = User::where('name', auth()->user()->name)->get();
            $records = Record::where('user_id', auth()->user()->id)->get();
        }
        return view('records')
        ->with('courses', $courses)
        ->with('users', $users)
        ->with('records', $records);
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
        $record = new Record($request->all());
        $record->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $record = Record::find($id);
        $course = Course::find($record->course_id);
        $user = User::find($course->user_id);
        return view('coursesshow')
        ->with('user', $user)
        ->with('course', $course)
        ->with('record', $record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activities = Activitie::where('record_id', $id)->get();
        $records = Record::where('id', $id)->get();
        if(auth()->user()->type == 'administrador' || auth()->user()->type == 'docente')
        {   
            return view('activities')
            ->with('activities', $activities)
            ->with('records', $records);
        }
        else
        {
            return view('activitiesshow')
            ->with('activities', $activities)
            ->with('records', $records);
        }
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
        $record = Record::find($request->id);
        $record->user_id = $request->user_id;
        $record->course_id = $request->course_id;
        $record->save();
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
        $record = Record::find($request->id);
        $record->delete();
        return back();
    }
}
