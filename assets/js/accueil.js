var modal = $('#contactModal');

var initMarque = function() {
    $(".fancybox").fancybox();

    $('td.actions a').on('click', function(event) {
        var href = this.href;
        var pos = href.indexOf('#');
        var substr = href.substr(pos + 1);

        var subPos = substr.indexOf('-');
        id = substr.substr(0, subPos);
        var title = substr.substr(subPos + 1);
        title = decodeURIComponent((title+'').replace(/\+/g, '%20'));

        modal.find('.piece-title').text(title);
        modal.modal('show');
        event.preventDefault();
        /* Act on the event */
    });

    var marqueSelect = $("#marqueSelect").chosen({
        allow_single_deselect: true
    });

    marqueSelect.change(function(event, val) {
        location.href=mainUrl+'magasin/'+val.selected+'#liste';
    });
};

initMarque();

var id = false;
var alert = modal.find('.alert');
var alertClose = modal.find('#alert-close');
var alertText = alert.find('#alert-text');
var sender = modal.find('.contactSend');
var emailExpression = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var emailModal = modal.find('#form-email');
var telModal = modal.find('#form-tel');
var messageModal = modal.find('#form-message');
var nameModal = modal.find('#form-name');

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
        var promise = $.ajax(mainUrl+'magasin/ask/', {
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