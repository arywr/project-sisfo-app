  <!-- Bootstrap core JavaScript-->
  <script>
    document.getElementById("sys-day").innerHTML = day();
    document.getElementById("sys-date").innerHTML = date();
    document.getElementById("sys-time").innerHTML = time();

    function day() {
      var d = new Date(),
        days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
      return days[d.getDay()];
    }

    function date() {
      var d = new Date(),
        months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
          'November', 'Desember'
        ];
      return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
    }

    function time() {
      var d = new Date(),
        minutes = d.getMinutes().toString().length == 1 ? '0' + d.getMinutes() : d.getMinutes(),
        hours = d.getHours().toString().length == 1 ? '0' + d.getHours() : d.getHours(),
        ampm = d.getHours() >= 12 ? 'PM' : 'AM';
      return hours + ':' + minutes + ' ' + ampm;
    }
  </script>
  <script src="<?= base_url('vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('js/sb-admin-2.min.js'); ?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('vendor/chart.js/Chart.min.js'); ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('js/demo/chart-area-demo.js'); ?>"></script>
  <script src="<?= base_url('js/demo/chart-pie-demo.js');?>"></script>

</body>

</html>