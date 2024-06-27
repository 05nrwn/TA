document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('ethics2Chart').getContext('2d');
    var ethics2Chart = null;

    function updateEthics2Chart(data) {
        var labels = data.map(function (item) {
            return item.etika2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (ethics2Chart) {
            ethics2Chart.destroy();
        }

        var ethics2ModelName = "Level Etika"; // Replace with your actual model name (lowercase)

        ethics2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: ethics2ModelName, // Use the model name for label
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

    function fetchEthics2Data(tahunLulus, studyProgram) {
        fetch(`/filter-ethics2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateEthics2Chart(data['ethics2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchEthics2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchEthics2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchEthics2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
