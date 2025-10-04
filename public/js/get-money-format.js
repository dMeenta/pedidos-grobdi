function getFormattedMoneyValue(
    value,
    minFractDigits = 2,
    maxFractDigits = 2,
    localeString = "es-PE"
) {
    return value.toLocaleString(localeString, {
        minimumFractionDigits: minFractDigits,
        maximumFractionDigits: maxFractDigits,
    });
}
