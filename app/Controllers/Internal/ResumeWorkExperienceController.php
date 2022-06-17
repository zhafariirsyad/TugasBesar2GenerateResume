<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ResumePersonalInformation;
use App\Models\ResumeWorkExperience;

class ResumeWorkExperienceController extends BaseController
{
    protected $resumeWorkExperience,$resumePersonalInformation;
    public function __construct()
    {
        $this->resumeWorkExperience = new ResumeWorkExperience();
        $this->resumePersonalInformation = new ResumePersonalInformation();
    }

    public function index()
    {
        $resume_work_experiences = $this->resumeWorkExperience->join('resume_personal_informations','resume_personal_informations.id=resume_work_experiences.user_id')
        ->select([
            'resume_work_experiences.*',
            'resume_personal_informations.name as user_name'
        ])->findAll();
        return view('backend/pages/resume_work_experiences/index', [
            'resume_work_experiences' => $resume_work_experiences
        ]);
    }

    public function create(){
        $users = $this->resumePersonalInformation->findAll();
        return view('backend/pages/resume_work_experiences/create', [
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
            'company_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Company Name cannot be empty'
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
            return redirect()->to('internal/resume_work_experiences/create')->withInput()->with('validation', $validation);
        }

        $this->resumeWorkExperience->save([
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'position' => $this->request->getVar('position'),
            'company_name' => $this->request->getVar('company_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date') ?? null,
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_work_experiences')->with('success', 'Data Added Successfully');
    }

    public function edit($id){
        $users = $this->resumePersonalInformation->findAll();
        $resume_work_experience = $this->resumeWorkExperience->find($id);
        return view('backend/pages/resume_work_experiences/edit', [
            'validation' => \Config\Services::validation(),
            'resume_work_experience' => $resume_work_experience,
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
            'company_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Company Name cannot be empty'
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
            return redirect()->to('internal/resume_work_experiences/edit/'.$id)->withInput()->with('validation', $validation);
        }

        $this->resumeWorkExperience->update($id,[
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'position' => $this->request->getVar('position'),
            'company_name' => $this->request->getVar('company_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_work_experiences')->with('success', 'Data Updated Successfully');
    }

    public function delete($id){
        $resume_work_experiences = $this->resumeWorkExperience->find($id);

        if ($resume_work_experiences) {
            $this->resumeWorkExperience->delete($id);
        }

        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
