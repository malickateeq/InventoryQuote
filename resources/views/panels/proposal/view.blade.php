@extends('panels.layouts.master')
@section('content')

<div class="row">
    <div class="col-xl-8 col-md-8 mb-4 offset-md-2">
        <div class="card card shadow">
            <h5 class="card-header">Proposal for <b class="text-warning">quotation#{{ $proposal->quotation->quotation_id }} </b> </h5>
            <div class="card-body">
                <form>
                    <h5> <b> Proposal Specifications </b> </h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for=""> Actual Local Charges (USD) </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->local_charges }}$" readonly
                                name="local_charges" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""> Freight Charges (USD) </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->freight_charges }}$" readonly
                                name="freight_charges" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for=""> Destination Local Charges (USD) </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->destination_local_charges }}$" readonly
                                name="destination_local_charges" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""> Customs Clearance Charges (USD) </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->customs_clearance_charges }}$" readonly
                                name="customs_clearance_charges" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for=""> Subtotal (USD) </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->total }}$" readonly
                                name="total" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01">Ready to load date</label>
                            <?php $date = Carbon\Carbon::parse($proposal->valid_till); ?>
                            <input type="text" class="form-control" name="date" value="{{ $date->format('M d Y') }}"
                                readonly />

                        </div>
                    </div>

                    <h5> <b> Vendor Details </b> </h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for=""> Vendor Name: </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->vendor->name }}" readonly
                                name="local_charges" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""> Vendor Phone: </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->vendor->phone }}" readonly
                                name="freight_charges" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for=""> Vendor Email: </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->vendor->email }}" readonly
                                name="local_charges" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""> Vendor Additional Email: </label>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $proposal->vendor->additional_email }}" readonly
                                name="freight_charges" required>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Other Info </b> </h5>
                    <div class="form-row">
                        <div class="col-md-10 mb-3">

                            <label for="exampleFormControlTextarea1">Remarks</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="remarks" readonly>{{ $proposal->remarks }}</textarea>
                        </div>
                    </div>
                    
                </form>
                @if(Auth::user()->role == 'user')
                <a href="{{ route('proposal.accept', $proposal->id) }}" class="btn btn-success">Accept Proposal</a>
                @elseif(Auth::user()->role == 'vendor')
                <a href="{{ route('proposal.make', $proposal->id) }}" class="btn btn-danger">Withdraw Proposal</a>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection