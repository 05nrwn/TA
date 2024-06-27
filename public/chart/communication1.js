document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('communicationChart').getContext('2d');
    var communicationChart = null;

    function updateCommunicationChart(data) {
        var labels = data.map(function (item) {
            return item.komunikasi1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (communicationChart) {
            communicationChart.destroy();
        }

        var communicationModelName = "Level Komunikasi"; // Replace with your actual model name (lowercase)

        communicationChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: communicationModelName, // Use the model name for label
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

    function fetchCommunicationData(tahunLulus, studyProgram) {
        fetch(`/filter-communication?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateCommunicationChart(data['communication']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchCommunicationData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchCommunicationData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchCommunicationData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
