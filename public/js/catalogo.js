let canvas = new fabric.Canvas('tshirt-canvas');

function updateTshirtImage(imageURL){
    fabric.Image.fromURL(imageURL, function(img) {
        newScale = canvas.width / img.width
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: newScale,
            scaleY: newScale
        });
    });
}


// Update the TShirt color according to the selected color by the user
document.getElementById("inputCor").addEventListener("change", function(){
    document.getElementById("tshirt-div").style.backgroundColor = '#'+this.value;
}, false);


function on(id) {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("inputQuantidade").value = "1";
    document.getElementById("inputId").value = id;
    document.getElementById("tshirt-div").style.backgroundColor = '#'+document.getElementById("inputCor").value;
    document.getElementById("estampaNome").innerHTML = document.getElementById(id).alt;
    updateTshirtImage(document.getElementById(id).src);
}

function off() {
    document.getElementById("overlay").style.display = "none";
    console.log("off");
}
