document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('skillChart').getContext('2d');
    var skillChart = null;

    function updateSkillChart(data) {
        var labels = data.map(function (item) {
            return item.keahlian_bidang_ilmu1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (skillChart) {
            skillChart.destroy();
        }

        var skillModelName = "Level Keahlian Bidang Ilmu"; // Replace with your actual model name (lowercase)

        skillChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: skillModelName, // Use the model name for label
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

    function fetchSkillData(tahunLulus, studyProgram) {
        fetch(`/filter-skill?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateSkillChart(data['skill']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchSkillData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchSkillData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchSkillData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
