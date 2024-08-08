loadData();
readId();

btnAciton = "Insert";
// To open the modal when the button is clicked
$("#addNew").on("click", () => {
  $("#modal").modal("show");
});

$("#form").submit(function (event) {
  event.preventDefault();
  let form_data = new FormData($("#form")[0]);

  if (btnAciton == "Insert") {
    form_data.append("action", "register");
    readId();
    location.reload();
  } else {
    form_data.append("action", "updateItem");
  }

  $.ajax({
    url: "api.php",
    type: "POST",
    data: form_data,
    contentType: false,
    processData: false,
    success: function (response) {
      if (btnAciton == "Insert") {
        alert("Success! you have registerd Successfully!");
      } else {
        alert(response.msg);
      }
      $("#form")[0].reset();
      $("#modal").modal("hide");
      btnAciton = "Insert";
      loadData();
    },
    error: function (error) {
      console.log("Error!", error.msg);
    },
  });
});

function loadData() {
  let sendingData = { action: "getAll" };
  $.ajax({
    url: "api.php",
    data: sendingData,
    type: "post",
    success: function (response) {
      let status = response.status;
      let data = response.msg;
      let tr = "";
      if (status) {
        data.forEach((element) => {
          tr += "<tr>";
          for (i in element) {
            tr += `<td>${element[i]}</td>`;
          }

          tr += `<td>
            <button class="btn btn-warning editBtn" data-id="${element.itemid}">Edit</button>
            <button class="btn btn-danger deleteBtn" data-id="${element.itemid}">Delete</button>
          </td>`;
          tr += "</tr>";
        });
        $("#table tbody").html(tr);
      }
      console.log("loaded well enough");
    },
    error: function (error) {
      console.log(error.msg);
    },
  });
}

function readId() {
  let sendingDat = { action: "readid" };
  $.ajax({
    url: "api.php",
    data: sendingDat,
    type: "post",
    success: function (response) {
      // console.log(response);
      for (let i = 1; i < parseInt(response.length) + 1; i++) {
        $("#id").val(i + 1);
      }
    },
    error: function (error) {
      console.log(error.responseText);
    },
  });
}

// updating the item
function fetchItem(id) {
  let sendingData = { action: "getItem", id: id };
  console.log(sendingData.id);
  $.ajax({
    url: "api.php",
    type: "POST",
    datatype: "json",
    data: sendingData,
    success: function (response) {
      let data = response.msg[0];
      $("#id").val(data.itemid);
      $("#name").val(data.itemname);
      $("#qyt").val(data.qyt);
      $("#price").val(data.price);
      $("#modal").modal("show");
      btnAciton = "update";

      loadData();
    },
    error: function (error) {
      console.log(error.responseText);
    },
  });
}

// deleting the item
function deleteItem(id) {
  let sendingData = { action: "deletItem", id: id };
  $.ajax({
    data: sendingData,
    url: "api.php",
    type: "post",
    success: function (response) {
      alert(response.msg);
      loadData();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

$("#table").on("click", ".editBtn", function () {
  let id = $(this).attr("data-id");
  fetchItem(id);
});
$("#table").on("click", ".deleteBtn", function () {
  let id = $(this).attr("data-id");

  if (confirm("Are you sure you want to delete this" + id)) {
    deleteItem(id);
  }
});
