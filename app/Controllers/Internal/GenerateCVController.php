<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ResumeEducation;
use App\Models\ResumeOrganizationalExperience;
use App\Models\ResumePersonalInformation;
use App\Models\ResumeWorkExperience;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateCVController extends BaseController
{
    protected $resumePersonalInformation, $resumeOrganizationExperience, $resumeWorkExperience, $resumeEducation;
    public function __construct()
    {
        $this->resumePersonalInformation = new ResumePersonalInformation();
        $this->resumeOrganizationExperience = new ResumeOrganizationalExperience();
        $this->resumeWorkExperience = new ResumeWorkExperience();
        $this->resumeEducation = new ResumeEducation();
    }

    public function index()
    {
        $users = $this->resumePersonalInformation->findAll();
        return view('backend/pages/generate_resume/index', [
            'users' => $users
        ]);
    }

    public function generate($id){
        $user = $this->resumePersonalInformation->find($id);
        $work_experiences = $this->resumeWorkExperience->where('user_id',$user['id'])->findAll();
        $organization_experiences = $this->resumeOrganizationExperience->where('user_id',$user['id'])->findAll();
        $educations = $this->resumeEducation->where('user_id',$user['id'])->findAll();

        $filename = "Resume". " - " . $user['name'] ." - ". date('Y');

        // // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $view = view('backend/pages/generate_resume/cv_view',[
            'user'=>$user,
            'work_experiences' => $work_experiences,
            'organization_experiences' => $organization_experiences,
            'educations' => $educations
        ]);
        // load HTML content
        $dompdf->loadHtml($view);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => 0));

    }

    public function export($id){
        $user = $this->resumePersonalInformation->find($id);
        $work_experiences = $this->resumeWorkExperience->where('user_id',$user['id'])->findAll();
        $organization_experiences = $this->resumeOrganizationExperience->where('user_id',$user['id'])->findAll();
        $educations = $this->resumeEducation->where('user_id',$user['id'])->findAll();
        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Curriculum Vitae '. $user['name']);
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        $sheet->setCellValue('A3', $user['name']);
        $sheet->mergeCells('A3:D3');

        $sheet->setCellValue('F3', $user['profession']);
        $sheet->mergeCells('F3:G3');

        $sheet->setCellValue('I3', $user['address']);
        $sheet->mergeCells('I3:K3');

        $sheet->setCellValue('A4', $user['email'].'|'.$user['phone_number'].'|'.$user['linkedin_url']);
        $sheet->mergeCells('A4:K4');

        $column_work = 10;

        $sheet->setCellValue('A8', 'Work Experiences');
        $sheet->setCellValue('A9', 'Position')
        ->setCellValue('B9', 'Company Name');
        
        foreach ($work_experiences as $work_experience) {
            $sheet->setCellValue('A' . $column_work, $work_experience['position'])
                ->setCellValue('B' . $column_work, $work_experience['company_name']);

            $column_work++;
        }

        $column_organization = 10;

        $sheet->setCellValue('E8', 'Organizational Experiences');
        $sheet->setCellValue('E9', 'Position')
        ->setCellValue('F9', 'Company Name');
        
        foreach ($organization_experiences as $organization_experience) {
            $sheet->setCellValue('E' . $column_organization, $organization_experience['position'])
                ->setCellValue('F' . $column_organization, $organization_experience['organization_name']);

            $column_organization++;
        }

        $column_education = 10;

        $sheet->setCellValue('I8', 'Educations');
        $sheet->setCellValue('I9', 'Position')
        ->setCellValue('J9', 'Company Name');
        
        foreach ($educations as $educations) {
            $sheet->setCellValue('I' . $column_education, $educations['major'])
                ->setCellValue('J' . $column_education, $educations['school_name']);

            $column_education++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-User-'.$user['name'];

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
