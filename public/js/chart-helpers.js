/**
 * Retorna un chart de ChartJs
 *
 * @function createChart
 * @param {string} canvasQuery - Canvas query selector - usually an ID.
 * @param {array} labels - Array of Strings.
 * @param {array} datasets - Array of Objects.
 * @param {string} type - Type of chart - example: 'bar', 'pie'.
 * @param {Object} extraOptions - Object with additional options for the chart.
 */
function createChart(canvasQuery, labels, datasets, type, extraOptions = {}) {
    const canvas = $(canvasQuery);

    if (!canvas) {
        console.error(`No se encontró el canvas con selector ${canvasQuery}`);
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

/**
 * Inserts the filter logic of Leyends for toggleable Charts Datasets
 * without overwrite other plugins.
 *
 * @param {Object} options - Base Chart config.
 * @returns {Object} New Config Object with the filter applied.
 */
function withToggleableLegend(options = {}) {
    const merged = { ...options };

    merged.plugins = {
        ...(merged.plugins || {}),
    };

    merged.plugins.legend = {
        ...(merged.plugins.legend || {}),
        labels: {
            ...(merged.plugins.legend?.labels || {}),
            filter: (legendItem, chartData) => {
                const dataset = chartData.datasets[legendItem.datasetIndex];
                return !dataset.hidden;
            },
        },
    };

    return merged;
}

function createToggleableChart(
    canvasId,
    labels,
    datasets,
    type,
    extraOptions = {}
) {
    const options = withToggleableLegend(extraOptions);
    return createChart(canvasId, labels, datasets, type, options);
}

function updateActiveDataset(chart, selectedIndex) {
    chart.data.datasets.forEach((dataset, index) => {
        dataset.hidden = index !== selectedIndex;
    });
    chart.update();
}

/* Must include the [empty-chart] partial for this functions */
function detectChartDataLength(chart) {
    const $canvas = $(chart.canvas);

    const allDataValues = chart.data.datasets
        .flatMap((ds) => ds.data)
        .filter((v) => v !== null && v !== undefined && v !== 0);

    if (chart.data.datasets.length === 0 || allDataValues.length === 0) {
        $canvas.siblings(".chart-message").fadeIn();
    } else {
        $canvas.siblings(".chart-message").hide();
    }
}
