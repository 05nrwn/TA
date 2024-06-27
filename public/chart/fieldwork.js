document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('fieldWorkChart').getContext('2d');
    var fieldWorkChart = null;

    function updateFieldWorkChart(data) {
        var labels = data.map(function (item) {
            return item.kerja_lapangan;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (fieldWorkChart) {
            fieldWorkChart.destroy();
        }

        var fieldWorkModelName = "Level Kerja Lapangan"; // Replace with your actual model name (lowercase)

        fieldWorkChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: fieldWorkModelName, // Use the model name for label
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

    function fetchFieldWorkData(tahunLulus, studyProgram) {
        fetch(`/filter-fieldwork?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateFieldWorkChart(data['field_work']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchFieldWorkData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchFieldWorkData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchFieldWorkData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
