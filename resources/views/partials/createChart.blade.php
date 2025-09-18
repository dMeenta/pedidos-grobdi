<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function createChart(canvasId, labels, data, datasetLabel, type, backgroundColor = 'rgba(205, 32, 32, 1)', borderColor = 'rgba(121, 17, 17, 0.51)', extraDatasetProps = {}, extraOptions = {}) {
        const ctx = $(canvasId).get(0).getContext('2d');
        return new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: datasetLabel,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    data: data,
                    ...extraDatasetProps
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                ...extraOptions
            }
        });
    }
</script>