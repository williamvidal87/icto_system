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
  </style>
  <div style="width: 8in">
  
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
        <span style="font-family: serif;font-size: 12pt;text-decoration: underline;">ACCOMPLISHMENTS REPORT</span>
      </div>
      <div class="row">
        <table style="width: 8in;margin-top:10pt">
          
          <tr>
            <th style="border-width: 1px;border-color: black">Ticket</th>
            <th style="border-width: 1px;border-color: black">Request</th>
            <th style="border-width: 1px;border-color: black">Category</th>
            <th style="border-width: 1px;border-color: black">Assign Personnel</th>
            <th style="border-width: 1px;border-color: black">Client</th>
            <th style="border-width: 1px;border-color: black">Status</th>
            <th style="border-width: 1px;border-color: black">Date</th>
          </tr>
          @foreach ($WorkTicketDatabasePrint as $data)
              <tr>
                  <td style="border-width: 1px;border-color: black">{{ "TK" }}{{ 11000+$data->id }}</td>
                  <td style="border-width: 1px;border-color: black">
                      @if(!empty($data->technical_id))
                          {{ "TR" }}{{ 3300+$data->getTechnicalID->id }}
                      @endif
                      @if(!empty($data->support_id))
                          {{ "IR" }}{{ 6600+$data->getSupportID->id }}
                      @endif
                      @if(!empty($data->borrow_id))
                          {{ "BR" }}{{ 2200+$data->getBorrowID->id }}
                      @endif
                  </td>
                  <td style="border-width: 1px;border-color: black">{{ $data->getRequestCategory->request_type ?? " " }}</td>
                  <td style="border-width: 1px;border-color: black">
                      @if(!empty($data->technical_id))
                          {{ $data->getTechnicalPersonnelID->getPersonnelID->name }}
                      @endif
                      @if(!empty($data->support_id))
                          {{ $data->getSupportPersonnelID->getPersonnelID->name }}
                      @endif
                      @if(!empty($data->borrow_id))
                          {{ $data->getBorrowPersonnelID->getPersonnelID->name }}
                      @endif
                  </td>
                  <td style="border-width: 1px;border-color: black">
                      @if(!empty($data->technical_id))
                          {{ $data->getTechnicalClientID->getClientID->name }}
                      @endif
                      @if(!empty($data->support_id))
                          {{ $data->getSupportClientID->getClientID->name }}
                      @endif
                      @if(!empty($data->borrow_id))
                          {{ $data->getBorrowClientID->getClientID->name }}
                      @endif
                  </td>
                      <td style="border-width: 1px;border-color: black">
                          @if($data->status_id==2)
                              {{ $data->getStatus->status ?? " " }}
                          @endif
                          @if($data->status_id==3)
                              {{ $data->getStatus->status ?? " " }}
                          @endif
                          @if($data->status_id==4)
                              {{ $data->getStatus->status ?? " " }}
                          @endif
                          @if($data->status_id==5)
                              {{ $data->getStatus->status ?? " " }}
                          @endif
                      </td>
                      
                      <td style="border-width: 1px;border-color: black"><?php
                          
                      $date=$data->updated_at;
                      $date = new DateTime($date);
                      echo $date->format('d-m-Y');
                      ?></td>
              </tr>
          @endforeach
        </table>
      </div>
      
    </div>
    
    
  </div>
</div>