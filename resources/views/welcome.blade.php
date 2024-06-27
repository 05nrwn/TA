<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom styling for date range picker */
        #dateRangePicker {
            display: flex;
            justify-content: center;
        }

        .input-daterange .form-control {
            width: 150px;
            text-align: center;
        }

        .input-group-prepend,
        .input-group-append {
            height: auto;
        }

        .input-group-prepend,
        .input-group-append .input-group-text {
            background-color: #e9ecef;
            border-color: #ced4da;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#importModal">
                            <i class="fas fa-download fa-sm text-white-50"></i> Import CSV
                        </a>
                    </div>

                    <div class="mb-3">
                        <div>
                            <h5>Filter : </h5>
                            <label for="graduation-year-select">Select Graduation Year:</label>
                            <select id="graduation-year-select">
                                <option value="All" {{ $selectedGraduationYear == 'All' ? 'selected' : '' }}>All</option>
                                @foreach($graduationYears as $year)
                                <option value="{{ $year }}" {{ $year == $selectedGraduationYear ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>

                            <label for="study-program-select">Select Study Program:</label>
                            <select id="study-program-select">
                                <option value="All" {{ 'All' == $selectedStudyProgram ? 'selected' : '' }}>All</option>
                                @foreach($studyPrograms as $program)
                                <option value="{{ $program }}" {{ $program == $selectedStudyProgram ? 'selected' : '' }}>{{ $program }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Earnings and Tasks Cards -->
                    <!-- Earnings (Monthly) Card -->
                    <div class="card border-left-primary shadow mb-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TIF</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getTIF}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Annual) Card -->
                    <div class="card border-left-success shadow mb-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">MIF</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getMIF }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card -->
                    <div class="card border-left-warning shadow mb-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TKK</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getTKK }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Status Alumni Saat ini</h6>
                                        <button class="btn btn-primary" id="showStatusChart" data-toggle="modal" data-target="#statusChartModal">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="statusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni Telah Mendapat Pekerjaan Sebelum Lulus</h6>
                                        <button class="btn btn-primary" id="showWorkBeforeGraduateChart" data-toggle="modal" data-target="#workBeforeGraduateModal">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="workBeforeGraduateChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni Mencari Pekerjaan Setelah Lulus</h6>
                                        <button class="btn btn-primary" id="showFindWorkAfterGraduateChart" data-toggle="modal" data-target="#findWorkAfterGraduateModal">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="findWorkAfterGraduateChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <div class="justify-content-between d-flex">
                                            <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni Mencari Pekerjaan Setelah Lulus</h6>
                                            <button class="btn btn-primary" id="showFindWorkBeforeGraduateChartModal" data-toggle="modal" data-target="#findWorkBeforeGraduateModal">Detail</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <canvas id="findWorkBeforeGraduateChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <div class="justify-content-between d-flex">
                                            <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni Telah Mendapat Pekerjaan Setelah Lulus (Bulan)</h6>
                                            <button class="btn btn-primary" id="showWorkAfterGraduateMonthChart" data-toggle="modal" data-target="#workAfterGraduateMonthModal">Detail</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <canvas id="workAfterGraduateMonthChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <div class="justify-content-between d-flex">
                                            <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni Telah Mendapat Pekerjaan Sebelum Lulus (Bulan)</h6>
                                            <button class="btn btn-primary" id="showWorkBeforeGraduateMonthChart" data-toggle="modal" data-target="#workBeforeGraduateMonthModal">Detail</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <canvas id="workBeforeGraduateMonthChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Gaji Perbulan Alumni</h6>
                                        <button class="btn btn-primary" id="ShowSalaryChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="salaryChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Tingkat Pendidikan Yang Tepat Pada Tempat Kerja</h6>
                                        <button class="btn btn-primary" id="ShowWorkGradeAppropriateChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="workGradeAppropriateChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Jenis Perusahaan</h6>
                                        <button class="btn btn-primary" id="ShowInstanceTypeChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="instanceTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Jabatan Jika Menjadi Wiraswasta</h6>
                                        <button class="btn btn-primary" id="ShowIfSelfEmployedChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="ifSelfEmployedChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Keterikatan Jurusan Dengan Pekerjaan</h6>
                                        <button class="btn btn-primary" id="ShowWorkCorrelationChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="workCorrelationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Tingkatan Tempat Kerja</h6>
                                        <button class="btn btn-primary" id="ShowWorkGradeChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="workGradeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Column -->

                        <!-- <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="workCorrelationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Sumber Biaya Pendidikan Lanjut</h6>
                                        <button class="btn btn-primary" id="ShowFurtherStudyCostChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="furtherStudyCostChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Banyaknya Alumni Yang Mengambil Pendidikan Lanjut</h6>
                                        <button class="btn btn-primary" id="ShowCountFurtherStudyChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="countFurtherStudyChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Alumni yang mendapat pekerjaan sebelum lulus dan hubungannya dengan program studi</h6>
                                        <button class="btn btn-primary" id="ShowGotJobBeforeGraduateAndCorrelatedChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="gotJobBeforeGraduateAndCorrelatedChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Etika 1</h6>
                                        <button class="btn btn-primary" id="ShowEthicsChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="ethicsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Keahlian berdasarkan bidang ilmu</h6>
                                        <button class="btn btn-primary" id="ShowSkillChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="skillChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Bahasa Inggris</h6>
                                        <button class="btn btn-primary" id="ShowEnglishChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="englishChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Penggunaan Teknologi Informasi</h6>
                                        <button class="btn btn-primary" id="ShowTiUsageChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="tiUsageChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Komunikasi</h6>
                                        <button class="btn btn-primary" id="ShowCommunicationChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="communicationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Kerja Sama Tim</h6>
                                        <button class="btn btn-primary" id="ShowTeamWorkChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="teamWorkChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Pengembangan Diri</h6>
                                        <button class="btn btn-primary" id="ShowSelfImprovementChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="selfImprovementChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id=""></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Etika 2</h6>
                                        <button class="btn btn-primary" id="ShowEthics2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="ethics2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Keahlian berdasarkan bidang ilmu 2</h6>
                                        <button class="btn btn-primary" id="ShowSkill2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="skill2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Bahasa Inggris 2</h6>
                                        <button class="btn btn-primary" id="ShowEnglish2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="english2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Penggunaan Teknologi Informasi 2</h6>
                                        <button class="btn btn-primary" id="ShowTiUsage2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="tiUsage2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Komunikasi 2</h6>
                                        <button class="btn btn-primary" id="ShowCommunication2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="communication2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Kerja Sama Tim 2</h6>
                                        <button class="btn btn-primary" id="ShowTeamWork2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="teamWork2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Pengembangan Diri 2</h6>
                                        <button class="btn btn-primary" id="ShowSelfImprovement2Chart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="selfImprovement2Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Perkuliahan</h6>
                                        <button class="btn btn-primary" id="ShowLecturesChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="lecturesChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Diskusi</h6>
                                        <button class="btn btn-primary" id="ShowDiscussionChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="discussionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Demonstrasi</h6>
                                        <button class="btn btn-primary" id="ShowDemonstrationChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="demonstrationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Partisipasi dalam proyek riset</h6>
                                        <button class="btn btn-primary" id="ShowResearchProjectParticipationChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="researchProjectParticipationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Magang</h6>
                                        <button class="btn btn-primary" id="ShowInternshipChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="internshipChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Praktikum</h6>
                                        <button class="btn btn-primary" id="ShowPracticeChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="practiceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4 w-full">
                                <div class="card-header py-3">
                                    <div class="justify-content-between d-flex">
                                        <h6 class="m-0 font-weight-bold text-primary mt-2">Kerja Lapang</h6>
                                        <button class="btn btn-primary" id="ShowFieldWorkChart">Detail</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <canvas id="fieldWorkChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        @include('modals.modal')
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('templates/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('templates/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('templates/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('templates/js/demo/chart-bar-demo.js') }}"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="csvForm" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="csvFile">Pilih CSV File</label>
                            <div class="form-control">
                                <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!-- Chart -->
    <script>
        // Pass PHP data to JavaScript
        window.statusData = <?php echo json_encode($getStatusNow); ?>;
        window.workBeforeGraduateData = <?php echo json_encode($getWorkBeforeGraduate); ?>;
        window.workBeforeGraduateMonthData = <?php echo json_encode($getWorkBeforeGraduateMonth); ?>;
        window.workAfterGraduateMonthData = <?php echo json_encode($getWorkAfterGraduateMonth); ?>;
        window.furtherStudyCostData = <?php echo json_encode($getFurtherStudyCost); ?>;
        window.JobBeforeGraduateAndCorrelatedData = <?php echo json_encode($getGotJobBeforeGraduateAndCorrelated); ?>;
        window.salaryData = <?php echo json_encode($getSalary); ?>;
        window.ifSelfEmployedData = <?php echo json_encode($getIfSelfEmployeed); ?>;
        window.instanceTypeData = <?php echo json_encode($getInstanceType); ?>;
        window.countFurtherStudyData = <?php echo json_encode($getCountFurtherStudy); ?>;
        window.findWorkAfterGraduateData = <?php echo json_encode($getFindWorkAfterGraduate); ?>;
        window.workGradeData = <?php echo json_encode($getWorkGrade); ?>;
        window.workCorrelationData = <?php echo json_encode($getWorkCorrelation); ?>;
        window.workGradeAppropriateData = <?php echo json_encode($getWorkGradeAppropriate); ?>;
        window.findWorkBeforeGraduateData = <?php echo json_encode($getFindWorkBeforeGraduate); ?>;
        window.workingPlaceProvinceData = <?php echo json_encode($getWorkingPlaceProvince); ?>;
        window.workingPlaceRegencyData = <?php echo json_encode($getWorkingPlaceRegency); ?>;
        window.ethics1Data = <?php echo json_encode($getEthics); ?>;
        window.skill1Data = <?php echo json_encode($getSkill); ?>;
        window.english1Data = <?php echo json_encode($getEnglish); ?>;
        window.tiUsage1Data = <?php echo json_encode($getTIUsage); ?>;
        window.communication1Data = <?php echo json_encode($getCommunication); ?>;
        window.teamWork1Data = <?php echo json_encode($getTeamWork); ?>;
        window.selfImprovement1Data = <?php echo json_encode($getSelfImprovement); ?>;
        window.ethics2Data = <?php echo json_encode($getEthics2); ?>;
        window.skill2Data = <?php echo json_encode($getSkill2); ?>;
        window.english2Data = <?php echo json_encode($getEnglish2); ?>;
        window.tiUsage2Data = <?php echo json_encode($getTIUsage2); ?>;
        window.communication2Data = <?php echo json_encode($getCommunication2); ?>;
        window.teamWork2Data = <?php echo json_encode($getTeamWork2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;

        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;
        window.selfImprovement2Data = <?php echo json_encode($getSelfImprovement2); ?>;

        window.Data = <?php echo json_encode($getLectures); ?>;
        window.Data = <?php echo json_encode($getDemonstration); ?>;
        window.Data = <?php echo json_encode($getResearchProjectParticipation); ?>;
        window.Data = <?php echo json_encode($getInternship); ?>;
        window.Data = <?php echo json_encode($getPractice); ?>;
        window.Data = <?php echo json_encode($getFieldWork); ?>;
        window.Data = <?php echo json_encode($getDiscussion); ?>;


        var selectedGraduationYear = '{{ $selectedGraduationYear }}';
        var selectedProgram = '{{ $selectedStudyProgram }}';
    </script>
    <script src="{{ asset('chart/statusnow.js') }}"></script>
    <script src="{{ asset('chart/workbeforegraduate.js') }}"></script>
    <script src="{{ asset('chart/countfurtherstudy.js') }}"></script>
    <script src="{{ asset('chart/findworkbeforegraduate.js') }}"></script>
    <script src="{{ asset('chart/findworkaftergraduate.js') }}"></script>
    <script src="{{ asset('chart/furtherstudycost.js') }}"></script>
    <script src="{{ asset('chart/getjobbeforegraduateandcorrelated.js') }}"></script>
    <script src="{{ asset('chart/getsalary.js') }}"></script>
    <script src="{{ asset('chart/ifselfemployeed.js') }}"></script>
    <script src="{{ asset('chart/instancetype.js') }}"></script>
    <script src="{{ asset('chart/workaftergraduatemonth.js') }}"></script>
    <script src="{{ asset('chart/workbeforegraduatemonth.js') }}"></script>
    <script src="{{ asset('chart/workcorrelation.js') }}"></script>
    <script src="{{ asset('chart/workgrade.js') }}"></script>
    <script src="{{ asset('chart/workgradeappropriate.js') }}"></script>
    <script src="{{ asset('chart/workingplaceprovince.js') }}"></script>
    <script src="{{ asset('chart/workingplaceregency.js') }}"></script>
    <script src="{{ asset('chart/ethics1.js') }}"></script>
    <script src="{{ asset('chart/skill1.js') }}"></script>
    <script src="{{ asset('chart/english1.js') }}"></script>
    <script src="{{ asset('chart/tiusage1.js') }}"></script>
    <script src="{{ asset('chart/communication1.js') }}"></script>
    <script src="{{ asset('chart/teamwork1.js') }}"></script>
    <script src="{{ asset('chart/selfimprovement1.js') }}"></script>

    <script src="{{ asset('chart/ethics2.js') }}"></script>
    <script src="{{ asset('chart/skill2.js') }}"></script>
    <script src="{{ asset('chart/english2.js') }}"></script>
    <script src="{{ asset('chart/tiusage2.js') }}"></script>
    <script src="{{ asset('chart/communication2.js') }}"></script>
    <script src="{{ asset('chart/teamwork2.js') }}"></script>
    <script src="{{ asset('chart/selfimprovement2.js') }}"></script>

    <script src="{{ asset('chart/lectures.js') }}"></script>
    <script src="{{ asset('chart/discussion.js') }}"></script>
    <script src="{{ asset('chart/demonstration.js') }}"></script>
    <script src="{{ asset('chart/researchprojectparticipation.js') }}"></script>
    <script src="{{ asset('chart/internship.js') }}"></script>
    <script src="{{ asset('chart/practice.js') }}"></script>
    <script src="{{ asset('chart/fieldwork.js') }}"></script>




</body>

</html>