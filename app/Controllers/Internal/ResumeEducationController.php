<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ResumeEducation;
use App\Models\ResumePersonalInformation;

class ResumeEducationController extends BaseController
{
    protected $resumeEducation,$resumePersonalInformation;
    public function __construct()
    {
        $this->resumeEducation = new ResumeEducation();
        $this->resumePersonalInformation = new ResumePersonalInformation();
    }

    public function index()
    {
        $resume_educations = $this->resumeEducation->join('resume_personal_informations','resume_personal_informations.id=resume_educations.user_id')
        ->select([
            'resume_educations.*',
            'resume_personal_informations.name as user_name'
        ])->findAll();
        return view('backend/pages/resume_educations/index', [
            'resume_educations' => $resume_educations
        ]);
    }

    public function create(){
        $users = $this->resumePersonalInformation->findAll();
        return view('backend/pages/resume_educations/create', [
            'validation' => \Config\Services::validation(),
            'users' => $users
        ]);
    }

    public function store(){
        if (!$this->validate([
            'major' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Major cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'school_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'School Name cannot be empty'
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
            return redirect()->to('internal/resume_educations/create')->withInput()->with('validation', $validation);
        }

        $this->resumeEducation->save([
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'major' => $this->request->getVar('major'),
            'school_name' => $this->request->getVar('school_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date') ?? null,
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_educations')->with('success', 'Data Added Successfully');
    }

    public function edit($id){
        $users = $this->resumePersonalInformation->findAll();
        $resume_education = $this->resumeEducation->find($id);
        return view('backend/pages/resume_educations/edit', [
            'validation' => \Config\Services::validation(),
            'resume_education' => $resume_education,
            'users' => $users
        ]);
    }

    public function update($id){
        if (!$this->validate([
            'major' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Major cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'school_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'School Name cannot be empty'
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
            return redirect()->to('internal/resume_educations/edit/'.$id)->withInput()->with('validation', $validation);
        }

        $this->resumeEducation->update($id,[
            'user_id' => $this->request->getVar('user_id'),
            'about' => $this->request->getVar('about'),
            'major' => $this->request->getVar('major'),
            'school_name' => $this->request->getVar('school_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date') ?? null,
            'untill_now' => $this->request->getVar('untill_now') ?? 'no',
        ]);

        return redirect()->to('internal/resume_educations')->with('success', 'Data Updated Successfully');
    }

    public function delete($id){
        $resume_education = $this->resumeEducation->find($id);

        if ($resume_education) {
            $this->resumeEducation->delete($id);
        }

        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
