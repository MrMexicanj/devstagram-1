//configuracion de dropzone
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/${imagenPublicada.name}');

            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
            
        }
    }
});

//envio cuando hay error
dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen;
});

//remover un archivo 
dropzone.on('removedfile', function(){
    console.log('El archivo se elimino');
});

