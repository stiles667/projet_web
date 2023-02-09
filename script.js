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

$(".profile img").click(function () {
  $("#file-input").click();
});

$("#file-input").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(".profile img").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  }
});

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

$(".imgCategorie h3").click(function () {
  var newImgCategorie = $(
    '<div class="imgCategorie">' +
      '<img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png" alt="Supprimer">' +
      '<img class="edit" src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/256/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png" alt="Modifier">' +
      '<h3 id="Name">Quizz n°5</h3><img class="Illustration" src="https://cdn-icons-png.flaticon.com/512/3655/3655618.png">' +
      "</div>"
  );
  $(this).closest(".imgCategorie").before(newImgCategorie);
});

$(".trash").click(function () {
  $(this).closest(".imgCategorie").remove();
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
});

$(".imgCategorie .trash").click(function () {
  $("#popup1").popup();
});

$("#popup1").popup();
