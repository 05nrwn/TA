document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('selfImprovementChart').getContext('2d');
    var selfImprovementChart = null;

    function updateSelfImprovementChart(data) {
        var labels = data.map(function (item) {
            return item.pengembangan_diri1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (selfImprovementChart) {
            selfImprovementChart.destroy();
        }

        var selfImprovementModelName = "Level Pengembangan Diri"; // Replace with your actual model name (lowercase)

        selfImprovementChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: selfImprovementModelName,// Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust color as desired
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

    function fetchSelfImprovementData(tahunLulus, studyProgram) {
        fetch(`/filter-selfimprovement?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateSelfImprovementChart(data['self_improvement']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchSelfImprovementData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchSelfImprovementData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchSelfImprovementData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
