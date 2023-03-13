const trash = document.querySelectorAll("img, .trash");

$("img, #edit").click(function () {
  $("#myDiv").css("display", "block");
  console.log("Voulez-vous modifier ce quiz ?");
});

$('#submit').on('click', ()=> {
  console.log('Vous avez cliqué');
});

// Onglets

$(".button").click(function () {
  $(".button").removeClass("active");
  $(".container-onglet").removeClass("active");

  // Ajouter la classe "active" à l'onglet cliqué
  $(this).addClass("active");
  var tab = $(this).data("onglet");
  $("#" + tab).addClass("active");
});

//Delete quiz quizzeur

$(".imgCategorie").appendTo("#categories");

// $(".user .trash, .quiz2 .trash2").click(function () {
//   var result = confirm("Êtes-vous sûr de vouloir supprimer cet élément?");
//   if (result) {
//     $(this).closest(".user").remove();
//     $(this).closest(".quiz2").remove();
//   }
//   return console.log("ok");
// });

//Search bar

$(document).ready(function () {
  $('input[type="search"]').focus(function () {
    $(".search-container").css("width", "400px");
  });

  $('input[type="search"]').blur(function () {
    $(".search-container").css("width", "220px");
  });

  //Timer

  var timeLeft = 60;
  var countdown = setInterval(function () {
    timeLeft--;
    document.getElementById("countdown").innerHTML = timeLeft;
    if (timeLeft <= 0) clearInterval(countdown);
  }, 1000);
});
