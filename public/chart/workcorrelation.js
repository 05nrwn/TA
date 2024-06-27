document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('workCorrelationChart').getContext('2d');
    var workCorrelationChart = null;

    function updateWorkCorrelationChart(data) {
        console.log('Data for chart:', data); // Log the data for debugging

        if (!Array.isArray(data)) {
            console.error('Expected data to be an array', data);
            return;
        }

        var labels = data.map(function (item) {
            return item.hubungan_bidang_studi_pekerjaan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (workCorrelationChart) {
            workCorrelationChart.destroy();
        }

        workCorrelationChart = new Chart(ctx, {
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
        console.log(`Fetching data for: ${dataType}, Year: ${tahunLulus}, Program: ${studyProgram}`);
        fetch(`/filter-workcorrelation?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Log the fetched data

                if (data && data[dataType]) {
                    updateWorkCorrelationChart(data[dataType]);
                } else {
                    console.error('Data format is incorrect or missing data for:', dataType);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function updateCharts(tahunLulus, studyProgram) {
        fetchData('work_correlation', tahunLulus, studyProgram);
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        updateCharts(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        updateCharts(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize charts with initial data
    var initialGraduationYear = '{{ $selectedGraduationYear }}';
    var initialStudyProgram = '{{ $selectedStudyProgram }}';
    console.log('Initial data:', initialGraduationYear, initialStudyProgram);

    if (initialGraduationYear && initialStudyProgram) {
        updateCharts(initialGraduationYear, initialStudyProgram);
    } else if (window.workCorrelationData) {
        updateWorkCorrelationChart(window.workCorrelationData);
    } else {
        console.error('No initial data available for chart rendering.');
    }
});