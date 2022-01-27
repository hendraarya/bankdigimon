@extends('mainadmin')

@section('content')


<div class="row mb-3">
    <div class="col-md-2">
        <label for="sel1">Select Machine:</label>
        <select class="form-control mr-2" id="table-db" name="table-db">
            <option value="LogPlanningRb45l1">KN-45L-1</option>
            <option value="LogPlanningRb45l2">KN-45L-2</option>
            <option value="LogPlanningRb45l5">KN-45L-5</option>
            <option value="LogPlanningRb20l3">KN-20L-3</option>
            <option value="LogPlanningRb20l4">KN-20L-4</option>
        </select>
    </div>
</div>

<table id="table-DB" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
    <!-- <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Plan</th>
            <th>Rubber Name</th>
            <th>Batch No</th>
            <th>Start Mixing</th>
            <th>Finish Mixing</th>
            <th>Start Mixing System</th>
            <th>Finish Mixing System</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody> -->
    
</table>

@endsection

@section('script')

<script>

    function getData() {
        $.ajax({
            url: '{{ url('bankrubber/get-list-data') }}',
            type: 'post',
            data: {
                jenis_table: $('#table-db').val()
            },
            success: function(response) {
                console.log(response);

                let tableHtml = `
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Plan</th>
                                    <th>Rubber Name</th>
                                    <th>Batch No</th>
                                    <th>Start Mixing</th>
                                    <th>Finish Mixing</th>
                                    <th>Start Mixing System</th>
                                    <th>Finish Mixing System</th>
                                </tr>
                            </thead>
                            <tbody>`;
                
                let no = 1;

                for (let i = 0; i < response.length; i++) {
                    tableHtml += `
                        <tr>
                            <td>${ no++ }</td>
                            <td>${ response[i].tgl_plan }</td>
                            <td>${ response[i].rubber_name }</td>
                            <td>${ response[i].batch_no }</td>
                            <td>${ response[i].start_mixing }</td>
                            <td>${ response[i].finish_mixing }</td>
                            <td>${ response[i].start_mixingsys }</td>
                            <td>${ response[i].finish_mixingsys }</td>
                        </tr>
                    `;
                }

                tableHtml += '</tbody></table>';

                $('#table-DB').html(tableHtml);

                $('#table-DB').DataTable({
                    destroy: true,
                    scrollX: true,
                    scrollY: '500px',
                    scrollCollapse: true
                })

            },
            error: function(xhr, stat, err) {
                console.log(err);
            }
        });
    }

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // pertama kali di load panggil fungsi getData diatas 
        getData();

        // tinggal kasih laoding aja man pas get data 

        $('#table-db').on('change',function(){
            getData();              
        })

    });
    // $(document).ready(function () { 
    //     $('#tableDB').DataTable();
    //     changeTableDatabase($('#table-db').val());
    // });

    // function changeTableDatabase(tablename){
    //     $.ajax({
    //         url: 'http://10.202.10.42:8002/api/getData/' + tablename,
    //         type: 'get',
    //         success: function(result){
    //             var html = `
    //             <thead>
    //                <tr>
    //                   <th>No</th>
    //                   <th>Tanggal Plan</th>
    //                   <th>Rubber Name</th>
    //                   <th>Batch No</th>
    //                   <th>Start Mixing</th>
    //                   <th>Finish Mixing</th>
    //                   <th>Start Mixing System</th>
    //                   <th>Finish Mixing System</th>
    //                </tr>
    //             </thead>
    //          <tbody>`;

    //          result.data.forEach(function(d,i){
    //             html = html +
    //                         `<tr>
    //                             <td>` + d.idplan + `</td>
    //                             <td>` + d.tgl_plan + `</td>
    //                             <td>` + d.rubber_name + `</td>
    //                             <td>` + d.batch_no + `</td>
    //                             <td>` + d.start_mixing+ `</td>
    //                             <td>` + d.finish_mixing+ `</td>
    //                             <td>` + d.start_mixingsys+ `</td>
    //                             <td>` + d.finish_mixingsys+ `</td>
    //                         <tr>`;
    //          })

    //          html = html + `</tbody>`;
    //          $('#tableDB').html(html);
    //         },
    //         error: function(xhr, stat, err) {
    //                     console.log(err);
    //                 }
    //     });
    // }

</script>
@endsection
