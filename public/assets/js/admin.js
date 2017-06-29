'use strict';

$( document ).ready(function() {

    //permet de cacher le placeholder dans les filtres
    $('.search-typeStructure, .search-ville, .searchAd').on('click', function () {
        $('.filtre').hide();
    });

/*----------------------------------------------------------*/
    //plugin autocomplete pour la recherche/autocompletion
    $('.search-ville').autocomplete({
        source: "recherche-ville",
        minLength: 1,
        autoFocus: true,
        select: function(e,ui)
        {
          $('.search-ville').val(ui.item.value);
        }
    });

    $('.searchAd').autocomplete({
        source: "recherche-ad",
        minLength: 1,
        autoFocus: true,
        select: function(e,ui)
        {
          $('.searchAd').val(ui.item.value);
        }
    });
/*----------------------------------------------------------*/
    //Afficher les données du bail d'un local
    $('.bail').on('click', function(){

        var token = $(this).data('tok');
        var id = $(this).data('id');
        var lien = $(this).data('url');

        $('#bail_update').attr('action', 'http://probius.intra.restosducoeur.asso.fr/admin/locauxInf25RI/bail/'+id+'/edit');

          $.ajax({
              url: lien,
              method: 'GET',
              dataType: 'JSON',
              data: {
                  '_token': token,
                  'id': id,
                  '_method': 'GET'
              },
              success: function(data) {

                //$.each(data, function(key, value){});
                $('.add-data-bail').append(
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="type_doc">Type de document</label>'+
                    '<input id="type_doc" type="text" size="200" name="type_document" class="form-control" value="'+data['type_document']+'">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="date_signature">Date de signature</label>'+
                    '<input id="date_signature" type="date" name="date_signature" class="form-control" value='+data['date_signature']+'/>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="date_debut">Date de début</label>'+
                    '<input id="date_debut" type="date" name"date_debut" class="form-control" value='+data['date_debut']+' />'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="date_fin">Date de fin</label>'+
                    '<input id="date_fin" type="date" name="date_fin" class="form-control" value='+data['date_fin']+' />'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="duree_ini">Durée initiale (jours)</label>'+
                    '<input id="duree_ini" type="number" name="duree_ini" class="form-control" value="'+data['duree_ini']+'" />'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 supsup">'+
                  '<div class="form-group">'+
                    '<label for="clause_desc">Quantité de site</label>'+
                    '<input id="clause_desc" type="number" name="quantite_site" class="form-control" value="'+data['quantite_site']+'" />'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3 supsup">'+
                  '<div class="form-group">'+
                    '<label for="tacite">Reconduction tacite ?</label>'+
                    '<select id="tacite" class="form-control" name="tacite_reconduction">'+
                      '<option id="opt1" value="0">Non</option>'+
                      '<option id="opt2" value="1">Oui</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-9 supsup">'+
                  '<div class="form-group">'+
                    '<label for="rec_desc">Description reconduction</label>'+
                    '<textarea id="rec_desc" name="reconduction_description" class="form-control">'+data['reconduction_description']+'</textarea>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-2 supsup">'+
                  '<div class="form-group">'+
                    '<label for="clause">Clause</label>'+
                    '<select id="clause" class="form-control" name="clause">'+
                      '<option id="cl1" value="0">Résolutoire</option>'+
                      '<option id="cl2" value="1">Résiliation</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-10 supsup">'+
                  '<div class="form-group">'+
                    '<label for="clause_desc">Description de la clause</label>'+
                    '<textarea id="clause_desc" name="description_clause" class="form-control">'+data['description_clause']+'</textarea>'+
                  '</div>'+
                '</div>'
                );
                
                //Test pour selectionné la valeur de tacite_reconduction
                data['tacite_reconduction'] == 0 ? $('#opt1').attr('selected', 'selected') : $('#opt2').attr('selected', 'selected');

                //Test pour selectionné la valeur de clause
                data['clause'] == 0 ? $('#cl1').attr('selected', 'selected') : $('#cl2').attr('selected', 'selected');

                $('#close-bail, .close').on('click', function(){
                    $('.supsup').remove();
                });

              },
              error: function(){
                  alert('La requête n\'a pas abouti'); 
              }
          });
      });

/*----------------------------------------------------------*/
    //Suppression local .... 
    $(".delete-data").on('click', function () {
        
        $(this).each(function(){

            var url = $(this).data('url');
            console.log(url);
            $("#delete-form").attr('action', url);
        });
    });

    let tab = [];
    let val = 0;
    //Suppression multiple
    $(".locauxDestAll").on('click', 'input:checkbox', function(){

      val = $(this).attr('value');

      if ($(this).is(':checked')){

        tab.push(val);

      }else{

          var index = tab.indexOf(val);

          if (index !== -1) {
              tab.splice(tab[index], 1);
          }
        console.log(tab);
      }
      console.log(tab);
    });
    
    
/*----------------------------------------------------------*/

  //Fermer la modal après export
  $('#exportExcel').on('click', function () {
      $('#export-locaux').modal('hide');
  })


});