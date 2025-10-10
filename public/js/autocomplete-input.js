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

    if (!$input.length || !$list.length) {
        console.warn(
            "⚠️ initAutocompleteInput: inputSelector o listSelector no encontraron elementos."
        );
        return;
    }

    const state = {
        selectedIndex: -1,
        $input,
        $list,
        $hidden,
        debounceTimer: null,
    };

    const namespace = `.autocomplete_${Date.now()}_${Math.random()
        .toString(36)
        .slice(2, 11)}`;

    function getNestedValue(obj, path, fallback = "") {
        return path.split(".").reduce((curr, key) => {
            return curr && curr[key] !== undefined ? curr[key] : fallback;
        }, obj);
    }

    const listId = $list.attr("id") || `autocomplete-list-${Date.now()}`;
    $list
        .attr("id", listId)
        .attr("role", "listbox")
        .attr("aria-labelledby", $input.attr("id") || "");
    $input
        .attr("aria-autocomplete", "list")
        .attr("aria-controls", listId)
        .attr("aria-expanded", "false");

    function handleInputKeyUp(e) {
        if (["ArrowUp", "ArrowDown", "Enter"].includes(e.key)) return;

        clearTimeout(state.debounceTimer);

        const query = state.$input.val().trim();
        if (query.length < minChars) {
            hideSuggestions();
            return;
        }

        state.debounceTimer = setTimeout(() => {
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

                    renderSuggestions(data);
                },
                error: (xhr, status, error) => {
                    console.error("Error en autocompletado:", error);
                    state.$list.html(
                        '<div class="list-group-item text-danger">Error al cargar sugerencias</div>'
                    );
                    showSuggestions();
                },
            });
        }, debounceDelay);
    }

    function renderSuggestions(data) {
        let html = "";
        if (data.length > 0) {
            data.forEach((item) => {
                const label = getNestedValue(
                    item,
                    displayField,
                    "(Sin nombre)"
                );
                const value = getNestedValue(item, valueField, "");

                let dataAttrs = `data-value="${String(value).replace(
                    /"/g,
                    "&quot;"
                )}" data-display="${String(label).replace(/"/g, "&quot;")}"`;

                extraDataFields.forEach((field) => {
                    const val = getNestedValue(item, field, "");
                    dataAttrs += ` data-${field}="${String(val).replace(
                        /"/g,
                        "&quot;"
                    )}"`;
                });

                html += renderItem
                    ? renderItem(item)
                    : `<div role="option" class="list-group-item list-group-item-action autocomplete-item"
                        tabindex="-1" ${dataAttrs}>${label}</div>`;
            });
            state.selectedIndex = -1;
        } else {
            html =
                '<div class="list-group-item text-muted">Sin resultados</div>';
        }
        state.$list.html(html);
        showSuggestions();
    }

    function showSuggestions() {
        state.$list.fadeIn().attr("aria-expanded", "true");
    }

    function hideSuggestions() {
        state.$list.fadeOut().attr("aria-expanded", "false");
    }

    function handleItemClick(e) {
        e.preventDefault();
        const $item = $(this);
        const dataset = $item.data();

        state.$input.val(dataset.display);

        if (state.$hidden) state.$hidden.val(dataset.value ?? "");

        if (typeof onSelect === "function") {
            onSelect(dataset);
        }

        hideSuggestions();
    }

    function handleInputKeyDown(e) {
        const $items = state.$list.find(".autocomplete-item");
        if (!state.$list.is(":visible") || $items.length === 0) return;

        if (e.key === "ArrowDown") {
            e.preventDefault();
            state.selectedIndex = (state.selectedIndex + 1) % $items.length;
            highlightItem($items, state.selectedIndex);
        } else if (e.key === "ArrowUp") {
            e.preventDefault();
            state.selectedIndex =
                (state.selectedIndex - 1 + $items.length) % $items.length;
            highlightItem($items, state.selectedIndex);
        } else if (e.key === "Enter" && state.selectedIndex >= 0) {
            e.preventDefault();
            $items.eq(state.selectedIndex).trigger("click");
        } else if (e.key === "Escape") {
            e.preventDefault();
            hideSuggestions();
        }
    }

    function highlightItem($items, index) {
        $items.removeClass("active").attr("aria-selected", "false");
        if (index >= 0 && index < $items.length) {
            const $item = $items.eq(index);
            $item.addClass("active").attr("aria-selected", "true");

            const itemTop = $item.position().top;
            const itemHeight = $item.outerHeight();
            const containerHeight = state.$list.height();
            const scrollTop = state.$list.scrollTop();

            if (itemTop < 0) {
                state.$list.scrollTop(scrollTop + itemTop);
            } else if (itemTop + itemHeight > containerHeight) {
                state.$list.scrollTop(
                    scrollTop + itemTop + itemHeight - containerHeight
                );
            }
        }
    }

    function handleClickOutside(e) {
        if (!$(e.target).closest($input, $list).length) {
            hideSuggestions();
        }
    }

    function handleInputClear() {
        if (state.$hidden) state.$hidden.val("");
    }

    // === 10. Vinculación de eventos con namespace ===
    state.$input
        .off(`${namespace}`)
        .on(`keyup${namespace}`, handleInputKeyUp)
        .on(`keydown${namespace}`, handleInputKeyDown)
        .on(`input${namespace}`, handleInputClear);

    $(document)
        .off(`click${namespace}`)
        .on(
            `click${namespace}`,
            `${listSelector} .autocomplete-item`,
            handleItemClick
        )
        .on(`click${namespace}`, handleClickOutside);
}
