@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i>Reporte status Máquinas</h1>

    <div class="card-header">
      
    </div>

    <div class="card">
      <div class="card-body">
        <div id="chartdiv1"></div>

        <div id="chartdiv"></div>
      </div>
    </div>
@stop

@section('content')

@stop

@section('css')
<style>
#chartdiv1  {
  width: 100%;
  height: 500px;
}


</style>

<style>
  #chartdiv  {
    width: 100%;
    height: 500px;
  }
  
  
  </style>
@stop

@section('js')
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>

<script>
  am5.ready(function() {
  var root1 = am5.Root.new("chartdiv1");

  root1.setThemes([
    am5themes_Animated.new(root1)
  ]);

  var chart = root1.container.children.push(am5xy.XYChart.new(root1, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX: true,
    paddingLeft:0,
    paddingRight:1
  }));
  
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root1, {}));
  cursor.lineY.set("visible", false);
  
  var xRenderer = am5xy.AxisRendererX.new(root1, { 
    minGridDistance: 30, 
    minorGridEnabled: true
  });
  
  xRenderer.labels.template.setAll({
    rotation: -90,
    centerY: am5.p50,
    centerX: am5.p100,
    paddingRight: 15
  });
  
  xRenderer.grid.template.setAll({
    location: 1
  })
  
  var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root1, {
    maxDeviation: 0.3,
    categoryField: "status",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root1, {})
  }));
  
  var yRenderer = am5xy.AxisRendererY.new(root1, {
    strokeOpacity: 0.1
  })
  
  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root1, {
    maxDeviation: 0.3,
    renderer: yRenderer
  }));
  
  var series = chart.series.push(am5xy.ColumnSeries.new(root1, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    sequencedInterpolation: true,
    categoryXField: "status",
    tooltip: am5.Tooltip.new(root1, {
      labelText: "{valueY}"
    })
  }));
  
  series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
  series.columns.template.adapters.add("fill", function (fill, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });
  
  series.columns.template.adapters.add("stroke", function (stroke, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });
  
  am5.net.load("{{route('machine.reportgrafconsult')}}").then(function(result) {
  /* am5.net.load("http://127.0.0.1:8000/api/reportgrafconsult").then(function(result) { */
    /*  */
    
  var data=am5.JSONParser.parse(result.response);
  console.log(result.response);

  xAxis.data.setAll(data);
  series.data.setAll(data);
 
  series.appear(1000);
  chart.appear(1000, 100);

}).catch(function(result) {
  console.log("Error loading " + result.xhr.responseURL);
});
  
  }); // end am5.ready()
  </script>



<script>
  am5.ready(function() {
var root = am5.Root.new("chartdiv");

root.setThemes([
  am5themes_Animated.new(root)
]);

var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    endAngle: 270
  })
);

var series = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category",
    endAngle: 270
  })
);

series.states.create("hidden", {
  endAngle: -90
});

am5.net.load("{{route('machine.reportgrafconsult')}}").then(function(result) {
  /* var data=am5.JSONParser.parse(result.response); */
  series.data.setAll(am5.JSONParser.parse(result.response));
  
}).catch(function(result) {
  console.log("Error loading " + result.xhr.responseURL);
});
series.appear(1000, 100);
  });
  </script>
@stop
