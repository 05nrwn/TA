document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('lecturesChart').getContext('2d');
    var lecturesChart = null;

    function updateLecturesChart(data) {
        var labels = data.map(function (item) {
            return item.perkuliahan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (lecturesChart) {
            lecturesChart.destroy();
        }

        var lecturesModelName = "Level Perkuliahan"; // Replace with your actual model name (lowercase)

        lecturesChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: lecturesModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(99, 132, 255, 0.2)', // Adjust color as desired
                    borderColor: 'rgba(99, 132, 255, 1)',
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

    function fetchLecturesData(tahunLulus, studyProgram) {
        fetch(`/filter-lectures?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateLecturesChart(data['lectures']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchLecturesData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchLecturesData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchLecturesData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
