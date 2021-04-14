<?php

namespace App\Http\Controllers\API\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Specialist\SpecialistCollection;
use App\Http\Resources\Specialist\Specialist as SpecialistResource;
use App\Http\Resources\Patient\PatientCollection;
use App\Http\Resources\Patient\Patient as PatientResource;
use App\Repositories\Eloquent\Patient\PatientRepositoryInterface; 
use App\Repositories\Eloquent\Specialist\SpecialistRepositoryInterface; 
use App\Http\Requests\Profile\ProfileUpdateRequest;

class ProfileController extends Controller
{
    private $userDetails;
    private $patientRepository;
    private $specialistRepository;

    public function __construct(
        PatientRepositoryInterface $patientRepository, 
        SpecialistRepositoryInterface $specialistRepository
        )
    {
        $this->middleware(['auth:api']);
        $this->patientRepository = $patientRepository;
        $this->specialistRepository = $specialistRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBasicProfile(Request $request)
    {
        if ($request->is("api/v1/patients/*")) {
            $this->userDetails = $this->patientRepository->find(auth('api')->user()->id);
            return response()->json(new PatientResource($this->userDetails), 200);
        }elseif($request->is("api/v1/specialists/*")) {
            $this->userDetails = $this->specialistRepository->getProfileDetails();
            return response()->json(new SpecialistResource($this->userDetails), 200);
        }else{
            return "do nothing for now";
        }
    }

    
    public function updatePatientProfile(ProfileUpdateRequest $request)
    {
        $this->patientRepository->updatePatientDetails($request->validated());
        return response()->json(["success"=> ["message"=>"Profile updated successfully"]], 200);
    }

    public function updateSpecialistProfile(ProfileUpdateRequest $request)
    {
        $this->specialistRepository->updateSpecialistDetails($request->validated());
        return response()->json(["success"=> ["message"=>"Profile updated successfully"]], 200);
    }
}
