document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('statusChart').getContext('2d');
    var statusChart = null;
    var storedData = null; // Variable to store fetched data
    var detailedStatusChart = null; // Variable to store detailed chart instance

    function updateChart(data, context, chartInstance, label) {
        var labels = data.map(function (item) {
            return item.status_saat_ini;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (chartInstance) {
            chartInstance.destroy(); // Destroy previous chart if it exists
        }

        // Create new chart instance
        var newChartInstance = new Chart(context, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
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

        return newChartInstance;
    }

    function fetchData(tahunLulus, studyProgram) {
        fetch(`/filter-statusnow?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                statusChart = updateChart(data['status_now'], ctx, statusChart, 'Student Status');
                storedData = data; // Store the fetched data
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchData(selectedGraduationYear, selectedStudyProgram);
    });

    // Show the modal with stored data
    $('#showStatusChart').on('click', function () {
        if (storedData && storedData.status_now) {
            updateModal(storedData.status_now);
            $('#statusChartModal').modal('show');
        } else {
            console.error('No data available to display in the modal.');
        }
    });

    // Function to update the modal content
    function updateModal(data) {
        var ctx = document.getElementById('detailedStatusChart').getContext('2d');

        // Clear previous chart if exists
        if (detailedStatusChart) {
            detailedStatusChart.destroy(); // Destroy previous detailed chart if it exists
        }

        // Create new chart with the data
        detailedStatusChart = new Chart(ctx, {
            type: 'bar', // Example chart type
            data: {
                labels: data.map(function (item) { return item.status_saat_ini; }), // Assumes data.labels exists
                datasets: [{
                    label: 'Status',
                    data: data.map(function (item) { return item.count; }), // Assumes data.values exists
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

        // Update text details (Example)
        var detailsHtml = data.map(function (item) {
            return `<p>${item.status_saat_ini}: ${item.count}</p>`;
        }).join('');
        $('#statusDetails').html(detailsHtml);
    }
});