@extends('panels.layouts.master')
@section('content')


<div class="row">
    <div class="col-xl-8 col-md-8 mb-4 offset-md-2">
        <div class="card card shadow">
            <h5 class="card-header">Add Quotation</h5>
            <div class="card-body">

                <form action="{{ route('quotation.store') }}" method="POST">
                    @csrf
                    <h5> <b> Origin </b> </h5>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('origin_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" value="{{ old('origin_city') }}"
                                name="origin_city" required>
                            @error('origin_city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('origin_state') is-invalid @enderror"
                                id="validationServer04" placeholder="State" name="origin_state" required>
                            @error('origin_state')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('origin_country') is-invalid @enderror"
                                id="validationServer03" placeholder="Country" name="origin_country" required>
                            @error('origin_country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" class="form-control @error('origin_zip') is-invalid @enderror"
                                id="validationServer05" placeholder="Zip" name="origin_zip" required>
                            @error('origin_zip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <h5> <b> Destination </b> </h5>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('destination_city') is-invalid @enderror"
                                id="validationServer03" placeholder="City" name="destination_city" required>
                            @error('destination_city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('destination_state') is-invalid @enderror"
                                id="validationServer04" placeholder="State" name="destination_state" required>
                            @error('destination_state')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control @error('destination_country') is-invalid @enderror"
                                id="validationServer03" placeholder="Country" name="destination_country" required>
                            @error('destination_country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" class="form-control @error('destination_zip') is-invalid @enderror"
                                id="validationServer05" placeholder="Zip" name="destination_zip" required>
                            @error('destination_zip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01">Ready to load date</label>
                            <input type="text" class="form-control" name="ready_to_load_date" value="" required />

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="incoterms">Incoterms</label>
                            <select class="custom-select mr-sm-2" id="incoterms" name="incoterms">
                                <option>Choose..</option>
                                <option value="EXW">EXW (Ex Works Place)</option>
                                <option value="FOB">FOB (Free On Board Port)</option>
                                <option value="CIP/CIF">CIF/CIP (Cost Insurance & Freight / Carriage & Insurance Paid)
                                </option>
                                <option value="DAP">DAP (Delivered At Place)</option>
                            </select>
                        </div>
                    </div>

                    <div id="exw">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">Pick Up Address</label>
                                <input type="text" class="form-control" name="pickup_address" value="" required />

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">Final destination address</label>
                                <input type="text" class="form-control" name="final_destination_address" value=""
                                    required />

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">

                            <label for="exampleFormControlTextarea1">Description of goods</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="description_of_goods"></textarea>
                            @error('description_of_goods')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2" for="transportation_type">Transportation Type</label>
                            <select class="custom-select mr-sm-2" id="transportation_type" name="transportation_type">
                                <option selected="">Choose...</option>
                                <option value="ocean">Ocean Freight</option>
                                <option value="air">Air Freight</option>
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
                                id="validationServer03" placeholder="Value of Goods (USD)" name="value_of_goods"
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
                                    id="validationServer04" placeholder="No of containers" name="no_of_containers">
                                @error('no_of_containers')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-5 mb-3">
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="container_size">
                                    <option selected="">Container size</option>
                                    <option value="20f">2 x 40'' containers</option>
                                    <option value="40f">2 x 20'' containers</option>
                                    <option value="40f_hc">1 x 40'' containers</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing"
                                        name="isStockable" value="Yes">
                                    <label class="custom-control-label" for="customControlAutosizing">Is
                                        Stockable</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing2"
                                        name="isDGR" value="Yes">
                                    <label class="custom-control-label" for="customControlAutosizing2">Is DGR</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Shipment Calculations </b> </h5>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="calculate_by" value="shipment"
                                    class="custom-control-input" selected="selected">
                                <label class="custom-control-label" for="customRadioInline1">Calculate by total
                                    shipment</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="calculate_by" value="units"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Calculate by units</label>
                            </div>
                        </div>
                    </div>

                    <div id="shipment">
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    id="validationServer03" placeholder="Quantity" name="quantity" required>
                                @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control @error('total_weight') is-invalid @enderror"
                                    id="validationServer04" placeholder="Gross Weight" name="total_weight">
                                @error('total_weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row dynamic-field" style="margin: 20px 0px 10px 0px;" id="units-1">
                        <label for="" style="font-weight: bold;">Pallet#1</label>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('quantity_units') is-invalid @enderror"
                                    id="validationServer03" placeholder="Quantity" name="quantity_units[]" required>
                                @error('quantity_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <!-- <label for="">Dimensions</label> -->
                                <input type="number" class="form-control @error('l') is-invalid @enderror"
                                    id="validationServer04" placeholder="length" name="l[]" required>
                                @error('l')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('w') is-invalid @enderror"
                                    id="validationServer03" placeholder="width" name="w[]" required>
                                @error('w')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="number" class="form-control @error('h') is-invalid @enderror"
                                    id="validationServer03" placeholder="height" name="h[]" required>
                                @error('h')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="form-row" id="dynamic_buttons">
                        <button type="button" class="btn btn-primary btn-sm" id="add-button"
                            style="padding: 0px 15px; height: 40px; margin: 0px 0px 20px 20px; font-size: 12px; border-radius: 10px;">
                            <!-- <span>Add New</span> -->
                            <i class="fal fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" id="remove-button"
                            style="padding: 0px 15px; height: 40px; margin: 0px 0px 20px 20px; font-size: 12px; border-radius: 10px;">
                            <!-- <span>Add New</span> -->
                            <i class="fal fa-minus"></i>
                        </button>
                    </div>

                    <hr>
                    <h5 class="mt-4"> <b> Other Info </b> </h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">

                            <label for="exampleFormControlTextarea1">Remarks</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="remarks"></textarea>
                            @error('remarks')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing3"
                                        name="isClearanceReq" value="Yes">
                                    <label class="custom-control-label" for="customControlAutosizing3">Required Customs
                                        Clearance?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Request Quotation</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('bottom_scripts')
<script>
    $(document).ready(function () {
        $('#exw').hide();
        $('.dynamic-field').hide();
        $('#dynamic_buttons').hide();
        $(".require").prop('required', false);
        $('#for_flc').hide();

        // On load
        if ($("#transportation_type").find(':selected').val() == 'ocean') {
            $('#type_of_shipment').empty();
            $("#type_of_shipment").append(new Option("LCL", "lcl"));
            $("#type_of_shipment").append(new Option("FCL", "fcl"));
        } else if ($("#transportation_type").find(':selected').val() == 'air') {
            $('#type_of_shipment').empty();
            $("#type_of_shipment").append(new Option("AIR", "air"));
        }

        if ($("#type_of_shipment").find(':selected').val() == 'fcl') {
            $('#for_flc').show();
        }

        $("#transportation_type").change(function () {
            if ($(this).find(':selected').val() == 'ocean') {
                $('#type_of_shipment').empty();
                $("#type_of_shipment").append(new Option("LCL", "lcl"));
                $("#type_of_shipment").append(new Option("FCL", "fcl"));
            } else if ($(this).find(':selected').val() == 'air') {
                $('#type_of_shipment').empty();
                $("#type_of_shipment").append(new Option("AIR", "air"));
                $('#for_flc').hide();
            }
        });

        // FCL options
        $("#type_of_shipment").change(function () {
            if ($(this).find(':selected').val() == 'fcl') {
                $('#for_flc').show();
            } else {
                $('#for_flc').hide();
            }
        });

        // On calculation radio button clicks
        $('input:radio').change(function () 
        {
            var el = $(this).val();
            if (el == 'units') {
                $('#dynamic_buttons').show();
                $('.dynamic-field').show();
                $(".require").prop('required', true);

                $('#shipment').hide();
                $("input[name=quantity]").prop('required', false);
                $("input[name=total_weight]").prop('required', false);
            } else {
                $('.dynamic-field').hide();
                $('#dynamic_buttons').hide();
                $('#shipment').show();

                $(".require").prop('required', false);
            }
        });

        // Live results on calculations
        $("input[name=quantity_units], input[name=total_weight_units], input[name=l], input[name=w], input[name=h]")
            .keyup(function () {
                console.log('123');
                var quantity = $('input[name=quantity_units]').val() ? parseFloat($(
                    'input[name=quantity_units]').val()) : 1;
                var l = $('input[name=l]').val() ? parseFloat($('input[name=l]').val()) : 1;
                var w = $('input[name=w]').val() ? parseFloat($('input[name=w]').val()) : 1;
                var h = $('input[name=h]').val() ? parseFloat($('input[name=h]').val()) : 1;

                var total_weight = (l * w * h) / 6000 * quantity;
                $('input[name=total_weight_units]').val(total_weight);
                // $("#kg").text(total_weight);
                // $("#pcs").text(quantity);
            });

        
        // On Incoterms button clicks
        $('#incoterms').change(function () {
            var el = $(this).val();
            console.log(el);
            if (el == 'EXW') {
                $('#exw').show();
                $("input[name=pickup_address]").prop('required', true);
                $("input[name=final_destination_address]").prop('required',
                    true);
            } else {
                $('#exw').hide();
                $("input[name=pickup_address]").prop('required', false);
                $("input[name=final_destination_address]").prop('required',
                    false);
            }
        });

    });

    $(function () {
        $('input[name="ready_to_load_date"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: parseInt(moment().format('YYYY'), 10),
            autoApply: true,
            maxYear: 2050,
            locale: {
                format: 'D-M-YYYY'
            }
        });
    });

</script>


<!-- Add dynamic input fields -->
<script>
    $(document).ready(function () {
        var buttonAdd = $("#add-button");
        var buttonRemove = $("#remove-button");
        var className = ".dynamic-field";
        var count = 0;
        var field = "";
        var maxFields = 50;

        function totalFields() {
            return $(className).length;
        }

        function addNewField() {
            count = totalFields() + 1;
            field = $("#units-1").clone();
            field.attr("id", "units-" + count);
            field.children("label").text("Pallet# " + count);
            field.find("input").val("");
            $(className + ":last").after($(field));
        }

        function removeLastField() {
            if (totalFields() > 1) {
                $(className + ":last").remove();
            }
        }

        function enableButtonRemove() {
            if (totalFields() === 2) {
                buttonRemove.removeAttr("disabled");
                buttonRemove.addClass("shadow-sm");
            }
        }

        function disableButtonRemove() {
            if (totalFields() === 1) {
                buttonRemove.attr("disabled", "disabled");
                buttonRemove.removeClass("shadow-sm");
            }
        }

        function disableButtonAdd() {
            if (totalFields() === maxFields) {
                buttonAdd.attr("disabled", "disabled");
                buttonAdd.removeClass("shadow-sm");
            }
        }

        function enableButtonAdd() {
            if (totalFields() === (maxFields - 1)) {
                buttonAdd.removeAttr("disabled");
                buttonAdd.addClass("shadow-sm");
            }
        }

        buttonAdd.click(function () {
            addNewField();
            enableButtonRemove();
            disableButtonAdd();
        });

        buttonRemove.click(function () {
            removeLastField();
            disableButtonRemove();
            enableButtonAdd();
        });
    });

</script>

@endsection
