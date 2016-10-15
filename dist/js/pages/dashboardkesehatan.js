$(function () {

  'use strict';

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: 700,
      color: "#f56954",
      highlight: "#f56954",
      label: "BPJS Kesehatan"
    },
    {
      value: 500,
      color: "#00a65a",
      highlight: "#00a65a",
      label: "Pelayanan Administrasi"
    },
    {
      value: 400,
      color: "#f39c12",
      highlight: "#f39c12",
      label: "Pelayanan Kesehatan"
    },
    {
      value: 600,
      color: "#00c0ef",
      highlight: "#00c0ef",
      label: "Pelayanan Obat"
    }
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> Pengaduan"
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------

  var area = new Morris.Area({
    element: 'revenue-chart',
    data: [
      { y: '2015-01', a: 1, b: 3, c: 2, d: 6},
      { y: '2015-02', a: 2,  b: 6, c: 8, d: 2},
      { y: '2015-03', a: 5,  b: 2, c: 9, d: 5},
      { y: '2015-04', a: 4,  b: 2, c: 3, d: 5},
      { y: '2015-05', a: 7,  b: 7, c: 2, d: 8},
      { y: '2015-06', a: 9,  b: 3, c: 7, d: 1},
      { y: '2015-07', a: 7, b: 5, c: 8, d: 7}
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c', 'd'],
    labels: ['BPJS Kesehatan', 'Pelayanan Administrasi', 'Pelayanan Kesehatan', 'Pelayanan Obat'],
    lineColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
    hideHover: 'auto'
  });


});
