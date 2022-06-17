<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ResumePersonalInformation;

class ResumePersonalInformationController extends BaseController
{
    protected $resumePersonalInformation;
    public function __construct()
    {
        $this->resumePersonalInformation = new ResumePersonalInformation();
    }

    public function index()
    {
        $resume_personal_informations = $this->resumePersonalInformation->findAll();
        return view('backend/pages/resume_personal_informations/index', [
            'resume_personal_informations' => $resume_personal_informations
        ]);
    }

    public function create(){
        return view('backend/pages/resume_personal_informations/create', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function store(){
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'linkedin_url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Linkedin Url cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],
            'phone_number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phone Number cannot be empty',
                    'numeric' => 'Phone Number must be numeric',
                ]
            ],
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/resume_personal_informations/create')->withInput()->with('validation', $validation);
        }

        $this->resumePersonalInformation->save([
            'name' => $this->request->getVar('name'),
            'about' => $this->request->getVar('about'),
            'linkedin_url' => $this->request->getVar('linkedin_url'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'profession' => $this->request->getVar('profession'),
        ]);

        return redirect()->to('internal/resume_personal_informations')->with('success', 'Data Added Successfully');
    }

    public function edit($id){
        $resume_personal_information = $this->resumePersonalInformation->find($id);
        return view('backend/pages/resume_personal_informations/edit', [
            'validation' => \Config\Services::validation(),
            'resume_personal_information' => $resume_personal_information
        ]);
    }

    public function update($id){
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'about' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'About cannot be empty'
                ]
            ],
            'linkedin_url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Linkedin Url cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],
            'phone_number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phone Number cannot be empty',
                    'numeric' => 'Phone Number must be numeric',
                ]
            ],
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/resume_personal_informations/edit/'.$id)->withInput()->with('validation', $validation);
        }

        $this->resumePersonalInformation->update($id,[
            'name' => $this->request->getVar('name'),
            'about' => $this->request->getVar('about'),
            'linkedin_url' => $this->request->getVar('linkedin_url'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'profession' => $this->request->getVar('profession'),
        ]);

        return redirect()->to('internal/resume_personal_informations')->with('success', 'Data Updated Successfully');
    }

    public function delete($id){
        $resume_personal_information = $this->resumePersonalInformation->find($id);

        if ($resume_personal_information) {
            $this->resumePersonalInformation->delete($id);
        }

        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
