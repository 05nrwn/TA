document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('communication2Chart').getContext('2d');
    var communication2Chart = null;

    function updateCommunication2Chart(data) {
        var labels = data.map(function (item) {
            return item.komunikasi2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (communication2Chart) {
            communication2Chart.destroy();
        }

        var communication2ModelName = " Level Skill Komunikasi"; // Replace with your actual model name (lowercase)

        communication2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: communication2ModelName, // Use the model name for label
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

    function fetchCommunication2Data(tahunLulus, studyProgram) {
        fetch(`/filter-communication2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateCommunication2Chart(data['communication2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchCommunication2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchCommunication2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchCommunication2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
