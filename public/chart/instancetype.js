document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('instanceTypeChart').getContext('2d');
    var instanceTypeChart = null;

    function updateChart(data) {
        console.log('Data for chart:', data); // Log the data for debugging

        // Check if data is an array
        if (!Array.isArray(data)) {
            console.error('Expected data to be an array', data);
            return;
        }

        var labels = data.map(function (item) {
            return item.jenis_perusahaan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (instanceTypeChart) {
            instanceTypeChart.destroy();
        }

        instanceTypeChart = new Chart(ctx, {
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
        fetch(`/filter-instancetype?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Log the fetched data
                if (data && data[dataType]) {
                    updateChart(data[dataType]); // Call updateChart function with the correct data
                } else {
                    console.error('Data format is incorrect or missing', data);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function initializeCharts(tahunLulus, studyProgram) {
        fetchData('instance_type', tahunLulus, studyProgram);
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        initializeCharts(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        initializeCharts(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize charts with initial data
    var initialGraduationYear = '{{ $selectedGraduationYear }}';
    var initialStudyProgram = '{{ $selectedStudyProgram }}';
    console.log('Initial data:', initialGraduationYear, initialStudyProgram);
    initializeCharts(initialGraduationYear, initialStudyProgram);
});
