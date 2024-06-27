document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('workAfterGraduateMonthChart').getContext('2d');
    var workAfterGraduateMonthChart = null;

    // Function to update the bar chart
    function updateWorkAfterGraduateMonthChart(data) {
        console.log('Data for chart:', data); // Log the data for debugging

        // Check if data is an array
        if (!Array.isArray(data)) {
            console.error('Expected data to be an array', data);
            return;
        }

        var labels = data.map(function (item) {
            return item.bulan_pekerjaan_setelah_lulus;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (workAfterGraduateMonthChart) {
            workAfterGraduateMonthChart.destroy();
        }

        workAfterGraduateMonthChart = new Chart(ctx, {
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
    }

    // Function to fetch data from the server
    function fetchData(dataType, tahunLulus, studyProgram) {
        return fetch(`/filter-workaftergraduatemonth?data_type=${dataType}&tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                // Handle errors as needed
                return [];
            });
    }

    // Function to update charts based on selected options
    function updateCharts(tahunLulus, studyProgram) {
        fetchData('work_after_graduate_month', tahunLulus, studyProgram)
            .then(data => {
                console.log('Fetched data:', data); // Log the fetched data

                // Check the format of the data
                if (!data || typeof data !== 'object') {
                    console.error('Unexpected data format', data);
                    return;
                }

                // Check if the expected property exists and is an array
                if (!Array.isArray(data.work_after_graduate_month)) {
                    console.error('Expected work_after_graduate_month to be an array', data);
                    return;
                }

                // Update the chart with the correct data array
                updateWorkAfterGraduateMonthChart(data.work_after_graduate_month);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Event listeners for graduation year and study program select change
    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        updateCharts(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        updateCharts(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    updateCharts('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');

    // Function to update the modal content
    function updateModal(data) {
        var modalCtx = document.getElementById('detailedWorkAfterGraduateMonthChart').getContext('2d');

        // Clear previous chart if exists
        if (window.detailedWorkAfterGraduateMonthChart instanceof Chart) {
            window.detailedWorkAfterGraduateMonthChart.destroy();
        }

        // Create new chart with the data
        window.detailedWorkAfterGraduateMonthChart = new Chart(modalCtx, {
            type: 'bar',
            data: {
                labels: data.map(function (item) { return item.bulan_pekerjaan_setelah_lulus; }), // Assumes data.labels exists
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
            return `<p>${item.bulan_pekerjaan_setelah_lulus}: ${item.count}</p>`;
        }).join('');
        $('#workAfterGraduateMonthDetails').html(detailsHtml);
    }

    // Show the modal with updated data when button is clicked
    $('#showWorkAfterGraduateMonthChart').on('click', function () {
        var selectedGraduationYear = $('#graduation-year-select').val();
        var selectedStudyProgram = $('#study-program-select').val();

        fetchData('work_after_graduate_month', selectedGraduationYear, selectedStudyProgram)
            .then(data => {
                updateModal(data['work_after_graduate_month']);
                $('#workAfterGraduateMonthModal').modal('show');
            })
            .catch(error => {
                console.error('Error fetching modal data:', error);
            });
    });

});