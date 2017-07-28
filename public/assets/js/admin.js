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

    $('.search-immat').autocomplete({
        source: "recherche-immat",
        minLength: 1,
        autoFocus: true,
        select: function(e,ui)
        {
          $('.search-immat').val(ui.item.value);
        }
    });
/*----------------------------------------------------------*/
    //Afficher les données du bail d'un local
    $('.bail').on('click', function(){

        var token = $(this).data('tok');
        var id = $(this).data('id');
        var lien = $(this).data('url');

        $('#bail_update').attr('action', 'http://probius.intra.restosducoeur.asso.fr/admin/locaux/bail/'+id+'/edit');

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
                    '<label for="type_document">Type de document</label>'+
                    '<select id="type_document" class="form-control" name="type_document">'+
                      '<option id="type-opt1" value="Bail Civil">Bail Civil</option>'+
                      '<option id="type-opt2" value="Bail Commercial">Bail Commercial</option>'+
                      '<option id="type-opt3" value="Bail amphytheotique">Bail amphytheotique</option>'+
                      '<option id="type-opt4" value="Conventions">Conventions</option>'+
                      '<option id="type-opt5" value="Autres">Autres</option>'+
                    '</select>'+
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
                      '<option id="cl1" value="0">Résiliation</option>'+
                      '<option id="cl2" value="1">Résolutoire</option>'+
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
                data['clause'] == 'résiliation' ? $('#cl1').attr('selected', 'selected') : $('#cl2').attr('selected', 'selected');

                //Test pour selectionné la valeur de type_document
                $('#type_document option').each(function(){

                    if ($(this).attr('value') == data['type_document']) {

                      $(this).attr('selected', 'selected');
                    }
                });

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
    //Suppression local, CF, véhicules .... 
    $(".delete-data").on('click', function () {
        
        $(this).each(function(){

            var url = $(this).data('url');
            $("#delete-form").attr('action', url);

            //Alertes pour les sinistres lors de la suppression
            var sinistres = $(this).data('sinistres');

            if (sinistres  >  0) {
                $('.countSinistres').text(sinistres);
            }else{
              $('.alertSinistres').remove();
            }
        }); 
    });

    /*let tab = [];
    let val = 0;*/
    
    //Suppression multiple (A finir)
    /*$(".locauxDestAll").on('click', 'input:checkbox', function(){

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
    });*/
    
    //Edition Chambre froide
    $(".edit-cf").on('click', function () {

      $(this).each(function(){

            var url = $(this).data('url');
            var volume = $(this).data('volume');

            $('.volume').attr('value', volume);
            $("#edit-form-cf").attr('action', url);
      });

    });

/*----------------------------------------------------------*/

  //Fermer la modal après export
  $('#exportExcel').on('click', function () {
      $('#export-locaux').modal('hide');
  })

/*----------------------------------------------------------*/
  
  //cocher/décocher toutes les checkbox boutton paramètrage/export
  $(".checkAllCol, .checkAllExp").on('click', 'input:checkbox', function(){

    var colonnesIdDefault = ['numero_ad', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie'];

    if ($(this).is(':checked')){
        
        if ($(this).attr('id') == 'checkAllCol') {

            $('.choix-colonnes input:checkbox').each(function(){
              $(this).prop('checked', 'checked');
            });

        }else{

            $('.choix-colonnes2 input:checkbox').each(function(){
              $(this).prop('checked', 'checked');
            });
        }

    }else{

        if ($(this).attr('id') == 'checkAllCol') {

            $('.choix-colonnes input:checkbox').each(function(){

                var val = $(this).attr('value');

                if ($.inArray(val, colonnesIdDefault) == -1) {

                    $(this).prop('checked', '');
                }
            });
        }else{

            $('.choix-colonnes2 input:checkbox').each(function(){

                var val = $(this).attr('value');

                if ($.inArray(val, colonnesIdDefault) == -1) {

                    $(this).prop('checked', '');
                }
            });
        }
    }
        
  });

  $('#choixExport').on('click', function(){
      if ($('#checkAllCol').is(':checked')) {
        $('#checkAllExp').prop('checked', 'checked');
      }
  });

/*----------------------------------------------------------*/

  // Fonction pour cloturer les sinistres et mettre la ligne en coloré
  $(".cloture").on('click', function () {

      $(this).each(function(){

            var url = $(this).data('url');
            console.log(url);
            $("#cloture-sinistre").attr('action', url);
      });

  });

});