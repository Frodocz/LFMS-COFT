$(document).ready(function(){
    //toggle the tooltip to show tips when a href or button is hovered
    $('[data-toggle="tooltip"]').tooltip();

    //popup a confirmation clock to ask user whether or not delete an item
    $('.confirmationDelete').on('click', function () {
        return confirm('Are you sure you want to delete this?');
    });


});


