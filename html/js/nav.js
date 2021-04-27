/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("side_nav").style.width = "10%";
    document.getElementById("logo").style.left = "8%"; 
    document.getElementById("info").style.marginLeft = "9%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }
  
/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
  document.getElementById("side_nav").style.width = "0%";
  document.getElementById("info").style.marginLeft = "2%";
  document.getElementById("logo").style.left = "1%";
  document.body.style.backgroundColor = "white";
  }
