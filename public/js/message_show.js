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
        $('#invitation').html(butasInvitation);
    });});


    // Print mygtukas
    document.querySelector('#print-button').addEventListener('click',function(){
        window.print();
    });




  function goBack() {
    window.history.back();
  }

  function goForward() {
    window.history.forward();
  }

  window.onload = function() {
    const backButton = document.getElementById("backButton");
    const forwardButton = document.getElementById("forwardButton");

    backButton.disabled = !window.history.length;
    forwardButton.disabled = !window.history.length;

    window.onpopstate = function() {
      backButton.disabled = !window.history.length;
      forwardButton.disabled = !window.history.length;
    };
  };


  $(document).ready(function(){
    $('#postImage').on('click',function(e){
        $("#postImageModalImage") = $(this).attr("src", $(this).attr("src"));
        console.log(this);


        $('#postImageModal').modal('show');

    });});

