document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('tiUsage2Chart').getContext('2d');
    var tiUsage2Chart = null;

    function updateTIUsage2Chart(data) {
        var labels = data.map(function (item) {
            return item.penggunaan_ti2;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (tiUsage2Chart) {
            tiUsage2Chart.destroy();
        }

        var tiUsage2ModelName = "Level Penggunaan TI"; // Replace with your actual model name (lowercase)

        tiUsage2Chart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: tiUsage2ModelName, // Use the model name for label
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

    function fetchTIUsage2Data(tahunLulus, studyProgram) {
        fetch(`/filter-tiusage2?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateTIUsage2Chart(data['ti_usage2']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchTIUsage2Data(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchTIUsage2Data(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchTIUsage2Data('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
