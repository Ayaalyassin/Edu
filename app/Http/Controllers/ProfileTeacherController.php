<?php

namespace App\Http\Controllers;

use App\Models\ProfileTeacher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileTeacherRequest;
use App\Models\User;

class ProfileTeacherController extends Controller
{
    use GeneralTrait;

    private $uploadPath = "assets/images/profile_teachers";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            DB::beginTransaction();

            $profile_teacher = ProfileTeacher::all();
            $profile_teacher->loadMissing(['user']);

            DB::commit();
            return $this->returnData($profile_teacher, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
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
    public function store(ProfileTeacherRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $certificate = null;
            if (isset($request->certificate)) {
                $certificate = $this->saveImage($request->certificate, $this->uploadPath);
            }
            $profile_teacher = $user->profile_teacher()->create([
                'certificate' => $certificate,
                'description' => isset($request->description) ? $request->description : null,
                'jurisdiction' => isset($request->jurisdiction) ? $request->jurisdiction : null,
                'domain' => isset($request->domain) ? $request->domain : null,
                'status' => 0,
                'assessing' => 0
            ]);
            DB::commit();
            return $this->returnData($profile_teacher, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show()
    {
        try {
            DB::beginTransaction();

            $profile_teacher = auth()->user()->profile_teacher()->first();
            $profile_teacher->loadMissing(['user']);

            DB::commit();
            return $this->returnData($profile_teacher, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }

    public function getById($id)
    {
        try {
            DB::beginTransaction();

            $profile_teacher = ProfileTeacher::find($id);
            if (!$profile_teacher)
                return $this->returnError("401", 'Not found');
            $profile_teacher->loadMissing(['user']);

            DB::commit();
            return $this->returnData($profile_teacher, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileTeacher $profileTeacher)
    {
        //
    }


    public function update(ProfileTeacherRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $certificate = null;
            if (isset($request->certificate)) {
                $certificate = $this->saveImage($request->certificate, $this->uploadPath);
            }

            $profile_teacher = $user->profile_teacher()->first();

            $profile_teacher->update([
                'certificate' => isset($request->certificate) ? $certificate : $profile_teacher->certificate,
                'about' => isset($request->about) ? $request->about : $profile_teacher->about,
                'competent' => isset($request->competent) ? $request->competent : $profile_teacher->competent,
            ]);

            DB::commit();
            return $this->returnData($profile_teacher, 'operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }


    public function destroy()
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $profile_teacher = $user->profile_teacher()->first();
            if (!$profile_teacher)
                return $this->returnError("", 'not found');
            $profile_teacher->delete();
            DB::commit();
            return $this->returnSuccessMessage('operation completed successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), 'Please try again later');
        }
    }
}
