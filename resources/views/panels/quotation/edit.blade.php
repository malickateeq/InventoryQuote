@extends('panels.user.master')
@section('content')


<div class="row">
    <div class="col-xl-8 col-md-8 mb-4 offset-md-2">
        <div class="card card shadow">
            <h5 class="card-header">Quotation</h5>
            <div class="card-body">

                <form action="{{ route('quotation.update', $quotation->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <h5> <b> Origin </b> </h5>
                            <input type="text" class="form-control @error('origin') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $quotation->origin }}"
                                name="origin" required>
                            @error('origin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5> <b> Destination </b> </h5>
                            <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ $quotation->destination }}"
                                name="destination" required>
                            @error('destination')
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
                            <input type="text" class="form-control" name="ready_to_load_date" value="{{ $date->format('d-m-Y') }}" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="transportation_type">Transportation Type</label>
                            <select class="custom-select mr-sm-2" id="transportation_type"
                                name="transportation_type">
                                <option selected="">Choose...</option>
                                <option value="ocean" <?php echo ($quotation->transportation_type == 'ocean') ? 'selected="selected"' : ''; ?> >Ocean Freight</option>
                                <option value="air" <?php echo ($quotation->transportation_type == 'air') ? 'selected="selected"' : ''; ?>>Air Freight</option>
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Type of Shipment</label>
                            <select class="custom-select mr-sm-2" id="type_of_shipment" name="type">
                                <option selected="">Choose...</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Description of Goods </b> </h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <input type="number" class="form-control @error('value_of_goods') is-invalid @enderror"
                                value="{{ $quotation->value_of_goods }}" placeholder="Value of Goods (USD)" name="value_of_goods"
                                required>
                            @error('value_of_goods')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row" id="for_flc">
                            <div class="col-md-5 mb-3">
                                <input type="text" class="form-control @error('no_of_containers') is-invalid @enderror"
                                value="{{ $quotation->no_of_containers }}" placeholder="No of containers" name="no_of_containers">
                                @error('no_of_containers')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-5 mb-3">
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="container_size">
                                    <option>Container size</option>
                                    <option value="20f" <?php echo ($quotation->transportation_type == '20f') ? 'selected="selected"' : ''; ?> >20ft</option>
                                    <option value="40f"<?php echo ($quotation->transportation_type == '40f') ? 'selected="selected"' : ''; ?> >40ft</option>
                                    <option value="40f_hc"<?php echo ($quotation->transportation_type == '40f_hc') ? 'selected="selected"' : ''; ?> >40ft HC</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing"
                                        name="isStockable" value="Yes" <?php if($quotation->isStockable == 'Yes') echo 'checked="checked"'; ?>>
                                    <label class="custom-control-label" for="customControlAutosizing">Is
                                        Stockable</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing2"
                                        name="isDGR" value="Yes" <?php if($quotation->isDGR == 'Yes') echo 'checked="checked"'; ?>>
                                    <label class="custom-control-label" for="customControlAutosizing2">Is DGR</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Shipment Calculations </b> </h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="calculate_by" value="shipment"
                                    class="custom-control-input" <?php if($quotation->calculate_by == 'shipment') echo 'checked="checked"'; ?>>
                                <label class="custom-control-label" for="customRadioInline1">Calculate by total
                                    shipment</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="calculate_by" value="units"
                                    class="custom-control-input" <?php if($quotation->calculate_by == 'units') echo 'checked="checked"'; ?>>
                                <label class="custom-control-label" for="customRadioInline2">Calculate by units</label>
                            </div>
                        </div>
                    </div>

                    <div id="shipment">
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ $quotation->quantity }}" placeholder="Quantity" name="quantity" required>
                                @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('total_weight') is-invalid @enderror"
                                value="{{ $quotation->total_weight }}" placeholder="Gross Weight" name="total_weight" required>
                                @error('total_weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div id="units">
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('quantity_units') is-invalid @enderror"
                                value="{{ $quotation->quantity }}" placeholder="Quantity" name="quantity_units" required>
                                @error('quantity_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <!-- <label for="">Dimensions</label> -->
                                <input type="number" class="form-control @error('l') is-invalid @enderror"
                                    id="validationServer04" placeholder="length" name="l" value="{{ $quotation->l }}" required>
                                @error('l')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('w') is-invalid @enderror"
                                    id="validationServer03" placeholder="width" name="w" value="{{ $quotation->w }}" required>
                                @error('w')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('h') is-invalid @enderror"
                                    id="validationServer03" placeholder="height" name="h" value="{{ $quotation->h }}" required>
                                @error('h')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('total_weight_units') is-invalid @enderror"
                                value="{{ $quotation->total_weight }}" name="total_weight_units" disabled>
                                @error('total_weight_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Other Info </b> </h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            
                            <label for="exampleFormControlTextarea1">Remarks</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remarks">{{ $quotation->remarks }}</textarea>
                            @error('value_of_goods')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing3"
                                        name="isClearanceReq" value="Yes" <?php if($quotation->isClearanceReq == 'Yes') echo 'checked="checked"'; ?>>
                                    <label class="custom-control-label" for="customControlAutosizing3">Required Customs
                                        Clearance?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Update Quotation</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom_scripts')
<script>
    $(document).ready(function() 
    {
        $('#shipment').hide();
        $('#units').hide();
        $('#for_flc').hide();

        var trans_type = {!! json_encode($quotation->transportation_type) !!};
        var calculated_by = {!! json_encode($quotation->calculate_by) !!};
        var type = {!! json_encode($quotation->type) !!};
        if(calculated_by == 'units')
        {
            $('#units').show();
            $("input[name=quantity]").prop('required',false);
            $("input[name=total_weight]").prop('required',false);
        }
        else
        {
            $('#shipment').show();
            $("input[name=quantity_units]").prop('required',false);
            $("input[name=l]").prop('required',false);
            $("input[name=w]").prop('required',false);
            $("input[name=h]").prop('required',false);
            $("input[name=total_weight_units]").prop('required',false);
        }
        if(type == 'fcl')
        {
            $('#for_flc').show();
        }
        if(trans_type == 'ocean')
        {
            $('#type_of_shipment').empty();
            $("#type_of_shipment").append(new Option("LCL", "lcl"));
            $("#type_of_shipment").append(new Option("FCL", "fcl"));
        }
        else
        {
            $('#type_of_shipment').empty();
            $("#type_of_shipment").append(new Option("AIR", "air"));
        }

        $("#transportation_type").change(function()
        {
            if($(this).find(':selected').val() == 'ocean')
            {
                $('#type_of_shipment').empty();
                $("#type_of_shipment").append(new Option("LCL", "lcl"));
                $("#type_of_shipment").append(new Option("FCL", "fcl"));
            }
            else if($(this).find(':selected').val() == 'air')
            {
                $('#type_of_shipment').empty();
                $("#type_of_shipment").append(new Option("AIR", "air"));
            }
        });

        // FCL options
        $("#type_of_shipment").change(function()
        {
            if($(this).find(':selected').val() == 'fcl')
            {
                $('#for_flc').show();
            }
        });

        // On calculation radio button clicks
        $('input:radio').change(function()
        {
            var el = $(this).val();
            if(el == 'units')
            {
                $('#units').show();
                $('#shipment').hide();

                $("input[name=quantity]").prop('required',false);
                $("input[name=total_weight]").prop('required',false);
            }
            else
            {
                $('#units').hide();
                $('#shipment').show();
                
                $("input[name=quantity_units]").prop('required',false);
                $("input[name=l]").prop('required',false);
                $("input[name=w]").prop('required',false);
                $("input[name=h]").prop('required',false);
                $("input[name=total_weight_units]").prop('required',false);
            }  
        });

        
        // Live results on calculations
        $("input[name=quantity_units], input[name=total_weight_units], input[name=l], input[name=w], input[name=h]" ).keyup(function() 
        { 
            console.log('123');
            var quantity = $('input[name=quantity_units]').val() ? parseFloat( $('input[name=quantity_units]').val() ) : 1;
            var l = $('input[name=l]').val() ? parseFloat( $('input[name=l]').val() ) : 1;
            var w = $('input[name=w]').val() ? parseFloat( $('input[name=w]').val() ) : 1;
            var h = $('input[name=h]').val() ? parseFloat( $('input[name=h]').val() ) : 1;
            
            var total_weight = (l*w*h)/6000 * quantity;
            $('input[name=total_weight_units]').val(total_weight);
            // $("#kg").text(total_weight);
            // $("#pcs").text(quantity);
        });

    });
    $(function () {
        $('input[name="date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY'), 10),
                autoApply: true,
                maxYear: 2050
            }
        );
    });

</script>
@endsection