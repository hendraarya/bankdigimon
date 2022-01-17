@extends('mainadmin')

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="card-title mb-0">Report Log Planning Rubber</h6>
    </div>
    <div class="card-body">
        <form method="post" id="form-report">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="sel1">Select Machine:</label>
                    <select class="form-control mr-2" id="log_planning" name="log_planning">
                        <option value="kn45l1">KN-45L-1</option>
                        <option value="kn45l2">KN-45L-2</option>
                        <option value="kn45l5">KN-45L-5</option>
                        <option value="kn20l3">KN-20L-3</option>
                        <option value="kn20l4">KN-20L-4</option>
                    </select>
                </div>

            </div>
            @csrf
            <div class="row">
                <div class="col-md-10 col-lg-7 col-xs-12">
                    <div class="d-flex align-items-center">
                        <label class="mr-3">Periode</label>
                        <input type="text" name="date_from" id="date_from" class="form-control mr-3">
                        <div class="mr-3">s/d</div>
                        <input type="text" name="date_to" id="date_to" class="form-control mr-3">
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-success mr-2" id="btn-excel">Export Excel</button>
                        <button type="button" class="btn btn-danger" id="btn-pdf">Export PDF</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

<script>
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
				url: '{{ url('report-log-planningrb/excel') }}',
				type: 'post',
				data: {
					date_from: $('#date_from').val(),
					date_to: $('#date_to').val(),
                    log_planning: $('#log_planning').val()
				},
				xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                	let date = date_format(new Date());
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = 'Log Machine ' + date + '.xlsx';
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
				url: '{{ url('report-log-planningrb/pdf') }}',
				type: 'post',
				data: {
					date_from: $('#date_from').val(),
					date_to: $('#date_to').val(),
                    log_planning: $('#log_planning').val()
				},
				xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                	let date = date_format(new Date());
                    a.href = url;
                    a.download = 'Log Machine ' + date + '.pdf';
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