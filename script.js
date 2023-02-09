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

const trash = document.querySelectorAll('img, .trash')

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

$(trash).each(function(index) {
  $(this).data("index", index + 1);
});

$(trash).click(function() {
  console.log($(this).data("index"));
});



$("img, #edit").click(function() {
  $("#myDiv").css("display", "block");
  console.log("Voulez-vous modifier ce quiz ?");
});




$(".profile img").click(function() {
  $("#file-input").click();
});

$("#file-input").change(function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(".profile img").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  }
});