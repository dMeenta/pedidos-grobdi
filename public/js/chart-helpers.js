function createChart(canvasId, labels, datasets, type, extraOptions = {}) {
    const canvas = $(canvasId);

    if (!canvas) {
        console.error(`No se encontró el canvas con selector ${canvasId}`);
        return null;
    }

    const ctx = canvas[0].getContext("2d");

    return new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            ...extraOptions,
        },
    });
}

/* Must include the [empty-chart] partial for this functions */
function detectChartDataLength(chart, dataLength) {
    const $canvas = $(chart.canvas);
    if (dataLength < 1) {
        $canvas.siblings(".chart-message").fadeIn();
    } else {
        $canvas.siblings(".chart-message").hide();
    }
}
