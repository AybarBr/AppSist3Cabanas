const fila = document.getElementById("fila-1");
const edit_button= document.getElementById("edit-button");
const save_button= document.getElementById("save-button");

//edit table
const categoria = document.getElementById("categoria");
const precio_venta = document.getElementById("precio-venta");
const precio_compra = document.getElementById("precio-compra");
const stock_min = document.getElementById("stock-min");
const cantidad = document.getElementById("cantidad");

//new fila
const nuevo_prod = document.getElementById("new-product");


edit_button.addEventListener("click", function(){
    precio_venta.contentEditable = true;
    precio_venta.style.backgroundColor= "#dddbdb";

    precio_compra.contentEditable = true;
    precio_compra.style.backgroundColor= "#dddbdb";

    stock_min.contentEditable = true;
    stock_min.style.backgroundColor= "#dddbdb";

    cantidad.contentEditable = true;
    cantidad.style.backgroundColor= "#dddbdb";

})

save_button.addEventListener("click", function(){
    precio_venta.contentEditable = false;
    precio_venta.style.backgroundColor= "#FFFFFF";

    precio_compra.contentEditable = false;
    precio_compra.style.backgroundColor= "#FFFFFF";

    stock_min.contentEditable = false;
    stock_min.style.backgroundColor= "#FFFFFF";

    cantidad.contentEditable = false;
    cantidad.style.backgroundColor= "#FFFFFF";
})

nuevo_prod.addEventListener("click", function(){
    document.getElementById("dataTable").insertRow(-1).innerHTML = '<input><td></td>';

    precio_venta.contentEditable = true;

    precio_compra.contentEditable = true;

    stock_min.contentEditable = true;

    cantidad.contentEditable = true;

})

