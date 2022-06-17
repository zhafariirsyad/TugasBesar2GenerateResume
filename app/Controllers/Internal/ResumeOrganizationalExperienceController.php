<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ResumeOrganizationalExperience;
use App\Models\ResumePersonalInformation;

class ResumeOrganizationalExperienceController extends BaseController
{
    protected $resumeOrganizationExperience,$resumePersonalInformation;
    public function __construct()
    {
        $this->resumeOrganizationExperience = new ResumeOrganizationalExperience();
        $this->resumePersonalInformation = new ResumePersonalInformation();
    }

    public function index()
    {
        $resume_organizational_experiences = $this->resumeOrganizationExperience->join('resume_personal_informations','resume_personal_informations.id=resume_organizational_experiences.user_id')
        ->select([
            'resume_organizational_experiences.*',
            'resume_personal_informations.name as user_name'
        ])->findAll();
        return view('backend/pages/resume_organizational_experiences/index', [
            'resume_organizational_experiences' => $resume_organizational_experiences
        ]);
    }

    public function create(){
        $users = $this->resumePersonalInformation->findAll();
        return view('backend/pages/resume_organizational_experiences/create', [
            'validation' => \Config\Services::validation(),
            'users' => $users
        ]);
    }

    public function store(){
        if (!$this->validate([
            'position' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Position cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'organization_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Organization Name cannot be empty'
                ]
            ],
            'start_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start Date cannot be empty'
                ]
            ],
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/resume_organizational_experiences/create')->withInput()->with('validation', $validation);
        }

        $this->resumeOrganizationExperience->save([
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'position' => $this->request->getVar('position'),
            'organization_name' => $this->request->getVar('organization_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date') ?? null,
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_organizational_experiences')->with('success', 'Data Added Successfully');
    }

    public function edit($id){
        $users = $this->resumePersonalInformation->findAll();
        $resume_organizational_experience = $this->resumeOrganizationExperience->find($id);
        return view('backend/pages/resume_organizational_experiences/edit', [
            'validation' => \Config\Services::validation(),
            'resume_organizational_experience' => $resume_organizational_experience,
            'users' => $users
        ]);
    }

    public function update($id){
        if (!$this->validate([
            'position' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Position cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'organization_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Organization Name cannot be empty'
                ]
            ],
            'start_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start Date cannot be empty'
                ]
            ],
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/resume_organizational_experiences/edit/'.$id)->withInput()->with('validation', $validation);
        }

        $this->resumeOrganizationExperience->update($id,[
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'position' => $this->request->getVar('position'),
            'organization_name' => $this->request->getVar('organization_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_organizational_experiences')->with('success', 'Data Updated Successfully');
    }

    public function delete($id){
        $resume_organizational_experiences = $this->resumeOrganizationExperience->find($id);

        if ($resume_organizational_experiences) {
            $this->resumeOrganizationExperience->delete($id);
        }

        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
