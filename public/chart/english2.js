document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('english2Chart').getContext('2d');
    var english2Chart = null;

    function updateEnglish2Chart(data) {
        var labels = data.map(function (item) {
            return item.bahasa_inggris2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (english2Chart) {
            english2Chart.destroy();
        }

        var english2ModelName = "Level Berbahasa Inggris"; // Replace with your actual model name (lowercase)

        english2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: english2ModelName, // Use the model name for label
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

    function fetchEnglish2Data(tahunLulus, studyProgram) {
        fetch(`/filter-english2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateEnglish2Chart(data['english2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchEnglish2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchEnglish2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchEnglish2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
