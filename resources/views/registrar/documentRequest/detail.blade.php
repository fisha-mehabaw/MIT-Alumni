@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Document Requests
        <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('documentRequests') }}">Document Request</a></li>
        </ol>
    </section>
    

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">Document Request Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Programme:</th>
                            <td width=65%>{{ $documentRequest->programme }}</td>
                        </tr>

                        <tr>
                            <th>Request Type:</th>
                            <td>{{ $documentRequest->request_type }}</td>
                        </tr>

                        <tr>
                            <th>Status:</th>
                            <td>
                                {{ $documentRequest->status }} &nbsp;&nbsp;
                                <a href="#" data-toggle="modal" data-target="#changeStatus"> Change Response</a> 
                            </td>
                        </tr>

                        @if($documentRequest->status == "Rejected")
                            <tr>
                                <th>Rejection Reason:</th>
                                <td>{{ $documentRequest->rejectionReason }}</td>
                            </tr>
                        @endif

                        @if($documentRequest->status == "Finished")
                            <tr>
                                <th>Traking Number:</th>
                                <td>{{ $documentRequest->traking_number }}</td>
                            </tr>
                        @endif
                        
                        <tr>
                            <th>Request Date:</th>
                            <td>{{ $documentRequest->request_date }}</td>
                        </tr>
                        
                        <tr>
                            <th>Destination Address Institute/University/Organization:</th>
                            <td>{{ $documentRequest->address_name }}</td>
                        </tr>
                        
                        <tr>
                            <th>P.o.Box:</th>
                            <td>{{ $documentRequest->address_pobox }}</td>
                        </tr>

                        <tr>
                            <th>Town:</th>
                            <td>{{ $documentRequest->address_town }}</td>
                        </tr>
                        
                        <tr>
                            <th>Region/State:</th>
                            <td>{{ $documentRequest->address_region }}</td>
                        </tr>

                        <tr>
                            <th>Country:</th>
                            <td>{{ $documentRequest->address_country }}</td>
                        </tr>
                
                    </table>

                    <div class="modal fade" id="changeStatus">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change Document Request Staus</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('documentRequest.status') }}" data-toggle="validator">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{ $documentRequest->id}}">

                                    <div class="form-group">
                                        <label for="Response">Response</label>
                                        <select name="status" class="form-control" id="responseStatus" required>
                                            <option value="">~Select Response Status~</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Finished">Finished</option>
                                        </select>
                                    </div>

                                    <div id="display"></div>

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn"> Change </button>
                                </form>
                            </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>

<script type="text/javascript" id="myHtml">
    function show_selected() 
    {
        var d = document.getElementById('responseStatus');
        var selectedValue = d.options[d.selectedIndex].value

        if (selectedValue == "Rejected") 
        {
            document.getElementById('display').innerHTML = `
                <div class="form-group">
                    <label for="rejectionReason"><strong>Rejection Reason: </strong></label>
                    <textarea class="form-control rounded-0" rows="3" name="reasonForRejection" Required></textarea>
                </div>
            `
        }


        else if (selectedValue == "Finished") 
        {
            document.getElementById('display').innerHTML = `
                <div class="form-group">
                    <label for="trakingNumber"><strong>Traking Number: </strong></label>
                    <input type="text" class="form-control" name="traking_number">  
                </div>
            `
        }

        else { document.getElementById('display').innerHTML = "" }
    }

    document.getElementById('responseStatus').addEventListener('click', show_selected)
</script>
@endsection
