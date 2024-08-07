document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('ifSelfEmployedChart').getContext('2d');
    var ifSelfEmployedChart = null;

    function updateChart(data) {
        var labels = data.map(function (item) {
            return item.posisi_wiraswasta;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (ifSelfEmployedChart) {
            ifSelfEmployedChart.destroy();
        }

        ifSelfEmployedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Students',
                    data: counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
        fetch(`/filter-selfemployeed?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                switch (dataType) {
                    case 'status_now':
                        updateStatusNowChart(data[dataType]);
                        break;
                    case 'work_before_graduate':
                        updateWorkBeforeGraduateChart(data[dataType]);
                        break;
                    case 'work_before_graduate_month':
                        updateWorkBeforeGraduateMonthChart(data[dataType]);
                        break;
                    case 'work_after_graduate_month':
                        updateWorkAfterGraduateMonthChart(data[dataType]);
                        break;
                    case 'salary':
                        updateSalaryChart(data[dataType]);
                        break;
                    case 'working_place_province':
                        updateWorkingPlaceProvinceChart(data[dataType]);
                        break;
                    case 'working_place_regency':
                        updateWorkingPlaceRegencyChart(data[dataType]);
                        break;
                    case 'if_self_employed':
                        updateIfSelfEmployedChart(data[dataType]);
                        break;
                    case 'instance_type':
                        updateInstanceTypeChart(data[dataType]);
                        break;
                    case 'work_grade':
                        updateWorkGradeChart(data[dataType]);
                        break;
                    case 'work_correlation':
                        updateWorkCorrelationChart(data[dataType]);
                        break;
                    case 'work_grade_appropriate':
                        updateWorkGradeAppropriateChart(data[dataType]);
                        break;
                    case 'further_study_cost':
                        updateFurtherStudyCostChart(data[dataType]);
                        break;
                    case 'count_further_study':
                        updateCountFurtherStudyChart(data[dataType]);
                        break;
                    case 'find_work_before_graduate':
                        updateFindWorkBeforeGraduateChart(data[dataType]);
                        break;
                    case 'find_work_after_graduate':
                        updateFindWorkAfterGraduateChart(data[dataType]);
                        break;
                    case 'got_job_before_graduate_and_correlated':
                        updateGotJobBeforeGraduateAndCorrelatedChart(data[dataType]);
                        break;
                    // Add more cases for other data types
                    default:
                        console.log(`Unhandled data type: ${dataType}`);
                }
            });
    }


    function fetchData(tahunLulus, studyProgram) {
        fetch(`/filter-selfemployeed?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateChart(data['if_self_employed']);
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
