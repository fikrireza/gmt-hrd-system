$(function () {

  'use strict';

  var bar = new Morris.Bar({
    element: 'pengaduan-warga-tahun',
    resize: true,
    data: [
      {y: '2012', a: 312, b: 267 , c: 45},
      {y: '2013', a: 324, b: 296, c: 28},
      {y: '2014', a: 235, b: 200, c: 35},
      {y: '2016', a: 346, b: 281, c: 65},
      {y: '2017', a: 0, b: 0, c: 0}
    ],
    barColors: ['#605CA8', '#00C0EF', '#DD4B39'],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Jumlah Pengaduan', 'Sudah Ditanggapi', 'Belum Ditanggapi'],
    hideHover: 'auto'
  });

  var area = new Morris.Area({
    element: 'pengaduan-warga-SKPD-Belum-Ditanggapi',
    data: [
      { y: '2015-01', a: 5,  b: 4, c: 4, d: 6, e: 8 },
      { y: '2015-02', a: 6,  b: 5, c: 6, d: 2, e: 3  },
      { y: '2015-03', a: 3,  b: 7, c: 8, d: 2, e: 6  },
      { y: '2015-04', a: 5,  b: 8, c: 2, d: 3, e: 4  },
      { y: '2015-05', a: 3,  b: 2, c: 5, d: 6, e: 6  },
      { y: '2015-06', a: 2,  b: 4, c: 4, d: 8, e: 7  }
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c', 'd', 'e'],
    labels: ['SKPD Kesehatan', 'SKPD Pendidikan', 'SKPD Perhubungan', 'SKPD Keuangan', 'SPKD  Teknologi'],
    lineColors: ['#605ca8', '#00a65a', '#3c8dbc', '#f39c12', '#D81B60'],
    hideHover: 'auto'
  });


  var area = new Morris.Area({
    element: 'pengaduan-warga-SKPD-Sudah-Ditanggapi',
    data: [
      { y: '2015-01', a: 4, b: 3, c: 2, d: 6, e: 8 },
      { y: '2015-02', a: 5,  b: 6, c: 8, d: 2, e: 3  },
      { y: '2015-03', a: 5,  b: 2, c: 9, d: 5, e: 6  },
      { y: '2015-04', a: 4,  b: 2, c: 3, d: 5, e: 8  },
      { y: '2015-05', a: 7,  b: 7, c: 2, d: 8, e: 5  },
      { y: '2015-06', a: 9,  b: 3, c: 7, d: 1, e: 2  }
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c', 'd', 'e'],
    labels: ['SKPD Kesehatan', 'SKPD Pendidikan', 'SKPD Perhubungan', 'SKPD Keuangan', 'SPKD  Teknologi'],
    lineColors: ['#605ca8', '#00a65a', '#3c8dbc', '#f39c12', '#D81B60'],
    hideHover: 'auto'
  });

});
