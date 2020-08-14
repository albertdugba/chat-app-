// $("#name").autogrow();

// let textArea = document.querySelector(".chat__form");
// textArea.addEventListener("keydown", autosize);

// function autosize() {
//   let el = this;

//   setTimeout(() => {
//     el.style.cssText = "height:auto; padding:0";
//     el.style.cssText = "height:" + el.scrollHeight + "px";
//   }, 0);
// }

function toggleModal() {
  if ($("#toggleBtn").css("display") == "block") {
    $("#container").fadeOut(function () {
      $("#overlay").fadeIn(300, function () {
        $("#toggleBtn").fadeOut(300, function () {
          $(".container").fadeIn(300);
        });
        $("#container").removeClass("container default");
        $("#container").addClass("container fullscreen");
      });
    });
  } else {
    $("#container").fadeOut(function () {
      $("#overlay").fadeOut(300, function () {
        $("#container").removeClass("container fullscreen");
        $("#container").addClass("container default");
        $("#toggleBtn").fadeIn(300, function () {
          $(".container").fadeIn(300);
        });
      });
    });
  }
}

function toggleButton() {
  //$(".container").css("visibility", "visible");
  $(".container").slideToggle();
}

function rdata(action) {
  let name = document.getElementById("name").value;
  if (name === "") {
    alert("Message required");
  } else {
    $.post(
      "postindex.php",
      { insertdata: action, messageBody: name },
      function (data, status) {
        if (action === "insertdata") {
          ///alert(data);
          let obj = JSON.parse(data);
          if (obj.state == "success") {
            $("#rdata").append(obj.message);
            if (obj.append == false) {
              scrollDown();
            }
            $("#name").val(" ");
          } else {
            $("#rdata").append(obj.message).fadeIn(300);

            //scrollDown();
          }
        } else {
          $("#rdata").html(data);
        }
      }
    );

    // document.getElementById("send").value = "";
  }
}

function scrollDown() {
  let height = document.getElementById("rdata").offsetHeight;
  $("#chat__messages").scrollTop(height);

  $.post("postindex.php", { insertdata: "resetMessageStatusTo1" }, function (
    data
  ) {});
}
let holdhtml = " ";

// this function is gettin all th chat messages //
let clearinter = setInterval(function () {
  $.post("postindex.php", { insertdata: "retrievevedata" }, function (data) {
    $("#rdata").html(data);
    scrollDown();
    clearInterval(clearinter);
    //scrollDown();
  });
}, 1000);

// this function is doin the count
setInterval(function () {
  $.post("postindex.php", { insertdata: "readNonRead" }, function (data) {
    let objCountNonRead = JSON.parse(data);

    if (objCountNonRead.statusCount === "yes") {
      $("#scrollCountDown").fadeIn(500);
      document.getElementById("scrollCountDown").innerHTML =
        objCountNonRead.Count;
      holdhtml = objCountNonRead.message;
    } else {
      $("#scrollCountDown").fadeOut(500);
      document.getElementById("scrollCountDown").innerHTML = "";
    }

    //scrollDown();
  });
}, 1000);

function scrollCountDown(data) {
  if (holdhtml == " ") {
    scrollDown();
    $(data).fadeOut(500);
  } else {
    $("#rdata").append(holdhtml);
    scrollDown();
    $(data).fadeOut(500);
  }
}
