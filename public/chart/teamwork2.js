document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('teamWork2Chart').getContext('2d');
    var teamWork2Chart = null;

    function updateTeamWork2Chart(data) {
        var labels = data.map(function (item) {
            return item.kerja_sama_tim2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (teamWork2Chart) {
            teamWork2Chart.destroy();
        }

        var teamWork2ModelName = "Level Kerjasama Tim"; // Replace with your actual model name (lowercase)

        teamWork2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: teamWork2ModelName, // Use the model name for label
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

    function fetchTeamWork2Data(tahunLulus, studyProgram) {
        fetch(`/filter-teamwork2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateTeamWork2Chart(data['team_work2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchTeamWork2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchTeamWork2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchTeamWork2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
