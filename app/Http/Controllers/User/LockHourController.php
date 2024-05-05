<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LockHourRequest;
use App\Models\CalendarHour;
use App\Models\LockHour;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LockHourController extends Controller
{
    use GeneralTrait;


    public function test()
    {
        return"test git hub";
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $teacher = $user->profile_teacher;
            if (!$teacher) {
                return $this->returnError(500, 'Token is Invalid');
            }
            $lockHour = $teacher->with('day')
                ->with('day.hours')
                ->with('day.hours.hour_lock')
                ->with('day.hours.hour_lock.student')
                ->with('day.hours.hour_lock.student.user')
                ->get();
            return $this->returnData($lockHour, 'operation completed successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function store(LockHourRequest $request)
    {
        try {
            $user = Auth::user();
            $student = $user->profile_student;
            $wallet = $user->wallet;

            if (!$student) {
                return $this->returnError(500, 'Token is Invalid');
            }

            if ($student->hour_lock->first()) {
                return $this->returnError(500, 'already request hour lock');
            }

            $hours = CalendarHour::find($request->hour_id)->day->teacher->service_teachers;

            if (!CalendarHour::find($request->hour_id)) {
                return $this->returnError(404, 'The Hour Not Found');
            }

            foreach ($hours as $hour) {
                if ($hour->id == $request->service_id) {
                    if ($wallet->value < $hour->price) {
                        return $this->returnError(501, 'not Enough money in wallet');
                    }
                    if ($hour->type == 'private lesson') {
                        $wallet->update([
                            'value' => $wallet->value  - (10 / 100) * $hour->price,
                        ]);
                    } elseif ($hour->type == 'video call') {
                        $wallet->update([
                            'value' => $wallet->value  - $hour->price,
                        ]);
                    }
                    $student->hour_lock()->create([
                        'hour_id' => $request->hour_id,
                        'service_id' => $request->service_id,
                        'status' => 0
                    ]);
                    return $this->returnData(200, 'operation completed successfully');
                }
            }

            return $this->returnError(404, 'The service Not Found');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {

        try {
            $lockHour = LockHour::find($id);
            $teacher = auth()->user()->profile_teacher;
            if (!$lockHour) {
                return $this->returnError(400, 'not found request');
            }
            if ($lockHour->status == 1) {
                return $this->returnError(400, "can't delete because the request is accept");
            }
            if (!$teacher) {
                return $this->returnError(500, 'Token is Invalid');
            }
            $user = $lockHour->student->user->wallet;
            $wallet = $user->update([
                'value' => $user->value + (10 / 100) * $lockHour->service->price,
            ]);
            $lockHour->delete();
            return $this->returnData($wallet, 'operation completed successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function get_my_request()
    {

        try {
            $user = Auth::user()->profile_student;
            if (!$user) {
                return $this->returnError(500, 'Token is Invalid');
            }
            $lock_hour = $user->with(['hour_lock' => function ($e) {
            }])
                ->with(['hour_lock.service' => function ($ex) {
                    $ex->select('id', 'type');
                }])
                ->with(['hour_lock.hour' => function ($h) {
                    $h->select('id', 'hour', 'day_id');
                }])
                ->with(['hour_lock.hour.day' => function ($h) {
                    $h->select('id', 'day');
                }])
                ->get();

            return $this->returnData($lock_hour, 'operation completed successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
