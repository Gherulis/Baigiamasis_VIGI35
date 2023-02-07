    setTimeout(function(){
        document.getElementById('bad_message').classList.add('hide');
    }, 5000);
    setTimeout(function(){
        document.getElementById('good_message').classList.add('hide');
    }, 5000);

    $(document).ready(function(){
    $('.invitation-button').on('click',function(e){
        var butasInvitation = $(this).attr('data-butas-invitation');
        console.log(butasInvitation);


        $('#exampleModal1').modal('show');
        $('#invitation').val(butasInvitation);
    });});

