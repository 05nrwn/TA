document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('researchProjectParticipationChart').getContext('2d');
    var researchProjectParticipationChart = null;

    function updateResearchProjectParticipationChart(data) {
        var labels = data.map(function (item) {
            return item.partisipasi_proyek_riset;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (researchProjectParticipationChart) {
            researchProjectParticipationChart.destroy();
        }

        var researchProjectParticipationModelName = "Level Partisipasi Proyek Riset"; // Replace with your actual model name (lowercase)

        researchProjectParticipationChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: researchProjectParticipationModelName, // Use the model name for label
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

    function fetchResearchProjectParticipationData(tahunLulus, studyProgram) {
        fetch(`/filter-researchprojectparticipation?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateResearchProjectParticipationChart(data['research_project_participation']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchResearchProjectParticipationData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchResearchProjectParticipationData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchResearchProjectParticipationData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
