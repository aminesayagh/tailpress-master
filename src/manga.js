let slide = new Array();
slide = document.querySelectorAll(".postContent img");
console.log(slide);
document.querySelector("#slideElement img").src = slide[0].dataset.src;