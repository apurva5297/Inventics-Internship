

<div>

<table class="table scrolldown" style="width:100%">
  @if($bank_detail != null)
  
    <tr>
    <th>Account Number:</th>
    <td>{{ $bank_detail->account_no }}</td>
  </tr>
  <tr>
    <th>Account Holder Name:</th>
    <td>{{ $bank_detail->account_holder_name }}</td>
  </tr>
  <tr>
    <th>Bank Name:</th>
    <td>{{ $bank_detail->bank_name }}</td>
  </tr>
  <tr>
    <th>Branch Name:</th>
    <td>{{ $bank_detail->branch_name }}</td>
  </tr>
  <tr>
    <th>IFSC Code:</th>
    <td>{{ $bank_detail->ifsc_code }}</td>
  </tr>
  <tr>
    <th>Check Image:</th>
    <td><img src="{{ asset('images/'.$bank_detail->image) }}" height="150px" width="300px" alt="{{ $bank_detail->image }}">
</td>
  </tr>
  
  @else
  
        <p style="text-align:center;">No Bank Details</p>
  
  @endif
  
  
</table>
</div>
