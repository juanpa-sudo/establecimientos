@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar Establecimiento</h1>
        <div class="mt-5 row justify-content-center">
            <form action="{{ route('establecimiento.store') }}" method="post" class="card card-body col-md-9 col-xs-12"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre y Categoria e Imagen</legend>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del
                            Establecimiento</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre del establecimiento" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <label for="categoria">Categoría</label>

                        <select name="categoria_id" id="categoria"
                            class="form-control @error('categoria_id') is-invalid @enderror">

                            <option selected disabled>--Seleccione--</option>

                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $categoria->id == old('categoria_id') ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>

                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="imagen_principal">Imagen Principal</label>

                        <input type="file" class="form-control @error('imagen_principal') is-invalid @enderror"
                            id="imagen_principal" name="imagen_principal">
                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary ">Ubicacion</legend>
                    <div class="mb-3">
                        <h3 class="text-center"> Busca tu direccion en el mapa</h3>
                        <p class="mt-5 mb-3 text-secondary text-center">El asistente colocara una direccion estimada, mueve
                            el pin hacia el lugar correcto </p>
                    </div>
                    <div class="mb-3">
                        <div id="mapid" style="height: 400px"></div>
                    </div>
                    <div class="mb-3">
                        <p>Confirma si el siguiente dato es correcto</p>
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" name="direccion" id="direccion"
                            class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion"
                            value="{{ old('direccion') }}">
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                        <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">
                    </div>
                    <div class="mb-3">
                        <label for="barrio" class="form-label">Barrio</label>
                        <input type="text" name="barrio" id="barrio"
                            class="form-control @error('barrio') is-invalid @enderror"
                            placeholder="Barrio donde se aloja el negocio" value="{{ old('barrio') }}">
                        @error('barrio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Información del establecimiento</legend>
                    <div class="mb-3">
                        <label for="telefono" class="form-label @error('telefono') is-invalid @enderror">Telefono</label>
                        <input type="tel" name="telefono" id="telefono"
                            class="form-control  @error('telefono') is-invalid @enderror"
                            placeholder="Ingresa el telefono del establecimiento" value="{{ old('telefono') }}">
                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descripcion"
                            class="form-label @error('descripcion') is-invalid @enderror">Descripcion</label>
                        <textarea class="form-control" id="descripcion"
                            name="descripcion">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apertura" class="form-labe @error('apertura') is-invalid @enderror">Hora de
                            apertura</label>
                        <input type="time" class="form-control" name="apertura" id="apertura"
                            value="{{ old('apertura') }}">
                        @error('apertura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cierre" class="form-labe @error('cierre') is-invalid @enderror">Hora de cierre</label>
                        <input type="time" class="form-control" name="cierre" id="cierre" value="{{ old('cierre') }}">
                        @error('cierre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Imagenes del establecimientos</legend>
                    <div class="mb-3">
                        <label for="dropzone" class="form-label">Imagenes</label>
                        <div class="dropzone" id="Dropzone"></div>


                    </div>
                </fieldset>
                <input type="hidden" name="uuid" id="uuid" value="{{ Str::uuid() }}">
                <input type="submit" class="btn btn-primary mt-3" value="Registrar Establecimientos">
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet"></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>


@endsection
