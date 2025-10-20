/* JQuery Required */
function tableRenderRows(tBody, data, renderRow) {
    const emptyTableRow = tBody.find(".empty-table-row");
    if (data.length > 0) {
        emptyTableRow.hide();
        tBody.find("tr:not(.empty-table-row)").remove();
        tBody.append(data.map(renderRow).join(""));
    } else {
        tBody.find("tr:not(.empty-table-row)").remove();
        emptyTableRow.fadeIn();
    }
}

function tableShowError(tBody, colspan, message, textColor = "text-muted") {
    const emptyTableRow = tBody.find(".empty-table-row");
    emptyTableRow.hide();
    tBody.find("tr:not(.empty-table-row)").remove();
    tBody.append(`
        <tr>
            <td colspan="${colspan}" class="text-center py-4 ${textColor}">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                <p><strong>Error:</strong> ${message}</p>
            </td>
        </tr>`);
}

function tableShowloader(
    tBody,
    colspan,
    label,
    spinnerColor = "text-light",
    textColor = "text-muted"
) {
    const emptyTableRow = tBody.find(".empty-table-row");
    emptyTableRow.hide();
    tBody.find("tr:not(.empty-table-row)").remove();
    tBody.append(`
        <tr>
            <td colspan="${colspan}" class="text-center py-6">
                <div class="spinner-border ${spinnerColor}" role="status"></div>
                <p class="${textColor} mt-3 mb-0">Cargando ${label}...</p>
            </td>
        </tr>`);
}
