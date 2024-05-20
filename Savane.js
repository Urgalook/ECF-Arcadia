let togg5 = document.getElementById("togg5");
let togg6 = document.getElementById("togg6");
let togg7 = document.getElementById("togg7");
let togg8 = document.getElementById("togg8");
let togg9 = document.getElementById("togg9");

let d5 = document.getElementById("d5");
let d6 = document.getElementById("d6");
let d7 = document.getElementById("d7");
let d8 = document.getElementById("d8");
let d9 = document.getElementById("d9");


togg5.addEventListener("click", () => {
  if(getComputedStyle(d5).display != "none"){
    d5.style.display = "none";
  } else {
    d5.style.display = "block";
  }
})

togg6.addEventListener("click", () => {
    if(getComputedStyle(d6).display != "none"){
      d6.style.display = "none";
    } else {
      d6.style.display = "block";
    }
})

togg7.addEventListener("click", () => {
    if(getComputedStyle(d7).display != "none"){
      d7.style.display = "none";
    } else {
      d7.style.display = "block";
    }
})

togg8.addEventListener("click", () => {
    if(getComputedStyle(d8).display != "none"){
      d8.style.display = "none";
    } else {
      d8.style.display = "block";
    }
})

togg9.addEventListener("click", () => {
  if(getComputedStyle(d9).display != "none"){
    d9.style.display = "none";
  } else {
    d9.style.display = "block";
  }
})