//Global data array with datapoints
var array_data = {};
window.array_data = array_data;

//Global parameters JSON. These are the parameters used for plotting
var parameters = {Power_input: {values: 0, name: "Power Input"},
					   Charge: {values: 1, name: "Charge"},
					   Battery_temp: {values: 2, name: "Battery Temperature"},
					   Battery_v: {values: 3, name : "Battery Voltage"}, 
					   Battery_c: {values: 4, name : "Battery Current"}, 
					   IO_v: {values: 5, name: "IO Voltage"},
					   IO_c: {values: 6, name: "IO Current"},
					   Temperature: {values: 7, name : "Temperature"}};
window.parameters = parameters;

//Main script
function main(group) {
	
	//Check if the group is a master user
	if (group === "kingzaiz1") {
		var table = "data_gruppe11";
	}
	else {
		var table = group;
	}
	
	//Starts plot with initial 60 values
	StartPlot('get_data.php','SELECT * FROM '+table+' ORDER BY date desc limit 60', parameters);

	//This line makes the plot update every second
	setInterval(function () {add_to_plot('get_data.php','SELECT * FROM '+table+' ORDER BY date desc limit 1', parameters);}, 1000);
}

//Plots the most recent 60 readings
function StartPlot(file, sql, parameter) {
	
	//Loads a request
	var Req = new XMLHttpRequest();
	
	//Onload function
	Req.onload = function () {
		if(this.status == 200){
			temp = this.responseText;
			//Check if the database table is empty
			if (Object.keys(temp).length === 2) {
				return;			
			}		
			array_data = JSON.parse(this.responseText).reverse();
			Plotting(parameter, array_data, 'scatter', '#B0E0E6');
		}
	}
	Req.open("GET", file+"?q="+sql, true);
	Req.send();
}

//Add trace to plot and remove last value
function add_to_plot(file, sql, parameter) {
	
	//Loads a request
	var Req = new XMLHttpRequest();
	//Onload function
	Req.onload = function () {
		if(this.status == 200){
			temp = this.responseText;
			//Check if the database table is empty
			if (Object.keys(temp).length === 2) {
				return;
			}			
			result = JSON.parse(this.responseText);
			//check if there is no existing plot; if no plot exists then it will call start plot.
			if (Object.keys(array_data).length === 0){StartPlot(file, sql, parameter); return;}
			extend_plot(result, parameter);
		}	
	}
	Req.open("GET", file+"?q="+sql, true);
	Req.send();
}



//Callback function for starting plot
function Plotting(parameter, data, types, backg_color) {
	var date_array = [];	
	data.forEach(function (value, index, array) {date_array.push(value[8]);})
	for (const param in parameter){
		var temps = [];
		data.forEach(function (value, index, array) {temps.push(value[parameter[param].values]);})
		var datas = [{y: temps, x: date_array, mode: types}];
		var layout = {title: parameter[param].name, plot_bgcolor: backg_color, paper_bgcolor: backg_color, font: {color: '#000000', size: 16}};
		Plotly.newPlot(parameter[param].name, datas, layout);
	}
}

//Callback function for extending plot
function extend_plot(result, parameter) {
	//Check to see if fetched date is equal to the most recent trace.
	if (result[0][8] !== array_data.slice(-1)[0][8]) {
		array_data.push(result[0]);
		array_data.shift();
		for (const param in parameter) {
			if (parameter[param].values === 0){var temp = String(result[0][parameter[param].values]);}
			else {var temp = parseInt(result[0][parameter[param].values]);}
			Plotly.extendTraces(parameter[param].name, {y:[[temp]], x: [[result[0][8]]]}, [0]);
		}
	}
}



