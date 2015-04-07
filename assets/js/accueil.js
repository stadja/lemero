var initMarque = function() {
    var marqueSelect = $("#marqueSelect").chosen({
        allow_single_deselect: true
    });

    marqueSelect.change(function(event, val) {
        location.href='http://prototype.stadja.net/lemero/garage/magasin/'+val.selected+'#liste';
    //     if (val) {
    //         $('#annee-loader').show();
    //         $('#annee-loader').hide();
    //         $('#modele-loader').hide();
    //         $('#listing-loader').hide();
    //         $('annee-selector').html('');
    //         $('modele-selector').html('');
    //         $('listing-table').html('');
    //         var promise = $.ajax('http://prototype.stadja.net/lemero/garage/magasin/getYears/' + val.selected);
    //         promise.success(function(data) {
    //             $('#annee-loader').hide();
    //             $('annee-selector').html(data);
    //             initYear();
    //         });
    //     } else {
    //         $('#annee-loader').hide();
    //         $('#modele-loader').hide();
    //         $('#listing-loader').hide();
    //         $('annee-selector').html('');
    //         $('modele-selector').html('');
    //         $('listing-table').html('');
    //     }
    });
};

// var initYear = function() {
//     var yearSelect = $("#yearSelect").chosen({
//         allow_single_deselect: true
//     });

//     yearSelect.change(function(event, val) {
//         if (val) {
//             var marque = $("#marqueSelect").val();
//             $('#modele-loader').show();
//             $('#listing-loader').hide();
//             $('modele-selector').html('');
//             $('listing-table').html('');


//             var promise = $.ajax('http://prototype.stadja.net/lemero/garage/magasin/getModels/' + marque + '/' + val.selected);
//             promise.success(function(data) {
//                 $('#modele-loader').hide();
//                 $('modele-selector').html(data);
//                 initModele();
//             });
//         } else {
//             $('#modele-loader').hide();
//             $('modele-selector').html('');
//             $('#listing-loader').hide();
//             $('listing-table').html('');
//         }
//     });
// };

// var initModele = function() {
//     var modeleSelect = $("#modeleSelect").chosen({
//         allow_single_deselect: true
//     });

//     modeleSelect.change(function(event, val) {
//         if (val) {
//             var marque = $("#marqueSelect").val();
//             var year = $("#yearSelect").val();
//             $('#listing-loader').show();
//             $('listing-table').html('');

//             var modele = val.selected.replace(/\W/g, '_')
//             var promise = $.ajax('http://prototype.stadja.net/lemero/garage/magasin/getPieces/' + marque + '/' + year + '/' + modele);
//             promise.success(function(data) {
//                 $('#listing-loader').hide();
//                 $('listing-table').html(data);
//                 $(".fancybox").fancybox();
//             });
//         } else {
//             $('#listing-loader').hide();
//             $('listing-table').html('');
//         }
//     });
// };

initMarque();

var id = false;
var modal = $('#contactModal');
var alert = modal.find('.alert');
var alertClose = modal.find('#alert-close');
var alertText = alert.find('#alert-text');
var sender = modal.find('.contactSend');
var emailExpression = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var emailModal = modal.find('#form-email');
var telModal = modal.find('#form-tel');
var messageModal = modal.find('#form-message');
var nameModal = modal.find('#form-name');

modal.on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this);
    var title = button.data('title') // Extract info from data-* attributes
    id = button.data('id') // Extract info from data-* attributes
    modal.find('.piece-title').text(title);

});

modal.on('hidden.bs.modal', function(event) {
    sender.text('Envoyer un message au vendeur');
    sender.click(clickSend);
    alert.hide();
    email = emailModal.val('');
    tel = telModal.val('');
    message = messageModal.val('');
    name = nameModal.val('');
});


alertClose.click(function() {
    alert.hide();
});


var clickSend = function() {
    var email = emailModal.val();
    var tel = telModal.val();
    var message = messageModal.val();
    var name = nameModal.val();

    var error = '';
    if (!emailExpression.test(email)) {
        error = 'Veuillez rentrer un email!';
    }

    if (error) {
        alertText.text(error);
        alert.show();
    } else {
        sender.text('en cours...');
        sender.unbind('click');
        var promise = $.ajax('http://prototype.stadja.net/lemero/garage/magasin/ask/', {
            data: {
                email: email,
                tel: tel,
                name: name,
                msg: message,
                id: id
            }
        });
		promise.success(function() {
    		sender.text('Merci, votre demande a été envoyée!');
		});
		promise.error(function() {
	        alertText.text("Il semble qu'il y ait eu une erreur... pourriez vous réessayer dans quelques minutes ?");
	        alert.show();
    		sender.text('Error :(');
		});
		
    }
};

sender.click(clickSend);