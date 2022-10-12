$(document).ready(function () {
  $(".dropdown").click(function () {
    $(".dropdown-list ul").toggleClass("active");
  });

  $(".dropdown-list ul li").click(function () {
    var icon_text = $(this).html();
    $(".default-option").html(icon_text);
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest(".dropdown").length) {
      $(".dropdown-list ul").removeClass("active");
    }
  });
});

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

//chechout page toggle
function checkFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function checkFunction1() {
  var x = document.getElementById("myDIV1");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

//function for moblile top  nav toggle nav
function myFunctionTopNav() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

// test orange achademy
for (let x = 0; x < 100; x++) {
  if (x < 10) {
    for (let y = 5; y > 0; y--) {
      if (y != 0) {
        console.log("hello");
      }
    }
  }
}

for (let x = 5; x > 0; x--) {
  console.log("hello");
}

function ImCalling(noOfTimesToCall) {
  let x = 1;

  while (x < noOfTimesToCall) {
    console.log("hello");
    x = x + 1;
  }
}

ImCalling(5);
