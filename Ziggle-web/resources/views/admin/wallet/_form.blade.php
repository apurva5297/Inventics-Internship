

<div>
<table class="table scrolldown">
				<thead>
					<tr>
						<th>ID</th>
						<th>Transaction ID</th>
						<th>Source</th>
						<th>Amount</th>
						<th>Trans. Type</th>
						<th>Status</th>
					</tr>
				</thead>
		        <tbody>
				   @foreach($transactions as $transaction)
                   <tr>
                   <td>{{$transaction->id}}</td>
                    <td>{{$transaction->transaction_id}}</td>
                    <td>{{$transaction->source}}</td>
                    <td>{{$transaction->amount}}</td>
                    @if($transaction->trans_type == 'credit')
                    <td><span class="label label-success">Credit&nbsp;<i class="fa fa-arrow-up"></i></span></td>
                    @else
                    <td><span class="label label-danger">Debit&nbsp;<i class="fa fa-arrow-down"></i></span></td>
                    @endif
                    @if($transaction->status == 'pending')
                    <td>Pending</td>
                    @else
                    <td>Approved</td>
                    @endif
                   </tr>
                   @endforeach
				</tbody>
			</table>
</div>
<style>
        table.scrolldown {
            width: 100%;
              
            /* border-collapse: collapse; */
            border-spacing: 0;
            border: 2px solid black;
        }
          
        /* To display the block as level element */
        table.scrolldown tbody, table.scrolldown thead {
            display: block;
        } 
          
        thead tr th {
            height: 40px; 
            line-height: 40px;
        }
          
        table.scrolldown tbody {
              
            /* Set the height of table body */
            height: 500px; 
              
            /* Set vertical scroll */
            overflow-y: auto;
              
            /* Hide the horizontal scroll */
            overflow-x: hidden; 
        }
          
        tbody { 
            border-top: 2px solid black;
        }
          
        tbody td, thead th {
            width : 200px;
            border-right: 1px solid black;
        }
        td {
            text-align:center;
        }
    </style>
