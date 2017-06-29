$(".suppression-badge").on('click', function () {
    var url = this.getAttribute('data-url');
    var CSRF_TOKEN = $('#csrf').attr('value');
    var aJax = $.ajax({
        type: "POST",
        url: url + '/test',
        dataType: 'JSON',
        data: {_token: CSRF_TOKEN}
    })
            .done(function (response) {
                if (response.data) {
                    $("#delete-text").text("êtes vous sure de vouloir supprimer cette question?");
                    $("#delete-btn").attr("disabled", false);
                } else {
                    $("#delete-text").text("Impossible de supprimer cette question, elle est utilisée dans des un questionnaire");
                    $("#delete-btn").attr("disabled", true);
                }
            })
            .fail(function () {
                alert("error");
            });
    $("#delete-form").attr('action', url);
});

$(".edition-badge").on('click', function () {

});

$("#addReponse").on('click', function () {
    var nbRep = parseInt($("#nbReponseText").text(), 10);
    $(".form-group").append('<div class="margin-bottom answer input-group">' +
            '<span class="input-group-addon">' +
            '<input type="radio" name="answer" value="' + nbRep + '">' +
            '</span>' +
            '<input id="answer' + nbRep + '" type="text" class="form-control" placeholder="Réponce '+parseInt(nbRep+1,10)+'"/>' + '\
</div>');
    $("#nbReponseText").html(nbRep + 1);
    $("#nbReponse").val(nbRep + 1);
});


$("#removeReponse").on('click', function () {
    var nbRep = parseInt($("#nbReponseText").text(), 10);
    if (nbRep > 0) {
        $(".answer").last().remove();
        $("#nbReponseText").html(nbRep - 1);
        $("#nbReponse").val(nbRep - 1);
    }
});
//# sourceMappingURL=all.js.map
