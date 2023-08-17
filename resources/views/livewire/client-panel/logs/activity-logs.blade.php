<div>
  <section class="content-header">
      <div class="container-fluid">
        <div class="mb-2 row">
          <div class="col-sm-6">
            <h1>Activity Log History</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
            <br>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="ActivityLogTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Activity</th>
                    <th>Date Time</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($Activty_Logs as $data)
                      <tr>
                        <td>{{ $data->activity }}</td>
                        <td>{{ $data->created_at->format('d/m/y h:i A') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>
@section('custom_script')
  @include('layouts.scripts.activity-log-scripts'); 
@endsection
