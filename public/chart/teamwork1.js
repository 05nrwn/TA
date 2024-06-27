document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('teamWorkChart').getContext('2d');
    var teamWorkChart = null;

    function updateTeamWorkChart(data) {
        var labels = data.map(function (item) {
            return item.kerja_sama_tim1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (teamWorkChart) {
            teamWorkChart.destroy();
        }

        var teamWorkModelName = "Level Kerja Sama Tim"; // Replace with your actual model name (lowercase)

        teamWorkChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: teamWorkModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust color as desired
                    borderColor: 'rgba(75, 192, 192, 1)',
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

    function fetchTeamWorkData(tahunLulus, studyProgram) {
        fetch(`/filter-teamwork?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateTeamWorkChart(data['team_work']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchTeamWorkData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchTeamWorkData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchTeamWorkData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
