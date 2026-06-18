// Default font SB Admin
Chart.defaults.global.defaultFontFamily =
  'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Ambil data dari atribut canvas
var ctxCanvas = document.getElementById("myPieChart");

var jumlahMasuk   = ctxCanvas.getAttribute('data-masuk');
var jumlahProses  = ctxCanvas.getAttribute('data-proses');
var jumlahSelesai = ctxCanvas.getAttribute('data-selesai');

// Pie Chart
var myPieChart = new Chart(ctxCanvas, {
  type: 'doughnut',
  data: {
    labels: ["Masuk", "Proses", "Selesai"],
    datasets: [{
      data: [jumlahMasuk, jumlahProses, jumlahSelesai],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
