var upload = document.querySelector('#my-dropzone');

Dropzone.autoDiscover = false;

Dropzone.options.myDropzone = {

    paramName: "file",
    parallelUploads: 1,
    addRemoveLinks: true,
    dictDefaultMessage: 'Dépose au moins une photo ici !',
    dictRemoveFile: 'Supprimer',

    sending: function(file, xhr, formData)
    {
        formData.append("_token", $('[name=_token').val());
        formData.append("id", upload.dataset.id);
    },

    init: function()
    {
        var myDropzone = this;

        $.get('/photos/' + upload.dataset.id, function(data) {
            $.each(data.photos, function (key, value) {
                var file = {name: value.filename, size: value.size};
                myDropzone.options.addedfile.call(myDropzone, file);
                myDropzone.options.thumbnail.call(myDropzone, file, value.server);
                myDropzone.emit("complete", file);
            });
        });

        this.on("removedfile", function(file) {
            $.ajax({
                type: 'POST',
                url: '/upload/delete',
                data: {id: upload.dataset.id, filename: file.name, _token: $('[name=_token').val()},
                dataType: 'html'
            })
        });
    },

    error: function(file, response)
    {
        if ($.type(response) === "string")
            var message = response; // dropzone sends it's own error messages in string
        else
            var message = response.message;

        file.previewElement.classList.add("dz-error");

        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];

        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }

        return _results;
    }
};

$(document).ready(function() {
    $("#my-dropzone").dropzone({
        url: "/upload"
    });
});
