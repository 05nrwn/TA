document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('skill2Chart').getContext('2d');
    var skill2Chart = null;

    function updateSkill2Chart(data) {
        var labels = data.map(function (item) {
            return item.keahlian_bidang_ilmu2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (skill2Chart) {
            skill2Chart.destroy();
        }

        var skill2ModelName = "Level Skill"; // Replace with your actual model name (lowercase)

        skill2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: skill2ModelName, // Use the model name for label
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

    function fetchSkill2Data(tahunLulus, studyProgram) {
        fetch(`/filter-skill2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateSkill2Chart(data['skill2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchSkill2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchSkill2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchSkill2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
