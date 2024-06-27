document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('demonstrationChart').getContext('2d');
    var demonstrationChart = null;

    function updateDemonstrationChart(data) {
        var labels = data.map(function (item) {
            return item.demonstrasi;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (demonstrationChart) {
            demonstrationChart.destroy();
        }

        var demonstrationModelName = "Level Demonstrasi"; // Replace with your actual model name (lowercase)

        demonstrationChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: demonstrationModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Adjust color as desired
                    borderColor: 'rgba(255, 159, 64, 1)',
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

    function fetchDemonstrationData(tahunLulus, studyProgram) {
        fetch(`/filter-demonstartion?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateDemonstrationChart(data['demonstration']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchDemonstrationData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchDemonstrationData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchDemonstrationData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
