// const fileInput = document.getElementById("fileInput");
// const imageContainer = document.getElementById("imgUser");
// const image = document.getElementById("image");

// fileInput.addEventListener("change", () => {
//   const reader = new FileReader();
//   reader.onload = () => {
//     image.src = reader.result;
//   };
//   reader.readAsDataURL(fileInput.files[0]);
// });

// console.log(fileInput);

// $(document).ready(function () {
//     $("#fileInput").change(function () {
//         console.log("test");
//     });
// });

// const trash = document.querySelectorAll("#trash");
// const myDiv = document.querySelector("#myDiv");

// trash.forEach(item => {
//   item.addEventListener('click', () => {
//     myDiv.style.display = "block";
//     console.log("ok");
//   });
// });

const trash = document.querySelectorAll("img, .trash");

// $(trash).each((trash,buttonIndex)=>{
//   $("img, #trash").click(function() {
//     $(".Illustration").css("display", "none");
//     console.log("Voulez-vous supprimer ce quiz ?");
//   });
// });

// $(trash).click(function() {
//   console.log($(trash).index(this));
// });

// index = []

// trash.forEach((button,buttonIndex)=>{
//   button.addEventListener('click', () => {
//     index.addNewElementToTheUserSequence(buttonIndex)
//     console.log("==>>",index)
//   })
// })

$("img, #edit").click(function () {
  $("#myDiv").css("display", "block");
  console.log("Voulez-vous modifier ce quiz ?");
});

// $("img, #trash").click(function() {
//   $(".imgCategorie").css("display", "none");
//   console.log("Supprimer");
// });

// $(".profile img").click(function () {
//   $("#file-input").click();
// });

// $("#file-input").change(function () {
//   if (this.files && this.files[0]) {
//     var reader = new FileReader();
//     reader.onload = function (e) {
//       $(".profile img").attr("src", e.target.result);
//     };
//     reader.readAsDataURL(this.files[0]);
//   }
// });

// var children = document.getElementsByClassName("imgCategorie");
// for (var i = 0; i < children.length; i++) {
//   children[i].addEventListener("click", (function(index) {
//     return function() {
//       console.log("Index -> " + index);
//       $(".imgCategorie").css("display", "none");
//     };
//   })(i));
// }

// $(document).ready(function() {
//   $(".imgCategorie").each(function(index) {
//     $(this).click(function() {
//       console.log("Index -> " + index);
//       $(".imgCategorie").hide();
//     });
//   });
// });

// $(document).ready(function() {
//   $(".imgCategorie").each(function(index) {
//     $(this).click(function() {
//       console.log("Index -> " + index);
//       $(this).hide();
//     });
//   });
// });

// $(document).ready(function() {
//   $(".imgCategorie .trash").each(function(index) {
//     $(this).click(function() {
//       console.log("Index -> " + index);
//       $(this).hide();
//     });
//   });
// });

// $('.imgCategorie h3').click(function(){
//   var newImgCategorie = $('<div class="imgCategorie"><img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png" alt="Supprimer"><img class="edit" src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/256/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png" alt="Modifier"><h3 id="Name">Quizz n°5</h3><img class="Illustration" src="https://cdn-icons-png.flaticon.com/512/3655/3655618.png"></div>');
//   $(this).closest('.imgCategorie').after(newImgCategorie);
// });

// $(".imgCategorie h3").click(function () {
//   var newImgCategorie = $(
//     '<div class="imgCategorie">' +
//       '<img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png" alt="Supprimer">' +
//       '<img class="edit" src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/256/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png" alt="Modifier">' +
//       '<h3 id="Name">Quizz n°5</h3><img class="Illustration" src="https://cdn-icons-png.flaticon.com/512/3655/3655618.png">' +
//     "</div>"
//   );
//   $(this).closest(".imgCategorie").before(newImgCategorie);
// });

$(document).on("click", ".trash", function () {
  $(this).closest(".container-question").remove();
  // Mettre à jour les numéros des questions restantes
  $(".question .number h3").each(function (index) {
    $(this).text(index + 1);
  });
});

$(document).ready(function () {
  $(".question .number h3").each(function (index) {
    $(this).text(index + 1);
  });

  $(".add").click(function () {
    var numQuestions = $(".question").length;
    var newImgCategorie = $(
    '<div id="pageCreate">' +
      ' <div class="container-question">' + 
        '<div class="question">' +
          '<div class="number">' +
          '<h3>' +
            numQuestions +
          '</h3>' +
          '</div>' +
          '<input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">' +
          '<img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png" alt="Supprimer">' +
        '</div>' +
        '<div class="container-answer">' +
          '<div class="answer">' +
            '<div>' +
              '<label for="answer1" class="letter">A</label>' +
              '<input type="text" name="answer1">' +
            '</div>' +
            '<div>' +
              '<label for="answer2" class="letter">B</label>' +
              '<input type="text" name="answer2">' +
            '</div>' +
            '<div>' +
              '<label for="answer3" class="letter">C</label>' +
              '<input type="text" name="answer3">' +
            '</div>' +
            '<div>' +
              '<label for="answer" class="letter">D</label>' +
              '<input type="text" name="answer4">' +
            '</div>' +
            '<div class="check">' +
              '<img src="https://img.icons8.com/fluency/256/checkmark.png">' +
              '<label for="correctAnswer">Sélectionner la bonne réponse</label>' +
              '<select name="correctAnswer" id="correctAnswer">' +
                  '<option value="answer1">A</option>' +
                  '<option value="answer2">B</option>' +
                  '<option value="answer3">C</option>' +
                  '<option value="answer4">D</option>' +
              '</select>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>' +
    '</div>'
    );
    $(this).closest(".question").before(newImgCategorie);
  });
});

$(document).on("click", ".question:not(.add)", function () {
  if ($(".container-answer").height() > 0) {
    $(".container-answer").height(0);
  } else {
    $(".container-answer").height($(".container-answer").prop("scrollHeight") + "px");
  }
});

//A SUPPRIMER ----------------------------------------------

$(".tab-item").click(function() {
  // Retirer la classe "active" de tous les onglets
  $(".tab-item").removeClass("active");
  $(".tab-content").removeClass("active");

  // Ajouter la classe "active" à l'onglet cliqué
  $(this).addClass("active");
  var tab = $(this).data("tab");
  $("#" + tab).addClass("active");
});

//A SUPPRIMER ----------------------------------------------


$(".button").click(function() {
  // Retirer la classe "active" de tous les onglets
  $(".button").removeClass("active");
  $(".container-onglet").removeClass("active");

  // Ajouter la classe "active" à l'onglet cliqué
  $(this).addClass("active");
  var tab = $(this).data("onglet");
  $("#" + tab).addClass("active");
});




// $('.imgCategorie h3').click(function(){
//   $(this).closest('.imgCategorie').append();
// });

$(".imgCategorie").appendTo("#categories");

// $('.imgCategorie .trash').click(function(){
//   if (confirm("Êtes-vous sûr de vouloir supprimer ce quizz ?")) {
//     $(this).closest('.imgCategorie').remove();
//   }
// });

$(".imgCategorie .trash").click(function () {
  var result = confirm("Êtes-vous sûr de vouloir supprimer cet élément?");
  if (result) {
    $(this).closest(".imgCategorie").remove();
  }
  return console.log("ok");
});

$(".imgCategorie").click(function () {
  console.log("ok");
  $(".menu-deroulant").toggle();
});
