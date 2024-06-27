document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('findWorkAfterGraduateChart').getContext('2d');
    var findWorkAfterGraduateChart = null;

    function updateFindWorkAfterGraduateChart(data) {
        if (!data || !Array.isArray(data)) {
            console.error('Invalid data format:', data);
            return;
        }

        var labels = data.map(function (item) {
            return item.mendapat_pekerjaan_setelah_lulus;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (findWorkAfterGraduateChart) {
            findWorkAfterGraduateChart.destroy();
        }

        findWorkAfterGraduateChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Students',
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

    function fetchData(tahunLulus, studyProgram) {
        fetch(`/filter-findworkaftergraduate?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => {
                console.log('Raw response:', response);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new TypeError('Received non-JSON response');
                }

                return response.json();
            })
            .then(data => {
                console.log('Fetched data:', data);
                if (data && data.work_after_graduate_month) {
                    updateFindWorkAfterGraduateChart(data.work_after_graduate_month);
                } else {
                    console.error('Expected data structure not found:', data);
                }
            })
            .catch(error => console.error('Error fetching data:', error));
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

    fetchData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');

    function updateModal(data) {
        var modalCtx = document.getElementById('detailedFindWorkAfterGraduateChart').getContext('2d');

        if (window.detailedFindWorkAfterGraduateChart instanceof Chart) {
            window.detailedFindWorkAfterGraduateChart.destroy();
        }

        window.detailedFindWorkAfterGraduateChart = new Chart(modalCtx, {
            type: 'bar',
            data: {
                labels: data.map(function (item) { return item.mendapat_pekerjaan_setelah_lulus; }),
                datasets: [{
                    label: 'Number of Students',
                    data: data.map(function (item) { return item.count; }),
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

        var detailsHtml = data.map(function (item) {
            return `<p>${item.mendapat_pekerjaan_setelah_lulus}: ${item.count}</p>`;
        }).join('');
        $('#findWorkAfterGraduateDetails').html(detailsHtml);
    }

    $('#showFindWorkAfterGraduateChart').on('click', function () {
        var selectedGraduationYear = $('#graduation-year-select').val();
        var selectedStudyProgram = $('#study-program-select').val();

        fetch(`/filter-findworkaftergraduate?tahun_lulus=${selectedGraduationYear}&program_studi=${selectedStudyProgram}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.work_After_graduate_month) {
                    updateModal(data.work_After_graduate_month);
                    $('#findWorkAfterGraduateModal').modal('show');
                } else {
                    console.error('Expected data structure not found for modal:', data);
                }
            })
            .catch(error => console.error('Error fetching modal data:', error));
    });

});