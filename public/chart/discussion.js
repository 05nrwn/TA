document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('discussionChart').getContext('2d');
    var discussionChart = null;

    function updateDiscussionChart(data) {
        var labels = data.map(function (item) {
            return item.diskusi;
        });
        var counts = data.map(function (item) {
            return item.count;
        });

        if (discussionChart) {
            discussionChart.destroy();
        }

        var discussionModelName = "Level Diskusi"; // Replace with your actual model name (lowercase)

        discussionChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'pie')
            data: {
                labels: labels,
                datasets: [{
                    label: discussionModelName, // Use the model name for label
                    data: counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust color as desired
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

    function fetchDiscussionData(tahunLulus, studyProgram) {
        fetch(`/filter-discussion?tahun_lulus=${tahunLulus}&program_studi=${studyProgram}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging: Check the fetched data
                updateDiscussionChart(data['discussion']); // Access data using model name
            });
    }

    document.getElementById('graduation-year-select').addEventListener('change', function () {
        var selectedGraduationYear = this.value;
        var selectedStudyProgram = document.getElementById('study-program-select').value;
        fetchDiscussionData(selectedGraduationYear, selectedStudyProgram);
    });

    document.getElementById('study-program-select').addEventListener('change', function () {
        var selectedStudyProgram = this.value;
        var selectedGraduationYear = document.getElementById('graduation-year-select').value;
        fetchDiscussionData(selectedGraduationYear, selectedStudyProgram);
    });

    // Initialize chart with initial data
    fetchDiscussionData('{{ $selectedGraduationYear }}', '{{ $selectedStudyProgram }}');
});
