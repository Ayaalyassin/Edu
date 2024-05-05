<?php

namespace App\Http\Controllers;

use App\Models\TeachingMethodUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TeachingMethodUserRequest;
use App\Models\TeachingMethod;

class TeachingMethodUserController extends Controller
{
    use GeneralTrait;
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     */
=======


>>>>>>> origin/khader
    public function getMyTeachingMethod()
    {
        try {
            $profile_student=auth()->user()->profile_student()->first();
            $teaching_methods_user=[];
            if($profile_student)
                 $teaching_methods_user=$profile_student->teaching_methods_user()->get();
            return $this->returnData($teaching_methods_user,'operation completed successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

<<<<<<< HEAD
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
=======


>>>>>>> origin/khader
    public function store(TeachingMethodUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $profile_student=auth()->user()->profile_student()->first();

            $teaching_method=TeachingMethod::find($request->teaching_method_id);

            if(!$teaching_method)
                return $this->returnError("401", 'teaching method not found');
            $is_exist=$profile_student->teaching_methods_user()->where('teaching_method_id',$request->teaching_method_id)->get();
            if(count($is_exist)>0)
                return $this->returnError("400", 'teaching method already exist');

            $profile_student->teaching_methods_user()->attach([
                $request->teaching_method_id
            ]);
            $profile_student->loadMissing(['teaching_methods_user']);

            DB::commit();
            return $this->returnData($profile_student,'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * Display the specified resource.
     */
    public function show(TeachingMethodUser $teachingMethodUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeachingMethodUser $teachingMethodUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeachingMethodUser $teachingMethodUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
=======

>>>>>>> origin/khader
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $profile_student=auth()->user()->profile_student()->first();

            $teaching_method_user=$profile_student->teaching_methods_user()->where('teaching_method_users.id',$id)->first();
            if(!$teaching_method_user)
                return $this->returnError("", 'not found');
            $profile_student->teaching_methods_user()->newPivotStatement()->where('id',$id)->delete();

            DB::commit();
            return $this->returnSuccessMessage('operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
