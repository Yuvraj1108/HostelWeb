function DisplayItem(xml)
{

	var Data=JSON.parse(xml.responseText);
	
	for (var day in Data) {
		var complexdict = Data[day];
		for (var meal in complexdict) {
			var itemdict = complexdict[meal];
			tochange = document.getElementById(day+meal);
			var thestring ="<ul>";
			console.log(day+meal)
			for (var items in itemdict){
				console.log(items + "\n")
				if (items.replace(/\s/g, '').length){
				thestring += "<li>" + items + "</li>";}
			}
			thestring += "</ul>";
			console.log(thestring)
			tochange.innerHTML = thestring;
		}
	}
	
}

$(function(){
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if(this.readyState==4 && this.status==200)
		{
			DisplayItem(this);
			$("#MessOutputError").text(this.readyState);
		}
		else
		{
			$("#MessOutputError").text(this.readyState+" "+this.status);
			//$("#MessOutputError").show();
		}
	};
	xmlhttp.open("GET","../PHP/MessMenu.php",true);
	xmlhttp.send();
});


