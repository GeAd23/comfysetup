var result = "default";
var colormode = "light";
var content;
var orderitem = "";

function dbRequest() {
	// phpscript.php aufrufen über POST aufrufen
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			result = xhttp.responseText;
			tableListenerRemove();
			document.getElementById("table").innerHTML = result;
			tableListener();
		}
	};
	xhttp.open("POST", "requestdbitem.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	if(sessionStorage.getItem("itemSorted") === null || sessionStorage.getItem("itemSorted") === "") //Zum Zurücksetzen, muss die Seite neu geladen (oder per Button) werden.
	{
		xhttp.send("a=searchItem&b=" + $("#search").val());
	}
	else
	{
		var order = sessionStorage.getItem("itemSorted");
		var mode = sessionStorage.getItem("sortMode");
		xhttp.send("a=searchItemOrder&b=" + $("#search").val() + "&c=" + order + "&d=" + mode);
	}
}

function dbRequestOrdered(order, mode) {
	// phpscript.php aufrufen über POST aufrufen
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			result = xhttp.responseText;
			tableListenerRemove();
			document.getElementById("table").innerHTML = result;
			tableListener();
		}
	};
	xhttp.open("POST", "requestdbitem.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("a=searchItemOrder&b=" + $("#search").val() + "&c=" + order + "&d=" + mode);
}

function sorteditem(item, mode)
{
	if(sessionStorage.getItem("itemSorted") === null)
	{
		sessionStorage.setItem("itemSorted", item);
	}
	else
	{
		sessionStorage.setItem("itemSorted", item);
	}
	if(sessionStorage.getItem("sortMode") === null)
	{
		sessionStorage.setItem("sortMode", mode);
	}
	else
	{
		sessionStorage.setItem("sortMode", mode);
	}
}

function resetorder()
{
	sessionStorage.setItem("itemSorted", "");
	sessionStorage.setItem("sortMode", "");
	dbRequest();
}

function prepareRequestOrder(order)
{
	var ordercontent = order.split(" ", );
	ordercontent = ordercontent[0];
	if(ordercontent != undefined)
	{
		order = ordercontent;
	}
	if(order == orderitem)
	{
		orderitem = order;
		sorteditem(orderitem, "up");
		dbRequestOrdered(orderitem, "up");
		orderitem = "";
	}
	else
	{
		orderitem = order;
		sorteditem(orderitem, "down");
		dbRequestOrdered(orderitem, "down");
	}
}

function tableListener()
{
	var tabledb = document.getElementById("table1");
	
	for (var i = 0, n = tabledb.rows.length - tabledb.rows.length + 1; i < n; i=i+1) { //EventListener für die Header der Tabelle erstellen.
		for (var j = 0, m = tabledb.rows[i].cells.length; j < m; j=j+1) {
			tabledb.rows[i].cells[j].addEventListener("click", function(){ prepareRequestOrder(this.innerHTML); }); //this --> tabledb.rows[i].cells[j].innerHTML
		}
	}	
}

function tableListenerRemove()
{
	var tabledb = document.getElementById("table1");
	
	for (var i = 0, n = tabledb.rows.length - tabledb.rows.length + 1; i < n; i=i+1) { //EventListener für die Header der Tabelle erstellen.
		for (var j = 0, m = tabledb.rows[i].cells.length; j < m; j=j+1) {
			tabledb.rows[i].cells[j].removeEventListener("click", function(){ prepareRequestOrder(this.innerHTML); }); //this --> tabledb.rows[i].cells[j].innerHTML
		}
	}
}

window.onload = function () {
	var livesearch = document.getElementById("search");
	livesearch.addEventListener("keyup", dbRequest);
	tableListener();
	
	content = document.getElementById("csscolormode");
	document.getElementById("toggle1").addEventListener("click", position0);
	session1();
	resetorder();
}

function position0(){
	if(colormode == "light"){
			colormode="dark";
		  sessionStorage.setItem("colormode", colormode);
		  content.href = "./media/darkstyle.css";
	}
	else if(colormode == "dark"){
			colormode="light";
		  sessionStorage.setItem("colormode", colormode);
		  content.href = "./media/lightstyle.css";
	}
}

function session1(){
	if(sessionStorage.getItem("colormode") === null){
		sessionStorage.setItem("colormode", colormode);
		if(colormode == "light"){
			document.getElementById("toggle1").checked = false;
			content.href = "./media/lightstyle.css";
		}
		else if(colormode == "dark"){
			document.getElementById("toggle1").checked = true;
			content.href = "./media/darkstyle.css";
		}
	}
	else{
		colormode = sessionStorage.getItem("colormode");
		if(colormode == "light"){
			document.getElementById("toggle1").checked = false;
			content.href = "./media/lightstyle.css";
			}
		else if(colormode == "dark"){
			document.getElementById("toggle1").checked = true;
			content.href = "./media/darkstyle.css";
		}
	}
}
