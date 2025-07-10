@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar Centro de Salud</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('centrosalud.update',$centrosalud->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="inputName" class="form-label"><strong>Nombre:</strong></label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $centrosalud->name }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    id="inputName" 
                    placeholder="Ingresar nombre del centro de salud">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="adress" class="form-label"><strong>Dirección:</strong></label>
                <input 
                    type="text" 
                    name="adress" 
                    value="{{ $centrosalud->adress }}"
                    class="form-control @error('adress') is-invalid @enderror" 
                    id="adress" 
                    placeholder="Ingresar la dirección del centro de salud">
                @error('adress')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="description" class="form-label"><strong>Descripción:</strong></label>
                <input 
                    type="text" 
                    name="description" 
                    value="{{ $centrosalud->description }}"
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    placeholder="Descripción del centro de salud">
                @error('description')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12">
                <label class="form-label">Buscar en el mapa:</label>
                <!-- Contenedor del buscador y mapa -->
                <input type="text" name="address" id="address" placeholder="Buscar dirección" class="form-control mb-2">

                <div id="map" style="height: 400px; margin-bottom: 15px;"></div>

                <!-- Campos ocultos -->
                <input type="hidden" name="latitude" id="latitude" value="{{ $centrosalud->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $centrosalud->longitude }}">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
  
  </div>
</div>

@stop

@section('css')

@stop

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFYHepFxrAp3eEIPF5Dynw3Qi85Bhf6rI&libraries=places"></script>
    <script>
        document.getElementById("address").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Detiene el envío del formulario
        }
        });
        let map, marker, autocomplete;

        function initMap() {
            const initialLat = parseFloat(document.getElementById('latitude').value) || -12.0464;
            const initialLng = parseFloat(document.getElementById('longitude').value) || -77.0428;
            const defaultLocation = { lat: initialLat, lng: initialLng };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 14,
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map,
                draggable: true,
            });

            // Actualizar coordenadas en inputs al mover marcador
            marker.addListener("dragend", function () {
                const pos = marker.getPosition();
                document.getElementById("latitude").value = pos.lat();
                document.getElementById("longitude").value = pos.lng();
            });

            // Autocomplete del campo address
            const input = document.getElementById("address");
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) return;

                const location = place.geometry.location;
                map.setCenter(location);
                map.setZoom(16);

                marker.setPosition(location);

                document.getElementById("latitude").value = location.lat();
                document.getElementById("longitude").value = location.lng();
            });

            // Set coordenadas iniciales
            document.getElementById("latitude").value = defaultLocation.lat;
            document.getElementById("longitude").value = defaultLocation.lng;
        }

        window.initMap = initMap;
    </script>

    <!-- Inicializa el mapa al cargar -->
    <script>
        window.onload = function () {
            initMap();
        };
    </script>
@stop