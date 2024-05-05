<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use App\Http\Requests\UpdateTeachingMethodRequest;
>>>>>>> origin/khader
use App\Models\ProfileTeacher;
use App\Models\TeachingMethod;
use Illuminate\Http\Request;
use App\Http\Requests\TeachingMethodRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class TeachingMethodController extends Controller
{
    use GeneralTrait;

    private $uploadPath = "assets/images/teaching_methods";
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     */
=======


>>>>>>> origin/khader
    public function index($teacher_id)
    {
        try {
            //$profile_teacher=User::find($teacher_id)->profile_teacher()->first();
            $profile_teacher=ProfileTeacher::find($teacher_id);
            if (!$profile_teacher) {
                return $this->returnError("401",'user Not found');
            }
            $teaching_methods=$profile_teacher->teaching_methods()->get();
            return $this->returnData($teaching_methods,'operation completed successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * Show the form for creating a new resource.
     */
=======


>>>>>>> origin/khader
    public function show($id)
    {
        try {
            DB::beginTransaction();

            $teaching_method= TeachingMethod::find($id);
            if (!$teaching_method) {
                return $this->returnError("401",'teaching_method Not found');
            }

            DB::commit();
            return $this->returnData($teaching_method,'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }

<<<<<<< HEAD
    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
=======


>>>>>>> origin/khader
    public function store(TeachingMethodRequest $request)
    {
        try {
            DB::beginTransaction();
            $profile_teacher=auth()->user()->profile_teacher()->first();

            $file=null;
            if (isset($request->file)) {
                $file = $this->saveImage($request->file, $this->uploadPath);
            }

            $teaching_method= $profile_teacher->teaching_methods()->create([
                'title'=>$request->title,
                'type'=>$request->type,
                'description'=>$request->description,
                'file'=>$file,
<<<<<<< HEAD
                'status'=>0
=======
                'status'=>$request->status,
                'price'=>$request->price
>>>>>>> origin/khader
            ]);


            DB::commit();
            return $this->returnData($teaching_method,'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeachingMethod $teachingMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeachingMethodRequest $request,$id)
=======



    public function update(UpdateTeachingMethodRequest $request,$id)
>>>>>>> origin/khader
    {
        try {
            DB::beginTransaction();

            $profile_teacher=auth()->user()->profile_teacher()->first();

            $teaching_method=$profile_teacher->teaching_methods()->find($id);

            $file=null;
            if (isset($request->file)) {
                $file = $this->saveImage($request->file, $this->uploadPath);
            }

            $teaching_method->update([
                'title'=>isset($request->title)? $request->title :$teaching_method->title,
                'type'=>isset($request->type)? $request->type :$teaching_method->type,
                'description'=>isset($request->description)? $request->description :$teaching_method->description,
                'file'=>isset($request->file)? $file :$teaching_method->file,
<<<<<<< HEAD
=======
                'status'=>isset($request->status)? $request->status :$teaching_method->status,
                'price'=>isset($request->price)? $request->price :$teaching_method->price,
>>>>>>> origin/khader
            ]);

            DB::commit();
            return $this->returnData($teaching_method,'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }

<<<<<<< HEAD
    /**
     * Remove the specified resource from storage.
     */
=======

>>>>>>> origin/khader
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $profile_teacher=auth()->user()->profile_teacher()->first();
            $teaching_method=$profile_teacher->teaching_methods()->find($id);

            if (!$teaching_method) {
                return $this->returnError("401",'teaching_method Not found');
            }

            $teaching_method->delete();

            DB::commit();
            return $this->returnSuccessMessage('operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }
}
