document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('ethicsChart').getContext('2d');
    var ethicsChart = null;

    function updateEthicsChart(data) {
        var labels = data.map(function (item) {
            return item.etika1;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (ethicsChart) {
            ethicsChart.destroy();
        }

        ethicsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Level Etika',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
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

    function fetchEthicsData(tahunLulus, studyProgram) {
        fetch(`/filter-ethics?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateEthicsChart(data['ethics']);
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchEthicsData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchEthicsData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchEthicsData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
