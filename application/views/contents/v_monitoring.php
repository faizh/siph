<style>
.toggle-handle {
    background-color: white;
}

.title h4 {
  font-weight: 700;
  margin-bottom: 5px;
  font-size: 20px;
  color: #012970;
  text-align: center;
}
</style>

<!-- ======= Team Section ======= -->
<section id="team" class="team mt-5 mb-0">

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Monitoring</h2>
            <p>Monitor Komponen SIPH</p>
        </header>

        <div class="title">
          <h4>Sistem Monitoring</h4>
        </div>

        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Komponen</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                  <a href="#!" style="color: inherit" onclick="toogleComponents()">Sistem Irigasi <i id="dropdown-icon" class="bi bi-chevron-down"></i></a>
                </td>
                <td>
                    <input type="checkbox" <?= ($components['status_irigasi'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" onchange="updateKatup(this)" disabled>
                </td>
            </tr>
            <tr class="sistem-irigasi" hidden="hidden">
                <td>Sistem Irigasi <b>(Valve In)</b></td>
                <td>
                    <input type="checkbox" <?= ($components['katup_in'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" onchange="updateKatup(this)" disabled>
                </td>
            </tr>
            <tr class="sistem-irigasi" hidden="hidden">
                <td>Sistem Irigasi <b>(Valve Out)</b></td>
                <td>
                    <input type="checkbox" <?= ($components['katup_out'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" onchange="updateKatup(this)" disabled>
                </td>
            </tr>
            <tr>
                <td>Pompa Penyiraman</td>
                <td>
                    <input type="checkbox" <?= ($components['pompa'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" onchange="updatePompa(this)" disabled>
                </td>
            </tr>
            <tr>
                <td>Lampu</td>
                <td>
                    <input type="checkbox" <?= ($components['lampu'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" onchange="updateLampu(this)" disabled>
                </td>
            </tr>
        </tbody>
        </table>
    </div>

</section><!-- End Team Section -->

<!-- ======= Counts Section ======= -->
<div id="counts" class="counts mt-0 pt-0">
      <div class="container" data-aos="fade-up">
        <div class="title">
          <h4>Data Realtime Sensor</h4>
        </div>

        <div class="row gy-4">
          <div class="col-lg-3 col-md-3">
            <div class="count-box">
              <i class="bi bi-water"></i>
              <div>
                <span><?= $components['ultrasonik'] ?> cm</span>
                <p>Ketinggian Air</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3">
            <div class="count-box">
              <i class="bi bi-percent" style="color: #ee6c20;"></i>
              <div>
                <span><?= $components['soilMoisture1'] ?>%</span>
                <p>Kelembaban Tanah 1</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3">
            <div class="count-box">
              <i class="bi bi-percent" style="color: #ee6c20;"></i>
              <div>
                <span><?= $components['soilMoisture2'] ?>%</span>
                <p>Kelembaban Tanah 2</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3">
            <div class="count-box">
              <i class="bi bi-lightbulb" style="color: #15be56;"></i>
              <div>
                <!-- <span style="font-size: 30px;"><?= $components['durasiLampu'] ?></span>
                <p>Durasi Lampu Menyala</p> -->
                <span><?= $components['ldr'] == 0 ? 'Siang' : 'Malam' ?></span>
                <p>Sensor LDR</p>
              </div>
            </div>
          </div>

        </div>

      </div>
</div><!-- End Counts Section -->

<section id="team" class="team mb-0">
  <div class="container" data-aos="fade-up">
    <div class="title">
      <h4>Data Grafik</h4>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="p-2">
          <canvas id="kelembaban-tanah-1"></canvas>
        </div>
      </div>

      <div class="col-6">
        <div class="p-2">
          <canvas id="kelembaban-tanah-2"></canvas>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-6">
        <div class="p-2">
          <canvas id="ketinggian-air"></canvas>
        </div>
      </div>

      <div class="col-6">
        <div class="p-2">
          <canvas id="intensitas-cahaya"></canvas>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('kelembaban-tanah-1');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: [<?php echo '"'.implode('","', $graph['tanah1Times']).'"' ?>],
      datasets: [{
        label: 'Kelembaban Tanah 1',
        data: [<?php echo implode(',', $graph['tanah1Status']) ?>],
        borderWidth: 1
      }]
    },
  });

  const ctx2 = document.getElementById('kelembaban-tanah-2');
  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: [<?php echo '"'.implode('","', $graph['tanah2Times']).'"' ?>],
      datasets: [{
        label: 'Kelembaban Tanah 2',
        data: [<?php echo implode(',', $graph['tanah2Status']) ?>],
        borderWidth: 1
      }]
    },
  });

  const ctx3 = document.getElementById('ketinggian-air');
  new Chart(ctx3, {
    type: 'line',
    data: {
      labels: [<?php echo '"'.implode('","', $graph['ketinggianAirTimes']).'"' ?>],
      datasets: [{
        label: 'Ketinggian Air',
        data: [<?php echo implode(',', $graph['ketinggianAirStatus']) ?>],
        borderWidth: 1
      }]
    },
  });

  const ctx4 = document.getElementById('intensitas-cahaya');
  new Chart(ctx4, {
    type: 'line',
    data: {
      labels: [<?php echo '"'.implode('","', $graph['intensitasCahayaTimes']).'"' ?>],
      datasets: [{
        label: 'Intensitas Cahaya',
        data: [<?php echo implode(',', $graph['intensitasCahayaStatus']) ?>],
        borderWidth: 1
      }]
    },
  });
</script>

<script>
  function updateKatup(katup) {
    katup.disabled = true;
    var status;

    if (katup.checked) {
      status = 'on';
    }else{
      status = 'off';
    }

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url("index.php/api/update_status_katup")?>',
      async:false,
      cache: false,
      data:{ status: status },
      dataType: 'html',
      success: function(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data['status'] == true) {
          alert(data.msg);
        }else {
          alert(data.msg);
        }

        katup.disabled = false;
      },

    });
  }

  function updatePompa(pompa) {
    pompa.disabled = true;
    var status;

    if (pompa.checked) {
      status = 'on';
    }else{
      status = 'off';
    }

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url("index.php/api/update_status_pompa")?>',
      async:false,
      cache: false,
      data:{ status: status },
      dataType: 'html',
      success: function(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data['status'] == true) {
          alert(data.msg);
        }else {
          alert(data.msg);
        }

        pompa.disabled = false;
      },

    });
  }

  function updateLampu(lampu) {
    lampu.disabled = true;
    var status;

    if (lampu.checked) {
      status = 'on';
    }else{
      status = 'off';
    }

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url("index.php/api/update_status_lampu")?>',
      async:false,
      cache: false,
      data:{ status: status },
      dataType: 'html',
      success: function(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data['status'] == true) {
          alert(data.msg);
        }else {
          alert(data.msg);
        }

        lampu.disabled = false;
      },

    });
  }
  
  function toogleComponents() {
    $('.sistem-irigasi').each(function(i, obj) {
        let hidden = obj.getAttribute("hidden");

        if (hidden) {
          obj.removeAttribute("hidden");
        } else {
          obj.setAttribute("hidden", "hidden");
        }
    });

    var dropdown_icon =document.getElementById("dropdown-icon");
    if ( dropdown_icon.classList.contains('bi-chevron-down') ) {
      dropdown_icon.classList.remove('bi-chevron-down');
      dropdown_icon.classList.add('bi-chevron-up');
    } else {
      dropdown_icon.classList.remove('bi-chevron-up');
      dropdown_icon.classList.add('bi-chevron-down');
    }
  }
</script>