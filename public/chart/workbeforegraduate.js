document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('workBeforeGraduateChart').getContext('2d');
    var workBeforeGraduateChart = null;

    // Function to update the bar chart
    function updateChart(data, context, chartInstance) {
        var labels = data.map(function (item) {
            return item.mendapat_pekerjaan_sebelum_lulus;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        // Destroy the previous chart instance if exists
        if (chartInstance) {
            chartInstance.destroy();
        }

        // Create a new Chart.js instance
        chartInstance = new Chart(context, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Students',
                    data: counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

        return chartInstance;
    }

    // Function to fetch data from the server
    function fetchData(tahunLulus, studyProgram) {
        return fetch(`/filter-workbeforegraduate?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                // Handle errors as needed
                return [];
            });
    }

    // Initialize chart with initial data
    var initialGraduationYear = '{{ $selectedGraduationYear }}'; // Replace with your initial data from backend
    var initialStudyProgram = '{{ $selectedStudyProgram }}'; // Replace with your initial data from backend

    fetchData(initialGraduationYear, initialStudyProgram)
        .then(data => {
            console.log('Initial data:', data); // Debugging: Check the initial fetched data
            workBeforeGraduateChart = updateChart(data['work_before_graduate'], ctx, workBeforeGraduateChart);
        })
        .catch(error => {
            console.error('Error fetching initial data:', error);
            // Handle errors as needed
        });

    // Event listener for graduation year and study program select change
    $('#graduation-year-select').change(function () {
        var selectedGraduationYear = $(this).val();
        var selectedStudyProgram = $('#study-program-select').val();

        fetchData(selectedGraduationYear, selectedStudyProgram)
            .then(data => {
                console.log('Updated data:', data); // Debugging: Check the updated fetched data
                workBeforeGraduateChart = updateChart(data['work_before_graduate'], ctx, workBeforeGraduateChart);
            })
            .catch(error => {
                console.error('Error fetching updated data:', error);
                // Handle errors as needed
            });
    });

    $('#study-program-select').change(function () {
        var selectedStudyProgram = $(this).val();
        var selectedGraduationYear = $('#graduation-year-select').val();

        fetchData(selectedGraduationYear, selectedStudyProgram)
            .then(data => {
                console.log('Updated data:', data); // Debugging: Check the updated fetched data
                workBeforeGraduateChart = updateChart(data['work_before_graduate'], ctx, workBeforeGraduateChart);
            })
            .catch(error => {
                console.error('Error fetching updated data:', error);
                // Handle errors as needed
            });
    });

    // Function to update the modal content
    function updateModal(data) {
        var modalCtx = document.getElementById('detailedWorkBeforeGraduateChart').getContext('2d');

        // Clear previous chart if exists
        if (window.detailedWorkBeforeGraduateChart instanceof Chart) {
            window.detailedWorkBeforeGraduateChart.destroy();
        }

        // Create new chart with the data
        window.detailedWorkBeforeGraduateChart = new Chart(modalCtx, {
            type: 'bar',
            data: {
                labels: data.map(function (item) { return item.mendapat_pekerjaan_sebelum_lulus; }), // Assumes data.labels exists
                datasets: [{
                    label: 'Number of Students',
                    data: data.map(function (item) { return item.count; }), // Assumes data.values exists
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

        // Update text details (Example)
        var detailsHtml = data.map(function (item) {
            return `<p>${item.mendapat_pekerjaan_sebelum_lulus}: ${item.count}</p>`;
        }).join('');
        $('#workBeforeGraduateDetails').html(detailsHtml);
    }

    // Show the modal with updated data when button is clicked
    $('#showWorkBeforeGraduateChart').on('click', function () {
        var selectedGraduationYear = $('#graduation-year-select').val();
        var selectedStudyProgram = $('#study-program-select').val();

        fetchData(selectedGraduationYear, selectedStudyProgram)
            .then(data => {
                updateModal(data['work_before_graduate']);
                $('#workBeforeGraduateModal').modal('show');
            })
            .catch(error => {
                console.error('Error fetching modal data:', error);
                // Handle errors as needed
            });
    });

});
