<style>
.toggle-handle {
    background-color: white;
}
</style>

<!-- ======= Team Section ======= -->
<section id="team" class="team mt-5 mb-0">

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Monitoring</h2>
            <p>Monitor Komponen SIPH</p>
        </header>

        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Komponen</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Katup</td>
                <td>
                    <input type="checkbox" <?= ($components['katup'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <td>Pompa</td>
                <td>
                    <input type="checkbox" <?= ($components['lampu'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <td>Lampu</td>
                <td>
                    <input type="checkbox" <?= ($components['pompa'] == 1) ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
        </tbody>
        </table>
    </div>

</section><!-- End Team Section -->

<!-- ======= Counts Section ======= -->
<div id="counts" class="counts mt-0 pt-0">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-4">
            <div class="count-box">
              <i class="bi bi-water"></i>
              <div>
                <span><?= $components['ultrasonik'] ?> cm</span>
                <p>Ketinggian Air</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="count-box">
              <i class="bi bi-percent" style="color: #ee6c20;"></i>
              <div>
                <span><?= $components['soilMoisture'] ?>%</span>
                <p>Kelembaban Tanah</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="count-box">
              <i class="bi bi-lightbulb" style="color: #15be56;"></i>
              <div>
                <span><?= $components['durasiLampu'] ?> jam</span>
                <p>Durasi Lampu Menyala</p>
              </div>
            </div>
          </div>

        </div>

      </div>
</div><!-- End Counts Section -->