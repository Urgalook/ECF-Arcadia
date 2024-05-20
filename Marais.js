let togg10 = document.getElementById("togg10");
let togg11 = document.getElementById("togg11");
let togg12 = document.getElementById("togg12");

let d10 = document.getElementById("d10");
let d11 = document.getElementById("d11");
let d12 = document.getElementById("d12");

togg10.addEventListener("click", () => {
    if(getComputedStyle(d10).display != "none"){
      d10.style.display = "none";
    } else {
      d10.style.display = "block";
    }
})

togg11.addEventListener("click", () => {
    if(getComputedStyle(d11).display != "none"){
      d11.style.display = "none";
    } else {
      d11.style.display = "block";
    }
})

togg12.addEventListener("click", () => {
    if(getComputedStyle(d12).display != "none"){
      d12.style.display = "none";
    } else {
      d12.style.display = "block";
    }
})