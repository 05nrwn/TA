document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('tiUsageChart').getContext('2d');
    var tiUsageChart = null;

    function updateTIUsageChart(data) {
        var labels = data.map(function (item) {
            return item.penggunaan_ti1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (tiUsageChart) {
            tiUsageChart.destroy();
        }

        var tiUsageModelName = "Level Penggunakan TI"; // Replace with your actual model name (lowercase)

        tiUsageChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: tiUsageModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Adjust color as desired
                    borderColor: 'rgba(255, 206, 86, 1)',
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

    function fetchTIUsageData(tahunLulus, studyProgram) {
        fetch(`/filter-tiusage?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateTIUsageChart(data['ti_usage']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchTIUsageData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchTIUsageData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchTIUsageData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
