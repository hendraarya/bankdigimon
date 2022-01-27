@extends('mainadmin')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <h6 class="card-title mb-0">Download Report WR Online</h6>
    </div>
    <div class="card-body">
        <form method="post" id="form-report">
            @csrf
            <div class="row">
                <div class="col-md-10 col-lg-7 col-xs-12">
                    <div class="d-flex align-items-center">
                        <label class="mr-3">Periode</label>
                        <input type="text" name="date_from" id="date_from" class="form-control mr-3">
                        <div class="mr-3">s/d</div>
                        <input type="text" name="date_to" id="date_to" class="form-control mr-3">
                        <button type="button" class="btn btn-success mr-3 w-50" id="btn-excel">Export Excel</button>
                        <button type="button" class="btn btn-danger mr-3 w-50" id="btn-pdf">Export PDF</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>WR ID</th>
                <th>Machine No</th>
                <th>Machine Name</th>
                <th>Failure Date</th>
                <th>Failure Time</th>
                <th>Problem</th>
                <th>Type</th>
                <th>Urgency</th>
                <th>Priority</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($data as $row)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $row->swr }}</td>
                <td>{{ $row->smach}}</td>
                <td>{{ $row->smachname}}</td>
                <td>{{ $row->drepair }}</td>
                <td>{{ $row->trepair}}</td>
                <td>{{ $row->sproblem }}</td>
                <td>{{ $row->stype }}</td>
                <td>{{ $row->surgency }}</td>
                <td>{{ $row->spriority }}</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>

@endsection

@section('script')

<script>
	$(document).ready(function() {
    $('#example').DataTable();
   
 });

 function date_format(datetime) {
        let ta = new Date(datetime);
        let month = (1 + ta.getMonth()).toString();
        let mta = month.length > 1 ? month : '0' + month;
        let date = ta.getDate().toString();
        let tgl = date.length > 1 ? date : '0' + date;
        if(ta.getFullYear() == '1900') {
        	return '';
        }
        return  tgl + '-' + mta + '-' + ta.getFullYear();
    }

	$(document).ready(function() {
		$('#date_from, #date_to').datepicker({
			  dateFormat: "dd/mm/yy"
		});

		$('#btn-excel').on('click', function() {

			$.ajax({
				url: '{{ url('bankwronline/report/excel') }}',
				type: 'post',
				data: {
					date_from: $('#date_from').val(),
					date_to: $('#date_to').val(),
				},
				xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                	let date = date_format(new Date());
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = 'Data WR Online' + date + '.xlsx';
                    document.body.append(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                },
                error: function(xhr, stat, err) {
                	console.log(err);
                }
			});

		});


		// Btn pdf 
		$('#btn-pdf').on('click', function() {

			$.ajax({
				url: '{{ url('bankwronline/report/pdf') }}',
				type: 'post',
				data: {
					date_from: $('#date_from').val(),
					date_to: $('#date_to').val(),
				},
				xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                	let date = date_format(new Date());
                    a.href = url;
                    a.download = 'Data WR Online ' + date + '.pdf';
                    document.body.append(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                },
                error: function(xhr, stat, err) {
                	console.log(err);
                }
			});

		});

	});
</script>
@endsection