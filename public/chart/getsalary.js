document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salaryChart').getContext('2d');
    var salaryChart = null;

    function updateChart(data) {
        console.log('Data for chart:', data); // Log the data for debugging

        if (!Array.isArray(data)) {
            console.error('Expected data to be an array:', data);
            return;
        }

        var labels = data.map(function (item) {
            return item.pendapatan_per_bulan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (salaryChart) {
            salaryChart.destroy();
        }

        salaryChart = new Chart(ctx, {
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
        fetch(`/filter-salary?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data

                // Check if the data object contains the expected array
                if (dataType === 'salary' && Array.isArray(data.salary)) {
                    updateChart(data.salary);
                } else {
                    console.error(`Unexpected data format for ${dataType}:`, data);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchData('salary', selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchData('salary', selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchData('salary', '{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
