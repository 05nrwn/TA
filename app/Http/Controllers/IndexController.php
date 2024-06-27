<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $tahunLulus = $request->input('tahun_lulus', date('Y')); // Default to current year if no tahun lulus is provided
        $studyProgram = $request->input('program_studi', 'All'); // Default to 'All' if no study program is provided

        $getStatusNow = Student::getStatusNow($tahunLulus, $studyProgram);
        $getWorkBeforeGraduate = Student::getWorkBeforeGraduate($tahunLulus, $studyProgram);

        $graduationYears = Student::select('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->get()
            ->pluck('tahun_lulus');

        $studyPrograms = Student::select('program_studi')
            ->distinct()
            ->orderBy('program_studi', 'asc')
            ->get()
            ->pluck('program_studi');


        $getMIF = Student::getMIF();
        $getTIF = Student::getTIF();
        $getTKK = Student::getTKK();
        $getStatusNow = Student::getStatusNow($tahunLulus, $studyProgram);
        $getWorkBeforeGraduate = Student::getWorkBeforeGraduate($tahunLulus, $studyProgram);
        $getWorkBeforeGraduateMonth =  Student::getWorkBeforeGraduateMonth($tahunLulus, $studyProgram);
        $getWorkAfterGraduateMonth = Student::getWorkAfterGraduateMonth($tahunLulus, $studyProgram);
        $getSalary = Student::getSalary($tahunLulus, $studyProgram);
        $getWorkingPlaceProvince = Student::getWorkingPlaceProvince($tahunLulus, $studyProgram);
        $getWorkingPlaceRegency = Student::getWorkingPlaceRegency($tahunLulus, $studyProgram);
        $getIfSelfEmployeed = Student::getIfSelfEmployeed($tahunLulus, $studyProgram);
        $getInstanceType = Student::getInstanceType($tahunLulus, $studyProgram);
        $getWorkGrade = Student::getWorkGrade($tahunLulus, $studyProgram);
        $getWorkCorrelation = Student::getWorkCorrelation($tahunLulus, $studyProgram);
        $getWorkGradeAppropriate = Student::getWorkGradeAppropriate($tahunLulus, $studyProgram);
        $getFurtherStudyCost = Student::getFurtherStudyCost($tahunLulus, $studyProgram);
        $getCountFurtherStudy = Student::getCountFurtherStudy($tahunLulus, $studyProgram);
        $getFindWorkBeforeGraduate = Student::getFindWorkBeforeGraduate($tahunLulus, $studyProgram);
        $getFindWorkAfterGraduate = Student::getFindWorkAfterGraduate($tahunLulus, $studyProgram);
        $getGotJobBeforeGraduateAndCorrelated = Student::getGotJobBeforeGraduateAndCorrelated($tahunLulus, $studyProgram);
        $getEthics = Student::getEthics($tahunLulus, $studyProgram);
        $getEthics2 = Student::getEthics2($tahunLulus, $studyProgram);
        $getSkill = Student::getSkill($tahunLulus, $studyProgram);
        $getSkill2 = Student::getSkill2($tahunLulus, $studyProgram);
        $getEnglish = Student::getEnglish($tahunLulus, $studyProgram);
        $getEnglish2 = Student::getEnglish2($tahunLulus, $studyProgram);
        $getTIUsage = Student::getTIUsage($tahunLulus, $studyProgram);
        $getTIUsage2 = Student::getTIUsage2($tahunLulus, $studyProgram);
        $getCommunication = Student::getCommunication($tahunLulus, $studyProgram);
        $getCommunication2 = Student::getCommunication2($tahunLulus, $studyProgram);
        $getTeamWork = Student::getTeamWork($tahunLulus, $studyProgram);
        $getTeamWork2 = Student::getTeamWork2($tahunLulus, $studyProgram);
        $getSelfImprovement = Student::getSelfImprovement($tahunLulus, $studyProgram);
        $getSelfImprovement2 = Student::getSelfImprovement2($tahunLulus, $studyProgram);
        $getLectures = Student::getLectures($tahunLulus, $studyProgram);
        $getDemonstration = Student::getDemonstration($tahunLulus, $studyProgram);
        $getResearchProjectParticipation = Student::getResearchProjectParticipation($tahunLulus, $studyProgram);
        $getInternship = Student::getInternship($tahunLulus, $studyProgram);
        $getPractice = Student::getPractice($tahunLulus, $studyProgram);
        $getFieldWork = Student::getFieldWork($tahunLulus, $studyProgram);
        $getDiscussion = Student::getDiscussion($tahunLulus, $studyProgram);

        // $getQuey = Student::countQuery();

        // echo json_encode($getQuey);
        // die();
        return view('welcome', [
            'getMIF' => $getMIF,
            'getTIF' => $getTIF,
            'getTKK' => $getTKK,
            'getStatusNow' => $getStatusNow,
            'getWorkBeforeGraduate' => $getWorkBeforeGraduate,
            'getWorkBeforeGraduateMonth' => $getWorkBeforeGraduateMonth,
            'getWorkAfterGraduateMonth' => $getWorkAfterGraduateMonth,
            'getSalary' => $getSalary,
            'getWorkingPlaceProvince' => $getWorkingPlaceProvince,
            'getWorkingPlaceRegency' => $getWorkingPlaceRegency,
            'getIfSelfEmployeed' => $getIfSelfEmployeed,
            'getInstanceType' => $getInstanceType,
            'getWorkGrade' => $getWorkGrade,
            'getWorkCorrelation' => $getWorkCorrelation,
            'getWorkGradeAppropriate' => $getWorkGradeAppropriate,
            'getFurtherStudyCost' => $getFurtherStudyCost,
            'getCountFurtherStudy' => $getCountFurtherStudy,
            'getFindWorkBeforeGraduate' => $getFindWorkBeforeGraduate,
            'getFindWorkAfterGraduate' => $getFindWorkAfterGraduate,
            'getGotJobBeforeGraduateAndCorrelated' => $getGotJobBeforeGraduateAndCorrelated,
            'getEthics' => $getEthics,
            'getEthics2' => $getEthics2,
            'getSkill' => $getSkill,
            'getSkill2' => $getSkill2,
            'getEnglish' => $getEnglish,
            'getEnglish2' => $getEnglish2,
            'getTIUsage' => $getTIUsage,
            'getTIUsage2' => $getTIUsage2,
            'getCommunication' => $getCommunication,
            'getCommunication2' => $getCommunication2,
            'getTeamWork' => $getTeamWork,
            'getTeamWork2' => $getTeamWork2,
            'getSelfImprovement' => $getSelfImprovement,
            'getSelfImprovement2' => $getSelfImprovement2,
            'getLectures' => $getLectures,
            'getDemonstration' => $getDemonstration,
            'getResearchProjectParticipation' => $getResearchProjectParticipation,
            'getInternship' => $getInternship,
            'getPractice' => $getPractice,
            'getFieldWork' => $getFieldWork,
            'getDiscussion' => $getDiscussion,
            'graduationYears' => $graduationYears,
            'studyPrograms' => $studyPrograms,
            'selectedGraduationYear' => $tahunLulus,
            'selectedStudyProgram' => $studyProgram,
        ]);
    }

    public function filterStatusNow(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'status_now' => 'getStatusNow',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }

    public function filterWorkBeforeGraduate(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_before_graduate' => 'getWorkBeforeGraduate',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }

    public function filterWorkBeforeGraduateMonth(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_before_graduate_month' => 'getWorkBeforeGraduateMonth',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkAfterGraduateMonth(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_after_graduate_month' => 'getWorkAfterGraduateMonth',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterSalary(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'salary' => 'getSalary',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkingPlaceProvince(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'working_place_province' => 'getWorkingPlaceProvince',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkingPlaceRegency(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'working_place_regency' => 'getWorkingPlaceRegency',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterIfSelfEmployeed(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'if_self_employed' => 'getIfSelfEmployeed',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterInstaceType(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'instance_type' => 'getInstanceType',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkGrade(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_grade' => 'getWorkGrade',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkCorrelation(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_correlation' => 'getWorkCorrelation',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterWorkGradeAppropriate(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'work_grade_appropriate' => 'getWorkGradeAppropriate',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterFurtherStudyCost(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'further_study_cost' => 'getFurtherStudyCost',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterCountFurtherStudy(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'count_further_study' => 'getCountFurtherStudy',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterFindWorkBeforeGraduate(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'find_work_before_graduate' => 'getFindWorkBeforeGraduate',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterFindWorkAfterGraduate(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'find_work_after_graduate' => 'getFindWorkAfterGraduate',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterGotJobBeforeGraduateAndCorrelated(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'got_job_before_graduate_and_correlated' => 'getGotJobBeforeGraduateAndCorrelated',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterEthics(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'ethics' => 'getEthics',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterEthics2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'ethics2' => 'getEthics2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterSkill(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'skill' => 'getSkill',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterSkill2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'skill2' => 'getSkill2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterEnglish(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'english' => 'getEnglish',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterEnglish2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'english2' => 'getEnglish2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterTIUsage(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'ti_usage' => 'getTIUsage',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterTIUsage2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'ti_usage2' => 'getTIUsage2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterCommunication(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'communication' => 'getCommunication',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterCommunication2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'communication2' => 'getCommunication2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterTeamWork(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'team_work' => 'getTeamWork',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterTeamWork2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'team_work2' => 'getTeamWork2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterSelfImprovement(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'self_improvement' => 'getSelfImprovement',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterSelfImprovement2(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'self_improvement2' => 'getSelfImprovement2',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterLectures(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'lectures' => 'getLectures',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterDemonstration(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'demonstration' => 'getDemonstration',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterResearchProjectPraticipation(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'research_project_participation' => 'getResearchProjectParticipation',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterIntership(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'internship' => 'getInternship',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterPractice(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'practice' => 'getPractice',
            // Add more datasets as needed
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterFieldWork(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'field_work' => 'getFieldWork',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
    public function filterDiscussion(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus');
        $studyProgram = $request->input('program_studi');

        // Fetch all datasets
        $datasets = [
            'discussion' => 'getDiscussion',
        ];

        $filteredData = [];

        // Fetch data for each dataset
        foreach ($datasets as $dataType => $method) {
            $filteredData[$dataType] = Student::$method($tahunLulus, $studyProgram);
        }

        return response()->json($filteredData);
    }
}
