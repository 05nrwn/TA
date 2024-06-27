document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('gotJobBeforeGraduateAndCorrelatedChart').getContext('2d');
    var gotJobBeforeGraduateAndCorrelatedChart = null;

    function updateChart(data) {
        var labels = data.map(function (item) {
            return item.hubungan_bidang_studi_pekerjaan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (gotJobBeforeGraduateAndCorrelatedChart) {
            gotJobBeforeGraduateAndCorrelatedChart.destroy();
        }

        gotJobBeforeGraduateAndCorrelatedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Students',
                    data: counts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function fetchData(dataType, tahunLulus, studyProgram) {
        fetch(`/filter-getjobbeforegraduateandcorrelated?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                switch (dataType) {
                    case 'status_now':
                        updateChart(data[dataType]);
                        break;
                    case 'work_before_graduate':
                        updateChart(data[dataType]);
                        break;
                    case 'work_before_graduate_month':
                        updateChart(data[dataType]);
                        break;
                    case 'work_after_graduate_month':
                        updateChart(data[dataType]);
                        break;
                    case 'salary':
                        updateChart(data[dataType]);
                        break;
                    case 'working_place_province':
                        updateChart(data[dataType]);
                        break;
                    case 'working_place_regency':
                        updateChart(data[dataType]);
                        break;
                    case 'if_self_employed':
                        updateChart(data[dataType]);
                        break;
                    case 'instance_type':
                        updateChart(data[dataType]);
                        break;
                    case 'work_grade':
                        updateChart(data[dataType]);
                        break;
                    case 'work_correlation':
                        updateChart(data[dataType]);
                        break;
                    case 'work_grade_appropriate':
                        updateChart(data[dataType]);
                        break;
                    case 'further_study_cost':
                        updateChart(data[dataType]);
                        break;
                    case 'count_further_study':
                        updateChart(data[dataType]);
                        break;
                    case 'find_work_before_graduate':
                        updateChart(data[dataType]);
                        break;
                    case 'find_work_after_graduate':
                        updateChart(data[dataType]);
                        break;
                    case 'got_job_before_graduate_and_correlated':
                        updateChart(data[dataType]);
                        break;
                    // Add more cases for other data types if needed
                    default:
                        console.log(`Unhandled data type: ${dataType}`);
                }
            });
    }

    function fetchData(tahunLulus, studyProgram) {
        fetch(`/filter-getjobbeforegraduateandcorrelated?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateChart(data['got_job_before_graduate_and_correlated']);
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize charts with initial data
    fetchData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
