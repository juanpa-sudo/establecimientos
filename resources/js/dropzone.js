document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#Dropzone")) {
        Dropzone.autoDiscover = false;
        const myDropzone = new Dropzone("div#Dropzone", {
            url: "/imagenes/store",
            maxFiles: 10,

            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
                    .content
            },
            acceptedFiles: ".jpg,.png,.gif,.jpeg",
            dictDefaultMessage: "Suelta las imagenes del establecimiento Aqui",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar imagen",
            success: function(file, respuesta) {
                // file: respuesta del cliente
                // repsuesta: respuesta del servidor
                // console.log("respuesta", respuesta);
                // console.log("file", file);
                file.nombreImagen = respuesta.ruta_imagen;
            },
            sending: function(file, xhr, formData) {
                formData.append("uuid", document.querySelector("#uuid").value);
            },
            removedfile: function(file, respuesta) {
                console.log(file.nombreImagen);
                const params = {
                    imagen: file.nombreImagen
                };
                axios
                    .post("/imagenes/destroy", params)
                    .then(result => {
                        console.log(result);
                    })
                    .catch(err => {
                        console.log("Error grandisimo", err);
                    });
            }
        });
    }
});
