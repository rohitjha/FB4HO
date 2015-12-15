//convert graph_data into readable form

console.log(start_date);
console.log(end_date);

var current_date = new Date();

var parts = graph_data.split(" ");
data = [];
for (i = 2; i < parts.length; i+=4) {

    if (parts[i] == "1")
    {
        data.push( {time: parts[i - 2] + " " + parts[i - 1], frequency: parts[i + 1]});
    }//if

}//for


//Remove based on start and end time
if (start_date != "" && end_date != "") //strings
{

//We know we came from the doctor page
temp_data = [];

  t_s = start_date.split(/[- :]/);
  t_e = end_date.split(/[- :]/);


  //console.log(t_e);

  t_start = new Date(t_s[0], t_s[1]-1, t_s[2], t_s[3], t_s[4], t_s[5]);
  t_end = new Date(t_e[0], t_e[1]-1, t_e[2], t_e[3], t_e[4], t_e[5]);

  //console.log(t_end);

  for (var i = 0; i < data.length; i++)
  {
    t = data[i].time.split(/[- :]/);
    var data_date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    
   //console.log(data_date + "vs" + t_start + " and " + t_end + "\n");

    if (data_date > t_start && data_date < t_end)
    {
     temp_data.push({time : data[i].time, frequency : data[i].frequency });

    }//if

//console.log();

  }//for all the elements

data = temp_data;

//change type of graph based on the days selected
var diff = t_end.getTime() - t_start.getTime();
var diffDays = Math.ceil(diff / (1000 * 3600 * 24));

console.log("Diff: " + diffDays + "\n");

if (diffDays == 1) //test
time_type = "Day";
else if (diffDays < 7) //test
time_type = "Week";
else
time_type = "Month"; 

time_type = "Month";

//current_date = new Date(t_start - 1); //sets the current_date to start date

}//if start and end time is defined


if (time_type == "Day")
{


//Make 24 discrete options and insert value when available.
data_hours = Array.apply(null, Array(24)).map(Number.prototype.valueOf,0);
  
  //var current_date = new Date();
  for (var i = 0; i < data.length; i++)
  {
    t = data[i].time.split(/[- :]/);
    var data_date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
   // var diff = current_date.getTime() - data_date.getTime();
   // var diffDays = Math.ceil(diff / (1000 * 3600 * 24)); 

   var IsSameDay = false;
   if (data_date.getDate() == current_date.getDate() && 
       data_date.getMonth() == current_date.getMonth() && 
       data_date.getYear() == current_date.getYear())
      {
	IsSameDay = true;
      }

    if (IsSameDay == true && data[i].frequency != '0')
    {
     data_hours[data_date.getHours()] = parseInt(data[i].frequency);
    }

  }//for all values in the table

//Create hours array as sendable to data

data_hours_obj = [];

  for (var i = 0; i < 24; i++)
  {
    data_hours_obj.push({time : FindHour(i), frequency : data_hours[i] });
  }

data = data_hours_obj;

}//if day selected

else if (time_type == "Week")
{

//Make 7 discrete options and insert value when available.
data_days = Array.apply(null, Array(7)).map(Number.prototype.valueOf,0);
data_days_counter = Array.apply(null, Array(7)).map(Number.prototype.valueOf,0);


  //var current_date = new Date();
  for (var i = 0; i < data.length; i++)
  {
    t = data[i].time.split(/[- :]/);
    var data_date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    //var diff = current_date.getTime() - data_date.getTime();
    //var diffDays = Math.ceil(diff / (1000 * 3600 * 24)); 

   if (current_date.getDate() - data_date.getDate() <= 6 && data[i].frequency != '0')
   {
     data_days[current_date.getDate() - data_date.getDate()] += parseInt(data[i].frequency);
     data_days_counter[current_date.getDate() - data_date.getDate()] += 1;

   }

  }//for all values in the table


//Create days array as sendable to data

data_days_obj = [];

  for (var i = 0; i < 7; i++)
  {
    if (data_days_counter[6 - i] == 0) {data_days_counter[6 - i] = 1; } //otherwise 0/0 = NaN 
    data_days_obj.push({time : FindDay(6 - i), frequency : parseInt(data_days[6 - i] / data_days_counter[6 - i]) })
  }

data = data_days_obj;

}//if week selected

