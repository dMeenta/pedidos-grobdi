/**
 * Inicializa un campo de autocompletado con soporte para búsqueda AJAX,
 * navegación por teclado y renderizado personalizado.
 *
 * @function initAutocompleteInput
 * @param {Object} options - Configuración de la función.
 * @param {string} options.apiUrl - URL o endpoint al que se enviará la query AJAX.
 * @param {string | JQuery} options.inputSelector - Selector del input de tipo text que se usará.
 * @param {string | JQuery} options.listSelector - Selector del contenedor donde se mostrarán las sugerencias.
 * @param {string} [options.displayField="name"] - Campo del objeto que se mostrará en el input al seleccionar.
 * @param {string} [options.valueField="id"] - Campo del objeto que se usará como valor unico y principal.
 * @param {string | JQuery | null} [options.hiddenIdSelector=null] - Selector del input hidden donde se guardará el valor seleccionado.
 * @param {string[]} [options.extraDataFields=[]] - Campos adicionales del objeto a incluir como atributos
 * @param {Function | null} [options.renderItem=null] - Función para renderizar cada sugerencia (Debe devolver HTML)
 * Si no se define, se muestra el campo indicado en [displayField]
 * @param {Function | null} [options.onSelect=null] - Callback ejecutado al seleccionar un elemento.
 * Recibe un objeto con todas las propiedades data-* del elemento.
 * @param {number} [options.minChars=2] - Número mínimo de caracteres antes de ejecutar la búsqueda.
 * @param {number} [options.debounceDelay=300] - Tiempo de espera (ms) tras dejar de escribir antes de lanzar la busqueda.
 *
 * @example
 * Ejemplo: autocompletar doctores
 * initAutocompleteInput({
 * apiUrl: '/api/doctors',
 * inputSelector: '#name_doctor',
 * listSelector: '#doctorsList',
 * hiddenIdSelector: '#id_doctor',
 * displayField: 'nombre',
 * valueField: 'id',
 * extraDataFields: ['email', 'especialidad'],
 * renderItem: (item) => `
 * <a href="#" class="list-group-item list-group-item-action autocomplete-item"
 *    data-value="${item.id}"
 *    data-display="${item.nombre}"
 *    data-email="${item.email}"
 *    data-especialidad="${item.especialidad}">
 *    <strong>${item.nombre}</strong><br>
 * </a>`,
 * onSelect: (data) => { console.log('Seleccionado:', data); }
 * });
 */
function initAutocompleteInput({
    apiUrl,
    inputSelector,
    listSelector,
    displayField = "name",
    valueField = "id",
    hiddenIdSelector = null,
    extraDataFields = [],
    renderItem = null,
    onSelect = null,
    minChars = 2,
    debounceDelay = 300,
}) {
    const $input =
        typeof inputSelector === "string" ? $(inputSelector) : inputSelector;
    const $list =
        typeof listSelector === "string" ? $(listSelector) : listSelector;
    const $hidden = hiddenIdSelector
        ? typeof hiddenIdSelector === "string"
            ? $(hiddenIdSelector)
            : hiddenIdSelector
        : null;

    if (!$input || !$list) {
        console.warn(
            "⚠️ initAutocompleteInput: inputSelector y listSelector son obligatorios."
        );
        return;
    }

    let debounceTimer;
    let selectedIndex = -1;

    $input.on("keyup", function (e) {
        if (["ArrowUp", "ArrowDown", "Enter"].includes(e.key)) return;

        clearTimeout(debounceTimer);

        const query = $input.val().trim();
        if (query.length < minChars) {
            $list.fadeOut();
            return;
        }

        debounceTimer = setTimeout(() => {
            $.ajax({
                url: apiUrl,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    q: query,
                },
                success: (data) => {
                    if (!Array.isArray(data)) {
                        console.warn("La respuesta del API debe ser un array");
                        data = [];
                    }

                    let html = "";
                    if (data.length > 0) {
                        data.forEach((item) => {
                            const label = item[displayField] ?? "(Sin nombre)";
                            const value = item[valueField] ?? "";

                            let dataAttrs = `data-value="${value}" data-display="${label}"`;

                            extraDataFields.forEach((field) => {
                                const val = item[field] ?? "";
                                dataAttrs += ` data-${field}="${String(
                                    val
                                ).replace(/"/g, "&quot;")}"`;
                            });

                            html += renderItem
                                ? renderItem(item)
                                : `<a href="#" class="list-group-item list-group-item-action autocomplete-item"
                                ${dataAttrs}>${label}</a>`;
                        });
                        selectedIndex = -1;
                    } else {
                        html =
                            '<div class="list-group-item text-muted">Sin resultados</div>';
                    }
                    $list.html(html).fadeIn();
                },
            });
        }, debounceDelay);
    });

    $(document).on("click", `${listSelector} .autocomplete-item`, function (e) {
        e.preventDefault();
        const dataset = $(this).data();
        $input.val(dataset.display);

        if ($hidden) $hidden.val(dataset.value ?? "");

        if (typeof onSelect === "function") {
            onSelect(dataset);
        }

        $list.fadeOut();
    });

    $input.on("keydown", function (e) {
        const items = $list.find(".autocomplete-item");
        if (!$list.is(":visible") || items.length === 0) return;

        if (e.key === "ArrowDown") {
            e.preventDefault();
            selectedIndex = (selectedIndex + 1) % items.length;
            highlightItem(items, selectedIndex);
        }
        if (e.key === "ArrowUp") {
            e.preventDefault();
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
            highlightItem(items, selectedIndex);
        }
        if (e.key === "Enter" && selectedIndex >= 0) {
            e.preventDefault();
            $(items[selectedIndex]).trigger("click");
        }
    });

    function highlightItem(items, index) {
        items.removeClass("active");
        if (index >= 0 && index < items.length) {
            const item = $(items[index]);
            item.addClass("active");
            const itemTop = item.position().top;
            const itemBottom = itemTop + item.outerHeight();
            const containerHeight = $list.height();

            if (itemTop < 0) {
                $list.scrollTop($list.scrollTop() + itemTop);
            } else if (itemBottom > containerHeight) {
                $list.scrollTop(
                    $list.scrollTop() + (itemBottom - containerHeight)
                );
            }
        }
    }

    $(document).click((e) => {
        if (!$(e.target).closest(inputSelector + ", " + listSelector).length) {
            $list.fadeOut();
        }
    });

    $input.on("input", () => {
        if ($hidden) $hidden.val("");
    });
}
