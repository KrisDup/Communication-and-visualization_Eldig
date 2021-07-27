//Global data array 
var array_data = {};
window.array_data = array_data;

//Global parameters JSON
var parameters = {Current: {values: 1, name : "Current"}, Temperature: {values: 0, name : "Temperature"}, Voltage: {values: 2, name : "Voltage"}};
window.parameters = parameters;





//Main script
function main() {
	
	//Starts plot with initial 60 values
	StartPlot('get_data.php','SELECT * FROM testing_data ORDER BY date desc limit 60', parameters);

	//This line makes the plot update every second
	setInterval(function () {add_to_plot('get_data.php','SELECT * FROM testing_data ORDER BY date desc limit 1', parameters);}, 1000);
}







//Plots the most recent 60 readings
function StartPlot(file, sql, parameter) {
	var Req = new XMLHttpRequest();
	Req.onload = function () {
		if(this.status == 200){
			document.getElementById('output').innerHTML = this.responseText;
			array_data = JSON.parse(this.responseText).reverse();
			Plotting(parameter, array_data, 'lines', '#B0E0E6');
		}
	}
	Req.open("GET", file+"?q="+sql, true);
	Req.send();
}

//Add trace to plot and remove last value
function add_to_plot(file, sql, parameter) {
	var Req = new XMLHttpRequest();
	Req.onload = function () {
		if(this.status == 200){
			document.getElementById('output').innerHTML = this.responseText;
			result = JSON.parse(this.responseText);
			extend_plot(result, parameter);
		}	
	}
	Req.open("GET", file+"?q="+sql, true);
	Req.send();
}

//Callback function for starting plot
function Plotting(parameter, data, types, backg_color) {
	for (const param in parameter){
		var temps = [];
		data.forEach(function (value, index, array) {temps.push(value[parameter[param].values]);})
		var datas = [{y: temps, mode: types}];
		var layout = {title: parameter[param].name, plot_bgcolor: backg_color, paper_bgcolor: backg_color, font: {color: '#000000', size: 16}};
		Plotly.newPlot(parameter[param].name, datas, layout);
	}
}

//Callback function for extending plot
function extend_plot(result, parameter) {
	//Check to see if fetched date is equal to the most recent trace.
	if (result[0][2] !== array_data[59][2]) {
		array_data.push(result[0]);
		array_data.shift();
		for (const param in parameter) {
			Plotly.extendTraces(parameter[param].name, {y:[[parseInt(result[0][parameter[param].values])]]}, [0]);
		}
	}
}



