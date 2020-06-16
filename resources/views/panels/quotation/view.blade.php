@extends('panels.layouts.master')
@section('content')

<div class="row">
    <div class="col-xl-8 col-md-8 mb-4 offset-md-2">
        <div class="card card shadow">
            <h5 class="card-header">
                Quotation

                @if($quotation->status == 'active')
                <span class="badge badge-success">{{ $quotation->status }}</span>
                @elseif($quotation->status == 'withdrawn')
                <span class="badge badge-danger">{{ $quotation->status }}</span>
                @elseif($quotation->status == 'completed')
                <span class="badge badge-primary">{{ $quotation->status }}</span>
                @endif
            </h5>
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <h5> <b> Origin </b> </h5>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $quotation->origin }}" readonly
                                name="origin_city" required>
                            @error('origin_city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5> <b> Destination </b> </h5>
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $quotation->origin }}" readonly
                                name="origin_city" required>
                            @error('origin_city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01">Ready to load date</label>
                            <?php $date = Carbon\Carbon::parse($quotation->ready_to_load_date); ?>
                            <input type="text" class="form-control" name="date" value="{{ $date->format('M d Y') }}"
                                readonly />

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="transportation_type">Transportation Type</label>
                            <input type="text" class="form-control" value="{{ $quotation->transportation_type }}"
                                readonly>
                        </div>
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="transportation_type">Type of Shipment</label>
                            <input type="text" class="form-control" value="{{ $quotation->type }}" readonly>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Description of Goods </b> </h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="mr-sm-2">Value of Goods</label>
                            <input type="number" class="form-control @error('value_of_goods') is-invalid @enderror"
                                id="validationServer03" value="{{ $quotation->value_of_goods }}" readonly
                                name="value_of_goods" required>
                        </div>
                        @if($quotation->type == 'fcl')
                        <div class="row" id="for_flc">
                            <div class="col-md-5 mb-3">
                                <label class="mr-sm-2">Number of containers</label>
                                <input type="text" class="form-control @error('no_of_containers') is-invalid @enderror"
                                    id="validationServer04" value="{{ $quotation->no_of_containers }}" readonly
                                    name="no_of_containers" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="mr-sm-2">Container size</label>
                                <input type="text" class="form-control @error('no_of_containers') is-invalid @enderror"
                                    id="validationServer04" value="{{ $quotation->container_size }}" readonly
                                    name="no_of_containers" required>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing"
                                        name="isStockable" value="Yes"
                                        <?php if($quotation->isStockable == 'Yes') echo 'checked="checked"'; ?>
                                        disabled>
                                    <label class="custom-control-label" for="customControlAutosizing">Is
                                        Stockable</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing2"
                                        name="isDGR" value="Yes"
                                        <?php if($quotation->isDGR == 'Yes') echo 'checked="checked"'; ?> disabled>
                                    <label class="custom-control-label" for="customControlAutosizing2">Is
                                        DGR</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Shipment Calculations </b> </h5>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="calculate_by" value="shipment"
                                    class="custom-control-input"
                                    <?php if($quotation->calculate_by == 'shipment') echo 'checked="checked"'; ?>
                                    disabled>
                                <label class="custom-control-label" for="customRadioInline1">Calculate by total
                                    shipment</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="calculate_by" value="units"
                                    class="custom-control-input"
                                    <?php if($quotation->calculate_by == 'units') echo 'checked="checked"'; ?> disabled>
                                <label class="custom-control-label" for="customRadioInline2">Calculate by
                                    units</label>
                            </div>
                        </div>
                    </div>

                    @if($quotation->calculate_by == 'shipment')
                    <div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ $quotation->quantity }}" readonly name="quantity">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('total_weight') is-invalid @enderror"
                                    value="{{ $quotation->total_weight }}" readonly name="total_weight" required>
                            </div>
                        </div>
                    </div>
                    @elseif($quotation->calculate_by == 'units')
                    <div>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control @error('quantity_units') is-invalid @enderror"
                                    value="{{ $quotation->quantity }}" readonly name="quantity_units" required>
                                @error('quantity_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">Lenght (cm)</label>
                                <input type="number" class="form-control @error('l') is-invalid @enderror"
                                    value="{{ $quotation->l }}" readonly name="l" required>
                                @error('l')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">Width (cm)</label>
                                <input type="number" class="form-control @error('w') is-invalid @enderror"
                                    value="{{ $quotation->w }}" readonly name="w" required>
                                @error('w')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">Height (cm)</label>
                                <input type="number" class="form-control @error('h') is-invalid @enderror"
                                    value="{{ $quotation->h }}" readonly name="h" required>
                                @error('h')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Gross weight (KG)</label>
                                <input type="number"
                                    class="form-control @error('total_weight_units') is-invalid @enderror"
                                    value="{{ $quotation->total_weight }}" readonlyWeight" name="total_weight_units"
                                    disabled>
                                @error('total_weight_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    @endif

                    <hr>
                    <h5 class="mt-4"> <b> Other Info </b> </h5>
                    <div class="form-row">
                        <div class="col-md-10 mb-3">

                            <label for="exampleFormControlTextarea1">Remarks</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remarks"
                                readonly>{{ $quotation->remarks }}</textarea>
                            @error('value_of_goods')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input"
                                        <?php if($quotation->isClearanceReq == 'Yes') echo 'checked="checked"'; ?>
                                        readonly name="isClearanceReq" value="Yes">
                                    <label class="custom-control-label" for="customControlAutosizing3">Required
                                        Customs
                                        Clearance?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                @if(Auth::user()->role == 'user')
                    @if($quotation->status == 'active')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                            Withdraw Quotation
                        </button>
                    @elseif($quotation->status == 'withdrawn')
                        <p class="text-danger"> <b> You've withdrawn this quotation!</b> </p>
                    @elseif($quotation->status == 'completed')
                        <p class="text-success"> <b> This quotation has an accepeted proposal!</b> </p>
                    @endif
                @elseif(Auth::user()->role == 'vendor')
                    @if(is_offer_made(Auth::user()->id, $quotation->id))
                        <p class="text-primary"> <b> You've already sent a proposal!</b> </p> 
                    @elseif($quotation->status == 'active')
                        <a href="{{ route('proposal.make', $quotation->id) }}" class="btn btn-success">Make Offer</a>
                    @elseif($quotation->status == 'withdrawn')     
                        <p class="text-danger"> <b> The user has withdrawn this quotation!</b> </p>   
                    @elseif($quotation->status == 'completed')
                        <p class="text-success"> <b> This quotation has already been accepted!</b> </p>
                    @endif        
                @endif
            </div>
        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Withdraw <b class="text-warning"> Quotation#{{ $quotation->quotation_id }} </b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('quotation.destroy', $quotation->id ) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="_method" value="DELETE">
                    Do you want to withdraw this quotation? 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
