let order = document.querySelectorAll(".cancel");
order.forEach(btn=> btn.addEventListener('click',cancelProduct));

function cancelProduct () {
    const id = this.dataset.id;
    fetch(`http://localhost/ITIcafe/ibrahim/cancel.php?id=${id}`)
    .then((res) => res.json)
    .then((data) => {
        if(data) {
            let btn = document.querySelector(`button[data-id = '${id}']`);
            btn.parentElement.parentElement.remove();   
        }
    });
};



