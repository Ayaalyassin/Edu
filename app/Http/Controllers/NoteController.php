<?php

namespace App\Http\Controllers;

use App\Models\Note;
<<<<<<< HEAD
use App\Models\ProfileStudent;
=======
>>>>>>> origin/khader
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NoteRequest;
use App\Models\User;

class NoteController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        try {
            DB::beginTransaction();

<<<<<<< HEAD
            $profile_teacher= auth()->user()->profile_teacher()->first();

            $student = ProfileStudent::find($request->student_id);
            if (!$student)
                return $this->returnError(404, 'student not found');

            $note = $profile_teacher->note_as_teacher()->create([
                'note' => $request->note,
                'profile_student_id' => $request->student_id
=======
            $user = auth()->user();

            $student = User::find($request->student_id);
            if (!$student)
                return $this->returnError(404, 'student not found');

            $note = $user->note_as_teacher()->create([
                'note' => $request->note,
                'student_id' => $request->student_id
>>>>>>> origin/khader
            ]);

            DB::commit();
            return $this->returnData($note, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
<<<<<<< HEAD
            $user = auth()->user()->profile_teacher()->first();
=======
            $user = auth()->user();
>>>>>>> origin/khader
            $note = $user->note_as_teacher()->find($id);
            if (!$note)
                return $this->returnError("", 'note not found');
            $note->delete();

            DB::commit();
            return $this->returnSuccessMessage('operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }
}
