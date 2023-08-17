<div>
  <style>
    *{
      font-size: 11pt;
      font-family: Arial, Helvetica, sans-serif;
    }
    .column {
      float: left;
      padding: 10px;
    }
    
    .left, .right {
      width: 25%;
    }
    
    .middle {
      width: 50%;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    @page { 
      margin-top: 0.25in;
      margin-left: 0.25in;
      margin-bottom: 0.15in;
    }
    /* img {
    margin:0px;padding:0px
    } */
    
    /* .header,
    .footer {
        width: 100%;
        text-align: center;
        position: fixed;
    }
    .header {
        top: 0px;
    }
    .footer {
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    } */
    
  </style>
  
  {{-- for header all --}}
  {{-- <div class="header">
    Page <span class="pagenum"></span>
  </div> --}}
  
  <div style="width: 8in;">
  
    <div class="row">
      <div class="column left">
        <img src="image/logo/norsu2.png" alt="Norsu" height="90" width="90" style="float: right;position: fixed;">
      </div>
      <div class="column middle" style="line-height: 1.6;">
          <p style="text-align: center;position: fixed;margin-top:0pt">
          Republic of the Philippines
          <br><span style="font-family: serif;font-size: 12pt;font-weight: bold;">NEGROS ORIENTAL STATE UNIVERSITY</span>
          <br>Guihulngan Campus
          <br>Information Communication Technology Office Support
          </p>
      </div>
      <div class="column right">
      </div>
    </div>
    
    <div style="margin-top: 85pt;width: 8in">
    
      <div class="row" style="text-align: center;">
        <span style="font-family: serif;font-size: 12pt;text-decoration: underline;">INVENTORY REPORT</span>
      </div>
      <div class="row">
        <table style="width: 8in;margin-top:10pt">
          <tr>
            <th>Device ID</th>
            <th>Device Name</th> 
            <th>Property No</th> 
            <th>Serial No</th> 
            <th>Date</th> 
            <th>Client Assign</th> 
            <th>Status</th>
          </tr>
          @foreach ($Inventory_Equipment_Print as $data)
              <tr>
                  <td>{{ "DE" }}{{ 1002039200+$data->id }}</td>
                  <td>{{ $data->device_name }}</td>
                  <td>{{ $data->property_no ?? "none" }}</td>
                  <td>{{ $data->serial_no ?? "none" }}</td>
                  <td><?php
                          
                      $date=$data->updated_at;
                      $date = new DateTime($date);
                      echo $date->format('d/m/Y');
                      ?></td>
                  <td>{{ $data->getClient->name ?? "none" }}</td>
                  <td>
                      @if($data->status_id!=1)
                          @if($data->status_id==6)
                            {{ $data->getStatus->status ?? " " }}
                          @endif
                          @if($data->status_id==7)
                            {{ $data->getStatus->status ?? " " }}
                          @endif
                          @if($data->status_id==8)
                            {{ $data->getStatus->status ?? " " }}
                          @endif
                      @endif
                  </td>
              </tr>
          @endforeach
        </table>
      </div>
      
    </div>
    
    
  </div>
  
  {{-- for footer all --}}
{{-- <div class="footer">
  Page <span class="pagenum"></span>
</div> --}}


</div>