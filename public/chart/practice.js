document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('practiceChart').getContext('2d');
    var practiceChart = null;

    function updatePracticeChart(data) {
        var labels = data.map(function (item) {
            return item.praktikum;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (practiceChart) {
            practiceChart.destroy();
        }

        var practiceModelName = "Level Praktikum"; // Replace with your actual model name (lowercase)

        practiceChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: practiceModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Adjust color as desired
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

    function fetchPracticeData(tahunLulus, studyProgram) {
        fetch(`/filter-practice?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updatePracticeChart(data['practice']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchPracticeData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchPracticeData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchPracticeData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
