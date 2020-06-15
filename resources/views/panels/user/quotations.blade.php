@extends('panels.user.master')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Quotations</h1>
        <a href="{{ route('quotation.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Quotation
        </a>
    </div>
    <p class="mb-4"> View status of your quotations.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quotations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="quotations_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Route</th>
                            <th>Transportation Type</th>
                            <th>Ready to load</th>
                            <th>Worth</th>
                            <th>Gross Weight</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <!-- <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        @foreach($quotations as $quotation)
                        <tr>
                            <td> <b>{{ $quotation->quotation_id }} </b> </td>
                            <td> 
                                <span class="text-success">{{ $quotation->origin }}</span>  
                                to 
                                <span class="text-danger">{{ $quotation->destination }}</span>
                            </td>
                            <td>{{ $quotation->transportation_type }} ({{ $quotation->type }})</td>
                            <td>
                                <?php
                                    $date = Carbon\Carbon::parse($quotation->ready_to_load_date);
                                    echo $date->format('M d Y');
                                ?>
                            </td>
                            <td>{{ $quotation->value_of_goods }} $</td>
                            <td>{{ $quotation->total_weight }} KG</td>
                            <td>{{ $quotation->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


@section('bottom_scripts')
<script>
    $(document).ready( function () {
        $('#quotations_table').DataTable();
    });
</script>
@endsection