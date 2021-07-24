if (document.querySelector("#mapid")) {
    // Add map
    let lat = document.querySelector("#lat").value || 2.9342463477172744;
    let lng = document.querySelector("#lng").value || -75.28085911314771;
    let mymap = L.map("mapid").setView([lat, lng], 17);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {}).addTo(
        mymap
    );

    // Agregando el mark
    let market = new L.marker([lat, lng], {
        draggable: true,
        autoPan: true
    }).addTo(mymap);

    //geocoding server
    let geocodeService = L.esri.Geocoding.geocodeService({
        apikey:
            "AAPK3c837bdde8c746ae94df20c3f51e51e7JfAVPsY5YPfnb_3XZCfmNoXBXTwkP9nvVzb5_yzNGbKhkCMrFjc4GMX6sPqt3IOv"
    });

    // Detectando cuando suelta el amrcador
    market.on("moveend", function(e) {
        market = e.target;
        let posicion = market.getLatLng();

        // Centrar el mapa cuando el usuario suelta mark
        mymap.panTo(L.latLng(posicion.lat, posicion.lng));

        geocodeService
            .reverse()
            .latlng(posicion, 17)
            .run((error, result, response) => {
                if (error) return console.log(error);
                market.bindPopup(result.address.LongLabel).openPopup();

                localizacion(result);
            });
    });

    // Buscador
    // create the geocoding control and add it to the map
    let searchControl = L.esri.Geocoding.geosearch({
        providers: [
            L.esri.Geocoding.arcgisOnlineProvider({
                // API Key to be passed to the ArcGIS Online Geocoding Service
                apikey:
                    "AAPK3c837bdde8c746ae94df20c3f51e51e7JfAVPsY5YPfnb_3XZCfmNoXBXTwkP9nvVzb5_yzNGbKhkCMrFjc4GMX6sPqt3IOv"
            })
        ],
        placeholder: "Busca el lugar",
        useMapBounds: false,
        collapseAfterResult: false,
        zoomToResult: true,
        allowMultipleResults: false
    }).addTo(mymap);

    //  Resultados

    let results = L.layerGroup().addTo(mymap);
    // console.log(res);
    searchControl.on("results", data => {
        // Quitar el marcador anterior
        market.remove();

        let resultados = data.results[0];

        market = L.marker([resultados.latlng.lat, resultados.latlng.lng], {
            draggable: true,
            autoPan: true
        }).addTo(mymap);

        // Muestra la direccion
        market.bindPopup(resultados.text).openPopup();

        market.on("moveend", function(e) {
            market = e.target;
            let posicion = market.getLatLng();

            // Centrar el mapa cuando el usuario suelta mark
            mymap.panTo(L.latLng(posicion.lat, posicion.lng));

            geocodeService
                .reverse()
                .latlng(posicion, 17)
                .run((error, result, response) => {
                    if (error) return console.log(error);
                    market.bindPopup(result.address.LongLabel).openPopup();

                    localizacion(result);
                });
        });

        resultados = {
            latlng: resultados.latlng,
            address: {
                Address: resultados.properties.ShortLabel,
                Neighborhood: resultados.properties.Nbrhd,
                District: resultados.properties.District
            }
        };

        localizacion(resultados);
    });

    // Agregando la informacion en los input de direccion y barrio
    const localizacion = result => {
        document.querySelector("#direccion").value =
            result.address.Address || "";
        document.querySelector("#barrio").value = `${result.address
            .Neighborhood || ""} ${result.address.District || ""}`;

        document.querySelector("#lat").value = result.latlng.lat;
        document.querySelector("#lng").value = result.latlng.lng;
    };
}
