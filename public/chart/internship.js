document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('internshipChart').getContext('2d');
    var internshipChart = null;

    function updateInternshipChart(data) {
        var labels = data.map(function (item) {
            return item.magang;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (internshipChart) {
            internshipChart.destroy();
        }

        var internshipModelName = "Level Magang"; // Replace with your actual model name (lowercase)

        internshipChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: internshipModelName, // Use the model name for label
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

    function fetchInternshipData(tahunLulus, studyProgram) {
        fetch(`/filter-internship?tahun_ lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateInternshipChart(data['internship']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchInternshipData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchInternshipData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchInternshipData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
