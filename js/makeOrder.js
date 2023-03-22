let user_login = document.getElementById("user_login").value;
// let admin_login = document.getElementById("admin_login").value;

let orderRow = document.getElementById("orderRow");
let image_btns = document.querySelectorAll(".select-product");
console.log(user_login);
if(user_login){
image_btns.forEach((btn) => btn.addEventListener("click", selectProduct));
function selectProduct() {
  const id = this.dataset.productId;
 
  fetch(`http://localhost/ITIcafe/makeOrder.php?product-id=${id}&user-id=${user_login}`)
    .then((data) => {
      if (data) {
        console.log(id);
        window.location.reload();
      }
    });
}
// http://localhost/home.php
}

else if(admin_login){
image_btns.forEach((btn) => btn.addEventListener("click", selectProduct));
function selectProduct() {
  const id = this.dataset.productId;
  fetch(`http://localhost/ITIcafe/adminmakeOrder.php?product-id=${id}&admin-id=${admin_login}`)
    .then((data) => {
      if (data) {
        window.location.reload();
      }
    });
}
}
let cancel_btns = document.querySelectorAll(".cancel-product");
cancel_btns.forEach((btn) => btn.addEventListener("click", cancelProduct));

function cancelProduct() {
  const id = this.dataset.cancelId;
  console.log(id);
  fetch(`http://localhost/ITIcafe/makeOrder.php?cancel-id=${id}`).then(
    (data) => {
      if (data) {
        let btn = document.querySelector(`button[data-cancel-id='${id}']`);
        btn.parentElement.parentElement.parentElement.remove();
      }
    }
  );
}
let increase_btns = document.querySelectorAll(".increaseAmount");
increase_btns.forEach((btn) => btn.addEventListener("click", increaseAmount));

function increaseAmount() {
  const id = this.dataset.increaseId;

  fetch(`http://localhost/ITIcafe/makeOrder.php?increase-id=${id}`).then(
    (data) => {
      if (data) {
        let btn = document.querySelector(`button[data-increase-id='${id}']`);
         let amount =
           btn.parentElement.parentElement.previousElementSibling.firstElementChild.firstElementChild.getAttribute(
             "value"
           );
           
        // console.log(amount);
        let newAmount = parseInt(amount) + 1;
        btn.parentElement.parentElement.previousElementSibling.firstElementChild.firstElementChild.setAttribute(
          "value",
          newAmount
        );
        // console.log(newAmount);
      }
    }
  );
}

let decrease_btns = document.querySelectorAll(".decreaseAmount");
decrease_btns.forEach((btn) => btn.addEventListener("click", decreaseAmount));

function decreaseAmount() {
  const id = this.dataset.decreaseId;

  fetch(
    `http://localhost/ITIcafe/makeOrder.php?decrease-id=${id}&amount=`
  ).then((data) => {
    if (data) {
      let btn = document.querySelector(`button[data-decrease-id='${id}']`);
      let amount =
        btn.parentElement.parentElement.nextElementSibling.firstElementChild.firstElementChild.getAttribute(
          "value"
        );
      // console.log(amount);
      if (amount > 1) {
        let newAmount = parseInt(amount) - 1;
        btn.parentElement.parentElement.nextElementSibling.firstElementChild.firstElementChild.setAttribute(
          "value",
          newAmount
        );
        // console.log(newAmount);
      }
    }
  });
}
