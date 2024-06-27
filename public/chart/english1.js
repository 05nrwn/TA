document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('englishChart').getContext('2d');
    var englishChart = null;

    function updateEnglishChart(data) {
        var labels = data.map(function (item) {
            return item.bahasa_inggris1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (englishChart) {
            englishChart.destroy();
        }

        var englishModelName = "Level Berbahasa Inggris"; // Replace with your actual model name (lowercase)

        englishChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: englishModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust color as desired
                    borderColor: 'rgba(54, 162, 235, 1)',
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

    function fetchEnglishData(tahunLulus, studyProgram) {
        fetch(`/filter-english?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateEnglishChart(data['english']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchEnglishData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchEnglishData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchEnglishData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
