@extends('mainadmin')

@section('content')


<form method="post" id="form-report">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="sel1">Select Machine:</label>
                    <select class="form-control mr-2" id="selectId" name="selectId">
                        <option value="kn45l1">KN-45L-1</option>
                        <option value="kn45l2">KN-45L-2</option>
                        <option value="kn45l5">KN-45L-5</option>
                        <option value="kn20l3">KN-20L-3</option>
                        <option value="kn20l4">KN-20L-4</option>
                    </select>
                    
                </div>
                <button type="button" class="btn btn-success mr-5 mt-1" id="btn-load">Load</button>
            </div>
        </form>

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

    $('#selectId').on('change',function(){

        //SelectID
        var id = $(this).val();

        //AJAX request
        $.ajax({
            url: 'viewdataplan'+id,
            type:'get',
            dataType:'json',
            success:function(data){
               
            }
        })

    });
   
 });
</script>
@endsection