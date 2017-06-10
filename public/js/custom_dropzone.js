var upload = document.querySelector('#my-dropzone');

// Disable the auto init. So we can modify settings first. We will manually initialize it later.
Dropzone.autoDiscover = false;

// imageUpload portion is the camelized version of our HTML elements ID.
Dropzone.options.myDropzone = {
    paramName: "filecustom",
    maxFilesize: 5, // MB
    parallelUploads: 2, //limits number of files processed to reduce stress on server
    addRemoveLinks: true,
    dictDefaultMessage: 'Dépose tes photos ici :)',
    dictRemoveFile: 'Supprimer',
    accept: function(file, done) {
        // TODO: Image upload validation
        done();
    },
    sending: function(file, xhr, formData) {
        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
        formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
        formData.append("id", upload.dataset.id);
    },
    init: function() {

        var myDropzone = this;

        $.get('/server-photos/' + upload.dataset.id, function(data) {
            $.each(data.photos, function (key, value) {
                var file = {name: value.filename, size: value.size};
                myDropzone.options.addedfile.call(myDropzone, file);
                myDropzone.options.thumbnail.call(myDropzone, file, value.server);
                myDropzone.emit("complete", file);
            });
        });
        this.on("success", function(file, response) {

        });
        this.on("removedfile", function(file) {
          $.ajax({
            type: 'POST',
            url: '/upload/delete',
            data: {id: upload.dataset.id, filename: file.name, _token: $('[name=_token').val()},
            dataType: 'html'
          })
        });
    }
};

$(document).ready(function() {
  $("#my-dropzone").dropzone({
    url: "/upload"
  });
});