/*
else if (time_type == "Month")
{

//Make 31 discrete options and insert value when available.
data_days = Array.apply(null, Array(31)).map(Number.prototype.valueOf,0);
data_days_counter = Array.apply(null, Array(31)).map(Number.prototype.valueOf,0);


  //var current_date = new Date();
  for (var i = 0; i < data.length; i++)
  {
    t = data[i].time.split(/[- :]/);
    var data_date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);

   var IsSameMonth = false;
   if (data_date.getMonth() == current_date.getMonth() &&
       data_date.getYear() == current_date.getYear())
      {
        IsSameMonth = true;
      }

    if (IsSameMonth == true && data[i].frequency != '0')
    {
     data_days[data_date.getDate()] += parseInt(data[i].frequency);
     data_days_counter[data_date.getDate()] += 1;
    }


  }//for all values in the table


//Create days array as sendable to data

data_days_obj = [];

  for (var i = 0; i < 31; i++)
  {
    if (data_days_counter[i + 1] == 0) {data_days_counter[i + 1] = 1; } //otherwise 0/0 = NaN 
    data_days_obj.push({time : i + 1, frequency : parseInt(data_days[i + 1] / data_days_counter[i + 1]) })
  }

data = data_days_obj;

}//if month selected
*/

else if (time_type == "Month")
{

//Make 31 discrete options and insert value when available.
data_days = Array.apply(null, Array(31)).map(Number.prototype.valueOf,0);
data_days_counter = Array.apply(null, Array(31)).map(Number.prototype.valueOf,0);


  //var current_date = new Date();
  for (var i = 0; i < data.length; i++)
  {
    t = data[i].time.split(/[- :]/);
    var data_date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);


    var diff = current_date.getTime() - data_date.getTime();
    var diffDays = Math.ceil(diff / (1000 * 3600 * 24)); 

    var IsSameMonth = false;
   if (diffDays < 31)
      {
        IsSameMonth = true;
      }

    if (IsSameMonth == true && data[i].frequency != '0')
    {
     data_days[data_date.getDate()] += parseInt(data[i].frequency);
     data_days_counter[data_date.getDate()] += 1;
    }


  }//for all values in the table

//Create days array as sendable to data

data_days_obj = [];

 // for (var i = current_date.getDate() + 1; i != current.getDate(); i++)
  var i = current_date.getDate() + 1;
  while (true)
  {
    if (data_days_counter[i - 1] == 0) {data_days_counter[i - 1] = 1; } //otherwise 0/0 = NaN 
    data_days_obj.push({time : i, frequency : parseInt(data_days[i] / data_days_counter[i]) })

   if (i == current_date.getDate()) break;
   
   i += 1;
   if (i == 31) i = 1;


  }

data = data_days_obj;

}//if month selected


//Is Data Empty
var IsNoData = true;
for (var i = 0; i < data.length; i++)
{
 if (data[i].frequency != 0 && !isNaN(data[i].frequency)) 
 {
  IsNoData = false;
  break;
 }
}

console.log("Data: " + IsNoData);
console.log("print data" +  data)

var margin = {top: 40, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;


var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>Steps Taken:</strong> <span style='color:red'>" + d.frequency + "</span>";
  })

var placement = "#graph2";

if (IsNoData == true)
{
 placement = "#graphX"; //doesn't exist
}

var svg2 = d3.select(placement).append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg2.call(tip);

//d3.tsv("data.tsv", type, function(error, data) {
  x.domain(data.map(function(d) { return d.time; }));
  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

  svg2.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg2.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("No. of Steps Taken");

  svg2.selectAll(".bar2")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar2")
      .attr("x", function(d) { return x(d.time); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.frequency); })
      .attr("height", function(d) { return height - y(d.frequency); })
      .on('mouseover', tip.show)
      .on('mouseout', tip.hide)

//});

function type(d) {
  d.frequency = +d.frequency;
  return d;
}

function FindHour(hours)
{

    //it is pm if hours from 12 onwards
    suffix = (hours >= 12)? 'pm' : 'am';

    //only -12 from hours if it is greater than 12 (if not back at mid night)
    hours = (hours > 12)? hours -12 : hours;

    //if 00 then it is 12 am
    hours = (hours == '00')? 12 : hours;

    return hours + " " + suffix;
}


function FindDay(offset)
{

var day = new Date(); //today

for (var i = 0; i < offset; i++)
{

day.setDate(day.getDate() - 1);

}//for all previous days

//console.log(day.getDay());
//console.log(offset);


      if (day.getDay() == 0) return "Sun";
 else if (day.getDay() == 1) return "Mon";
 else if (day.getDay() == 2) return "Tue";
 else if (day.getDay() == 3) return "Wed";
 else if (day.getDay() == 4) return "Thu";
 else if (day.getDay() == 5) return "Fri";
 else if (day.getDay() == 6) return "Sat";

}

