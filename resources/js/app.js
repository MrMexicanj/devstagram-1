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
});

//Eventos de Dropzone
dropzone.on('sending', function(file, xhr, formData){
    console.log(formData);
});

//envio cuando hay error
dropzone.on('success', function(file, response){
    console.log(response);
});
//Envio cuando hay error
dropzone.on('error', function(file, message){
    console.log(message);
});
//remover un archivo 
dropzone.on('removedfile', function(){
    console.log('El archivo se elimino');
});

