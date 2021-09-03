          <?php if ($this->errors->hasError()): ?>
          <div class="col-md-6">
            <div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <ul>
                    <?php foreach ($this->errors->all() as $e): ?>
                      <li><?= $e ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php endif; ?>

          <?php if (Fantom\Session::hasFlash('error')): ?>
            <div class="col-md-6">
              <div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?= Fantom\Session::flash('error') ?>
                </div>
              </div>
          </div>
          <?php endif; ?>
          <?php if (Fantom\Session::hasFlash('success')): ?>
            <div class="col-md-">
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?= Fantom\Session::flash('success') ?>
                </div>
              </div>
          </div>
          <?php endif; ?>