document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('selfImprovement2Chart').getContext('2d');
    var selfImprovement2Chart = null;

    function updateSelfImprovement2Chart(data) {
        var labels = data.map(function (item) {
            return item.pengembangan_diri2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (selfImprovement2Chart) {
            selfImprovement2Chart.destroy();
        }

        var selfImprovement2ModelName = "Level Pengembangan Diri"; // Replace with your actual model name (lowercase)

        selfImprovement2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: selfImprovement2ModelName, // Use the model name for label
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

    function fetchSelfImprovement2Data(tahunLulus, studyProgram) {
        fetch(`/filter-selfimprovement2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateSelfImprovement2Chart(data['self_improvement2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchSelfImprovement2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchSelfImprovement2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchSelfImprovement2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
